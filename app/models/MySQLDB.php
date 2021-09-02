<?php
namespace App\Models;
use App\Models\Interfaces\iDatabase;

class MySQLDB implements iDatabase
{
    private $query;
    private $dbConnection;
    
    public function __construct($host = 'localhost', $dbName = 'marketplace', $login = 'root', $password = 'root')
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
	 * Non-fiction query. If it hasn`t placeholders, returns show() method.
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

    private function preparedQuery(string $queryString, array $data): \PDOStatement
    {
        $this->query = $this->dbConnection->prepare("$queryString");
        $this->query->execute($data);
        
        return $this->query;
    }

    private function simpleQuery(string $queryString): \PDOStatement
    {
        $this->query = $this->dbConnection->query("$queryString");
        return $this->query;
    }
}