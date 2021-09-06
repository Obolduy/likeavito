<?php
namespace App\Models;
use App\Models\Database;

class UserOld extends Model
{
    public function setRememberToken(int $id): void
    {
        $remember_token = md5(rand() . time());

        $this->update("UPDATE users SET remember_token = ? WHERE id = ?", [$remember_token, $id]);

        setcookie('remember_token', $remember_token, time()+2678400);
    }

    public function setPasswordResetToken(string $email, string $link): void
    {
        $query = $this->db->prepare("INSERT INTO password_reset SET email = ?, token = ?");
        $query->execute([$email, $link]);
    }

    public function resetPassword($password, string $token, string $email): void
    {
        $this->update("UPDATE users SET password = ?, updated_at = now() WHERE email = ?", [$password, $email]);
        $this->delete('password_reset', $token, 'token');
    }

    public function changePassword(string $link)
    {
        if ($new_password = $this->getOne('passwords_changes', $link, 'link')) {
            $this->update("UPDATE users SET updated_at = now(), password = ? WHERE id = ?",
            [$new_password[0]['password'], $_SESSION['user']['id']]);

            $this->setData($_SESSION['user']['id']);
        } else {
            return false;
        }
    }

    public function addPasswordToChangeTable(string $email, string $password): void
    {
        $query = $this->db->prepare('INSERT INTO passwords_changes SET email = ?, password = ?, link = ?, request_time = now()');
        $query->execute([$email, $password, $_SESSION['changepassword_link']]);
    }
}