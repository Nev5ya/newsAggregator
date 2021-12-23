<?php

use App\Http\Controllers\Admin\ParserController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DownloadController;

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

Route::get('/', [NewsController::class, 'index'])
    ->name('news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])
    ->where('id', '\d+')
    ->name('news.show');

Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
    Route::get('/', [CategoryController::class, 'index'])
        ->name('index');
    Route::get('{id}', [CategoryController::class, 'show'])
        ->name('show');
});

Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function() {

    Route::resource('news', AdminNewsController::class)->except('show');
    Route::resource('category', AdminCategoryController::class)->except('show');
    Route::resource('users', UserController::class)->except('create');

    Route::get('/download', [DownloadController::class, 'index'])
        ->name('download.index');
    Route::post('/download', [DownloadController::class, 'download'])
        ->name('download.load');

    Route::get('/parser', [ParserController::class, 'index'])
        ->name('parser');
});

Auth::routes();

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => 'auth'], function () {
    Route::get('/edit/{id}', [ProfileController::class, 'editProfile'])
        ->name('edit');

    Route::put('/update/{user}', [ProfileController::class, 'updateProfile'])
        ->name('update');

    Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
        Route::get('/edit/{id}', [ProfileController::class, 'editPassword'])
            ->name('edit');

        Route::put('/update/{user}', [ProfileController::class, 'updatePassword'])
            ->name('update');
    });
});



/* Provide auth for social networks */
Route::get('/auth/{social}', [LoginController::class, 'socialLogin'])
    ->name('socialLogin');
Route::get('/auth/{social}/response', [LoginController::class, 'socialResponse']);
