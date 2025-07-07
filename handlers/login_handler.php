<?php

use Controllers\AuthController;
use Security\SessionManager;

SessionManager::init();

$result = AuthController::login($_POST);

if ($result['success']) {
    header('Location: /dashboard.php');//implementar dashboard de usuario
} else {
    // Guardar errores y datos ingresados en sesión para mostrar
    $_SESSION['login_errors'] = $result['errors'];
    $_SESSION['login_data'] = $_POST;

    header('Location: /login.php?error=1');
    exit;
}