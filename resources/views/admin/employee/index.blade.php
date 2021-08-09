@extends('layouts.admin')
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('employee.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.employeeManage.create_new_btn') }}
        </a>
        &nbsp;
        <a class="btn btn-info" href="{{ url('import/employee') }}">
            {{ trans('global.import') }} {{ trans('cruds.employeeManage.create_new_btn') }}
        </a>
    </div>
</div>
<div class="card">
    <div class="card-header">
        {{ trans('cruds.employeeManage.create_new_btn') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Permission">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th width="20">#</th>
                        <th>ID</th>
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
                                {{ $employee->emp_id ?? '' }}
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
                                <a class="btn btn-xs btn-primary" href="{{ url('employee/'.$employee->id) }}">
                                    {{ trans('global.view') }}
                                </a>

                                <a class="btn btn-xs btn-info" href="{{ route('employee.edit', $employee->id) }}">
                                    {{ trans('global.edit') }}
                                </a>

                                <form action="{{ url('employee/destroy/'.$employee->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id" value="{{ $employee->id }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
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
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ url('employee_mass_destroy') }}",
            className: 'btn-danger',
            action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                    return $(entry).data('entry-id')
                });
                
                if (ids.length === 0) {
                    alert('{{ trans('global.datatables.zero_selected') }}')
                    return
                }

                if (confirm('{{ trans('global.areYouSure') }}')) {
                    $.ajax({
                        headers: {'x-csrf-token': _token},
                        method: 'POST',
                        url: config.url,
                        data: { ids: ids }
                    }).done(function () {
                        location.reload()
                    });
                }
            }
        }
        dtButtons.push(deleteButton)

        $.extend(true, $.fn.dataTable.defaults, {
        // order: [[ 1, 'desc' ]],
        order: [[ 1, 'asc' ]],
        pageLength: 100,
    });
    $('.datatable-Permission:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
        });
    })
</script>
@endsection