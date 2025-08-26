<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Animal;
use App\Models\Donacion;
use App\Models\SolicitudAdopcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Filtrar donaciones por fundación para el panel admin
     */
    public function filtrarDonaciones(Request $request)
    {
        $fundacionId = $request->input('fundacion_id');
        $query = \App\Models\Donacion::with('fundacion');
        if ($fundacionId) {
            $query->where('fundacion_id', $fundacionId);
        }
        $donaciones = $query->orderBy('created_at', 'desc')->paginate(15);
        $fundaciones = \App\Models\PerfilFundacion::with('usuario')->get();
        $total_recaudado = $donaciones->sum('monto');
        $promedio_donacion = $donaciones->count() ? $donaciones->avg('monto') : 0;
        $donaciones_unicas = $donaciones->pluck('usuario_id')->unique()->count();
        return view('admin.donaciones.index', compact('donaciones', 'fundaciones', 'total_recaudado', 'promedio_donacion', 'donaciones_unicas'));
    }
    /**
     * Listado de fundaciones para el panel de administración
     */
    public function fundaciones()
    {
        $fundaciones = \App\Models\PerfilFundacion::with('usuario')
            ->withCount(['animales' => function($query) {
                $query->where('estado', 'disponible');
            }, 'donaciones'])
            ->paginate(10);
        return view('admin.fundaciones.index', compact('fundaciones'));
    }
    public function __construct()
    {
        \Log::info('AdminController __construct', [
            'user' => auth()->user()
        ]);
    }
    
    /**
     * Muestra el listado de mascotas perdidas en el panel de administración
     */
    public function mascotasPerdidas()
    {
        $mascotas = \App\Models\MascotaPerdida::with('usuario')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.mascotas-perdidas.index', compact('mascotas'));
    }

    public function index()
    {
        \Log::info('Usuario autenticado:', [
            'id' => Auth::id(),
            'email' => Auth::user()->email ?? null,
            'rol' => Auth::user()->rol ?? null
        ]);
        $estadisticas = [
            'total_usuarios' => Usuario::count(),
            'total_fundaciones' => Usuario::where('rol', 'fundacion')->count(),
            'total_animales' => Animal::count(),
            'total_donaciones' => Donacion::count(),
            'total_solicitudes' => SolicitudAdopcion::count()
        ];
        $donaciones = Donacion::with('fundacion')->orderBy('created_at', 'desc')->take(10)->get();
        $solicitudes = SolicitudAdopcion::with('usuario', 'animal', 'fundacion')->orderBy('created_at', 'desc')->take(10)->get();

        // Actividad reciente (ejemplo: últimos cambios en usuarios, animales, donaciones)
        $actividades = [];
        $ultimosUsuarios = Usuario::orderBy('created_at', 'desc')->take(3)->get();
        foreach ($ultimosUsuarios as $usuario) {
            $actividades[] = [
                'titulo' => 'Nuevo usuario registrado',
                'descripcion' => $usuario->nombre . ' (' . $usuario->email . ')',
                'fecha' => $usuario->created_at,
                'color' => 'cyan',
                'icono' => '<path d="M17 20h5v-2a4 4 0 0 0-3-3.87"/><path d="M9 20H4v-2a4 4 0 0 1 3-3.87"/><circle cx="12" cy="7" r="4"/>'
            ];
        }
        $ultimosAnimales = Animal::orderBy('created_at', 'desc')->take(3)->get();
        foreach ($ultimosAnimales as $animal) {
            $actividades[] = [
                'titulo' => 'Nuevo animal agregado',
                'descripcion' => $animal->nombre . ' (' . $animal->tipo . ')',
                'fecha' => $animal->created_at,
                'color' => 'yellow',
                'icono' => '<circle cx="12" cy="12" r="10"/><path d="M8 15s1.5-2 4-2 4 2 4 2"/>'
            ];
        }
        $ultimasDonaciones = Donacion::orderBy('created_at', 'desc')->take(3)->get();
        foreach ($ultimasDonaciones as $donacion) {
            $actividades[] = [
                'titulo' => 'Nueva donación',
                'descripcion' => 'Monto: $' . number_format($donacion->monto, 2),
                'fecha' => $donacion->created_at,
                'color' => 'green',
                'icono' => '<path d="M12 8v4l3 3"/><circle cx="12" cy="12" r="10"/>'
            ];
        }
        usort($actividades, function($a, $b) {
            return $b['fecha']->timestamp <=> $a['fecha']->timestamp;
        });

        return view('admin.dashboard', compact('estadisticas', 'donaciones', 'solicitudes', 'actividades'));
    }

    public function usuarios(Request $request)
    {
        $query = Usuario::with('perfilFundacion');
        
        // Filtros
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        if ($request->filled('rol')) {
            $query->where('rol', $request->rol);
        }
        
        if ($request->filled('status')) {
            $status = $request->status === 'activo' ? 1 : 0;
            $query->where('activo', $status);
        }
        
        if ($request->filled('fecha_desde')) {
            $query->whereDate('created_at', '>=', $request->fecha_desde);
        }
        
        if ($request->filled('fecha_hasta')) {
            $query->whereDate('created_at', '<=', $request->fecha_hasta);
        }
        
        $usuarios = $query->paginate(10);
        $total_usuarios = Usuario::count();
        $total_admins = Usuario::where('rol', 'admin')->count();
        $total_fundaciones = Usuario::where('rol', 'fundacion')->count();
        $nuevos_usuarios = Usuario::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        
        return view('admin.usuarios.index', compact('usuarios', 'total_usuarios', 'total_admins', 'total_fundaciones', 'nuevos_usuarios'));
    }

    public function crearUsuario()
    {
        return view('admin.usuarios.create');
    }

    public function guardarUsuario(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:6|confirmed',
            'rol' => 'required|in:admin,fundacion',
        ]);
        $usuario = new Usuario();
        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->rol = $request->rol;
        $usuario->save();
        return redirect()->route('admin.usuarios')->with('success', 'Usuario creado exitosamente');
    }

    public function editarUsuario($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function actualizarUsuario(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
            'rol' => 'required|in:admin,fundacion',
            'password' => 'nullable|string|min:6|confirmed',
        ]);
        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        $usuario->rol = $request->rol;
        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
        }
        $usuario->save();
        return redirect()->route('admin.usuarios')->with('success', 'Usuario actualizado exitosamente');
    }

    public function eliminarUsuario($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return redirect()->route('admin.usuarios')->with('success', 'Usuario eliminado exitosamente');
    }
    
    /**
     * Exportar usuarios a CSV
     */
    public function exportarUsuarios(Request $request)
    {
        $query = Usuario::with('perfilFundacion');
        
        // Aplicar los mismos filtros que en la vista
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        if ($request->filled('rol')) {
            $query->where('rol', $request->rol);
        }
        
        if ($request->filled('status')) {
            $status = $request->status === 'activo' ? 1 : 0;
            $query->where('activo', $status);
        }
        
        if ($request->filled('fecha_desde')) {
            $query->whereDate('created_at', '>=', $request->fecha_desde);
        }
        
        if ($request->filled('fecha_hasta')) {
            $query->whereDate('created_at', '<=', $request->fecha_hasta);
        }
        
        $usuarios = $query->get();
        
        $filename = 'usuarios_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($usuarios) {
            $file = fopen('php://output', 'w');
            
            // Agregar BOM para UTF-8
            fwrite($file, "\xEF\xBB\xBF");
            
            // Encabezados
            fputcsv($file, ['ID', 'Nombre', 'Email', 'Rol', 'Estado', 'Fundación', 'Fecha de Registro', 'Última Actualización']);
            
            foreach ($usuarios as $usuario) {
                fputcsv($file, [
                    $usuario->id,
                    $usuario->nombre,
                    $usuario->email,
                    ucfirst($usuario->rol),
                    $usuario->activo ? 'Activo' : 'Inactivo',
                    $usuario->perfilFundacion ? $usuario->perfilFundacion->nombre : 'N/A',
                    $usuario->created_at->format('d/m/Y H:i:s'),
                    $usuario->updated_at->format('d/m/Y H:i:s')
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    /**
     * Acciones en lote para usuarios
     */
    public function accionesLoteUsuarios(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|string',
            'action' => 'required|in:delete,change_role,toggle_status'
        ]);
        
        $usuariosIds = json_decode($request->user_ids, true);
        $accion = $request->action;
        $mensaje = '';
        $success = true;
        
        try {
            switch ($accion) {
                case 'delete':
                    Usuario::whereIn('id', $usuariosIds)->delete();
                    $mensaje = 'Usuarios eliminados exitosamente';
                    break;
                    
                case 'change_role':
                    $request->validate(['role' => 'required|in:admin,fundacion,publico']);
                    Usuario::whereIn('id', $usuariosIds)->update(['rol' => $request->role]);
                    $mensaje = 'Rol actualizado para los usuarios seleccionados';
                    break;
                    
                case 'toggle_status':
                    $request->validate(['action' => 'required|in:activate,deactivate']);
                    $status = $request->input('action') === 'activate' ? true : false;
                    Usuario::whereIn('id', $usuariosIds)->update(['activo' => $status]);
                    $mensaje = $status ? 'Usuarios activados exitosamente' : 'Usuarios desactivados exitosamente';
                    break;
            }
        } catch (\Exception $e) {
            $success = false;
            $mensaje = 'Error al realizar la acción: ' . $e->getMessage();
        }
        
        return response()->json([
            'success' => $success,
            'message' => $mensaje
        ]);
    }
    
    /**
     * Estadísticas detalladas de usuarios
     */
    public function estadisticasUsuarios()
    {
        $estadisticas = [
            'total_usuarios' => Usuario::count(),
            'usuarios_activos' => Usuario::where('activo', true)->count(),
            'usuarios_inactivos' => Usuario::where('activo', false)->count(),
            'admins' => Usuario::where('rol', 'admin')->count(),
            'fundaciones' => Usuario::where('rol', 'fundacion')->count(),
            'registros_ultimo_mes' => Usuario::where('created_at', '>=', Carbon::now()->subMonth())->count(),
            'registros_ultima_semana' => Usuario::where('created_at', '>=', Carbon::now()->subWeek())->count(),
            'registros_hoy' => Usuario::whereDate('created_at', Carbon::today())->count(),
        ];
        
        // Registros por mes (últimos 12 meses)
        $registrosPorMes = Usuario::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as mes'),
            DB::raw('count(*) as total')
        )
        ->where('created_at', '>=', Carbon::now()->subYear())
        ->groupBy('mes')
        ->orderBy('mes')
        ->get();
        
        // Distribución por rol
        $distribucionRoles = Usuario::select('rol', DB::raw('count(*) as total'))
            ->groupBy('rol')
            ->get();
            
        return response()->json([
            'estadisticas' => $estadisticas,
            'registros_por_mes' => $registrosPorMes,
            'distribucion_roles' => $distribucionRoles
        ]);
    }

    public function actualizarRol(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $request->validate([
            'rol' => 'required|in:fundacion,admin'
        ]);

        $usuario->rol = $request->rol;
        $usuario->save();

        return redirect()->route('admin.usuarios')->with('success', 'Rol actualizado exitosamente');
    }

    public function animales()
    {
        $animales = \App\Models\Animal::with('fundacion')->orderBy('created_at', 'desc')->paginate(12);
        return view('admin.animales.index', compact('animales'));
    }

    public function crearAnimal()
    {
        return view('admin.animales.create');
    }

    public function guardarAnimal(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string',
            'edad' => 'required|integer',
            'sexo' => 'required|string',
            'descripcion' => 'required|string',
            'estado' => 'required|in:disponible,adoptado,en_adopcion',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $animal = new Animal();
        $animal->nombre = $request->nombre;
        $animal->tipo = $request->tipo;
        $animal->edad = $request->edad;
        $animal->sexo = $request->sexo;
        $animal->descripcion = $request->descripcion;
        $animal->estado = $request->estado;
        $animal->fundacion_id = auth()->user()->id; // Asumiendo que el usuario logueado es la fundación
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombre = time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(public_path('test'), $nombre);
            $animal->imagen = $nombre;
        }
        $animal->save();
        return redirect()->route('admin.animales')->with('success', 'Animal creado exitosamente');
    }

    public function editarAnimal($id)
    {
        $animal = \App\Models\Animal::findOrFail($id);
        return view('admin.animales.edit', compact('animal'));
    }

    public function actualizarAnimal(Request $request, $id)
    {
        $animal = \App\Models\Animal::findOrFail($id);
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string',
            'edad' => 'required|integer',
            'sexo' => 'required|string',
            'descripcion' => 'required|string',
            'estado' => 'required|in:disponible,adoptado,en_adopcion',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $animal->nombre = $request->nombre;
        $animal->tipo = $request->tipo;
        $animal->edad = $request->edad;
        $animal->sexo = $request->sexo;
        $animal->descripcion = $request->descripcion;
        $animal->estado = $request->estado;
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombre = time() . '.' . $imagen->getClientOriginalExtension();
            try {
                $imagen->move(public_path('test'), $nombre);
            } catch (\Exception $e) {
                dd('Error al mover imagen: ' . $e->getMessage());
            }
            $animal->imagen = $nombre;
        }
        $animal->save();
        return redirect()->route('admin.animales')->with('success', 'Animal actualizado exitosamente');
    }

    public function eliminarAnimal($id)
    {
        $animal = \App\Models\Animal::findOrFail($id);
        $animal->delete();
        return redirect()->route('admin.animales')->with('success', 'Animal eliminado exitosamente');
    }

    public function solicitudes()
    {
        $solicitudes = SolicitudAdopcion::with('usuario', 'animal', 'fundacion')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.solicitudes.index', compact('solicitudes'));
    }

    public function donaciones()
    {
        $donaciones = Donacion::with('fundacion')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        $fundaciones = \App\Models\PerfilFundacion::with('usuario')->get();
        $total_recaudado = $donaciones->sum('monto');
        $promedio_donacion = $donaciones->count() ? $donaciones->avg('monto') : 0;
        $donaciones_unicas = $donaciones->pluck('usuario_id')->unique()->count();
        return view('admin.donaciones.index', compact('donaciones', 'fundaciones', 'total_recaudado', 'promedio_donacion', 'donaciones_unicas'));
    }

    public function reportes()
    {
        $reportes = [
            'animales_por_tipo' => Animal::select('tipo', \DB::raw('count(*) as total'))
                ->groupBy('tipo')
                ->get(),
            'donaciones_por_mes' => Donacion::select(
                \DB::raw('DATE_FORMAT(created_at, "%Y-%m") as mes'),
                \DB::raw('count(*) as total')
            )
            ->groupBy('mes')
            ->orderBy('mes', 'desc')
            ->take(12)
            ->get(),
            'solicitudes_por_estado' => SolicitudAdopcion::select('estado', \DB::raw('count(*) as total'))
                ->groupBy('estado')
                ->get()
        ];

        return view('admin.reportes.index', compact('reportes'));
    }
}
