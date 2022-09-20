@extends('layouts.app')

@section('content')


<div class="row">
	<div class="col-sm-12">
		<div class="card-box table-responsive">
	

			<table id="table" class="table table-striped table-hover table-condensed" cellspacing="0" width="100%">
				<thead class="thead-default" style="text-transform: uppercase;">
					<tr>
                        <th>ID</th>
                        <th>MESSAGE TYPE</th>
						            <th>MESSAGE CONTENT</th>
                        <th>ADDED BY</th>
                        <th>DATE CREATED</th>
                        <th>SCHEDULED</th>
                        <th>SENT</th>
                        <th>FAILED</th>
						            <th>STATUS</th>
						<th style="width:200px;">ACTIONS</th>
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
				<h3 class="modal-title">MESSAGE DETAILS</h3>
			</div>
			<div class="modal-body form">
				<form action="#" id="form" class="form-horizontal">
					{{ csrf_field() }}
          <input type="hidden" value="" id="id" name="id"/>
        <input type="hidden" value="{{Auth::user()->id}}" id="id" name="added_by"/>
        <input type="hidden" value="{{ Auth::user()->church_id }}" id="church_id" name="church_id" />
					<div class="form-body">
                        <div class="form-group row">
							<label class="control-label col-md-3">Message Type</label>
							<div class="col-md-9">
								<select name="message_type" class="form-control">
									<option value="Notification">Notification</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-md-3">Message Content</label>
							<div class="col-md-9">
								<textarea name="message_content" placeholder="Enter Message 240 Characters" class="form-control">
								</textarea>
							</div>
						</div>
              <div class="form-group row">
                <label class="control-label col-md-3">Status</label>
                <div class="col-md-9">
                  <select name="status" class="form-control">
                    <option value="New Message">New Message</option>
                    <option value="Scheduled">Scheduled</option>
                    <option value="Cancelled">Cancelled</option>
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
        <h3 class="modal-title">Prepare Users</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="usersform" class="form-horizontal">
					{{ csrf_field() }}
          <input type="hidden" value="" id="id" name="id"/>
          <input type="hidden" value="" id="actionoption" name="actionoption"/>
          <input type="hidden" value="" id="message_id" name="message_id"/>
        <input type="hidden" value="{{Auth::user()->id}}" id="id" name="added_by"/>
        <input type="hidden" value="{{ Auth::user()->church_id }}" id="church_id" name="church_id" />
					<div class="form-body">

            <div class="form-group row">
              <label class="control-label col-md-3">Send to</label>
							<div class="col-md-9">
              <label class="c-input c-radio">
                  <input value="individual" name="usersoption" type="radio">
                  <span class="c-indicator"></span>
                  Individuals
              </label>
              <label class="c-input c-radio">
                  <input value="groupusers" name="usersoption" type="radio">
                  <span class="c-indicator"></span>
                  Groups
              </label>
              <label class="c-input c-radio">
                <input value="all" name="usersoption" type="radio">
                <span class="c-indicator"></span>
                All Users
            </label>
          </div>
        </div>

            <div class="form-group row individual" style="display:none;">
							<label class="control-label col-md-3">Select User/s</label>
							<div class="col-md-9">
								<select style="width:100%" name="users[]" multiple="multiple" class="form-control members">
                  @foreach($members as $key)
                  <option value="{{ $key->id }}">{{ $key->name }}</option>
                  @endforeach
								</select>
							</div>
            </div>
            <div class="groupusers" style="display:none;">
            <div class="form-group row">
							<label class="control-label col-md-3">Zonal Area</label>
							<div class="col-md-9">
								<select style="width:100%" name="zones[]" multiple="multiple" class="zonalareas form-control">
									@foreach($residentialareas as $key)
                  <option value="{{ $key->id }}">{{ $key->zone_name }}</option>
                  @endforeach
								</select>
							</div>
            </div>
            
            <div class="form-group row">
							<label class="control-label col-md-3">Select Group/s</label>
							<div class="col-md-9">
								<select style="width:100%" name="groups[]" multiple="multiple" class="membergroups form-control">
                  @foreach($member_groups as $key)
                  <option value="{{ $key->id }}">{{ $key->name }}</option>
                  @endforeach
								</select>
							</div>
            </div>
          </div>
          </div>
          <div style="display:none; font-weight:bold; text-align:center;" class="scheduledusers"></div>
				
        </form>
        

      </div>
      <div class="modal-footer">
        <button type="submit" id="savebutton" onclick="prepareUsers('check')" class="btn btn-primary"><span class="savebtn">Check Users</span></button>
        <button type="submit" id="savebutton" onclick="prepareUsers('prepare')" class="btn btn-primary"><span class="savebtn">Schedule Message</span></button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->

