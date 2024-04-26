<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProjectController;
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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout')->middleware('auth:api');
    Route::post('refresh', 'refresh')->middleware('auth:api');

});

////////////////Employees Routers/////////////

Route::middleware('auth:api')->controller(EmployeeController::class)->group(function () {
    Route::get('employees', 'index');
    Route::post('store_employees', 'store');
    Route::get('show_employees/{id}', 'show');
    Route::put('employees/{id}', 'update');
    Route::get('Trash_employees', 'Trash');
    Route::get('restore_employees', 'restore');
    Route::delete('delete_Permanently', 'deletePermanently');
    Route::delete('delete_employees/{id}', 'delete');
});


///////////////Departments Routers///////////////

Route::middleware('auth:api')->controller(DepartmentController::class)->group(function () {
    Route::get('departments', 'index');
    Route::post('store_departments', 'store');
    Route::get('show_departments/{id}', 'show');
    Route::put('update_departments/{id}', 'update');
    Route::get('Trash_Department', 'Trash');
    Route::get('restore_Department', 'restore');
    Route::delete('deletePermanently', 'deletePermanently');
    Route::delete('delete_Department/{id}', 'delete');

});

///////////////Project Routers///////////////

Route::controller(ProjectController::class)->group(function () {
    Route::post('store_Projects', 'store')->middleware('auth:api');
    Route::get('show_Projects/{id}', 'show');

});

/////////////////////Notes Routers//////////////////////
Route::controller(NoteController::class)->group(function () {
    Route::get('Notes', 'index');
    Route::post('Department_Note', 'DepartmentNote')->middleware('auth:api');
    Route::post('Employee_Note', 'EmployeeNote')->middleware('auth:api');


});
