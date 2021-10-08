<?php
namespace App\Controllers;

use App\View\View;
use App\Models\CategoriesManipulate;

class AdminAddCategoryController
{   
    public static function addCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            new View('addcategory', ['title' => 'Добавление категории']);
        } else {
            (new CategoriesManipulate)->addCategory(strip_tags(trim($_POST['category'])));
            
            header("Location: /");
        }
    }
}