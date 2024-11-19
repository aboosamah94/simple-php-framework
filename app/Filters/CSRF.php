<?php

namespace App\Filters;

use App\Libraries\CSRF as CSRFProtection;

class CSRF
{
    private $csrf;

    public function __construct()
    {
        $this->csrf = new CSRFProtection();
    }

    public function before()
    {
        // For POST requests, we need to validate the CSRF token
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate the CSRF token
            if (!$this->csrf->validate('csrf_token')) {
                // CSRF token is invalid, handle error (throw exception, show error message, etc.)
                echo "CSRF token is invalid!";
                exit;  // Optionally, redirect or handle this more gracefully
            }
        }

        // Generate the CSRF token input for use in forms
        // You can echo or return the token in your views to include it in the forms
        $_SESSION['csrf_token'] = $this->csrf->input('csrf_token');  // Store the generated token in session
    }
}