<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SuspectController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\AuthController;

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
Route::post('/suspects/Create', [SuspectController::class, 'create']);
Route::post('/suspects/Update', [SuspectController::class, 'update']);

Route::get('/categories',[CategorieController::class, 'list']);
Route::get('/categories/{id}', [CategorieController::class, 'item']);
Route::post('/categories/Create', [CategorieController::class, 'create']);
Route::post('/categories/Update', [SuspectController::class, 'update']);

Route::get('/places',[PlaceController::class, 'list']);
Route::get('/places/{id}', [PlaceController::class, 'item']);
Route::post('/places/Create', [PlaceController::class, 'create']);
Route::post('/places/Update', [SuspectController::class, 'update']);

Route::get('/complaints',[ComplaintController::class, 'list']);
Route::get('/complaints/{id}', [ComplaintController::class, 'item']);
Route::post('/complaints/Create', [ComplaintController::class, 'create']);
Route::post('/complaints/Update', [ComplaintController::class, 'update']);

Route::get('/alerts',[AlertsController::class, 'list']);
Route::get('/alerts/{id}', [AlertsController::class, 'item']);
Route::post('/alerts/Create', [AlertsController::class, 'create']);
Route::post('/alerts/Update', [AlertsController::class, 'update']);

Route::get('/info_com',[Info_ComController::class, 'list']);
Route::get('/info_com/{id}', [Info_ComController::class, 'item']);
Route::post('/info_com/Create', [Info_ComController::class, 'create']);
Route::post('/info_com/Update', [Info_ComController::class, 'update']);

Route::get('/info_sus',[Info_SusController::class, 'list']);
Route::get('/info_sus/{id}', [Info_SusController::class, 'item']);
Route::post('/info_sus/Create', [Info_SusController::class, 'create']);
Route::post('/info_sus/Update', [Info_SusController::class, 'update']);

Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('/Elements/{id}', [CategorieController::class, 'elements']);
