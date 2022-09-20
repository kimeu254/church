@extends('layouts.app')

@section('content')
    <style>
        #progress {
            display: none;
            color: green;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <table id="table" class="table  table-striped" cellspacing="0" width="100%">
                    <thead class="thead-default" style="text-transform: uppercase;">
                    <tr>
                        <th>Contributor's Names</th>
                        <th>Project Name</th>
                        <th>Contribution Date</th>
                        <th>Payment Mode</th>
                        <th>Amount Contributed</th>
                        <th style="width:125px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end row -->
    <!-- Bootstrap modal -->
    <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Manage Projects</h3>
                </div>
                <div class="modal-body form">
                    <form action="#" id="form" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" value="" id="id" name="id"/>
                        <input type="hidden" value="{{ Auth::user()->church_id }}" id="church_id" name="church_id" />

                        <div class="form-body">
                            <div class="form-group row ">
                                <label class="control-label col-md-3">Contributor</label>
                                <div class=" col-sm-9" id="event-type">
                                    <div class="form-check form-check-inline"
                                         onclick="toggleTime('member')">
                                        <label class="form-check-label">
                                            <input class="form-check-input scheduler" type="radio"
                                                   name="member" value="member" checked=""> Member
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline"
                                         onclick="toggleTime('nonmember')">
                                        <label class="form-check-label">
                                            <input class="form-check-input scheduler" type="radio"
                                                   name="member" value="nonmember"> Non-Member
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div id="nonmember" class="form-group row row-sm hidden">
                                <label class="control-label col-md-3">Contributor's Names</label>
                                <div class="col-md-9">
                                    <input name="names" placeholder="Enter Names of Contributor" class="form-control" type="text">
                                </div>
                            </div>

                            <div id="phone_number" class="form-group row row-sm hidden">
                                <label class="control-label col-md-3">Phone Number</label>
                                <div class="col-md-9">
                                    <input name="phone_number" placeholder="Enter Phone Number" class="form-control" type="text">
                                </div>
                            </div>


                            <div id="member" class="form-group row row-sm hidden">
                                <label for="" class="control-label col-md-3">Member</label>
                                <select class="selectpicker col-md-9" data-live-search="true"
                                        name="member" multiple>
                                    <option value="">Select Member</option>
                                    @foreach($members as $member)
                                        <option data-tokens="ketchup mustard"
                                                value="{{$member->id}}">{{$member->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group row">
                                <label class="control-label col-md-3">Project Name</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="project_name_id">
                                        <option value=""></option>
                                        @foreach($projects as $type)
                                            <option value="{{$type->id}}">{{$type->project_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Contribution Date</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input name="contribution_date" type="date" id="contribution date" class="form-control" placeholder="Contribution Date" id="datepicker">
                                        <span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
                                    </div><!-- input-group -->
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="form-group row">
                                    <label class="control-label col-md-3">Payment Mode</label>
                                    <div class="col-md-9">
                                        <select name="payment_mode" class="form-control" onchange="otherSelect()">
                                            <option value=""></option>
                                            <option value="MPesa">MPesa</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Cheque">Cheque</option>
                                            <option value="Credit card">Credit card</option>
                                            <option value="Debit card">Debit card</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div id="Code" class="form-group row row-sm hidden">
                                <label class="control-label col-md-3">Code</label>
                                <div class="col-md-9">
                                    <input name="code" placeholder="input sms code" class="form-control"
                                           type="text">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="control-label col-md-3">Amount Contributed</label>
                                <div class="col-md-9">
                                    <input name="amount_contributed" placeholder="Amount Contributed" class="form-control" type="number">
                                </div>
                            </div>


                        <div id="progress">Please wait...</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->




    <script type="text/javascript">

        var save_method; //for save method string
        var table;

        $(document).ready(function() {
            table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                order: [ [0, 'desc'] ],
                dom: 'Bfrtip',
                ajax: '{{ route('list-contributions') }}',
                columns: [
                    { data: 'member_name', name: 'member_name'},
                    { data: 'project_name_detail', name: 'project_name_detail' },
                    { data: 'contribution_date', name: 'contribution_date' },
                    { data: 'payment_mode', name: 'payment_mode' },
                    { data: 'amount_contributed', name: 'amount_contributed' },
                    { data: "action" }
                ],
                buttons: [
                    'pageLength', 'excel',
                    {
                        text: 'New Contribution',
                        action: function (e, dt, node, config) {
                            add_contribution();
                        }
                    }
                ],
            });
        });

        function otherSelect(){
            if (document.forms[0].payment_mode.options[document.forms[0].payment_mode.selectedIndex].value == "MPesa"){
                $("#Code").removeClass('hidden')
            } else{
                $("#Code").addClass('hidden')
            }
        }

        function toggleTime(val) {
            if (val === "member") {
                $("#member").removeClass('hidden')
            } else {
                $("#member").addClass('hidden')
            }
            if (val === "nonmember") {
                $("#nonmember").removeClass('hidden')
            } else {
                $("#nonmember").addClass('hidden')
            }
            if (val === "nonmember") {
                $("#phone_number").removeClass('hidden')
            } else {
                $("#phone_number").addClass('hidden')
            }
        }


        function add_contribution()
        {
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('New Contribution'); // Set Title to Bootstrap modal title
        }

        function edit_contribution(id)
        {
            save_method = 'update';
            $('#form')[0].reset(); // reset form on modals

            //Ajax Load data from ajax
            $.ajax({
                url : "contributions/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {

                    $('[name="id"]').val(data[0].id);
                    $('[name="member"]').val(data[0].member);
                    $('[name="names"]').val(data[0].names);
                    $('[name="phone_number"]').val(data[0].phone_number);
                    $('[name="project_name_id"]').val(data[0].project_name_id);
                    $('[name="contribution_date"]').val(data[0].contribution_date);
                    $('[name="payment_mode"]').val(data[0].payment_mode);
                    $('[name="code"]').val(data[0].code);
                    $('[name="amount_contributed"]').val(data[0].amount_contributed);


                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Contribution'); // Set title to Bootstrap modal title

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    // alert('Error get data from ajax');
                    swal({   title: "Error",
                        text: "Error getting data from ajax.",
                        timer: 2500,
                        type: "error",
                        showConfirmButton: false
                    });
                }
            });
        }

        function reload_table()
        {
            table.ajax.reload(null,false); //reload datatable ajax
        }

        function save()
        {
            $('#progress').show();
            var url;
            if(save_method == 'add')
            {
                url = "contributions";
                t = "POST";
            }
            else
            {
                var id = document.getElementById('id').value;
                url = "contributions/" + id;
                t = "PUT";
            }

            // ajax adding data to database
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : url,
                type: t,
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data)
                {
                    //if success close modal and reload ajax table
                    reload_table();
                    $('#progress').hide();
                    $('#modal_form').modal('hide');
                    swal({   title: "Success",
                        text: "Project has been Added/Updated successfully.",
                        timer: 2500,
                        type: "success",
                        showConfirmButton: false
                    });
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    // alert('Error adding / update data');
                    swal({   title: "Error",
                        text: "Error adding / updating data.",
                        // timer: 1000,
                        type: "error",
                        showConfirmButton: true
                    });
                }
            });
        }

        function delete_appdata(id)
        {

            swal({
                    title: "Are you sure?",
                    text: "Your will not be able to recover this App Data Settings!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                },
                function(){
                    // ajax delete data to database
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url : "/app-data/"+id,
                        type: "DELETE",
                        dataType: "JSON",
                        success: function(data)
                        {
                            // swal("Deleted!", "Your imaginary file has been deleted.", "success");
                            swal({   title: "Deleted",
                                text: "App Data Setting has been Deleted.",
                                timer: 2500,
                                type: "success",
                                showConfirmButton: false
                            });
                            reload_table();
                        },
                    });
                });
        }


    </script>
@endsection
