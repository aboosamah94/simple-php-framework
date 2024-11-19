<?php

namespace App\Controllers;

use App\Models\UsersModel;

class UserController extends BaseController
{
    private $User;

    public function __construct()
    {
        parent::__construct();
        $this->User = new UsersModel();
    }

    public function index()
    {
        // Fetch all users from the model
        $data = [
            'title' => 'Home Page',
            'username' => 'John Doe',
            'users' => $this->User->findAll()
        ];

        // Return the view with the users data
        return $this->view('User/index', $data);
    }

    public function show($id)
    {
        // Fetch a single user by ID
        $data = [
            'title' => 'User Details',
            'username' => 'John Doe',
            'user' => $this->User->find($id)
        ];

        // Return the view with the user data
        return $this->view('User/show', $data);
    }
}