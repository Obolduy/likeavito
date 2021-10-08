<?php
namespace App\Models;

use App\Models\LotManipulate;

class ApiLotManipulate extends Model
{
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

        $this->db->dbQuery("$query update_time = now() WHERE id = ?", $execute);

        $lot = $this->db->dbQuery("SELECT id, category_id FROM lots WHERE id = ?", [$lot_id])->fetch();
                    
        $lotData = ["id" => $lot['id'], "link" => "http://{$_SERVER['SERVER_NAME']}/category/{$lot['category_id']}/{$lot['id']}"];

        return json_encode($lotData, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Delete lot by id
     * @param int lot`s id
     * @return string JSON \w information 
     */

    public function deleteLot(int $lot_id): string
    {
        (new LotManipulate)->deleteLot($lot_id);
        return json_encode(['Success!' => 'Lot has deleted'], JSON_UNESCAPED_UNICODE);
    }
}