<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
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
});

Auth::routes();


/* Provide user profile page
 * Only current
 * */
Route::get('/profile/edit/{id}', [UserController::class, 'edit'])
    ->middleware(['auth', 'user'])
    ->where('id' ,'\d+')
    ->name('showProfile');

Route::put('/profile/update/{user}', [UserController::class, 'update'])
    ->middleware('user')
    ->name('updateProfile');
