<?php

namespace App\Console;

class CommandRunner
{
    public function run(array $args)
    {
        if (count($args) < 2) {
            $this->showHelp();
            return;
        }

        // The first argument is the full command (e.g., 'create::controller')
        $fullCommand = $args[1];

        // Split the command into main command and subcommand
        $commandParts = explode('::', $fullCommand);

        // Ensure the command is in the correct format (mainCommand::subCommand)
        if (count($commandParts) < 2) {
            echo "Invalid command format. Use 'command::subcommand'.\n";
            return;
        }

        $command = $commandParts[0];
        $subcommand = $commandParts[1];

        // Slice the params for the rest of the arguments
        $params = array_slice($args, 2);

        // Dispatch the command correctly
        $this->dispatch($command, $subcommand, $params);
    }

    private function dispatch($command, $subcommand, $params)
    {
        switch ($command) {
            case 'create':
                $this->handleCreateCommand($subcommand, $params);
                break;

            case 'migrate':
                $this->handleMigrateCommand($subcommand, $params);
                break;

            case 'seed':
                $this->handleSeedCommand($subcommand, $params);
                break;

            default:
                echo "Unknown command: {$command}\n";
        }
    }

    private function handleCreateCommand($subcommand, $params)
    {
        // Mapping create subcommands (controller, model, migration, seeder)
        $class = "App\\Console\\Commands\\Create" . ucfirst(strtolower($subcommand));

        if (class_exists($class)) {
            $instance = new $class();
            $instance->execute($subcommand, $params);
        } else {
            echo "Create command not found: {$subcommand}\n";
        }
    }

    private function handleMigrateCommand($subcommand, $params)
    {
        // Mapping migrate subcommands (up, down, refresh, etc.)
        $class = "App\\Console\\Commands\\Migrate" . ucfirst(strtolower($subcommand));

        if (class_exists($class)) {
            $instance = new $class();
            $instance->execute($subcommand, $params);
        } else {
            echo "Migrate command not found: {$subcommand}\n";
        }
    }

    private function handleSeedCommand($subcommand, $params)
    {
        // Mapping seed subcommands (run, reset, etc.)
        $class = "App\\Console\\Commands\\Seed" . ucfirst(strtolower($subcommand));

        if (class_exists($class)) {
            $instance = new $class();
            $instance->execute($subcommand, $params);
        } else {
            echo "Seed command not found: {$subcommand}\n";
        }
    }

    private function showHelp()
    {
        echo "Usage: php simple [command]::[subcommand] [options]\n\n";
        echo "Available commands:\n";
        echo "  create::controller\n";
        echo "  create::model\n";
        echo "  create::migration\n";
        echo "  create::seeder\n";
        echo "*  migrate::up\n";
        echo "*  migrate::down\n";
        echo "*  migrate::refresh\n";
        echo "*  seed::run\n";
        echo "*  seed::reset\n";
    }
}
