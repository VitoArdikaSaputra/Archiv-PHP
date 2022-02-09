<?php

use App\Http\Controllers\SuratContoller;
use App\Http\Controllers\UserController;
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

//MIDDLEWARE
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//AUTH
Route::group(['middleware'] => 'auth:sanctum', function(){
  
});
// Route::post('/login', [UserController::class, 'index']);
Route::post('/create-user', [UserController::class, 'createUser']);
//CRUD DOCUMENT
Route::get('/surats', [SuratContoller::class, 'index']);
Route::get('/surats/{id}', [SuratContoller::class, 'show']);
Route::post('/surats', [SuratContoller::class, 'store']);
Route::patch('/surats/{id}', [SuratContoller::class, 'update']);
Route::delete('/surats/{id}', [SuratContoller::class, 'delete']);
// Route::apiResource('/surats', [SuratContoller::class]);
// Route::get('dependent-dropdown', [DependentDropdownController::class, 'index']);