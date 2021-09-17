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

        $user = (new UserGet)->getUserByLogin($this->login);

        if ($this->avatarFile) {
            $this->avatarName = (new Picture)->uploadPicture("users/{$user['id']}",
                $this->avatarFile)[0];
        }

        $userManipulate->addUserInfo($this->name, $this->surname, $user['id'], $this->avatarName);

        $_SESSION['user_id'] = $user['id'];
    }
}