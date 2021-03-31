<?php
namespace App\Models;

class Base
{
    public $db;
    public $result;

    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=marketplace', 'root', 'root');
        } catch (PDOException $e) {
            echo 'Ошибка: ' . $e->getMessage();
            die();
        }  
    }

    /**
	 * Taking non fiction select query and returning the PDO fetch.
	 * @param string SQL query
	 * @return array
	 */

    public function selectQuery(string $query): array
    {
        $this->result = $this->db->query("$query");

        return $this->show($this->result);
    }

    /**
	 * Taking non fiction update query and array with query values. Then it makes a query and returns void.
	 * @param string SQL query
	 * @return array
	 */

    public function updateQuery(string $query, array $data): void
    {
        $this->result = $this->db->prepare("$query");
        $this->result->execute($data);
    }

    /**
	 * Returning the PDO fetch.
	 * @param array PDOObject with data
	 * @return array
	 */

    public function show(PDOStatement $fetch): array
    {
        for ($data = []; $row = $fetch->fetch(); $data[] = $row);

        return $data;
    }

    /**
	 * Getting all DB matches (query SELECT). Returning the PDO fetch.
	 * @param string required DB table
	 * @return array
	 */

    public function getAll(string $table): array
    {
        if ($table == 'lots') {
            $this->result = $this->db->query("SELECT * FROM $table ORDER BY update_time DESC");
        } else {
            $this->result = $this->db->query("SELECT * FROM $table ORDER BY id DESC");
        }

        return $this->show($this->result);
    }

    /**
	 * Getting required lot`s tag (query SELECT, JOIN). Returning the PDO fetch.
	 * @param string <- WHERE lots_category.name =
	 * @return array
	 */

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

    public function getOne(string $table, $what, string $column = 'id'): array
    {
        if ($table == 'lots') {
            $this->result = $this->db->query("SELECT title, price, photo, description, name, add_time FROM $table JOIN lots_category 
                ON lots.category_id=lots_category.id WHERE $table.$column = '$what'"); 
        } else {
            $this->result = $this->db->query("SELECT * FROM $table WHERE $column = '$what'");
        }
        
        return $this->show($this->result);
    }

    public function delete(string $table, int $chosen, string $column = 'id'): void
    {
        $this->result = $this->db->prepare("DELETE FROM $table WHERE $column = ?");
        $this->result->execute([$chosen]);
    }

    /**
	 * Adding new user into db
	 * @param string login
     * @param string hashed password
     * @param string name
     * @param int user`s city id
	 * @return void
	 */

    public function addUser(string $login, string $password, string $email, int $city_id): void
    {
        $this->result = $this->db->prepare("INSERT INTO users SET email = ?, password = ?, city_id = ?, status_id = 1,
            ban_status = 0, active = 0, registration_time = NOW(), login = ?");
        $this->result->execute([$email, $password, $city_id, $login]);
    }

    /**
	 * Adding data into names\surnames tables and updating users table
	 * @param string name
     * @param string surnames
     * @param int user`s id
	 * @return void
	 */

    public function addUserInfo(string $name, string $surname, int $user_id): void
    {
        $this->result = $this->db->prepare("INSERT INTO names SET name = ?, user_id = ?");
        $this->result->execute([$name, $user_id]);

        $this->result = $this->db->prepare("INSERT INTO surnames SET surname = ?, user_id = ?");
        $this->result->execute([$surname, $user_id]);

        $data = $this->getOne('names', $user_id, 'user_id');
        
        foreach ($data as $elem) {
            $this->updateQuery("UPDATE users SET name_id = ? WHERE id = ?", [$elem['id'], $user_id]);
        }

        $data = $this->getOne('surnames', $user_id, 'user_id');

        foreach ($data as $elem) {
            $this->updateQuery("UPDATE users SET surname_id = ? WHERE id = ?", [$elem['id'], $user_id]);
        }
    }

    /**
	 * Adding new lot into db
	 * @param string title
     * @param int price
     * @param string description
     * @param string filename of lot picture or NULL
     * @param int lot`s category id
     * @param int user`s id
	 * @return void
	 */

    public function addLot(string $title, int $price, string $description, int $category_id, int $owner_id): void
    {
        $this->result = $this->db->prepare("INSERT INTO lots SET owner_id = ?', category_id = ?, title = ?, price = ?, 
            description = ?, add_time = NOW(), update_time = NOW()");
        $this->result->execute([$_SESSION['user']['id'], $category_id, $title, $price, $description]);
    }

    public function updateLot(string $title, int $price, string $description, int $lot_id): void
    {
        $this->result = $this->db->prepare("UPDATE lots SET title = ?, price = ?, description = ?, update_time = NOW()
            WHERE id = ?");
        $this->result->execute([$title, $price, $description, $photo, $lot_id]);
    }

    /**
	 * Adding lot`s pictures (if they are exists).
	 * @param string hashed name of picture
     * @param int lot id
	 * @return void
	 */

    public function addLotPictures(string $picture, int $id): void
    {
        $this->result = $this->db->prepare("INSERT INTO lots_pictures SET lot_id = ?, picture = ?");
        $this->result->execute([$id, $picture]);
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