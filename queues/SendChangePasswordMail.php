<?php
require_once $_SERVER['DOCUMENT_ROOT'] . 'vendor/autoload.php';
use App\Models\SendChangePasswordEmail;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

(new SendChangePasswordEmail)->listenToChangePasswordEmail();