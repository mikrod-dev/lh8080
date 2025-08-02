<?php
require_once(__DIR__ . '/../../../config/php/paths.php');
require_once(__DIR__ . '/../../../bootstrap/autoload.php');

use Helpers\Config;

$page_title = '403' . Config::get('seo.default_title_suffix');
require_once(PARTIALS . 'head.php');
?>

<body class="d-flex flex-column justify-content-center align-items-center vh-100">

<main class="px-3 text-center">
    <h1>⛔ Error 403</h1>
    <!--TODO: usar Lang-->
    <p class="lead">No tenés permiso para acceder a esta página</p>
    <a href="/" class="btn btn-lg btn-light fw-bold border-white bg-white">Volver</a>
</main>

<?php require_once(PARTIALS . 'footer.php'); ?>

</body>
