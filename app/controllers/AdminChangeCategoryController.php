<?php
namespace App\Controllers;

use App\Models\Categories;
use App\View\View;

class AdminChangeCategoryController
{  
    public static function adminShowCategoriesTable(): void
    {
        $categories = (new Categories)->getAllCategories();

        new View('adminshowcategoriess', ['categories' => $categories, 'title' => 'Просмотр категорий']);
    }

    public static function adminChangeCategory(int $category_id): void
    {
        $categories = new Categories();

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $category = $categories->getCategory($category_id);

            new View('adminchangecategory', ['category' => $category, 'title' => 'Изменение категорию']);
        } else {
            $categories->changeCategory($category_id, trim(strip_tags($_POST['category'])));

            header("Location: /admin/change/category/$category_id");
        }
    }
}