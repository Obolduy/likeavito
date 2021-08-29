<?php
namespace App\Models;

class Database
{
    public $joinData;
    private $dbConnection;
    
    public function __construct($host = 'localhost', $dbName = 'marketplace', $login = 'root', $password = 'root')
    {
        try {
            $this->dbConnection = new \PDO("mysql:host=$host;dbname=$dbName", $login, $password);
        } catch (PDOException $e) {
            echo 'Ошибка: ' . $e->getMessage();
            die();
        }
    }

    /**
	 * Takes table`s name and associative array \w placeholders and inserts it into the table
	 * @param string table name
     * @param array data with placeholders and values
	 * @return void
	 */

    public function insert(string $table, array $data): void
    {
        $queryValues = $this->prepareQueryValues($data);

        $query = $this->dbConnection->prepare("INSERT INTO $table SET $queryValues");
        $query->execute(array_values($data));
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
        $query = $this->dbConnection->query("SELECT * FROM $table WHERE $column = \"$what\" LIMIT $limit[0], $limit[1]");

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
            $query = $this->dbConnection->query("SELECT * FROM $table LIMIT $limit[0], $limit[1]");
        } else {
            $query = $this->dbConnection->query("SELECT * FROM $table ORDER BY id DESC LIMIT $limit[0], $limit[1]");
        }

        if ($query === false) {
            throw new \Exception('Data not found');
        }
        
        return $this->show($query);
    }

    public function delete(string $table, $chosen, string $column = 'id'): void
    {
        $query = $this->dbConnection->prepare("DELETE FROM $table WHERE $column = ?");
        $query->execute([$chosen]);
    }

    public function update(string $table, array $data, array $where): void
    {
        $queryValues = $this->prepareQueryValues($data);

        $whereField = key($where);
        $data[$whereField] = current($where);

        $query = $this->dbConnection->prepare("UPDATE $table SET $queryValues, updated_at = now() WHERE $whereField = ?");
        $query->execute(array_values($data));
    }

    /**
     * Join tables. Type of join are chosing via $param. Default it is null.
	 * @param string param \w type of join
	 * @return array
	 */

    public function join(string $param = NULL): array
    {
        $param = strtoupper($param);

        // Для удобства переводим в переменные
        $selectArray = $this->joinData['select'];
        $tablesArray = $this->joinData['tables'];
        $whereArray = $this->joinData['where'];

        // Записываем таблицу, к которой джойним остальные
        $mainTable = array_shift($tablesArray);

        $joinArray = [];
        foreach ($this->joinData['joinOn'] as $elem) {
            $joinArray[] = "$elem[0] = $elem[1]";
        }

        // Циклом проходим по массиву таблиц и джойним их (Одинаковым способом, переданным параметром)
        $joinString = '';
        for ($i = 0; $i <= count($tablesArray) - 1; $i++) {
            $joinString .= "$param JOIN {$tablesArray[$i]} ON {$joinArray[$i]} ";
        }

        $selectString = implode(',', $selectArray);
        $whereString = implode($whereArray);

        $query = $this->dbConnection->query("SELECT $selectString FROM $mainTable $joinString WHERE $whereString");
        return $this->show($query);
    }

    /**
	 * ['users.id', 'names.name', 'cities.city'], ['users', 'names', 'cities'], ['users.id', '=', '69'], [['users.id', 'names.user_id'], ['users.city_id', 'cities.id']]
	 * @param array array with selected params 
     * @param array selected tables
     * @param array 'where' like in laravel
     * @param array array with arrays to join on
	 */

    public function prepareJoin(array $selectQuery, array $tables, array $whereQuery, array $joinOn)
    {
        $this->joinData = ['select' => $selectQuery, 'tables' => $tables, 'where' => $whereQuery, 'joinOn' => $joinOn];
        return $this;
    }

    public function rawQuery(string $query, array $prepareData = NULL)
    {
        if ($prepareData) {
            return $this->prepareQuery($query, $prepareData);
        }
        
        return $this->simpleQuery($query);
    }

    public function getTableCount(string $table, $what, string $column = 'id'): array
    {
        $query = $this->dbConnection->query("SELECT COUNT(*) FROM $table WHERE $column = \"$what\"");

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

    /**
	 * Takes the associative array and return SQL string like key=?
	 * @param array associative array where key is DB`s field and value is the DB value
	 * @return string like key=?
	 */

    private function prepareQueryValues(array $queryArray): string
    {
        $queryValues = '';

        foreach ($queryArray as $key => $value) {
            $queryValues .= "$key = ?,";
        }

        $queryValuesArray = str_split($queryValues);
        array_pop($queryValuesArray);

        return implode($queryValuesArray);
    }

    private function prepareQuery(string $queryString, array $data)
    {
        $query = $this->dbConnection->prepare("$queryString");
        $query->execute($data);
        
        return true;
    }

    private function simpleQuery(string $queryString)
    {
        $query = $this->dbConnection->query("$queryString");
        return $this->show($query);
    }
}