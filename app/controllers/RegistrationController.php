<?php
namespace App\Controllers;
use App\Models\AuthUser;
use App\Models\EmailVerify;
use App\Models\UserRegistration;
use App\Models\UserValidation;
use App\Models\MySQLDB;
use App\Models\SendRegistrationEmail;
use App\View\View;

class RegistrationController
{   
    public static function registration()
    {
        $db = new MySQLDB();
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $cities = $db->dbQuery("SELECT * FROM cities")->fetchAll();

            new View('registration', ['cities' => $cities, 'title' => 'Зарегистрироваться']);
        } else {
            $login = strip_tags($_POST['login']);
            $email = strip_tags($_POST['email']);
            $password = strip_tags($_POST['password']);
            $confirmPassword = strip_tags($_POST['confirmPassword']);
            $name = strip_tags($_POST['name']);
            $surname = strip_tags($_POST['surname']);
            $cityId = $_POST['city_id'];

            $checkUser = (new UserValidation)->registrationCheck($login, $email, $password, $confirmPassword);

            if (is_bool($checkUser)) {
                $cryptPassword = password_hash($password, PASSWORD_DEFAULT);

                $registration = new UserRegistration($login, $cryptPassword, $email, $cityId, $name, $surname, $_FILES['photo']);
                $registration->registration();

                $_SESSION['userauth'] = true;
                $_SESSION['user'] = (new AuthUser);

                self::prepareRegistrationEmail($email);

                header('Location: /');
            } else {
                $_SESSION['reg_err_msg'] = $checkUser;

                header('Location: /registration');
            }
        }
    }

    /**
	 * Checking does user has non-confirmated account.
     * If he does, it updates DB (active status and update time) and return emailconfirm view.
     * @param string generated hash token
	 * @return void
	 */

    public static function verifyEmail(string $token): void
    {
        if ($_SESSION['verifylink'] == $token && $_SESSION['user']['active'] == 0) {
            new EmailVerify();

            $_SESSION['verifylink'] = null;

            include_once $_SERVER['DOCUMENT_ROOT'] . '/App/View/Views/emailconfirm.php';
        }
    }

    /**
	 * Adding into RabbitMQ`s queue user`s email and hashed confirm link
     * @param string email
	 * @return void
	 */

    public static function prepareRegistrationEmail(string $email): void
    {
        $link = md5($email . time());
        $_SESSION['verifylink'] = $link;

        $email_data = json_encode([$email, $link]);

        $queue = new SendRegistrationEmail();
        $queue->createQueue('send_reg_email');
        $queue->sendMessage($email_data);
        $queue->closeConnection();
    }
}