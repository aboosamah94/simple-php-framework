<?php

namespace App\Console\Commands;
use App\Console\CommandInterface;

class CreateSeeder implements CommandInterface
{
    public function execute($subcommand, $params)
    {
        if (empty($params)) {
            echo "Please specify the seeder name.\n";
            return;
        }

        $seederName = ucfirst($params[0]) . "Seeder";
        $filePath = __DIR__ . "/../../Database/Seeds/{$seederName}.php";

        if (file_exists($filePath)) {
            echo "Seeder already exists.\n";
            return;
        }

        $seederTemplate = "<?php\n\nnamespace App\Database\Seeders;\n\nclass {$seederName}\n{\n    public function run()\n    {\n        // Add your seeding logic here\n    }\n}\n";

        file_put_contents($filePath, $seederTemplate);
        echo "Seeder {$seederName} created.\n";
    }
}