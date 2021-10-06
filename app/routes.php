<?php
use App\Router\Route;
use App\Controllers\{
    MainPageController, ShowLotController, ShowUserController, RegistrationController, LoginController,
    DeleteLotController, ChangeLotController, ChangeUserController, AddLotController, AddCommentController,
    ShowOtherUserController, AdminLoginController, AdminPanelController, AdminChangeUserController, AdminChangeLotController,
    AdminChangeCommentController, AdminDeleteUserController, AdminDeleteLotController, AdminDeleteCommentController,
    ResetPasswordController, ApiGetUserController, ApiGetLotController, ApiChangeLotController, ApiAuthUserController,
    ApiDeleteLotController, ChangeCommentController, DeleteCommentController, ChatController, RedirectController,
    ChangeEmailController, ChangePasswordController};

return [
    new Route('/api/login', [ApiAuthUserController::class, 'apiLoginUser']),
    new Route('/api/getuser/{user_id}', [ApiGetUserController::class, 'apiGetUser']),
    new Route('/api/getuser/{user_id}/lots', [ApiGetLotController::class, 'apiGetUsersLots']),
    new Route('/api/getlot/{lot_id}', [ApiGetLotController::class, 'apiGetLot']),
    new Route('/api/changelot/{lot_id}', [ApiChangeLotController::class, 'apiChangeLot'], ['apiauthmiddleware', 'apiusercheckauthmiddleware']),
    new Route('/api/deletelot/{lot_id}', [ApiDeleteLotController::class, 'apiDeleteLot'], ['apiauthmiddleware', 'apiusercheckauthmiddleware']),
    new Route('/', [MainPageController::class, 'showlots']),
    new Route('/redirect', [RedirectController::class, 'redirect']),
    new Route('/chat/{user_id}', [ChatController::class, 'openchat'], ['authmiddleware', 'banmiddleware']),
    new Route('/chat/refresh/{chat_name}', [ChatController::class, 'refreshchat'], ['authmiddleware', 'banmiddleware']),
    new Route('/chat/sendmessage/{chat_name}', [ChatController::class, 'controllerSendMessage'], ['authmiddleware', 'banmiddleware']),
    new Route('/registration', [RegistrationController::class, 'registration'], ['noauthmiddleware']),
    new Route('/registration/{user_id}/{token}', [RegistrationController::class, 'verifyemail'], ['authmiddleware']),
    new Route('/login', [LoginController::class, 'login'], ['noauthmiddleware']),
    new Route('/logout', [LoginController::class, 'logout']),
    new Route('/category/{category_id}', [MainPageController::class, 'showcategory']),
    new Route('/category/{category_id}/{lot_id}', [ShowLotController::class, 'showlot']),
    new Route('/category/{category_id}/{lot_id}/addcomment', [AddCommentController::class, 'addComment'], ['authmiddleware', 'emailcheckmiddleware', 'banmiddleware']),
    new Route('/addlot', [AddLotController::class, 'newLot'], ['authmiddleware', 'emailcheckmiddleware', 'banmiddleware']),
    new Route('/managelot/{lot_id}/delete', [DeleteLotController::class, 'deleteLot'], ['authmiddleware', 'emailcheckmiddleware']),
    new Route('/managelot/{lot_id}/change', [ChangeLotController::class, 'changeLot'], ['authmiddleware', 'emailcheckmiddleware', 'banmiddleware']),
    new Route('/changecomment/{comment_id}', [ChangeCommentController::class, 'changeComment'], ['authmiddleware', 'emailcheckmiddleware', 'banmiddleware']),
    new Route('/deletecomment/{comment_id}', [DeleteCommentController::class, 'deleteComment'], ['authmiddleware', 'emailcheckmiddleware']),
    new Route('/user', [ShowUserController::class, 'showuser'], ['authmiddleware']),
    new Route('/user/showlots', [ShowUserController::class, 'showUsersLots'], ['authmiddleware']),
    new Route('/user/showcomments', [ShowUserController::class, 'showUsersComments'], ['authmiddleware']),
    new Route('/user/change', [ChangeUserController::class, 'changeInformation'], ['authmiddleware', 'emailcheckmiddleware']),
    new Route('/user/change_email/{link}', [ChangeEmailController::class, 'changeEmailController'], ['authmiddleware']),
    new Route('/user/change_password/{link}', [ChangePasswordController::class, 'changePasswordController'], ['authmiddleware']),
    new Route('/user/delete', [DeleteUserController::class, 'deleterequest'], ['authmiddleware', 'emailcheckmiddleware']),
    new Route('/user/delete/{token}', [DeleteUserController::class, 'deleteuser'], ['authmiddleware', 'emailcheckmiddleware']),
    new Route('/user/resetpassword', [ResetPasswordController::class, 'resetRequest'], ['noauthmiddleware']),
    new Route('/user/resetpassword/{token}', [ResetPasswordController::class, 'passwordResetForm'], ['noauthmiddleware']),
    new Route('/users/{user_id}', [ShowUserController::class, 'showotheruser']),
    new Route('/admin/login', [AdminLoginController::class, 'adminLogin'], ['adminmiddleware']),
    new Route('/admin', [AdminPanelController::class, 'showAdminPanel'], ['adminmiddleware', 'adminauthmiddleware']),
    new Route('/admin/users', [AdminChangeUserController::class, 'adminShowUsersTable'], ['adminmiddleware', 'adminauthmiddleware']),
    new Route('/admin/lots', [AdminChangeLotController::class, 'adminShowLotsTable'], ['adminmiddleware', 'adminauthmiddleware']),
    new Route('/admin/comments', [AdminChangeCommentController::class, 'adminShowCommentsTable'], ['adminmiddleware', 'adminauthmiddleware']),
    new Route('/admin/change/user/{user_id}', [AdminChangeUserController::class, 'adminChangeUser'], ['adminmiddleware', 'adminauthmiddleware']),
    new Route('/admin/change/lot/{lot_id}', [AdminChangeLotController::class, 'adminChangeLot'], ['adminmiddleware', 'adminauthmiddleware']),
    new Route('/admin/change/comment/{comment_id}', [AdminChangeCommentController::class, 'adminChangeComment'], ['adminmiddleware', 'adminauthmiddleware']),
    new Route('/admin/delete/user/{user_id}', [AdminDeleteUserController::class, 'adminDeleteUser'], ['adminmiddleware', 'adminauthmiddleware']),
    new Route('/admin/delete/lot/{lot_id}', [AdminDeleteLotController::class, 'adminDeleteLot'], ['adminmiddleware', 'adminauthmiddleware']),
    new Route('/admin/delete/comment/{comment_id}', [AdminDeleteCommentController::class, 'adminDeleteComment'], ['adminmiddleware', 'adminauthmiddleware']),
];