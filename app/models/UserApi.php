<?php
namespace App\Models;

class UserApi extends ModelApi
{
    public function __construct()
    {
        $this->db = self::connection();
    }

    public function getUserInfo(int $user_id)
    {
        $query = $this->db->query("SELECT u.id, u.login, u.email, c.city, n.name, s.surname FROM users AS u
            LEFT JOIN cities AS c ON c.id = u.city_id
                LEFT JOIN names AS n ON n.id=u.name_id
                    LEFT JOIN surnames AS s ON s.id = u.surname_id WHERE u.id = $user_id");
                    
        $dataArray = $this->show($query);

        foreach($dataArray as $elem) {
            $userData[] = ["id" => $elem['id'], "login" => $elem['login'], "name" => $elem['name'],
                "surname" => $elem['surname'], "city" => $elem['city'], "link" => "http://likeavito/users/{$elem['id']}"];
        }

        return $this->showJson($userData);
    }
}