<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VictimController;
use App\Http\Controllers\Api\Complaint_statusController;
use App\Http\Controllers\Api\SuspectController;
use App\Http\Controllers\Api\WitneController;
use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\LotController;
use App\Http\Controllers\Api\ProductController;



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
Route::get('/victim',[VictimController::class, 'list']);
Route::get('/victim/{id}', [VictimController::class, 'item']);
Route::post('/victim/create', [VictimController::class, 'create']);
Route::post('/victim/update', [VictimController::class, 'update']);

Route::get('/suspect',[SuspectController::class, 'list']);
Route::get('/suspect/{id}', [SuspectController::class, 'item']);
Route::post('/suspect/create', [SuspectController::class, 'create']);
Route::post('/suspect/update', [SuspectController::class, 'update']);

Route::get('/complaints',[ComplaintController::class, 'list']);
Route::get('/complaints/{id}', [ComplaintController::class, 'item']);
Route::get('/complaints/user/{userId}', [ComplaintController::class, 'complaintsUser']);
Route::post('/complaints/create', [ComplaintController::class, 'create']);
Route::post('/complaints/update', [ComplaintController::class, 'update']);
route::post('/complaints/delete/{id}', [ComplaintController::class, 'delete']);
Route::get('/complaints/{id}/victim', [ComplaintController::class, 'item']);
Route::get('/complaints/{id}/witnes', [ComplaintController::class, 'item']);
Route::get('/complaints/{id}/suspect', [ComplaintController::class, 'item']);

Route::get('/witnes',[WitneController::class, 'list']);
Route::get('/witnes/{id}', [WitneController::class, 'item']);
Route::post('/witnes/create', [WitneController::class, 'create']);
Route::post('/witnes/update', [WitneController::class, 'update']);

Route::get('/complaint_status',[Complaint_statusController::class, 'list']);
Route::get('/complaint_status/{id}', [Complaint_statusController::class, 'item']);
Route::post('/complaint_status/create', [Complaint_statusController::class, 'create']);
Route::post('/complaint_status/update', [Complaint_statusController::class, 'update']);

Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('/Elements/{id}', [ComplaintController::class, 'elements']);
Route::get('/ListComplaintComplaint/{id}', [ComplaintController::class, 'ListUser']);
Route::get('/SearchComplaints/{searchTerm}', [ComplaintController::class, 'SearchComplaints']);

Route::get('/users',[UserController::class, 'list']);
Route::get('/users/{id}', [UserController::class, 'item']);
Route::post('/users/create',[UserController::class, 'create']);
Route::post('/users/update',[UserController::class, 'update']);

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

Route::get('/lot/search/{searchTerm}', [LotController::class, 'SearchLots']);
Route::get('/product/search/{searchTerm}', [ProductController::class, 'SearchProducts']);
Route::get('/employee/search/{searchTerm}', [EmployeeController::class, 'SearchEmployees']);
