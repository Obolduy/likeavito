<?php
namespace App\Controllers;

use App\Models\Chat;
use App\View\View;

class ChatController
{   
    /**
	 * Open chat with user.
     * @param int Recipient`s id
	 * @return void
	 */

    public static function openChat(int $user_id)
    {
        if (!preg_match("#{$_SESSION['user']['id']}$#", $user_id)) {
            $chat = new Chat();

            $messages = $chat->showChat($_SESSION['user']['id'], $user_id);
            $chat_name = $_SESSION["chat_with_$user_id"];
    
            new View('chat', ['chat_name' => $chat_name, 'messages' => $messages, 'title' => "Чат"]);
        } else {
            header('Location: /'); die();
        }
    }

    /**
	 * Adding messahe to the chat table.
     * @param string Chat`s name
	 * @return void
	 */

    public static function controllerSendMessage(string $chat_name)
    {
        $chat = new Chat();

        $text = trim(strip_tags($_POST['text']));
        $my_id = $_SESSION['user']['id'];

        $chat->sendMessage($text, $chat_name, $my_id);
    }

    /**
	 * Sending SELECT query into DB and returns JSON. 
     * @param string Chat`s name
	 * @return string
	 */

    public static function refreshChat(string $chat_name): string
    {
        $chat = new Chat();

        $messages = $chat->refresh($chat_name);

        return json_encode($messages, JSON_UNESCAPED_UNICODE);
    }
}