@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.employeeManage.create_new_btn') }}
    </div>

    <div class="card-body">
        <form action="{{ route('employee.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="col">
                    <label for="emp_id">ID <span class="text-danger">*</span></label>
                    <input type="text" id="emp_id" name="emp_id" class="form-control" value="{{ $employee->emp_id ?? '' }}" required>
                </div>
                <div class="col">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="hidden" id="id" name="id" class="form-control" value="{{ $employee->id }}" required>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $employee->name ?? '' }}" required>
                </div>
                <div class="col">
                    <label for="department">Department <span class="text-danger">*</span></label>
                    <input type="text" id="department" name="department" class="form-control" value="{{ $employee->department ?? '' }}" />
                </div>
            </div>
            <div class="form-row mt-2">
                <div class="col">
                    <label for="designation">Designation <span class="text-danger">*</span></label>
                    <input type="text" id="designation" name="designation" class="form-control" value="{{ $employee->designation ?? '' }}" />
                </div>
                <div class="col">
                    <label for="contact">Contact Number </label>
                    <input type="text" id="contact" name="contact" class="form-control" value="{{ $employee->contact ?? '' }}">
                </div>
            </div>
            <div class="mt-2">
                <input class="btn btn-success" type="submit" value="{{ trans('global.update') }}">
            </div>
        </form>
    </div>
</div>
@endsection