@extends('layouts.app')
@section('content')
<div class="row">









    <div class="col-sm-12">
    <div class="card-box table-responsive">
        <form action="#" id="filterform" class="form-horizontal">
            <select class="pull-right event_id" style="" id="event_id" name="event_id" onchange="loadAttendance(this)">
            @foreach ($schedules as $list)
                <option value="{{ $list->id }}">{{ $list->event_name }} on {{ $list->servicedate }} From {{ $list->start_time }} to {{ $list->end_time }}</option>
            @endforeach
            </select>
            </form>

<table class="table table-hover table-striped" id="attendancetable">
    <thead>
    <th>NAME</th>
    {{-- <th>CHURCH NAME</th> --}}
    <th>EVENT</th>
    <th>SERVICE DATE</th>
    <th>START</th>
    <th>END</th>
    <th>STATUS</th>
    <th>CHANGE TIME</th>
    <th>CREATED AT</th>
    <th></th>
</thead>
    <body>
    </body>
</table>

<script>
     $(document).ready(function() {
        var table;
        loadAttendance();
    });

    function loadAttendance(){
        $('#attendancetable').dataTable().fnDestroy();
        var url = '{{ route('attendance-list') }}?';
        table = $('#attendancetable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                    "url": url + $('#filterform').serialize(),
                    "type": "GET"
                },
            columns: [
                { data: 'name', name: 'name' },
                //{ data: 'church_name', name: 'church_name' },
                { data: 'event_name', name: 'event_name' },
                { data: 'servicedate', name: 'servicedate' },
                { data: 'start_time', name: 'start_time' },
                { data: 'end_time', name: 'end_time' },
                { data: 'status', name: 'status' },
                { data: 'changetime', name: 'changetime' },
                { data: 'addedat', name: 'addedat' },
                { data: "action" }
            ]
        });
    }

 function admit(slotid){
            method = "GET";
            // ajax adding data to database
            $.ajax({
                url: '{{ url('admit-member') }}/' + slotid,
                type: method,
                dataType: "JSON",
                success: function (data) {
                    swal({
                        title: "Success",
                        text: "Admitted.",
                        timer: 2500,
                        type: "success",
                        showConfirmButton: false
                    });
                    reload_table()
                },
                error: function (jqXHR, textStatus, errorThrown) {

                    swal({
                        title: "Error",
                        text: "Error adding / updating data.",
                        // timer: 1000,
                        type: "error",
                        showConfirmButton: true
                    });
                }
            });
    }
 function cancel(slotid){
    method = "GET";
            // ajax adding data to database
            $.ajax({
                url: '{{ url('cancel-member') }}/' + slotid,
                type: method,
                dataType: "JSON",
                success: function (data) {
                    swal({
                        title: "Success",
                        text: "Cancelled Slot.",
                        timer: 2500,
                        type: "success",
                        showConfirmButton: false
                    });
                    reload_table()
                },
                error: function (jqXHR, textStatus, errorThrown) {

                    swal({
                        title: "Error",
                        text: "Error adding / updating data.",
                        // timer: 1000,
                        type: "error",
                        showConfirmButton: true
                    });
                }
            });
    }

function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax
  }

</script>
</div>
</div>

@endsection