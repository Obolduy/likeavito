<?php
require_once $_SERVER['DOCUMENT_ROOT'] . 'vendor/autoload.php';
use App\Models\SendChangeEmail;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

(new SendChangeEmail)->listenToChangeEmail();