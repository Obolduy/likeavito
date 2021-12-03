<?php
namespace App\Controllers;

use App\Models\CategoriesGet;
use App\View\View;
use App\Models\CategoriesManipulate;
use Predis\Autoloader;
use Predis\Client;

class AdminAddCategoryController
{   
    public static function addCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            new View('addcategory', ['title' => 'Добавление категории']);
        } else {
            (new CategoriesManipulate)->addCategory(strip_tags(trim($_POST['category'])));

            $categories = (new CategoriesGet)->getAllCategories();

            Autoloader::register();
            $cache = new Client([
                'scheme' => 'tcp',
                'host'   => $_ENV['REDIS_HOST'],
                'port'   => $_ENV['REDIS_PORT'],
            ]);

            $cache->del("lots_categories");
            
            for ($i = 0; $i < count($categories); $i++) {
                $cache->hset("lots_categories", "category_{$categories[$i]['id']}", "<a href=\"/category/{$categories[$i]['id']}/\">{$categories[$i]['category']}</a>");
            }
            
            header("Location: /");
        }
    }
}