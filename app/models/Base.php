<?php
namespace App\Models;

class Base
{
    public $db;
    public $result;

    public function __construct()
    {
        try {
            $this->db = new \PDO('mysql:host=localhost;dbname=marketplace', 'root', 'root');
        } catch (PDOException $e) {
            echo 'Ошибка: ' . $e->getMessage();
            die();
        }  
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