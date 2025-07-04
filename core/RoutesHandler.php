
<?php

class RoutesHandler
{
    private static $routes = [];

    public static function init()
    {
        // Rotas padrão do sistema
        self::addRoute("GET", "/", function () {
            echo "Bem-vindo ao CRM!";
        });
        // self::addRoute("GET", "/login", function () {
        //     echo "Página de Login";
        // });
        // self::addRoute("GET", "/admin", function () {
        //     require_once __DIR__ . '/../admin/index.php';
        // }, ["auth" => true, "permission" => "admin"]);

        // Tratamento especial para rotas /api/*
        self::addRoute("ANY", "/api/(.*)", function ($params) {
            APIHandler::handleRequest($params[0]);
        });

        System::log("RoutesHandler initialized.");
    }

    public static function addRoute($method, $pattern, $callback, $middlewares = [])
    {
        self::$routes[] = [
            "method" => $method,
            "pattern" => self::formatPattern($pattern),
            "callback" => $callback,
            "middlewares" => $middlewares
        ];
        System::log("Route added: [{$method}] {$pattern}");
    }

    private static function formatPattern($pattern)
    {
        // Converte padrões como /api/(.*) para regex
        return "/^" . str_replace("/", "\\/", $pattern) . "$/";
    }

    public static function dispatch()
    {
        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        // Remover o subdiretório base se necessário
        $base = dirname($_SERVER['SCRIPT_NAME']);
        if ($base !== '/' && strpos($uri, $base) === 0) {
            $uri = substr($uri, strlen($base));
            if ($uri === '') $uri = '/';
        }
        $method = $_SERVER["REQUEST_METHOD"];

        foreach (self::$routes as $route) {
            //echo $route['pattern'];
            if (preg_match($route["pattern"], $uri, $matches)) {
                if ($route["method"] === "ANY" || $route["method"] === $method) {
                    // Remover o primeiro elemento (full match) dos matches
                    array_shift($matches);

                    // Verificar autenticação e permissões
                    if (isset($route["middlewares"]["auth"]) && $route["middlewares"]["auth"] === true) {
                        if (!AuthHandler::isLoggedIn()) {
                            AuthHandler::redirect("/login");
                            return;
                        }
                    }
                    if (isset($route["middlewares"]["permission"])) {
                        if (!AuthHandler::checkPermission($route["middlewares"]["permission"])) {
                            echo "Acesso negado."; // Ou redirecionar para página de erro
                            return;
                        }
                    }

                    call_user_func_array($route["callback"], $matches);
                    return;
                }
            }
        }

        // Rota não encontrada
        header("HTTP/1.0 404 Not Found");
        echo "404 - Página não encontrada.";
    }

    public static function getRoutes()
    {
        return self::$routes;
    }
}


