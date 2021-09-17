<?php
namespace App\Models;

use App\Models\User;

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
            $email_array = json_decode($message->body, true);

            $user = new User();
            $user->sendChangeEmail($email_array['current_email']);
            $user->addEmailToChangeTable($email_array['new_email'], $email_array['current_email']);
        };
    }
}