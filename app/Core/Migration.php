<?php

namespace App\Core;
use App\Core\Database;

class Migration
{
    protected $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

}