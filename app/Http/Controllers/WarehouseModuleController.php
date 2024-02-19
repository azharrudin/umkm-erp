<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWarehouseModuleRequest;
use App\Http\Requests\UpdateWarehouseModuleRequest;
use App\Models\WarehouseModule;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;


class WarehouseModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("module.warehouse");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $x = WarehouseModule::create([

            "item_code" => $request['item_code'],
            "item_stocking_unit" => $request->input('item_stocking_unit'),
            "item_price" => $request->input('item_price'),
            "item_since" => $request->input('item_since'),
            "item_name" => $request->input('item_name'),
            "quantity" => $request->input('quantity'),
            "is_rejected" => 0,
            "vendor_name" => $request->input('vendor_name')
        ]);
        return $x;
    }

    /**
     * Display the specified resource.
     */
    public function show(WarehouseModule $warehouseModule)
    {
        $y = \DB::table("warehouse_modules")->select("*", DB::raw("SUM(quantity) AS mqty"))->groupBy("item_code")->get();
        return DataTables::of($y)->addColumn("action", function ($c) {
            return "<button class='btn btn-danger btn-sm'><i class='bi bi-trash' onclick='deleteItem(".$c->id.")'></i></button>&nbsp;&nbsp;<button class='btn btn-success btn-sm' onclick='showDialogEdit(this)'><i class='bi bi-pencil-square'></i></button>";
        })->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $x = WarehouseModule::where("item_code", $request->input("item_code"))->update([
            "item_code" => $request['item_code'],
            "item_stocking_unit" => $request->input('item_stocking_unit'),
            "item_price" => $request->input('item_price'),
            "item_since" => $request->input('item_since'),
            "item_name" => $request->input('item_name'),
            "quantity" => $request->input('quantity'),
            "vendor_name" => $request->input('vendor_name')
        ]);
        return $x;

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWarehouseModuleRequest $request, WarehouseModule $warehouseModule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $x = WarehouseModule::where("id", $request->id)->delete();
    }
    public function show_history(Request $request)
    {
        $x = WarehouseModule::select("*")->get();
        return DataTables::of($x)->addColumn("action", function ($c) {
            return "<button class='btn btn-danger mt-2 btn-sm'><i class='bi bi-trash'></i></button>&nbsp;&nbsp;<button class='btn btn-success mt-2 btn-sm' onclick='showDialogEdit(this)'><i class='bi bi-pencil-square'></i></button>";
        })->make(true);
    }
}
