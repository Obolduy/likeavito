<?php
namespace App\Controllers;

use App\Models\CategoriesGet;
use App\Models\CategoriesManipulate;
use App\View\View;
use Predis\Autoloader;
use Predis\Client;

class AdminChangeCategoryController
{  
    public static function adminShowCategoriesTable(): void
    {
        $categories = (new CategoriesGet)->getAllCategories();

        new View('adminshowcategories', ['categories' => $categories, 'title' => 'Просмотр категорий']);
    }

    public static function adminChangeCategory(int $category_id): void
    {
        $categories = new CategoriesGet();

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $category = $categories->getCategory($category_id);

            new View('adminchangecategory', ['category' => $category, 'title' => 'Изменение категории']);
        } else {
            (new CategoriesManipulate)->changeCategory($category_id, trim(strip_tags($_POST['category'])));

            $categories = $categories->getAllCategories();

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

            header("Location: /admin/change/category/$category_id");
        }
    }
}