<?php
require_once(__DIR__ . '/../../../config/php/paths.php');
require_once(__DIR__ . '/../../../bootstrap/autoload.php');

use Helpers\Config;

$page_title = 'Blog' . Config::get('seo.default_title_suffix');
require_once(PARTIALS . 'head.php');
?>
<body class="container d-flex flex-column min-vh-100">
<header>
    <?php require_once(PARTIALS . 'nav.user.php'); ?>
</header>
    <?php require_once(PARTIALS . 'content.blog.php'); ?>
</body>
<?php require_once(PARTIALS . 'footer.php'); ?>

