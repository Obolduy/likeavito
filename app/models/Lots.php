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
	 * Adding pictures to lots table
	 * @param string hash name of picture
     * @param int lot id
	 * @return void
	 */

    public function addLotPictures(string $picture, int $id): void
    {
        $query = $this->db->prepare("INSERT INTO lots_pictures SET lot_id = ?, picture = ?");
        $query->execute([$id, $picture]);
    }

    /**
	 * Get left join query with full (\w no pictures) lot (or all lots if ID is null) info (from 'lots', 'users', 'lots_category')
	 * @param int lot`s id
	 * @return array
	 */

    public function getFullLotInfo(int $lot_id = null)
    {
        if ($lot_id !== null) {
            $query = $this->db->query("SELECT l.*, u.login, c.category FROM lots AS l
                LEFT JOIN users AS u ON u.id = l.owner_id
                    LEFT JOIN lots_category AS c ON l.category_id = c.id WHERE l.id = $lot_id");
        } else {
            $query = $this->db->query("SELECT l.*, u.login, c.category FROM lots AS l
                LEFT JOIN users AS u ON u.id = l.owner_id
                    LEFT JOIN lots_category AS c ON l.category_id = c.id");
        }
             
        return $this->show($query);
    }
}