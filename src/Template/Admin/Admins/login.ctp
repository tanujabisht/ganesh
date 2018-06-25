<div class="login-box">
  <?php echo $this->Flash->render();?>
  <div class="login-logo">		
		    <?= $this->Html->image('logo.png');?>
  </div>
	<?= $this->element('login_form'); ?>
</div>
