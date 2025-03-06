<?php

namespace App\View;

class View
{
    public static function render($filePath, $data = [], $exit = true): void
    {
        if ($data) {
            extract($data);
        }

        ob_start();
            include base_path("/App/View/{$filePath}.view.php");
        $content = ob_get_clean();

        include_once base_path("/App/View/views/layout.view.php");

        if ($exit) {
            exit;
        }
    }
}