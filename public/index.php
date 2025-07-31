<?php
require_once(__DIR__ . '/../bootstrap/autoload.php');

use Controllers\AuthController;
use Controllers\PageController;
use Controllers\SignupController;
use Core\Router;
use Security\SessionManager;

SessionManager::init();

$router = new Router();

//GET es para las vistas
$router->get('/', [PageController::class, 'index']);
$router->get('/login', [PageController::class, 'login']);
$router->get('/signup', [PageController::class, 'signup']);
$router->get('/dashboard', [PageController::class, 'dashboard']);
$router->get('/blog', [PageController::class, 'blog']);

//POST es para los controladores
$router->post('/login', function () {
    $authController = new AuthController();
    $result = $authController->login($_POST);

    if ($result['success']) {
        header('Location: /dashboard');
        exit;
    }

    SessionManager::set('login_errors', $result['errors']);
    SessionManager::set('login_data', $_POST);
    header('Location: /login');
    exit;
});
$router->post('/signup', function (){
    $signupController = new SignupController();
    $result = $signupController->signup($_POST);

    if ($result['success']) {
        header('Location: /login');
        exit;
    }

    SessionManager::set('signup_errors', $result['errors']);
    SessionManager::set('signup_data', $_POST);
    header('Location: /signup');
    exit;
});
$router->post('/logout', [AuthController::class, 'logout']);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$router->dispatch($uri, $method);