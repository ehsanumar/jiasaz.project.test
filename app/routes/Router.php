<?php

namespace App\Routes;

class Router
{
    public static function route(): void
    {
        require __DIR__ . '/routes.php';

        $request = trim($_SERVER['REQUEST_URI']);

        if (array_key_exists($request, routes)) {
            $controller = routes[$request][0];
            $class = new $controller();
            $method = routes[$request][1];
            if (class_exists($controller) && method_exists($controller, $method)) {
                $class->$method();
                exit;
            }
        }

        http_response_code(404);
        include BASE_PATH . '/app/views/not_found.php';
    }
}
