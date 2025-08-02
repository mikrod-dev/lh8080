<?php

namespace Core\Middlewares;

require_once(dirname(__DIR__) . '/../../bootstrap/autoload.php');

use Security\SessionManager;

final class AuthMiddleware
{
    public static function handle(): void
    {
        SessionManager::init();

        if (!SessionManager::has('user_id')) {
            header('Location: /login?error=unauthorized');
            exit;
        }
    }
}