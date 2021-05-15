<?php
namespace App\Models;
use App\Controllers\DeleteLotController;

class LotsApi extends ModelApi
{
    public function __construct()
    {
        $this->db = self::connection();
    }

    /**
     * Get lot by id
     * @param int lot`s id
     * @return string JSON \w lot information 
     */
    public function getLot(int $lot_id): string
    {
        $query = $this->db->query("SELECT l.id, l.title, c.category, l.price, l.description,
            u.login, l.add_time, l.update_time, l.category_id
                FROM lots AS l LEFT JOIN lots_category AS c ON c.id = l.category_id LEFT JOIN users AS u ON u.id=l.owner_id
                    WHERE l.id = $lot_id");
                    
        $dataArray = $this->show($query);

        foreach ($dataArray as $elem) {
            $lotData[] = ["id" => $elem['id'], "title" => $elem['title'], "category" => $elem['category'],
                "price" => $elem['price'], "description" => $elem['description'], "owner_login" => $elem['login'],
                    "add_time" => $elem['add_time'], "update_time" => $elem['update_time'],
                        "link" => "http://likeavito/category/{$elem['category_id']}/{$elem['id']}"];
        }

        return $this->showJson($lotData);
    }

    /**
     * Get lots by user`s id
     * @param int user`s id
     * @return string JSON \w lots information 
     */

    public function getUsersLots(int $user_id): string
    {
        $query = $this->db->query("SELECT l.id, l.title, c.category, l.price, l.description,
            l.add_time, l.update_time, l.category_id FROM lots AS l
                LEFT JOIN lots_category AS c ON c.id = l.category_id WHERE l.owner_id = $user_id");
                    
        $dataArray = $this->show($query);

        foreach ($dataArray as $elem) {
            $lotData[] = ["id" => $elem['id'], "title" => $elem['title'], "category" => $elem['category'],
                "price" => $elem['price'], "description" => $elem['description'],
                    "add_time" => $elem['add_time'], "update_time" => $elem['update_time'],
                        "link" => "http://likeavito/category/{$elem['category_id']}/{$elem['id']}"];
        }

        return $this->showJson($lotData);
    }

    /**
     * Change lot by id
     * @param int user`s id
     * @param array json_decode array
     * @return string JSON \w lot information 
     */

    public function changeLot(int $lot_id, array $data): string
    {
        $query = "UPDATE lots SET ";
        foreach ($data as $key => $value) {
            $query .= "$key = ?, ";
            $execute[] = $value;
        }
        $execute[] = $lot_id;

        $query = $this->db->prepare("$query update_time = now() WHERE id = ?");
        $query->execute($execute);

        $query = $this->db->query("SELECT id, category_id FROM lots WHERE id = $lot_id");
                    
        $dataArray = $this->show($query);

        foreach ($dataArray as $elem) {
            $lotData[] = ["id" => $elem['id'], "link" => "http://likeavito/category/{$elem['category_id']}/{$elem['id']}"];
        }

        return $this->showJson($lotData);
    }

    /**
     * Delete lot by id
     * @param int lot`s id
     * @return string JSON \w information 
     */

    public function deleteLot(int $lot_id): string
    {
        DeleteLotController::deleteLot($lot_id);

        return $this->showJson(['Success!' => 'Lot has deleted']);
    }
}