<?php
namespace App\Models;

class EmailSender
{
    private $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    /**
     * Sending registration email and hashed confirmation link to user email
     * @param string hashed link
     */
    
    public function sendRegistrationEmail(string $link): void
    {
        mail("<{$this->email}>", 'Закончите Вашу регистрацию',
            EMAIL_REGISTRATION_MESSAGE_START . $link . EMAIL_MESSAGE_END,
                implode("\r\n", EMAIL_HEADERS));
    }

    public function sendDeleteMail(): void
    {
        $_SESSION['deletelink'] = md5($this->email . time());

        mail("<{$this->email}>", 'Подтвердите удаление Вашего аккаунта',
            EMAIL_ACCOUNT_DELETE_MESSAGE_START . $_SESSION['deletelink'] . EMAIL_MESSAGE_END,
                implode("\r\n", EMAIL_HEADERS));
    }

    public function sendChangePasswordEmail(string $password): void
    {
        $_SESSION['changepassword_link'] = md5($password . time());

        mail("<{$this->email}>", 'Подтвердите смену пароля',
            EMAIL_CHANGE_PASSWORD_MESSAGE_START . $_SESSION['changepassword_link'] . EMAIL_MESSAGE_END,
                implode("\r\n", EMAIL_HEADERS));
    }

    public function sendChangeEmail(): void
    {
        $_SESSION['changeemail_link'] = md5($this->email . time());

        mail("<{$this->email}>", 'Подтвердите смену Email',
            EMAIL_CHANGE_EMAIL_MESSAGE_START . $_SESSION['changeemail_link'] . EMAIL_MESSAGE_END,
                implode("\r\n", EMAIL_HEADERS));
    }
}