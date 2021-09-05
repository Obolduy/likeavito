<?php
namespace App\Models;
use App\Models\Interfaces\iDatabase;

class User
{
    public $db;

    public function __construct(iDatabase $db)
    {
        $this->db = $db;
    }

    /**
	 * Adding new user into db
	 * @param string login
     * @param string hashed password
     * @param string name
     * @param int user`s city id
	 * @return void
	 */

    public function addUser(string $login, string $password, string $email, int $city_id): void
    {
        $this->db->dbQuery("INSERT INTO users SET email = ?, password = ?, city_id = ?, status_id = 1,
            ban_status = 0, active = 0, registration_time = NOW(), login = ?",
                [$email, $password, $city_id, $login]);
    }

    /**
	 * Adding data into names\surnames tables and updating users table
	 * @param string name
     * @param string surnames
     * @param int user`s id
     * @param string hashed avatar
	 * @return void
	 */

    public function addUserInfo(string $name, string $surname, int $user_id, string $photo = null): void
    {
        $this->db->dbconnection->beginTransaction();

        $this->db->dbQuery("INSERT INTO names SET name = ?, user_id = ?",[$name, $user_id]);
        $this->db->dbQuery("INSERT INTO surnames SET surname = ?, user_id = ?",
            [$surname, $user_id]);

        $this->db->dbconnection->commit();

        $name_id = $this->db->dbQuery("SELECT id FROM names WHERE user_id = ?", [$user_id])
            ->fetchColumn();
        $surname_id = $this->db->dbQuery("SELECT id FROM surnames WHERE user_id = ?", [$user_id])
            ->fetchColumn();
        
        $this->db->dbconnection->beginTransaction();

        $this->db->dbQuery("UPDATE users SET name_id = ? WHERE id = ?", [$name_id, $user_id]);
        $this->db->dbQuery("UPDATE users SET surname_id = ? WHERE id = ?", [$surname_id, $user_id]);

        $this->db->dbconnection->commit();

        if ($photo) {
            $this->db->dbQuery("UPDATE users SET avatar = ? WHERE id = ?", [$photo, $user_id]);
        }
    }

    public function deleteUser(int $user_id): void
    {   
        $this->db->dbconnection->beginTransaction();

        $this->db->dbQuery("DELETE FROM users WHERE id = ?", [$user_id]);
        $this->db->dbQuery("DELETE FROM names WHERE user_id = ?", [$user_id]);
        $this->db->dbQuery("DELETE FROM surnames WHERE user_id = ?", [$user_id]);

        $this->db->dbconnection->commit();

        // Вынести это в Lot
        $user_lots = $this->db->dbQuery("SELECT id FROM lots WHERE owner_id = ?", [$user_id])
            ->fetchColumn();

        foreach ($user_lots as $elem) {
            $this->db->dbQuery("DELETE FROM lots_pictures WHERE lot_id = ?", [$elem]);

            if (is_dir("/img/lots/$elem")) {
                rmdir("/img/lots/$elem");
            }
        }

        $this->db->dbQuery("DELETE FROM lots WHERE owner_id = ?", [$user_id]);

        if (is_dir("/img/users/$user_id")) {
            rmdir("/img/users/$user_id");
        }
    }
}