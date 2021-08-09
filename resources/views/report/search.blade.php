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
    .select2-container{
        border: 1px solid black !important;
    }
</style>
<div class="card create-vistor-sec">
    <form action="{{ route('report.reportView') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row" style="padding: 1rem 1rem !important; margin: 50px;">
                <div class="col-md-12">
                    <span class="h3">Visitor Report</span>
                    <hr>
                    <div class="form-row">
                        <div class="col">
                            <label for="name">Visitor Name</label>
                            <input type="text" class="form-control form-control-lg select2-container" name="name" id="name" placeholder="Visitor Name">
                        </div>
                        <div class="col">
                            <label for="address">Address or Company</label>
                            <input type="text" class="form-control form-control-lg select2-container" name="address" id="address" placeholder="Visitor Address">
                        </div>
                        <div class="col">
                            <label for="employee_id">Employee</label>
                            <select class="form-control select2 form-control-lg" name="employee_id" id="employee_id" >
                                <option value="">Employee Name [ Employee Designation ]</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }} [ {{ $employee->department }} ] [ {{ $employee->designation }} ]</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col">
                            <label for="user_id">Entry By</label>
                            <select class="form-control select2 form-control-lg" name="user_id" id="user_id" >
                                <option value="">Entry Operator Select</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} [ {{ $user->designation }} ]</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="from_date">From Date</label>
                            <input type="date" class="form-control form-control-lg select2-container" name="from_date" id="from_date" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col">
                            <label for="to_date">To Date</label>
                            <input type="date" class="form-control form-control-lg select2-container" name="to_date" id="to_date" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <!-- <div class="col">
                            <div class="form-group">
                                <label for="employee">Employee </label>
                                <input type="text" class="form-control form-control-lg" name="employee" id="employee">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="visitor">Visitor Name </label>
                                <input type="text" class="form-control form-control-lg" name="visitor" id="visitor">
                            </div>
                        </div> -->
                    </div>
                    <hr>
                    <div class="form-row">
                        <button type="submit" class="btn btn-lg btn-success">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection