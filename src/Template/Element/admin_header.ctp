<a href="#" class="logo">        
          <span class="logo-mini"><b>GF</b></span>         
          <span class="logo-lg">
            <?php echo $this->Html->image('logo1.png', array('alt' => 'Ganesh Films','id'=>'admin_logo'));?>
          </span>
        </a>
		
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
		  
          <div class="navbar-custom-menu">
       
              <!-- User Account: style can be found in dropdown.less -->
            <ul class="nav navbar-nav"> 
			<li class="dropdown user user-menu">			
			<div id="txt1"><?php echo date('d-m-Y'); ?></div>
			</li>
			<li class="dropdown user user-menu">			
			<div id="txt"></div>
			</li>
            <li class="dropdown user user-menu">
	  <li class="logout">
		<?php echo $this->Html->link('Sign Out',array('controller'=>'admins','action'=>'logout'),array('class'=>'btn btn-default btn-flat'));?>
	  </li>
                  
                
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                

                <p>
                  
                </p>
              </li>
              
              <!-- Menu Footer-->
              
            </ul>
          </li>
					</ul>
				</div>
      </nav>
  
  <!--Driver notification popup-->
        
<script type="text/javascript">
startTime();
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

</script>
<style>
div#txt,div#txt1  {
    font-size: 22px;
vertical-align: middle;
color: #FFF;
padding: 25px 15px;

}
</style>
