<?php
declare(strict_types=1);

namespace Core\Middlewares;

require_once(dirname(__DIR__) . '/../../bootstrap/autoload.php');

use Core\ErrorHandler;
use Random\RandomException;
use Security\SessionManager;

final class CSRFToken
{
    public static function generate(): string
    {
        SessionManager::init();

        if (!SessionManager::has('csrf_token')) {
            try {
                SessionManager::set('csrf_token', bin2hex(random_bytes(32)));
            } catch (RandomException $e) {
                error_log("[CSRF_TOKEN] generate(): " . $e->getMessage());
                ErrorHandler::serverError();//500
            }
        }
        return SessionManager::get('csrf_token');
    }

    public static function validate(string $token): bool
    {
        SessionManager::init();

        return hash_equals($token, SessionManager::get('csrf_token'));
    }
}