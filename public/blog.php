<?php
$page_title = 'Blog | lh:8080';
require_once(__DIR__ . '/../config/php/paths.php');
require_once(PARTIALS . 'header.php');
?>
<body class="container d-flex flex-column min-vh-100">
<header>
    <?php require_once(PARTIALS . 'nav.public.php'); ?>
</header>

<main class="mt-5">
    <div class="row">
        <section class="row g-3 col-12 col-lg-9">
            <div class="col-12">
                <h3 class="text-center">Todos los posts</h3>
            </div>
            <div class="col-12 col-md-6 col-xl-4">
                <article class="card">
                    <img src="#"
                         class="card-img-top"
                         alt="Image of a microchip">
                    <div class="card-body">
                        <h5 class="card-title">About the new microchips</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the
                            card’s content.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        <a href="#" class="btn btn-primary">Read</a>
                    </div>
                </article>
            </div>
            <div class="col-12 col-md-6 col-xl-4">
                <article class="card">
                    <img src="#"
                         class="card-img-top"
                         alt="Image of a microchip">
                    <div class="card-body">
                        <h5 class="card-title">About the new microchips</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the
                            card’s content.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        <a href="#" class="btn btn-primary">Read</a>
                    </div>
                </article>
            </div>
            <div class="col-12 col-md-6 col-xl-4">
                <article class="card">
                    <img src="#"
                         class="card-img-top"
                         alt="Image of a microchip">
                    <div class="card-body">
                        <h5 class="card-title">About the new microchips</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the
                            card’s content.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        <a href="#" class="btn btn-primary">Read</a>
                    </div>
                </article>
            </div>
            <div class="col-12 col-md-6 col-xl-4">
                <article class="card">
                    <img src="#"
                         class="card-img-top"
                         alt="Image of a microchip">
                    <div class="card-body">
                        <h5 class="card-title">About the new microchips</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the
                            card’s content.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        <a href="#" class="btn btn-primary">Read</a>
                    </div>
                </article>
            </div>
            <div class="col-12 col-md-6 col-xl-4">
                <article class="card">
                    <img src="#"
                         class="card-img-top"
                         alt="Image of a microchip">
                    <div class="card-body">
                        <h5 class="card-title">About the new microchips</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the
                            card’s content.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        <a href="#" class="btn btn-primary">Read</a>
                    </div>
                </article>
            </div>

        </section>

        <div class="col-12 col-lg-3 d-none d-lg-block">
            <?php require_once(PARTIALS . 'aside.php'); ?>
        </div>

    </div>
</main>
</body>
<?php require_once(PARTIALS . 'footer.php'); ?>

