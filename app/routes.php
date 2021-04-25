<?php
use App\Router\Route;
use App\Controllers\{
    MainPageController, ShowLotController, ShowUserController, RegistrationController, LoginController,
    DeleteLotController, ChangeLotController, ChangeUserController, AddLotController, AddCommentController,
    ShowOtherUserController};

return [
    new Route('/', [MainPageController::class, 'showlots']),
    new Route('/registration', [RegistrationController::class, 'registration'], 'authmiddleware'),
    new Route('/login', [LoginController::class, 'login'], 'noauthmiddleware'),
    new Route('/logout', [LoginController::class, 'logout']),
    new Route('/category/{category_id}', [MainPageController::class, 'showcategory']),
    new Route('/category/{category_id}/{lot_id}', [ShowLotController::class, 'showlot']),
    new Route('/managelot/{lot_id}/delete', [DeleteLotController::class, 'deleteLot'], 'authmiddleware'),
    new Route('/managelot/{lot_id}/change', [ChangeLotController::class, 'changeLot'], 'authmiddleware'),
    new Route('/addlot', [AddLotController::class, 'newLot'], 'noauthmiddleware'),
    new Route('/category/{category_id}/{lot_id}/add_comment', [AddCommentController::class, 'addComment'], 'noauthmiddleware'),
    new Route('/user', [ShowUserController::class, 'showuser'], 'authmiddleware'),
    new Route('/user/{user_id}', [ShowOtherUserController::class, 'showotheruser']),
    new Route('/user/{user_id}/change', [ChangeUserController::class, 'changeInformation'], 'authmiddleware'),
    new Route('/index/df/{textinskobka}/{newtext}', [RegistrationController::class, 'testсont'], 'authmiddleware'),

    // new Route('/test/uri', function(){
    //     echo 'Можно и так';
    //   })
];