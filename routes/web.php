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

    Route::get("/warehouse/logs", [\App\Http\Controllers\WarehouseModuleController::class, "show_logs"])->name("warehouse.products.logs.get");
    Route::get("/warehouse/logs/{od}", [\App\Http\Controllers\WarehouseModuleController::class, "getlogByID"])->name("warehouse.products.logs.get_id");


    Route::get("/warehouse/supplier", [\App\Http\Controllers\WarehouseSupplierController::class, "show"])->name("warehouse.supplier.get");
    Route::get("/warehouse/supplier/{id}", [\App\Http\Controllers\WarehouseSupplierController::class, "getByID"])->name("warehouse.supplier.get_id");
    Route::post("/warehouse/supplier/edit", [\App\Http\Controllers\WarehouseSupplierController::class, "edit"])->name("warehouse.supplier.edit");
    Route::post("/warehouse/supplier", [\App\Http\Controllers\WarehouseSupplierController::class, "store"])->name("warehouse.supplier.add");

    
    Route::get("/warehouse/branches", [\App\Http\Controllers\WarehouseBranchesController::class, "show"])->name("warehouse.branches.get");
    Route::get("/warehouse/branches/{id}", [\App\Http\Controllers\WarehouseBranchesController::class, "getByID"])->name("warehouse.branches.get_id");
    Route::post("/warehouse/branches/edit", [\App\Http\Controllers\WarehouseBranchesController::class, "edit"])->name("warehouse.branches.edit");
    Route::post("/warehouse/branches", [\App\Http\Controllers\WarehouseBranchesController::class, "store"])->name("warehouse.branches.add");


});


Route::get('/api/fetch/warehouse/items', [\App\Http\Controllers\WarehouseModuleController::class, "fetch"] )->name("fetch.warehouse.items");
Route::get('/api/fetch/warehouse/branches', [\App\Http\Controllers\WarehouseBranchesController::class, "fetch"])->name("fetch.warehouse.branches");


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
Route::middleware("auth")->get('/warehouse/supplier', [App\Http\Controllers\WarehouseSupplierController::class, 'index']);
Route::middleware("auth")->get('/warehouse/branches', [App\Http\Controllers\WarehouseBranchesController::class, 'index']);

Route::middleware("auth")->get('/sales', [App\Http\Controllers\SalesModuleController::class, 'index']);
Route::middleware("auth")->get('/employee', [App\Http\Controllers\EmployeeModuleController::class, 'index']);