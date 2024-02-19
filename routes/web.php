<?php

use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix("api")->middleware("auth")->group(function(){
    Route::post("/warehouse", [\App\Http\Controllers\WarehouseModuleController::class, "store"]);
    Route::post("/warehouse/edit", [\App\Http\Controllers\WarehouseModuleController::class, "edit"]);
    Route::get("/warehouse", [\App\Http\Controllers\WarehouseModuleController::class, "show"]);
    Route::get("/warehouse/history", [\App\Http\Controllers\WarehouseModuleController::class, "show_history"]);
    Route::post("/warehouse/delete", [\App\Http\Controllers\WarehouseModuleController::class, "destroy"]);

});

Route::prefix("api")->middleware("auth")->group(function(){
    Route::post("/sales", [\App\Http\Controllers\SalesModuleController::class, "store"]);
    Route::post("/sales/edit", [\App\Http\Controllers\SalesModuleController::class, "edit"]);
    Route::get("/sales", [\App\Http\Controllers\SalesModuleController::class, "show"]);
    Route::post("/sales/delete", [\App\Http\Controllers\SalesModuleController::class, "destroy"]);

});
Route::prefix("api")->middleware("auth")->group(function(){
    Route::post("/employee", [\App\Http\Controllers\EmployeeModuleController::class, "store"]);
    Route::post("/employee/edit", [\App\Http\Controllers\EmployeeModuleController::class, "edit"]);
    Route::get("/employee", [\App\Http\Controllers\EmployeeModuleController::class, "show"]);
    Route::post("/employee/delete", [\App\Http\Controllers\EmployeeModuleController::class, "destroy"]);

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware("auth")->get('/warehouse', [App\Http\Controllers\WarehouseModuleController::class, 'index']);
Route::middleware("auth")->get('/sales', [App\Http\Controllers\SalesModuleController::class, 'index']);
Route::middleware("auth")->get('/employee', [App\Http\Controllers\EmployeeModuleController::class, 'index']);