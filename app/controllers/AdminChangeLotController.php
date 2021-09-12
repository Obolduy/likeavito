<?php
namespace App\Controllers;

use App\Models\Pagination;
use App\View\View;

class AdminChangeLotController
{   
    public static function adminShowLotsTable(): void
    {
        $lots = (new Pagination('lots', (($_GET['page'] * 10) - 10)))->pagination();

        new View('adminshowlots', ['lots' => $lots, 'title' => 'Просмотр товаров']);
    }
}