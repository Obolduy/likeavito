<?php
namespace App\Models;

class Database
{
    private $db;
    
    public function __construct($host = 'localhost', $dbName = 'marketplace', $login = 'root', $password = 'root')
    {
        try {
            $this->db = new \PDO("mysql:host=$host;dbname=$dbName", $login, $password);
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
     * @param array limit
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
     * @param array limit
     * @param bool desc
	 * @return array
	 */

    public function getAll(string $table, array $limit = [0, 1000], bool $desc = false): array
    {
        if ($desc == false) {
            $query = $this->db->query("SELECT * FROM $table LIMIT $limit[0], $limit[1]");
        } else {
            $query = $this->db->query("SELECT * FROM $table ORDER BY id DESC LIMIT $limit[0], $limit[1]");
        }
        

        if ($query === false) {
            throw new \Exception('Data not found');
        }
        
        return $this->show($query);
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

    /**
	 * Returning the PDO fetch.
	 * @param array PDOObject with data
	 * @return array
	 */

    private function show(\PDOStatement $fetch): array
    {
        for ($data = []; $row = $fetch->fetch(); $data[] = $row);

        return $data;
    }
}