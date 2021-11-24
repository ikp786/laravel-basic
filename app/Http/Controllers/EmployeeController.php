<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with('companies')->paginate(5);        
        return view('employees.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Company::pluck('name', 'id');
        return view('employees.create',compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {        
        $input = $request->validated(); 
        // dd($input);
            Employee::create($input);
        return redirect()->route('employees.index')->with('status-success','New Employee Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $employees = Employee::find($id);
        $companies = Company::all()->pluck('name', 'id');
        return view('employees.edit', compact('employees','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        $input = $request->all();        
        $employee = Employee::find($id);        
        $employee->update($input);
        return redirect()->route('employees.index')->with('status-success','Employee Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $employee = Employee::find($id);
        $employee->delete();
        return redirect()->back()->with(['status-success' => "Employee Deleted"]);
    }

    public function trash(){        

        $employees = Employee::onlyTrashed()->with('employees')->paginate(10);        
        return view('employees.trash',compact('employees'));
    }
}