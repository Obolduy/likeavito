<?php
namespace App\Models;

class LotsApi extends ModelApi
{
    public function __construct()
    {
        $this->db = self::connection();
    }

    public function getUsersLots(int $user_id)
    {
        $query = $this->db->query("SELECT l.id, l.title, c.category, l.price, l.description, l.add_time, l.update_time FROM lots AS l
            LEFT JOIN lots_category AS c ON c.id = u.category_id WHERE l.owner_id = $user_id");
                    
        $dataArray = $this->show($query);

        foreach($dataArray as $elem) {
            $lotData[] = ["id" => $elem['id'], "title" => $elem['title'], "category" => $elem['category'],
                "price" => $elem['price'], "description" => $elem['description'],
                    "add_time" => $elem['add_time'], "update_time" => $elem['update_time']];
        }

        return $this->showJson($lotData);
    }
}