<?php
namespace App\Models;

class UserAuth extends Model
{
    public $id;
    public $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->id = $_SESSION['user_id'];

        $user = $this->getUserInfo();

        $this->data = ['id' => $user['id'], 'login' => $user['login'],
            'password' => $user['password'], 'name' => $user['name'],
            'email' => $user['email'], 'surname' => $user['surname'],
            'city_id' => $user['city_id'], 'status_id' => $user['status_id'],
            'ban_status' => $user['ban_status'], 'registration_time' => $user['registration_time'],
            'updated_at' => $user['updated_at'], 'active' => $user['active'],
            'city_name' => $user['city'], 'avatar' => $user['avatar']];
    }

    /**
	 * Get left join query with user info (from 'users', 'names', 'surnames' and 'cities')
	 * @return array
	 */

    private function getUserInfo(): array
    {
        return $this->db->dbQuery("SELECT u.id, u.login, u.password, u.email, u.updated_at, u.avatar, n.name,
            s.surname, c.city, u.city_id, u.registration_time, u.ban_status, u.active, u.status_id
                FROM users AS u LEFT JOIN names AS n ON u.id = n.user_id
                    LEFT JOIN surnames AS s ON u.id = s.user_id LEFT JOIN cities AS c
                        ON c.id = u.city_id WHERE u.id = ?", [$this->id])->fetch();
    }
}