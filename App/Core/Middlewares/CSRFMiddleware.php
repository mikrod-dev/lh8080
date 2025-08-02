<?php

namespace Core\Middlewares;

require_once(dirname(__DIR__) . '/../../bootstrap/autoload.php');

use Core\ErrorHandler;

final class CSRFMiddleware
{
    public static function handle(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            if (!CSRFToken::validate($token)) {
                error_log('[CSRF_MIDDLEWARE] handle(): token invalido');
                ErrorHandler::forbidden();
            }
        }
    }
}