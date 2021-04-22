<?php
namespace App\Controllers;
use App\View\View;

class AdminPanelController
{   
    public function showAdminPanel()
    {
        new View('adminpanel');
    }
}