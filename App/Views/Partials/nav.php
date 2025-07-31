<?php
//TODO: implementar buscador
?>

<!--links principales para distribuir a los otros nav-->
<ul class="navbar-nav mb-2 mb-lg-0">
    <li class="nav-item">
        <a class="nav-link active"
           aria-current="page"
           href="/">
            Inicio
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link"
           href="/blog">
            Blog
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle"
           href="#"
           role="button"
           data-bs-toggle="dropdown"
           aria-expanded="false">
            Categorías
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
</ul>

<!--buscador-->
<form class="d-flex me-auto" role="search">
    <input class="form-control me-2"
           type="search"
           placeholder="Buscar post o palabra clave..."
           aria-label="Buscar"/>
    <button class="btn btn-outline-success" type="submit">
        <svg xmlns="http://www.w3.org/2000/svg"
             width="16" height="16" fill="currentColor"
             class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
        </svg>
    </button>
</form>
