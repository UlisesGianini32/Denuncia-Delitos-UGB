<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\LotController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\EntryController;




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

//---------------------------------------------------------------------------------------------------------
Route::get('/lot', [LotController::class, 'list']);
Route::get('/lot/{id}', [LotController::class, 'item']);
Route::post('/lot/create', [LotController::class, 'create']);
Route::post('/lot/update{id}', [LotController::class, 'update']);
Route::post('/lot/delete/{id}', [LotController::class, 'delete']);

Route::get('/product', [ProductController::class, 'list']);
Route::get('/product/{id}', [ProductController::class, 'item']);
Route::post('/product/create', [ProductController::class, 'create']);
Route::post('/product/update{id}', [ProductController::class, 'update']);
Route::post('/product/delete/{id}', [ProductController::class, 'delete']);

Route::get('/employee', [EmployeeController::class, 'list']);
Route::get('/employee/{id}', [EmployeeController::class, 'item']);
Route::post('/employee/create', [EmployeeController::class, 'create']);
Route::post('/employee/update{id}', [EmployeeController::class, 'update']);
Route::post('/employee/delete/{id}', [EmployeeController::class, 'delete']);

Route::get('/entry', [EntryController::class, 'list']);
Route::get('/entry/{id}', [EntryController::class, 'item']);
Route::post('/entry/create', [EntryController::class, 'create']);
Route::post('/entry/update{id}', [EntryController::class, 'update']);
Route::post('/entry/delete/{id}', [EntryController::class, 'delete']);

Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/users', [UserController::class, 'list']);
Route::post('/users/create', [UserController::class, 'create']);
Route::get('/entry/search/{searchTerm}', [EntryController::class, 'SearchEntries']);
Route::get('/lot/search/{searchTerm}', [LotController::class, 'SearchLots']);
Route::get('/product/search/{searchTerm}', [ProductController::class, 'SearchProducts']);
Route::get('/employee/search/{searchTerm}', [EmployeeController::class, 'SearchEmployees']);
