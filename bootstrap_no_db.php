<?php

// Carrega as configurações globais
$config = require_once __DIR__ . '/config/config.php';

// Carrega os módulos principais
require_once __DIR__ . '/core/System.php';
require_once __DIR__ . '/core/ThemeHandler.php';
require_once __DIR__ . '/core/RoutesHandler.php';
require_once __DIR__ . '/core/HookHandler.php';
require_once __DIR__ . '/core/PluginHandler.php';
require_once __DIR__ . '/core/DatabaseHandler.php';
require_once __DIR__ . '/core/AuthHandler.php';
require_once __DIR__ . '/core/APIHandler.php';

if($config['debug']){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

// Inicia o sistema
System::init();
ThemeHandler::init();
DatabaseHandler::init(); // Inicializa mas não falha se não conectar
AuthHandler::init();
PluginHandler::init();
RoutesHandler::init();

// Dispatch da rota
RoutesHandler::dispatch(); 