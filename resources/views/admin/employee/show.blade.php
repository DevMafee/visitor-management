@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.employeeManage.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th width="250px">
                            ID
                        </th>
                        <td>
                            {{ $employee->id ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th width="250px">
                            Name
                        </th>
                        <td>
                            {{ $employee->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th width="250px">
                            Department
                        </th>
                        <td>
                            {{ $employee->department ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Designation
                        </th>
                        <td>
                            {{ $employee->designation ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Contact Number
                        </th>
                        <td>
                            {{ $employee->contact?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
        <div class="tab-content">

        </div>
    </div>
</div>
@endsection