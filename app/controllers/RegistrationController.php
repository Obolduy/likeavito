<?php
namespace App\Controllers;
use App\Models\User;

class RegistrationController
{   
    public static function registration()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            include_once $_SERVER['DOCUMENT_ROOT'] . '/App/Views/registration.php';
        } else {
            $login = strip_tags($_POST['login']);
            $email = strip_tags($_POST['email']);
            $password = strip_tags($_POST['password']);
            $confirmPassword = strip_tags($_POST['confirmPassword']);
            $name = strip_tags($_POST['name']);
            $surname = strip_tags($_POST['surname']);
            $city_id = $_POST['city_id'];

            $check = User::registrationCheck($login, $password, $confirmPassword);

            if ($check == true) {
                session_start();
                $_SESSION['userauth'] = true;

                $user = new User();

                $cryptpassword = password_hash($password, PASSWORD_DEFAULT);
                
                $user->addUser($login, $cryptpassword, $email, $city_id);

                $user_info = $user->getOne('users', $email, 'email');

                foreach($user_info as $elem) {
                    $user->addUserInfo($name, $surname, $elem['id']);
                    $user->setData($elem['id']);
                    
                    $_SESSION['user'] = $user->data;
                }

                $user->sendEmail($email);
                
                header('Location: index.php'); die();       
            }
        }
    }

    public static function verifyEmail()
    {
        if ($_SESSION['user']['updated_at'] != null) {
            ( new User )->verifycationEmail();
            include_once $_SERVER['DOCUMENT_ROOT'] . '/App/Views/emailconfirm.php';
        }
    }
}