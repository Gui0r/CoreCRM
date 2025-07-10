<?php
require_once __DIR__ . '/bootstrap_no_db.php';

echo "=== Teste de Conexão ===\n";
echo "DatabaseHandler inicializado: " . (DatabaseHandler::isConnected() ? "SIM" : "NÃO") . "\n";
echo "AuthHandler funcionando: " . (class_exists('AuthHandler') ? "SIM" : "NÃO") . "\n";
echo "RoutesHandler funcionando: " . (class_exists('RoutesHandler') ? "SIM" : "NÃO") . "\n";
echo "PluginHandler funcionando: " . (class_exists('PluginHandler') ? "SIM" : "NÃO") . "\n";
echo "========================\n"; 