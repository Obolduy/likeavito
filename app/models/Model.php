<?php
namespace App\Models;

class Model
{
    protected $db;

    public function __construct()
    {
        try {
            $this->db = new \PDO('mysql:host=localhost;dbname=marketplace', 'root', 'root');
        } catch (PDOException $e) {
            echo 'Ошибка: ' . $e->getMessage();
            die();
        }  
    }

    public static function connection()
    {
        try {
            return new \PDO('mysql:host=localhost;dbname=marketplace', 'root', 'root');
        } catch (PDOException $e) {
            echo 'Ошибка: ' . $e->getMessage();
            die();
        }  
    }

    /**
	 * Returning the PDO fetch
	 * @param string table name
     * @param string 'where' expression
     * @param string column name
	 * @return array
	 */

    public function getOne(string $table, $what, string $column = 'id'): array
    {
        if ($table == 'lots') {
            $query = $this->db->query("SELECT title, price, photo, description, name, add_time FROM $table JOIN lots_category 
                ON lots.category_id=lots_category.id WHERE $table.$column = '$what'"); 
        } else {
            $query = $this->db->query("SELECT * FROM $table WHERE $column = '$what'");
        }
        
        return $this->show($query);
    }

    /**
	 * Returning the PDO fetch.
	 * @param array PDOObject with data
	 * @return array
	 */

    protected function show(\PDOStatement $fetch): array
    {
        for ($data = []; $row = $fetch->fetch(); $data[] = $row);

        return $data;
    }

    public function delete(string $table, $chosen, string $column = 'id'): void
    {
        $this->result = $this->db->prepare("DELETE FROM $table WHERE $column = ?");
        $this->result->execute([$chosen]);
    }

    public function update(string $query, array $data): void
    {
        $query = $this->db->prepare("$query");
        $query->execute($data);
    }
}