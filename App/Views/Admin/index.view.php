<?php
require_once(__DIR__ . '/../../../config/php/paths.php');
require_once(__DIR__ . '/../../../bootstrap/autoload.php');

use Helpers\Config;

$page_title = 'Inicio' . Config::get('seo.default_title_suffix');
require_once(PARTIALS . 'head.php');
?>
<body class="container d-flex flex-column min-vh-100">
<header>
    <?php require_once(PARTIALS . 'nav.admin.php'); ?>
</header>
    <?php require_once(PARTIALS . 'hero.php'); ?>
</body>
<?php require_once(PARTIALS . 'footer.php'); ?>