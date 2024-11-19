<?php

namespace System\Console\Commands;
use System\Console\CommandInterface;

class CreateModel implements CommandInterface
{
    public function execute($subcommand, $params)
    {
        if (empty($params)) {
            echo "Please specify the model name.\n";
            return;
        }

        $modelName = ucfirst($params[0]);
        $filePath = __DIR__ . "/../../Models/{$modelName}.php";

        if (file_exists($filePath)) {
            echo "Model already exists.\n";
            return;
        }

        $modelTemplate = "<?php\n\nnamespace App\Models;\n\nuse App\Core\Model;\n\nclass {$modelName} extends Model\n{\n\n protected \$table = '{$modelName}'; // add table name\n protected \$allowedFields = []; // add allowed Fields that can access like 'username', 'name', 'email'\n protected \$useTimestamps = true;\n protected \$createdField = 'created_at'; // Data Created at Field name\n protected \$updatedField = 'updated_at'; // Data Updated at Field name\n protected \$deletedField = 'deleted_at'; // Data Deleted at Field name\n protected \$useSoftDeletes = true; // Enables soft deletes\n\npublic function __construct()\n{\nparent::__construct(\$this->table);\n}\n\n // Add your properties and methods here\n\n}\n";

        file_put_contents($filePath, $modelTemplate);
        echo "Model {$modelName} created.\n";
    }
}
