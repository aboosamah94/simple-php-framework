<?php

namespace System\Core;

use System\Core\View;
use System\Core\EmailService;
use System\Core\Cache;

class Controller
{
    protected EmailService $emailService;
    protected Cache $cache;
    protected array $helpers = [];
    protected array $commonData = [];

    public function __construct(
        EmailService $emailService = null,
        Cache $cache = null
    ) {
        // If no email service is provided, create a new instance
        $this->emailService = $emailService ?? new EmailService();

        // If no cache service is provided, create a new instance
        $this->cache = $cache ?? new Cache();

        $this->loadHelpers();
    }


    protected function loadHelpers(): void
    {
        foreach ($this->helpers as $helper) {
            $this->helper($helper);
        }
    }

    // one use example inside controller $this->helper('url');
    public function helper(string $helper): void
    {
        $helperLocations = [
            APP_PATH . 'Helpers/' . $helper . '_helper.php',
            APP_PATH . 'helpers/' . $helper . '_helper.php',
            APP_PATH . 'Helpers/' . ucfirst($helper) . '_helper.php',
            APP_PATH . 'helpers/' . ucfirst($helper) . '_helper.php'
        ];

        foreach ($helperLocations as $helperFile) {
            if (file_exists($helperFile)) {
                require_once $helperFile;
                return;
            }
        }

        error_log("Helper file {$helper} not found in any of the expected locations.");
    }

    public function view(string $view, array $data = []): string
    {
        $data = array_merge($this->commonData, $data);
        $renderedContent = View::render($view, $data);
        echo $renderedContent;
        return $renderedContent;
    }

    public function setCommonData(array $data): void
    {
        $this->commonData = $data;
    }

    public function clearCommonData(): void
    {
        $this->commonData = [];
    }
}