<?php
?>
<nav class="navbar navbar-expand-lg bg-transparent mt-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="/public/index.php">lh:8080</a>
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
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active"
                       aria-current="page"
                       href="/public/index.php">
                        Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="/public/blog.php">
                        Blog
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Categorias
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Computer Science</a></li>
                        <li><a class="dropdown-item" href="#">Engineering</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Hardware</a></li>
                        <li><a class="dropdown-item" href="#">Software</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Programming</a></li>
                        <li><a class="dropdown-item" href="#">Game Development</a></li>
                        <li><a class="dropdown-item" href="#">Mobile Development</a></li>
                        <li><a class="dropdown-item" href="#">Web Development</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Chemistry</a></li>
                        <li><a class="dropdown-item" href="#">Computer Organization and Architecture</a>
                        </li>
                        <li><a class="dropdown-item" href="#">Math</a></li>
                        <li><a class="dropdown-item" href="#">Physics</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="/public/index.php">
                        Iniciar sesión | Registrarse
                    </a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2"
                       type="search"
                       placeholder="Buscar post o palabra clave..."
                       aria-label="Buscar"/>
                <button class="btn btn-outline-success"
                        type="submit">
                    Buscar
                </button>
            </form>
        </div>
    </div>
</nav>
