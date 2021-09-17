<?php
namespace App\Models;

use App\Models\EmailSender;

class SendRegistrationEmail extends RabbitmqQueues
{
    /**
     * Creating email listener (consumer)
     * @return void
     */

    public function listenToRegistrationEmail(): void
    {
        $this->createQueue('send_reg_email');
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
            $array = json_decode($message->body);
        
            (new EmailSender($array[0]))->sendRegistrationEmail($array[1]);
        };

        return $callback;
    }
}