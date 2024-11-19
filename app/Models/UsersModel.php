<?php

namespace App\Models;

use System\Core\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'name', 'email'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $useSoftDeletes = true;  // Enables soft deletes

    public function __construct()
    {
        parent::__construct($this->table);
    }
}
