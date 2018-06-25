<section class="content">
<div class="row">
   <div class="col-xs-12 ">
      <?php echo $this->Flash->render();?>
      <div class="box">
         <div class="box-header">
            <h3 class="box-title">User requested Wishtlist Summary</h3>
         </div>  
         <div class="box-body table-responsive no-padding">
           <table class="table table-bordered">
                <tr class="bg-primary">
                    <th>S.no.</th>
                     <th>Video detail</th>
                    <th>User detail</th>        
                    <th class="hidenwforprint">Date</th>
                </tr>
					 <?php if(!empty($clinics)){
                        $i=1;?>
                <?php foreach ($clinics as $user): ?>
				
					 <tr class="table-hover bg-success">
					
                    <td><?= $i;?></td>
                    <td><?php echo"<b>Name :</b>".$user->wishlist->name."<br><b>Description :</b>".$user->wishlist->description;?></td>
                    <td><?php echo"<b>Name :</b>".$user->user->name."<br><b>Contact number :</b>".$user->user->phone;?></td>                  
				    <td><?= $user->date;?></td>
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
<style>
    a#aadnew {
    background: #5c3973;
    padding: 5px 10px;
    font-size: 15px;
    color: #fff;
}
</style>