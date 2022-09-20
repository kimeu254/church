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
                        <th>Project Name</th>
                        <th>Start Date</th>
                        <th>Completion Date Target</th>
                        <th>TARGET AMOUNT</th>
                        <th>Progress</th>
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
                    <h3 class="modal-title">Manage Projects</h3>
                </div>
                <div class="modal-body form">
                    <form action="#" id="form" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" value="" id="id" name="id"/>
                        <input type="hidden" value="{{ Auth::user()->church_id }}" id="church_id" name="church_id" />

                        <div class="form-body">
                            <div class="form-group row">
                                <label class="control-label col-md-3">Project Name</label>
                                <div class="col-md-9">
                                    <input name="project_name" placeholder="Project Name" class="form-control"
                                           type="text">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="control-label col-md-3">Start Date</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input name="start_date" type="date" id="start date" class="form-control" placeholder="Start Date" id="datepicker">
                                        <span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
                                    </div><!-- input-group -->
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="control-label col-md-3">Completion Date Target</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input name="completion_date_target" type="date" id="completion date target" class="form-control" placeholder="Completion Date Target" id="datepicker">
                                        <span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
                                    </div><!-- input-group -->
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="control-label col-md-3">Target Amount</label>
                                <div class="col-md-9">
                                    <input name="target_amount" placeholder="Enter Target Amount" class="form-control" type="number">
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="control-label col-md-3">Progress/Stage</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="project_stage_id">
                                        <option value=""></option>
                                        @foreach($projectstages as $type)
                                            <option value="{{$type->id}}">{{$type->project_stage}}</option>
                                        @endforeach
                                    </select>
<!--                                    <input name="progress" placeholder="Project progress/Stage" class="form-control"
                                           type="text">-->
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
                dom: 'Bfrtip',
                ajax: '{{ route('list-projects') }}',
                columns: [
                    { data: 'project_name', name: 'project_name' },
                    { data: 'start_date', name: 'start_date' },
                    { data: 'completion_date_target', name: 'completion_date_target' },
                    { data: 'target_amount', name: 'target_amount' },
                    { data: 'project_stage_detail', name: 'project_stage_detail' },
                    { data: 'status', name: 'status' },
                    { data: "action" }
                ],
                buttons: [
                    'pageLength', 'excel',
                    {
                        text: 'New Project',
                        action: function (e, dt, node, config) {
                            add_project();
                        }
                    }
                ],
            });
        });


        function add_project()
        {
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('New Project'); // Set Title to Bootstrap modal title
        }

        function edit_project(id)
        {
            save_method = 'update';
            $('#form')[0].reset(); // reset form on modals

            //Ajax Load data from ajax
            $.ajax({
                url : "projects/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {

                    $('[name="id"]').val(data[0].id);
                    $('[name="project_name"]').val(data[0].project_name);
                    $('[name="start_date"]').val(data[0].start_date);
                    $('[name="completion_date_target"]').val(data[0].completion_date_target);
                    $('[name="target_amount"]').val(data[0].target_amount);
                    $('[name="project_stage_id"]').val(data[0].project_stage_id);
                    $('[name="status"]').val(data[0].status);



                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Project'); // Set title to Bootstrap modal title

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
                url = "projects";
                t = "POST";
            }
            else
            {
                var id = document.getElementById('id').value;
                url = "projects/" + id;
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

