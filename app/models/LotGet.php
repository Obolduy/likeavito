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
            LEFT JOIN lots_category AS c ON l.category_id = c.id WHERE l.owner_id = ?", [$userId])->fetchAll();
    }

    public function getLotsForCache(int $border = 5): array
    {
        return $this->db->dbQuery("SELECT * FROM lots ORDER BY id DESC LIMIT 0,$border")->fetchAll();
    }

    public function getAllLots()
    {
        return $this->db->dbQuery("SELECT l.*, u.login, c.category FROM lots AS l
            LEFT JOIN users AS u ON u.id = l.owner_id
                LEFT JOIN lots_category AS c ON l.category_id = c.id");
    }

    public function getLotsByCategoryId(int $categoryId)
    {
        return $this->db->dbQuery("SELECT lots.*, lots_category.category FROM lots 
            LEFT JOIN lots_category ON lots.category_id = lots_category.id WHERE category_id = $categoryId");
    }
}