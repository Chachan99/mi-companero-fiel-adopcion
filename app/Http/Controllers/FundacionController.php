<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\PerfilFundacion;
use App\Models\Animal;
use App\Models\Donacion;
use App\Models\SolicitudAdopcion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FundacionController extends Controller
{
    /**
     * Muestra el perfil de la fundación del usuario autenticado
     */
    public function perfil()
    {
        $fundacion = PerfilFundacion::firstOrCreate(
            ['usuario_id' => Auth::id()],
            [
                'nombre' => 'Fundación ' . Auth::user()->name,
                'descripcion' => 'Descripción de la fundación',
                'direccion' => 'Dirección no especificada',
                'telefono' => 'Sin teléfono',
                'email' => Auth::user()->email,
            ]
        );
        
        return view('fundacion.perfil.perfil', compact('fundacion'));
    }

    /**
     * Actualiza el perfil de la fundación
     */
    public function actualizarPerfil(Request $request)
    {
        $request->validate([
            // Información básica
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'email' => 'required|email',
            'sitio_web' => 'nullable|url',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
            // Información bancaria
            'banco_nombre' => 'required|string|max:255',
            'tipo_cuenta' => 'required|in:ahorros,corriente',
            'numero_cuenta' => 'required|string|max:50',
            'nombre_titular' => 'required|string|max:255',
            'identificacion_titular' => 'required|string|max:50',
            'email_contacto_pagos' => 'nullable|email',
            'otros_metodos_pago' => 'nullable|string',
            
            // Ubicación
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $data = $request->only([
                    'nombre', 'descripcion', 'direccion', 
                    'telefono', 'email', 'sitio_web', 
                    'facebook', 'instagram', 'latitud', 'longitud',
                    // Campos bancarios
                    'banco_nombre', 'tipo_cuenta', 'numero_cuenta',
                    'nombre_titular', 'identificacion_titular',
                    'email_contacto_pagos', 'otros_metodos_pago'
                ]);
                
                // Limpiar URLs de redes sociales si están vacías
                $data['facebook'] = $data['facebook'] ? 'https://facebook.com/' . ltrim(parse_url($data['facebook'], PHP_URL_PATH), '/') : null;
                $data['instagram'] = $data['instagram'] ? 'https://instagram.com/' . ltrim(parse_url($data['instagram'], PHP_URL_PATH), '/') : null;
                
                $fundacion = PerfilFundacion::updateOrCreate(
                    ['usuario_id' => Auth::id()],
                    $data
                );

                if ($request->hasFile('imagen')) {
                    $this->actualizarImagenPerfil($fundacion, $request->file('imagen'));
                }
            });

            return redirect()->route('fundacion.perfil')
                ->with('success', 'Perfil actualizado exitosamente');
                
        } catch (\Exception $e) {
            Log::error('Error al actualizar perfil: ' . $e->getMessage() . ' - ' . $e->getTraceAsString());
            return back()->with('error', 'Error al actualizar el perfil. Por favor, intente nuevamente.');
        }
    }

    /**
     * Muestra el formulario para editar el perfil
     */
    public function editarPerfil()
    {
        $fundacion = PerfilFundacion::firstOrCreate(
            ['usuario_id' => Auth::id()],
            [
                'nombre' => 'Fundación ' . Auth::user()->name,
                'descripcion' => 'Descripción de la fundación',
                'direccion' => 'Dirección no especificada',
                'telefono' => 'Sin teléfono',
                'email' => Auth::user()->email,
            ]
        );
        
        return view('fundacion.perfil.perfil-editar', compact('fundacion'));
    }

    /**
     * Muestra el listado de animales de la fundación
     */
    public function animales(Request $request)
    {
        $fundacion = PerfilFundacion::where('usuario_id', Auth::id())->firstOrFail();
        
        $animales = Animal::where('fundacion_id', $fundacion->usuario_id)
            ->when($request->has('estado'), function ($query) use ($request) {
                $query->where('estado', $request->estado);
            })
            ->withCount('solicitudesAdopcion')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();
                         
        return view('fundacion.animales.index', compact('animales', 'fundacion'));
    }

    /**
     * Muestra el formulario para crear un nuevo animal
     */
    public function crearAnimal()
    {
        return view('fundacion.animales.create');
    }

    /**
     * Almacena un nuevo animal en la base de datos
     */
    public function guardarAnimal(Request $request)
    {
        // Validar los campos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string',
            'edad' => 'required|integer|min:0',
            'tipo_edad' => 'required|in:meses,años,anios',
            'sexo' => 'required|string|in:macho,hembra',
            'descripcion' => 'required|string',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
            'direccion' => 'required|string|max:500'
        ]);

        try {
            // Obtener la fundación del usuario autenticado
            $fundacion = PerfilFundacion::where('usuario_id', Auth::id())->first();
            
            if (!$fundacion) {
                return back()->withInput()->with('error', 'No se encontró el perfil de la fundación. Por favor, complete su perfil primero.');
            }
            
            // Manejar la carga de la imagen primero
            $imagenPath = null;
            if ($request->hasFile('imagen')) {
                try {
                    $imagenPath = $this->guardarImagen($request->file('imagen'), 'animales');
                } catch (\Exception $e) {
                    Log::error('Error al guardar la imagen: ' . $e->getMessage());
                    return back()->withInput()->with('error', 'Error al procesar la imagen: ' . $e->getMessage());
                }
            }
            
            // Crear el animal usando mass assignment
            $animalData = [
                'nombre' => $request->nombre,
                'tipo' => $request->tipo,
                'edad' => $request->edad,
                'tipo_edad' => $request->tipo_edad,
                'sexo' => $request->sexo,
                'descripcion' => $request->descripcion,
                'latitud' => $request->latitud,
                'longitud' => $request->longitud,
                'direccion' => $request->direccion,
                'fundacion_id' => $fundacion->usuario_id,
                'estado' => 'disponible',
                'fecha_ingreso' => now(),
                'imagen' => $imagenPath
            ];
            
            $animal = Animal::create($animalData);

            return redirect()->route('fundacion.animales')
                ->with('success', 'Animal agregado exitosamente');
            
        } catch (\Exception $e) {
            Log::error('Error al guardar animal: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'input' => $request->except(['imagen'])
            ]);
            
            // Si hay una imagen guardada y falló el guardado, eliminarla
            if (isset($imagenPath) && $imagenPath && file_exists(public_path($imagenPath))) {
                unlink(public_path($imagenPath));
            }
            
            return back()->withInput()->with('error', 'Error al guardar el animal: ' . $e->getMessage());
        }
    }

    /**
     * Muestra el listado de donaciones recibidas
     */
    public function donaciones()
    {
        $donaciones = Donacion::where('fundacion_id', Auth::id())
            ->with('usuario')
            ->latest()
            ->paginate(10);
            
        return view('fundacion.donaciones.index', compact('donaciones'));
    }

    /**
     * Muestra las solicitudes de adopción
     */
    public function solicitudesAdopcion()
    {
        $solicitudes = SolicitudAdopcion::where('fundacion_id', Auth::id())
            ->with(['usuario', 'animal'])
            ->latest()
            ->paginate(10);
            
        return view('fundacion.solicitudes.index', compact('solicitudes'));
    }

    /**
     * Actualiza el estado de una solicitud de adopción
     */
    public function actualizarSolicitud(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,aceptado,rechazado',
            'respuesta' => 'required_if:estado,aceptado,rechazado|string'
        ]);

        try {
            $solicitud = SolicitudAdopcion::where('id', $id)
                ->where('fundacion_id', Auth::id())
                ->firstOrFail();
                
            $solicitud->update($request->only(['estado', 'respuesta']));

            return redirect()->route('fundacion.solicitudes')
                ->with('success', 'Solicitud actualizada');
                
        } catch (\Exception $e) {
            Log::error('Error al actualizar solicitud: ' . $e->getMessage());
            return back()->with('error', 'Error al actualizar la solicitud');
        }
    }
    
    /**
     * Cambia el estado de una solicitud de adopción
     * 
     * @param int $id ID de la solicitud
     * @param string $estado Nuevo estado (pendiente, en_revision, aprobada, rechazada)
     * @return \Illuminate\Http\Response
     */
    public function cambiarEstadoSolicitud($id, $estado)
    {
        try {
            // Validar que el estado sea válido
            if (!in_array($estado, ['pendiente', 'en_revision', 'aprobada', 'rechazada'])) {
                return back()->with('error', 'Estado no válido');
            }
            
            // Buscar la solicitud
            $solicitud = SolicitudAdopcion::where('id', $id)
                ->where('fundacion_id', Auth::id())
                ->firstOrFail();
                
            // Actualizar el estado
            $solicitud->estado = $estado;
            $solicitud->save();
            
            // Mensaje de éxito
            $mensajes = [
                'pendiente' => 'Solicitud marcada como pendiente',
                'en_revision' => 'Solicitud puesta en revisión',
                'aprobada' => '¡Solicitud aprobada exitosamente!',
                'rechazada' => 'Solicitud rechazada'
            ];
            
            return back()->with('success', $mensajes[$estado] ?? 'Estado actualizado');
            
        } catch (\Exception $e) {
            Log::error('Error al cambiar estado de solicitud: ' . $e->getMessage());
            return back()->with('error', 'Error al actualizar el estado de la solicitud');
        }
    }

    /**
     * Muestra el detalle de una solicitud
     */
    public function detalleSolicitud($id)
    {
        $solicitud = SolicitudAdopcion::with(['usuario', 'animal', 'fundacion'])
            ->where('fundacion_id', Auth::id())
            ->findOrFail($id);
            
        return view('fundacion.solicitudes.detalle', compact('solicitud'));
    }

    /**
     * Marca un animal como adoptado
     */
    public function marcarComoAdoptado($id)
    {
        try {
            $animal = Animal::where('id', $id)
                ->where('fundacion_id', Auth::id())
                ->firstOrFail();
                
            $animal->update(['estado' => 'adoptado']);

            return back()->with('success', 'Animal marcado como adoptado');
            
        } catch (\Exception $e) {
            Log::error('Error al marcar como adoptado: ' . $e->getMessage());
            return back()->with('error', 'Error al actualizar el estado');
        }
    }

    /**
     * Muestra el formulario para editar un animal
     */
    public function editarAnimal($id)
    {
        $animal = Animal::where('id', $id)
            ->where('fundacion_id', Auth::id())
            ->firstOrFail();
            
        return view('fundacion.animales.edit', compact('animal'));
    }

    /**
     * Actualiza los datos de un animal
     */
    public function actualizarAnimal(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string',
            'edad' => 'required|integer|min:0',
            'tipo_edad' => 'required|in:meses,años,anios',
            'sexo' => 'required|string',
            'descripcion' => 'required|string',
            'estado' => 'required|in:disponible,adoptado,en_adopcion',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $animal = Animal::where('id', $id)
                ->where('fundacion_id', Auth::id())
                ->firstOrFail();

            $animal->update($request->only([
                'nombre', 'tipo', 'edad', 'tipo_edad', 
                'sexo', 'descripcion', 'estado',
                'direccion', 'latitud', 'longitud'
            ]));

            if ($request->hasFile('imagen')) {
                // Eliminar imagen anterior si existe
                if ($animal->imagen && file_exists(public_path($animal->imagen))) {
                    unlink(public_path($animal->imagen));
                }
                $animal->imagen = $this->guardarImagen($request->file('imagen'), 'animales');
                $animal->save();
            }

            return redirect()->route('fundacion.animales')
                ->with('success', 'Animal actualizado exitosamente');
                
        } catch (\Exception $e) {
            Log::error('Error al actualizar animal: ' . $e->getMessage());
            return back()->with('error', 'Error al actualizar el animal');
        }
    }

    /**
     * Elimina un animal y sus relaciones
     */
    public function eliminarAnimal($id)
    {
        try {
            return DB::transaction(function () use ($id) {
                $animal = Animal::where('id', $id)
                    ->where('fundacion_id', Auth::id())
                    ->with(['solicitudesAdopcion', 'donaciones'])
                    ->firstOrFail();

                // Eliminar documentos de solicitudes
                $animal->solicitudesAdopcion->each(function ($solicitud) {
                    if ($solicitud->documentos) {
                        $documentos = json_decode($solicitud->documentos, true);
                        collect($documentos)->each(function ($doc) {
                            Storage::disk('public')->delete($doc['ruta']);
                        });
                    }
                });

                // Eliminar relaciones
                $animal->solicitudesAdopcion()->delete();
                $animal->donaciones()->delete();

                // Eliminar imagen
                if ($animal->imagen && file_exists(public_path($animal->imagen))) {
                    unlink(public_path($animal->imagen));
                }

                $animal->delete();

                return redirect()->route('fundacion.animales')
                    ->with('success', 'Animal eliminado correctamente');
            });
            
        } catch (\Exception $e) {
            Log::error('Error al eliminar animal: ' . $e->getMessage());
            return back()->with('error', 'Error al eliminar el animal');
        }
    }

    /**
     * Muestra el panel de control
     */
    public function panel()
    {
        $fundacion = PerfilFundacion::where('usuario_id', Auth::id())->first();
        
        // Check if the fundación exists
        if (!$fundacion) {
            // Redirect to profile setup or show an error
            return redirect()->route('fundacion.perfil.editar')
                ->with('error', 'Por favor complete el perfil de su fundación antes de continuar.');
        }
        
        $estadisticas = [
            'animales' => Animal::where('fundacion_id', $fundacion->usuario_id)->count(),
            'disponibles' => Animal::where('fundacion_id', $fundacion->usuario_id)
                ->where('estado', 'disponible')->count(),
            'solicitudes' => SolicitudAdopcion::where('fundacion_id', $fundacion->usuario_id)->count(),
            'donaciones' => Donacion::where('fundacion_id', $fundacion->usuario_id)->sum('monto')
        ];
        
        return view('fundacion.panel', compact('estadisticas', 'fundacion'));
    }

    /**
     * Muestra el listado público de fundaciones
     */
    public function publico()
    {
        $fundaciones = PerfilFundacion::with('usuario')
            ->withCount([
                'animales' => fn($query) => $query->where('estado', 'disponible'),
                'donaciones'
            ])
            ->paginate(6);
            
        return view('fundacion.publico', compact('fundaciones'));
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
            
            // Retornar la ruta relativa usando barras normales para URLs
            return 'img/' . $directorio . '/' . $nombreArchivo;
            
        } catch (\Exception $e) {
            Log::error('Error en guardarImagen: ' . $e->getMessage(), [
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

    /**
     * Actualiza la imagen del perfil
     */
    protected function actualizarImagenPerfil($fundacion, $imagen)
    {
        // Eliminar la imagen anterior si existe
        if ($fundacion->imagen && file_exists(public_path($fundacion->imagen))) {
            unlink(public_path($fundacion->imagen));
        }
        
        // Guardar la nueva imagen en public/img/fundaciones
        $nombreArchivo = 'fundacion_' . time() . '.' . $imagen->getClientOriginalExtension();
        $rutaCarpeta = public_path('img/fundaciones');
        
        // Crear el directorio si no existe
        if (!File::exists($rutaCarpeta)) {
            File::makeDirectory($rutaCarpeta, 0755, true, true);
        }
        
        // Mover la imagen a la carpeta de destino
        $imagen->move($rutaCarpeta, $nombreArchivo);
        
        // Guardar la ruta relativa en la base de datos
        $rutaRelativa = 'img/fundaciones/' . $nombreArchivo;
        $fundacion->imagen = $rutaRelativa;
        $fundacion->save();
    }
}