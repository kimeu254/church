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

                        <th>Income Type</th>
                        <th>Income Detail</th>
                        <th>Date Received</th>
                        <th>Payment Mode</th>
                        <th>Amount</th>
                        <th>Confirmed</th>
                        <th>Status</th>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Income Details</h3>
                </div>
                <div class="modal-body form">
                    <form action="#" id="form" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" value="" id="id" name="id" />
                        <input type="hidden" value="{{ Auth::user()->church_id }}" id="church_id" name="church_id" />
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="control-label col-md-3">Income Type</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="income_type_id">
                                        <option value=""></option>
                                        @foreach($income_types as $type)
                                            <option value="{{$type->id}}">{{$type->income_type}}</option>
                                        @endforeach
                                    </select>
                                    {{--                                    <input name="income_type" placeholder="Income Type" class="form-control" type="text">--}}
                                </div>
                            </div>

                            <div id="member" class="form-group row">
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

                            <div id="service" class="form-group row">
                                <label for="" class="control-label col-md-3">Service</label>
                                <select class="selectpicker col-md-9" data-live-search="true"
                                        name="service" multiple>
                                    <option value="">Select Service</option>
                                    @foreach($service as $service)
                                        <option data-tokens="ketchup mustard"
                                                value="{{$service->id}}">{{$service->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group row">
                                <label class="control-label col-md-3">Income Detail</label>
                                <div class="col-md-9">
                                    <input name="income_detail" placeholder="Income Detail" class="form-control"
                                           type="text">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="control-label col-md-3">Date Received</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input name="date_received" type="date" id="Date Received" class="form-control" placeholder="Date Received" id="datepicker">
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

                                        {{--                                    <input name="payment_mode" placeholder="Payment Mode" class="form-control" type="text">--}}
                                    </div>
                                </div>

                                <div id="Code" class="form-group row row-sm hidden">
                                    <label class="control-label col-md-3">Code</label>
                                    <div class="col-md-9">
                                        <input name="code" placeholder="input sms code" class="form-control"
                                               type="text">
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                                    <label class="control-label col-md-3">Amount</label>
                                    <div class="col-md-9">
                                        <input name="amount" placeholder="Amount" class="form-control" type="number"{{ old('amount') }}>
                                        <span class="text-danger">{{ $errors->first('amount') }}</span>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Confirmed</label>
                                        <div class="col-md-9">
                                            <select name="confirmed" class="form-control">
                                                <option value="">Select Option</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="control-label col-md-3">Status</label>
                                    <div class="col-md-9">
                                        <select name="status" class="form-control">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="progress">Please wait...</div>

                            </div>
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

        $(document).ready(function () {
            table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                order: [ [0, 'desc'] ],
                dom: 'Bfrtip',
                ajax: '{{ ('list-incomes') }}',
                columns: [
                    {
                        data: 'income_type_detail',
                        name: 'income_type_detail'
                    },
                    {
                        data: 'income_detail',
                        name: 'income_detail'
                    },

                    {
                        data: 'date_received',
                        name: 'date_received'
                    },
                    {
                        data: 'payment_mode',
                        name: 'payment_mode'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'confirmed',
                        name: 'confirmed'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: "action"
                    }
                ],

                buttons: [
                    'pageLength', 'excel',
                    {
                        text: 'New Income',
                        action: function (e, dt, node, config) {
                            add_income();
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


        function add_income() {
            $('#modal_form').modal('show'); // show bootstrap modal
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('.modal-title').text('New Income Input'); // Set Title to Bootstrap modal title
        }

        function edit_income(id) {
            save_method = 'update';
            $('#form')[0].reset(); // reset form on modals

            //Ajax Load data from ajax
            $.ajax({
                url: "incomes/" + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {

                    $('[name="id"]').val(data[0].id);
                    $('[name="income_type_id"]').val(data[0].income_type_id);
                    $('[name="income_detail"]').val(data[0].income_detail);
                    $('[name="member"]').val(data[0].member);
                    $('[name="service"]').val(data[0].service);
                    $('[name="date_received"]').val(data[0].date_received);
                    $('[name="payment_mode"]').val(data[0].payment_mode);
                    $('[name="code"]').val(data[0].code);
                    $('[name="amount"]').val(data[0].amount);
                    $('[name="confirmed"]').val(data[0].confirmed);
                    $('[name="status"]').val(data[0].status);


                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Income Details'); // Set title to Bootstrap modal title

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        }



        function reload_table() {
            table.ajax.reload(null, false); //reload datatable ajax
        }

        function save() {
            $('#progress').show();
            var url;
            if (save_method == 'add') {
                url = "incomes";
                t = "POST";
            } else {
                var id = document.getElementById('id').value;
                url = "incomes/" + id;
                t = "PUT";
            }
            // alert($('#form').serialize());
            // ajax adding data to database
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: t,
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function (data) {
                    reload_table();
                    //if success close modal and reload ajax table
                    $('#progress').hide();
                    $('#modal_form').modal('hide');
                    swal({
                        title: "Success",
                        text: "Income has been Added/Updated successfully.",
                        timer: 2500,
                        type: "success",
                        showConfirmButton: false
                    });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // console.log(data);
                    // alert('Error adding / update data');
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
        /*$('#form').on('submit',function(event){
            event.preventDefault();
            income_type_id = $('#income_type_id').val();
            income_detail = $('#income_detail').val();
            member = $('#member').val();
            service = $('#service').val();
            date_received = $('#date_received').val();
            payment_mode = $('#payment_mode').val();
            code = $('#code').val();
            amount = $('#amount').val();
            confirmed =$('#confirmed').val();
            status = $('#status').val();
            $.ajax({
                url: "incomes",
                type:"POST",
                data:{
                    income_type_id:income_type_id,
                    income_detail:income_detail,
                    member:member,
                    service:service,
                    date_received:date_received,
                    payment_mode:payment_mode,
                    code:code,
                    amount:amount,
                    confirmed:confirmed,
                    status:status,
                },
                success:function(response){
                    console.log(response); #Its return your success message
                },

                error: function(response) {
                    $('#amountError').text(response.responseJSON.errors.name);

                }

            });
        });
*/
        function delete_productcat(id) {
            swal({
                    title: "Are you sure?",
                    text: "Your will not be able to recover this Category!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                },
                function () {
                    // ajax delete data to database
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "categories/" + id,
                        type: "DELETE",
                        dataType: "JSON",
                        success: function (data) {
                            // swal("Deleted!", "Your imaginary file has been deleted.", "success");
                            swal({
                                title: "Deleted",
                                text: "Income has been Deleted.",
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
