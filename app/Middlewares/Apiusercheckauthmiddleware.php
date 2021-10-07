<?php
namespace App\Middlewares;

use App\Middlewares\IMiddleware;
use App\Models\Database;

class Apiusercheckauthmiddleware implements IMiddleware
{    
    public function middleware($uri)
    {
        preg_match('#/[0-9]+#', $_SERVER['REQUEST_URI'], $lotId);
        $lotId = preg_replace('#/#', '', $lotId);

        $database = new Database();

        $lotOwner = $database->dbQuery("SELECT owner_id FROM lots WHERE id = ?", [$lotId])->fetchColumn();
        
        if (!$database->dbQuery("SELECT id FROM api_user_tokens WHERE user_id = ?", [$lotOwner])) {
            header('HTTP/1.0 200');
            header('Content-Type: application/json; charset=UTF-8');
            
            echo json_encode(["error" => "That`s not you`re lot"]); die();
        }
    }
}