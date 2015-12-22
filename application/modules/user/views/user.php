<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      User Lists
      <small>list of user</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-book"></i> User Lists</a></li>
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
          <button type="button" class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#add-user"><i class="fa fa-plus-circle"></i> Add User</button> <br><br>

          <div class="table-responsive">
            <table id="table_user" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Id</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data['user'] as $k => $v) { ?>
                <tr>          
                  <td><?php echo $v->user_id;?></td>
                  <td><?php echo $v->firstname;?></td>
                  <td><?php echo $v->lastname;?></td>
                  <td><?php echo $v->email;?></td>
                  <td><?php echo $v->role;?></td>
                  <td>
                    <button type="button" class="edit_user btn btn-info btn-flat btn-sm" data-id="<?php echo $v->user_id;?>"><i class="fa fa-pencil"></i> Edit</button>
                    <button type="button" class="delete_user btn btn-danger btn-flat btn-sm" data-id="<?php echo $v->user_id;?>"><i class="fa fa-trash"></i> Delete</button>
                  </td>
                </tr>
              <?php  }  ?>   
            </tbody>
            <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Email</th>
                  <th>Role</th>
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