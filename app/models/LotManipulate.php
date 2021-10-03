<?php
namespace App\Models;

use App\Models\Picture;

class LotManipulate extends Model
{
    private $picture;

    public function __construct()
    {
        parent::__construct();
        $this->picture = new Picture();
    }

    public function addLot(string $title, int $price, string $description, int $categoryId, int $ownerId): void
    {
        $this->db->dbQuery("INSERT INTO lots SET owner_id = ?, category_id = ?, title = ?, price = ?, 
            description = ?, add_time = NOW(), update_time = NOW()",
                [$ownerId, $categoryId, $title, $price, $description]);
    }

    public function changeLot(int $lotId, string $title, int $price, string $description, int $categoryId, int $display = 0, ?array $pictures)
    {
        if ($pictures) {
            $this->picture->uploadPicture("lots/$lotId", $pictures);
        }

        $this->db->dbQuery("UPDATE lots SET title = ?, price = ?, description = ?, category_id = ?, display = ?, update_time = now() WHERE id = ?",
            [$title, $price, $description, $categoryId, $display, $lotId]);
    }

    public function deleteLot(int $lotId): void
    {
        $this->db->dbQuery("DELETE FROM lots_pictures WHERE lot_id = ?", [$lotId]);
        $this->db->dbQuery("DELETE FROM lots WHERE id = ?", [$lotId]);

        $this->picture->deletePicturesByPath("lots/$lotId");
    }
}