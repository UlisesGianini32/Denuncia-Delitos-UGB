<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PeopleController;
use App\Http\Controllers\Api\CrimeController;
use App\Http\Controllers\Api\ComplaintController;
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
Route::get('/people',[PeopleController::class, 'list']);
Route::get('/people/{id}', [PeopleController::class, 'item']);
Route::post('/people/create', [PeopleController::class, 'create']);
Route::post('/people/update', [PeopleController::class, 'update']);

Route::get('/crime',[CrimeController::class, 'list']);
Route::get('/crime/{id}', [CrimeController::class, 'item']);
Route::post('/crime/create', [CrimeController::class, 'create']);
Route::post('/crime/update', [CrimeController::class, 'update']);

Route::get('/complaints',[ComplaintController::class, 'list']);
Route::get('/complaints/{id}', [ComplaintController::class, 'item']);
Route::post('/complaints/create', [ComplaintController::class, 'create']);
Route::post('/complaints/update', [ComplaintController::class, 'update']);

Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('/Elements/{id}', [CategorieController::class, 'elements']);
Route::get('/ListComplaintComplaint/{id}', [ComplaintController::class, 'ListUser']);
Route::get('/SearchComplaints/{searchTerm}', [ComplaintController::class, 'SearchComplaints']);

Route::get('/users',[UserController::class, 'list']);
Route::get('/users/{id}', [UserController::class, 'item']);
Route::post('/users/create',[UserController::class, 'create']);
Route::post('/users/update',[UserController::class, 'update']);