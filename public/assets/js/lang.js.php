<?php
header('Content-Type: application/javascript');

require_once(__DIR__ . '/../../../config/php/paths.php');
require_once(CONFIG . 'locale.php');//TODO:revisar este require
//require_once (HELPERS . 'Lang.php');
require_once (__DIR__ . '/../../../bootstrap/autoload.php');

use Helpers\Lang;

$message = require_once(CONFIG . 'general.php');

$lang_config = [
    'required_username' => Lang::get('required_username'),
    'required_password' => Lang::get('required_password'),
    'required_name' => Lang::get('required_name'),
    'required_email' => Lang::get('required_email'),
    'required_confirm_password' => Lang::get('required_confirm_password'),
    'short_name' => Lang::get('short_name', ['min' => $message['min_name_length']]),
    'short_username' => Lang::get('short_username', ['min' => $message['min_username_length']]),
    'short_password' => Lang::get('short_password', ['min' => $message['min_password_length']]),
    'valid_input' => Lang::get('valid_input'),
    'invalid_email' => Lang::get('invalid_email'),
    'invalid_password' => Lang::get('invalid_password', ['min' => $message['min_password_length']]),//regex
    'password_mismatch' => Lang::get('password_mismatch'),
    'login_failed' => Lang::get('login_failed'),
];

echo 'export default ' . json_encode($lang_config, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . ";";
