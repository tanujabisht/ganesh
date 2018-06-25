<section class="content">
    <div class="row">	
      <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
             <?php if(isset($edit)){?>
             	<h3 class="box-title">Edit Admin</h3>
             <?php } else {?>
		        <h3 class="box-title">Add Admin</h3>
		     <?php }?>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <?= $this->Form->create($clinics,['type'=>'post']);?>
                    <label for="name">Name </label><span class="red">*</span>
                    <?= $this->Form->input('name', ['class' => 'form-control','required'=>'required','label'=>false]); ?>
                </div>
						    <div class="form-group">
                    <label for="phone">Contact Number </label><span class="red">*</span>
                    <?= $this->Form->input('phone', ['class' => 'form-control','required'=>true,'label'=>false]);?>
										<span id='usererr' class='red'></span>
                </div>
                <div class="form-group">
                    <label for="phone">Password </label><span class="red">*</span>
                    <?= $this->Form->input('password', ['class' => 'form-control','required'=>true,'label'=>false,'value'=>base64_decode($clinics->password2)]);?>
										<span id='usererr' class='red'></span>
                </div>
               </div>
               <div class="box-footer">
                 <label>
                  <?php if(isset($edit)){?>
                  <?php echo $this->Form->submit('Edit Admin',array('class' => 'btn btn-primary', 'id' => 'submit','onclick'=>'return validate();')); ?>
                 <?php } else {?> 
                  <?php echo $this->Form->submit('Add admin',array('class' => 'btn btn-primary', 'id' => 'submit','onclick'=>'return validate();')); ?>
                  <?php }?>
                 </label>
               </div>
         </div>
	</div>
			<?php $status=array('0'=>'Pending','1'=>'Approved');?>
			
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-body">
				
			   <div class="form-group">
              <label for="status">Status </label>
              <?= $this->Form->input('status', ['class' => 'form-control','type'=>'select','options'=>$status,'label'=>false]);?>
				</div>
               <?php if(isset($edit)){?>
						<div class="form-group">
              <label for="created">Created At </label>
              <?= $this->Form->text('created', ['class' => 'form-control','disabled'=>true,'label'=>false]);?>
						</div>
						<div class="form-group">
              <label for="created">Last Modified </label>
              <?= $this->Form->text('modified', ['class' => 'form-control','disabled'=>true,'label'=>false]);?>
						</div>
							<?php }?>
					</div>
				</div>
			</div>
		
		
</div>
</section>

