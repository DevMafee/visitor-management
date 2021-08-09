@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Employee Import
    </div>

    <div class="card-body p-5">
        <form action="{{ url('import/to/db/employee') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="col">
                    <label for="employeeImport">Name <span class="text-danger">*</span></label>
                    <input type="file" id="employeeImport" style="padding: 50px; border:2px solid green;" name="employeeImport" class="form-control" required>
                </div>
            </div>
            <div class="mt-2">
                <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">
                <a class="btn btn-info" href="{{ url()->previous() }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection