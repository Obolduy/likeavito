<?php
namespace App\Controllers;
use App\Models\Lots;
use App\View\View;

class AddLotController
{   
    public static function newLot(): void
    {
        $base = new Lots();

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $categories = $base->getAll('lots_category');

            new View('addlot', ['categories' => $categories, 'title' => 'Добавление товара']);
        } else {
            if (!is_numeric($_POST['price'])) {
                eader("Location: /addlot");
            }

            $title = strip_tags($_POST['title']);
            $price = strip_tags($_POST['price']);
            $description = strip_tags($_POST['description'], '<p></p><br/><br><i><b><s><u><strong>');
            $photo = $_FILES['photos']['name'];
            $category_id = strip_tags($_POST['category_id']);
            $owner_id = $_SESSION['user']['id'];

            $base->addLot($title, $price, $description, $category_id, $owner_id);

            $lot = $base->getOne('lots', $owner_id, 'owner_id');

            foreach ($lot as $elem) {
                $id = $elem['id'];
            }

            if ($photo) {
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

            header("Location: /category/$category_id/$id");
        }
    }
}