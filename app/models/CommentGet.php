<?php
namespace App\Models;

use App\Models\Interfaces\iDatabase;

class CommentGet
{
    private $commentId;
    private $db;

    public function __construct($commentId = null, iDatabase $db = null)
    {
        $this->commentId = $commentId;
        $this->db = $db ?? DEFAULT_DB_CONNECTION;
    }

    public function getLotComments(int $lotId)
    {
        $this->db->dbQuery("SELECT c.id, c.description, c.add_time, u.login, u.avatar, u.id FROM comments AS c
            LEFT JOIN users AS u ON u.id = c.user_id WHERE c.lot_id = ?", [$lotId])->fetchAll();
    }

    public function getOneComment()
    {
        $this->db->dbQuery("SELECT c.*, u.login, u.avatar, u.id FROM comments AS c
            LEFT JOIN users AS u ON u.id = c.user_id WHERE c.id = ?", [$this->commentId])->fetch();
    }
}