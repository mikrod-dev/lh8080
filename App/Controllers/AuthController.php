<?php
declare(strict_types=1);

namespace Controllers;

require_once(__DIR__ . '/../../config/php/paths.php');
require_once(__DIR__ . '/../../bootstrap/autoload.php');

use Repositories\UserRepository;
use Security\SessionManager;
use Helpers\Sanitizer;
use Helpers\LocaleManager;
use Helpers\Lang;
use Models\User;

final class AuthController
{
    public function login(array $data): array
    {
        LocaleManager::init();
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

        $userRepository = new UserRepository();
        $user = $userRepository->findByUsername($username);
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

        if ($user->getId() === 0) {
            return [
                'success' => false,
                'errors' => [
                    'username' => $loginFailed,
                    'password' => $loginFailed
                ]
            ];
        }

        SessionManager::init();
        SessionManager::set('user_id', $user->getId());
        SessionManager::set('username', $user->getUsername());
        SessionManager::set('lang', $user->getPreferredLanguage());
        SessionManager::set('role', $user->getRole());
        $user->setLastLogin();

        return ['success' => true];
    }

    public function checkAuth(): bool
    {
        SessionManager::init();
        return SessionManager::has('user_id') &&
                SessionManager::has('username');
    }

    public function forceLogin(User $user): void
    {
        SessionManager::init();
        SessionManager::set('user_id', $user->getId());
        SessionManager::set('username', $user->getUsername());
        SessionManager::set('lang', $user->getPreferredLanguage());
        SessionManager::set('role', $user->getRole());
        $user->setLastLogin();
    }

    public function logout(): never
    {
        SessionManager::logout();
        header('Location: /');
        exit;
    }

}