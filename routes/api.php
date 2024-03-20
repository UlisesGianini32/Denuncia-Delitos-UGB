<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SuspectController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/suspects',[SuspectController::class, 'list']);
Route::get('/suspects/{id}', [SuspectController::class, 'item']);
Route::post('/suspects/create', [SuspectController::class, 'create']);
Route::post('/suspects/update', [SuspectController::class, 'update']);

Route::get('/categories',[CategorieController::class, 'list']);
Route::get('/categories/{id}', [CategorieController::class, 'item']);
Route::post('/categories/create', [CategorieController::class, 'create']);
Route::post('/categories/update', [SuspectController::class, 'update']);

Route::get('/places',[PlaceController::class, 'list']);
Route::get('/places/{id}', [PlaceController::class, 'item']);
Route::post('/places/create', [PlaceController::class, 'create']);
Route::post('/places/update', [SuspectController::class, 'update']);

Route::get('/complaints',[ComplaintController::class, 'list']);
Route::get('/complaints/{id}', [ComplaintController::class, 'item']);
Route::post('/complaints/create', [ComplaintController::class, 'create']);
Route::post('/complaints/update', [ComplaintController::class, 'update']);

Route::get('/alerts',[AlertsController::class, 'list']);
Route::get('/alerts/{id}', [AlertsController::class, 'item']);
Route::post('/alerts/create', [AlertsController::class, 'create']);
Route::post('/alerts/update', [AlertsController::class, 'update']);

Route::get('/info_com',[Info_ComController::class, 'list']);
Route::get('/info_com/{id}', [Info_ComController::class, 'item']);
Route::post('/info_com/create', [Info_ComController::class, 'create']);
Route::post('/info_com/update', [Info_ComController::class, 'update']);

Route::get('/info_sus',[Info_SusController::class, 'list']);
Route::get('/info_sus/{id}', [Info_SusController::class, 'item']);
Route::post('/info_sus/create', [Info_SusController::class, 'create']);
Route::post('/info_sus/update', [Info_SusController::class, 'update']);

Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('/Elements/{id}', [CategorieController::class, 'elements']);

Route::get('/users',[UserController::class, 'list']);
Route::get('/users/{id}', [UserController::class, 'item']);
Route::post('/users/create',[UserController::class, 'create']);
Route::post('/users/update',[UserController::class, 'update']);