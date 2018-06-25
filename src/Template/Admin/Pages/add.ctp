<section class="content">
    <div class="row">
         <?= $this->Form->create($clinics,['type'=>'post','enctype'=>'multipart/form-data']);?>
      <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
             <?php if(isset($edit)){?>
             	<h3 class="box-title">Edit Page</h3>
             <?php } else {?>
		        <h3 class="box-title">Add Page</h3>
		     <?php }?>
            </div>
            <div class="box-body">
                <div class="form-group">
                   
                    <label for="name">Title</label><span class="red">*</span>
                    <?= $this->Form->input('title', ['class' => 'form-control','required'=>'required','label'=>false]); ?>
                </div>
                <?php $status=array('0'=>'Pending','1'=>'Approved');?>
				 <div class="form-group">
                    <label for="status">Status </label>
                    <?= $this->Form->input('status', ['class' => 'form-control','type'=>'select','options'=>$status,'label'=>false]);?>
				</div>
                 <?php $type=array('term'=>'Terms & Conditions','about'=>'About us','privacy'=>'Privacy Policy','help'=>'Help');?>
                  <div class="form-group">
                    <label for="status">Type </label>
                    <?= $this->Form->input('type', ['class' => 'form-control','type'=>'select','options'=>$type,'label'=>false]);?>
				</div>
               </div>
               <div class="box-footer">
                 <label>
                  <?php if(isset($edit)){?>
                  <?php echo $this->Form->submit('Edit Page',array('class' => 'btn btn-primary', 'id' => 'submit')); ?>
                 <?php } else {?> 
                  <?php echo $this->Form->submit('Add Page',array('class' => 'btn btn-primary', 'id' => 'submit')); ?>
                  <?php }?>
                 </label>
               </div>
         </div>
	</div>
			
			
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-body">
				
			        <div class="form-group">
                    <label for="status">Content </label>
                    <?= $this->Form->input('content', ['class' => 'form-control ckeditor','type'=>'textarea','label'=>false]);?>
				   </div>
             
					</div>
				</div>
			</div>
		
		 <?= $this->Form->end();?>
</div>
</section>
