<?php
namespace App\Models;

use App\Models\Interfaces\iDatabase;
use App\Models\Picture;

class LotManipulate
{
    private $db;
    private $picture;

    public function __construct(iDatabase $db = null)
    {
        $this->picture = new Picture();
        $this->db = $db ?? DEFAULT_DB_CONNECTION;
    }

    public function addLot(string $title, int $price, string $description, int $categoryId, int $ownerId): void
    {
        $this->db->dbQuery("INSERT INTO lots SET owner_id = ?, category_id = ?, title = ?, price = ?, 
            description = ?, add_time = NOW(), update_time = NOW()",
                [$ownerId, $categoryId, $title, $price, $description]);
    }

    public function changeLot(int $lotId, string $title, int $price, string $description, int $categoryId, array $pictures = null)
    {
        if ($pictures) {
            $this->picture->uploadPicture("lots/$lotId", $pictures);
        }

        $this->db->dbQuery("UPDATE lots SET title = ?, price = ?, description = ?, category_id = ?, update_time = now() WHERE id = ?",
            [strip_tags($_POST['title']), strip_tags($_POST['price']),
                strip_tags($title, $price, $description, '<p></p><br/><br><i><b><s><u><strong>'),
                    $categoryId, $lotId]);
    }

    public function deleteLot(int $lotId): void
    {
        $this->db->dbQuery("DELETE FROM lots_pictures WHERE lot_id = ?", [$lotId]);
        $this->db->dbQuery("DELETE FROM lots WHERE id = ?", [$lotId]);

        $this->picture->deletePicturesByPath("lots/$lotId");
    }
}