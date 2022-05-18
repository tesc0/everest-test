<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site;

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

Route::get('/', [Site::class, 'index']);
Route::get('/robots', [Site::class, 'listRobots']);
Route::get('/robot/{id}/delete', [Site::class, 'robotDelete']);
Route::get('/robot/{id?}', [Site::class, 'robot']);
Route::post('/robot', [Site::class, 'robotSave']);
Route::post('/fight', [Site::class, 'fight']);
