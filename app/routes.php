<?php
use App\Router\Route;
use App\Controllers\{
    MainPageController, ShowLotController, ShowUserController, RegistrationController, LoginController,
    DeleteLotController, ChangeLotController, ChangeUserController, AddLotController, AddCommentController,
    ShowOtherUserController, AdminLoginController, AdminPanelController, AdminChangeUserController, AdminChangeLotController,
    AdminChangeCommentController, AdminDeleteUserController, AdminDeleteLotController, AdminDeleteCommentController};

return [
    new Route('/', [MainPageController::class, 'showlots']),
    new Route('/registration', [RegistrationController::class, 'registration'], 'noauthmiddleware'),
    new Route('/login', [LoginController::class, 'login'], 'noauthmiddleware'),
    new Route('/logout', [LoginController::class, 'logout']),
    new Route('/category/{category_id}', [MainPageController::class, 'showcategory']),
    new Route('/category/{category_id}/{lot_id}', [ShowLotController::class, 'showlot']),
    new Route('/addlot', [AddLotController::class, 'newLot'], 'authmiddleware'),
    new Route('/managelot/{lot_id}/delete', [DeleteLotController::class, 'deleteLot'], 'authmiddleware'),
    new Route('/managelot/{lot_id}/change', [ChangeLotController::class, 'changeLot'], 'authmiddleware'),
    new Route('/category/{category_id}/{lot_id}/add_comment', [AddCommentController::class, 'addComment'], 'authmiddleware'),
    new Route('/user', [ShowUserController::class, 'showuser'], 'authmiddleware'),
    new Route('/user/change', [ChangeUserController::class, 'changeInformation'], 'authmiddleware'),
    new Route('/users/{user_id}', [ShowUserController::class, 'showotheruser']),
    new Route('/admin/login', [AdminLoginController::class, 'adminLogin'], 'adminmiddleware'),
    new Route('/admin', [AdminPanelController::class, 'showAdminPanel'], 'adminmiddleware'),
    new Route('/admin/users', [AdminChangeUserController::class, 'adminShowUsersTable'], 'adminmiddleware'),
    new Route('/admin/lots', [AdminChangeLotController::class, 'adminShowLotsTable'], 'adminmiddleware'),
    new Route('/admin/comments', [AdminChangeCommentController::class, 'adminShowCommentsTable'], 'adminmiddleware'),
    new Route('/admin/change/user/{user_id}', [AdminChangeUserController::class, 'adminChangeUser'], 'adminmiddleware'),
    new Route('/admin/change/lot/{lot_id}', [AdminChangeLotController::class, 'adminChangeLot'], 'adminmiddleware'),
    new Route('/admin/change/comment/{comment_id}', [AdminChangeCommentController::class, 'adminChangeComment'], 'adminmiddleware'),
    new Route('/admin/delete/user/{user_id}', [AdminDeleteUserController::class, 'adminDeleteUser'], 'adminmiddleware'),
    new Route('/admin/delete/lot/{lot_id}', [AdminDeleteLotController::class, 'adminDeleteLot'], 'adminmiddleware'),
    new Route('/admin/delete/comment/{comment_id}', [AdminDeleteCommentController::class, 'adminDeleteComment'], 'adminmiddleware'),
];