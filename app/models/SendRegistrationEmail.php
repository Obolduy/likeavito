<?php
namespace App\Models;

use App\Models\User;

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
        
            (new User)->sendRegistrationEmail($array[0], $array[1]);
        };

        return $callback;
    }
}