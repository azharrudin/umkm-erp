<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeModuleRequest;
use App\Http\Requests\UpdateEmployeeModuleRequest;
use App\Models\EmployeeModule;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EmployeeModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("module.employee");
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
    public function store(Request $r)
    {
        $x = EmployeeModule::create([
            'name' => $r->name,
            'email' => $r->email,
            'position' => $r->position,
            'address' => $r->address,
            'date_joined' => $r->date_joined,
            'active' => true,
            'date_exited' => $r->date_exited,
            'salary' => $r->salary,
            'salary_period' => $r->salary_period,
            'salary_method' => $r->salary_method,
        ]);
        return $x;
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeModule $employeeModule)
    {
        $x = EmployeeModule::select("*")->get();
        return DataTables::of($x)->addColumn("action", function ($c) {
            return "<button class='btn btn-danger btn-sm'><i class='bi bi-trash' onclick='deleteItem(".$c->id.")'></i></button>&nbsp;&nbsp;<button class='btn btn-secondary btn-sm' onclick='showDialogEdit(this)'><i class='bi bi-pencil-square'></i></button>";
        })->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $r)
    {
        $x = EmployeeModule::where("id", $r->input("id"))->update([
            'name' => $r->name,
            'email' => $r->email,
            'position' => $r->position,
            'address' => $r->address,
            'date_joined' => $r->date_joined,
            'active' => true,
            'date_exited' => $r->date_exited,
            'salary' => $r->salary,
            'salary_period' => $r->salary_period,
            'salary_method' => $r->salary_method,
        ]);
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeModuleRequest $request, EmployeeModule $employeeModule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeModule $employeeModule)
    {
        //
    }
}
