<?php

namespace App\Models;

use PDO;

class Product extends Model
{
    protected string $table = 'products';

    public function getAll()
    {
        $sql = "SELECT * FROM $this->table ORDER BY id ASC";
        return $this->connect->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByID($id)
    {
        $conn   = $this->connectDB();
        $result = array();

        if ($conn)
        {
            $sql        = "SELECT * FROM ".$this->table." WHERE id = ".$id;
            $resource   = $conn->query($sql);
            $result     = $resource->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result ? $result[0] : array();
    }

    public function insert($data = array())
    {
        $conn   = $this->connectDB();
        $result = false;

        if ($conn)
        {
            $sql = "INSERT INTO {$this->table} (first_name, last_name, email)
                    VALUES (?,?,?)";

            $result = $conn->prepare($sql)->execute([
              $data['first_name'], $data['last_name'], $data['email']
            ]);
        }
        return $result;
    }

    public function update($data)
    {
        $result = false;
        $conn   = $this->connectDB();

        if ($conn) {
            $sql = "UPDATE {$this->table}
                    SET first_name=?, last_name=?, email=?
                    WHERE id=?";
            $result = $conn->prepare($sql)->execute([
                $data['first_name'], $data['last_name'], $data['email'], $data['id']
            ]);
        }

        return $result;
    }

    public function delete($id)
    {
        $conn   = $this->connectDB();
        $result = false;

        if ($conn)
        {
            $sql      = "DELETE FROM {$this->table} WHERE id=?";
            $result   = $conn->prepare($sql)->execute([$id]);
        }

        return $result;
    }
}
