<?php

namespace System\Console;

interface CommandInterface
{
    public function execute($subcommand, $params);
}
