<?php
declare(strict_types=1);

namespace Controllers;

use Models\User;
use Security\SessionManager;
use Helpers\Sanitizer;
use Helpers\Lang;

require_once(__DIR__ . '/../../config/php/paths.php');
require_once(CONFIG . 'locale.php');

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
        if (!$user) {
            return ['success' => false, 'errors' => ['username' => Lang::get('username_not_found')]];
        }

        if (!password_verify($password, $user->getPasswordHash())) {
            return ['success' => false, 'errors' => ['password' => Lang::get('login_failed')]];
        }

        SessionManager::init();
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['username'] = $user->getUsername();

        return ['success' => true];
    }

    public static function logout(): never
    {
        SessionManager::init();
        unset($_SESSION['user_id'], $_SESSION['username']);
        session_unset();
        session_destroy();
        header('Location: /public/login.php');
        exit;
    }

    public static function checkAuth(): bool
    {
        SessionManager::init();
        return isset($_SESSION['user_id']);
    }

}