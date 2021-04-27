<?php
namespace App\Controllers;
use App\View\View;

class AdminPanelController
{   
    public static function showAdminPanel()
    {
        new View('adminpanel');
    }
}