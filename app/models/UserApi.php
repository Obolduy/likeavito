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

        foreach ($dataArray as $elem) {
            $userData[] = ["id" => $elem['id'], "login" => $elem['login'], "name" => $elem['name'],
                "surname" => $elem['surname'], "city" => $elem['city'], "link" => "http://likeavito/users/{$elem['id']}"];
        }

        return $this->showJson($userData);
    }

    public function userLogin(string $login, string $password): string
    {
        $query = $this->db->query("SELECT id, login, password FROM users WHERE login = \"$login\"");
        $dataArray = $this->show($query);

        foreach ($dataArray as $elem) {
            if (password_verify($password, $elem['password'])) {
                if ($this->checkApiToken($elem['id'])) {
                    return json_encode(['Success!' => 'You are logged in']); 
                } else {
                    return $this->setUserApiToken($login, $elem['id']);
                }
            }
        }
    }

    private function checkApiToken(int $user_id): bool
    {
        $query = $this->db->query("SELECT token, actual_from FROM api_user_tokens WHERE user_id = $user_id");
        $dataArray = $this->show($query);

        if ($dataArray == null || $dataArray[0]['token'] == null) {
            return false;
        } else {
            setcookie('api_token', $dataArray[0]['token'], time()+2678400);
            return true;
        }
    }

    private function setUserApiToken(string $login, int $user_id): string
    {
        $token = md5($login . time());

        $query = $this->db->prepare("INSERT INTO api_user_tokens SET token = ?, user_id = ?, actual_from = now()");
        $query->execute([$token, $user_id]);

        setcookie('api_token', $elem['token'], time()+2678400);

        return json_encode(['Success!' => 'You are logged in']); 
    }
}