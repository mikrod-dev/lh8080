<?php
declare(strict_types=1);

namespace Controllers;

require_once(__DIR__ . '/../../config/php/paths.php');
require_once(CONFIG . 'locale.php');
require_once(HELPERS . 'Lang.php');
require_once(HELPERS . 'Sanitizer.php');
require_once(HELPERS . 'Validator.php');
require_once(MODELS . 'User.php');

use Helpers\Sanitizer;
use Helpers\Validator;
use Helpers\Lang;
use Models\User;

//solucionar el problema de tener que usar variables estáticas para los valores min
final class SignupController
{
    private static int $min_name_length;
    private static int $min_username_length;
    private static int $min_password_length;
    private static bool $is_initialized = false;

    private static function init(): void {
        if(self::$is_initialized) return;

        $general_config = require_once(__DIR__ . '/../../config/php/general.php');
        self::$min_name_length = $general_config['min_name_length'];
        self::$min_username_length = $general_config['min_username_length'];
        self::$min_password_length = $general_config['min_password_length'];
        self::$is_initialized = true;
    }
    public static function register(array $data): array
    {
        self::init();
        // Sanitizar los datos
        $name = Sanitizer::text($data['name']);
        $username = Sanitizer::text($data['username']);
        $email = Sanitizer::email($data['email']);
        $password = $data['password'];
        $confirm_password = $data['confirm_password'];

        $errors=[];

        if(!Validator::required($name)){
            $errors['name'] = Lang::get('required_name');
        } elseif (!Validator::stringLength($name, self::$min_name_length)) {
            $errors['name'] = Lang::get('short_name', ['min' => self::$min_name_length]);
        }

        if(!Validator::required($username)){
            $errors['username'] = Lang::get('required_username');
        } elseif (!Validator::stringLength($username, self::$min_username_length)){
            $errors['username'] = Lang::get('short_username', ['min' => self::$min_username_length]);
        }

        if(!Validator::required($email)){
            $errors['email'] = Lang::get('required_email');
        } elseif (!Validator::email($email)){
            $errors['email'] = Lang::get('invalid_email');
        }

        if(!Validator::required($password)){
            $errors['password'] = Lang::get('required_password');
        } elseif (!Validator::stringLength($password, self::$min_password_length)) {
            $errors['password'] = Lang::get('short_password', ['min' => self::$min_password_length]);
        }

        if(!Validator::match($password, $confirm_password)){
            $errors['confirm_password'] = Lang::get('password_mismatch');
        }

        if(!isset($errors['username']) && User::existsByUsername($username)){
            $errors['username'] = Lang::get('username_taken');
        }
        if(!isset($errors['email']) && User::existsByEmail($email)){
            $errors['email'] = Lang::get('email_taken');
        }

        if(!empty($errors)){
            return ['success' => false, 'errors' => $errors];
        }

        // Crear usuario con contraseña hasheada y guardar en la base de datos
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $userCreated = User::create([
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword,
        ]);

        if(!$userCreated->save()){
            error_log('Signup failed');
            return ['success' => false, 'errors' => ['general' => Lang::get('signup_failed')]];
        }

        return ['success' => true];
    }
}