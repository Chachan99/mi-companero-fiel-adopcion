<?php
// Script de diagnóstico directo para Railway
// Accesible en: https://web-production-28d0.up.railway.app/railway-debug.php

header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<!DOCTYPE html>";
echo "<html><head><title>Railway Debug</title></head><body>";
echo "<h1>🔍 Railway Debug Report</h1>";
echo "<style>body{font-family:Arial;margin:20px;} .ok{color:green;} .error{color:red;} .warning{color:orange;}</style>";

try {
    echo "<h2>📋 Información Básica</h2>";
    echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
    echo "<p><strong>Server Time:</strong> " . date('Y-m-d H:i:s') . "</p>";
    echo "<p><strong>Document Root:</strong> " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
    echo "<p><strong>Script Path:</strong> " . __FILE__ . "</p>";
    
    echo "<h2>🔧 Variables de Entorno Críticas</h2>";
    $critical_vars = ['APP_KEY', 'APP_ENV', 'DB_HOST', 'DB_DATABASE', 'DB_USERNAME'];
    foreach ($critical_vars as $var) {
        $value = getenv($var) ?: $_ENV[$var] ?? 'NO DEFINIDA';
        $class = ($value === 'NO DEFINIDA') ? 'error' : 'ok';
        if ($var === 'APP_KEY' && $value !== 'NO DEFINIDA') {
            $value = substr($value, 0, 20) . '...';
        }
        if ($var === 'DB_USERNAME' && $value !== 'NO DEFINIDA') {
            $value = substr($value, 0, 10) . '...';
        }
        echo "<p class='$class'><strong>$var:</strong> $value</p>";
    }
    
    echo "<h2>📁 Archivos Laravel</h2>";
    $laravel_files = [
        '../bootstrap/app.php' => 'Bootstrap',
        '../config/app.php' => 'Config App',
        '../config/database.php' => 'Config Database',
        '../vendor/autoload.php' => 'Composer Autoload'
    ];
    
    foreach ($laravel_files as $file => $name) {
        $exists = file_exists($file);
        $class = $exists ? 'ok' : 'error';
        $status = $exists ? '✅ Existe' : '❌ No existe';
        echo "<p class='$class'><strong>$name:</strong> $status</p>";
    }
    
    echo "<h2>🗄️ Test de Base de Datos</h2>";
    
    // Intentar conexión a la base de datos
    $db_host = getenv('DB_HOST') ?: $_ENV['DB_HOST'] ?? null;
    $db_port = getenv('DB_PORT') ?: $_ENV['DB_PORT'] ?? '5432';
    $db_name = getenv('DB_DATABASE') ?: $_ENV['DB_DATABASE'] ?? null;
    $db_user = getenv('DB_USERNAME') ?: $_ENV['DB_USERNAME'] ?? null;
    $db_pass = getenv('DB_PASSWORD') ?: $_ENV['DB_PASSWORD'] ?? null;
    
    if ($db_host && $db_name && $db_user && $db_pass) {
        try {
            $dsn = "pgsql:host=$db_host;port=$db_port;dbname=$db_name";
            $pdo = new PDO($dsn, $db_user, $db_pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_TIMEOUT => 10
            ]);
            echo "<p class='ok'>✅ Conexión PostgreSQL: EXITOSA</p>";
            
            // Test query
            $stmt = $pdo->query('SELECT version()');
            $version = $stmt->fetchColumn();
            echo "<p class='ok'>📊 PostgreSQL Version: " . substr($version, 0, 50) . "...</p>";
            
        } catch (Exception $e) {
            echo "<p class='error'>❌ Error de conexión DB: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        echo "<p class='error'>❌ Variables de DB incompletas</p>";
    }
    
    echo "<h2>🚀 Test de Laravel Bootstrap</h2>";
    
    // Intentar cargar Laravel
    if (file_exists('../bootstrap/app.php')) {
        try {
            // Cambiar al directorio raíz de Laravel
            chdir('..');
            
            // Cargar Laravel
            require_once 'bootstrap/app.php';
            echo "<p class='ok'>✅ Laravel Bootstrap: EXITOSO</p>";
            
            // Intentar crear la aplicación
            $app = require_once 'bootstrap/app.php';
            echo "<p class='ok'>✅ Laravel App Creation: EXITOSO</p>";
            
        } catch (Exception $e) {
            echo "<p class='error'>❌ Error Laravel Bootstrap: " . htmlspecialchars($e->getMessage()) . "</p>";
            echo "<p class='error'>📍 Stack trace: " . htmlspecialchars($e->getTraceAsString()) . "</p>";
        }
    } else {
        echo "<p class='error'>❌ No se encuentra bootstrap/app.php</p>";
    }
    
    echo "<h2>📊 Información del Sistema</h2>";
    echo "<p><strong>Memory Limit:</strong> " . ini_get('memory_limit') . "</p>";
    echo "<p><strong>Max Execution Time:</strong> " . ini_get('max_execution_time') . "s</p>";
    echo "<p><strong>Upload Max Size:</strong> " . ini_get('upload_max_filesize') . "</p>";
    
    echo "<h2>🔍 Extensiones PHP</h2>";
    $required_extensions = ['pdo', 'pdo_pgsql', 'mbstring', 'openssl', 'tokenizer', 'xml', 'ctype', 'json'];
    foreach ($required_extensions as $ext) {
        $loaded = extension_loaded($ext);
        $class = $loaded ? 'ok' : 'error';
        $status = $loaded ? '✅' : '❌';
        echo "<p class='$class'><strong>$ext:</strong> $status</p>";
    }
    
} catch (Exception $e) {
    echo "<p class='error'>💥 Error crítico: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p class='error'>📍 Archivo: " . htmlspecialchars($e->getFile()) . " Línea: " . $e->getLine() . "</p>";
}

echo "<hr><p><small>🕐 Generado: " . date('Y-m-d H:i:s') . " | Railway Debug v1.0</small></p>";
echo "</body></html>";
?>