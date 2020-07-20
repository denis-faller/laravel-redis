<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;

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

Route::get('/', function () {
    return view('welcome');
});

// Перед выполнением, стоит запустить Redis - sudo service redis-server start
Route::get('/test', 'UserController@test');

Route::get('/test2', 'UserController@test2');

Route::get('/test3', 'UserController@test3');

Route::get('/test4', 'UserController@test4');

Route::get('/test5', 'UserController@test5');

Route::get('/test6', 'UserController@test6');

Route::get('/test7', 'UserController@test7');

Route::get('publish', function () {
    Redis::publish('test-channel', json_encode(['foo' => 'bar']));
});