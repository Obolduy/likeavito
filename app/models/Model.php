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

    public function getOne(string $table, $what, string $column = 'id', array $limit = [0, 1000]): array
    {
        $query = $this->db->query("SELECT * FROM $table WHERE $column = \"$what\" LIMIT $limit[0], $limit[1]");

        if ($query === false) {
            throw new \Exception('Data not found');
        }
        
        return $this->show($query);
    }

    /**
	 * Returning the PDO fetch of whole table
	 * @param string table name
	 * @return array
	 */

    public function getAll(string $table): array
    {
        $query = $this->db->query("SELECT * FROM $table");

        if ($query === false) {
            throw new \Exception('Data not found');
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

    public function getTableCount(string $table, $what, string $column = 'id'): array
    {
        $query = $this->db->query("SELECT COUNT(*) FROM $table WHERE $column = \"$what\"");

        if ($query === false) {
            throw new \Exception('Data not found');
        }
        
        return $this->show($query);
    }
}