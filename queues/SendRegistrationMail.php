<?php
require_once $_SERVER['DOCUMENT_ROOT'] . 'vendor/autoload.php';
use App\Models\SendRegistrationEmail;

(new SendRegistrationEmail)->listenToRegistrationEmail();