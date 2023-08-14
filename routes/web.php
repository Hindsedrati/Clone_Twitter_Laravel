<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;

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
    
        Route::post('/addTweet', [TweetController::class, 'addTweet'])->name('tweet.add');
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



require __DIR__.'/auth.php';
