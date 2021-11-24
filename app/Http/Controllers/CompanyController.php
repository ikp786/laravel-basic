<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Employee;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(5);
        return view('companies.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {        
        $input = $request->validated();
        if($request->logo) {
           $fileName = time().'_'.str_replace(" ","_",$request->logo->getClientOriginalName());
           $filePath = $request->file('logo')->storeAs('logo', $fileName, 'public');
           $input['logo'] = $fileName;
       }     

       $logo = Company::create($input);
       return redirect()->route('companies.index')->with('status-success','New Company Created');
   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Company::find($id);
        return view('companies.edit', compact('companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, $id)
    {
        $input = $request->all();        
        $company = Company::find($id);        
        if($request->logo) {
           $fileName = time().'_'.str_replace(" ","_",$request->logo->getClientOriginalName());
           $filePath = $request->file('logo')->storeAs('logo', $fileName, 'public');
           $input['logo'] = $fileName;           
       }else{
        unset($input['logo']);
    }        
    $company->update($input);
    return redirect()->route('companies.index')->with('status-success','Company Updated');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::withTrashed()->where('company_id',$id)->get();
        $employee_id = isset($employee[0]->id) ? 1 : 0;
        if ($employee_id == 1) {
            return redirect()->back()->with(['status-danger' => "this company cannot be deleted. Because this company foreign key save in Employee master"]);
        }
        $company = Company::find($id);
        $company->delete();
        return redirect()->back()->with(['status-success' => "Company Deleted"]);
    }
}
