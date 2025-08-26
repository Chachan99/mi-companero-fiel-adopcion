<?php
// Script de prueba básico para Railway
echo "<h1>Railway Test Script</h1>";
echo "<p>Timestamp: " . date('Y-m-d H:i:s') . "</p>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Server: " . $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown' . "</p>";
echo "<p>Document Root: " . $_SERVER['DOCUMENT_ROOT'] ?? 'Unknown' . "</p>";
echo "<p>Script Name: " . $_SERVER['SCRIPT_NAME'] ?? 'Unknown' . "</p>";
echo "<p>Request URI: " . $_SERVER['REQUEST_URI'] ?? 'Unknown' . "</p>";

// Verificar variables de entorno críticas
echo "<h2>Environment Variables</h2>";
echo "<p>APP_ENV: " . (getenv('APP_ENV') ?: 'Not set') . "</p>";
echo "<p>APP_KEY: " . (getenv('APP_KEY') ? 'Set (' . strlen(getenv('APP_KEY')) . ' chars)' : 'Not set') . "</p>";
echo "<p>DB_HOST: " . (getenv('DB_HOST') ?: 'Not set') . "</p>";
echo "<p>DB_DATABASE: " . (getenv('DB_DATABASE') ?: 'Not set') . "</p>";

// Verificar archivos Laravel
echo "<h2>Laravel Files Check</h2>";
$files = [
    '../bootstrap/app.php',
    '../config/app.php',
    '../routes/web.php',
    '../vendor/autoload.php'
];

foreach ($files as $file) {
    echo "<p>" . $file . ": " . (file_exists($file) ? 'EXISTS' : 'MISSING') . "</p>";
}

echo "<h2>Current Directory Contents</h2>";
$files = scandir('.');
foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        echo "<p>" . $file . (is_dir($file) ? ' (DIR)' : ' (FILE)') . "</p>";
    }
}
?>