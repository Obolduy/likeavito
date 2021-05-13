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

    /**
	 * Get left join query with full comment (or all comments if ID is null) info (from 'comments', 'users' and 'lots')
	 * @param int comment`s id
	 * @return array
	 */

    public function getFullCommentInfo(int $comment_id = null)
    {
        if ($comment_id != null) {
            $query = $this->db->query("SELECT c.*, u.login, l.title FROM comments AS c
                LEFT JOIN users AS u ON u.id = c.user_id
                    LEFT JOIN lots AS l ON c.lot_id = l.id WHERE c.id = $comment_id");
        } else {
            $query = $this->db->query("SELECT c.*, u.login, l.title FROM comments AS c
                LEFT JOIN users AS u ON u.id = c.user_id
                    LEFT JOIN lots AS l ON c.lot_id = l.id");
        }
             
        return $this->show($query);
    }
}