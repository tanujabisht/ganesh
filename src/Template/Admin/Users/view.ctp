<section class="content">
     <?php echo $this->Flash->render();?>
<div class="row">
   <div class="col-xs-12 ">
      <div class="box">
         <div class="box-header">
            <h3 class="box-title">USER DETAIL</h3>
         </div>
         <div class="row">
                <div class="col-sm-4"></div>
                  <div class="col-sm-4">
                      <div class="profile_img">
                          <?php
                            if(!empty($userdata->image)){
                                   echo $this->Html->image('user/'.$userdata->image,array('class'=>'img-responsive'));
                              }else{
                                   echo $this->Html->image('user/user.png',array('class'=>'img-responsive'));
                              }													 
                          ?>
                      </div>
                  </div>
                  <div class="col-sm-4"></div>
           </div>
         <div class="box-body table-responsive no-padding">
           <table class="table table-bordered">               
					 <?php if(!empty($userdata)){?>
                        <tr class="bg-primary">
                           <th>User Id</th>
                           <th>Name</th>   
                           <th>Contact Number</th>
                           <th>Email</th>
                            
                       </tr>
					 <tr class="table-hover bg-success">					
                    <td><?= $userdata->id;?></td>
					<td><?= $userdata->name;?></td>
                    <td><?= $userdata->phone;?></td>
                    <td><?= $userdata->email;?></td>
                </tr>
                <?php  }else{ ?>
				<tr><td colspan='5'>No Record Found.</td></tr>
			<?php }?>
        </table>
       </div>
          <div class="box-body table-responsive no-padding">
           <table class="table table-bordered">               
					 <?php if(!empty($userdata)){?>
                        <tr class="bg-primary">                            
                           <th>Date of birth</th>
                           <th>Location</th>
                           <th>Gender</th>                          
                       </tr>
					 <tr class="table-hover bg-success">					
                    <td><?= $userdata->dob;?></td>
					<td><?= $userdata->location;?></td>
                    <td><?= $userdata->gender;?></td>
                </tr>
                <?php  }else{ ?>
				<tr><td colspan='5'>No Record Found.</td></tr>
			<?php }?>
        </table>
       </div>
       <!-- Box Body -->
 
        
      <!-- Box -->
   </div>
</div>

      
</section>

<style>
    .profile_img {
    width: 50%;
    margin: 0 auto;
    border: 1px solid #ccc;
    box-shadow: 8px 19px 32px 7px #ccc;
    margin-bottom: 10%;
}
</style>