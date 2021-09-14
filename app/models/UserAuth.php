<?php
namespace App\Models;

use App\Models\Database;

class UserAuth
{
    public $id;
    public $data = [];
    private $db;

    public function __construct()
    {
        $this->db = new Database();
        $this->id = $_SESSION['user_id'];

        foreach ($this->getUserInfo() as $elem) {
            $this->data = ['id' => $elem['id'], 'login' => $elem['login'],
                'password' => $elem['password'], 'name_id' => $elem['name_id'],
                'email' => $elem['email'], 'surname_id' => $elem['surname_id'],
                'city_id' => $elem['city_id'], 'status_id' => $elem['status_id'],
                'ban_status' => $elem['ban_status'], 'registration_time' => $elem['registration_time'],
                'updated_at' => $elem['updated_at'], 'active' => $elem['active']];
        }
    }

    /**
	 * Get left join query with user info (from 'users', 'names', 'surnames' and 'cities')
	 * @return array
	 */

    private function getUserInfo(): array
    {
        return $this->db->dbQuery("SELECT u.id, u.login, u.password, u.email, u.avatar, n.name,
            s.surname, c.city, u.city_id, u.registration_time, u.ban_status, u.active, u.status_id
                FROM users AS u LEFT JOIN names AS n ON u.id = n.user_id
                    LEFT JOIN surnames AS s ON u.id = s.user_id LEFT JOIN cities AS c
                        ON c.id = u.city_id WHERE u.id = ?", [$this->id])->fetch();
    }
}