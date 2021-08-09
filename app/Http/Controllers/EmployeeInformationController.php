<?php

namespace App\Http\Controllers;

use App\EmployeeInformation;
use App\Imports\EmployeeInformationImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeInformationController extends Controller
{
    
    public function index()
    {
        if (! Gate::allows('employee_manage')) {
            return abort(401);
        }
        $employees = EmployeeInformation::all();
        return view('admin.employee.index', compact('employees'));
    }
    
    public function create()
    {
        if (! Gate::allows('employee_manage')) {
            return abort(401);
        }
        return view('admin.employee.create');
    }
    
    public function store(Request $request)
    {
        if (! Gate::allows('employee_manage')) {
            return abort(401);
        }
        EmployeeInformation::create($request->all());
        return redirect()->route('employee.index');
    }
    
    public function show(Request $request, $id)
    {
        if (! Gate::allows('employee_manage')) {
            return abort(401);
        }
        $employee = EmployeeInformation::find($id);
        return view('admin.employee.show', compact('employee'));
    }
    
    public function edit(Request $request, $id)
    {
        if (! Gate::allows('employee_manage')) {
            return abort(401);
        }
        $employee = EmployeeInformation::find($id);
        return view('admin.employee.edit', compact('employee'));
    }
    
    public function update(Request $request)
    {
        if (! Gate::allows('employee_manage')) {
            return abort(401);
        }
        $emp = EmployeeInformation::find($request->id);
        $emp->update($request->all());
        return redirect()->route('employee.index');
    }
    
    public function destroy(Request $request)
    {
        if (! Gate::allows('employee_manage')) {
            return abort(401);
        }
        $emp = EmployeeInformation::find($request->id);
        $emp->delete();
        return redirect()->route('employee.index');
    }
    
    public function massDestroy(Request $request)
    {
        EmployeeInformation::whereIn('id', request('ids'))->delete();
        return response()->noContent();
    }
    
    public function importView()
    {
        return view('admin.employee.import');
    }
    
    public function importAction(Request $request)
    {
        $file = $request->file('employeeImport');
        Excel::import(new EmployeeInformationImport, $file);
        return redirect()->route('employee.index')->withStatus('Employee Import Successfull.');
    }
}
