<?php

namespace App\Http\Controllers;

use App\VisitorInformation;
use App\EmployeeInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class VisitorInformationController extends Controller
{
    public function index()
    {
        if (! Gate::allows('visitor_manage')) {
            return abort(401);
        }

        $visitors = VisitorInformation::latest()->get();
        return view('admin.visitor.index', compact('visitors'));
    }
    
    public function create()
    {
        if (! Gate::allows('visitor_manage')) {
            return abort(401);
        }

        $employees = EmployeeInformation::where('status','Active')->get();
        return view('admin.visitor.create', compact('employees'));
    }
    
    public function store(Request $request)
    {
        if (! Gate::allows('visitor_manage')) {
            return abort(401);
        }

        $data = [
            'name'          => $request->name,
            'employee_id'   => $request->employee_id,
            'address'       => $request->address,
            'purpose'       => $request->purpose,
            'contact'       => $request->contact,
            'card_no'       => $request->card_no,
            'in_date'       => \Illuminate\Support\Carbon::now(),
            'in_time'       => \Illuminate\Support\Carbon::now(),
            'user_id'       => Auth::user()->id,
        ];
        
        if(VisitorInformation::create($data)){
            return redirect()->back();
        }
    }

    
    public function show(VisitorInformation $visitorInformation)
    {
        //
    }

    public function edit(Request $request, $id)
    {
        if (! Gate::allows('visitor_manage')) {
            return abort(401);
        }

        $employees = EmployeeInformation::where('status','Active')->get();
        $visit = VisitorInformation::find($id);
        return view('admin.visitor.edit', compact('visit', 'employees'));
    }

    public function update(Request $request)
    {
        if (! Gate::allows('visitor_manage')) {
            return abort(401);
        }
        $visit = VisitorInformation::find($request->id);
        $visit->update($request->all());
        return redirect()->route('visitor.list');
    }

    public function destroy(Request $request)
    {
        if (! Gate::allows('visitor_manage')) {
            return abort(401);
        }
        $visit = VisitorInformation::find($request->id);
        $visit->delete();
        return redirect()->route('visitor.list');
    }
}
