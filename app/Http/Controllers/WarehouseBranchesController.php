<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWarehouseModuleRequest;
use App\Http\Requests\UpdateWarehouseModuleRequest;
use App\Models\WarehouseBranches;
use App\Models\WarehouseModule;
use App\Models\WarehouseLogs;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;


class WarehouseBranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("module.warehouse_branches");
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
        ]);
        return $x;
    }

    /**
     * Display the specified resource.
     */
    public function show(WarehouseModule $warehouseModule)
    {
        $y = WarehouseBranches::get();
        return DataTables::of($y)->addColumn("action", function ($c) {
            return "<button class='btn btn-danger btn-sm'><i class='bi bi-trash' onclick='deleteItem(" . $c->id . ")'></i></button>&nbsp;&nbsp;<button class='btn btn-success btn-sm' onclick='showDialogEdit(this)'><i class='bi bi-pencil-square'></i></button>";
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
    /**
     * for fetching api
     */
    public function fetch(Request $request)
    {
        $search = $request->input('search');
        $branches = WarehouseBranches::where('name', 'like', "%{$search}%")
            ->orderBy('name')
            ->paginate(10);

        return response()->json([
            'results' => $branches->items(),
            'pagination' => [
                'more' => $branches->hasMorePages(),
                'current_page' => $branches->currentPage(),
                'last_page' => $branches->lastPage(),
            ]
        ]);
    }
}
