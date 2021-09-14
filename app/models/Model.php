<?php
namespace App\Models;

use App\Models\Interfaces\iDatabase;
use App\Models\Database;

class Model
{
    protected $db;

    public function __construct(iDatabase $db = null)
    {
        $this->db = $db ?? new Database();
    }
}