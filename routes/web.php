<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;

use App\Http\Controllers\ExplorerController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\TweetLikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserFollowController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () { return view('welcome'); });
Route::get('/', [TweetController::class, 'dashboard'])->name('tweet.dashboard');

Route::get('/profile/{user:username}', [UserController::class, 'userProfileView'])->name('user.profile');

Route::get('/profile/{user:username}/followers', [UserController::class, 'userFollowersView'])->name('user.profile.followers');
Route::get('/profile/{user:username}/followed', [UserController::class, 'userFollowedView'])->name('user.profile.followed');

Route::get('/tweet/{uuid}/comments', [TweetController::class, 'tweetCommentsView'])->name('tweet.comments');

Route::get('/explorer/{string}', [ExplorerController::class, 'explorerView'])->name('tweet.explorer');

// Route::get('/dashboard', function () { return view('dashboard'); })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('register', [UserController::class, 'registerView'])->name('user.register');
    Route::post('register', [UserController::class, 'registerStore'])->name('user.register');

    Route::get('login', [UserController::class, 'loginView'])->name('user.login');
    Route::post('login', [UserController::class, 'login'])->name('user.login');
});

Route::middleware(["auth:user", 'verified'])->group(function(){
    // Route::get("/Auth/redirectAuthenticatedUsers", [RedirectAuthenticatedUsersController::class, "home"]);

    /*
    |------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    | User Routes
    |------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    */
    // Route::group(['middleware' => 'checkRole:user', 'middleware' => 'checkRole:modo', 'middleware' => 'checkRole:admin'], function() {
    Route::group(['middleware' => 'checkRole:user,modo,admin'], function() {

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password/update', [PasswordController::class, 'update'])->name('profile.password.update');
        Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::post('/profile/updateProfilePicture', [ProfileController::class, 'updateProfilePicture'])->name('profile.update.picture');
        Route::post('/profile/updateProfileBanner', [ProfileController::class, 'updateProfileBanner'])->name('profile.update.banner');

        Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        Route::post('/tweet/addTweet', [TweetController::class, 'addTweet'])->name('tweet.add');

        Route::post('/tweet/{tweet}/addComment', [TweetController::class, 'addTweetComment'])->name('tweet.addComment');

        Route::get('/tweet/{uuid}/retweet', [TweetController::class, 'tweetRetweetView'])->name('tweet.retweet');
        Route::post('/tweet/{tweet}/retweet', [TweetController::class, 'addTweetRetweet'])->name('tweet.retweet');

        Route::post('/tweet/{tweet}/likes', [TweetLikeController::class, 'addTweetLikes'])-> name('tweet.likes');
        Route::delete('/tweet/{tweet}/likes', [TweetLikeController::class, 'destroyTweetLikes'])-> name('tweet.likes');

        Route::delete('/tweet/{uuid}/delete', [TweetController::class, 'tweetDestroy'])->name('tweet.delete');

        Route::get('/follow', [UserFollowController::class, 'dashboardFollowed'])->name('tweet.followed');
        Route::post('/follow/{user}', [UserFollowController::class, 'store'])->name('user.follow');
        Route::delete('/follow/{user}', [UserFollowController::class, 'destroy'])->name('user.follow');
    
        Route::post('/tweet/{tweet}/report', [TweetController::class, 'addTweetReport'])->name('tweet.report');

        Route::post('/uploads/process', [FileUploadController::class, 'process'])->name('uploads.process');

        Route::get('/notify', [UserController::class, 'testNoti']);

        Route::get('/profile/password/reset', [UserController::class, 'resetPasswordView'])->name('password.reset');
    });

    /*
    |------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    | Modo Routes
    |------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'modo', 'middleware' => 'checkRole:modo,admin'], function() {

        Route::delete('/tweet/{uuid}/delete', [TweetController::class, 'tweetDestroyModo'])->name('modo.tweet.delete');

    });

    /*
    |------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    | Admin Routes
    |------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'admin', 'middleware' => 'checkRole:admin'], function() {
        Route::get('/laravel-websockets');

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('/list/users', [AdminController::class, 'listUsers'])->name('admin.list.users');
        Route::get('/list/reports', [AdminController::class, 'listReports'])->name('admin.list.reports');
        Route::get('/list/words', [AdminController::class, 'blackListWords'])->name('admin.list.words');

        Route::post('/list/reports/{report}/check', [AdminController::class, 'reportCheck'])->name('admin.report.check');
        Route::delete('/list/reports/{report}/delete', [AdminController::class, 'reportDelete'])->name('admin.report.delete');

        Route::get('/list/users/{user}/edit', [AdminUserController::class, 'userEdit'])->name('admin.user.edit');
        Route::patch('/user/{user}/update', [AdminUserController::class, 'update'])->name('admin.user.update');

        Route::post('/user/{user}/updateProfilePicture', [AdminUserController::class, 'updateProfilePicture'])->name('admin.update.picture');
        Route::post('/user/{user}/updateProfileBanner', [AdminUserController::class, 'updateProfileBanner'])->name('admin.update.banner');

        Route::post('/user/{user}/link/password', [AdminUserController::class, 'resetPassword'])->name('admin.user.link.password');
        Route::post('/user/{user}/role/update', [AdminUserController::class, 'updateRole'])->name('admin.user.role');

        Route::get('/list/users/{user}/ban', [AdminUserController::class, 'userBan'])->name('admin.user.ban');
    });
});



// require __DIR__.'/auth.php';
