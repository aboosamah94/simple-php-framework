<?php
namespace App\Controllers;

use App\Models\UsersModel;

class UserController extends BaseController
{

    private $User;

    public function __construct()
    {
        $this->User = new UsersModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Home Page',
            'username' => 'John Doe'
        ];

        $data['users'] = $this->User->findAll();

        return $this->view('User/index', $data);
    }

    public function show($id)
    {
        $data = [
            'title' => 'Home Page',
            'username' => 'John Doe'
        ];

        $data['user'] = $this->User->find($id);

        return $this->view('User/show', $data);
    }

}
