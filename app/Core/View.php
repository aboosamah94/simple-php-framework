<?php
namespace App\Core;

class View
{
    public static function render($view, $data = [])
    {
        $viewFile = APP_PATH . 'Views/' . $view . '.php';
        if (file_exists($viewFile)) {
            extract($data);
            ob_start();
            require $viewFile;
            $content = ob_get_clean();
            echo $content;
        } else {
            echo "View '{$view}' not found.";
        }
    }
}