</div><!-- /.modal -->
<!-- End Bootstrap modal -->




</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<script type="text/javascript">

    var save_method; //for save method string
    var table;

    $(document).ready(function() {
      $('.members').select2();
      $('.zonalareas').select2();
      $('.membergroups').select2();


      $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        if(inputValue == 'individual'){
          $(".individual").show();
          $(".groupusers").hide();
        }else if(inputValue == 'groupusers'){
          $(".groupusers").show();
          $(".individual").hide();
        }else{
          $(".individual").hide();
          $(".groupusers").hide();
        }
  
    });

		    table = $('#table').DataTable({
		        processing: true,
		        serverSide: true,
		        dom: 'Bfrtip',
		        ajax: '{{ route('list-messages') }}',
		        columns: [
		            { data: 'id', name: 'id' },
		            { data: 'message_type', name: 'message_type' },
                    { data: 'message_content', name: 'message_content' },
                    { data: 'name', name: 'name' },
                { data: 'created_at', name: 'created_at' },
                { data: 'scheduled', name: 'scheduled' },
                { data: 'sent', name: 'sent' },
                { data: 'failed', name: 'failed' },
		            { data: 'status', name: 'status' },
	        		 { data: "action" }
		        ],
		        buttons: [
                     'pageLength', 'excel',
                      {
                text: 'NEW MESSAGE',
                action: function ( e, dt, node, config ) {
                    add_member();
                }
            }
                  ],
		    });
		});
    
    function add_member()
    {
      $('#modal_form').modal('show'); // show bootstrap modal
    	save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('.modal-title').text('CREATE NEW MESSAGE'); // Set Title to Bootstrap modal title
  }
  function edit_member(id)
  {
  	save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
      	url : "messaging/" + id,
      	type: "GET",
      	dataType: "JSON",
      	success: function(data)
      	{

      		$('[name="id"]').val(data[0].id);
          $('[name="message_content"]').val(data[0].message_content);
      		$('[name="message_type"]').val(data[0].message_type);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('EDIT MESSAGE'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
        	alert('Error get data from ajax');
        }
    });
  }


  function reload_table()
  {
      table.ajax.reload(null,false); //reload datatable ajax
  }

  function save()
  {
  	var url;
  	if(save_method == 'add')
  	{
  		url = "messaging";
      t = "POST";
  	}
  	else
  	{ 
      var id = document.getElementById('id').value;
  		url = "messaging/" + id;
      t = "PUT";
  	}
// alert($('#form').serialize());
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
               reload_table();
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
            swal({   title: "Success",   
               text: "Message has been Added/Updated successfully.",
               timer: 2500,
               type: "success",   
               showConfirmButton: false 
          }); 
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
           	// console.log(data);
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

   function delete_productcat(id)
   {
    swal({
      title: "Are you sure?",
      text: "Your will not be able to recover this Category!",
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
          url : "messaging/"+id,
          type: "DELETE",
          dataType: "JSON",
          success: function(data)
          {
              // swal("Deleted!", "Your imaginary file has been deleted.", "success");
              swal({   title: "Deleted",   
                   text: "Category has been Deleted.",   
                   timer: 2500,
                   type: "success",   
                   showConfirmButton: false 
              });
              reload_table();
           },
      });
    });
}


function groups(id)
{ 
  $('#usersform')[0].reset();
  var url = '{{ url('get-groups') }}';
  
      $('#member_groups').dataTable().fnDestroy();
      rolestable = $('#member_groups').DataTable({
      processing: true,
      serverSide: true,
      searching: false,
      paging: false,
      bInfo: false,
      ajax: url+'/' + id,
      columns: [
      { data: "groupname" }
      ]
    });
    $('.modal-title').text('SELECT RECEIPIENTS'); 
    $('[name="message_id"]').val(id);
    $('#savebutton').show();
    $('#ourgroups').modal('show'); // show bootstrap modal when complete loaded
               
  }

  function prepareUsers(option){
    $('[name="actionoption"]').val(option);
       $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        url: '{{ url('prepare-users') }}',
       	type: "GET",
       	data: $('#usersform').serialize(),
       	dataType: "JSON",
       	success: function(data)
       	{
           if(option == "check"){
             $('.scheduledusers').text(data+" USERS TO RECEIVE MESSAGE");
             $(".scheduledusers").show();
           }else{
               swal({   title: "Success",   
               text: "Message Has been Scheduled.",
               timer: 2500,
               type: "success",   
               showConfirmButton: false 
            }); 
            $('#ourgroups').modal('hide');
          }
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
           	// console.log(data);
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