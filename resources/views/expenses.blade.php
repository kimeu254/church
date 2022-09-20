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

                        <th>Expense Type</th>
                        <th>Expense Detail</th>
                        <th>Date</th>
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
                    <h3 class="modal-title">Expense Details</h3>
                </div>
                <div class="modal-body form">
                    <form action="#" id="form" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" value="" id="id" name="id" />
                        <input type="hidden" value="{{ Auth::user()->church_id }}" id="church_id" name="church_id" />
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="control-label col-md-3">Expense Type</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="expense_type_id">
                                        <option value=""></option>
                                        @foreach($expensetypes as $type)
                                            <option value="{{$type->id}}">{{$type->expense_type}}</option>
                                        @endforeach
                                    </select>
                                    {{--                                    <input name="expense_type" placeholder="Expense Type" class="form-control" type="text">--}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Expense Detail</label>
                                <div class="col-md-9">
                                    <input name="expense_detail" placeholder="Expense Detail" class="form-control" type="text">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Date of Expenditure </label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input name="date_received" type="date" id="Date Received" class="form-control" placeholder="Enter Date of Expenditure" id="datepicker">
                                        <span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
                                    </div><!-- input-group -->
                                </div>
                            </div>



                                <div class="form-group row">
                                    <label class="control-label col-md-3">Amount</label>
                                    <div class="col-md-9">
                                        <input name="amount" placeholder="Amount" class="form-control" type="number">
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
                            </div>
                        <div id="progress">Please wait...</div>
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
                ajax: '{{ ('list-expenses') }}',
                columns: [
                    {
                        data: 'expense_type_detail',
                        name: 'expense_type_detail'
                    },
                    {
                        data: 'expense_detail',
                        name: 'expense_detail'
                    },
                    {
                        data: 'date_received',
                        name: 'date_received'
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
                        text: 'New Expense',
                        action: function (e, dt, node, config) {
                            add_expense();
                        }
                    }
                ],

            });
        });

        function add_expense() {
            $('#modal_form').modal('show'); // show bootstrap modal
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('.modal-title').text('New Expense Input'); // Set Title to Bootstrap modal title
        }

        function edit_expense(id) {
            save_method = 'update';
            $('#form')[0].reset(); // reset form on modals

            //Ajax Load data from ajax
            $.ajax({
                url: "expenses/" + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {

                    $('[name="id"]').val(data[0].id);
                    $('[name="expense_type_id"]').val(data[0].expense_type_id);
                    $('[name="expense_detail"]').val(data[0].expense_detail);
                    $('[name="date_received"]').val(data[0].date_received);
                    $('[name="amount"]').val(data[0].amount);
                    $('[name="confirmed"]').val(data[0].confirmed);
                    $('[name="status"]').val(data[0].status);


                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Expense Details'); // Set title to Bootstrap modal title

                    reload_table();

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        }


        function reload_table()
        {
            table.ajax.reload(null,false); //reload datatable ajax
        }

        function save() {
            $('#progress').show();
            var url;
            if (save_method == 'add') {
                url = "expenses";
                t = "POST";
            } else {
                var id = document.getElementById('id').value;
                url = "expenses/" + id;
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
                    //if success close modal and reload ajax table
                    reload_table();
                    $('#progress').hide();
                    $('#modal_form').modal('hide');
                    swal({
                        title: "Success",
                        text: "Expense has been Added/Updated successfully.",
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
                                text: "Expense has been Deleted.",
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
