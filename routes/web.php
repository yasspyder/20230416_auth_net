<?php

use App\Http\Controllers\Admin\IndexAdminController;
use App\Http\Controllers\Admin\ParserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\IndexHomeController;
use App\Http\Controllers\News\IndexNewsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\LoginController;

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


Route::view('/about', 'about')->name('about');
Route::view('/registration', 'registration')->name('registration');
Route::match(['get', 'post'], '/profile', [ProfileController::class, 'update'])->name('profile');
Route::match(['get', 'post'], '/users/export', [ExportController::class, 'exportNews'])->name('users.export');

Route::controller(LoginController::class)
    ->prefix('auth')
    ->group(function () {
        Route::get('/vk', 'loginVK')->name('vklogin');
        Route::get('/yandex', 'loginYandex')->name('yandexlogin');
        Route::get('/vk/response', 'responseVK')->name('vkresponse');
        Route::get('/yandex/response', 'responseYandex')->name('yandexresponse');
    });

Route::controller(IndexHomeController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/account', 'account')->name('account');
        Route::match(['get', 'post'], '/add/user', 'addUser')->name('add.user');
    });

Route::controller(IndexAdminController::class)
    ->name('admin.')
    ->prefix('admin')
    ->middleware(['auth', 'role'])
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/edit/{categoryId}', 'editNews')->name('edit');
        Route::match(['get', 'post'], '/create', 'create')->name('create');
        Route::match(['get', 'post'], '/create/news', 'createNews')->name('create.news');
        Route::match(['get', 'post'], '/save', 'saveNews')->name('save');
        Route::match(['get', 'post'], '/category/{category}', 'editCategory')->name('category');
        Route::match(['get', 'post'], '/message/{news}', 'editMessage')->name('message');
        Route::controller(ParserController::class)
            ->prefix('parse')
            ->group(function () {
                Route::match(['get', 'post'], '/', 'index')->name('parse');
                Route::match(['get', 'post'], '/add', 'addSource')->name('parse.add');
                Route::match(['get', 'post'], '/load', 'loadParseNews')->name('parse.load');
            });
        Route::name('delete.')
            ->prefix('delete')
            ->group(function () {
                Route::delete('/message/{id}', 'deleteMessage')->name('message');
                Route::delete('/category/{id}', 'deleteCategory')->name('category');
                Route::delete('/parse{id}', [ParserController::class, 'deleteParseSource'])->name('parse');
            });
    });

Route::controller(IndexNewsController::class)
    ->name('news.')
    ->prefix('news')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/category/{categoryId}', 'newsCategory')->name('category');
        Route::get('/category/message/{news}', 'newsItem')->name('category.message');
    });

//Auth::routes();
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
