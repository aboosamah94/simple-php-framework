<?php
namespace App\Controllers;

use App\Core\Controller;

class BaseController extends Controller
{

    // Helpers
    // in controller $this->helper('url'); or protected $helpers = ['url', 'form'];
    // You can add default helpers here, like 'url', 'form', etc.
    protected $helpers = [
        'url',
    ];

    // Optionally, you can add common variables that should be available in all views
    protected $commonData = [
        'siteName' => 'My Website',
        'year' => null
    ];

    public function __construct()
    {
        parent::__construct();

        if ($this->commonData['year'] === null) {
            $this->commonData['year'] = date('Y');
        }
    }
}
