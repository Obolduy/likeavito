<?php
namespace App\Models;

class ModelApi extends Model
{
    public function showJson(array $data): string
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}