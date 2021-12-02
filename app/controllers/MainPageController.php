<?php
namespace App\Controllers;

use App\Models\{CategoriesGet, LotGet, UserGet, Pagination};
use App\View\View;
use Predis\Autoloader;
use Predis\Client;

class MainPageController
{   
    public static $sortByWhiteList = ['title', 'price', 'city', 'add_time'];

    public static function showLots(): void
    {
        Autoloader::register();
        $cache = new Client();

        if (!$cache->hgetall("new_lots") || !$cache->hgetall("lots_categories")) {
            self::cacheFiller($cache);
        }

        new View('main', ['lots' => $cache->hgetall("new_lots"), 'categories' => $cache->hgetall("lots_categories"), 'title' => 'Главная страница']);
    }

    public static function showCategory(int $category_id): void
    {
        $_GET['page'] = (int)$_GET['page'];

        if ($_GET['page'] == 0) {
            $_GET['page'] = 1;
        }

        if (!isset($_GET['page']) || $_GET['page'] == 1) {
            $_GET['page'] = 1;
        }

        $sortBy = $_GET['sort'];

        if (!in_array($sortBy, self::$sortByWhiteList)) {
            $sortBy = null;
        }

        $lotGet = new LotGet();

        $category = $lotGet->getLotsByCategoryId($category_id, $sortBy);
        
        $pagination = new Pagination((($_GET['page'] * 5) - 5));
        $pagination->pagination($category->queryString);
        
        if ($_SESSION['user']) {
            $user = (new UserGet)->getUser($_SESSION['user']['id']);
            $lots = $lotGet->sortLotsByUserCity($user['city'], $pagination->table);
        } else {
            $lots = $pagination->table;
        }
        
        foreach ($lots as $lot) {
            if ($getPic = $lotGet->getLotMainPicture($lot['id'])) {
                $lotsPictures['lot_id'] = $getPic['lot_id'];
                $lotsPictures['picture'] = $getPic['picture'];
                $lotsPictures['id'] = $getPic['id'];
            }
        }
        
        $category = $category->fetch();

        new View('showcategory', ['lots' => $lots, 'lots_pictures' => $lotsPictures, 'page_lot_count' => $pagination->pageCount, 'title' => $category['category']]);
    }

    /**
     * Fills Redis with data for main page from DB
     * @param Client Predis client object 
     * @return void
     */

    private static function cacheFiller(Client $cache): void
    {
        $lots = (new LotGet)->getLotsForCache();
        $categories = (new CategoriesGet)->getAllCategories();

        $lot_count = 1;
        $lots_array = [];
        
        foreach ($lots as $lot) {
            $lots_array["link_$lot_count"] = "<a href=\"/category/{$lot['category_id']}/{$lot['id']}\">{$lot['title']}</a>";
            $lot_count++;
        }

        $category_count = 1;
        $categories_array = [];

        foreach ($categories as $category) {
            $categories_array["category_$category_count"] = "<a href=\"/category/{$category['id']}/\">{$category['category']}</a>";
            $category_count++;
        }

        $cache->hmset("lots_categories", $categories_array);
        $cache->hmset("new_lots", $lots_array);
    }
}