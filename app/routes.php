<?php
use App\Router\Route;
use App\Controllers\TestController;

return [
    new Route('/test/uri', [TestController::class, 'testFunc'])
    // new Route('/test/uri', function(){
    //     echo 'Можно и так';
    //   })
];