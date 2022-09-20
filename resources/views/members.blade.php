@extends('layouts.app')

@section('content')



    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">


                <table id="table" class="table  table-striped" cellspacing="0" width="100%">
                    <thead class="thead-default" style="text-transform: uppercase;">
                    <tr>
                        <th>Member Number</th>
                        <th style="width:170px">Full Names</th>
                        <th>National id</th>
                        <th>Gender</th>
                        <th>Phone Number</th>
                        <th>Residential Area</th>
                        <th>baptized</th>
                        <th>marital status</th>
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
                    <h3 class="modal-title">Membership Details</h3>
                </div>
                <div class="modal-body form">
                    <form action="#" id="form" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" value="" id="id" name="id"/>
                        <input type="hidden" value="{{ Auth::user()->church_id }}" id="church_id" name="church_id"/>
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="control-label col-md-3">Member Names</label>
                                <div class="col-md-9">
                                    <input name="name" placeholder="Full Name" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">National ID</label>
                                <div class="col-md-9">
                                    <input name="national_id" placeholder="National id" class="form-control"
                                           type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Mobile Number</label>
                                <div class="col-md-9">
                                    <input name="phone_number" placeholder="Phone Number" class="form-control"
                                           type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Email Address</label>
                                <div class="col-md-9">
                                    <input name="email" placeholder="me@palmchurch.com" class="form-control"
                                           type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Gender</label>
                                <div class="col-md-9">
                                    <select name="gender" class="form-control">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Marital Status</label>
                                <div class="col-md-9">
                                    <select name="marital_status" class="form-control" onchange="otherSelect()">
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widow">Widow</option>
                                        <option value="Widower">Widower</option>
                                    </select>
                                </div>
                            </div>
                            <div id="married_in_church" class="form-group row row-sm hidden">
                                <label class="control-label col-md-3">Married in Church</label>
                                <div class="col-md-9">
                                    <select name="married_in_church" class="form-control">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2">Baptized</label>
                                <div class="col-md-4">
                                    <select name="baptized" class="form-control">
                                        <option value="">Select Option</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>


                                <label class="control-label col-md-2">Confirmed</label>
                                <div class="col-md-4">
                                    <select name="confirmed" class="form-control">
                                        <option value="">Select Option</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Residential Area</label>
                                <div class="col-md-9">
                                    <select name="residence_zone" class="form-control">
                                        <option value="">Select Area</option>
                                        @foreach($residentialareas as $key)
                                            <option value="{{ $key->id }}">{{ $key->zone_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Status</label>
                                <div class="col-md-9">
                                    <select name="status" class="form-control">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                        <option value="Deceased">Deceased</option>
                                    </select>
                                </div>
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



    <!-- Bootstrap modal -->
    <div class="modal fade" id="ourgroups" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Community Groups</h3>
                </div>
                <div class="modal-body form">
                    <form method="post" id="myForm" class="form-horizontal">
                        <table id="member_groups" class="table" width="100%">
                            <thead class="thead-default">
                            <tr style="width: 100%; padding: 50px;">
                                <th style="width: 100%; padding: 5px;">Select Group</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <input type='hidden' name='user_id'/>
                        <input type="hidden" value="" name="resource_type"/>
                    </form>

                </div>
                <div class="modal-footer">

                    <button type="submit" id="savebutton" onclick="saveGroups()" class="btn btn-primary"><span
                                class="savebtn">Save
            Groups</span></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->

    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->

    <div class="modal fade" id="modal_import" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Import Members</h3>
                </div>
                <div class="modal-body form">
                    <div class="alert alert-info">
                        Please download <a href="{{route('members.template')}}">This Template</a> fill in the details
                        and upload it below.
                    </div>
                    <form method="post" id="member_import_form" action="{{route('members.bulk-upload')}}"
                          class="form-horizontal" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="file" name="members" required class="form-control">
                        <hr>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary mt-2">
                        <span>
                            <i class="fa fa-upload"></i> Import Members
                        </span>
                        </button>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->

    </div>

    <div class="modal fade" id="modal_filter" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Filter</h3>
                </div>
                <div class="modal-body form">
                    <form action="#" id="filter_form" class="form-horizontal">
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="control-label col-md-3">Gender</label>
                                <div class="col-md-9">
                                    <select name="filter_gender" id="filter_gender"  class="form-control">
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Fellowship zones</label>
                                <div class="col-md-9">
                                    <select name="filter_residence_zone" id="filter_residence_zone" class="form-control">
                                        <option value="">Select Zone</option>
                                        @foreach($residentialareas as $key)
                                            <option value="{{ $key->id }}">{{ $key->zone_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Member Groups</label>
                                <div class="col-md-9">
                                    <select name="filter_member_groups" id="filter_member_groups" class="form-control">
                                        <option value="">Select Group</option>
                                        @foreach($groups as $key)
                                            <option value="{{ $key->id }}">{{ $key->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                           <div class="form-group row">
                                <label class="control-label col-md-3">Marital Status</label>
                                <div class="col-md-9">
                                    <select name="filter_marital_status" id="filter_marital_status" class="form-control">
                                        <option value="">Select Option</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widow">Widow</option>
                                        <option value="Widower">Widower</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Married in Church</label>
                                <div class="col-md-9">
                                    <select name="filter_married_in_church" id="filter_married_in_church" class="form-control">
                                        <option value="">Select Option</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Baptized</label>
                                <div class="col-md-9">
                                    <select name="filter_baptized_members" id="filter_baptized_members" class="form-control">
                                        <option value="">Select Option</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="btnFilter"  class="btn btn-primary">Filter</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>






    <script type="text/javascript">
        var save_method; //for save method string
        var table;

        $(document).ready(function () {
            table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                order: [ [0, 'desc'] ],
                dom: 'Bfrtip',
                ajax: '{{ route('list-members') }}',
                columns: [
                    {
                        data: 'membership_number',
                        name: 'membership_number'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'national_id',
                        name: 'national_id'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'zone_name',
                        name: 'zone_name'
                    },
                    {
                        data: 'baptized',
                        name: 'baptized'
                    },
                    {
                        data: 'marital_status',
                        name: 'marital_status'
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
                        text: 'New Member',
                        action: function (e, dt, node, config) {
                            add_member();
                        }
                    }, {
                        text: 'Import Members <span class="fa fa-file-excel-o"></span>',
                        action: function (e, dt, node, config) {
                            import_members();
                        }
                    },
                    {
                        text: 'Filter Data <span class="fa fa-filter"></span>',
                        action: function (e, dt, node, config) {
                           filter_data();
                        }
                    }
                ],
            });
        });

        function otherSelect(){
            if (document.forms[0].marital_status.options[document.forms[0].marital_status.selectedIndex].value == "Married"){
                $("#married_in_church").removeClass('hidden')
            } else{
                $("#married_in_church").addClass('hidden')
            }
        }

        $("#filter_form").on('submit', function(event) {
            event.preventDefault()
            $('#modal_filter').modal('hide');
            let url= "{{ route('list-members') }}"
            let table = $('#table').DataTable();
            url+="?"+$("#filter_form").serialize()
            // table.destroy();
            table.ajax.url(url).load()
        });


        function add_member() {
            $('#modal_form').modal('show'); // show bootstrap modal
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('.modal-title').text('New Member Registration'); // Set Title to Bootstrap modal title
        }

        $("#member_import_form").on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                dataType: "JSON",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (data, status) {
                    if (data.status === 200) {
                        $('#modal_import').modal('hide');
                        reload_table();
                        swal({
                            text: "Members imported successfully!",
                            icon: "success",
                        });
                    }
                },
                error: function (xhr, desc, err) {
                    swal({
                        text: 'Whoops! Something went wrong',
                        icon: 'error'
                    })

                }
            });
        });

        function filter_data(){
            $('#modal_filter').modal('show');
        }

        function import_members() {
            $('#modal_import').modal('show');
        }

        function edit_member(id) {
            save_method = 'update';
            $('#form')[0].reset(); // reset form on modals

            //Ajax Load data from ajax
            $.ajax({
                url: "members/" + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {

                    $('[name="id"]').val(data[0].id);
                    $('[name="name"]').val(data[0].name);
                    $('[name="national_id"]').val(data[0].national_id);
                    $('[name="phone_number"]').val(data[0].phone_number);
                    $('[name="gender"]').val(data[0].gender);
                    $('[name="email"]').val(data[0].email);
                    $('[name="marital_status"]').val(data[0].marital_status);
                    $('[name="married_in_church"]').val(data[0].married_in_church);
                    $('[name="baptized"]').val(data[0].baptized);
                    $('[name="confirmed"]').val(data[0].confirmed);
                    $('[name="residence_zone"]').val(data[0].residence_zone);
                    $('[name="status"]').val(data[0].status);


                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Member Details'); // Set title to Bootstrap modal title

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
            var url;
            if (save_method == 'add') {
                url = "members";
                t = "POST";
            } else {
                var id = document.getElementById('id').value;
                url = "members/" + id;
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
                    $('#modal_form').modal('hide');
                    swal({
                        title: "Success",
                        text: "Member details have been Added/Updated successfully.",
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
                                text: "Member has been Deleted.",
                                timer: 1000,
                                type: "success",
                                showConfirmButton: false
                            });
                            reload_table();
                        },
                    });
                });
        }

        function groups(id) {
            var url = '{{ url('get-groups') }}';

            user_id = id;
            $('#member_groups').dataTable().fnDestroy();
            rolestable = $('#member_groups').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                paging: false,
                bInfo: false,
                ajax: url + '/' + user_id,
                columns: [{
                    data: "groupname"
                }]
            });
            $('.modal-title').text('Available Groups');
            $('[name="user_id"]').val(user_id);
            $('#savebutton').show();
            $('#ourgroups').modal('show'); // show bootstrap modal when complete loaded

        }

        function saveGroups() {
            var modulesdata = $('#myForm [type="checkbox"]:checked').map(function () {
                return this.value;
            }).get();
            console.log(modulesdata)
            if (modulesdata == '') {
                modulesdata = 0;
            }


            method = "GET";
            $(':input[type="button"]').prop('disabled', true);


            // ajax adding data to database
            $.ajax({
                url: '{{ url('save-groups') }}/' + modulesdata + '/' + user_id,
                type: method,
                dataType: "JSON",
                success: function (data) {
                    reload_table();
                    //if success close modal and reload ajax table
                    $('#ourgroups').modal('hide');
                    swal({
                        title: "Success",
                        text: "Groups Have Been Saved.",
                        timer: 2500,
                        type: "success",
                        showConfirmButton: false
                    });
                    $(':input[type="button"]').prop('disabled', false);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $(':input[type="button"]').prop('disabled', false);
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
    </script>
@endsection