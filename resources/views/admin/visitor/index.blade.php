@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header h4">
        Visitor {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Permission">
                <thead>
                    <tr>
                        <th width="10">#</th>
                        <th>Card No</th>
                        <th>Visitor Name</th>
                        <th>Meet With</th>
                        <th>Address/Company</th>
                        <th>Purpose</th>
                        <th>Contact Number</th>
                        <th>Added By</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 0 @endphp
                    @foreach($visitors as $key => $visitor)
                        <tr data-entry-id="{{ $visitor->id }}">
                            <td>
                                {{ ++$i }}
                            </td>
                            <td>
                                {{ $visitor->card_no ?? '' }}
                            </td>
                            <td>
                                {{ $visitor->name ?? '' }}
                            </td>
                            <td>
                                {{ $visitor->employee->name ?? '' }}
                                <br> {{ $visitor->employee->department ?? '' }}
                                <br> {{ $visitor->employee->designation ?? '' }}
                            </td>
                            <td>
                                {{ $visitor->address ?? '' }}
                            </td>
                            <td>
                                {{ $visitor->purpose ?? '' }}
                            </td>
                            <td>
                                {{ $visitor->contact ?? '' }}
                            </td>
                            <td>
                                {{ $visitor->user->name ?? '' }}
                            </td>
                            <td>
                                @can('visitor_manage')
                                    @can('employee_manage')
                                    <a class="btn btn-xs btn-info" href="{{ route('visitor.edit', $visitor->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                    <form action="{{ url('visitor/destroy/'.$visitor->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="{{ $visitor->id }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                    @endcan
                                    <form action="{{ url('visitor/visitor-out') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="id" value="{{ $visitor->id }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-warning" value="Out">
                                    </form>
                                @endcan
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
        $.extend(true, $.fn.dataTable.defaults, {
            // order: [[ 1, 'desc' ]],
            order: [[ 1, 'asc' ]],
            pageLength: 100,
        });
        $('.datatable-Permission:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    })
</script>
@endsection