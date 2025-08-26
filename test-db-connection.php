<?php

/**
 * Test de conexión específico para Railway PostgreSQL
 * Ejecutar con: php test-db-connection.php
 */

echo "=== TEST DE CONEXIÓN POSTGRESQL RAILWAY ===\n\n";

// Mostrar todas las variables de entorno relacionadas con DB
echo "Variables de entorno disponibles:\n";
$env_vars = $_ENV + getenv();
foreach ($env_vars as $key => $value) {
    if (strpos($key, 'DB_') === 0 || strpos($key, 'POSTGRES') !== false || strpos($key, 'DATABASE') !== false) {
        $display_value = (strpos($key, 'PASSWORD') !== false) ? '[OCULTA]' : $value;
        echo "  {$key}: {$display_value}\n";
    }
}

echo "\n=== INTENTANDO CONEXIÓN ===\n";

// Configuración de conexión
$host = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?? 'localhost';
$port = $_ENV['DB_PORT'] ?? getenv('DB_PORT') ?? '5432';
$database = $_ENV['DB_DATABASE'] ?? getenv('DB_DATABASE') ?? 'railway';
$username = $_ENV['DB_USERNAME'] ?? getenv('DB_USERNAME') ?? 'postgres';
$password = $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ?? '';

echo "Intentando conectar a:\n";
echo "  Host: {$host}\n";
echo "  Puerto: {$port}\n";
echo "  Base de datos: {$database}\n";
echo "  Usuario: {$username}\n";
echo "  Password: " . (empty($password) ? '[VACÍA]' : '[CONFIGURADA]') . "\n\n";

// Test de conexión con timeout
ini_set('default_socket_timeout', 10);

try {
    $start_time = microtime(true);
    
    $dsn = "pgsql:host={$host};port={$port};dbname={$database}";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 10,
        PDO::ATTR_PERSISTENT => false
    ];
    
    echo "Creando conexión PDO...\n";
    $pdo = new PDO($dsn, $username, $password, $options);
    
    $end_time = microtime(true);
    $connection_time = round(($end_time - $start_time) * 1000, 2);
    
    echo "✅ CONEXIÓN EXITOSA en {$connection_time}ms\n";
    
    // Test básico de consulta
    echo "\nProbando consulta básica...\n";
    $stmt = $pdo->query('SELECT version()');
    $version = $stmt->fetchColumn();
    echo "✅ Versión PostgreSQL: {$version}\n";
    
    // Verificar si existen tablas de Laravel
    echo "\nVerificando tablas de Laravel...\n";
    $stmt = $pdo->query("SELECT tablename FROM pg_tables WHERE schemaname = 'public'");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if (empty($tables)) {
        echo "⚠️  No se encontraron tablas. Necesitas ejecutar migraciones.\n";
    } else {
        echo "✅ Tablas encontradas: " . implode(', ', array_slice($tables, 0, 5)) . "\n";
        if (count($tables) > 5) {
            echo "   ... y " . (count($tables) - 5) . " más\n";
        }
    }
    
} catch (PDOException $e) {
    $end_time = microtime(true);
    $connection_time = round(($end_time - $start_time) * 1000, 2);
    
    echo "❌ ERROR DE CONEXIÓN después de {$connection_time}ms:\n";
    echo "   Código: " . $e->getCode() . "\n";
    echo "   Mensaje: " . $e->getMessage() . "\n";
    
    // Diagnósticos adicionales
    if (strpos($e->getMessage(), 'timeout') !== false) {
        echo "\n🔍 DIAGNÓSTICO: Timeout de conexión\n";
        echo "   - Verifica que uses RAILWAY_PRIVATE_DOMAIN\n";
        echo "   - Confirma que el servicio PostgreSQL esté activo\n";
    }
    
    if (strpos($e->getMessage(), 'authentication failed') !== false) {
        echo "\n🔍 DIAGNÓSTICO: Error de autenticación\n";
        echo "   - Verifica usuario y contraseña\n";
        echo "   - Confirma las variables de entorno\n";
    }
    
    if (strpos($e->getMessage(), 'does not exist') !== false) {
        echo "\n🔍 DIAGNÓSTICO: Base de datos no existe\n";
        echo "   - Verifica el nombre de la base de datos\n";
        echo "   - Confirma que el servicio PostgreSQL esté configurado\n";
    }
    
} catch (Exception $e) {
    echo "❌ ERROR GENERAL: " . $e->getMessage() . "\n";
}

echo "\n=== FIN DEL TEST ===\n";