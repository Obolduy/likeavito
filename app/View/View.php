<?php
namespace App\View;

class View
{
    public function __construct(string $view)
    {
        if (file_exists("{$_SERVER['DOCUMENT_ROOT']}/App/View/Views/$view.php")) {
            include_once "{$_SERVER['DOCUMENT_ROOT']}/App/View/Views/$view.php";
        } else {
            echo 'Такого представления нет';
        }
    }
}