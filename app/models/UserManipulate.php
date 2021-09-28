<?php
namespace App\Models;

use App\Models\SendChangePasswordEmail;
use App\Models\SendChangeEmail;
use App\Models\Picture;
use App\Models\LotManipulate;

class UserManipulate extends Model
{
    /**
	 * Adding new user into db
	 * @param string login
     * @param string hashed password
     * @param string name
     * @param int user`s city id
	 * @return void
	 */

    public function addUser(string $login, string $password, string $email, int $cityId): void
    {
        $this->db->dbQuery("INSERT INTO users SET email = ?, password = ?, city_id = ?, status_id = 1,
            ban_status = 0, active = 0, registration_time = NOW(), login = ?",
                [$email, $password, $cityId, $login]);
    }

    /**
	 * Adding data into names\surnames tables and updating users table
	 * @param string name
     * @param string surnames
     * @param int user`s id
     * @param string hashed avatar
	 * @return void
	 */

    public function addUserInfo(string $name, string $surname, int $userId, string $photo = null): void
    {
        $this->db->transaction([
            ["INSERT INTO names SET name = ?, user_id = ?", [$name, $userId]],
            ["INSERT INTO surnames SET surname = ?, user_id = ?", [$surname, $userId]]
        ]);

        $name_id = $this->db->dbQuery("SELECT id FROM names WHERE user_id = ?", [$userId])
            ->fetchColumn();
        $surname_id = $this->db->dbQuery("SELECT id FROM surnames WHERE user_id = ?", [$userId])
            ->fetchColumn();
        
        $this->db->transaction([
            ["UPDATE users SET name_id = ? WHERE id = ?", [$name_id, $userId]],
            ["UPDATE users SET surname_id = ? WHERE id = ?", [$surname_id, $userId]]
        ]);


        if ($photo) {
            $this->db->dbQuery("UPDATE users SET avatar = ? WHERE id = ?", [$photo, $userId]);
        }
    }

    public function deleteUser(int $userId): void
    {   
        $this->db->transaction([
            ["DELETE FROM users WHERE id = ?", [$userId]], 
            ["DELETE FROM names WHERE user_id = ?", [$userId]],
            ["DELETE FROM surnames WHERE user_id = ?", [$userId]]
        ]);

        $userLots = $this->db->dbQuery("SELECT id FROM lots WHERE owner_id = ?", [$userId])
            ->fetchAll();

        foreach ($userLots as $elem) {
            (new LotManipulate)->deleteLot($elem['id']);
        }
    }

    public function changeUser(int $userId, string $currentEmail, string $login, ?string $password, string $email, string $name, string $surname, int $cityId, array $photo = null)
    {
        if ($photo) {
            (new Picture)->uploadPicture("users/$userId", $photo);
        }

        if ($password) {
            $email_data = json_encode(['email' => $currentEmail, 'password' => $password]);

            $queue = new SendChangePasswordEmail();
            $queue->createQueue('send_change_password_email');
            $queue->sendMessage($email_data);
            $queue->closeConnection();
        }

        if ($currentEmail != $email) {
            $email_data = ['new_email' => $email, 'current_email' => $currentEmail];
            $email_json = json_encode($email_data);

            $queue = new SendChangeEmail();
            $queue->createQueue('send_change_email_email');
            $queue->sendMessage($email_json);
            $queue->closeConnection();
        }

        $this->db->transaction([
            ["UPDATE users SET login = ?, city_id = ?, updated_at = now() WHERE id = ?", [$login, $cityId, $userId]],
            ["UPDATE names SET name = ? WHERE user_id = ?", [$name, $userId]],
            ["UPDATE surnames SET surname = ? WHERE user_id = ?", [$surname, $userId]]
        ]);
    }
}