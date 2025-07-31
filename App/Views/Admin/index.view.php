<?php
$page_title = 'Inicio | lh:8080';
require_once(__DIR__ . '/../../../config/php/paths.php');
require_once(PARTIALS . 'header.php');
?>
<body class="container d-flex flex-column min-vh-100">
<header>
    <?php require_once(PARTIALS . 'nav.admin.php'); ?>
</header>
    <?php require_once(PARTIALS . 'hero.php'); ?>
</body>
<?php require_once(PARTIALS . 'footer.php'); ?>