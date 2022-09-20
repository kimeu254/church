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
					<h4 class="pull-left page-title"></h4>
					<button class="btn btn-success pull-right" onclick="add_schedule()"><i class="glyphicon glyphicon-plus"></i> Add Schedule</button>
				</div>
			</div>

			<table id="table" class="table table-striped table-hover table-condensed">
				<thead class="thead-default">
					<tr>
                        <th>Service Name</th>
						<th>DESCRIPTION</th>
						<th>START TIME</th>
                        <th>END TIME</th>
                        <th>MAX MEMBERS</th>
                        <th>STATUS</th>
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
				<h3 class="modal-title">Manage Schedule</h3>
			</div>
			<div class="modal-body form">
				<form action="#" id="form" class="form-horizontal">
          {{ csrf_field() }}
                    <input type="hidden" value="" id="id" name="id"/>
                    <input type="hidden" value="{{Auth::id()}}" id="addedby" name="addedby"/>
                    <input type="hidden" value="{{Auth::id()}}" id="church_id" name="church_id"/>
					<div class="form-body">
                        <div class="form-group row">
                            <label class="control-label col-md-3">Service Name</label>
                            <div class="col-md-9">
                                <input name="name" placeholder="Service Name" class="form-control" type="text">
                            </div>
                        </div>
						<div class="form-group row">
							<label class="control-label col-md-3">Description</label>
							<div class="col-md-9">
								<input name="description" placeholder="Description" class="form-control" type="text">
							</div>
						</div>
                            <div class="form-group row">
                            <label class="control-label col-md-3">Start Time</label>
                            <div class="col-md-9">
                               <input name="start_time" placeholder="Start Time" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">End Time</label>
                            <div class="col-md-9">
                                <input name="end_time" placeholder="End Time" class="form-control" type="text">
                            </div>
                            </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Maximum Members</label>
                            <div class="col-md-9">
                                <input name="maxmembers" placeholder="Maximum Members" class="form-control" type="text">
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
            ajax: '{{ route('list-schedules') }}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                { data: 'start_time', name: 'start_time' },
                { data: 'end_time', name: 'end_time' },
                { data: 'maxmembers', name: 'maxmembers' },
                { data: 'status', name: 'status' },
              { data: "action" }
            ]
        });
    });

    function add_schedule()
    {
    	save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('New Schedule'); // Set Title to Bootstrap modal title
  }

  function edit_schedule(id)
  {
  	save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
      	url : "schedules/" + id,
      	type: "GET",
      	dataType: "JSON",
      	success: function(data)
      	{

      		$('[name="id"]').val(data[0].id);
            $('[name="name"]').val(data[0].name);
      		$('[name="start_time"]').val(data[0].start_time);
            $('[name="end_time"]').val(data[0].end_time);
      		$('[name="description"]').val(data[0].description);
            $('[name="status"]').val(data[0].status);


            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Schedule'); // Set title to Bootstrap modal title

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
  		url = "schedules";
      t = "POST";
  	}
  	else
  	{
      var id = document.getElementById('id').value;
  		url = "schedules/" + id;
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
                 text: "Schedule has been Added/Updated successfully.",
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


 
</script>
@endsection