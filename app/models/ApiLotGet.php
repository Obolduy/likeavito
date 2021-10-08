<?php
namespace App\Models;

class ApiLotGet extends Model
{
    /**
     * Get lot by id
     * @param int lot`s id
     * @return string JSON \w lot information 
     */
    
    public function getLot(int $lot_id): string
    {
        $lot = $this->db->dbQuery("SELECT l.id, l.title, c.category, l.price, l.description,
            u.login, u.owner_id, l.add_time, l.update_time, l.category_id
                FROM lots AS l LEFT JOIN lots_category AS c ON c.id = l.category_id LEFT JOIN users AS u ON u.id=l.owner_id
                    WHERE l.id = ?", [$lot_id])->fetch();

        $lotData = array_merge($lot, ["link" => "http://{$_SERVER['SERVER_NAME']}/category/{$lot['category_id']}/{$lot['id']}"]);

        return json_encode($lotData, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Get lots by user`s id
     * @param int user`s id
     * @return string JSON \w lots information 
     */

    public function getUserLots(int $user_id): string
    {
        $lot = $this->db->dbQuery("SELECT l.id, l.title, c.category, l.price, l.description,
            l.add_time, l.update_time, l.category_id FROM lots AS l
                LEFT JOIN lots_category AS c ON c.id = l.category_id WHERE l.owner_id = ?", [$user_id])->fetch();

        $lotData = array_merge($lot, ["link" => "http://{$_SERVER['SERVER_NAME']}/category/{$lot['category_id']}/{$lot['id']}"]);

        return json_encode($lotData, JSON_UNESCAPED_UNICODE);
    }
}