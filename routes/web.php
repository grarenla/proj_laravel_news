<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/login', 'UserController@loginAdminView');
Route::post('/admin/login', 'UserController@loginAdmin');
Route::get('/admin/logout', 'UserController@logout');


Route::group(['prefix' => '/admin', 'middleware' => 'adminLogin'], function () {
    Route::group(['prefix' => '/theloai'], function () {
        Route::get('/list', 'TheLoaiController@list');

        Route::get('/add', 'TheLoaiController@addView');
        Route::post('/add', 'TheLoaiController@add');

        Route::get('/edit/{id}', 'TheLoaiController@editView');
        Route::post('/edit/{id}', 'TheLoaiController@edit');

        Route::get('/delete/{id}', 'TheLoaiController@delete');
    });

    Route::group(['prefix' => '/loaitin'], function () {
        Route::get('/list', 'LoaiTinController@list');

        Route::get('/add', 'LoaiTinController@addView');
        Route::post('/add', 'LoaiTinController@add');

        Route::get('/edit/{id}', 'LoaiTinController@editView');
        Route::post('/edit/{id}', 'LoaiTinController@edit');

        Route::get('/delete/{id}', 'LoaiTinController@delete');
    });

    Route::group(['prefix' => '/tintuc'], function () {
        Route::get('/list', 'TinTucController@list');

        Route::get('/add', 'TinTucController@addView');
        Route::post('/add', 'TinTucController@add');

        Route::get('/edit/{id}', 'TinTucController@editView');
        Route::post('/edit/{id}', 'TinTucController@edit');

        Route::get('/delete/{id}', 'TinTucController@delete');
    });

    Route::group(['prefix' => '/slide'], function () {
        Route::get('/list', 'SlideController@list');

        Route::get('/add', 'SlideController@addView');
        Route::post('/add', 'SlideController@add');

        Route::get('/edit/{id}', 'SlideController@editView');
        Route::post('/edit/{id}', 'SlideController@edit');

        Route::get('/delete/{id}', 'SlideController@delete');
    });

    Route::group(['prefix' => '/user'], function () {
        Route::get('/list', 'UserController@list');

        Route::get('/add', 'UserController@addView');
        Route::post('/add', 'UserController@add');

        Route::get('/edit/{id}', 'UserController@editView');
        Route::post('/edit/{id}', 'UserController@edit');

        Route::get('/delete/{id}', 'UserController@delete');
    });

    Route::group(['prefix' => '/ajax'], function () {
        Route::get('/loaitin/{idTheLoai}', 'AjaxController@getLoaiTin');
    });

    Route::group(['prefix' => '/comment'], function () {
        Route::get('/delete/{id}', 'CommentController@delete');
    });
});

Route::get('/home', 'PagesController@home');

Route::get('/contact', 'PagesController@contact');

Route::get('/category/{id}', 'PagesController@category');

Route::get('news/{id}', 'PagesController@news');

Route::get('/login', 'PagesController@loginView');
Route::post('/login', 'PagesController@login');
Route::get('/logout', 'PagesController@logout');

Route::post('/comment/{id}', 'CommentController@post');

Route::get('/account', 'PagesController@accountView');
Route::post('/account', 'PagesController@account');

Route::get('/register', 'PagesController@registerView');
Route::post('/register', 'PagesController@register');

Route::get('/search', 'PagesController@search');