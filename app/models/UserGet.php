<?php
namespace App\Models;

use App\Models\Database;

class UserGet
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllUsers() 
    {
        return $this->db->dbQuery("SELECT u.id, u.login, u.email, u.avatar, n.name,
            s.surname, c.city, u.city_id, u.registration_time, u.ban_status, u.active, u.status_id
                FROM users AS u LEFT JOIN names AS n ON u.id = n.user_id
                    LEFT JOIN surnames AS s ON u.id = s.user_id LEFT JOIN cities AS c
                        ON c.id = u.city_id")->fetchAll();
    }

    public function getUserInfo(int $userId) 
    {
        return $this->db->dbQuery("SELECT u.id, u.login, u.email, u.avatar, n.name,
            s.surname, c.city, u.city_id, u.registration_time, u.ban_status, u.active, u.status_id
                FROM users AS u LEFT JOIN names AS n ON u.id = n.user_id
                    LEFT JOIN surnames AS s ON u.id = s.user_id LEFT JOIN cities AS c
                        ON c.id = u.city_id WHERE u.id = ?", [$userId])->fetch();
    }

    public function getUserByKey(array $data): array
    {
        return $this->db->dbQuery("SELECT * FROM users WHERE ? = ?",
            [array_keys($data), array_values($data)])->fetch();
    }

    public function getOtherUser(int $id): array
    {
        return $this->db->dbQuery("SELECT login, avatar, registration_time FROM users WHERE id = ?",
            [$id])->fetch();
    }
}