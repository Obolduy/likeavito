<?php
namespace App\Models;

use App\Models\User;

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
            $user_data = json_decode($message->body, true);

            $user = new User();
            $user->sendChangePasswordEmail($user_data['email'], $user_data['password']);
            $user->addPasswordToChangeTable($user_data['email'], $user_data['password']);
        };

        return $callback;
    }
}