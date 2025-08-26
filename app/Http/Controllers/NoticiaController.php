<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the public news.
     *
     * @return \Illuminate\View\View
     */
    public function publicIndex()
    {
        // Get featured news (destacadas)
        $featuredNews = Noticia::with('fundacion')
            ->where('publicada', true)
            ->where('destacada', true)
            ->where(function($query) {
                $query->whereNull('fecha_publicacion')
                      ->orWhere('fecha_publicacion', '<=', now());
            })
            ->orderBy('fecha_publicacion', 'desc')
            ->take(3)
            ->get();

        // Get regular news
        $noticias = Noticia::with('fundacion')
            ->where('publicada', true)
            ->where(function($query) {
                $query->whereNull('fecha_publicacion')
                      ->orWhere('fecha_publicacion', '<=', now());
            })
            ->where('destacada', false)
            ->orderBy('fecha_publicacion', 'desc')
            ->paginate(9);

        return view('publico.noticias.index', compact('noticias', 'featuredNews'));
    }

    /**
     * Muestra el formulario para crear una nueva noticia.
     */
    public function create()
    {
        $this->authorize('create', Noticia::class);
        return view('admin.noticias.create');
    }

    /**
     * Almacena una nueva noticia en la base de datos.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Noticia::class);
        
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'autor' => 'nullable|string|max:255',
            'destacada' => 'sometimes|boolean',
            'estado' => 'required|in:borrador,publicada,archivada',
            'publicado_en' => 'nullable|date',
            'resumen' => 'nullable|string|max:500',
        ]);
        
        // Procesar la imagen si se subió
        if ($request->hasFile('imagen')) {
            try {
                $nombreImagen = $this->guardarImagen($request->file('imagen'), 'noticias');
                $validated['imagen'] = $nombreImagen;
            } catch (\Exception $e) {
                return redirect()->back()
                    ->with('error', 'Error al procesar la imagen: ' . $e->getMessage());
            }
        }
        
        // Asignar el usuario autenticado como autor si no se proporciona un autor
        if (empty($validated['autor']) && Auth::check()) {
            $validated['autor'] = Auth::user()->name;
        }
        
        // Asignar el usuario actual si está autenticado
        if (Auth::check()) {
            $validated['usuario_id'] = Auth::id();
        }
        
        // Si se está publicando y no hay fecha de publicación, usar la fecha actual
        if ($validated['estado'] === 'publicada' && empty($validated['publicado_en'])) {
            $validated['publicado_en'] = now();
        }
        
        // Crear la noticia
        $noticia = Noticia::create($validated);
        
        return redirect()->route('admin.noticias.edit', $noticia)
            ->with('success', 'Noticia creada exitosamente.');
    }

    /**
     * Display the specified news article.
     *
     * @param  \App\Models\Noticia  $noticia
     * @return \Illuminate\View\View
     */
    public function show(Noticia $noticia)
    {
        // Si la noticia no está publicada, solo pueden verla usuarios autorizados
        if (!$noticia->publicada || ($noticia->fecha_publicacion && $noticia->fecha_publicacion > now())) {
            if (!Auth::check() || !Auth::user()->can('view', $noticia)) {
                abort(404, 'La noticia que buscas no existe o no está disponible.');
            }
        }
        
        // Incrementar el contador de vistas
        $noticia->increment('vistas');
        
        // Cargar la relación con la fundación
        $noticia->load('fundacion');
        
        // Obtener noticias relacionadas (misma fundación)
        $noticiasRelacionadas = Noticia::where('publicada', true)
            ->where('id', '!=', $noticia->id)
            ->where(function($query) use ($noticia) {
                $query->where('fundacion_id', $noticia->fundacion_id);
            })
            ->where(function($query) {
                $query->whereNull('fecha_publicacion')
                      ->orWhere('fecha_publicacion', '<=', now());
            })
            ->orderBy('fecha_publicacion', 'desc')
            ->take(3)
            ->get();
            
        // Si no hay suficientes noticias relacionadas, completar con noticias recientes
        if ($noticiasRelacionadas->count() < 3) {
            $noticiasAdicionales = Noticia::where('publicada', true)
                ->where('id', '!=', $noticia->id)
                ->whereNotIn('id', $noticiasRelacionadas->pluck('id'))
                ->where(function($query) {
                    $query->whereNull('fecha_publicacion')
                          ->orWhere('fecha_publicacion', '<=', now());
                })
                ->orderBy('fecha_publicacion', 'desc')
                ->take(3 - $noticiasRelacionadas->count())
                ->get();
                
            $noticiasRelacionadas = $noticiasRelacionadas->merge($noticiasAdicionales);
        }
            
        // Obtener noticias recientes para la barra lateral
        $noticiasRecientes = Noticia::where('estado', 'publicada')
            ->where('id', '!=', $noticia->id)
            ->where(function($query) use ($noticia) {
                $query->whereNull('publicado_en')
                      ->orWhere('publicado_en', '<=', now());
            })
            ->orderBy('publicado_en', 'desc')
            ->take(5)
            ->get();
            
        return view('publico.noticias.show', compact('noticia', 'noticiasRelacionadas', 'noticiasRecientes'));
    }

    /**
     * Muestra el formulario para editar una noticia.
     */
    public function edit(Noticia $noticia)
    {
        $this->authorize('update', $noticia);
        return view('admin.noticias.edit', compact('noticia'));
    }

    /**
     * Actualiza una noticia existente.
     */
    public function update(Request $request, Noticia $noticia)
    {
        $this->authorize('update', $noticia);
        
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'autor' => 'nullable|string|max:255',
            'destacada' => 'sometimes|boolean',
            'estado' => 'required|in:borrador,publicada,archivada',
            'publicado_en' => 'nullable|date',
            'resumen' => 'nullable|string|max:500',
            'eliminar_imagen' => 'sometimes|boolean',
        ]);
        
        // Procesar la imagen si se subió una nueva
        if ($request->hasFile('imagen')) {
            try {
                // Eliminar la imagen anterior si existe
                if ($noticia->imagen && file_exists(public_path('img/noticias/' . $noticia->imagen))) {
                    unlink(public_path('img/noticias/' . $noticia->imagen));
                }
                
                $nombreImagen = $this->guardarImagen($request->file('imagen'), 'noticias');
                $validated['imagen'] = $nombreImagen;
            } catch (\Exception $e) {
                return redirect()->back()
                    ->with('error', 'Error al procesar la imagen: ' . $e->getMessage());
            }
        } elseif ($request->has('eliminar_imagen') && $request->boolean('eliminar_imagen') && $noticia->imagen) {
            // Eliminar la imagen si se marcó la opción de eliminar
            if (file_exists(public_path('img/noticias/' . $noticia->imagen))) {
                unlink(public_path('img/noticias/' . $noticia->imagen));
            }
            $validated['imagen'] = null;
        } else {
            // Mantener la imagen existente si no se proporciona una nueva
            unset($validated['imagen']);
        }
        
        // Si se está publicando y no hay fecha de publicación, usar la fecha actual
        if ($validated['estado'] === 'publicada' && empty($validated['publicado_en']) && $noticia->estado !== 'publicada') {
            $validated['publicado_en'] = now();
        }
        
        // Actualizar la noticia
        $noticia->update($validated);
        
        return redirect()->route('admin.noticias.edit', $noticia)
            ->with('success', 'Noticia actualizada exitosamente.');
    }

    /**
     * Elimina una noticia.
     */
    public function destroy(Noticia $noticia)
    {
        $this->authorize('delete', $noticia);
        
        // Eliminar la imagen si existe
        if ($noticia->imagen) {
            Storage::delete('public/noticias/' . $noticia->imagen);
        }
        
        $noticia->delete();
        
        return redirect()->route('admin.noticias.index')
            ->with('success', 'Noticia eliminada exitosamente.');
    }
    
    /**
     * Cambia el estado de una noticia.
     */
    public function cambiarEstado(Request $request, Noticia $noticia)
    {
        $this->authorize('update', $noticia);
        
        $request->validate([
            'estado' => 'required|in:borrador,publicada,archivada',
        ]);
        
        $noticia->estado = $request->estado;
        
        // Si se está publicando y no tiene fecha de publicación, establecerla
        if ($request->estado === 'publicada' && !$noticia->publicado_en) {
            $noticia->publicado_en = now();
        }
        
        $noticia->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Estado de la noticia actualizado correctamente',
            'estado' => $noticia->estado,
            'estado_texto' => ucfirst($noticia->estado),
        ]);
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