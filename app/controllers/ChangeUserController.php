<?php
namespace App\Controllers;
use App\Models\SendChangePasswordEmail;
use App\Models\SendChangeEmail;
use App\Models\User;
use App\Models\Model;
use App\View\View;

class ChangeUserController
{   
    /**
	 * Change user`s data by himself
     * @param int user id
	 * @return void
	 */

    public static function changeInformation(): void
    {
        $user = new User();

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $user = $user->getFullUserInfo($_SESSION['user']['id']);
            $cities = (new Model)->getAll('cities');

            new View('changeuser', ['user' => $user, 'cities' => $cities, 'title' => 'Изменить данные']);
        } else {
            $check = $user->changeCheck(strip_tags($_POST['login']), strip_tags($_POST['password']),
                strip_tags($_POST['confirmPassword']), $_SESSION['user']['login'], strip_tags($_POST['email']));

            if ($check == true) {
                if ($_FILES['photo']['name']) {
                    $user->insertPicture("img/users/{$_SESSION['user']['id']}", $_FILES['photo']);
                }

                $cryptpassword = password_hash(strip_tags($_POST['password']), PASSWORD_DEFAULT);
                
                $data = [strip_tags($_POST['login']), $_POST['city_id'], $_SESSION['user']['id']];

                if ($_POST['password']) {
                    $email_data = json_encode(['email' => $_SESSION['user']['email'], 'password' => $cryptpassword]);

                    $queue = new SendChangePasswordEmail();
                    $queue->createQueue('send_change_password_email');
                    $queue->sendMessage($email_data);
                    $queue->closeConnection();
                }

                if ($_SESSION['user']['email'] != strip_tags($_POST['email'])) {
                    $email_data = ['new_email' => strip_tags($_POST['email']), 'current_email' => $_SESSION['user']['email']];
                    $email_json = json_encode($email_data);

                    $queue = new SendChangeEmail();
                    $queue->createQueue('send_change_email_email');
                    $queue->sendMessage($email_json);
                    $queue->closeConnection();
                }

                $user->update("UPDATE users SET login = ?, city_id = ?, updated_at = now() WHERE id = ?", $data);
                $user->update("UPDATE names SET name = ? WHERE user_id = ?", [strip_tags($_POST['name']), $_SESSION['user']['id']]);
                $user->update("UPDATE surnames SET surname = ? WHERE user_id = ?", [strip_tags($_POST['surname']), $_SESSION['user']['id']]);

                $user_info = $user->getOne('users', $_SESSION['user']['id']);

                foreach ($user_info as $elem) {
                    $user->setData($elem['id']);

                    $_SESSION['user'] = $user->data;
                }
            } else {
                $_SESSION['lot_err_msg'] = $check;

                header('Location: /user/change');
            }

            header('Location: /user/change');
        }
    }
}