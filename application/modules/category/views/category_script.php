<script type="text/javascript">
	$(document ).ready(function() {
		$('#table_category').DataTable({
			'order' : [[0,'asc']]
		});
	});  
</script>

<div class="modal fade" id="add-category" tabindex="-1" role="dialog" aria-labelledby="Add Category" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="modal-title">Add Category</h4>
	  </div>
	  <div class="modal-body">
		<form name="formCategory" id="formCategory" class="form-horizontal" method="POST" action="#">
		  <input type="hidden" name="type" id="type" value="add" >
		  <input type="hidden" name="category_id" id="category_id" value="" >
		  <div class="box-body">
			<div class="form-group">
			  <label for="category_name" class="col-sm-2 control-label">Name</label>
			  <div class="col-sm-10">
				<input type="text" class="form-control" name="category_name" id="category_name" placeholder="Name" required>
			  </div>
			</div>
		  </div><!-- /.box-body -->
		  <div class="box-footer">
			<button type="submit" id="cancel" class="btn btn-default btn-flat" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-primary btn-flat pull-right">Save</button>
		  </div><!-- /.box-footer -->
		</form>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
$(document).ready(function() {
  var url_category = "<?php echo base_url('category/add');?>";
  $("#formCategory").submit(function(event) {
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
      url_category = "<?php echo base_url('category/edit');?>";
    }
    $.ajax({
      type: 'POST',
      url: url_category,
      data: $(this).serialize(),
      dataType: 'json',
      encode: true
    }).done(function(data) {
      console.log(data);
      if (data.status == true) {
        alert(data.message);
        window.location.reload(true);
        $('#add-category').modal('hide');
      } else {
        alert(data.message);
      }
    });
    event.preventDefault();
  });

  $('#table_category tbody').on('click', '.edit_category', function() {
    $("#modal-title").html('Edit Category');
    $("#password").removeAttr('required');
    $("#add-category").modal('show');
    var category_id = $(this).data("id");
    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?php echo base_url('category/detail');?>",
      data: {
        category_id: category_id
      },
      success: function(data, textStatus, jqXHR) {
        if (data.status == true) {
          renderEditCategory(data.message);
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

$('#table_category tbody').on('click', '.delete_category', function() {
    var category_id = $(this).data("id");
    if (confirm("Are you sure?")) {
      $.ajax({
        type: 'POST',
        dataType: "json",
        url: "<?php echo base_url('category/delete');?>",
        data: {
          category_id: category_id
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

function refresh() {
  $("#note_edit").html(null);
  $("#modal-title").html('Add Category');
  $('#category_id').val(null);
  $('#type').val("add");
  $('#category_name').val(null);
}

$(document)
  .off('click', '#close')
  .on('click', '#close', function() {
      refresh();
  });
  $(document)
  .off('click', '#cancel')
  .on('click', '#cancel', function() {
      refresh();
  });

function renderEditCategory(category) {
  $('#category_id').val(category[0].category_id);
  $('#type').val("edit");
  $('#category_name').val(category[0].category_name);
}
</script>