<?php
$page_title = $page_title ?? 'Blog | lh:8080';
require_once(__DIR__ . '/../../../config/php/paths.php');
require_once(HELPERS . 'Sanitizer.php');
use Helpers\Sanitizer;
?>

<!DOCTYPE html>
<html lang="es" class="h-100 m-0 p-0">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
          crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo CSS ?>main.css<?php echo '?v=' . time() ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&family=Syne+Mono&display=swap"
          rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
            crossorigin="anonymous"
            defer></script>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo IMAGES ?>favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo IMAGES ?>favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo IMAGES ?>favicon_io/favicon-16x16.png">
    <link rel="manifest" href="<?php echo IMAGES ?>favicon_io/site.webmanifest">

    <title><?php echo Sanitizer::output($page_title) ?></title>
</head>