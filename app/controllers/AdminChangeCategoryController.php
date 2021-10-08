<?php
namespace App\Controllers;

use App\Models\CategoriesGet;
use App\Models\CategoriesManipulate;
use App\View\View;

class AdminChangeCategoryController
{  
    public static function adminShowCategoriesTable(): void
    {
        $categories = (new CategoriesGet)->getAllCategories();

        new View('adminshowcategories', ['categories' => $categories, 'title' => 'Просмотр категорий']);
    }

    public static function adminChangeCategory(int $category_id): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $category = (new CategoriesGet)->getCategory($category_id);

            new View('adminchangecategory', ['category' => $category, 'title' => 'Изменение категории']);
        } else {
            (new CategoriesManipulate)->changeCategory($category_id, trim(strip_tags($_POST['category'])));

            header("Location: /admin/change/category/$category_id");
        }
    }
}