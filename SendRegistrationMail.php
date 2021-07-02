<?php
require_once 'vendor/autoload.php';
use App\Models\SendRegistrationEmail;

(new SendRegistrationEmail)->listenToRegistrationEmail();