<?php
namespace App\Models;

use App\Models\Interfaces\iDatabase;

class LotGet
{
    private $db;

    public function __construct(iDatabase $db = null)
    {
        $this->db = $db ?? DEFAULT_DB_CONNECTION;
    }

    public function getFullLotInfo(int $lotId): array
    {
        $lotInfo = $this->db->dbQuery("SELECT l.*, u.login, u.avatar, c.category FROM lots AS l
            LEFT JOIN users AS u ON u.id = l.owner_id
                LEFT JOIN lots_category AS c ON l.category_id = c.id WHERE l.id = ?", [$lotId])->fetch();

        $lotPictures = $this->db->dbQuery("SELECT id AS pic_id, picture FROM lots_pictures WHERE lot_id = ?",
            [$lotId])->fetchAll();

        return ['LotInfo' => $lotInfo, 'LotPictures' => $lotPictures];
    }

    public function getPageWithLots(int $categoryId, int $border1, int $border2 = 5): array
    {
        return $this->db->dbQuery("SELECT * FROM lots WHERE category_id = ? LIMIT ?, ?",
                [$categoryId, $border1, $border2])->fetchAll();
    }
}