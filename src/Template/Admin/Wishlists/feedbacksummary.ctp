<section class="content">
<div class="row">
   <div class="col-xs-12 ">
      <?php echo $this->Flash->render();?>
      <div class="box">
         <div class="box-header">
            <h3 class="box-title">Feedback Summary</h3>
            
         </div>  
         <div class="box-body table-responsive no-padding">
           <table class="table table-bordered">
                <tr class="bg-primary">
                   
                      <th>S.no</th>
                      <th>User Detail</th>
                      <th>Comment</th>
                      <th>Rating</th>
                       <th>Date</th>
                    </tr>
				      <tbody>
            <?php if(!empty($admin)){
                        $i=1;?>
                <?php foreach ($admin as $user): ?>				
					 <tr class="table-hover bg-success">					
                                <td><?= $i;?></td>
                                <td><?php echo $user->user->name. " ( ".$user->user->phone.")"; ?></td>		
                              
                               <td><?= $user->comment;?></td>
                               <td><?= $user->rating;?></td>
                               <td><?= $user->date;?></td>	
                            </tr>
                            <?php $i++; endforeach; }else{ ?>
					 <tr><td colspan='5'>No Record Found.</td></tr>
					 <?php }?>
                  </tbody>
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
