<?php

namespace System\Core;

use Exception;

class View
{
    /**
     * Render the view by loading the corresponding template file.
     *
     * @param string $view The name of the view file (without the .php extension)
     * @param array $data An associative array of data to be passed to the view
     * @return string The rendered content from the view
     * @throws Exception If the view file does not exist
     */
    public static function render(string $view, array $data = []): string
    {
        
        // Define the full path to the view file
        $viewFile = APP_PATH . 'Views/' . $view . '.php';

        // Check if the view file exists
        if (file_exists($viewFile)) {
            // Import variables into the local scope, avoid overwriting existing variables
            extract($data, EXTR_SKIP);

            // Start output buffering and require the view file
            ob_start();
            require $viewFile;

            // Get the buffered content and return it
            return ob_get_clean();
        } else {
            // Throw an exception if the view file is not found
            throw new Exception("View '{$view}' not found.");
        }
    }
}