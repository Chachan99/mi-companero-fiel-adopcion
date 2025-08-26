<?php

namespace App\Http\Controllers\Fundacion;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use App\Models\PerfilFundacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class NoticiaController extends Controller
{
    public function __construct()
    {
        // El middleware 'auth' y 'role:fundacion' ya se aplican en las rutas
    }

    public function index()
    {
        // Obtener el perfil de la fundación del usuario autenticado
        $perfilFundacion = PerfilFundacion::where('usuario_id', Auth::id())->firstOrFail();
        
        // Obtener las noticias de la fundación
        $noticias = Noticia::where('fundacion_id', $perfilFundacion->id)
            ->latest('fecha_publicacion')
            ->paginate(10);

        return view('fundacion.noticias.index', compact('noticias'));
    }

    public function create()
    {
        return view('fundacion.noticias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'resumen' => 'nullable|string|max:500',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'publicada' => 'boolean',
            'fecha_publicacion' => 'nullable|date|after_or_equal:now',
        ]);

        // Obtener el perfil de la fundación del usuario autenticado
        $perfilFundacion = PerfilFundacion::where('usuario_id', Auth::id())->firstOrFail();

        // Crear la noticia con los datos validados
        $noticiaData = [
            'titulo' => $validated['titulo'],
            'contenido' => $validated['contenido'],
            'resumen' => $validated['resumen'] ?? Str::limit(strip_tags($validated['contenido']), 200),
            'publicada' => (bool)($validated['publicada'] ?? false),
            'fecha_publicacion' => $validated['fecha_publicacion'] ?? now(),
            'fundacion_id' => $perfilFundacion->id,
        ];

        // Procesar la imagen si se subió
        if ($request->hasFile('imagen')) {
            try {
                $imagenNombre = $this->guardarImagen($request->file('imagen'), 'noticias');
                $noticiaData['imagen'] = $imagenNombre;
            } catch (\Exception $e) {
                \Log::error('Error al procesar la imagen: ' . $e->getMessage());
                return redirect()->back()
                    ->with('error', 'Ocurrió un error al procesar la imagen. Por favor, inténtalo de nuevo.');
            }
        }
        
        // Crear la noticia
        $noticia = Noticia::create($noticiaData);
        
        // Redirigir con mensaje de éxito
        return redirect()->route('fundacion.noticias.index')
            ->with('success', 'Noticia creada exitosamente.');
    }

    public function edit(Noticia $noticia)
    {
        $this->authorize('update', $noticia);
        return view('fundacion.noticias.edit', compact('noticia'));
    }

    public function update(Request $request, Noticia $noticia)
    {
        $this->authorize('update', $noticia);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'publicada' => 'boolean',
            'fecha_publicacion' => 'nullable|date',
        ]);

        // Actualizar la noticia
        $noticia->titulo = $request->titulo;
        $noticia->contenido = $request->contenido;
        $noticia->publicada = $request->has('publicada');
        $noticia->fecha_publicacion = $request->fecha_publicacion;

        // Procesar la imagen si se subió
        if ($request->hasFile('imagen')) {
            try {
                // Eliminar la imagen anterior si existe
                if ($noticia->imagen && file_exists(public_path('img/noticias/' . $noticia->imagen))) {
                    @unlink(public_path('img/noticias/' . $noticia->imagen));
                }
                
                $imagenNombre = $this->guardarImagen($request->file('imagen'), 'noticias');
                $noticia->imagen = $imagenNombre;
            } catch (\Exception $e) {
                \Log::error('Error al procesar la imagen: ' . $e->getMessage());
                return redirect()->back()
                    ->with('error', 'Ocurrió un error al procesar la imagen. Por favor, inténtalo de nuevo.');
            }
        }

        $noticia->save();

        return redirect()->route('fundacion.noticias.index')
            ->with('success', 'Noticia actualizada exitosamente.');
    }

    public function destroy(Noticia $noticia)
    {
        $this->authorize('delete', $noticia);
        
        // Eliminar la imagen si existe
        if ($noticia->imagen && file_exists(public_path('img/noticias/' . $noticia->imagen))) {
            unlink(public_path('img/noticias/' . $noticia->imagen));
        }
        
        $noticia->delete();

        return redirect()->route('fundacion.noticias.index')
            ->with('success', 'Noticia eliminada exitosamente.');
    }

    /**
     * Guarda una imagen en el almacenamiento
     */
    protected function guardarImagen($imagen, $directorio)
    {
        try {
            // Generar un nombre único para la imagen
            $nombreArchivo = uniqid() . '_' . time() . '.' . $imagen->getClientOriginalExtension();
            
            // Verificar que el archivo de imagen sea válido
            if (!$imagen->isValid()) {
                throw new \Exception('El archivo de imagen no es válido');
            }
            
            // Crear el directorio en public/img si no existe
            $rutaDirectorio = public_path('img' . DIRECTORY_SEPARATOR . $directorio);
            
            if (!file_exists($rutaDirectorio)) {
                // Usar File facade para crear el directorio con permisos correctos
                File::makeDirectory($rutaDirectorio, 0777, true, true);
            }
            
            $rutaCompleta = $rutaDirectorio . DIRECTORY_SEPARATOR . $nombreArchivo;
            
            // Método alternativo: usar file_put_contents en lugar de move
            $contenidoImagen = file_get_contents($imagen->getRealPath());
            if ($contenidoImagen === false) {
                throw new \Exception('No se pudo leer el contenido de la imagen');
            }
            
            // Guardar el archivo usando file_put_contents
            if (file_put_contents($rutaCompleta, $contenidoImagen) === false) {
                throw new \Exception('No se pudo escribir la imagen en el directorio de destino');
            }
            
            // Verificar que el archivo se guardó correctamente
            if (!file_exists($rutaCompleta)) {
                throw new \Exception('El archivo no se guardó correctamente');
            }
            
            // Retornar solo el nombre del archivo
            return $nombreArchivo;
            
        } catch (\Exception $e) {
            \Log::error('Error en guardarImagen: ' . $e->getMessage(), [
                'directorio' => $directorio,
                'ruta_directorio' => $rutaDirectorio ?? 'no definida',
                'archivo_original' => $imagen->getClientOriginalName() ?? 'no definido',
                'es_valido' => $imagen->isValid() ?? false,
                'tamaño' => $imagen->getSize() ?? 0,
                'ruta_real' => $imagen->getRealPath() ?? 'no definida'
            ]);
            throw new \Exception('Error al procesar la imagen: ' . $e->getMessage());
        }
    }
}