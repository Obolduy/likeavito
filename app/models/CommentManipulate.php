<?php
namespace App\Models;

use App\Models\Database;

class CommentManipulate
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addComment(int $lotId, int $userId, string $description): void
    {
        $this->db->dbQuery("INSERT INTO comments SET user_id = ?, lot_id = ?,
            description = ?, add_time = NOW(), update_time = NOW()", [$userId, $lotId, $description]);
    }

    public function changeComment(int $commentId, int $display, string $commentText): void
    {
        $this->db->dbQuery("UPDATE comments SET description = ?, display = ? WHERE id = ?",
            [$commentText, $display, $commentId]);
    }

    public function deleteComment(int $commentId): void
    {
        $this->db->dbQuery("DELETE FROM comments WHERE id = ?", [$commentId]);
    }
}