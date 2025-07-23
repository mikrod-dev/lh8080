<?php
declare(strict_types=1);

namespace Controllers;

require_once(__DIR__ . '/../../config/php/paths.php');
require_once(CONFIG . 'locale.php');
//require_once(HELPERS . 'Lang.php');
//require_once(HELPERS . 'Sanitizer.php');
//require_once(SECURITY . 'SessionManager.php');
//require_once(MODELS . 'User.php');
require_once(__DIR__ . '/../../bootstrap/autoload.php');

use Models\User;
use Security\SessionManager;
use Helpers\Sanitizer;
use Helpers\Lang;

final class AuthController
{
    public static function login(array $data): array
    {
        $username = Sanitizer::text($data['username'] ?? '');
        $password = Sanitizer::text($data['password'] ?? '');

        $errors = [];

        if ($username === '') {
            $errors['username'] = Lang::get('required_username');
        }
        if ($password === '') {
            $errors['password'] = Lang::get('required_password');
        }

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        $user = User::findByUsername($username);
        $loginFailed = Lang::get('login_failed');

        if (!$user) {
            return [
                'success' => false,
                'errors' => [
                    'username' => $loginFailed,
                    'password' => $loginFailed
                ]
            ];
        }

        if (!password_verify($password, $user->getPasswordHash())) {
            return [
                'success' => false,
                'errors' => [
                    'username' => $loginFailed,
                    'password' => $loginFailed
                ]
            ];
        }

        SessionManager::init();
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['username'] = $user->getUsername();
        $user->setLastLogin();

        return ['success' => true];
    }

    public static function logout(): never
    {
        SessionManager::init();
        unset($_SESSION['user_id'], $_SESSION['username']);
        SessionManager::destroy();
        header('Location: /public/index.php');
        exit;
    }

    //TODO: verificar utilidad de este método en comparación con CSRF token
    public static function checkAuth(): bool
    {
        SessionManager::init();
        return isset($_SESSION['user_id']);
    }

}