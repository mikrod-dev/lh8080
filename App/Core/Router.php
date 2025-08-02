<?php

namespace Core;

final class Router
{
    private array $routes = [];

    public function get(string $uri, callable|array $action, array $middlewares = []): void
    {
        $this->routes['GET'][$uri] = ['action' => $action, 'middlewares' => $middlewares];
    }

    public function post(string $uri, callable|array $action, array $middlewares = []): void
    {
        $this->routes['POST'][$uri] = ['action' => $action, 'middlewares' => $middlewares];
    }

    public function dispatch(string $uri, string $method): void
    {
        $uri = trim($uri, '/');
        $routes = $this->routes[$method] ?? [];

        foreach ($routes as $route => $data) {
            $route_pattern = preg_replace('#\{[^\}]+\}#', '([^/]+)', trim($route, '/'));
            $regex = '#^' . $route_pattern . '$#';

            if (preg_match($regex, $uri, $matches)) {
                array_shift($matches);

                $action = $data['action'];
                $middlewares = $data['middlewares'];

                foreach ($middlewares as $middleware) {
                    if (is_callable([ $middleware, 'handle'])){
                        $middleware::handle();
                    }
                }

                if (is_array($action)) {
                    [$controller, $method] = $action;

                    if (!str_contains($controller, '\\')) {
                        $controller = "Controllers\\$controller";
                    }

                    if (!class_exists($controller)) {
                        error_log("[DEBUG] Router::dispatch(): Controller $controller no encontrado");
                        ErrorHandler::serverError();//500
                    }

                    $instance = new $controller;
                    $args = $_SERVER['REQUEST_METHOD'] === 'POST' ? [$_POST] : $matches;
                    call_user_func_array([$instance, $method], $args);
                } else {
                    call_user_func($action, $matches);
                }
                return;
            }
        }

        error_log("[DEBUG] Router::dispatch(): $uri no encontrado");
        ErrorHandler::notFound();

    }

}