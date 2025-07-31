<?php

namespace Security;

final class SessionManager
{
    public static function init(): void
    {
        if (session_status() === PHP_SESSION_NONE){
            ini_set('session.use_only_cookies', 1); // Solo cookies
            ini_set('session.use_strict_mode', 1); //
            ini_set('session.cookie_httponly', 1); // Previene XSS
//        ini_set('session.cookie_secure', 1);// Sesiones solo funcionan con HTTPS activado
            ini_set('session.cookie_samesite', 'Strict'); // Previene CSRF

            session_start();
        }

        self::regenerateId();
    }

    public static function regenerateId(): void
    {
        if(!isset($_SESSION['last_regeneration'])){
            $_SESSION['last_regeneration'] = time();
        }elseif(time() - $_SESSION['last_regeneration'] > 3600){
            session_regenerate_id(true);
        }
    }

    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key): mixed
    {
        return $_SESSION[$key] ?? null;
    }

    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public static function delete(string $key): void
    {
        unset($_SESSION[$key]);

    }

    public static function logout(): void
    {
        self::init();
        self::destroy();
    }

    public static function destroy(): void
    {
        session_unset();
        session_destroy();
    }

}