<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Books Lists
      <small>Last best book list</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-book"></i> Book Lists</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <!-- <h3 class="box-title">Title</h3>
           <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
          </div> -->
        </div>
        <div class="box-body">
          <button id="add" type="button" class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#add-book"><i class="fa fa-plus-circle"></i> Add Book</button> <br><br>

          <div class="table-responsive">
            <table id="table_book" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Book Code</th>
                <th>Title</th>
                <th>Category</th>
                <th>Publisher</th>
                <th>Author</th>
                <th>Publication_year</th>
                <th>Stock</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data['book'] as $k => $v) { ?>
                <tr>          
                  <td><?php echo $v->book_code;?></td>
                  <td><?php echo $v->title;?></td>
                  <td><?php echo $v->category_name;?></td>
                  <td><?php echo $v->publisher;?></td>
                  <td><?php echo $v->author;?></td>
                  <td><?php echo $v->publication_year;?></td>
                  <td><?php echo $v->stock;?></td>
                  <td>
                    <button type="button" class="edit_book btn btn-info btn-flat btn-sm" data-id="<?php echo $v->book_id;?>"><i class="fa fa-pencil"></i> Edit</button>
                    <button type="button" class="delete_book btn btn-danger btn-flat btn-sm" data-id="<?php echo $v->book_id;?>"><i class="fa fa-trash"></i> Delete</button>
                  </td>
                </tr>
              <?php  }  ?>   
            </tbody>
            <tfoot>
                <tr>
                  <th>Book Code</th>
                  <th>Title</th>
                  <th>Category</th>
                  <th>Publisher</th>
                  <th>Author</th>
                  <th>Publication_year</th>
                  <th>Stock</th>
                  <th>Action</th>
                </tr>
            </tfoot>
            </table>
          </div><!-- /.table-responsive -->
        </div><!-- /.box-body -->
        <div class="box-footer">
          
        </div><!-- /.box-footer-->
      </div><!-- /.box -->
    
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->