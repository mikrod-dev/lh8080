<?php
require_once (__DIR__ . '/../../config/php/paths.php');
require_once (HELPERS . 'Lang.php');
require_once (SECURITY . 'SessionManager.php');

//TODO:hacer este archivo una clase
use Helpers\Lang;
use Security\SessionManager;
SessionManager::init();

$allowed = ['es', 'en'];
$locale = $_GET['lang'] ?? $_SESSION['lang'] ?? 'es';

if (!isset($_SESSION['lang'])) {
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    if (in_array($lang, $allowed)) $_SESSION['lang'] = $lang;
    else $_SESSION['lang'] = 'es';
}

Lang::setLocale($locale);
