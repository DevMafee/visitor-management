<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeInformation;
use App\VisitorInformation;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Gate;

class TrashedDataController extends Controller
{
    public function employee()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $employees = EmployeeInformation::onlyTrashed()->get();

        return view('trash.employee', compact('employees'));
    }

    public function employeeRestore(Request $request, $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        if(EmployeeInformation::onlyTrashed()->where('id', $id)->restore()){
        	return redirect()->route('trash.employee')->with(['message'=>'Restore Operation Succeed.']);
        }else{
        	return redirect()->route('trash.employee')->with(['message'=>'Failed Restore Operation.']);
        }
        
    }

    public function visits()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $visits = VisitorInformation::onlyTrashed()->get();

        return view('trash.visits', compact('visits'));
    }

    public function visitsRestore(Request $request, $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        
        if(VisitorInformation::onlyTrashed()->where('id', $id)->restore()){
        	return redirect()->route('trash.visits')->with(['message'=>'Restore Operation Succeed.']);
        }else{
        	return redirect()->route('trash.visits')->with(['message'=>'Failed Restore Operation.']);
        }
        
    }

    public function users()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $users = User::onlyTrashed()->get();

        return view('trash.users', compact('users'));
    }

    public function usersRestore(Request $request, $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        
        if(User::onlyTrashed()->where('id', $id)->restore()){
        	return redirect()->route('trash.users')->with(['message'=>'Restore Operation Succeed.']);
        }else{
        	return redirect()->route('trash.users')->with(['message'=>'Failed Restore Operation.']);
        }
        
    }

}
