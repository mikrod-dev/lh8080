<?php

namespace Helpers;

require_once(__DIR__ . '/../../config/php/paths.php');
require_once(__DIR__ . '/../../bootstrap/autoload.php');

use Controllers\AuthController;
use Repositories\UserRepository;
use Security\SessionManager;

final class LocaleManager
{
    private static array $allowed = ['es', 'en'];

    public static function init(): void
    {
        SessionManager::init();

        if (isset($_GET['lang']) && in_array($_GET['lang'], self::$allowed)) {
            // Caso 1: El usuario forzó el idioma con ?lang=
            $locale = $_GET['lang'];
            SessionManager::set('lang', $locale);

            $authController = new AuthController();
            if ($authController->checkAuth()) {
                $userRepository = new UserRepository();
                $userRepository->updateLanguage(SessionManager::get('user_id'), $locale);
            }
        } elseif (SessionManager::has('lang')) {
            // Caso 2: Ya hay un idioma guardado en la sesión
            $locale = SessionManager::get('lang');
        } else {
            // Caso 3: No hay sesión, se toma preferencia del navegador
            $browser_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            $locale = in_array($browser_lang, self::$allowed) ? $browser_lang : 'es';
            SessionManager::set('lang', $locale);
        }

        Lang::setLocale($locale);
    }
}
