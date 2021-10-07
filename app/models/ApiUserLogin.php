<?php

namespace App\Models;

class ApiUserLogin extends Model
{
    /**
     * Create API access for user
     * @param string user`s login
     * @param string user`s password
     * @return string|bool JSON \w information or true\false if it`s first time sign in
     */

    public function userLogin(string $login, string $password): string
    {
        $user = $this->db->dbQuery("SELECT id, login, password FROM users WHERE login = ?", [$login])->fetch();

        if (password_verify($password, $user['password'])) {
            if ($this->checkApiToken($user['id'])) {
                return json_encode(['Success!' => 'You are logged in']); 
            } else {
                return $this->setUserApiToken($login, $user['id']);
            }
        } else {
            return json_encode(['Error!' => 'Wrong password']);
        }
    }

    /**
     * Check user`s token by id
     * @param int user`s id
     * @return bool 
     */

    private function checkApiToken(int $userId): bool
    {
        $data = $this->db->dbQuery("SELECT token, actual_from FROM api_user_tokens WHERE user_id = ?",
            [$userId])->fetch();

        if ($data == null || $data['token'] == null) {
            return false;
        } else {
            setcookie('api_token', $data['token'], time()+2678400);

            return true;
        }
    }

    /**
     * Set user API Token
     * @param string login
     * @param int user`s id
     * @return string JSON \w user information 
     */

    private function setUserApiToken(string $login, int $userId): string
    {
        $token = md5($login . time());

        $this->db->dbQuery("INSERT INTO api_user_tokens SET token = ?, user_id = ?, actual_from = now()", [$token, $userId]);

        setcookie('api_token', $token, time()+2678400);

        return json_encode(['Success!' => 'You are logged in']); 
    }
}