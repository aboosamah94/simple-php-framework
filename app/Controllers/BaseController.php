<?php
namespace App\Controllers;

use System\Core\Controller;

class BaseController extends Controller
{
    protected array $helpers = [
        'url'
    ];

    protected array $commonData = [
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