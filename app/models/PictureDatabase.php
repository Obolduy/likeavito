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

    public function updateLotPicture(string $lotId, array $pictures, ?string $radio): void
    {
        if ($radio == 'photos_add') {
            foreach ($pictures as $pictureName) {
                $this->db->dbQuery("INSERT INTO lots_pictures SET picture = ?, lot_id = ?",
                    [$pictureName, $lotId]);
            }
        } else {
            $this->db->dbQuery("DELETE FROM lots_pictures WHERE lot_id = ?", [$lotId]);

            foreach ($pictures as $pictureName) {
                $this->db->dbQuery("INSERT INTO lots_pictures SET picture = ?, lot_id = ?",
                    [$pictureName, $lotId]);
            }
        }
    }
}