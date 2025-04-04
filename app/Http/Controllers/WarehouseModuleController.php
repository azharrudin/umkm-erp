<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWarehouseModuleRequest;
use App\Http\Requests\UpdateWarehouseModuleRequest;
use App\Models\WarehouseModule;
use App\Models\WarehouseLogs;
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
        ]);
        return $x;
    }

    /**
     * Display the specified resource.
     */
    public function show(WarehouseModule $warehouseModule)
    {
        $y =WarehouseLogs::with(['item', 'branch'])
        ->select('branch_id', 'item_id', "quantity")
        ->selectRaw("
        GROUP_CONCAT(DISTINCT warehouse_branches.name ORDER BY warehouse_branches.name ASC SEPARATOR ', ') as branch_names,
        SUM(CASE WHEN actions = 'added' THEN quantity ELSE 0 END) as total_added,
        SUM(CASE WHEN actions = 'removed' THEN quantity ELSE 0 END) as total_removed,
        SUM(CASE WHEN actions = 'added' THEN quantity ELSE 0 END) - 
        SUM(CASE WHEN actions = 'removed' THEN quantity ELSE 0 END) as total_quantity
    ") ->join('warehouse_branches', 'warehouse_logs.branch_id', '=', 'warehouse_branches.id')
        ->groupBy('item_id')
        ->get();
        return DataTables::of($y)->addColumn("action", function ($c) {
            return "<button class='btn btn-danger btn-sm'><i class='bi bi-trash' onclick='deleteItem(".$c->id.")'></i></button>&nbsp;&nbsp;<button class='btn btn-success btn-sm' onclick='showDialogEdit(this)'><i class='bi bi-pencil-square'></i></button>";
        })->make(true);
    }
    
    public function show_logs(WarehouseModule $warehouseModule)
    {
        $y =WarehouseLogs::with(['item', 'branch'])->get();
        return DataTables::of($y)->addColumn("action", function ($c) {
            return "<button class='btn btn-danger btn-sm'><i class='bi bi-trash' onclick='deleteItemLogs(".$c->id.")'></i></button>&nbsp;&nbsp;<button class='btn btn-success btn-sm editProductLogBtn'  data-id=".$c->id."><i class='bi bi-pencil-square'></i></button>";
        })->make(true);
    }

    function getlogByID($id){
        $y = WarehouseLogs::with(['item', 'branch'])->find($id);
        return $y;
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
    public function fetch(Request $request)
    {
        $search = $request->input('search');
        $branches = WarehouseModule::where('item_name', 'like', "%{$search}%")
            ->orderBy('item_name')
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
