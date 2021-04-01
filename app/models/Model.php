<?php
namespace App\Models;

class Model
{
    protected $db;

    public static function connection()
    {
        try {
            return new \PDO('mysql:host=localhost;dbname=marketplace', 'root', 'root');
        } catch (PDOException $e) {
            echo 'Ошибка: ' . $e->getMessage();
            die();
        }  
    }
}