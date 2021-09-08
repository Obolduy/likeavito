<?php
namespace App\Controllers;
use App\Models\Pagination;
use App\View\View;
use Predis\Autoloader;
use Predis\Client;

class MainPageController
{   
    public static function showLots(): void
    {
        Autoloader::register();
        $cache = new Client();

        $lots = $cache->hmget("new_lots", "link_1", "link_2", "link_3", "link_4", "link_5");
        $categories = $cache->hmget("lots_categories", "category_1", "category_2", "category_3", "category_4",
            "category_5", "category_6", "category_7", "category_8");

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
        
        $pagination = new Pagination($category_id);
        $page_count = $pagination->pagination();
        
        new View('showcategory', ['lots' => $lots, 'page_count' => $page_count, 'title' => $category[0]['category']]);
    }
}