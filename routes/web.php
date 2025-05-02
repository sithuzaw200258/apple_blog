<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[WelcomeController::class,'index'])->name('welcome');
Route::delete('/welcome/posts/delete/{id}',[WelcomeController::class,'deletePost'])->name('welcome.posts.delete');
Route::get('/detail/{slug}',[WelcomeController::class,'detail'])->name('welcome.detail');
Route::get('/categories/{slug}',[WelcomeController::class,'postByCategory'])->name('welcome.category');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::resources([
        'users' => UserController::class,
        'categories' => CategoryController::class,
        'posts' => PostController::class,
        'photos' => PhotoController::class,
    ]);
});

Route::get('/posts/trashed',[PostController::class,'deletedPosts'])->name('posts.trashed');
Route::delete('/posts/delete/{id}',[PostController::class,'forceDeletePost'])->name('posts.delete');
Route::delete('/posts/restore/{id}',[PostController::class,'restorePost'])->name('posts.restore');



Route::get('posts/export', [PostController::class, 'export'])->name('posts.export');
Route::post('posts/import', [PostController::class, 'import'])->name('posts.import');

// Route::resource('categories', CategoryController::class);

Route::get('users/view-pdf', [UserController::class, 'viewPDF'])->name('view-pdf');
Route::get('users/download-pdf', [UserController::class, 'downloadPDF'])->name('download-pdf');


