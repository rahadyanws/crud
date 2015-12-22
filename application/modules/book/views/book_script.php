<script type="text/javascript">
	$(document ).ready(function() {
		$('#table_book').DataTable({
			'order' : [[4,'desc']]
		});
	});  
</script>

<div class="modal fade" id="add-book" tabindex="-1" role="dialog" aria-labelledby="Add Book" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="modal-title">Add Book</h4>
	  </div>
	  <div class="modal-body">
		<form name="formBook" id="formBook" class="form-horizontal" method="POST" action="#">
		  <input type="hidden" name="type" id="type" value="add" >
		  <input type="hidden" name="book_id" id="book_id" value="" >
		  <div class="box-body">
			<div class="form-group">
			  <label for="book_code" class="col-sm-2 control-label">Code</label>
			  <div class="col-sm-10">
				<input type="text" name="book_code" class="form-control" id="book_code" placeholder="Book Code" required>
			  </div>
			</div>
			<div class="form-group">
			  <label for="title" class="col-sm-2 control-label">Title</label>
			  <div class="col-sm-10">
				<input type="text" class="form-control" name="title" id="title" placeholder="Title" required>
			  </div>
			</div>
			<div class="form-group">
			  <label for="publisher" class="col-sm-2 control-label">Publisher</label>
			  <div class="col-sm-10">
				<input type="text" class="form-control" name="publisher" id="publisher" placeholder="Publisher" required>
			  </div>
			</div>
			<div class="form-group">
			  <label for="author" class="col-sm-2 control-label">Author</label>
			  <div class="col-sm-10">
				<input type="text" class="form-control" name="author" id="author" placeholder="Author" required>
			  </div>
			</div>
			<div class="form-group">
			  <label for="publication_year" class="col-sm-2 control-label">Publication</label>
			  <div class="col-sm-10">
				<input type="text" class="form-control" name="publication_year" id="publication_year" placeholder="Publication Year" required>
				<span id="note_edit"></span>
			  </div>
			</div>
			<div class="form-group">
			  <label for="stock" class="col-sm-2 control-label">Stock</label>
			  <div class="col-sm-10">
				<input type="text" class="form-control" name="stock" id="stock" placeholder="Stock" required>
				<span id="note_edit"></span>
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
  var url_book = "<?php echo base_url('book/add');?>";
  $("#formBook").submit(function(event) {
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
      url_book = "<?php echo base_url('book/edit');?>";
    }
    $.ajax({
      type: 'POST',
      url: url_book,
      data: $(this).serialize(),
      dataType: 'json',
      encode: true
    }).done(function(data) {
      console.log(data);
      if (data.status == true) {
        alert(data.message);
        window.location.reload(true);
        $('#add-book').modal('hide');
      } else {
        alert(data.message);
      }
    });
    event.preventDefault();
  });

  $('#table_book tbody').on('click', '.edit_book', function() {
    $("#modal-title").html('Edit User');
    $("#password").removeAttr('required');
    $("#add-book").modal('show');
    var book_id = $(this).data("id");
    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?php echo base_url('book/detail');?>",
      data: {
        book_id: book_id
      },
      success: function(data, textStatus, jqXHR) {
        if (data.status == true) {
          renderEditBook(data.message);
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

$('#table_book tbody').on('click', '.delete_book', function() {
    var book_id = $(this).data("id");
    if (confirm("Are you sure?")) {
      $.ajax({
        type: 'POST',
        dataType: "json",
        url: "<?php echo base_url('book/delete');?>",
        data: {
          book_id: book_id
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

function renderEditBook(book) {
  $('#book_id').val(book[0].book_id);
  $('#type').val("edit");
  $('#book_code').val(book[0].book_code);
  $('#title').val(book[0].title);
  $('#publisher').val(book[0].publisher);
  $('#author').val(book[0].author);
  $('#publication_year').val(book[0].publication_year);
  $('#stock').val(book[0].stock);
}
</script>