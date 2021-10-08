<?php
namespace App\Controllers;

use App\Models\CategoriesManipulate;
use App\Models\LotManipulate;
use App\Models\CommentManipulate;

class AdminDeleteCategoryController
{   
    public static function adminDeleteCategory(int $category_id): void
    {
        (new CategoriesManipulate)->deleteCategory($category_id);

        $lotsIds = (new LotManipulate)->deleteCategoryLots($category_id);

        foreach ($lotsIds as $lot) {
            (new CommentManipulate)->deleteLotComments($lot['id']);
        }
        
        header('Location: /admin/categories');
    }
}