<?php
namespace App\Models;

class ModelApi extends Model
{
    /**
     * Returns JSON \w unicode
     * @param array
     * @return string unicode JSON 
     */
    
    public function showJson(array $data): string
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}