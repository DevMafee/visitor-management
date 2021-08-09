@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Deleted Visits List
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Permission">
                <thead>
                    <tr>
                        <th width="10">#</th>
                        <th width="10">SN</th>
                        <th>Card No</th>
                        <th>Visitor Name</th>
                        <th>Meet With</th>
                        <th>Designation</th>
                        <th>Purpose</th>
                        <th>Contact Number</th>
                        <th>Added By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 0 @endphp
                    @foreach($visits as $key => $visit)
                        <tr data-entry-id="{{ $visit->id }}">
                            <td>
                                
                            </td>
                            <td>
                                {{ ++$i }}
                            </td>
                            <td>
                                {{ $visit->card_no ?? '' }}
                            </td>
                            <td>
                                {{ $visit->name ?? '' }}
                            </td>
                            <td>
                                {{ $visit->employee->name ?? '' }}
                            </td>
                            <td>
                                {{ $visit->employee->designation ?? '' }}
                            </td>
                            <td>
                                {{ $visit->purpose ?? '' }}
                            </td>
                            <td>
                                {{ $visit->contact ?? '' }}
                            </td>
                            <td>
                                {{ $visit->user->name ?? '' }}
                            </td>
                            <td>
                                <form action="{{ url('trash/visits/restore/'.$visit->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="id" value="{{ $visit->id }}">
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