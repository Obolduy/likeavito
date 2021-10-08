<?php
namespace App\Models;

use App\Models\ApiLotGet;

class ApiLotValidate extends Model
{
    public function checkOwnerId(int $userId, int $lotId): bool
    {
        $lot = (new ApiLotGet)->getLot($lotId);

        return ($lot['owner_id'] == $userId) ? true : false;
    }
}