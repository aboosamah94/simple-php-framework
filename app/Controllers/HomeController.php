<?php
namespace App\Controllers;

class HomeController extends BaseController
{
    // This method handles the home page
    public function index()
    {
        $data = [
            'title' => 'Home Page',
            'username' => 'John Doe'
        ];

        return $this->view('home/index', $data);
    }

    // This method handles the about page
    public function about()
    {
        echo "This is the About Page.";
    }
}
