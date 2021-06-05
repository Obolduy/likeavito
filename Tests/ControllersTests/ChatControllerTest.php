<?php
use PHPUnit\Framework\TestCase;
use App\Controllers\ChatController;
use App\Models\Chat;

class ChatControllerTest extends TestCase
{
    private $chatController;
    private $chat;

    protected function setUp(): void 
    {
        $this->chatController = new ChatController();
        $this->chat = new Chat();
    }

    public function refreshChatProvider()
    {
        return [
            ['chat_b548521f5c2763bb46c98923ce8cb7c8'],
            ['chat_8d9ed36bfaa70b8e8fb691b326e1a0dd'],
            ['chat_ec18e4b5b552fe56d3b88fcc746ceea1'],
            ['chat_613d3d5df83eba8845a8211a48fdd3dd']
        ];
    }

    public function controllerSendMessageProvider()
    {
        return [
            ['chat_b548521f5c2763bb46c98923ce8cb7c8', 1, 'TestMessage1 '],
            ['chat_8d9ed36bfaa70b8e8fb691b326e1a0dd', 9, 'Test Message2'],
            ['chat_ec18e4b5b552fe56d3b88fcc746ceea1', 12, 'Новоесообщение3'],
            ['chat_613d3d5df83eba8845a8211a48fdd3dd', 11, 'Новое сообщение4']
        ];
    }

    /**
     * @dataProvider refreshChatProvider
     */

    public function testRefreshChat($chat_name) 
    {
        $test = $this->chatController->refreshChat($chat_name);

        $this->assertIsString($test);
    }

    /**
     * @dataProvider controllerSendMessageProvider
     */

    public function testControllerSendMessageProvider($chat_name, $user_id, $text) 
    {
        $_SESSION['user']['id'] = $user_id;
        $_POST['text'] = $text;

        $this->chatController->controllerSendMessage($chat_name);

        $data = $this->chat->getOne($chat_name, $text, 'message');

        $this->assertNotNull($data);
    }

    protected function tearDown(): void
    {
        $this->chatController = NULL;
        $this->chat = NULL;
    }
}