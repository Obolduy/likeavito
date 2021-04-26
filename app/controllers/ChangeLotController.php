<?php
namespace App\Controllers;
use App\Models\Lots;
use App\View\View;

class ChangeLotController
{   
    public static function changeLot(int $lot_id): void
    {
        $base = new Lots();
        $lot = $base->getOne('lots', $lot_id);

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {            
            new View('changelot', ['lot' => $lot]);
        } else {
            if (!is_numeric(strip_tags($_POST['price']))) {
                echo 'Цена должна быть записана числом';
                
                new View('changelot', ['lot' => $lot]);
            }

            if ($_FILES['photos']['name']) {
                if (!is_dir("img/lots/$lot_id")) {
                    mkdir("img/lots/$lot_id");
                }

                $dir = "img/lots/$lot_id";
                $ext = '';

                for ($i = 0; $i <= count($_FILES['photos']); $i++) {
                    preg_match_all('#\.[A-Za-z]{3,4}$#', $_FILES['photos']['name'][$i], $ext);
                    $name = md5($_FILES['photos']['name'][$i]) . $ext[0][0];
                    move_uploaded_file($_FILES['photos']['tmp_name'][$i], "$dir/$name");

                    $base->addLotPictures($name, $id);
                }
            }

            $base->update("UPDATE lots SET title = ?, price = ?, description = ?, update_time = now() WHERE id = ?",
                [strip_tags($_POST['title']), strip_tags($_POST['price']), strip_tags($_POST['description']), $lot_id]);
        }
    }
}