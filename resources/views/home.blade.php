@extends('layouts.admin')

@section('content')
<style> 
    .create-vistor-sec  .select2-container--default:focus{
        border: 0;
    }
    .create-vistor-sec  .select2-container--default span.select2-selection.select2-selection--single {
        height: calc(1.5em + 1rem + 2px);
        padding: .5rem 1rem;
        font-size: 1.09375rem;
        line-height: 1.5;
        border-radius: .3rem;
        border: 0;
    }

    .create-vistor-sec .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(1.5em + 1rem + 2px);
    } 
    .select2-selection__rendered:focus{
        border: 0;
    }
    .create-vistor-sec .select2-container--focus {
        border: 0 !important;
    }
    .create-vistor-sec .select2-container--focus:focus {
        border: 0 !important;
    }
    span.select2-results ul li {
        padding: 0 10px;
    }
</style>
<div class="content">
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header text-center bg-info" style="background-color: #077292!important;">
                    <h4>Today's Visitor IN / Out</h4>
                </div>
                <div class="card-header text-center">
                    <h4>{{ $todayCountIn }} / {{ $todayCountOut }}</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header text-center bg-warning" style="background-color: #3d4e0ade!important;">
                    <h4>Visitor This Week IN / Out</h4>
                </div>
                <div class="card-header text-center">
                    <h4>{{ $thisWeekCountIn }} / {{ $thisWeekCountOut }}</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header text-center bg-dark" style="background-color: #523020!important;">
                    <h4>Visitor This Month IN / Out</h4>
                </div>
                <div class="card-header text-center">
                    <h4>{{ $thisMonthCountIn }} / {{ $thisMonthCountOut }}</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header text-center bg-dark">
                    <h4>Visitor This This Year IN / Out</h4>
                </div>
                <div class="card-header text-center">
                    <h4>{{ $thisYearCountIn }} / {{ $thisYearCountOut }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header text-center bg-info" style="background-color: #077292!important;">
                    <h4>Latest's In Visitors</h4>
                </div>
                <table class="card-body table table-bordered table-striped table-hover datatable" style="margin:0px !important; padding:0px !important;">
                    <thead>
                        <tr>
                            <th scope="col" width="15px">#</th>
                            <th scope="col">Card No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Meet With</th>
                            <th scope="col">Department</th>
                            <th scope="col">Purpose</th>
                            <th scope="col">In Time</th>
                            <th scope="col" width="15px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestVisits as $latestVisit)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $latestVisit->card_no }}</td>
                            <td>{{ $latestVisit->name }}</td>
                            <td>{{ $latestVisit->employee->name }}</td>
                            <td>{{ $latestVisit->employee->department }}</td>
                            <td>{{ $latestVisit->purpose }}</td>
                            <td>{{ date('h:i A', strtotime($latestVisit->in_time)) }}</td>
                            <td>
                                <form action="{{ url('visitor/visitor-out') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="id" value="{{ $latestVisit->id }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-warning" value="Out">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-5 create-vistor-sec">
            <form action="{{ route('visitor.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="jumbotron">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label class="h4" for="employee_id">Meet With <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control select2" name="employee_id" id="employee_id" required>
                                        <option value="">Employee Name [ Employee Designation ]</option>
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->name }} [ {{ $employee->department }} ] [ {{ $employee->designation }} ]</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label class="h4" for="name">Visitor Name <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control form-control-lg" name="name" id="name" required>
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label class="h4" for="address">Address or Company</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control form-control-lg" name="address" id="address">
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label class="h4" for="purpose">Visit Purpose <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control form-control-lg" name="purpose" id="purpose" required>
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label class="h4" for="contact">Visitor Mobile Number </label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control form-control-lg" name="contact" id="contact">
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label class="h4" for="card_no">Visitor Card </label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control form-control-lg" name="card_no" id="card_no">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center bg-success">
                        <button type="submit" class="btn btn-lg btn-block btn-success">Add Visitor</button>
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-header text-center bg-success" style="background-color: #0f6b45!important;">
                    <h4>Today's Out Visitors</h4>
                </div>
                <table class="card-body table table-bordered table-striped table-hover" style="margin:0px !important; padding:0px !important;">
                    <thead>
                        <tr>
                            <th scope="col" width="15px">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Meet With</th>
                            <th scope="col">Department</th>
                            <th scope="col">Purpose</th>
                            <th scope="col">In Time</th>
                            <th scope="col">Out Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestOutVisits as $latestOutVisit)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $latestOutVisit->name }}</td>
                            <td>{{ $latestOutVisit->employee->name }}</td>
                            <td>{{ $latestOutVisit->employee->department }}</td>
                            <td>{{ $latestOutVisit->purpose }}</td>
                            <td>{{ date('h:i A', strtotime($latestOutVisit->in_time)) }}</td>
                            <td>{{ date('h:i A', strtotime($latestOutVisit->out_time)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection