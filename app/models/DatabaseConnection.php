<?php
namespace App\Models;

class DatabaseConnection
{
    public function connection(string $dbms, string $host, string $dbName, string $login, string $password): \PDO
    {
        $dbms = strtolower($dbms);

        return new \PDO("$dbms:host=$host;dbname=$dbName", $login, $password,
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES   => false
            ]
        );
    }
}