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

use Illuminate\Support\Facades\Redis;

Route::get('/', function () {


    Redis::lpush('fri', 'value1');
    Redis::lpush('fri', 'value2');
    Redis::lpush('fri', 'value3');
    $cuantos = Redis::llen('fri');
    dump($cuantos);

//    $redis = Redis::connection();
//
//    $redis->flushall();
//
//    $redis->lpush('fri', 'value1');
//    $redis->lpush('fri', 'value2');
//    $redis->lpush('fri', 'value3');
//    $redis->lpush('fri', 'value4');
//    $redis->lpush('fri', 'value5');
//
//    $todos = $redis->lrange('fri', 0,-1);
//    dump($todos);
//
//    $dosprimeros = $redis->lrange('fri', 0,1);
//    dump($dosprimeros);
//
//    $cuantos = $redis->llen('fri');
//    dump($cuantos);


    return view('welcome');
});
