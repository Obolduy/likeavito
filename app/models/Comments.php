<?php
namespace App\Models;

class Comments extends Model
{
    public function __construct()
    {
        $this->db = self::connection();
    }

    public function newComment(int $user_id, int $lot_id, string $description): void
    {
        $query = $this->db->prepare("INSERT INTO comments SET user_id = ?', lot_id = ?,
            description = ?, add_time = NOW(), update_time = NOW()");
        $query->execute([$_SESSION['user']['id'], $lot_id, $description]);
    }
}