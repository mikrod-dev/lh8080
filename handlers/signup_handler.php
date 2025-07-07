<?php

use Controllers\SignupController;
use Security\SessionManager;

SessionManager::init();

$result = SignupController::register($_POST);

if ($result['success']) {
    // Redirección al login con mensaje que se registró correctamente
    header('Location: /login.php?registered=1');//cambiar con el router
    exit;
} else {
    // Guardar errores y datos ingresados en una sesión para mostrarlos en signup.php
    $_SESSION['signup_errors'] = $result['errors'];
    $_SESSION['signup_data'] = $_POST;

    // Volver al formulario de registro
    header('Location: /public/signup.php');//cambiar con el router
    exit;
}