<?php
namespace App\Models;

class Chat extends Model
{
    /**
	 * Deleting chat table and entry in chats_list table.
	 * @param string chat`s name w\no "chat"
	 * @return void
	 */

    public function deleteChat(string $chat_name): void
    {
        $this->db->dbQuery("DROP TABLE chat_$chat_name");
        $this->db->dbQuery("DELETE FROM chats_list WHERE chat = ?", ["chat_$chat_name"]);
    }

    /**
	 * Reload chat`s messages. Using by AJAX.
	 * @param string chat`s name w\"chat"
	 * @return array
	 */

    public function refresh(string $chat_name): array
    {
        return $this->db->dbQuery("SELECT c.*, u.login FROM $chat_name AS c LEFT JOIN users AS u ON c.user_id=u.id")
            ->fetchAll();
    }
    
    /**
	 * Taking users ids and showing chat and call createChat method if it needs.
	 * @param int Initiator`s id
     * @param int Recipient`s id
	 * @return array
	 */

    public function showChat(int $user1_id, int $user2_id): array
    {
        $chat = $this->db->dbQuery("SELECT * FROM chats_list WHERE (user1_id = ? AND user2_id = ?) OR
            (user1_id = ? AND user2_id = ?)", [$user1_id, $user2_id, $user2_id, $user1_id])->fetch();

        if (!$chat) {
            $this->createChat($user1_id, $user2_id);
            $this->showChat($user1_id, $user2_id);
        }

        $_SESSION["chat_with_$user2_id"] = $chat['chat'];
        
        return $this->db->dbQuery("SELECT c.*, u.login FROM {$chat['chat']} AS c 
            LEFT JOIN users AS u ON c.user_id=u.id")->fetchAll();
    }

    /**
     * @param string message text
     * @param string chat`s name w\"chat"
     * @param int Sender`s id
	 * @return void
	 */

    public function sendMessage(string $text, string $chat_name, int $user_id): void
    {
        $this->db->dbQuery("INSERT INTO $chat_name SET message = ?, user_id = ?", [$text, $user_id]);
    }
    
    /**
	 * Creating chat table and entry in chats_list table.
	 * @param int Initiator`s id
     * @param int Recipient`s id
	 * @return void
	 */

    private function createChat(int $user1_id, int $user2_id): void
    {
        $chatName = md5($user1_id . '_' . $user2_id);
        $this->db->dbQuery("CREATE TABLE chat_$chatName (
            id INT(64) AUTO_INCREMENT PRIMARY KEY,
            message TEXT(1000) NOT NULL,
            user_id INT(64) NOT NULL,
            date DATETIME NOT NULL DEFAULT NOW()
        )");

        $this->db->dbQuery("INSERT INTO chats_list SET chat = ?, user1_id = ?, user2_id = ?", 
            ["chat_$chatName", $user1_id, $user2_id]);
    }
}