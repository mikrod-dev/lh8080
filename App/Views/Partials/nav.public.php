<?php
require_once(__DIR__ . '/../../../config/php/paths.php');
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
            <div class="btn-group d-lg-none mt-3" role="group" aria-label="login and signup buttons">
                <a href="/login" class="btn btn-primary">Iniciar sesión</a>
                <a href="/signup" class="btn btn-outline-secondary">Registrarse</a>
            </div>


            <!--solo visible en escritorio-->
            <div class="dropdown d-none d-lg-flex">
                <a href="#"
                   class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         width="32" height="32" fill="currentColor"
                         class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path fill-rule="evenodd"
                              d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                    </svg>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark text-small shadow">

                    <li><a class="dropdown-item" href="/login">Iniciar sesión</a></li>
                    <li><a class="dropdown-item" href="/signup">Registrarse</a></li>
                </ul>
            </div>

        </div>
    </div>
</nav>
