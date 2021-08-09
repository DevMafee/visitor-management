@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Deleted Employees List
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Permission">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th width="10">#</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Contact Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 0 @endphp
                    @foreach($employees as $key => $employee)
                        <tr data-entry-id="{{ $employee->id }}">
                            <td>

                            </td>
                            <td>
                                {{ ++$i }}
                            </td>
                            <td>
                                {{ $employee->name ?? '' }}
                            </td>
                            <td>
                                {{ $employee->department ?? '' }}
                            </td>
                            <td>
                                {{ $employee->designation ?? '' }}
                            </td>
                            <td>
                                {{ $employee->contact ?? '' }}
                            </td>
                            <td>
                                <form action="{{ url('trash/employee/restore/'.$employee->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="id" value="{{ $employee->id }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-success" value="Retrive">
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
        $.extend(true, $.fn.dataTable.defaults, {
            order: [[ 1, 'asc' ]],
            pageLength: 25,
        });
        $('.datatable-Permission:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    })
</script>
@endsection