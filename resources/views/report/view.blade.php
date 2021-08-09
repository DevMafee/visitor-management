@extends('layouts.admin')
@section('content')
<style>
    @media print {
        body * {
        visibility: hidden;
        }
        #printThis, #printThis * {
        visibility: visible;
        }
        #printThis {
        position: absolute;
        left: 0;
        top: 0;
        }
    }
</style>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-8">Visitor List</div>
            <div class="col-4">
                <button class="btn btn-primary" type="button" onclick="return printDiv('printThis')">Print</button>
                <button class="btn btn-success" id="btnExport" onclick="fnExcelReport();">Download</button>
            </div>
        </div>
    </div>

    <div class="card-body" id="printThis">
        <div class="row">
            <div class="col text-center">
                <img src="{{ asset('img/logo.png') }}" style="max-width: 120px; ">
                <br>
                <span class="h4">Department of Social Services</span><br>
                <span class="h6">Visitor Report</span><br>
                <span class="h6">Date : From <b>{{  date('j M, Y', strtotime($from_date)) }}</b> To <b>{{ date('j M, Y', strtotime($to_date)) }}</b></span><br>
            </div>
            {{-- <div class="col-7 text-left">
                <img src="{{ asset('img/logo.png') }}" style="max-width: 120px; ">
                <br>
            </div> --}}
        </div>
        <br>
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Permission" id="headerTable">
                <thead style="background-color: lightgray;">
                    <tr>
                        <th width="10">#</th>
                        <th>Date</th>
                        <th>Card No</th>
                        <th>Visitor Name</th>
                        <th>Meet With</th>
                        <th>Address/Company</th>
                        <th width="150">Purpose</th>
                        {{-- <th>Contact Number</th> --}}
                        <th>In Time</th>
                        <th>Out Time</th>
                        <th>Added By</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 0 @endphp
                    @foreach($visits as $key => $visitor)
                        <tr data-entry-id="{{ $visitor->id }}">
                            <td>
                                {{ ++$i }}
                            </td>
                            <td>
                                {{  date('j M, Y', strtotime($visitor->created_at)) }}
                            </td>
                            <td>
                                {{ $visitor->card_no ?? '' }}
                            </td>
                            <td>
                                {{ $visitor->name ?? '' }}
                            </td>
                            <td>
                                {{ $visitor->employee->name ?? '' }}
                                {{-- <br> {{ $visitor->employee->department ?? '' }}
                                <br> {{ $visitor->employee->designation ?? '' }} --}}
                            </td>
                            <td>
                                {{ $visitor->address ?? '' }}
                            </td>
                            <td>
                                {{ $visitor->purpose ?? '' }}
                            </td>
                            {{-- <td>
                                {{ $visitor->contact ?? '' }}
                            </td> --}}
                            <td>{{ date('h:i A', strtotime($visitor->in_time)) }}</td>
                            <td>{{ $visitor->out_time!=''?date('h:i A', strtotime($visitor->out_time)):'' }}</td>
                            <td>
                                {{ $visitor->user->name ?? '' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<iframe id="txtArea1" style="display:none"></iframe>
@endsection
@section('scripts')
@parent
<script>
    function printDiv(printThis) {
        var printContents = document.getElementById(printThis).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

    function fnExcelReport(){
        var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
        var textRange; var j=0;
        tab = document.getElementById('headerTable'); // id of table

        for(j = 0 ; j < tab.rows.length ; j++) 
        {     
            tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
            //tab_text=tab_text+"</tr>";
        }

        tab_text=tab_text+"</table>";
        tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
        tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
        tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE "); 

        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
        {
            txtArea1.document.open("txt/html","replace");
            txtArea1.document.write(tab_text);
            txtArea1.document.close();
            txtArea1.focus(); 
            sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
        }  
        else                 //other browser not tested on IE 11
            sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

        return (sa);
    }
</script>
@endsection