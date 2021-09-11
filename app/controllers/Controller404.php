<?php
namespace App\Controllers;

use App\View\View;

class Controller404
{   
    public function error404()
    {
        header("HTTP/1.1 404 Not Found");
        
        new View('404', ['title' => 'Упс... Страница не найдена']);
    }
}