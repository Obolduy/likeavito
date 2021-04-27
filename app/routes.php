<?php
use App\Router\Route;
use App\Controllers\{
    MainPageController, ShowLotController, ShowUserController, RegistrationController, LoginController,
    DeleteLotController, ChangeLotController, ChangeUserController, AddLotController, AddCommentController,
    ShowOtherUserController, AdminLoginController, AdminPanelController, AdminChangeUserController, AdminChangeLotController,
    AdminChangeCommentController, AdminDeleteUserController, AdminDeleteLotController, AdminDeleteCommentController};

return [
    new Route('/', [MainPageController::class, 'showlots']),
    new Route('/registration', [RegistrationController::class, 'registration'], 'authmiddleware'),
    new Route('/login', [LoginController::class, 'login'], 'noauthmiddleware'),
    new Route('/logout', [LoginController::class, 'logout']),
    new Route('/category/{category_id}', [MainPageController::class, 'showcategory']),
    new Route('/category/{category_id}/{lot_id}', [ShowLotController::class, 'showlot']),
    new Route('/addlot', [AddLotController::class, 'newLot'], 'noauthmiddleware'),
    new Route('/managelot/{lot_id}/delete', [DeleteLotController::class, 'deleteLot'], 'authmiddleware'),
    new Route('/managelot/{lot_id}/change', [ChangeLotController::class, 'changeLot'], 'authmiddleware'),
    new Route('/category/{category_id}/{lot_id}/add_comment', [AddCommentController::class, 'addComment'], 'noauthmiddleware'),
    new Route('/user', [ShowUserController::class, 'showuser'], 'authmiddleware'),
    new Route('/user/change', [ChangeUserController::class, 'changeInformation'], 'authmiddleware'),
    new Route('/users/{user_id}', [ShowUserController::class, 'showotheruser']),
    new Route('/admin/login', [AdminLoginController::class, 'adminLogin']),
    new Route('/admin', [AdminPanelController::class, 'showAdminPanel']),
    new Route('/admin/users', [AdminChangeUserController::class, 'adminShowUsersTable']),
    new Route('/admin/lots', [AdminChangeLotController::class, 'adminShowLotsTable']),
    new Route('/admin/comments', [AdminChangeCommentController::class, 'adminShowCommentsTable']),
    new Route('/admin/change/user/{user_id}', [AdminChangeUserController::class, 'adminChangeUser']),
    new Route('/admin/change/lot/{lot_id}', [AdminChangeLotController::class, 'adminChangeLot']),
    new Route('/admin/change/comment/{comment_id}', [AdminChangeCommentController::class, 'adminChangeComment']),
    new Route('/admin/delete/user/{user_id}', [AdminDeleteUserController::class, 'adminDeleteUser']),
    new Route('/admin/delete/lot/{lot_id}', [AdminDeleteLotController::class, 'adminDeleteLot']),
    new Route('/admin/delete/comment/{comment_id}', [AdminDeleteCommentController::class, 'adminDeleteComment']),
    new Route('/index/df/{textinskobka}/{newtext}', [RegistrationController::class, 'testсont'], 'authmiddleware'),
];