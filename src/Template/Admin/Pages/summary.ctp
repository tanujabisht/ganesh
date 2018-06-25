<section class="content">
<div class="row">
   <div class="col-xs-12 ">
      <?php echo $this->Flash->render();?>
      <div class="box">
         <div class="box-header">
            <h3 class="box-title">Pages Summary</h3>
         </div>  
         <div class="box-body table-responsive no-padding">
           <table class="table table-bordered">
                <tr class="bg-primary">
                    <th>S.no.</th>
                    <th>Title</th>
					<th  class="hidenwforprint">Status</th>
                    <th class="hidenwforprint">Edit</th>
                    <!--<th align="center" class="hidenwforprint">Delete</th>-->
                </tr>
					 <?php if(!empty($clinics)){
                        $i=1;?>
                <?php foreach ($clinics as $user): ?>
				
					 <tr class="table-hover bg-success">
					
                    <td><?= $i;?></td>
                    <td><?= $user->title;?></td>
				    <td  class="hidenwforprint"><?php if($user->status == 1){
					   echo $this->Form->postLink('<span class="label label-success">Approved</span>', array('action'=>'changestatus', $user->id), array('escape' => false)); 
					}else{
					   echo $this->Form->postLink('<span class="label label-warning">Pending</span>', array('action'=>'changestatus', $user->id), array('escape' => false));
					}?>
				</td>
                    <td class="hidenwforprint"><?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action'=>'add', $user->id), array('escape' => false)); ?></td>
                </tr>
                <?php $i++; endforeach; }else{ ?>
					 <tr><td colspan='5'>No Record Found.</td></tr>
					 <?php }?>
        </table>
       </div>
       <!-- Box Body --> 
         <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
              <li>
               <?= $this->Paginator->prev('<span aria-hidden="true">&laquo;</span> ',['escape'=>false]) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next('<span aria-hidden="true">&raquo;</span> ',['escape'=>false]) ?>
              </li>
           </ul> 
         </div>
         <!-- Box Footer -->  
      </div>
      <!-- Box -->
   </div>
</div>

      
</section>
