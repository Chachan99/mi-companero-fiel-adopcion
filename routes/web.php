<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicoController;
use App\Http\Controllers\AdopcionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AnimalController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [PublicoController::class, 'index'])->name('home');

// Rutas públicas
Route::get('/', [PublicoController::class, 'index'])->name('publico.index');

// Ruta para listar todos los animales disponibles para adopción
Route::get('/animales', [PublicoController::class, 'animales'])->name('publico.animales');

// Rutas de animales perdidos
Route::get('/animales-perdidos', [App\Http\Controllers\AnimalPerdidoController::class, 'index'])->name('animales-perdidos.index');
Route::get('/animales-perdidos/crear', [App\Http\Controllers\AnimalPerdidoController::class, 'create'])->name('animales-perdidos.create');
Route::post('/animales-perdidos', [App\Http\Controllers\AnimalPerdidoController::class, 'store'])->name('animales-perdidos.store');
Route::get('/animales-perdidos/{id}', [App\Http\Controllers\AnimalPerdidoController::class, 'show'])->name('animales-perdidos.show');
Route::post('/animales-perdidos/{id}/encontrado', [App\Http\Controllers\AnimalPerdidoController::class, 'marcarComoEncontrado'])
    ->name('animales-perdidos.marcar-encontrado');
Route::get('/animal/{id}', [PublicoController::class, 'animal'])->name('publico.animal');
Route::get('/fundacion/{id}', [PublicoController::class, 'fundacion'])->name('publico.fundacion');
Route::get('/fundaciones', [PublicoController::class, 'fundaciones'])->name('publico.fundaciones');
Route::get('/donaciones', [PublicoController::class, 'donaciones'])->name('publico.donaciones');

// Ruta para la página de información para adoptantes primerizos
Route::get('/informacion-adopcion', [PublicoController::class, 'informacionAdopcion'])->name('publico.informacion');
Route::get('/informate', [PublicoController::class, 'informate'])->name('publico.informate');
// Rutas de noticias
Route::get('/noticias', [App\Http\Controllers\NoticiaController::class, 'publicIndex'])->name('noticias.index');
Route::get('/noticias/{noticia}', [App\Http\Controllers\NoticiaController::class, 'show'])->name('noticias.show');
Route::post('/donar', [PublicoController::class, 'donar'])->name('publico.donar');
Route::get('/nosotros', function () {
    return view('publico.nosotros');
})->name('publico.nosotros');
// Ruta para manejar la búsqueda (unificada)
Route::get('/buscar', [PublicoController::class, 'buscar'])->name('publico.buscar');

// Ruta para el formulario de contacto
Route::get('/contacto', [PublicoController::class, 'contacto'])->name('publico.contacto');
Route::post('/contactar', [PublicoController::class, 'contactar'])->name('publico.contactar');

// Ruta para manejar favoritos
Route::post('/favorito', [PublicoController::class, 'toggleFavorito'])->name('publico.favorito');

// Rutas de diagnóstico para Railway
Route::get('/railway-debug', function () {
    try {
        ob_start();
        include base_path('railway-debug.php');
        $content = ob_get_clean();
        return response($content)->header('Content-Type', 'text/html');
    } catch (Exception $e) {
        return response('<h1>Error al cargar railway-debug.php</h1><p>' . $e->getMessage() . '</p>', 500);
    }
});

Route::get('/test-db-connection', function () {
    try {
        ob_start();
        include base_path('test-db-connection.php');
        $content = ob_get_clean();
        return response($content)->header('Content-Type', 'text/html');
    } catch (Exception $e) {
        return response('<h1>Error al cargar test-db-connection.php</h1><p>' . $e->getMessage() . '</p>', 500);
    }
});

Route::get('/railway-laravel-check', function () {
    try {
        ob_start();
        include base_path('railway-laravel-check.php');
        $content = ob_get_clean();
        return response($content)->header('Content-Type', 'text/html');
    } catch (Exception $e) {
        return response('<h1>Error al cargar railway-laravel-check.php</h1><p>' . $e->getMessage() . '</p>', 500);
    }
});

