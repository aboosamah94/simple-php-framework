<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {

        $cacheKey = 'home_index_data';
        $data = $this->cache->get($cacheKey);

        if ($data === false) {
            $data = [
                'title' => 'Home Page',
                'username' => 'John Doe'
            ];

            $this->cache->save($cacheKey, $data, 600); // Cache for 10 minutes
        }

        $data = [
            'title' => 'Home Page',
            'username' => 'John Doe'
        ];

        return $this->view('home/index', $data);
    }

    // This method handles the about page
    public function about()
    {
        $data = [
            'title' => 'About Page',
            'username' => 'John Doe'
        ];
        
        return $this->view('home/about', $data);
    }
}
