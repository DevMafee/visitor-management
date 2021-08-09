<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VisitorInformation;
use App\EmployeeInformation;
use App\User;
use Illuminate\Support\Facades\Gate;

class ReportController extends Controller
{
    public function report()
    {
        $employees = EmployeeInformation::where('status','Active')->get();
        $users = User::whereNotIn('id',[1,2])->get();
        return view('report.search', compact('employees', 'users'));
    }

    public function reportView(Request $request)
    {
        if (! Gate::allows('visitor_manage')) {
            return abort(401);
        }
        
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $employee = $request->employee_id;
        $user = $request->user_id;
        $name = $request->name;
        $address = $request->address;
        $details = VisitorInformation::query();
        if ($employee != '') {
            $details->where('employee_id', $employee);
        }

        if ($user != '') {
            $details->where('user_id', $user);
        }

        if ($name != '') {
            $details->where('name', 'like', '%'.$name.'%');
        }

        if ($address != '') {
            $details->where('address', 'like', '%'.$address.'%');
        }

        $visits = $details->with('employee', 'user')->whereBetween('created_at', [$from_date.' 00:00:00', $to_date.' 23:59:59'])->get();
        return view('report.view', compact('visits', 'from_date', 'to_date'));
    }
}
