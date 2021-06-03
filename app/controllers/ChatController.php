<?php
namespace App\Controllers;
use App\Models\User;
use App\Models\Chat;
use App\View\View;

class ChatController
{   
    public static function chat(int $user_id)
    {
        $chat = new Chat();

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $messages = $chat->showChat($_SESSION['user']['id'], $user_id);

            new View('chat', ['messages' => $messages, 'title' => "Чат"]);
        } else {
            $text = trim(strip_tags($_POST['text']));
            $chat_name = $_SESSION["chat_with_$user_id"];
            $my_id = $_SESSION['user']['id'];

            $chat->sendMessage($text, $chat_name, $my_id);
            
            header("Location: /chat/$user_id");
        }
    }
}