<?php
namespace App\Controllers;;

class ManageLotController
{   
    public function deleteLot(int $lot_id): void
    {
        $base = new Base();
        
        $base->delete('lots_pictures', $lot_id, 'lot_id');
        $base->delete('lots', $lot_id);

        rmdir("img/lots/$lot_id");
    }

    public function changeLot(int $lot_id): void
    {
        $base = new Base();
        $lot = $base->getOne('lots', $lot_id);

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            foreach ($lot as $elem) {
                $title = $elem['title'];
                $price = $elem['price'];
                $description = $elem['description'];
            }
            
            include_once 'C:\OpenServer\domains\likeavito\changelot.php';
        } else {
            if (!is_numeric(strip_tags($_POST['price']))) {
                throw new Exception('Цена должна быть записана числом');
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

            $base->updateLot($_POST['title'], $_POST['price'], $_POST['description'], $lot_id);
        }
    }
}