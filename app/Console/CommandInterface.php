<?php

namespace App\Console;

interface CommandInterface
{
    public function execute($subcommand, $params);
}
