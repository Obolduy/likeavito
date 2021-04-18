<?php
namespace App\Models;

class Comments extends Model
{
    public function __construct()
    {
        $this->db = self::connection();
    }

    public function newComment(int $lot_id, int $user_id, string $description): void
    {
        $query = $this->db->prepare("INSERT INTO comments SET user_id = ?, lot_id = ?,
            description = ?, add_time = NOW(), update_time = NOW()");
        $query->execute([$user_id, $lot_id, $description]);
    }

    public function changeComment(int $comment_id, string $description): void
    {
        $query = $this->db->prepare("UPDATE comments SET description = ?, update_time = NOW() WHERE id = ?");
        $query->execute([$description, $comment_id]);
    }

    public function deleteComment(int $comment_id): void
    {
        $query = $this->db->prepare("DELETE FROM comments WHERE id = ?");
        $query->execute([$comment_id]);
    }
}