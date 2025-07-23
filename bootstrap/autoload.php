<?php
// Autoloader para simplificar los require a clases
spl_autoload_register(
    function ($class) {
        $base_dir = dirname(__DIR__) . '/App/';
        $class_path = str_replace('\\', '/', $class);
        $file = $base_dir . $class_path . '.php';

        if (file_exists($file)) {
            require_once($file);
        } else {
            error_log("Clase $class no encontrada. (ruta esperada: $file)");
        }
    }
);