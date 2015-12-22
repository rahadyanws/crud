<script type="text/javascript">
	$(document ).ready(function() {
		$('#table_user').DataTable({
			'order' : [[0,'asc']]
		});
	});  
</script>

<div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="Add User" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="modal-title">Add User</h4>
	  </div>
	  <div class="modal-body">
		<form name="formUser" id="formUser" class="form-horizontal" method="POST" action="#">
		  <input type="hidden" name="type" id="type" value="add" >
		  <input type="hidden" name="user_id" id="user_id" value="" >
		  <div class="box-body">
  			<div class="form-group">
  			  <label for="firstname" class="col-sm-2 control-label">Firstname</label>
  			  <div class="col-sm-10">
  				<input type="text" name="firstname" class="form-control" id="firstname" placeholder="Firstname" required>
  			  </div>
  			</div>
  			<div class="form-group">
  			  <label for="lastname" class="col-sm-2 control-label">Lastname</label>
  			  <div class="col-sm-10">
  				<input type="text" class="form-control" name="lastname" id="lastname" placeholder="Lastname" required>
  			  </div>
  			</div>
  			<div class="form-group">
  			  <label for="email" class="col-sm-2 control-label">Email</label>
  			  <div class="col-sm-10">
  				<input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
  			  </div>
  			</div>
  			<div class="form-group">
  			  <label for="password" class="col-sm-2 control-label">Password</label>
  			  <div class="col-sm-10">
  				<input type="text" class="form-control" name="password" id="password" placeholder="Password" required>
  			  <span id="note_edit"></span>
          </div>
  			</div>
  			<div class="form-group">
          <label for="role" class="col-sm-2 control-label">Role</label>
          <div class="col-sm-10">
            <select id="role" name="role" class="form-control" required>
            <option value="" >Select Role</option>
            <option value="administrator" >Administrator</option>
            <option value="operator" >Operator</option>
            </select>
          </div>
        </div>
		  </div><!-- /.box-body -->
		  <div class="box-footer">
			<button type="submit" class="btn btn-default btn-flat" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-primary btn-flat pull-right">Save</button>
		  </div><!-- /.box-footer -->
		</form>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
$(document).ready(function() {
  var url_user = "<?php echo base_url('user/add');?>";
  $("#formUser").submit(function(event) {
    $(document).ajaxStart(function() {
      $("input").prop('disabled', true);
      $("button").prop('disabled', true);
      $("select").prop('disabled', true);
    });
    $(document).ajaxStop(function() {
      $("input").prop('disabled', false);
      $("button").prop('disabled', false);
      $("select").prop('disabled', false);
    });
    $(document).ajaxError(function() {
      alert("failed");
      $("input").prop('disabled', false);
      $("button").prop('disabled', false);
      $("select").prop('disabled', false);
    });
    if ($("#type").val() == "edit") {
      url_user = "<?php echo base_url('user/edit');?>";
    }
    $.ajax({
      type: 'POST',
      url: url_user,
      data: $(this).serialize(),
      dataType: 'json',
      encode: true
    }).done(function(data) {
      console.log(data);
      if (data.status == true) {
        alert(data.message);
        window.location.reload(true);
        $('#add-user').modal('hide');
      } else {
        alert(data.message);
      }
    });
    event.preventDefault();
  });

  $('#table_user tbody').on('click', '.edit_user', function() {
    $("#note_edit").html('Leave blank if you dont want to change the password');
    $("#modal-title").html('Edit User');
    $("#password").removeAttr('required');
    $("#add-user").modal('show');
    var user_id = $(this).data("id");
    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?php echo base_url('user/detail');?>",
      data: {
        user_id: user_id
      },
      success: function(data, textStatus, jqXHR) {
        if (data.status == true) {
          renderEditUser(data.message);
        } else {
          alert(data.message);
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert("failed");
      }
    });
  });
});

$('#table_user tbody').on('click', '.delete_user', function() {
    var user_id = $(this).data("id");
    if (confirm("Are you sure?")) {
      $.ajax({
        type: 'POST',
        dataType: "json",
        url: "<?php echo base_url('user/delete');?>",
        data: {
          user_id: user_id
        },
        success: function(data, textStatus, jqXHR) {
          if (data.status == true) {
            alert(data.message);
            location.reload();
          } else {
            alert(data.message);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert("failed");
        }
      });
    }
  });

function renderEditUser(user) {
  $('#user_id').val(user[0].user_id);
  $('#type').val("edit");
  $('#firstname').val(user[0].firstname);
  $('#lastname').val(user[0].lastname);
  $('#email').val(user[0].email);
  $('#role').val(user[0].role);
}
</script>