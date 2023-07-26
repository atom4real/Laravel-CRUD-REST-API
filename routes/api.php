<?php

use App\Http\Controllers\Api\EmployeesCRUDController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('get', [EmployeesCRUDController::class, 'index']);
Route::post('post', [EmployeesCRUDController::class, 'store']);
Route::get('get/{id}', [EmployeesCRUDController::class, 'getByID']);
Route::get('get/{id}/edit', [EmployeesCRUDController::class, 'edit']);
Route::put('get/{id}/edit', [EmployeesCRUDController::class, 'update']);
Route::delete('employees/{id}/delete', [EmployeesCRUDController::class, 'delete']);