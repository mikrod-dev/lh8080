<?php

namespace Core;

final class Router
{
    private array $routes = [];

    public function get(string $uri, callable|array $action): void
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function post(string $uri, callable|array $action): void
    {
        $this->routes['POST'][$uri] = $action;
    }

    public function dispatch(string $uri, string $method): void
    {
        $uri = trim($uri, '/');
        $routes = $this->routes[$method] ?? [];

        //TODO:BORRAR ERROR_LOGS
        error_log("[DEBUG] Router::dispatch(): URI: $uri - METHOD: $method");

        foreach ($routes as $route => $action) {
            $route_pattern = preg_replace('#\{[^\}]+\}#', '([^/]+)', trim($route, '/'));
            $regex = '#^' . $route_pattern . '$#';

            if (preg_match($regex, $uri, $matches)) {
                array_shift($matches);

                if (is_array($action)) {
                    [$controller, $method] = $action;

                    if (!str_contains($controller, '\\')) {
                        $controller = "Controllers\\$controller";
                    }

                    if (!class_exists($controller)) {
                        http_response_code(500);
                        error_log("[DEBUG] Router::dispatch(): Controller $controller no encontrado");
                        return;
                    }

                    $instance = new $controller;
                    $args = $_SERVER['REQUEST_METHOD'] === 'POST' ? [$_POST] : $matches;
                    call_user_func_array([$instance, $method], $args);
                    return;
                } else {
                    call_user_func($action, $matches);
                }
            }
        }

        http_response_code(404);
        echo "404 No encontrado: $uri";

    }

}