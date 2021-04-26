<?php
namespace App\Controllers;
use App\Models\Lots;
use App\View\View;

class MainPageController
{   
    public static function showLots(): void
    {
        $lots = ( new Lots )->getAll('lots');

        new View('main', ['lots' => $lots]);
    }

    public static function showCategory(int $category_id): void
    {
        $lots = ( new Lots )->getOne('lots', 'category_id', $category_id);

        new View('showcategory', ['lots' => $lots]);
    }
}