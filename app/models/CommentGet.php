<?php
namespace App\Models;

class CommentGet extends Model
{
    public function getLotComments(int $lotId)
    {
        return $this->db->dbQuery("SELECT c.id, c.description, c.add_time, c.user_id, u.login, u.avatar FROM comments AS c
            LEFT JOIN users AS u ON u.id = c.user_id WHERE c.lot_id = ?", [$lotId])->fetchAll();
    }

    public function getCommentById(int $commentId)
    {
        return $this->db->dbQuery("SELECT c.*, u.login, u.avatar, u.id FROM comments AS c
            LEFT JOIN users AS u ON u.id = c.user_id WHERE c.id = ?", [$commentId])->fetch();
    }

    public function getCommentsByUserId(int $userId)
    {
        return $this->db->dbQuery("SELECT c.description, c.add_time, c.update_time, l.id, l.category_id, FROM comments AS c
            LEFT JOIN lots AS l ON l.id = c.lot_id WHERE c.user_id = ?", [$userId])->fetchAll();
    }
}