<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
                  <div class="pull-left image">
        <img src="<?php echo base_url('assets/img/avatar5.png');?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php 
        if (isset($user_role)) {
          echo ucfirst($user_role);
        } else {
          echo "Guest";
        }
        
        ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Offline</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li><a href="<?php echo base_url('web');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>