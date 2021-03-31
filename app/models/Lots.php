<?php
namespace App\Models;

class Lots
{

    public function showLot(int $id)
    {
        $one = $this->base->getOne('lots', $id, 'id');
        $lots .= "
            <h2><p>{$one['title']}</p></h2>
            <h5><p>{$one['price']}₽</p></h5>
            <p><img src=\"img/{$one['photo']}\" alt=\"Здесь должна быть картинка\" width=\"480\" height=\"480\"></p>
            <h4><p>{$one['description']}</p></h4>
            <p><a href=\"/index.php?tag={$one['name']}\">{$one['name']}</a></p>
            <h6>Добавлено: <p>{$one['add_time']}</p></h6>";
        return $lots;
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

    public function showAllLots()
    {
        $data = $this->base->getAll('lots')->showAll();
        foreach ($data as $elem) {
            $lots .= "<p><a href=\"lots.php?lot={$elem['id']}\">{$elem['title']}</a><br>{$elem['price']}<br>
            <img src=\"img/{$elem['photo']}\" alt=\"Здесь должна быть картинка\" width=\"400\" height=\"360\"><br>{$elem['add_time']}<br><br></p>";
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