<?php
$page_title = 'Inicio | lh:8080';
require_once(__DIR__ . '/../config/php/paths.php');
require_once(LAYOUTS . 'header.php');
?>

<main class="container px-4 py-5 flex-grow-1">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-12 col-lg-6">
            <img src="/public/assets/images/hero-image.png"
                 class="d-block mx-auto img-fluid rounded" alt="Hero image" loading="lazy">
        </div>
        <div class="col-lg-6">
            <h1 class="display-4 fw-bold lh-1 mb-3">
                De localhost<br>
                al mundo
            </h1>
            <p class="lead fs-4">Este blog en construcción cuenta cómo se construye desde cero.
                Todo es un experimento, paso a paso, <em>aprender haciendo.</em></p>
            <p class="lead fs-4">Hecho con HTML, PHP, MySQL. Servido con Apache y Docker,
                y estilizado con
                Bootstrap.</p>
            <p class="lead fs-4">Explorá los artículos y no dudes en dejar comentarios.</p>
            <br/>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a class="btn btn-primary btn-lg px-4 me-md-2" href="/public/blog.php">Leer posts</a>
                <a class="btn btn-outline-secondary btn-lg px-4" href="login.php">Iniciar sesión</a>
            </div>
            <small class="text-muted">Para comentar, primero inicia sesión</small>
        </div>
    </div>
</main>

<?php require_once(LAYOUTS . 'footer.php'); ?>


