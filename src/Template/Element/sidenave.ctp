
        <section class="sidebar">
          <div class="user-panel">
            <div class="pull-left image">
              <?php echo $this->Html->image('user.png', array('alt' => 'user image'));?>
            </div>
            <div class="pull-left info">
              <p></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <ul class="sidebar-menu">
           <li class="header">MAIN NAVIGATION</li>
          <li class="treeview">
          <?php echo $this->Html->link(__('<i class="fa fa-dashboard"></i><span>Dashboard</span>', true), array('controller'=> 'admins','action'=>'dashboard'),array('id'=>'asummary','escape'=>false));?>
          </li>
	  
		<li class="treeview" id='report'>
              <a href="#">
                <i class="fa fa-bar-chart"></i>
                <span>Admin Manager</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" id='Repotmenu'>
		        <li><?php echo $this->Html->link(__('Admin Summary', true), array('controller'=> 'admins','action'=>'adminsummary'),array('id'=>'asummary'));?></li>
                <li><?php echo $this->Html->link(__('Add Admin', true), array('controller'=> 'admins','action'=>'adminadd'),array('id'=>'aadd'));?></li>
              </ul>
            </li>
        <li><?php echo $this->Html->link(__('<i class="fa fa-dashboard"></i><span>  Users Summary</span>', true), array('controller'=> 'users','action'=>'summary'),array('id'=>'aadd','escape'=>false));?></li>
         <li class="treeview" id='report'>
              <a href="#">
                <i class="fa fa-bar-chart"></i>
                <span>Category Manager</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" id='Repotmenu'>
		        <li><?php echo $this->Html->link(__('Category Summary', true), array('controller'=> 'cats','action'=>'summary'),array('id'=>'asummary'));?></li>
                <li><?php echo $this->Html->link(__('Add Category', true), array('controller'=> 'cats','action'=>'add'),array('id'=>'aadd'));?></li>
              </ul>
            </li>
         <li class="treeview" id='report'>
              <a href="#">
                <i class="fa fa-bar-chart"></i>
                <span>Videos Manager</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" id='Repotmenu'>
		        <li><?php echo $this->Html->link(__('Videos Summary', true), array('controller'=> 'vedios','action'=>'summary'),array('id'=>'asummary'));?></li>
                <li><?php echo $this->Html->link(__('Add Videos', true), array('controller'=> 'vedios','action'=>'add'),array('id'=>'aadd'));?></li>
              </ul>
            </li>
            <li class="treeview" id='report'>
              <a href="#">
                <i class="fa fa-bar-chart"></i>
                <span>Pages Manager</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" id='Repotmenu'>
		        <li><?php echo $this->Html->link(__('Pages Summary', true), array('controller'=> 'pages','action'=>'summary'),array('id'=>'asummary'));?></li>
                <!--<li><?php //echo $this->Html->link(__('Add Pages', true), array('controller'=> 'pages','action'=>'add'),array('id'=>'aadd'));?></li>-->
              </ul>
            </li>
            <li class="treeview" id='report'>
              <a href="#">
                <i class="fa fa-bar-chart"></i>
                <span>Wishlist Manager</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" id='Repotmenu'>
		        <li><?php echo $this->Html->link(__('Wishlist Summary', true), array('controller'=> 'wishlists','action'=>'summary'),array('id'=>'asummary'));?></li>
                <li><?php echo $this->Html->link(__('User Requested Wishlist', true), array('controller'=> 'wishlists','action'=>'request'),array('id'=>'aadd'));?></li>
              </ul>
            </li>
            <li><?php echo $this->Html->link(__('<i class="fa fa-dashboard"></i><span>  Feedback Summary</span>', true), array('controller'=> 'wishlists','action'=>'feedbacksummary'),array('id'=>'aadd','escape'=>false));?></li>
          </ul>
        </section>
        <!-- /.sidebar -->
     