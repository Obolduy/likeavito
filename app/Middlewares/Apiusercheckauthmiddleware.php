<?php
namespace App\Middlewares;

use App\Middlewares\IMiddleware;
use App\Models\Model;

class Apiusercheckauthmiddleware implements IMiddleware
{    
    public function middleware($uri)
    {
        preg_match('#/[0-9]+#', $_SERVER['REQUEST_URI'], $lot_id);
        $lot_id = preg_replace('#/#', '', $lot_id);

        $model = new Model();
        $lot_owner = $model->getOne('lots', $lot_id[0]);
        
        if ($model->getOne('api_user_tokens', $lot_owner[0]['owner_id'], 'user_id') == null) {
            header('HTTP/1.0 200');
            header('Content-Type: application/json; charset=UTF-8');
            
            echo json_encode(["error" => "That`s not you`re lot"]); die();
        }
    }
}