<?php
namespace App\Controllers;
use App\Models\Lots;
use App\View\View;

class AdminShowLotsController
{   
    public function adminShowLotsTable()
    {
        $list = (new Lots)->getAll('lots');

        new View('adminshowlots');
    }
}