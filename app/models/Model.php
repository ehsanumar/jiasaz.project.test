<?php

namespace App\Models;

use PDO;
use PDOException;

class Model
{
    protected string $table;
    protected PDO $connect;

    public function __construct()
    {
        try {
            $env = parse_ini_file('.env');

            $this->connect = new PDO(
                "mysql:host={$env['DB_HOST']};dbname={$env['DB_NAME']}",
                $env['DB_USER'],
                $env['DB_PASSWORD']
            );
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }
}
