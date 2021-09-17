<?php
namespace App\Controllers;

use App\Models\Categories;
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

        $category = (new Categories)->getCategory($category_id);
            
        $pagination = new Pagination('lots', (($_GET['page'] * 5) - 5));
        $pagination->pagination('category_id', $category_id);

        new View('showcategory', ['lots' => $pagination->table, 'page_count' => $pagination->pageCount, 'title' => $category['category']]);
    }
}