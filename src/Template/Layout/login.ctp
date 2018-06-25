<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= SITE_NAME ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
   
    <?php
		echo $this->Html->meta('fav.png','img/fav.png',array('type' => 'icon'));
        echo $this->Html->css('docs.min');
       echo $this->Html->css('style1.css');
        echo $this->Html->css('bootstrap/css/bootstrap.min.css');
        echo $this->Html->css('dist/css/AdminLTE.min.css');
		 echo $this->Html->script('plugins/jQuery/jquery-2.2.3.min');
		 echo $this->Html->script('common.js');
    ?>
    
  <style>
		.btn-primary {
background-color:#412d61 !important;
border-color: #412d61 !important;
/*border-radius: 50px !important;*/
padding: 10px 0;
color: #fff !important;
font-weight: 700;
letter-spacing: 0.03em;
text-transform: uppercase;
}
		.message{
    background-repeat: repeat-x;
	background-image: -moz-linear-gradient(top, #ee5f5b, #c43c35);
	background-image: -ms-linear-gradient(top, #ee5f5b, #c43c35);
	background-image: -webkit-gradient(linear, left top, left bottom, from(#ee5f5b), to(#c43c35));
	background-image: -webkit-linear-gradient(top, #ee5f5b, #c43c35);
	background-image: -o-linear-gradient(top, #ee5f5b, #c43c35);
	background-image: linear-gradient(top, #ee5f5b, #c43c35);
    border: 1px solid rgba(0, 0, 0, 0.5);
    clear: both;
    color: #fff;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.3);
    padding: 7px 14px;
    border-radius: 4px;
    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.25) inset;
    font-size: 105%;
    font-weight: bold;
	margin-bottom: 2%;
}
.login-logo > a >img {
   width: 60% !important;
margin-bottom: 10px;
margin-top: 10px;
}
.login-logo >img {
max-width: 70%;
}
.login-logo, .register-logo {
    font-size: 35px;
    text-align: center;
    margin-bottom: 0px !important;
    font-weight: 300;
		background: #cdb7f3;
        padding-top: 0px;
      
}
.login-page, .register-page {
    background:url("..../../img/bg.jpg") !important;
    background-size: 100% !important;
    background-position: center 40% !important;
    
   }
   .login-box, .register-box {
    width: 360px;
    margin: 10% auto !important;
}
	</style>
  </head>
  <body class="hold-transition login-page">
      <?= $this->fetch('content') ?>
  </body>
</html>
