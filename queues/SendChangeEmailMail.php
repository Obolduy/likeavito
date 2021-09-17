<?php
require_once $_SERVER['DOCUMENT_ROOT'] . 'vendor/autoload.php';
use App\Models\SendChangeEmail;

(new SendChangeEmail)->listenToChangeEmail();