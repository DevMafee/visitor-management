@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.employeeManage.create_new_btn') }}
    </div>

    <div class="card-body">
        <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="col">
                    <label for="emp_id">ID <span class="text-danger">*</span></label>
                    <input type="text" id="emp_id" name="emp_id" class="form-control"  placeholder="Employee ID .." />
                </div>
                <div class="col">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" class="form-control"  placeholder="Employee Name .." required />
                </div>
                <div class="col">
                    <label for="department">Department <span class="text-danger">*</span></label>
                    <input type="text" id="department" name="department" class="form-control"  placeholder="Employee Department .." required />
                </div>
            </div>
            <div class="form-row mt-2">
                <div class="col">
                    <label for="designation">Designation <span class="text-danger">*</span></label>
                    <input type="text" id="designation" name="designation" class="form-control"  placeholder="Designation .." />
                </div>
                <div class="col">
                    <label for="contact">Contact Number </label>
                    <input type="text" id="contact" name="contact" class="form-control"  placeholder="Contact Number .." />
                </div>
            </div>
            <div class="mt-2">
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection