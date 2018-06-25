<div class="login-box-body">
    <?=  $this->Form->create('Admins');?>
    <div class="form-group has-feedback">
      <?= $this->Form->input('phone', array('id'=>'phone','class' => 'form-control','placeholder'=>'Contact Number','div'=>false,'label'=>false,'required'=>true)); ?>
	  <i class="fa fa-envelope form-control-feedback" aria-hidden="true"></i>
    </div>
    <div class="form-group has-feedback">  
      <?= $this->Form->password('password', array('id'=>'password','class' => 'form-control','placeholder'=>'Password','required'=>true)); ?>
	  <i class="fa fa-key form-control-feedback" aria-hidden="true"></i>
    </div>
    <div class="row">
       <div class="col-xs-12">  
          <?= $this->Form->button('Sign In', array('div' => false,'class' => 'btn btn-primary btn-block btn-flat','type'=>'submit'));?>
       </div>
    </div>
    <?= $this->Form->end();?>
	<br>
    
  </div>