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
<div class="card create-vistor-sec">
    <form action="{{ route('visitor.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="jumbotron" style="padding: 1rem 2rem !important;">
                <h3 class="display-4 text-center">Visitor Entry</h3>
                <hr class="my-4">
                <div class="form-row">
                    <div class="col">
                        <label class="h4" for="employee_id">Meet With <span class="text-danger">*</span></label>
                        <input type="hidden" id="id" name="id" value="{{ $visit->id }}" required>
                        <select class="form-control select2" name="employee_id" id="employee_id" required>
                            <option value="">Employee Name [ Employee Designation ]</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ $employee->id==$visit->employee_id?'selected':'' }}>{{ $employee->name }} [ {{ $employee->department }} ] [ {{ $employee->designation }} ]</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="h4" for="name">Visitor Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg" name="name" id="name" value="{{ $visit->name }}" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="h4" for="address">Address / Company <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg" name="address" id="address" value="{{ $visit->address }}" required>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <label class="h4" for="purpose">Visit Purpose <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="purpose" value="{{ $visit->purpose }}" id="purpose" required>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="h4" for="contact">Visitor Mobile Number </label>
                            <input type="text" class="form-control form-control-lg" name="contact" value="{{ $visit->contact }}" id="contact">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="h4" for="card_no">Visitor Card <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="card_no" value="{{ $visit->card_no }}" id="card_no" required>
                    </div>
                    <div class="col-md-6">
                        <label class="h4 mt-4" for="card_no">&nbsp;</label>
                        <button type="submit" class="btn btn-lg btn-success">Update Visit</button>
                    </div>
                </div>

                <hr class="my-4">
            </div>
        </div>
        <div class="card-footer">
            <a class="btn btn-lg btn-info" href="{{ route('visitor.list') }}">Latest Visitors List</a>
        </div>
    </form>
</div>
@endsection