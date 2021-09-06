<?php
namespace App\Models;
use App\Models\Database;

class UserOld extends Model
{
    public function verifycationEmail(): void
    {
        $this->update("UPDATE users SET updated_at = now(), active = ? WHERE id = ?", [1, $_SESSION['user']['id']]);

        $this->setData($_SESSION['user']['id']);
    }

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

    public function changeEmail(string $link)
    {
        if ($new_email = $this->getOne('emails_changes', $link, 'link')) {
            $this->update("UPDATE users SET updated_at = now(), email = ? WHERE id = ?",
                [$new_email[0]['new_email'], $_SESSION['user']['id']]);

            $this->setData($_SESSION['user']['id']);
        } else {
            return false;
        }
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

    public function addEmailToChangeTable(string $new_email, string $current_email): void
    {
        $query = $this->db->prepare('INSERT INTO emails_changes SET new_email = ?, current_email = ?, link = ?, request_time = now()');
        $query->execute([$new_email, $current_email, $_SESSION['changeemail_link']]);
    }
}