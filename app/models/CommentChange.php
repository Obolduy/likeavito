<?php
namespace App\Models;

use App\Models\Interfaces\iDatabase;

class CommentChange
{
    private $commentId;
    private $commentText;
    private $db;

    public function __construct(int $commentId, string $commentText, iDatabase $db = null)
    {
        $this->commentId = $commentId;
        $this->commentText = $commentText;
        $this->db = $db ?? DEFAULT_DB_CONNECTION;

        $this->changeComment();
    }

    public function changeComment(): void
    {
        $this->db->dbQuery("UPDATE comments SET description = ? WHERE id = ?",
            [$this->commentText, $this->commentId]);
    }
}