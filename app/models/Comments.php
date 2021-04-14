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
}