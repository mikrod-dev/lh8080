<?php

namespace Core;

require_once(__DIR__ . '/../../config/php/paths.php');

final class ViewRenderer
{
    public static function render(string $view): void{
        $view_file = PROJECT_ROOT . "/App/Views/$view.php";

        if (!file_exists($view_file)) {
            http_response_code(404);
            echo "View not found: $view";
            return;
        }

        include_once($view_file);
    }

}