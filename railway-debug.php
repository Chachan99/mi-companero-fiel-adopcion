<?php

/**
 * Script de diagnóstico para Railway
 * Ejecutar con: php railway-debug.php
 */

echo "=== DIAGNÓSTICO DE CONFIGURACIÓN RAILWAY ===\n\n";

// Verificar variables de entorno críticas
echo "1. VARIABLES DE ENTORNO:\n";
$required_vars = [
    'APP_KEY',
    'APP_ENV',
    'DB_CONNECTION',
    'DB_HOST',
    'DB_PORT',
    'DB_DATABASE',
    'DB_USERNAME',
    'DB_PASSWORD'
];

foreach ($required_vars as $var) {
    $value = getenv($var) ?: $_ENV[$var] ?? 'NO DEFINIDA';
    $status = $value !== 'NO DEFINIDA' ? '✅' : '❌';
    echo "   {$status} {$var}: " . ($var === 'DB_PASSWORD' ? '[OCULTA]' : $value) . "\n";
}

echo "\n2. CONFIGURACIÓN DE BASE DE DATOS:\n";
try {
    // Intentar conexión a la base de datos
    $host = getenv('DB_HOST') ?: $_ENV['DB_HOST'] ?? 'localhost';
    $port = getenv('DB_PORT') ?: $_ENV['DB_PORT'] ?? '5432';
    $database = getenv('DB_DATABASE') ?: $_ENV['DB_DATABASE'] ?? 'laravel';
    $username = getenv('DB_USERNAME') ?: $_ENV['DB_USERNAME'] ?? 'root';
    $password = getenv('DB_PASSWORD') ?: $_ENV['DB_PASSWORD'] ?? '';
    
    $dsn = "pgsql:host={$host};port={$port};dbname={$database}";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    
    echo "   ✅ Conexión a PostgreSQL: EXITOSA\n";
    echo "   ✅ Host: {$host}:{$port}\n";
    echo "   ✅ Base de datos: {$database}\n";
    
} catch (Exception $e) {
    echo "   ❌ Error de conexión: " . $e->getMessage() . "\n";
}

echo "\n3. ARCHIVOS DE CONFIGURACIÓN:\n";
$config_files = [
    'Procfile',
    'nixpacks.toml',
    '.env.example',
    'composer.json',
    'package.json'
];

foreach ($config_files as $file) {
    $exists = file_exists($file);
    $status = $exists ? '✅' : '❌';
    echo "   {$status} {$file}: " . ($exists ? 'EXISTE' : 'NO ENCONTRADO') . "\n";
}

echo "\n4. EXTENSIONES PHP:\n";
$required_extensions = ['pdo', 'pdo_pgsql', 'mbstring', 'openssl', 'tokenizer', 'xml', 'ctype', 'json'];

foreach ($required_extensions as $ext) {
    $loaded = extension_loaded($ext);
    $status = $loaded ? '✅' : '❌';
    echo "   {$status} {$ext}: " . ($loaded ? 'CARGADA' : 'NO DISPONIBLE') . "\n";
}

echo "\n5. PERMISOS DE DIRECTORIO:\n";
$directories = ['storage', 'bootstrap/cache'];

foreach ($directories as $dir) {
    if (is_dir($dir)) {
        $writable = is_writable($dir);
        $status = $writable ? '✅' : '❌';
        echo "   {$status} {$dir}: " . ($writable ? 'ESCRIBIBLE' : 'SIN PERMISOS') . "\n";
    } else {
        echo "   ❌ {$dir}: NO EXISTE\n";
    }
}

echo "\n6. CONFIGURACIÓN LARAVEL:\n";
if (file_exists('artisan')) {
    echo "   ✅ Laravel detectado\n";
    
    // Verificar configuración
    if (file_exists('config/database.php')) {
        include 'config/database.php';
        echo "   ✅ Configuración de base de datos cargada\n";
    }
} else {
    echo "   ❌ Laravel no detectado (falta artisan)\n";
}

echo "\n=== FIN DEL DIAGNÓSTICO ===\n";
echo "\nSi hay errores marcados con ❌, revisa la configuración en Railway.\n";
echo "Variables de entorno faltantes deben configurarse en el panel de Railway.\n";