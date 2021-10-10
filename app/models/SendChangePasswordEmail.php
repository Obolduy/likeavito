<?php
namespace App\Models;

use App\Models\PasswordChange;
use App\Models\EmailSender;

class SendChangePasswordEmail extends RabbitmqQueues
{
    /**
     * Creating email listener (consumer)
     * @return void
     */

    public function listenToChangePasswordEmail(): void
    {
        $this->createQueue('send_change_password_email');
        $callback = $this->createCallback();
        $this->createConsume($callback);
        $this->createInfinityLoop();
        $this->closeConnection();
    }

    /**
     * Creating callback for emailsender
     * @return callback
     */

    public function createCallback()
    {
        $callback = function ($message) {  
            $userData = json_decode($message->body, true);

            $emailChanger = new PasswordChange($userData['email'], $userData['password']);
            $emailSender = new EmailSender($userData['email']);

            $emailSender->sendChangePasswordEmail($userData['link']);
            $emailChanger->addPasswordToChangeTable($userData['link']);
        };

        return $callback;
    }
}