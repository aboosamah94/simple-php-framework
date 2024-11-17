<?php

namespace App\Console\Commands;
use App\Console\CommandInterface;

class CreateController implements CommandInterface
{
    public function execute($subcommand, $params)
    {
        if (empty($params)) {
            echo "Please specify the controller name.\n";
            return;
        }

        $controllerName = ucfirst($params[0]) . "Controller";
        $filePath = __DIR__ . "/../../Controllers/{$controllerName}.php";

        if (file_exists($filePath)) {
            echo "Controller already exists.\n";
            return;
        }

        $controllerTemplate = "<?php\n\nnamespace App\Controllers;\n\nclass {$controllerName} extends BaseController\n{\n\n // Add your methods here\n\n}\n";

        file_put_contents($filePath, $controllerTemplate);
        echo "Controller {$controllerName} created.\n";
    }
}
