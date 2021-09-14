<?php
namespace App\Models;

use App\Models\Database;
use App\Models\SendChangePasswordEmail;
use App\Models\SendChangeEmail;
use App\Models\UserAuth;
use App\Models\Picture;
use App\Models\LotManipulate;

class UserManipulate
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
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

        $user_lots = $this->db->dbQuery("SELECT id FROM lots WHERE owner_id = ?", [$user_id])
            ->fetch();

        foreach ($user_lots as $elem) {
            (new LotManipulate)->deleteLot($elem);
        }
    }

    public function changeUser(int $userId, string $login, string $password, string $email, string $name, string $surname, int $cityId, array $photo = null)
    {
        if ($photo) {
            (new Picture)->uploadPicture("users/$userId", $photo);
        }

        $currentEmail = (new UserAuth)->data['email'];

        if ($_POST['password']) {
            $email_data = json_encode(['email' => $currentEmail, 'password' => $password]);

            $queue = new SendChangePasswordEmail();
            $queue->createQueue('send_change_password_email');
            $queue->sendMessage($email_data);
            $queue->closeConnection();
        }

        if ($currentEmail != strip_tags($email)) {
            $email_data = ['new_email' => strip_tags($email), 'current_email' => $currentEmail];
            $email_json = json_encode($email_data);

            $queue = new SendChangeEmail();
            $queue->createQueue('send_change_email_email');
            $queue->sendMessage($email_json);
            $queue->closeConnection();
        }

        $this->db->dbconnection->beginTransaction();

        $this->db->dbQuery("UPDATE users SET login = ?, city_id = ?, updated_at = now() WHERE id = ?",
            [$login, $cityId, $userId]);
        $this->db->dbQuery("UPDATE names SET name = ? WHERE user_id = ?", [$name, $cityId]);
        $this->db->dbQuery("UPDATE surnames SET surname = ? WHERE user_id = ?", [$surname, $cityId]);

        $this->db->dbconnection->commit();
    }
}