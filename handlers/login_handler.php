<?php

require_once(__DIR__ . '/../config/php/paths.php');
//require_once(CONTROLLERS . 'AuthController.php');
//require_once(SECURITY . 'SessionManager.php');
require_once(__DIR__ . '/../bootstrap/autoload.php');

use Controllers\AuthController;
use Security\SessionManager;

SessionManager::init();

$result = AuthController::login($_POST);

if ($result['success']) {
    if(AuthController::checkAuth() && $_SESSION['role'] === 'admin'){
        $role = 'Admin';
    } else {
        $role = 'User';
    }
    header("Location: /App/Views/Dashboard/$role/index.view.php");//TODO:verificar que funcione
    exit;

} else {
    // Guardar errores y datos ingresados en sesión para mostrar
    $_SESSION['login_errors'] = $result['errors'];
    $_SESSION['login_data'] = $_POST;

    header('Location: /public/login.php?error=1');
    exit;
}