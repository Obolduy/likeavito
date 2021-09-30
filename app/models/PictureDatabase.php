<?php
namespace App\Models;

class PictureDatabase extends Model
{    
    public function addLotPicture(string $lotId, array $pictures): void
    {
        foreach ($pictures as $pictureName) {
            $this->db->dbQuery("INSERT INTO lots_pictures SET lot_id = ?, picture = ?",
                [$lotId, $pictureName]);
        }
    }
}