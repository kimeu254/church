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
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="pull-left page-title">Income Types</h4>
                        <button class="btn btn-success pull-right" onclick="add_income_type()"><i class="glyphicon glyphicon-plus"></i> Add Income Type</button>
                    </div>
                </div>

                <table id="table" class="table table-striped table-hover table-condensed">
                    <thead class="thead-default">
                    <tr>
                        <th>Income Type</th>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Manage Incomes</h3>
                </div>
                <div class="modal-body form">
                    <form action="#" id="form" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" value="" id="id" name="id"/>
                        <input type="hidden" value="{{ Auth::user()->church_id }}" id="church_id" name="church_id"/>
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="control-label col-md-3">Income Type</label>
                                <div class="col-md-9">
                                    <input name="income_type" placeholder="Income Type" class="form-control" type="text">
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

        $(document).ready(function() {
            table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                order: [ [0, 'desc'] ],
                ajax: '{{ route('list-incometypes') }}',
                columns: [
                    { data: 'income_type', name: 'income_type' },
                    { data: 'status', name: 'status' },
                    { data: "action" }
                ]
            });
        });

        function add_income_type()
        {
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('New Income Type'); // Set Title to Bootstrap modal title
        }

        function edit_income_type(id)
        {
            save_method = 'update';
            $('#form')[0].reset(); // reset form on modals

            //Ajax Load data from ajax
            $.ajax({
                url : "incometypes/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {

                    $('[name="id"]').val(data[0].id);
                    $('[name="income_type"]').val(data[0].income_type);
                    $('[name="status"]').val(data[0].status);



                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Income Type'); // Set title to Bootstrap modal title

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
                url = "incometypes";
                t = "POST";
            }
            else
            {
                var id = document.getElementById('id').value;
                url = "incometypes/" + id;
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
                success: function(data) {
                    reload_table();
                    //if success close modal and reload ajax table
                    $('#progress').hide();
                    $('#modal_form').modal('hide');
                    swal({   title: "Success",
                        text: "Income type has been Added/Updated successfully.",
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
                        url : "/app-data-settings/"+id,
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

