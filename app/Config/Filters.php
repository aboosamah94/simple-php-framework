<?php

namespace App\Config;

use App\Filters\CSRF;

class Filters
{
    // Define filter aliases
    public array $aliases = [
        'csrf' => CSRF::class,
    ];

    // Global filters
    public array $globals = [
        'before' => [
            'csrf',  // Apply CSRF filter globally before any route
        ],
        'after' => [],
    ];

    // Route-specific filters (empty in this case)
    public array $filters = [];
}
