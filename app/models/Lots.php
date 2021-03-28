<?php

require_once 'classes.php';

class Lots
{    
    public function newLot(): void
    {
        $title = strip_tags($_POST['title']);
        $price = strip_tags($_POST['price']);
        $description = strip_tags($_POST['description']);
        $photo = $_FILES['photos']['name'];
        $category_id = strip_tags($_POST['category_id']);
        $owner_id = $_SESSION['user_id'];

        $path = 'img/';

        $base = new Base();
        
        foreach ($photo as $elem) {
            $photos[] = $elem;
            foreach ($_FILES['photos']['tmp_name'] as $dif) {
                copy($dif, $path . $elem);
            }
        }
        $photo = implode(',', $photos);
        
        //var_dump($photos);

       // for ($i = 0; $i < count($_FILES['photos']['tmp_name']); $i++) {
            //$photo .= preg_replace('#Array#', '', $_FILES['photos']['tmp_name'][$i]);
            //copy($_FILES['photos']['tmp_name'], $path . $_FILES['photos']['name']);
            //echo $_FILES['photos']['tmp_name'][$i];
       // }
        //$photo = preg_replace('#Array#', '', $photo);
        //echo $photo;
        //copy($_FILES['photos']['tmp_name'][0], $path . $_FILES['photos']['name']);

        // НАДО ПОЛУЧИТЬ ПУТЬ ЗАХЕШИРОВАТЬ ЕГО И ПЕРЕДАТЬ В БД А ПОТОМ ЕЩЕ И ВЫВЕСТИ ЭТО КАК ТО
        
        $base->addLot($title, $price, $description, $photo, $category_id, $owner_id);

        header('Location: index.php'); die();
    }

    public function getForm($lot_id)
    {
        $base = new Base();

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $lot = $base->getOne('lots', $lot_id);

            foreach($lot as $elem) {
                $title = $elem['title'];
                $price = $elem['price'];
                $description = $elem['description'];
            }

            include_once 'file with this form';

            $content = "<br><form method=POST>
            <input type=\"text\" name=\"title\" value=\"{$lot['title']}\"><br><br>
            <input type=\"text\" name=\"price\" value=\"{$lot['price']}\"><br><br>
            <textarea name=\"description\" placeholder=\"type text\">{$lot['description']}</textarea><br><br>
            <input name=\"delete\" type=\"checkbox\" value=\"1\"> Удалить <br><br>
            <input type=\"submit\" name=\"submit\">
            </form>";

            return $content;
        }
    }

    public function changeLot(string $title, int $price, string $description, string $photo, int $lot_id)
    {        
        if (!is_numeric(strip_tags($price))) {
            throw new Exception('Цена должна быть записана числом');
        }

        $base = new Base();

        if ($photo) {
            $base->updateLot(strip_tags($title), strip_tags($price), strip_tags($description), $lot_id, strip_tags($photo));
        } else {
            $base->updateLot(strip_tags($title), strip_tags($price), strip_tags($description), $lot_id);
        }

        return 'Лот изменен успешно';
    }

    public function deleteLot(int $lot_id): void
    {
        $base = new Base();

        $base->delete('lots', $lot_id);

        //echo 'Лот успешно удален';
    }

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