// Ruta de diagnóstico simple integrada
Route::get('/railway-status', function () {
    $html = '<html><head><title>Estado de Railway</title><style>body{font-family:Arial,sans-serif;margin:40px;} .success{color:green;} .error{color:red;} .warning{color:orange;}</style></head><body>';
    $html .= '<h1>🚂 Estado de Railway - Laravel</h1>';
    
    // Verificar variables de entorno
    $html .= '<h2>Variables de Entorno:</h2><ul>';
    $vars = ['APP_KEY', 'APP_ENV', 'DB_CONNECTION', 'DB_HOST', 'DB_PORT', 'DB_DATABASE', 'DB_USERNAME'];
    foreach ($vars as $var) {
        $value = env($var, 'NO DEFINIDA');
        $class = $value !== 'NO DEFINIDA' ? 'success' : 'error';
        $display = $var === 'DB_PASSWORD' ? '[OCULTA]' : $value;
        $html .= "<li class='{$class}'>{$var}: {$display}</li>";
    }
    $html .= '</ul>';
    
    // Test de conexión a base de datos
    $html .= '<h2>Conexión a Base de Datos:</h2>';
    try {
        \DB::connection()->getPdo();
        $html .= '<p class="success">✅ Conexión exitosa a la base de datos</p>';
        
        // Verificar tablas
        $tables = \DB::select('SELECT table_name FROM information_schema.tables WHERE table_schema = \'public\'');
        $html .= '<p class="success">✅ Tablas encontradas: ' . count($tables) . '</p>';
    } catch (Exception $e) {
        $html .= '<p class="error">❌ Error de conexión: ' . $e->getMessage() . '</p>';
    }
    
    $html .= '<h2>Información del Sistema:</h2><ul>';
    $html .= '<li>PHP Version: ' . PHP_VERSION . '</li>';
    $html .= '<li>Laravel Version: ' . app()->version() . '</li>';
    $html .= '<li>Environment: ' . app()->environment() . '</li>';
    $html .= '<li>Timezone: ' . config('app.timezone') . '</li>';
    $html .= '</ul>';
    
    $html .= '<p><small>Generado: ' . now() . '</small></p>';
    $html .= '</body></html>';
    
    return response($html)->header('Content-Type', 'text/html');
});

// Ruta temporal para depuración de información bancaria
Route::get('/debug/bank-info', function() {
    // Mostrar todas las fundaciones con su información bancaria
    $fundaciones = \App\Models\PerfilFundacion::all();
    
    $result = [];
    foreach ($fundaciones as $fundacion) {
        $result[] = [
            'id' => $fundacion->id,
            'nombre' => $fundacion->nombre,
            'banco_nombre' => $fundacion->banco_nombre,
            'tipo_cuenta' => $fundacion->tipo_cuenta,
            'numero_cuenta' => $fundacion->numero_cuenta,
            'nombre_titular' => $fundacion->nombre_titular,
            'tipo_identificacion' => $fundacion->tipo_identificacion,
            'identificacion_titular' => $fundacion->identificacion_titular,
            'email_contacto_pagos' => $fundacion->email_contacto_pagos,
            'otros_metodos_pago' => $fundacion->otros_metodos_pago,
            'has_bank_info' => !empty($fundacion->banco_nombre) || !empty($fundacion->tipo_cuenta) || 
                              !empty($fundacion->numero_cuenta) || !empty($fundacion->nombre_titular)
        ];
    }
    
    // Mostrar también la consulta SQL que se está ejecutando
    $query = \App\Models\PerfilFundacion::with('usuario')
        ->where(function($query) {
            $query->where(function($q) {
                $q->whereNotNull('banco_nombre')
                  ->where('banco_nombre', '!=', '');
            })->orWhere(function($q) {
                $q->whereNotNull('nombre_titular')
                  ->where('nombre_titular', '!=', '');
            });
        })
        ->toSql();
    
    return response()->json([
        'query' => $query,
        'fundaciones' => $result
    ]);
})->name('debug.bank-info');

// Ruta de prueba para verificar el modelo Noticia
Route::get('/test-noticias', [TestController::class])->name('test.noticias');

// Rutas de adopción
Route::get('/adopcion/{animalId}', [AdopcionController::class, 'showForm'])->name('adopcion.form');
Route::post('/adopcion', [AdopcionController::class, 'store'])->name('adopcion.store');

