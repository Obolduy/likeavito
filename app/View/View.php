<?php
namespace App\View;

class View
{
    public function __construct(string $view, ...$params)
    {
        if (file_exists("{$_SERVER['DOCUMENT_ROOT']}/App/View/Views/$view.php")) {
            if ($params) {
                foreach ($params[0] as $key => $value) {
                    $$key = $params[0][$key];
                }
            }
            
            include_once "{$_SERVER['DOCUMENT_ROOT']}/App/View/Views/layout.php";
        } else {
            echo 'Такого представления нет';
        }
    }
}