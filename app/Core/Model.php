<?php
namespace App\Core;

use App\Core\Database;

class Model
{
    protected $db;
    protected $table;
    protected $allowedFields = [];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $useSoftDeletes = false;

    public function __construct($table)
    {
        $this->table = $table;
        $this->db = (new Database())->getConnection();
    }


    public function findAll()
    {
        $query = "SELECT * FROM {$this->table}";
        return $this->db->query($query)->fetchAll();
    }

    // Fetch a record by its ID
    public function find($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }


    // Method to insert a new record
    public function insert(array $data)
    {
        // Ensure only allowed fields are inserted
        $data = array_intersect_key($data, array_flip($this->allowedFields));

        // If timestamps are enabled, add created and updated fields
        if ($this->useTimestamps) {
            $time = date('Y-m-d H:i:s');
            if (in_array($this->createdField, $this->allowedFields)) {
                $data[$this->createdField] = $time;
            }
            if (in_array($this->updatedField, $this->allowedFields)) {
                $data[$this->updatedField] = $time;
            }
        }

        // Insert query (simplified)
        $columns = implode(',', array_keys($data));
        $values = implode(',', array_map(fn($v) => "'$v'", array_values($data)));
        $query = "INSERT INTO $this->table ($columns) VALUES ($values)";
        return $this->db->query($query);
    }

    // Method to update a record
    public function update($id, array $data)
    {
        // Ensure only allowed fields are updated
        $data = array_intersect_key($data, array_flip($this->allowedFields));

        // If timestamps are enabled, update the updated field
        if ($this->useTimestamps && in_array($this->updatedField, $this->allowedFields)) {
            $data[$this->updatedField] = date('Y-m-d H:i:s');
        }

        // Update query (simplified)
        $set = implode(',', array_map(fn($k, $v) => "$k='$v'", array_keys($data), array_values($data)));
        $query = "UPDATE $this->table SET $set WHERE id = $id";
        return $this->db->query($query);
    }

    // The delete method: handles soft or hard delete based on configuration
    public function delete($id)
    {
        // Check if soft deletes are enabled
        if ($this->useSoftDeletes) {
            // Ensure that the deletedField exists in allowed fields
            if (in_array($this->deletedField, $this->allowedFields)) {
                // Soft delete: update the deleted_at field
                $query = "UPDATE $this->table SET $this->deletedField = NOW() WHERE id = $id";
                return $this->db->query($query);
            }
        } else {
            // Hard delete: permanently remove the record
            $query = "DELETE FROM $this->table WHERE id = $id";
            return $this->db->query($query);
        }

        return false; // Return false if the delete operation was not successful
    }

    // Optional: Restore a soft-deleted record
    public function restore($id)
    {
        if ($this->useSoftDeletes && in_array($this->deletedField, $this->allowedFields)) {
            $query = "UPDATE $this->table SET $this->deletedField = NULL WHERE id = $id";
            return $this->db->query($query);
        }
        return false;
    }
}
