<?php
namespace App\Controllers;

use App\Models\CategoriesManipulate;
use App\Models\LotManipulate;
use App\Models\CategoriesGet;
use App\Models\CommentManipulate;
use Predis\Autoloader;
use Predis\Client;

class AdminDeleteCategoryController
{   
    public static function adminDeleteCategory(int $category_id): void
    {
        (new CategoriesManipulate)->deleteCategory($category_id);

        $lotsIds = (new LotManipulate)->deleteCategoryLots($category_id);

        foreach ($lotsIds as $lot) {
            (new CommentManipulate)->deleteLotComments($lot['id']);
        }
        
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

        header('Location: /admin/categories');
    }
}