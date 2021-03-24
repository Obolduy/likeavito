<?php

class Base
{
    public $db;
    public $result;

    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=larashop', 'root', 'root');
        } catch (PDOException $e) {
            echo 'Ошибка: ' . $e->getMessage();
            die();
        }  
    }

    /**
	 * Taking non fiction query and returning the PDO fetch
	 * @param string SQL query
	 * @return array
	 */

    public function selectQuery(string $query): array
    {
        $this->result = $this->db->query("$query");

        return $this->show($this->result);
    }

    /**
	 * Returning the PDO fetch
	 * @param array PDOObject with data
	 * @return array
	 */

    public function show(PDOStatement $fetch): array
    {
        for ($data = []; $row = $fetch->fetch(); $data[] = $row);

        return $data;
    }

    public function getAll(string $table): array
    {
        if ($table == 'lots') {
            $this->result = $this->db->query("SELECT * FROM $table ORDER BY update_time DESC");
        } else {
            $this->result = $this->db->query("SELECT * FROM $table ORDER BY id DESC");
        }

        return $this->show($this->result);
    }

    public function getTag(string $tag): array
    {
        $this->result = $this->db->query("SELECT lots.id, title, price, description, photo, add_time FROM lots JOIN lots_category 
            ON lots.category_id=lots_category.id WHERE lots_category.name = '$tag' ORDER BY update_time DESC");

        return $this->show($this->result);
    }

    public function getWithout(string $category): array
    {
        if ($category == 'jobs') {
            $this->result = $this->db->query("SELECT * FROM lots WHERE category_id!=8 ORDER BY update_time DESC");
        } else {
            $this->result = $this->db->query("SELECT * FROM lots WHERE category_id=8 ORDER BY update_time DESC");
        }

        return $this->show($this->result);
    }

    /**
	 * Returning the PDO fetch
	 * @param string table name
     * @param string 'where' expression
     * @param string column name
	 * @return array
	 */

    public function getOne(string $table, mixed $what, string $column = 'id'): array
    {
        if ($table == 'lots') {
            $this->result = $this->db->query("SELECT title, price, photo, description, name, add_time FROM $table JOIN lots_category 
                ON lots.category_id=lots_category.id WHERE $table.$column = '$what'"); 
        } else {
            $this->result = $this->db->query("SELECT * FROM $table WHERE $column = '$what'");
        }
        
        return $this->show($this->result);
    }

    public function delete(string $table, int $chosen): void
    {
        $this->result = $this->db->prepare("DELETE * FROM ? WHERE id = ?");
        $this->result->execute($table, $chosen['id']);
    }

    /**
	 * Adding new user into db
	 * @param string login
     * @param string hashed password
     * @param string name
     * @param int user`s city id
	 * @return void
	 */

    public function addUser(string $login, string $password, string $name, int $city_id): void
    {
        $this->result = $this->db->prepare("INSERT INTO users SET name = ?, password = ?, city_id = ?, status_id = 2,
            ban_status = 0, reg_time = NOW(), login = ?");
        $this->result->execute($name, $password, $city_id, $login);
    }

    /**
	 * Adding new lot into db
	 * @param string title
     * @param int price
     * @param string description
     * @param string filename of lot picture
     * @param int lot`s category id
     * @param int user`s id
	 * @return void
	 */

    public function addLot(string $title, int $price, string $description, string $photo, int $category_id, int $owner_id): void
    {
        $this->result = $this->db->prepare("INSERT INTO lots SET owner_id = ?', category_id = ?, title = ?, price = ?, 
            description = ?, photo = ?, add_time = NOW(), update_time = NOW()");
        $this->result->execute($owner_id, $category_id, $title, $price, $description, $photo);
    }

    public function updateLot(string $title, int $price, string $description, string $photo): void
    {
        $this->result = $this->db->prepare("UPDATE lots SET title = ?, price = ?, description = ?, photo = ?, update_time = NOW()");
        $this->result->execute($title, $price, $description, $photo);
    }

    /* Change next two when you will remake views */
    
    public static function getCities()
    {
        $query = "SELECT * FROM cities_avito";
        $result = mysqli_query(mysqli_connect('localhost', 'root', 'root', 'test'), $query) or die(mysqli_error(mysqli_connect('localhost', 'root', 'root', 'test')));
        
        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
        $cities .= "<select name=\"city_id\">";
        foreach ($data as $elem) {
            //$cities .= "<p><input type=\"radio\" name=\"city_id\" value=\"{$elem['id']}\">{$elem['name']}</p>";
            $cities .= "<option value=\"{$elem['id']}\">{$elem['name']}</option>";
        }
        $cities .= "</select>";
        return $cities;
    }

    public static function getCategories()
    {
        $query = "SELECT * FROM lots_category";
        $result = mysqli_query(mysqli_connect('localhost', 'root', 'root', 'test'), $query) or die(mysqli_error(mysqli_connect('localhost', 'root', 'root', 'test')));
        
        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
        $categories .= "<select name=\"category_id\">";
        foreach ($data as $elem) {
            $categories .= "<option value=\"{$elem['id']}\">{$elem['name']}</option>";
        }
        $categories .= "</select>";
        return $categories;
    }
}