<section class="content">
    <div class="row">
         <div class="col-sm-3"></div>
        <div class="col-sm-6">
                    <div class="jumbotron">
                        <p class="clinic_data">
                             <?php echo $this->Html->image('logo1.png', array('alt' => 'Ganesh Films'));?>
                        </p> 
                      <h3 style="text-align: center;"><b><?= "Ganesh Films Pvt Ltd"; ?></b></h3>      
                                           
                    </div>          
        </div>
         <div class="col-sm-3">
         </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="<?php echo $this->Url->build('/',true).'admin/users/summary';?>">
                      <div class="info-box">
                        <span class="info-box-icon bg-blue1"><?php echo $user; ?></span>            
                        <div class="info-box-content">
                          <span class="info-box-text1">Total Users</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                </a>                      <!-- /.info-box -->
            </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="<?php echo $this->Url->build('/',true).'admin/cats/summary';?>">
                      <div class="info-box">
                        <span class="info-box-icon bg-blue1"><?php echo $cat; ?></span>            
                        <div class="info-box-content">
                          <span class="info-box-text1">Total Video Category</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                </a>                      <!-- /.info-box -->
            </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="<?php echo $this->Url->build('/',true).'admin/wishlists/request';?>">
                      <div class="info-box">
                        <span class="info-box-icon bg-blue1"><?php echo $wish; ?></span>            
                        <div class="info-box-content">
                          <span class="info-box-text1">Users Wishlist</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                </a>                      <!-- /.info-box -->
            </div>
           <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="<?php echo $this->Url->build('/',true).'admin/wishlists/summary';?>">
                      <div class="info-box">
                        <span class="info-box-icon bg-blue1"><?php echo $wishlist; ?></span>            
                        <div class="info-box-content">
                          <span class="info-box-text1">Total Wishlist Video</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                </a>                      <!-- /.info-box -->
            </div>
        <?php 
        if(!empty($res)){
             foreach($res as $cat_details){
            ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="<?php echo $this->Url->build('/',true).'admin/vedios/summary/'.$cat_details['cat_id'];?>">
                      <div class="info-box">
                        <span class="info-box-icon bg-blue1"><?php echo $cat_details['count']; ?></span>            
                        <div class="info-box-content">
                          <span class="info-box-text1"><?php echo $cat_details['cat_name']; ?></span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                </a>                      <!-- /.info-box -->
            </div>
            <?php } } ?>
    </div>
</section>
<style>
    .clinic_data img {
    width: 35%;
}
</style>


