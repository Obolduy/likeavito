<?php
namespace App\Models;

use App\Models\Interfaces\iDatabase;
use App\Models\Picture;

class LotChange
{
    private $id;
    private $db;

    public function __construct(int $id, iDatabase $db = null)
    {
        $this->id = $id;
        $this->db = $db ?? DEFAULT_DB_CONNECTION;
    }

    public function changeLot(string $title, int $price, string $description, int $categoryId, array $pictures = null)
    {
        if ($pictures) {
            (new Picture)->uploadPicture("lots/{$this->id}", $pictures);
        }

        $this->db->dbQuery("UPDATE lots SET title = ?, price = ?, description = ?, category_id = ?, update_time = now() WHERE id = ?",
            [strip_tags($_POST['title']), strip_tags($_POST['price']),
                strip_tags($title, $price, $description, '<p></p><br/><br><i><b><s><u><strong>'),
                    $categoryId, $this->id]);
    }
}