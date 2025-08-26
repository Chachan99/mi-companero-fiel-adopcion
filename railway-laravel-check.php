<?php

/**
 * Verificación específica de Laravel en Railway
 * Ejecutar con: php railway-laravel-check.php
 */

echo "=== VERIFICACIÓN LARAVEL EN RAILWAY ===\n\n";

// 1. Verificar estructura de archivos críticos
echo "1. ARCHIVOS CRÍTICOS:\n";
$critical_files = [
    'artisan' => 'Comando artisan de Laravel',
    'composer.json' => 'Configuración de dependencias',
    'config/app.php' => 'Configuración principal',
    'config/database.php' => 'Configuración de base de datos',
    '.env.example' => 'Plantilla de variables de entorno',
    'Procfile' => 'Configuración de Railway',
    'nixpacks.toml' => 'Configuración de build'
];

foreach ($critical_files as $file => $description) {
    $exists = file_exists($file);
    $status = $exists ? '✅' : '❌';
    echo "   {$status} {$file} - {$description}\n";
}

// 2. Verificar configuración de base de datos
echo "\n2. CONFIGURACIÓN DE BASE DE DATOS:\n";
if (file_exists('config/database.php')) {
    $config = include 'config/database.php';
    $default_connection = $config['default'] ?? 'No definida';
    echo "   ✅ Conexión por defecto: {$default_connection}\n";
    
    if (isset($config['connections']['pgsql'])) {
        echo "   ✅ Configuración PostgreSQL encontrada\n";
        $pgsql_config = $config['connections']['pgsql'];
        echo "   - Driver: " . ($pgsql_config['driver'] ?? 'No definido') . "\n";
        echo "   - Host: " . ($pgsql_config['host'] ?? 'No definido') . "\n";
        echo "   - Puerto: " . ($pgsql_config['port'] ?? 'No definido') . "\n";
    } else {
        echo "   ❌ Configuración PostgreSQL no encontrada\n";
    }
} else {
    echo "   ❌ Archivo config/database.php no encontrado\n";
}

// 3. Verificar variables de entorno críticas
echo "\n3. VARIABLES DE ENTORNO CRÍTICAS:\n";
$required_env = [
    'APP_KEY' => 'Clave de encriptación de Laravel',
    'APP_ENV' => 'Entorno de la aplicación',
    'APP_DEBUG' => 'Modo debug',
    'DB_CONNECTION' => 'Tipo de conexión de BD',
    'DB_HOST' => 'Host de la base de datos',
    'DB_PORT' => 'Puerto de la base de datos',
    'DB_DATABASE' => 'Nombre de la base de datos',
    'DB_USERNAME' => 'Usuario de la base de datos',
    'DB_PASSWORD' => 'Contraseña de la base de datos'
];

foreach ($required_env as $var => $description) {
    $value = $_ENV[$var] ?? getenv($var) ?? null;
    $status = $value ? '✅' : '❌';
    $display_value = $value;
    
    if (strpos($var, 'PASSWORD') !== false || strpos($var, 'KEY') !== false) {
        $display_value = $value ? '[CONFIGURADA]' : '[NO CONFIGURADA]';
    }
    
    echo "   {$status} {$var}: {$display_value} - {$description}\n";
}

// 4. Verificar extensiones PHP necesarias
echo "\n4. EXTENSIONES PHP:\n";
$required_extensions = [
    'pdo' => 'PDO para base de datos',
    'pdo_pgsql' => 'Driver PostgreSQL',
    'openssl' => 'Encriptación SSL',
    'mbstring' => 'Manejo de strings multibyte',
    'tokenizer' => 'Tokenizer para Laravel',
    'xml' => 'Procesamiento XML',
    'ctype' => 'Verificación de tipos de caracteres',
    'json' => 'Procesamiento JSON',
    'bcmath' => 'Matemáticas de precisión arbitraria'
];

foreach ($required_extensions as $ext => $description) {
    $loaded = extension_loaded($ext);
    $status = $loaded ? '✅' : '❌';
    echo "   {$status} {$ext} - {$description}\n";
}

// 5. Verificar permisos de directorios
echo "\n5. PERMISOS DE DIRECTORIOS:\n";
$directories = [
    'storage' => 'Directorio de almacenamiento',
    'storage/logs' => 'Logs de la aplicación',
    'storage/framework' => 'Cache del framework',
    'storage/framework/cache' => 'Cache de datos',
    'storage/framework/sessions' => 'Sesiones',
    'storage/framework/views' => 'Vistas compiladas',
    'bootstrap/cache' => 'Cache de bootstrap'
];

foreach ($directories as $dir => $description) {
    if (is_dir($dir)) {
        $writable = is_writable($dir);
        $status = $writable ? '✅' : '❌';
        echo "   {$status} {$dir} - {$description}\n";
    } else {
        echo "   ❌ {$dir} - Directorio no existe\n";
    }
}

// 6. Test de conexión rápida
echo "\n6. TEST DE CONEXIÓN RÁPIDA:\n";
try {
    $host = $_ENV['DB_HOST'] ?? getenv('DB_HOST');
    $port = $_ENV['DB_PORT'] ?? getenv('DB_PORT') ?? '5432';
    
    if ($host) {
        echo "   Probando conexión a {$host}:{$port}...\n";
        
        $start = microtime(true);
        $connection = @fsockopen($host, $port, $errno, $errstr, 5);
        $time = round((microtime(true) - $start) * 1000, 2);
        
        if ($connection) {
            echo "   ✅ Puerto accesible en {$time}ms\n";
            fclose($connection);
        } else {
            echo "   ❌ No se puede conectar: {$errstr} (código: {$errno})\n";
        }
    } else {
        echo "   ❌ DB_HOST no configurado\n";
    }
} catch (Exception $e) {
    echo "   ❌ Error en test de conexión: " . $e->getMessage() . "\n";
}

echo "\n=== RECOMENDACIONES ===\n";
echo "1. Asegúrate de usar RAILWAY_PRIVATE_DOMAIN para DB_HOST\n";
echo "2. Verifica que todas las variables de entorno estén configuradas\n";
echo "3. Ejecuta 'php artisan migrate' después de la conexión exitosa\n";
echo "4. Revisa los logs en Railway para errores específicos\n";

echo "\n=== FIN DE VERIFICACIÓN ===\n";