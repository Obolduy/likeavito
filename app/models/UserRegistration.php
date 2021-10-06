<?php
namespace App\Models;

use App\Models\UserManipulate;
use App\Models\UserGet;
use App\Models\Picture;
use App\Models\SendRegistrationEmail;

class UserRegistration extends Model
{
    private $login, $password, $email, $city_id, $name, $surname, $avatarFile, $avatarName;

    public function __construct(
        string $login, string $password, string $email, int $city_id, string $name, 
        string $surname, ?array $avatarFile = null
        )
    {
        parent::__construct();
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->city_id = $city_id;
        $this->name = $name;
        $this->surname = $surname;
        $this->avatarFile = $avatarFile;
        $this->avatarName = null;
    }

    public function registration(): array
    {
        $userManipulate = new UserManipulate();
        $userManipulate->addUser($this->login, $this->password, $this->email, $this->city_id);

        $user = (new UserGet)->getUserByLogin($this->login);

        if ($this->avatarFile) {
            $this->avatarName = (new Picture)->uploadPicture("users/{$user['id']}",
                $this->avatarFile)[0];
        }

        $userManipulate->addUserInfo($this->name, $this->surname, $user['id'], $this->avatarName);
        
        $this->prepareRegistrationEmail($user['id']);

        return ['id' => $user['id'], 'login' => $user['login'], 'email' => $user['email'], 'active' => $user['active'], 'ban_status' => $user['ban_status']];
    }

    /**
	 * Adding into RabbitMQ`s queue user`s email and hashed confirm link
     * @param string user id
	 * @return void
	 */

    private function prepareRegistrationEmail(int $id): void
    {
        $link = md5($this->email . time());
        $this->db->dbQuery('INSERT INTO registration_tokens SET user_id = ?, token = ?', [$id, $link]);

        $email_data = json_encode([$this->email, $link, $id]);

        $queue = new SendRegistrationEmail();
        $queue->createQueue('send_reg_email');
        $queue->sendMessage($email_data);
        $queue->closeConnection();
    }
}