<?php
namespace App\Models;
use App\Models\Interfaces\iDatabase;

class Lot
{
    private $db;

    public function __construct(iDatabase $db = null)
    {
        $this->db = $db ?? DEFAULT_DB_CONNECTION;
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
        $this->db->dbQuery("INSERT INTO lots SET owner_id = ?, category_id = ?, title = ?, price = ?, 
            description = ?, add_time = NOW(), update_time = NOW()",
                [$owner_id, $category_id, $title, $price, $description]);
    }

    /**
	 * Get left join query with full (\w no pictures) lot (or all lots if ID is null) info (from 'lots', 'users', 'lots_category')
	 * @param int lot`s id
	 * @return array
	 */

    public function getFullLotInfo(int $lot_id = null)
    {
        if ($lot_id !== null) {
            return $this->db->dbQuery("SELECT l.*, u.login, c.category FROM lots AS l
                LEFT JOIN users AS u ON u.id = l.owner_id
                    LEFT JOIN lots_category AS c ON l.category_id = c.id WHERE l.id = $lot_id");
        } else {
            return $this->db->dbQuery("SELECT l.*, u.login, c.category FROM lots AS l
                LEFT JOIN users AS u ON u.id = l.owner_id
                    LEFT JOIN lots_category AS c ON l.category_id = c.id");

                    /////////////
        }
    }

    public function getPageWithLots(int $categoryId, int $border1, int $border2 = 5): array
    {
        return $this->db->dbQuery("SELECT * FROM lots WHERE category_id = ? LIMIT ?, ?",
                [$categoryId, $border1, $border2])->fetchAll();
    }
}