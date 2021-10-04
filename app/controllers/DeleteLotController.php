<?php
namespace App\Controllers;

use App\Models\LotManipulate;
use App\Models\LotGet;
use Predis\Autoloader;
use Predis\Client;

class DeleteLotController
{   
    public static function deleteLot(int $lot_id): void
    {
        $lotGet = new LotGet();

        $checkUser = $lotGet->getFullLotInfo($lot_id);

        if ($checkUser['LotInfo']['owner_id'] == $_SESSION['user']['id']) {
            (new LotManipulate)->deleteLot($lot_id);

            $lots = $lotGet->getLotsForCache();
            
            Autoloader::register();
            $cache = new Client();

            for ($i = 1; $i <= 5; $i++) {
                $cache->hmset("new_lots", [
                    "link_$i" => "<a href=\"/category/{$lots[$i - 1]['category_id']}/{$lots[$i - 1]['id']}\">{$lots[$i - 1]['title']}</a>"
                ]);
            }

            header('Location: /'); die();
        }

        header('Location: /user/showlots');
    }
}