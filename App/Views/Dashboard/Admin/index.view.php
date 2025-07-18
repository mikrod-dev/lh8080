<?php
$page_title = 'Inicio | lh:8080';
require_once(__DIR__ . '/../../../../config/php/paths.php');;
require_once(PARTIALS . 'header.php');
?>
    <body class="container d-flex flex-column min-vh-100">
    <header>
        <?php require_once(PARTIALS . 'nav.admin.php'); ?>
    </header>

    <div class="row flex-nowrap">
        <?php require_once(PARTIALS . 'aside.admin.php'); ?>

        <main class="col p-4 overflow-auto">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center
                  pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Panel de administración</h1>
            </div>

            <!-- Widgets rápidos -->
            <div class="row g-3 mb-4">
                <div class="col">
                    <div class="card text-center border-primary">
                        <div class="card-body">
                            <h6 class="card-title text-primary">Usuarios</h6>
                            <p class="fs-4 mb-0"><?= $stats['users'] ?? 0 ?></p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card text-center border-success">
                        <div class="card-body">
                            <h6 class="card-title text-success">Posts</h6>
                            <p class="fs-4 mb-0"><?= $stats['posts'] ?? 0 ?></p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card text-center border-warning">
                        <div class="card-body">
                            <h6 class="card-title text-warning">Comentarios pendientes</h6>
                            <p class="fs-4 mb-0"><?= $stats['pending_comments'] ?? 0 ?></p>
                        </div>
                    </div>
                </div>

            </div>

            <h2 class="h4">Comentarios pendientes</h2>
            <div class="table-responsive small">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Post</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!--                    --><?php //foreach ($pendingComments as $c): ?>
                    <!--                        <tr>-->
                    <!--                            <td>--><?php //= $c['comment_id'] ?><!--</td>-->
                    <!--                            <td>-->
                    <?php //= htmlspecialchars($c['post_title']) ?><!--</td>-->
                    <!--                            <td>--><?php //= htmlspecialchars($c['username']) ?><!--</td>-->
                    <!--                            <td>--><?php //= $c['created_at'] ?><!--</td>-->
                    <!--                            <td>-->
                    <!--                                <button class="btn btn-sm btn-success">Aprobar</button>-->
                    <!--                                <button class="btn btn-sm btn-danger">Eliminar</button>-->
                    <!--                            </td>-->
                    <!--                        </tr>-->
                    <!--                    --><?php //endforeach; ?>
                    </tbody>
                </table>
            </div>
            <p></p>
        </main>

    </div>

    </body>
<?php require_once(PARTIALS . 'footer.php'); ?>