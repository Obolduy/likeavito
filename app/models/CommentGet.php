<?php
namespace App\Models;

use App\Models\Database;

class CommentGet
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getLotComments(int $lotId)
    {
        $this->db->dbQuery("SELECT c.id, c.description, c.add_time, u.login, u.avatar, u.id FROM comments AS c
            LEFT JOIN users AS u ON u.id = c.user_id WHERE c.lot_id = ?", [$lotId])->fetchAll();
    }

    public function getCommentById(int $commentId)
    {
        $this->db->dbQuery("SELECT c.*, u.login, u.avatar, u.id FROM comments AS c
            LEFT JOIN users AS u ON u.id = c.user_id WHERE c.id = ?", [$commentId])->fetch();
    }

    public function getCommentsByUserId(int $userId)
    {
        $this->db->dbQuery("SELECT c.description, c.add_time, c.update_time, l.id, l.category_id, FROM comments AS c
            LEFT JOIN lots AS l ON l.id = c.lot_id WHERE c.user_id = ?", [$userId])->fetchAll();
    }
}