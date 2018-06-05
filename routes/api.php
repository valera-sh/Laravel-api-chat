<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Запрос на получение всех сообщений
Route::get('/chat/', 'ChatController@index');

// Запрос на добавление комментария
Route::put('/chat/add', 'ChatController@store');

// Запрос на удаление всех сообщений по id пользователя.
Route::delete('/chat/del/{user_id}', 'ChatController@destroy');