<?php
namespace App\Models;

use App\Models\EmailChanger;
use App\Models\EmailSender;

class SendChangeEmail extends RabbitmqQueues
{
    /**
     * Creating email listener (consumer)
     * @return void
     */

    public function listenToChangeEmail(): void
    {
        $this->createQueue('send_change_email_email');
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
        return function ($message) {
            $emailArray = json_decode($message->body, true);

            $emailChanger = new EmailChanger();
            $emailSender = new EmailSender($emailArray['current_email']);

            $emailSender->sendChangeEmail($emailArray['current_email'], $emailArray['ChangeEmailLink']);
            $emailChanger->addEmailToChangeTable($emailArray['new_email'], $emailArray['current_email'], $emailArray['ChangeEmailLink']);
        };
    }
}