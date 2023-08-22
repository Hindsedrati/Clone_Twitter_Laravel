<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ExplorerController;
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
Route::get('/', [TweetController::class, 'dashboard'])->name('tweets.dashboard');

Route::get('/profile/{name}', [UserController::class, 'userProfileView'])->name('user.profile');
Route::get('/tweet/{uuid}/comments', [TweetController::class, 'tweetCommentsView'])->name('tweet.comments');

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
    Route::group(['middleware' => 'checkRole:user'], function() {
        // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        Route::post('/tweet/addTweet', [TweetController::class, 'addTweet'])->name('tweet.add');

        Route::post('/tweet/{tweet}/addComment', [TweetController::class, 'addTweetComment'])->name('tweet.addComment');

        Route::get('/tweet/{uuid}/retweet', [TweetController::class, 'tweetRetweetView'])->name('tweet.retweet');
        Route::post('/tweet/{tweet}/retweet', [TweetController::class, 'addTweetRetweet'])->name('tweet.retweet');

        Route::post('/tweet/{tweet}/likes', [TweetLikeController::class, 'addTweetLikes'])-> name('tweet.likes');
        Route::delete('/tweet/{tweet}/likes', [TweetLikeController::class, 'destroyTweetLikes'])-> name('tweet.likes');

        Route::get('/follow', [TweetController::class, 'dashboardFollowed'])->name('tweets.followed');
        Route::post('/follow/{user}', [UserFollowController::class, 'store'])->name('user.follow');
        Route::delete('/follow/{user}', [UserFollowController::class, 'destroy'])->name('user.follow');

        Route::get('/explorer/{string}', [ExplorerController::class, 'explorerView'])->name('tweet.explorer');
    });

    /*
    |------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    | Modo Routes
    |------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    */
    // Route::group(['middleware' => 'checkRole:modo'], function() {
        
    // });

    /*
    |------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    | Admin Routes
    |------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    */
    // Route::group(['prefix' => 'admin', 'middleware' => ['checkRole:admin']], function() {

    // });
});



// require __DIR__.'/auth.php';
