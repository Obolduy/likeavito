<?php
namespace App\Controllers;

use App\Models\EmailVerify;
use App\Models\UserRegistration;
use App\Models\UserValidation;
use App\Models\CitiesGet;
use App\Models\UserGet;
use App\View\View;

class RegistrationController
{   
    public static function registration()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $cities = (new CitiesGet)->getAllCities();

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
                $_SESSION['user'] = $registration->registration();

                $_SESSION['userauth'] = true;

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

    public static function verifyEmail(int $user_id, string $token): void
    {
        $userActive = (new UserGet)->getUser($user_id)['active'];

        if (!$userActive) {
            new EmailVerify($token);

            include_once $_SERVER['DOCUMENT_ROOT'] . '/App/View/Views/emailconfirm.php';
        }
    }
}