<?php
namespace App\Controllers;
use App\View\View;

class RedirectController
{   
    public static function redirect()
    {
        new View('redirect', ['link' => $_GET['link'], 'title' => "Подтвердите переход на {$_GET['link']}"]);
    }
}