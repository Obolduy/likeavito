<?php
namespace App\Controllers;
use App\Models\User;
use App\Models\Model;
use App\View\View;

class RegistrationController
{   
    public static function registration()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $cities = (new Model)->getAll('cities');

            new View('registration', ['cities' => $cities]);
        } else {
            $login = strip_tags($_POST['login']);
            $email = strip_tags($_POST['email']);
            $password = strip_tags($_POST['password']);
            $confirmPassword = strip_tags($_POST['confirmPassword']);
            $name = strip_tags($_POST['name']);
            $surname = strip_tags($_POST['surname']);
            $city_id = $_POST['city_id'];

            $check = User::registrationCheck($login, $email, $password, $confirmPassword);

            if ($check == true) {
                $_SESSION['userauth'] = true;

                $user = new User();

                $cryptpassword = password_hash($password, PASSWORD_DEFAULT);
                
                $user->addUser($login, $cryptpassword, $email, $city_id);

                $user_info = $user->getOne('users', $email, 'email');

                foreach ($user_info as $elem) {
                    $user->addUserInfo($name, $surname, $elem['id']);
                    $user->setData($elem['id']);
                    
                    $_SESSION['user'] = $user->data;
                }

                $user->sendEmail($email);
                
                header('Location: /');
            }
        }
    }

    /**
	 * Checking does user has non-confirmated account.
     * If he is, it update DB(active status and update time) and return emailconfirm view.
	 * @return void
	 */

    public static function verifyEmail(): void
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