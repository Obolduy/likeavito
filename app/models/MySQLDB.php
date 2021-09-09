<?php
namespace App\Models;

use App\Models\Interfaces\iDatabase;

class MySQLDB implements iDatabase
{
    public $dbConnection;
    private $query;
    
    public function __construct($host = 'localhost', $dbName = 'marketplace', $login = 'root', $password = 11111111)
    {
        $this->dbConnection = new \PDO(
            "mysql:host=$host;dbname=$dbName", $login, $password,
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES   => false
            ]
        );
    }

    /**
	 * SQL query into MySQL DB
	 * @param array query string
     * @param array placeholders
	 * @return \PDOStatement
	 */

    public function dbQuery(string $queryString, array $prepareData = NULL): \PDOStatement
    {
        if ($prepareData) {
            return $this->preparedQuery($queryString, $prepareData);
        }
        
        return $this->simpleQuery($queryString);
    }

    /**
	 * SQL prepared query
	 * @param array query string
     * @param array array with placeholders
	 * @return \PDOStatement
	 */

    private function preparedQuery(string $queryString, array $data): \PDOStatement
    {
        $this->query = $this->dbConnection->prepare("$queryString");
        $this->query->execute($data);
        
        return $this->query;
    }

    /**
	 * Simple SQL query
	 * @param array query string
	 * @return \PDOStatement
	 */

    private function simpleQuery(string $queryString): \PDOStatement
    {
        $this->query = $this->dbConnection->query("$queryString");
        return $this->query;
    }
}