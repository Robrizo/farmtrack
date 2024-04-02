<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CropController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FarmInventoryController;

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

Route::get('/crops', [CropController::class, 'index']);
Route::get('/crops/{id}', [CropController::class, 'show']);
Route::post('/crops', [CropController::class, 'store']);
Route::delete('/crops/{id}', [CropController::class, 'destroy']);
Route::put('/crops/{id}', [CropController::class, 'update']);
Route::get('/crops/search/{keyword}', [CropController::class, 'search']);

Route::get('/farminventory', [FarmInventoryController::class, 'index']);
Route::get('/farminventory/{id}', [FarmInventoryController::class, 'show']);
Route::post('/farminventory', [FarmInventoryController::class, 'store']);
Route::delete('/farminventory/{id}', [FarmInventoryController::class, 'destroy']);
Route::put('/farminventory/{id}', [FarmInventoryController::class, 'update']);
Route::get('/farminventory/search/{keyword}', [FarmInventoryController::class, 'search']);
Route::get('/farm', [FarmInventoryController::class, 'totalInputCost']);
Route::get('/inputs', [FarmInventoryController::class, 'totalInputs']);


Route::get('/employees', [EmployeeController::class, 'index']);
Route::get('/employees/{id}', [EmployeeController::class, 'show']);
Route::post('/employees', [EmployeeController::class, 'store']);
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);
Route::put('/employees/{id}', [EmployeeController::class, 'update']);
Route::get('/employees/search/{keyword}', [EmployeeController::class, 'search']);
Route::get('/employee', [EmployeeController::class, 'totalEmployees']);

Route::get('/finances', [FinanceController::class, 'index']);
Route::post('/finances', [FinanceController::class, 'store']);
Route::delete('/finances/{id}', [FinanceController::class, 'destroy']);
Route::put('/finances/{id}', [FinanceController::class, 'update']);
Route::get('/finances/search/{keyword}', [FinanceController::class, 'search']);
Route::get('/payment', [FinanceController::class, 'totalPayments']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/search/{keyword}', [UserController::class, 'search']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/signout', [AuthController::class, 'logout']);
Route::get('/getuser', [AuthController::class, 'show']);
Route::put('/getusers/{id}', [AuthController::class, 'update']);

