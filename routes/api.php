<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [Controller::class, 'login']);
Route::post('/register', [Controller::class, 'register']);

Route::get('/getUsers', [Controller::class, 'getUsers'])->name('getUsers');
Route::get('/login', [Controller::class, 'login'])->name('login');

Route::middleware('auth:api')->get('/getUsersWithAuth', [Controller::class, 'getUsersWithAuth']);
