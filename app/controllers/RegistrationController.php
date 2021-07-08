<?php
namespace App\Controllers;
use App\Models\SendRegistrationEmail;
use App\Models\User;
use App\Models\Model;
use App\View\View;

class RegistrationController
{   
    public static function registration()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $cities = (new Model)->getAll('cities');

            new View('registration', ['cities' => $cities, 'title' => 'Зарегистрироваться']);
        } else {
            $login = strip_tags($_POST['login']);
            $email = strip_tags($_POST['email']);
            $password = strip_tags($_POST['password']);
            $confirmPassword = strip_tags($_POST['confirmPassword']);
            $name = strip_tags($_POST['name']);
            $surname = strip_tags($_POST['surname']);
            $city_id = $_POST['city_id'];
            $photo = $_FILES['photo']['name'];

            $check = User::registrationCheck($login, $email, $password, $confirmPassword);

            if (is_bool($check)) {
                $_SESSION['userauth'] = true;

                $cryptpassword = password_hash($password, PASSWORD_DEFAULT);

                $user = new User();                
                $user->addUser($login, $cryptpassword, $email, $city_id);
                $user_info = $user->getOne('users', $email, 'email');

                foreach ($user_info as $elem) {
                    if ($photo) {
                        $user_id = $elem['id'];
                        $photo = $user->insertPicture("img/users/$user_id", $_FILES['photo']);

                        $user->addUserInfo($name, $surname, $elem['id'], $photo);
                    } else {
                        $user->addUserInfo($name, $surname, $elem['id']);
                    }
                    $user->setData($elem['id']);

                    $_SESSION['user'] = $user->data;
                }
                self::prepareRegistrationEmail($email);

                header('Location: /');
            } else {
                $_SESSION['reg_err_msg'] = $check;

                header('Location: /registration');
            }
        }
    }

    /**
	 * Checking does user has non-confirmated account.
     * If he is, it updates DB (active status and update time) and return emailconfirm view.
     * @param string generated hash token
	 * @return void
	 */

    public static function verifyEmail(string $token): void
    {
        if ($_SESSION['verifylink'] == $token && $_SESSION['user']['active'] == 0) {
            ( new User )->verifycationEmail();

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