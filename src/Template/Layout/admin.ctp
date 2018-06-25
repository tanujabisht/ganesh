<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	
    	<title>
            <?= SITE_NAME ?>
            
        </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <?=	 $this->Html->meta('fav.png','img/fav.jpg',array('type' => 'icon')); ?>
	<?= $this->Html->css('docs.min'); ?>
    <?= $this->Html->css('style.css'); ?>
    <?= $this->Html->css('bootstrap/css/bootstrap.min.css'); ?>
    <?= $this->Html->css('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'); ?>
    <?= $this->Html->css('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css');  ?>
    <?= $this->Html->css('dist/css/AdminLTE.min.css'); ?>
    <?= $this->Html->css('dist/css/skins/_all-skins.min.css'); ?>
	<?= $this->Html->script("plugins/jQuery/jquery-2.2.3.min.js"); ?>
    <?= $this->Html->script("ckeditor/ckeditor.js"); ?>
		<!--<script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>-->
		
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
			
        <?= $this->element('admin_header'); ?>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <?php  if($this->request->session()->read('Auth.User.type')=='A'){?>
         <?= $this->element('sidenave'); ?>
         <?php }else{
              echo $this->element('sidenaveclinic');
            } ?>
				
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <?php if(!isset($no)){?>
        <section class="content-header">
         <h1>
           
           <?= $section;?>
           <small> <?= $sub_section;?></small>
         </h1>
        </section>
		<?php } ?>
        <?= $this->fetch('content') ?>
       
      </div><!-- /.content-wrapper -->
      <footer class="main-footer" id="footer">
        <strong>Copyright ©  . All Rights Reserved.</strong>
      </footer>
            <!--</form>-->
          
    </div><!-- ./wrapper -->

<script type = 'text/javascript' src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <?= $this->Html->script('dist/js/app.min.js'); ?>
	<?=  $this->Html->script('jquery-ui.min.js'); ?>
	<?=  $this->Html->script('common'); ?>

<script>
    	 $(function () {
			        $(".date").datepicker({dateFormat: 'yy-mm-dd'});
						   });
</script>
  </body>
</html>