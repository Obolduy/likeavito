<?php
namespace App\Controllers;

use App\Models\Pagination;
use App\Models\LotGet;
use App\View\View;

class AdminChangeLotController
{   
    public static function adminShowLotsTable(): void
    {
        if (!isset($_GET['page']) || $_GET['page'] == 1) {
            $_GET['page'] = 1;
        }

        $lots = new Pagination(($_GET['page'] * 5) - 5);
        $lots->pagination((new LotGet)->getAllLots()->queryString);

        new View('adminshowlots', ['lots' => $lots->table, 'page_count' => $lots->pageCount, 'title' => 'Просмотр товаров']);
    }
}