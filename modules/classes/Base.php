<?php

class Base
{
    public $dbHost;
    public $dbUser;
    public $dbPassword;
    public $dbName;
    public $link;
    public $query;
    public $result;

    public function __construct($dbHost, $dbUser, $dbPassword, $dbName)
    {
        $this->dbHost = $dbHost;
        $this->dbUser = $dbUser;
        $this->dbPassword = $dbPassword;
        $this->dbName = $dbName;

        $this->link = mysqli_connect($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);
    }

    public function getAll($table)
    {
        if ($table == 'lots') {
            $this->query = "SELECT * FROM $table ORDER BY update_time DESC";
        } else {
            $this->query = "SELECT * FROM $table ORDER BY id DESC";
        }
        $this->result = mysqli_query($this->link, $this->query) or die(mysqli_error($this->link));

        return $this;
    }

    public function getTag($tag)
    {
        $this->query = "SELECT lots.id, title, price, description, photo, add_time FROM lots JOIN lots_category 
            ON lots.category_id=lots_category.id WHERE lots_category.name='$tag' ORDER BY update_time DESC";
        $this->result = mysqli_query($this->link, $this->query) or die(mysqli_error($this->link));

        return $this;
    }

    public function getWithout($category)
    {
        if ($category == 'jobs') {
            $this->query = "SELECT * FROM lots WHERE category_id!=8 ORDER BY update_time DESC";
        } else {
            $this->query = "SELECT * FROM lots WHERE category_id=8 ORDER BY update_time DESC";
        }
        $this->result = mysqli_query($this->link, $this->query) or die(mysqli_error($this->link));

        return $this;
    }

    public function showAll()
    {
        for ($data = []; $row = mysqli_fetch_assoc($this->result); $data[] = $row);

        return $data;
    }

    public function getOne($table, $what, $column = 'id')
    {
        if ($table == 'lots') {
            $this->query = "SELECT title, price, photo, description, name, add_time FROM $table JOIN lots_category 
                ON lots.category_id=lots_category.id WHERE $table.$column = '$what'"; 
        } else {
            $this->query = "SELECT * FROM $table WHERE $column = '$what'";
        }
        $this->result = mysqli_query($this->link, $this->query) or die(mysqli_error($this->link));
        
        return mysqli_fetch_assoc($this->result);
    }

    public function delete($table, $chosen)
    {
        $this->query = "DELETE * FROM '$table' WHERE id = '{$chosen['id']}'";
        $this->result = mysqli_query($this->link, $this->query) or die(mysqli_error($this->link));
    }

    public function addUser($login, $password, $name, $city_id)
    {
        $this->query = "INSERT INTO users SET name='$name', password='$password', city_id='$city_id', status_id=2,
            ban_status=0, reg_time=NOW(), login='$login'";
        $this->result = mysqli_query($this->link, $this->query) or die(mysqli_error($this->link));
    }

    public function addLot($title, $price, $description, $photo, $category_id, $owner_id)
    {
        $this->query = "INSERT INTO lots SET owner_id='$owner_id', category_id='$category_id', title='$title', price='$price', 
            description='$description', photo='$photo',
                add_time=NOW(), update_time=NOW()";
        $this->result = mysqli_query($this->link, $this->query) or die(mysqli_error($this->link));
    }

    public function updateLot()
    {
        //fdfsfdsfseffefefefew
    }

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