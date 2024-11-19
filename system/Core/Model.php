<?php
namespace System\Core;

use PDO;
use System\Core\Database;

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

    public function __construct(string $table)
    {
        $this->table = $table;
        $this->db = (new Database())->getConnection();
    }

    /**
     * Find all records in the table
     *
     * @return array
     */
    public function findAll(): array
    {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Find a record by its ID
     *
     * @param int $id
     * @return array|false
     */
    public function find(int $id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Insert a new record
     *
     * @param array $data
     * @return bool
     */
    public function insert(array $data): bool
    {
        // Ensure only allowed fields are inserted
        $data = array_intersect_key($data, array_flip($this->allowedFields));

        // Add timestamps if enabled
        if ($this->useTimestamps) {
            $time = date('Y-m-d H:i:s');
            if (in_array($this->createdField, $this->allowedFields)) {
                $data[$this->createdField] = $time;
            }
            if (in_array($this->updatedField, $this->allowedFields)) {
                $data[$this->updatedField] = $time;
            }
        }

        // Prepare the INSERT query
        $columns = implode(',', array_keys($data));
        $placeholders = implode(',', array_fill(0, count($data), '?'));
        $query = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";

        // Prepare and execute the statement
        $stmt = $this->db->prepare($query);
        return $stmt->execute(array_values($data));
    }

    /**
     * Update a record by its ID
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        // Ensure only allowed fields are updated
        $data = array_intersect_key($data, array_flip($this->allowedFields));

        // Add updated timestamp if enabled
        if ($this->useTimestamps && in_array($this->updatedField, $this->allowedFields)) {
            $data[$this->updatedField] = date('Y-m-d H:i:s');
        }

        // Prepare the UPDATE query
        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "$key = ?";
        }
        $setString = implode(',', $set);
        $query = "UPDATE {$this->table} SET $setString WHERE id = ?";

        // Prepare and execute the statement
        $stmt = $this->db->prepare($query);
        return $stmt->execute(array_merge(array_values($data), [$id]));
    }

    /**
     * Delete a record by its ID
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        if ($this->useSoftDeletes) {
            // Soft delete: Update the deleted_at field
            if (in_array($this->deletedField, $this->allowedFields)) {
                $query = "UPDATE {$this->table} SET {$this->deletedField} = NOW() WHERE id = ?";
                $stmt = $this->db->prepare($query);
                return $stmt->execute([$id]);
            }
        } else {
            // Hard delete: Remove the record from the database
            $query = "DELETE FROM {$this->table} WHERE id = ?";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([$id]);
        }
        return false;
    }

    /**
     * Restore a soft-deleted record
     *
     * @param int $id
     * @return bool
     */
    public function restore(int $id): bool
    {
        if ($this->useSoftDeletes && in_array($this->deletedField, $this->allowedFields)) {
            $query = "UPDATE {$this->table} SET {$this->deletedField} = NULL WHERE id = ?";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([$id]);
        }
        return false;
    }

    /**
     * Begin a database transaction
     */
    public function beginTransaction(): void
    {
        $this->db->beginTransaction();
    }

    /**
     * Commit a database transaction
     */
    public function commit(): void
    {
        $this->db->commit();
    }

    /**
     * Rollback a database transaction
     */
    public function rollback(): void
    {
        $this->db->rollBack();
    }
}