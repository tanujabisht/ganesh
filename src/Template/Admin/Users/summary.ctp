<section class="content">
<div class="row">
   <div class="col-xs-12 ">
      <?php echo $this->Flash->render();?>
      <div class="box">
         <div class="box-header">
            <h3 class="box-title">User Summary</h3>
         </div>  
         <div class="box-body table-responsive no-padding">
           <table class="table table-bordered">
                <tr class="bg-primary">
                    <th>User Id</th>
                    <th>Name</th>
					<th>Contact Number</th>
                    <th>Status</th>                
                    <th>Email</th>
                    <th>Current Status</th>
                    <th>Change Status</th>
                    <th  class="hidenwforprint">View Profile</th>
                    
                </tr>
					 <?php if(!empty($clinics)){
                        $i=1;?>
                <?php foreach ($clinics as $user): ?>
				
					 <tr class="table-hover bg-success">
					
                    <td><?=  $user->id;?></td>
                    <td><?= $user->name;?></td>
					<td><?= $user->phone;?></td>
                    <td><?php if($user->active == 1){echo"Active";}else{echo"Inactive";}?></td>
                    <td><?= $user->email;?></td>
                    <td  class="hidenwforprint"><?php if($user->active == 1){
					  echo '<span class="label label-success">Unblock</span>'; 
					}else{
					   echo '<span class="label label-warning">Block</span>';
					}?>
				</td>
                     <td  class="hidenwforprint"><?php if($user->active == 1){
					   echo $this->Form->postLink('<span class="label label-warning">Set block</span>', array('action'=>'changestatus', $user->id), array('escape' => false)); 
					}else{
					   echo $this->Form->postLink('<span class="label label-success">Set Unblock</span>', array('action'=>'changestatus', $user->id), array('escape' => false));
					}?>
				</td>
                    <td class="hidenwforprint"><?php echo $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span>', array('action'=>'view', $user->id), array('escape' => false)); ?></td>
                    
                    
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
