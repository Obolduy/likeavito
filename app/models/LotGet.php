<?php
namespace App\Models;

class LotGet extends Model
{
    public function getFullLotInfo(int $lotId): array
    {
        $lotInfo = $this->db->dbQuery("SELECT l.*, u.login, u.avatar, c.category FROM lots AS l
            LEFT JOIN users AS u ON u.id = l.owner_id
                LEFT JOIN lots_category AS c ON l.category_id = c.id WHERE l.id = ?", [$lotId])->fetch();

        $lotPictures = $this->db->dbQuery("SELECT id AS pic_id, picture, lot_id FROM lots_pictures WHERE lot_id = ?",
            [$lotId])->fetchAll();

        return ['LotInfo' => $lotInfo, 'LotPictures' => $lotPictures];
    }

    public function getUserLots(int $userId): array
    {
        return $this->db->dbQuery("SELECT l.*, c.category FROM lots AS l
            LEFT JOIN lots_category AS c ON l.category_id = c.id WHERE l.user_id = ?", [$userId])->fetchAll();
    }
}