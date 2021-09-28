<?php
namespace App\Models;

class UserGet extends Model
{
    public function getAllUsers() 
    {
        return $this->db->dbQuery("SELECT u.id, u.login, u.email, u.avatar, n.name,
            s.surname, c.city, u.city_id, u.registration_time, u.ban_status, u.active, u.status_id
                FROM users AS u LEFT JOIN names AS n ON u.id = n.user_id
                    LEFT JOIN surnames AS s ON u.id = s.user_id LEFT JOIN cities AS c
                        ON c.id = u.city_id")->fetchAll();
    }

    public function getUser(int $userId) 
    {
        return $this->db->dbQuery("SELECT u.id, u.login, u.email, u.avatar, n.name, u.active,
            s.surname, c.city, u.city_id, u.registration_time, u.ban_status, u.active, u.status_id
                FROM users AS u LEFT JOIN names AS n ON u.id = n.user_id
                    LEFT JOIN surnames AS s ON u.id = s.user_id LEFT JOIN cities AS c
                        ON c.id = u.city_id WHERE u.id = ?", [$userId])->fetch();
    }

    public function getUserByLogin(string $login): array
    {
        return $this->db->dbQuery("SELECT * FROM users WHERE login = ?", [$login])->fetch();
    }

    public function getOtherUser(int $id): array
    {
        return $this->db->dbQuery("SELECT u.id, u.login, u.avatar, u.registration_time, c.city, n.name, s.surname FROM users AS u
            LEFT JOIN names AS n ON u.id = n.user_id LEFT JOIN surnames AS s ON u.id = s.user_id
                LEFT JOIN cities AS c ON u.city_id = c.id WHERE u.id = ?", [$id])->fetch();
    }

    public function getUserIdByToken(string $token): string
    {
        return $this->db->dbQuery("SELECT id FROM users WHERE remember_token = ?", [$token])->fetchColumn();
    }
}