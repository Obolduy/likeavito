<?php
namespace App\Models;

class LotsApi extends ModelApi
{
    public function __construct()
    {
        $this->db = self::connection();
    }

    public function getLot(int $lot_id)
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

    public function getUsersLots(int $user_id)
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

    public function changeLot(int $lot_id, $data)
    {
        $array = json_decode($data, true);

        $query = $this->db->prepare("UPDATE lots SET title = ?, price = ?, category_id = ?, description = ?, update_time = now()
            WHERE id = ?");
        $query->execute([$array['title'], $array['price'], $array['category_id'], $array['description'], $lot_id]);

        $query = $this->db->query("SELECT id, category_id FROM lots WHERE id = $lot_id");
                    
        $dataArray = $this->show($query);

        foreach ($dataArray as $elem) {
            $lotData[] = ["id" => $elem['id'], "link" => "http://likeavito/category/{$elem['category_id']}/{$elem['id']}"];
        }

        return $this->showJson($lotData);
    }
}