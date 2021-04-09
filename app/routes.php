<?php
use App\Router\Route;
use App\Controllers\{TestController, RegistrationController};

return [
    new Route('/test/uri', [TestController::class, 'testFunc']),
    new Route('/registration', [RegistrationController::class, 'registration']),
    new Route('/index/df/{textinskobka}/{newtext}', [RegistrationController::class, 'testсont']),

    // new Route('/test/uri', function(){
    //     echo 'Можно и так';
    //   })
];