Route::middleware('auth')->group(function () {
    \Log::info('Definiendo rutas de admin');
    Route::get('/prueba-log', function() { return 'Log de grupo admin OK'; });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/prueba-gate', function() { return 'OK prueba-gate'; });
    
    // Rutas de administración
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
    // Filtrar donaciones por fundación
    Route::get('/donaciones/filtrar', [\App\Http\Controllers\AdminController::class, 'filtrarDonaciones'])->name('donaciones.filtrar');
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/prueba', function() { return 'OK admin'; });
        Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('usuarios');
        Route::patch('/usuarios/{id}/rol', [AdminController::class, 'actualizarRol'])->name('usuarios.rol');
        Route::get('/animales', [AdminController::class, 'animales'])->name('animales');
        Route::get('/solicitudes', [AdopcionController::class, 'gestionar'])->name('solicitudes');
        Route::patch('/solicitudes/{id}/{estado}', [AdopcionController::class, 'cambiarEstado'])->name('solicitudes.estado');
        // Temporary debug route for bank info
        Route::get('/debug/bank-info', function() {
            $fundaciones = \App\Models\PerfilFundacion::all();
            
            $result = [];
            foreach ($fundaciones as $fundacion) {
                $result[] = [
                    'id' => $fundacion->id,
                    'nombre' => $fundacion->nombre,
                    'banco_nombre' => $fundacion->banco_nombre,
                    'tipo_cuenta' => $fundacion->tipo_cuenta,
                    'numero_cuenta' => $fundacion->numero_cuenta,
                    'nombre_titular' => $fundacion->nombre_titular,
                    'has_bank_info' => !empty($fundacion->banco_nombre) || !empty($fundacion->tipo_cuenta) || 
                                      !empty($fundacion->numero_cuenta) || !empty($fundacion->nombre_titular)
                ];
            }
            
            return response()->json($result);
        });
        Route::get('/donaciones', [PublicoController::class, 'donaciones'])->name('donaciones');
        Route::get('/reportes', [AdminController::class, 'reportes'])->name('reportes');
        // Gestión de mascotas perdidas
        Route::get('/mascotas-perdidas', [AdminController::class, 'mascotasPerdidas'])->name('mascotas-perdidas');
        // CRUD de usuarios
        Route::get('/usuarios/crear', [AdminController::class, 'crearUsuario'])->name('usuarios.crear');
        Route::post('/usuarios', [AdminController::class, 'guardarUsuario'])->name('usuarios.guardar');
        Route::get('/usuarios/{id}/editar', [AdminController::class, 'editarUsuario'])->name('usuarios.editar');
        Route::put('/usuarios/{id}', [AdminController::class, 'actualizarUsuario'])->name('usuarios.actualizar');
        Route::delete('/usuarios/{id}', [AdminController::class, 'eliminarUsuario'])->name('usuarios.eliminar');
        
        // Funcionalidades avanzadas de usuarios
        Route::get('/usuarios/exportar', [AdminController::class, 'exportarUsuarios'])->name('usuarios.exportar');
        Route::post('/usuarios/acciones-lote', [AdminController::class, 'accionesLoteUsuarios'])->name('usuarios.acciones-lote');
        Route::get('/usuarios/estadisticas', [AdminController::class, 'estadisticasUsuarios'])->name('usuarios.estadisticas');
        // CRUD de animales
        Route::get('/animales/crear', [AdminController::class, 'crearAnimal'])->name('animales.crear');
        Route::post('/animales', [AdminController::class, 'guardarAnimal'])->name('animales.guardar');
        Route::get('/animales/{id}/editar', [AdminController::class, 'editarAnimal'])->name('animales.editar');
        Route::put('/animales/{id}', [AdminController::class, 'actualizarAnimal'])->name('animales.actualizar');
        Route::delete('/animales/{id}', [AdminController::class, 'eliminarAnimal'])->name('animales.eliminar');
    // Panel de administración
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');

    // Fundaciones (listado para admin)
    Route::get('/fundaciones', [\App\Http\Controllers\AdminController::class, 'fundaciones'])->name('fundaciones');

    // Rutas de administración de noticias
    Route::resource('noticias', \App\Http\Controllers\NoticiaController::class)->except(['show']);
    Route::post('noticias/{noticia}/estado', [\App\Http\Controllers\NoticiaController::class, 'cambiarEstado'])->name('noticias.cambiar-estado');
    });
    
    // Redirección de dashboard según rol
    Route::get('/dashboard', function () {
        if (Auth::user()->rol === 'fundacion') {
            return redirect()->route('fundacion.panel');
        } elseif (Auth::user()->rol === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
});

require __DIR__.'/auth.php';

// Test routes (temporary)
require __DIR__.'/test.php';
require __DIR__.'/db-check.php';

// Rutas de perfil público
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil/editar', [\App\Http\Controllers\ProfileController::class, 'editPublico'])->name('profile.edit-publico');
    Route::put('/perfil/editar', [\App\Http\Controllers\ProfileController::class, 'updatePublico'])->name('profile.update-publico');
});

