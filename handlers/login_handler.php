<?php

require_once(__DIR__ . '/../config/php/paths.php');
require_once(CONTROLLERS . 'AuthController.php');
require_once(SECURITY . 'SessionManager.php');

use Controllers\AuthController;
use Security\SessionManager;

SessionManager::init();

$result = AuthController::login($_POST);

if ($result['success']) {
    header('Location: /dashboard.php');//implementar dashboard de usuario
    exit;
} else {
    // Guardar errores y datos ingresados en sesión para mostrar
    $_SESSION['login_errors'] = $result['errors'];
    $_SESSION['login_data'] = $_POST;

    header('Location: /public/login.php?error=1');
    exit;
}