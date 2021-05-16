<?php
namespace App\Models;

class Lots extends Model
{
    public function __construct()
    {
        $this->db = self::connection();
    }

    /**
	 * Adding new lot into db
	 * @param string title
     * @param int price
     * @param string description
     * @param string filename of lot picture or NULL
     * @param int lot`s category id
     * @param int user`s id
	 * @return void
	 */

    public function addLot(string $title, int $price, string $description, int $category_id, int $owner_id): void
    {
        $query = $this->db->prepare("INSERT INTO lots SET owner_id = ?, category_id = ?, title = ?, price = ?, 
            description = ?, add_time = NOW(), update_time = NOW()");
        $query->execute([$owner_id, $category_id, $title, $price, $description]);
    }

    /**
	 * Adding lot`s pictures (if they are exists) and creating directory if it`s needs.
	 * @param array hashed names of pictures
     * @param int lot id
	 * @return void
	 */

    public function addLotPictures(array $picture, int $id): void
    {
        if (!is_dir("img/lots/$id")) {
            mkdir("img/lots/$id");
        }

        $dir = "img/lots/$id";
        $ext = '';

        for ($i = 0; $i < count($picture['name']); $i++) {
            preg_match_all('#\.[A-Za-z]{3,4}$#', $picture['name'][$i], $ext);
            $name = md5($picture['name'][$i]) . $ext[0][0];
            move_uploaded_file($picture['tmp_name'][$i], "$dir/$name");

            $query = $this->db->prepare("INSERT INTO lots_pictures SET lot_id = ?, picture = ?");
            $query->execute([$id, $name]);
        }
    }

    /**
	 * Get left join query with full lot (or all lots if ID is null) info (from 'lots', 'users', 'lots_category' and 'lots_pictures')
	 * @param int lot`s id
	 * @return array
	 */

    public function getFullLotInfo(int $lot_id = null)
    {
        if ($lot_id !== null) {
            $query = $this->db->query("SELECT l.*, u.login, c.category, p.picture FROM lots AS l
                LEFT JOIN users AS u ON u.id = l.owner_id
                    LEFT JOIN lots_category AS c ON l.category_id = c.id
                        LEFT JOIN lots_pictures AS p ON l.id = p.lot_id WHERE l.id = $lot_id");
        } else {
            $query = $this->db->query("SELECT l.*, u.login, c.category, p.picture FROM lots AS l
                LEFT JOIN users AS u ON u.id = l.owner_id
                    LEFT JOIN lots_category AS c ON l.category_id = c.id
                        LEFT JOIN lots_pictures AS p ON l.id = p.lot_id");
        }
             
        return $this->show($query);
    }
}