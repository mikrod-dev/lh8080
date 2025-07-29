<?php
require_once(__DIR__ . '/../bootstrap/autoload.php');

use Core\Router;
use Security\SessionManager;

SessionManager::init();

Router::get('/', ['HomeController', 'index']);
Router::get('/post/{id}', ['PostController', 'show']);
Router::get('/post/{id}/comentario', ['CommentController', 'store']);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];
//TODO:BORRAR LOG
error_log("[DEBUG] index.php: URI: $uri - METHOD: $method");

Router::dispatch($uri, $method);