<?php
require_once(__DIR__ . '/../../../config/php/paths.php');
require_once __DIR__ . '/../../../bootstrap/autoload.php';

use Security\SessionManager;
use Core\Middlewares\CSRFToken;
use Helpers\Sanitizer;

SessionManager::init();
$token = CSRFToken::generate();
$avatar_url = SessionManager::get('avatar_url');
?>

<nav class="navbar navbar-expand-lg bg-transparent mt-3">
    <div class="container">
        <a class="navbar-brand" href="/">lh:8080</a>
        <button class="navbar-toggler btn-outline-light"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                     fill="currentColor" class="bi bi-list"
                     viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                </svg>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!--links y buscador-->
            <?php require_once(PARTIALS . 'nav.php'); ?>

            <!--solo visible en pantallas chicas-->
            <div class="btn-group d-lg-none mt-3" role="group" aria-label="dashboard and logout buttons">
                <a href="/dashboard" class="btn btn-outline-light">Mi panel</a>
                <form action="/logout" method="post">
                    <input type="hidden" name="csrf_token" value="<?php echo Sanitizer::output($token) ?>">
                    <button type="submit" class="btn btn-outline-danger">Salir</button>
                </form>
            </div>


            <!--solo visible en escritorio-->
            <div class="dropdown d-none d-lg-flex">
                <a href="#"
                   class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo Sanitizer::output($avatar_url) ?>"
                         alt="avatar"
                         class="rounded-circle"
                         width="32" height="32">
                    <!--TODO: imagen de userRepository-->
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="/dashboard">Panel</a></li>
                    <li>
                        <form action="/logout" method="post">
                            <input type="hidden" name="csrf_token" value="<?php echo Sanitizer::output($token) ?>">
                            <button type="submit" class="dropdown-item">Salir</button>
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav>