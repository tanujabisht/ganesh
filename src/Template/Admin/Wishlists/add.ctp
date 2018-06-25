<section class="content">
    <div class="row">
         <?= $this->Form->create($clinics,['type'=>'post','enctype'=>'multipart/form-data']);?>
      <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
             <?php if(isset($edit)){?>
             	<h3 class="box-title">Edit Wishlist</h3>
             <?php } else {?>
		        <h3 class="box-title">Add Wishlist</h3>
		     <?php }?>
            </div>
            <div class="box-body">
               
                <div class="form-group">                   
                    <label for="name">Video Name</label><span class="red">*</span>
                    <?= $this->Form->input('name', ['class' => 'form-control','required'=>'required','label'=>false]); ?>
                </div>
                
               </div>
             <div class="form-group">
                    <label for="status">Thumb nail </label>
                    <div id='img_preview'>
                        <?php
                         if(!empty($img))
                            echo $this->Html->image('data/'.$img,array('id'=>'preview'));
                            else
                            echo $this->Html->image('data/noimage.png',array('id'=>'preview'));?>
                    </div>
                    <?= $this->Form->input('thumb', array('type'=>'file','onchange'=>'PreviewImage("thumb","preview")','label'=>false));?>
				</div>
               <div class="box-footer">
                 <label>
                  <?php if(isset($edit)){?>
                  <?php echo $this->Form->submit('Edit Wishlist',array('class' => 'btn btn-primary', 'id' => 'submit')); ?>
                 <?php } else {?> 
                  <?php echo $this->Form->submit('Add Wishlist',array('class' => 'btn btn-primary', 'id' => 'submit')); ?>
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
                            <label for="name">Description</label><span class="red">*</span>
                            <?= $this->Form->textarea('description', ['class' => 'form-control','required'=>'required','label'=>false]); ?>
                        </div>
                        <div class="form-group">
                             <label for="status">Status </label>
                             <?= $this->Form->input('status', ['class' => 'form-control','type'=>'select','options'=>$status,'label'=>false]);?>
                         </div>            
					</div>
				</div>
			</div>
		
		 <?= $this->Form->end();?>
</div>
</section>
<script>
    function PreviewImage(str,str1){
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById(str).files[0]);
            oFReader.onload = function (oFREvent) {
                document.getElementById(str1).src = oFREvent.target.result;
                };
    }
</script>
<style>
    #preview {
    width: auto;
    height: 200px;
}
</style>