<?php

namespace App\Console\Commands;
use App\Console\CommandInterface;

class CreateMigration implements CommandInterface
{
    public function execute($subcommand, $params)
    {
        if (empty($params)) {
            echo "Please specify the migration name.\n";
            return;
        }

        $migrationName = ucfirst($params[0]);
        $filePath = __DIR__ . "/../../Database/Migrations/{$migrationName}.php";

        if (file_exists($filePath)) {
            echo "Migration already exists.\n";
            return;
        }

        $migrationTemplate = "<?php\n\nnamespace App\Database\Migrations;\nuse App\Core\Migration;\n\nclass {$migrationName} extends Migration\n{\n    public function up() {\n        // Add migration logic here\n    }\n\n    public function down() {\n        // Reverse migration logic\n    }\n}\n";

        file_put_contents($filePath, $migrationTemplate);
        echo "Migration {$migrationName} created.\n";
    }
}
