<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['guest'])->group(function () {

    Route::get('register', [UserController::class, 'registerForm'])->name('register');
    Route::post('register', [UserController::class, 'register'])->name('registration');

    Route::get('', [UserController::class, 'loginForm'])->name('login');
    Route::post('', [UserController::class, 'login'])->name('loginProcess');

    Route::get('restPassword', [UserController::class, 'restForm'])->name('rest');
    Route::post('restPassword', [UserController::class, 'rest'])->name('restProcess');

    Route::fallback(function () {
        return view('Auth.login');
    });
});

Route::middleware(['auth'])->group(function () {

    // User Logout
    Route::post('logout', [UserController::class, 'logout'])->name('logoutProcess');

    // Posts
    Route::get('posts', [PostController::class, 'all'])->name('all');

    //Create Post
    Route::get('posts/store', [PostController::class, 'storeForm'])->name('storeForm');
    Route::post('posts/store', [PostController::class, 'store'])->name('store');

    //Comment
    Route::post('posts/store/{id}', [CommentController::class, 'commentStore'])->name('commentStore');
    Route::Delete('posts/delete/{id}', [CommentController::class, 'commentDelete'])->name('commentDelete');

    //Like
    Route::post('like/store/{id}', [LikeController::class, 'likeIncrease'])->name('likeIncrease');
    Route::Delete('like/delete/{id}', [LikeController::class, 'likeDecrease'])->name('likeDecrease');

    Route::fallback(function () {
        return redirect(url('posts'));
    });
});





Route::get('send-mail', [MailController::class, 'index']);
