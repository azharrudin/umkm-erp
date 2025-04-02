<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWarehouseModuleRequest;
use App\Http\Requests\UpdateWarehouseModuleRequest;
use App\Models\WarehouseSupplier;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;


class WarehouseSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("module.warehouse_suppliers");
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
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'sector' => 'required|string|max:255',
            'address' => 'required|string',
            'notes' => 'nullable|string',
            'active' => 'required|boolean',
        ]);
    
        // Create a new supplier record in the database
        $supplier = WarehouseSupplier::create($validated);
    
        // Return a response (you can return success message or data)
        return response()->json(['success' => true, 'message' => 'Supplier added successfully!']);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(WarehouseSupplier $warehouseModule)
    {
        $y = WarehouseSupplier::get();
        return DataTables::of($y)->addColumn("action", function ($c) {
            return "<button class='btn btn-danger btn-sm m-1'><i class='bi bi-trash' data-id='".$c->id."'></i></button>&nbsp;&nbsp;<button class='btn btn-success m-1 btn-sm editSupplierBtn' data-id='".$c->id."'><i class='bi bi-pencil-square'></i></button>";
        })->make(true);
    }
    public function getByID($id)
    {
        $y = WarehouseSupplier::find($id);
        return $y; 
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'sector' => 'required|string|max:255',
            'address' => 'required|string',
            'notes' => 'nullable|string',
            'active' => 'required|boolean',
        ]);
        $y = WarehouseSupplier::find($request->id);
        $y->update($validated);
        return $y;

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
        $x = WarehouseSupplier::where("id", $request->id)->delete();
    }
    public function show_history(Request $request)
    {
        $x = WarehouseSupplier::select("*")->get();
        return DataTables::of($x)->addColumn("action", function ($c) {
            return "<button class='btn btn-danger my-2 mx-2 btn-sm'><i class='bi bi-trash'></i></button>&nbsp;&nbsp;<button class='btn btn-success my-2 mx-2 btn-sm' onclick='showDialogEdit(this)'><i class='bi bi-pencil-square'></i></button>";
        })->make(true);
    }
}
