<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\admin\DownloadController;

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

//news
Route::get('/', [NewsController::class, 'index'])
    ->name('news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])
    ->where('id', '\d+')
    ->name('news.show');

//category
Route::get('/category/{id}', [CategoryController::class, 'show'])
    ->name('category.show');

//contact
Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact');

// admin
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::resource('news', AdminNewsController::class)->except('show');
    Route::resource('category', AdminCategoryController::class)->except('show');
    Route::get('/download', [DownloadController::class, 'index'])
        ->name('download');
    Route::post('/download', [DownloadController::class, 'download']);
});

//auth
Route::view('/auth', 'auth.index')->name('auth');





