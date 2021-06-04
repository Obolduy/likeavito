<?php
use PHPUnit\Framework\TestCase;
use App\Models\Chat;

class ChatTest extends TestCase
{
    private $chat;

    protected function setUp(): void 
    {
        $this->chat = new Chat();
    }

    public function deleteChatProvider()
    {
        return [
            ['5cd6a063c51df65aa0d61bbfd9882874'],
            ['6a969987d95675e2caf4e00d8453c1ef'],
            ['7177ff6aafad58b0656fca6e31b41601'],
            ['821588896b793f28e7b607f4f43ee80b']
        ];
    }

    public function refreshProvider()
    {
        return [
            ['chat_5cd6a063c51df65aa0d61bbfd9882874'],
            ['chat_6a969987d95675e2caf4e00d8453c1ef'],
            ['chat_7177ff6aafad58b0656fca6e31b41601'],
            ['chat_821588896b793f28e7b607f4f43ee80b']
        ];
    }

    public function showChatProvider()
    {
        return [
            [1, 49],
            [5, 28],
            [1, 20],
            [4, 38]
        ];
    }

    public function sendMessageProvider()
    {
        return [
            ['SimpleTestText1', 'chat_5cd6a063c51df65aa0d61bbfd9882874', 10],
            ['SimpleTestText2', 'chat_6a969987d95675e2caf4e00d8453c1ef', 2],
            ['SimpleTestText3', 'chat_7177ff6aafad58b0656fca6e31b41601', 1],
            ['SimpleTestText4', 'chat_821588896b793f28e7b607f4f43ee80b', 15]
        ];
    }

    public function createChatProvider()
    {
        return [
            [8, 11],
            [7, 12],
            [9, 13],
            [10, 14]
        ];
    }

    /**
     * @dataProvider deleteChatProvider
     */

    public function testDeleteChat($chat_name) 
    {
        $this->chat->deleteChat($chat_name);

        $data = $this->chat->getAll("chat_$chat_name");

        $this->assertNull($data);
    }

    /**
     * @dataProvider refreshProvider
     */

    public function testRefresh($chat_name) 
    {
        $data = $this->chat->refresh($chat_name);

        $this->assertNotNull($data);
    }

    /**
     * @dataProvider showChatProvider
     */

    public function testShowChat($user1_id, $user2_id) 
    {
        $data = $this->chat->showChat($user1_id, $user2_id);

        foreach ($data as $elem) {
            $this->assertIsNotBool($data);
        }
    }

    /**
     * @dataProvider sendMessageProvider
     */

    public function testSendMessage($text, $chat_name, $user1_id) 
    {
        $this->chat->sendMessage($text, $chat_name, $user1_id);

        $data = $this->chat->getAll($chat_name, [0, 1000], true);

        $this->assertEquals($data[0]['message'], $text);
    }

    /**
     * @dataProvider createChatProvider
     */

    public function testCreateChat($user1_id, $user2_id) 
    {
        $this->chat->createChat($user1_id, $user2_id);

        $chat_name = md5($user1_id . '_' . $user2_id);

        $data1 = $this->chat->getAll("chat_$chat_name");
        $this->assertIsNotBool($data1);

        $data2 = $this->chat->getOne("chats_list", "chat_$chat_name", 'chat');
        $this->assertNotNull($data2);
    }

    protected function tearDown(): void
    {
        $this->chat = NULL;
    }
}