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
            $chat_name = $_SESSION["chat_with_$user_id"];

            new View('chat', ['chat_name' => $chat_name, 'messages' => $messages, 'title' => "Чат"]);
        } else {
            $text = trim(strip_tags($_POST['text']));
            $chat_name = $_SESSION["chat_with_$user_id"];
            $my_id = $_SESSION['user']['id'];

            $chat->sendMessage($text, $chat_name, $my_id);

            header("Location: /chat/$user_id");
        }
    }

    public static function refreshChat(string $chat_name)
    {
        $chat = new Chat();

        $messages = $chat->refresh($chat_name);

        foreach ($messages as $message) {
            echo "<p class=\"message\">
			{$message['date']}";
				if($message['login'] != $_SESSION['user']['login']):
					echo " <a href=\"/users/{$message['user_id']}\">{$message['login']}</a>";
				else: echo " <a href=\"/users/{$message['user_id']}\">Я</a>";
				endif;
			echo ": {$message['message']}
		</p>";
        }
    }
}