<?php

namespace App\Models;

class ApiUserGet extends Model
{
    /**
     * Get user by id
     * @param int user`s id
     * @return string JSON \w user information 
     */

    public function getUserInfo(int $user_id): string
    {
        $user = $this->db->dbQuery("SELECT u.id, u.login, u.email, c.city, n.name, s.surname FROM users AS u
            LEFT JOIN cities AS c ON c.id = u.city_id LEFT JOIN names AS n ON n.id=u.name_id
                LEFT JOIN surnames AS s ON s.id = u.surname_id WHERE u.id = ?", [$user_id])->fetch();

        $userData = array_merge($user, ["link" => "http://{$_SERVER['SERVER_NAME']}/users/{$user['id']}"]);

        return json_encode($userData, JSON_UNESCAPED_UNICODE);
    }

    public function getIdViaToken(string $token): int
    {
        return $this->db->dbQuery("SELECT user_id FROM api_user_tokens WHERE token = ?", [$token])
            ->fetchColumn();
    }
}