// Rutas del panel de fundación
// News management routes for foundations
Route::name('fundacion.noticias.')
    ->prefix('panel-fundacion/noticias')
    ->middleware(['auth', 'role:fundacion'])
    ->group(function () {
        Route::get('/', [\App\Http\Controllers\Fundacion\NoticiaController::class, 'index'])->name('index');
        Route::get('/crear', [\App\Http\Controllers\Fundacion\NoticiaController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Fundacion\NoticiaController::class, 'store'])->name('store');
        Route::get('/{noticia}/editar', [\App\Http\Controllers\Fundacion\NoticiaController::class, 'edit'])->name('edit');
        Route::put('/{noticia}', [\App\Http\Controllers\Fundacion\NoticiaController::class, 'update'])->name('update');
        Route::delete('/{noticia}', [\App\Http\Controllers\Fundacion\NoticiaController::class, 'destroy'])->name('destroy');
    });

Route::prefix('panel-fundacion')
    ->name('fundacion.')
    ->middleware(['auth', 'role:fundacion'])
    ->group(function () {
        // Panel principal
        Route::get('/panel', [\App\Http\Controllers\FundacionController::class, 'panel'])->name('panel');
        
        // Perfil de la fundación
        Route::get('/perfil', [\App\Http\Controllers\FundacionController::class, 'perfil'])->name('perfil');
        Route::get('/perfil/editar', [\App\Http\Controllers\FundacionController::class, 'editarPerfil'])->name('perfil.editar');
        Route::post('/perfil/actualizar', [\App\Http\Controllers\FundacionController::class, 'actualizarPerfil'])->name('perfil.actualizar');
        
        // Gestión de animales
        Route::get('/animales', [\App\Http\Controllers\FundacionController::class, 'animales'])->name('animales');
        Route::get('/animales/crear', [\App\Http\Controllers\FundacionController::class, 'crearAnimal'])->name('animales.crear');
        Route::post('/animales', [\App\Http\Controllers\FundacionController::class, 'guardarAnimal'])->name('animales.guardar');
        Route::get('/animales/{id}/editar', [\App\Http\Controllers\FundacionController::class, 'editarAnimal'])->name('animales.editar');
        Route::put('/animales/{id}', [\App\Http\Controllers\FundacionController::class, 'actualizarAnimal'])->name('animales.actualizar');
        Route::delete('/animales/{id}', [\App\Http\Controllers\FundacionController::class, 'eliminarAnimal'])->name('animales.eliminar');
        Route::patch('/animales/{id}/adoptado', [\App\Http\Controllers\FundacionController::class, 'marcarComoAdoptado'])->name('animales.adoptado');
        
        // Gestión de donaciones
        Route::get('/donaciones', [\App\Http\Controllers\FundacionController::class, 'donaciones'])->name('donaciones');
        
        // Gestión de solicitudes
        Route::get('/solicitudes', [AdopcionController::class, 'solicitudesFundacion'])->name('solicitudes');
        Route::get('/solicitudes/{id}', [\App\Http\Controllers\FundacionController::class, 'detalleSolicitud'])->name('solicitudes.detalle');
        Route::patch('/solicitudes/{id}/estado/{estado}', [\App\Http\Controllers\FundacionController::class, 'cambiarEstadoSolicitud'])->name('solicitudes.estado');
        Route::patch('/solicitudes/{id}/aceptar', [\App\Http\Controllers\FundacionController::class, 'aceptarSolicitud'])->name('solicitudes.aceptar');
        Route::patch('/solicitudes/{id}/rechazar', [\App\Http\Controllers\FundacionController::class, 'rechazarSolicitud'])->name('solicitudes.rechazar');
        
        // Ruta pública de la fundación
        Route::get('/publico', [\App\Http\Controllers\FundacionController::class, 'publico'])->name('publico');
        
        // Rutas de prueba (puedes eliminarlas en producción)
        Route::get('/prueba', function() { return 'Ruta de prueba fundación'; });
    });
