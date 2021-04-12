<?php
namespace App\Models;

class Lots extends Model
{
    public function __construct()
    {
        $this->db = self::connection();
    }

    /**
	 * Select lot`s id by user`s id
     * @param int user (owner) id
	 * @return array
	 */

    public function selectLotId(int $owner_id)
    {
        $query = $this->db->query("SELECT id FROM lots WHERE owner_id = $owner_id ORDER BY id DESC");

        return $this->show($query);
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

    public function updateLot(string $title, int $price, string $description, int $lot_id): void
    {
        $query = $this->db->prepare("UPDATE lots SET title = ?, price = ?, description = ?, update_time = NOW()
            WHERE id = ?");
        $query->execute([$title, $price, $description, $photo, $lot_id]);
    }

    /**
	 * Adding lot`s pictures (if they are exists).
	 * @param string hashed name of picture
     * @param int lot id
	 * @return void
	 */

    public function addLotPictures(string $picture, int $id): void
    {
        $query = $this->db->prepare("INSERT INTO lots_pictures SET lot_id = ?, picture = ?");
        $query->execute([$id, $picture]);
    }

    public function getAllLots()
    {
        $lots = $this->db->query("SELECT * FROM lots ORDER BY update_time DESC");

        return $this->show($lots);
    }

    public function showLot(int $id)
    {
        $lot = $this->db->getOne('lots', $id);

        return $lot;
    }

    public function showTag($tag)
    {
        $data = $this->base->getTag($tag)->showAll();
        foreach ($data as $elem) {
            $lots .= "<p><a href=\"lots.php?lot={$elem['id']}\">{$elem['title']}</a><br>{$elem['price']}<br>
                {$elem['photo']}<br>{$elem['add_time']}</p>";
        }
        return $lots;
    }

    public function showLots()
    {
        $data = $this->base->getWithout('jobs')->showAll();
        foreach ($data as $elem) {
            $lots .= "<p><a href=\"lots.php?lot={$elem['id']}\">{$elem['title']}</a><br>{$elem['price']}<br>
                {$elem['photo']}<br>{$elem['add_time']}</p>";
        }
        return $lots;
    }

    public function showJobs()
    {
        $data = $this->base->getWithout('lots')->showAll();
        foreach ($data as $elem) {
            $lots .= "<p><a href=\"lots.php?lot={$elem['id']}\">{$elem['title']}</a><br>{$elem['price']}<br>
                {$elem['photo']}<br>{$elem['add_time']}</p>";
        }
        return $lots;
    }

    public function joinColumn($user_id)
    {
        $this->base->query = "SELECT l.id, l.title, l.price, lc.name, l.category_id, l.add_time, l.update_time FROM lots AS l 
            JOIN users AS u JOIN lots_category AS lc ON l.owner_id=u.id AND l.category_id=lc.id WHERE u.id=$user_id";
        $this->base->result = mysqli_query($this->base->link, $this->base->query);

        for ($data = []; $row = mysqli_fetch_assoc($this->base->result); $data[] = $row);
        $content = '<table border=1px solid black>
            <tr>
                <th>Название товара</th>
                <th>Цена товара</th>
                <th>Категория</th>
                <th>Время добавления</th>
                <th>Время изменения</th>
            </tr>';
            foreach ($data as $elem) {
                $content .= "<tr>
                    <td><a href=\"?edit={$elem['id']}\">{$elem['title']}</a></td>
                    <td>{$elem['price']}</td>
                    <td>{$elem['name']}</td>
                    <td>{$elem['add_time']}</td>
                    <td>{$elem['update_time']}</td>
                </tr>";
            }
        $content .= '</table>';
        return $content;
    }
}