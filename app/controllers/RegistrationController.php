<?php
namespace App\Controllers;
use App\Models\User;
use App\View\View;

class RegistrationController
{   
    public static function registration()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            (new View('registration'));
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
        if ($_SESSION['user']['updated_at'] === null && $_SESSION['user']['active'] === 0) {
            ( new User )->verifycationEmail();
            include_once $_SERVER['DOCUMENT_ROOT'] . '/App/Views/emailconfirm.php';
        }
    }

    public static function testсont($textinskobka, $newtext)
    {
        echo $textinskobka . $newtext;
    }
}