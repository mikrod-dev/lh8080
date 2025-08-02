<?php

namespace Core;

final class ErrorHandler
{
    // Forbidden 403: El servidor ya tiene al usuario autenticado,
    // pero no tiene permiso para lo que pide
    public static function forbidden(): never{

        http_response_code(403);
        ViewRenderer::render('Errors/403.view');
        exit;
    }

    // Not found 404: El usuario hizo una petición válida,
    // pero el servidor no puede encontrar el recurso que pidió
    public static function notFound(): never{
        http_response_code(404);
        ViewRenderer::render('Errors/404.view');
        exit;
    }

    // Internal server error 500: Ocurrió un error inesperado en el servidor.
    // Fallo del código, base de datos o algún componente interno
    public static function serverError(): never{
        http_response_code(500);
        ViewRenderer::render('Errors/500.view');
        exit;
    }

    // Service unavailable 503: El servidor no está disponible temporalmente.
    // El servidor está caído, reiniciado, saturado o sin acceso a algún servicio crítico
    public static function connectionError(): never{
        http_response_code(503);
        ViewRenderer::render('Errors/503.view');
        exit;
    }

}