<?php
require_once(__DIR__ . '/../../../config/php/paths.php');
require_once(__DIR__ . '/../../../bootstrap/autoload.php');

use Security\SessionManager;
use Helpers\Sanitizer;
use Helpers\Config;

SessionManager::init();

$name = SessionManager::get('name');
$page_title = 'Panel' . Config::get('seo.default_title_suffix');;
require_once(PARTIALS . 'head.php');
?>
    <body class="container d-flex flex-column min-vh-100">
    <header>
        <?php require_once(PARTIALS . 'nav.user.php'); ?>
    </header>

        <div class="row flex-nowrap">
            <?php require_once(PARTIALS . 'aside.user.php'); ?>

            <main class="col p-4 overflow-auto">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center
                  pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Panel informativo de <?php echo Sanitizer::output($name) ?> </h1>
                </div>

                <!-- Widgets rápidos -->
                <div class="row g-3 mb-4">
                    <div class="col">
                        <div class="card text-center">
                            <div class="card-body">
                                <h6 class="card-title">Posts</h6>
                                <p class="fs-4 mb-0"><?= $stats['posts'] ?? 0 ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card text-center">
                            <div class="card-body">
                                <h6 class="card-title">Readlists</h6>
                                <p class="fs-4 mb-0"><?= $stats['lists'] ?? 0 ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card text-center">
                            <div class="card-body">
                                <h6 class="card-title">Comentarios</h6>
                                <p class="fs-4 mb-0"><?= $stats['comments'] ?? 0 ?></p>
                            </div>
                        </div>
                    </div>
                </div>


                <h2 class="h4">Últimos posts</h2>
                <div class="table-responsive small">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Título</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!--                        --><?php //foreach ($recentPosts as $p): ?>
                        <!--                            <tr>-->
                        <!--                                <td>--><?php //= $p['post_id'] ?><!--</td>-->
                        <!--                                <td>-->
                        <?php //= htmlspecialchars($p['title']) ?><!--</td>-->
                        <!--                                <td>--><?php //= $p['created_at'] ?><!--</td>-->
                        <!--                                <td>-->
                        <?php //= $p['is_published'] ? 'Publicado' : 'Borrador' ?><!--</td>-->
                        <!--                            </tr>-->
                        <!--                        --><?php //endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </main>

        </div>

    </body>
<?php require_once(PARTIALS . 'footer.php'); ?>