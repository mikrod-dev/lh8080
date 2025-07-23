<?php
header('Content-Type: application/javascript');

$general_config = require_once(__DIR__ . '/../../../config/php/general.php');//TODO:usar Config

$config = [
    'minNameLength' => $general_config['min_name_length'],
    'minUsernameLength' => $general_config['min_username_length'],
    'minPasswordLength' => $general_config['min_password_length'],
];

echo "export default " . json_encode($config, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . ";";