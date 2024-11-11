<?php

namespace App\Core;

use App\Core\View;
use App\Core\EmailService;

class Controller
{
    protected $emailService;
    protected $helpers = [];
    protected $commonData = [];

    // Constructor to load helpers automatically and other initialization
    public function __construct()
    {
        $this->loadHelpers();
        $this->emailService = new EmailService();
    }

    // Automatically load the helpers defined in the child controller
    protected function loadHelpers()
    {
        if (!empty($this->helpers)) {
            foreach ($this->helpers as $helper) {
                $helperFile = APP_PATH . 'Helpers/' . $helper . '_helper.php';

                if (file_exists($helperFile)) {
                    require_once $helperFile;
                } else {
                    error_log('Helper file ' . $helper . ' not found.');
                }
            }
        }
    }

    // Allow loading a single helper dynamically
    public function helper($helper)
    {
        $helperFile = APP_PATH . 'Helpers/' . $helper . '_helper.php';
        if (file_exists($helperFile)) {
            require_once $helperFile;
        } else {
            error_log('Helper file ' . $helper . ' not found.');
        }
    }

    // View rendering method with common data merged into the provided data
    public function view($view, $data = [])
    {
        $data = array_merge($this->commonData, $data);

        return View::render($view, $data);
    }
}
