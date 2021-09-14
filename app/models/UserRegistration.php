<?php
namespace App\Models;

use App\Models\UserManipulate;
use App\Models\UserGet;
use App\Models\Picture;

class UserRegistration extends Model
{
    private $login;
    private $password;
    private $email;
    private $city_id;
    private $name;
    private $surname;
    private $avatarFile;
    private $avatarName;

    public function __construct(string $login, string $password, string $email, int $city_id, string $name, string $surname, array $avatarFile = null)
    {
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->city_id = $city_id;
        $this->name = $name;
        $this->surname = $surname;
        $this->avatarFile = $avatarFile;
        $this->avatarName = null;
    }

    public function registration()
    {
        $userManipulate = new UserManipulate();
        $userManipulate->addUser($this->login, $this->password, $this->email, $this->city_id);

        $user = (new UserGet)->getUserByKey(['login' => $this->login]);

        if ($this->avatar) {
            $this->avatarName = (new Picture)->uploadPicture("users/{$user[0]['id']}",
                $this->avatarFile);
        }

        $userManipulate->addUserInfo($this->name, $this->surname, $user[0]['id'], $this->avatarName);

        $_SESSION['user_id'] = $user[0]['id'];
    }
}