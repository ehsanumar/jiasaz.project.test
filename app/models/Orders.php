<?php

namespace App\Models;

use PDO;

class Orders extends Model
{
    protected string $table = 'orders';

    public function getAll(): false|array
    {
        $sql = "SELECT $this->table.*, Products.name AS product_name
FROM Orders
JOIN Products ON Orders.product_id = Products.id
ORDER BY Orders.id ASC;";
        return $this->connect->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($data = []): bool
    {
        $sql = "INSERT INTO $this->table (`username`, `product_id`) VALUES (?,?)";

        return $this->connect->prepare($sql)->execute([
            $data['username'], $data['product_id']
        ]);
    }

    public function update($data): bool
    {
        $sql = "UPDATE {$this->table} SET status=?  WHERE id=?";
        return $this->connect->prepare($sql)->execute([
            $data['status'], $data['id']
        ]);
    }

    public function delete($id)
    {
            $sql      = "DELETE FROM {$this->table} WHERE id=?";
            $result   = $this->connect->prepare($sql)->execute([$id]);

    }
}