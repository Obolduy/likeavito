<?php
namespace App\Models;

use App\Models\SendChangePasswordEmail;
use App\Models\SendChangeEmail;
use App\Models\UserAuth;
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
        $this->db->transaction([["INSERT INTO names SET name = ?, user_id = ?", [$name, $user_id]],
            ["INSERT INTO surnames SET surname = ?, user_id = ?", [$surname, $user_id]]]);

        $name_id = $this->db->dbQuery("SELECT id FROM names WHERE user_id = ?", [$user_id])
            ->fetchColumn();
        $surname_id = $this->db->dbQuery("SELECT id FROM surnames WHERE user_id = ?", [$user_id])
            ->fetchColumn();
        
        $this->db->transaction([["UPDATE users SET name_id = ? WHERE id = ?", [$name_id, $user_id]],
            ["UPDATE users SET surname_id = ? WHERE id = ?", [$surname_id, $user_id]]]);


        if ($photo) {
            $this->db->dbQuery("UPDATE users SET avatar = ? WHERE id = ?", [$photo, $user_id]);
        }
    }

    public function deleteUser(int $user_id): void
    {   
        $this->db->transaction([
            ["DELETE FROM users WHERE id = ?", [$user_id]], 
            ["DELETE FROM names WHERE user_id = ?", [$user_id]],
            ["DELETE FROM surnames WHERE user_id = ?", [$user_id]]
        ]);

        $user_lots = $this->db->dbQuery("SELECT id FROM lots WHERE owner_id = ?", [$user_id])
            ->fetchColumn();

        (new LotManipulate)->deleteLot($user_lots);
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

        $this->db->transaction([
            ["UPDATE users SET login = ?, city_id = ?, updated_at = now() WHERE id = ?", [$login, $cityId, $userId]],
            ["UPDATE names SET name = ? WHERE user_id = ?", [$name, $cityId]],
            ["UPDATE surnames SET surname = ? WHERE user_id = ?", [$surname, $cityId]]
        ]);
    }
}