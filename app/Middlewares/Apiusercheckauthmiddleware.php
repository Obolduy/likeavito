<?php
namespace App\Middlewares;

use App\Middlewares\IMiddleware;
use App\Models\ApiUserGet;
use App\Models\ApiLotValidate;

class Apiusercheckauthmiddleware implements IMiddleware
{    
    public function middleware($uri)
    {
        preg_match('#\d+#', $_SERVER['REQUEST_URI'], $lotId);

        $userId = (new ApiUserGet)->getIdViaToken($_COOKIE['api_token']);
        $check = (new ApiLotValidate)->checkOwnerId($userId, $lotId[0]);
        
        if (!$check) {
            header('HTTP/1.0 200');
            header('Content-Type: application/json; charset=UTF-8');
            
            echo json_encode(["error" => "That`s not you`re lot"]); die();
        }
    }
}