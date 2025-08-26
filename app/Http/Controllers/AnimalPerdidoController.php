<?php

namespace App\Http\Controllers;

use App\Models\MascotaPerdida;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AnimalPerdidoController extends Controller
{
    /**
     * Display a listing of lost pets.
     */
    public function index()
    {
        $animalesPerdidos = MascotaPerdida::where('estado', 'perdido')
            ->latest()
            ->paginate(12);

        return view('publico.animales-perdidos.index', compact('animalesPerdidos'));
    }

    /**
     * Show the form for creating a new lost pet post.
     */
    public function create()
    {
        return view('publico.animales-perdidos.create');
    }

    /**
     * Store a newly created lost pet post in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo' => 'required|string|max:50',
            'raza' => 'nullable|string|max:100',
            'edad' => 'required|integer|min:0',
            'tipo_edad' => 'required|in:meses,años',
            'sexo' => 'required|in:macho,hembra',
            'descripcion' => 'required|string|max:1000',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'telefono_contacto' => 'required|string|max:20',
            'email_contacto' => 'required|email|max:100',
            'recompensa' => 'nullable|string|max:100',
            'ultima_ubicacion' => 'required|string',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
            'direccion' => 'nullable|string',
        ]);

        // Handle file upload
        if ($request->hasFile('imagen')) {
            // Crear directorio si no existe
            $directory = public_path('img/animales-perdidos');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            
            // Generar nombre único para la imagen
            $imageName = uniqid() . '_' . time() . '.' . $request->file('imagen')->getClientOriginalExtension();
            
            // Mover la imagen al directorio público
            $request->file('imagen')->move($directory, $imageName);
            
            // Guardar la ruta relativa en la base de datos
            $validated['imagen'] = 'img/animales-perdidos/' . $imageName;
        }

        // Set user ID if authenticated
        if (auth()->check()) {
            $validated['usuario_id'] = auth()->id();
            
            // If user is a foundation, associate with them
            if (auth()->user()->rol === 'fundacion') {
                $validated['fundacion_id'] = auth()->id();
            }
        }

        // Create the lost pet post
        MascotaPerdida::create($validated);

        return redirect()->route('animales-perdidos.index')
            ->with('success', '¡Publicación de mascota perdida creada con éxito!');
    }

    /**
     * Display the specified lost pet.
     */
    public function show($id)
    {
        $mascota = MascotaPerdida::findOrFail($id);
        return view('publico.animales-perdidos.show', compact('mascota'));
    }

    /**
     * Mark a lost pet as found.
     */
    public function marcarComoEncontrado($id)
    {
        $mascota = MascotaPerdida::findOrFail($id);

        // Verificar permisos (solo el dueño, la fundación o un administrador puede marcar como encontrado)
        $user = auth()->user();
        if ($user->rol !== 'admin' && 
            $user->id !== $mascota->usuario_id && 
            $user->id !== $mascota->fundacion_id) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        $mascota->update([
            'estado' => 'encontrado',
            'fecha_encontrado' => now()
        ]);

        return back()->with('success', '¡La mascota ha sido marcada como encontrada!');
    }
}
