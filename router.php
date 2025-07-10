<?php
// Router para servir arquivos estáticos e PHP
$uri = $_SERVER['REQUEST_URI'];

// Remove query string
$uri = parse_url($uri, PHP_URL_PATH);

// Se for um arquivo estático (CSS, JS, etc.)
if (preg_match('/\.(css|js|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)$/', $uri)) {
    $file = __DIR__ . $uri;
    
    if (file_exists($file)) {
        $extension = pathinfo($uri, PATHINFO_EXTENSION);
        
        // Define o content-type correto
        $contentTypes = [
            'css' => 'text/css',
            'js' => 'application/javascript',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'ico' => 'image/x-icon',
            'svg' => 'image/svg+xml',
            'woff' => 'font/woff',
            'woff2' => 'font/woff2',
            'ttf' => 'font/ttf',
            'eot' => 'application/vnd.ms-fontobject'
        ];
        
        if (isset($contentTypes[$extension])) {
            header('Content-Type: ' . $contentTypes[$extension]);
        }
        
        readfile($file);
        exit;
    }
}

// Se não for arquivo estático, serve o index
require_once __DIR__ . '/index_no_db.php'; 