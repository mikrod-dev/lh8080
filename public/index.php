<?php
require_once(__DIR__ . '/../bootstrap/autoload.php');

use Controllers\AuthController;
use Controllers\PageController;
use Controllers\SignupController;
use Core\Middlewares\AuthMiddleware;
use Core\Middlewares\CSRFMiddleware;
use Core\Router;
use Security\SessionManager;

SessionManager::init();

$router = new Router();

//GET es para las vistas
$router->get('/', [PageController::class, 'index']);
$router->get('/blog', [PageController::class, 'blog']);
$router->get('/login', [PageController::class, 'login']);
$router->get('/signup', [PageController::class, 'signup']);
$router->get('/dashboard',
    [PageController::class, 'dashboard'],
    [AuthMiddleware::class]
);

//POST es para los controladores
$router->post('/login',
    [AuthController::class, 'loginHandler'],
    [CSRFMiddleware::class]);;

$router->post('/signup',
    [SignupController::class, 'signupHandler'] ,
    [CSRFMiddleware::class]
);

$router->post('/logout',
    [AuthController::class, 'logout'],
    [AuthMiddleware::class, CSRFMiddleware::class]
);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$router->dispatch($uri, $method);