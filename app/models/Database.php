<?php
namespace App\Models;

use App\Models\Interfaces\iDatabase;
use App\Models\DatabaseConnection;

class Database implements iDatabase
{
    public $dbConnection;
    private $query;
    
    public function __construct(?string $dbms = null, ?string $host = null, ?string $dbName = null, ?string $login = null, ?string $password = null)
    {
        $dbms = $dbms ?? $_ENV['DEFAULT_DB_CONNECTION'];
        $host = $host ?? $_ENV['DEFAULT_DB_HOST'];
        $dbName = $dbName ?? $_ENV['DATABASE_NAME'];
        $login = $login ?? $_ENV['DB_LOGIN'];
        $password = $password ?? $_ENV['DB_PASSWORD'];
        
        $this->dbConnection = (new DatabaseConnection)->connection($dbms, $host, $dbName, $login, $password);
    }

    /**
	 * SQL query
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
	 * PDO transaction
	 * @param array query, query[0] is a query string and query[1] is a prepare data array
	 * @return void
	 */

    public function transaction(array $queries): void
    {
        $this->dbConnection->beginTransaction();

        foreach ($queries as $query) {
            $this->query = $this->dbConnection->prepare($query[0]);
            $this->query->execute($query[1]);
        }

        $this->dbConnection->commit();
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