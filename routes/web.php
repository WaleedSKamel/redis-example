<?php

use Illuminate\Support\Facades\Route;

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
use \Illuminate\Support\Facades\Redis;
use \App\Http\Controllers\EInvoice;


Route::get('/', function () {
    /*for ($i=1; $i < 10; $i++) {
        Redis::set('m_'.$i,$i);
    }*/
    return Redis::get('m_5');
    Redis::set('w_4','4'); // how to set key and value in redis

    return Redis::get('w_4'); // get value from redis
   return Redis::keys('w_4');  // get all key this matching
});

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('e-invoice/{str}', [EInvoice::class,'invoice']);
