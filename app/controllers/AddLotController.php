<?php
namespace App\Controllers;
use App\Models\Lots;
use App\View\View;

class AddLotController
{   
    public function newLot(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            new View('addlot');
        } else {
            if (!is_numeric($_POST['price'])) {
                throw new Exception('Цена должна быть записана числом');
            }

            $title = strip_tags($_POST['title']);
            $price = strip_tags($_POST['price']);
            $description = strip_tags($_POST['description']);
            $photo = $_FILES['photos']['name'];
            $category_id = strip_tags($_POST['category_id']);
            $owner_id = $_SESSION['user']['id'];

            $base = new Lots();
            $base->addLot($title, $price, $description, $category_id, $owner_id);

            if ($photo) {
                $lot = $base->selectLotId($owner_id);
                $id = $lot[0][0];

                mkdir("img/lots/$id");

                $dir = "img/lots/$id";
                $ext = '';

                for ($i = 0; $i <= count($_FILES['photos']); $i++) {
                    preg_match_all('#\.[A-Za-z]{3,4}$#', $_FILES['photos']['name'][$i], $ext);
                    $name = md5($_FILES['photos']['name'][$i]) . $ext[0][0];
                    move_uploaded_file($_FILES['photos']['tmp_name'][$i], "$dir/$name");

                    $base->addLotPictures($name, $id);
                }
            }

            header('Location: index.php'); die();
        }
    }
}