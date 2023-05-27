<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/kelurahan', 'App\Http\Controllers\KelurahanController@index');
Route::get('/kelurahan/{id}', 'App\Http\Controllers\KelurahanController@show');
Route::post('/kelurahan', 'App\Http\Controllers\KelurahanController@store');
Route::put('/kelurahan/{id}', 'App\Http\Controllers\KelurahanController@update');
Route::delete('/kelurahan/{id}', 'App\Http\Controllers\KelurahanController@destroy');

Route::get('/pasien', 'App\Http\Controllers\PasienController@index');
Route::get('/pasien/{id}', 'App\Http\Controllers\PasienController@show');
Route::post('/pasien', 'App\Http\Controllers\PasienController@store');
Route::put('/pasien/{id}', 'App\Http\Controllers\PasienController@update');
Route::delete('/pasien/{id}', 'App\Http\Controllers\PasienController@destroy');
