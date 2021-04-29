<?php
namespace App\Controllers;
use App\Models\Lots;
use App\View\View;

class MainPageController
{   
    public static function showLots(): void
    {
        $lots = ( new Lots )->getAll('lots', [0, 5], true);//
        $categories = ( new Lots )->getAll('lots_category');

        new View('main', ['lots' => $lots, 'categories' => $categories]);
    }

    public static function showCategory(int $category_id): void
    {
        if (!isset($_GET['page']) || $_GET['page'] == 1) {
            $_GET['page'] = 1;
        }

        $lots = (new Lots)->getOne('lots', $category_id, 'category_id', [(($_GET['page'] * 5) - 5), 5]);
        $count = (new Lots)->getTableCount('lots', $category_id, 'category_id');

        if ($count[0][0] % 5 != 0) {
            while ($count[0][0] % 5 != 0) {
                $count[0][0]++;
            }

            $str_count = $count[0][0] / 5;
        }

        new View('showcategory', ['lots' => $lots, 'str_count' => $str_count]);
    }
}