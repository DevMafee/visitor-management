<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\VisitorInformation;
use App\EmployeeInformation;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = EmployeeInformation::where('status','Active')->get();

        $todayCountIn = count(VisitorInformation::whereBetween('in_date', [Carbon::today(), Carbon::today()])->get());
        $todayCountOut = count(VisitorInformation::whereBetween('in_date', [Carbon::today(), Carbon::today()])->where('visit_status', 'Out')->get());
        
        $thisWeekCountIn = count(VisitorInformation::whereBetween('in_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get());
        $thisWeekCountOut = count(VisitorInformation::whereBetween('in_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('visit_status', 'Out')->get());
        
        $thisMonthCountIn = count(VisitorInformation::whereBetween('in_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get());
        $thisMonthCountOut = count(VisitorInformation::whereBetween('in_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('visit_status', 'Out')->get());
        
        $thisYearCountIn = count(VisitorInformation::whereBetween('in_date', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get());
        $thisYearCountOut = count(VisitorInformation::whereBetween('in_date', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->where('visit_status', 'Out')->get());

        $latestVisits = VisitorInformation::where('visit_status', 'In')->get();
        $latestOutVisits = VisitorInformation::whereBetween('in_date', [Carbon::today(), Carbon::today()])->where('visit_status', 'Out')->get();
        return view('home', compact(
            'employees',
            'todayCountIn',
            'todayCountOut',
            'thisWeekCountIn',
            'thisWeekCountOut',
            'thisMonthCountIn',
            'thisMonthCountOut',
            'thisYearCountIn',
            'thisYearCountOut',
            'latestVisits',
            'latestOutVisits'
        ));
    }

    public function visitorOut(Request $request){
        $visit = VisitorInformation::find($request->id);
        $data = [
            'out_date'       => Carbon::now(),
            'out_time'       => Carbon::now(),
            'visit_status'  => 'Out'
        ];
        $visit->update($data);
        return redirect()->back();
    }
}
