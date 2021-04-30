<?php
namespace App\Controllers;
use App\Models\Lots;
use App\View\View;

class MainPageController
{   
    public static function showLots(): void
    {
        $lot = new Lots();

        $lots = $lot->getAll('lots', [0, 5], true);
        $categories = $lot->getAll('lots_category');

        new View('main', ['lots' => $lots, 'categories' => $categories, 'title' => 'Главная страница']);
    }

    public static function showCategory(int $category_id): void
    {
        if (!isset($_GET['page']) || $_GET['page'] == 1) {
            $_GET['page'] = 1;
        }

        $lot = new Lots();

        $category = $lot->getOne('lots_category', $category_id);
        $lots = $lot->getOne('lots', $category_id, 'category_id', [(($_GET['page'] * 5) - 5), 5]);
        $count = $lot->getTableCount('lots', $category_id, 'category_id');

        if ($count[0][0] % 5 != 0) {
            while ($count[0][0] % 5 != 0) {
                $count[0][0]++;
            }

            $page_count = $count[0][0] / 5;
        }

        new View('showcategory', ['lots' => $lots, 'page_count' => $page_count, 'title' => $category[0]['category']]);
    }
}