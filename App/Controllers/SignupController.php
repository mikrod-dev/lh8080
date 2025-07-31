<?php
declare(strict_types=1);

namespace Controllers;

require_once(__DIR__ . '/../../config/php/paths.php');
require_once(__DIR__ . '/../../bootstrap/autoload.php');

use Exception;
use Helpers\Sanitizer;
use Helpers\Validator;
use Helpers\Config;
use Helpers\LocaleManager;
use Helpers\Lang;
use Models\User;
use Repositories\UserRepository;

final class SignupController
{
    private int $min_name_length;
    private int $min_username_length;
    private int $min_password_length;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->min_name_length = Config::get('general.min_name_length');
        $this->min_username_length = Config::get('general.min_username_length');
        $this->min_password_length = Config::get('general.min_password_length');
    }

    public function signup(array $data): array
    {
        LocaleManager::init();

        // Sanitizar los datos
        $name = Sanitizer::text($data['name']);
        $username = Sanitizer::text($data['username']);
        $email = Sanitizer::email($data['email']);
        $password = $data['password'];
        $confirm_password = $data['confirm_password'];

        $userRepository = new UserRepository();
        $errors = [];

        if (!Validator::required($name)) {
            $errors['name'] = Lang::get('required_name');
        } elseif (!Validator::stringLength($name, $this->min_name_length)) {
            $errors['name'] = Lang::get('short_name', ['min' => $this->min_name_length]);
        }

        if (!Validator::required($username)) {
            $errors['username'] = Lang::get('required_username');
        } elseif (!Validator::stringLength($username, $this->min_username_length)) {
            $errors['username'] = Lang::get('short_username', ['min' => $this->min_username_length]);
        }

        if (!Validator::required($email)) {
            $errors['email'] = Lang::get('required_email');
        } elseif (!Validator::email($email)) {
            $errors['email'] = Lang::get('invalid_email');
        }

        if (!Validator::required($password)) {
            $errors['password'] = Lang::get('required_password');
        } elseif (!Validator::stringLength($password, $this->min_password_length)) {
            $errors['password'] = Lang::get('short_password', ['min' => $this->min_password_length]);
        }

        if (!Validator::match($password, $confirm_password)) {
            $errors['confirm_password'] = Lang::get('password_mismatch');
        }

        if (!isset($errors['username']) && $userRepository->existsByUsername($username)) {
            $errors['username'] = Lang::get('username_taken');
        }
        if (!isset($errors['email']) && $userRepository->existsByEmail($email)) {
            $errors['email'] = Lang::get('email_taken');
        }

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = new User(
            [
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'password_hash' => $hashedPassword
            ]
        );

        if (!$userRepository->save($user)) {
            error_log('Signup failed');//TODO: eliminar después de tests
            return ['success' => false, 'errors' => ['general' => Lang::get('signup_failed')]];
        }

        return ['success' => true];
    }
}