<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSalesModuleRequest;
use App\Http\Requests\UpdateSalesModuleRequest;
use App\Models\SalesModule;
use App\Models\WarehouseModule;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SalesModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("module.sales");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $r)
    {
     
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        if(intval($r->confirmed) == 1){
            $x = SalesModule::create([
                'item_code' => $r->item_code,
                'totalcount' => $r->totalcount,
                'totalprice' =>  $r->totalprice,
                'discount' =>  $r->discount,
                'tax' =>  $r->tax,
                'selldate' => $r->selldate,
                'invoice' => $r->invoice
            ]);
             DB::table("warehouse_modules")->select("*", DB::raw("SUM(quantity) AS quantity"))->where('item_code', "=", $r->item_code)->groupBy("item_code")->decrement("quantity", intval($r->totalcount));
            return $r->item_code;
        }
        $n = WarehouseModule::select("*")
            ->where('item_code', "=", $r->item_code)
            ->first();
        $n = DB::table("warehouse_modules")->select("*", DB::raw("SUM(quantity) AS quantity")) ->where('item_code', "=", $r->item_code)->groupBy("item_code")->first();

        return $n;
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesModule $salesModule)
    {

        $x = SalesModule::select("*",  \DB::raw("sales_modules.id as id"))->join('warehouse_modules', 'sales_modules.item_code', '=', 'warehouse_modules.item_code')
            ->get();
        return DataTables::of($x)->addColumn("action", function ($c) {
            return "<button class='btn btn-danger btn-sm'><i class='bi bi-trash'></i></button>&nbsp;&nbsp;<button class='btn btn-success btn-sm' onclick='showDialogEdit(this)'><i class='bi bi-pencil-square'></i></button>";
        })->addColumn("total_price", function($q){
            $angka = intval($q["totalprice"]);
            return  "Rp. ".number_format($angka,2,',','.');
        })->addColumn("item_price", function($q){
            $angka = intval($q["item_price"]);
            return  "Rp. ".number_format($angka,2,',','.');
        })->addColumn("discount", function($q){
            return  strval($q->discount)."%";
        })->addColumn("totalprice_before", function($q){
            $angka = intval($q["totalcount"]) * intval($q["item_price"]);
            return  "Rp. ".number_format($angka,2,',','.');
        })->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $r)
    {
       
        SalesModule::where("id","=",$r->id)->update(array(
            'item_code' => $r->item_code,
            'totalcount' => $r->totalcount,
            'totalprice' =>  $r->totalprice,
            'discount' =>  $r->discount,
            'tax' =>  $r->tax,
            'selldate' => $r->selldate,
            'invoice' => $r->invoice
        ));
        return "ok"; 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalesModuleRequest $request, SalesModule $salesModule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesModule $salesModule)
    {
        //
    }
}
