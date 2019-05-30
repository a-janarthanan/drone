<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/lib/tooltip2.js"></script>
<script type="text/javascript">
	function disp()
	{
		var retVal = confirm("Do you want to continue ?");
		if( retVal == true ){
		window.location.href='<?php echo site_url('dispute/dispute_task/'.$task_id) ?>';
		}
	}
</script>
<style>
.abc{
	width:72px;
	float:left;
}
.offerbg {
float: right;
width: 90px;
color: #fff;
background-color: #f2413e;
padding: 7px 10px;
-webkit-border-radius: 6px;
-moz-border-radius: 6px;
border-radius: 6px;
border: medium none !important;
box-shadow: 0 3px 0 rgba(0, 0, 0, 0.2);
}
</style>
<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
	<div>
    <div class="red-subtitle top-red-subtitle" >Konversation</div>
<div class="profile_back">
<div class="container">
<div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0; padding-bottom:20px;">
<div class="home-signpost-content">
    <div class="dbleft dbleft-main">



<?php

if($error!='') { ?>

<div id="error"><ul><?php echo $error; ?></ul>
</div>
<?php } ?>


     <?php 
     
     $category_image=base_url().'upload/category/no_image.png';

      
      if($task_detail->category_image!='') {  
      
          if(file_exists(base_path().'upload/category/'.$task_detail->category_image)) { 
              
              $category_image=base_url().'upload/category/'.$task_detail->category_image;
          
          }
          
      }
      
      $data['category_image']=$category_image;
      
      
          $is_accept = 0;
          $task_detail = $this->task_model->get_task_detail($task_id); 
          $is_close = $task_detail->task_activity_status;
  
  
  
    if($task_detail->user_id)
          {
               $check_user_detail=$this->user_model->get_user_profile_by_id($task_detail->user_id);
                  
                  if($check_user_detail) { 
                  ?>
                  
                         
<div id="s1postJ" class="padB10"><b>Konversation med: <?php echo anchor('user/'.$check_user_detail->profile_name,ucfirst($check_user_detail->first_name).' '.ucfirst(substr($check_user_detail->last_name,0,1)),' style="color:black" ');?></b></div>
                  
                  <?php
                  }
          }
     ?>
     
     
     


<div class="btn btn-default fr" style="width:auto;" >Bud: <b>
  <?php 
      //$worker_id =
      $offfer_amount = $this->user_task_model->offer_price($user_worker_id, $task_id);
      echo $site_setting->currency_symbol.$offfer_amount->offer_amount;
  ?></b></div>
<div class="clear"></div>



<ul class="padli10">
              <li>
                  <div class="addtl"  style="width:72px;float:left;"><img src="<?php echo base_url().getThemeName();?>/images/per.jpg" class="round-corner" width="50" height="50" alt="" /></div>
                  <div class="addtr" >
                      <h2 class="abmarks abmarks-2"><?php echo ucfirst($task_detail->task_name);?></h2>
                      <div class="colmark colmark-2">skapad i <?php echo ucfirst($task_detail->city_name); ?></div>
                  </div>
                  <div class="clear"></div>
              </li>
              
             
              
              <li>
                   <div class="inside-subtitle">Beskrivning:</div>
                  <p class="LH18 colmark colmark-2">
                      <?php 
                          $task_description= $task_detail->task_description;		
                          $task_description=str_replace('KSYDOU','"',$task_description);
                          echo $task_description=str_replace('KSYSING',"'",$task_description);
                       ?>
                  </p>
              </li>
              
              
                  
                  <div class="clear"></div>
             
              
           
          </ul>


 <div class="marTB20"><div class="inside-subtitle">Konversation</div></div>     

<ul class="padli10 marT10">
  <?php 
      foreach($result as $row) {
      
      
  
      
      
          $user_detail=$this->user_model->get_user_profile_by_id($row->comment_post_user_id);
              $user_image= base_url().'upload/no_image.png';
               
               if($user_detail->profile_image!='') {  
          
                  if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
              
                      $user_image=base_url().'upload/user/'.$user_detail->profile_image;
                      
                  }
                  
              }
              
              
              
  ?>
      <li class="posrel">
          <div class="tpp">
              <div class="abc">
                 <?php echo anchor('user/'.$user_detail->profile_name,'<img src="'.$user_image.'" alt="" width="50" height="50" class="round-corner" />');?>
              </div>
             <?php 
              if($row->comment_post_user_id != get_authenticateUserID()) 
              { 
                  $conbg =  'conbg1';
              } else {
                  $conbg =  'conbg2';
              }
            ?>
              <div class="<?php echo $conbg;?>">
                  <?php /*if($row->is_final == 0) {  ?> <p class="marT10">this msg is related to <?php echo $task_detail->task_name; ?></p><?php }*/ ?>
                  <?php if($row->is_accept == 1) { $is_accept = 1 ;} ?>
                      <p class="LH18 marT5"><?php echo $row->task_comment;?></p>
              </div>
              <div class="clear"></div>
          </div>
      </li>
  <?php } ?>
                      
</ul>            


<?php
  $dispute = $this->dispute_model->check_dispute_task($task_id);
$dispute_status=0;
if($dispute)
{
  $dispute_status=1;
}


  
if($is_close != 3 && $dispute_status!=1) {
  
  
  $attributes = array('name'=>'frm_new_comment','class'=>'fdesign');
  echo form_open('worker_task/conversation/'.$worker_id.'/'.$task_id,$attributes);
?>  
  <ul class="padli10">
      <li>
          <div class="abc">
          <?php
          
          $userinfo=$this->user_model->get_user_info(get_authenticateUserID());
          
          $user_detail=$this->user_model->get_user_profile_by_id(get_authenticateUserID());
              $user_image= base_url().'upload/no_image.png';
               
               if($user_detail->profile_image!='') {  
          
                  if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
              
                      $user_image=base_url().'upload/user/'.$user_detail->profile_image;
                      
                  }
                  
              }
              
              ?>
           <?php echo anchor('user/'.$userinfo->profile_name,'<img src="'.$user_image.'" alt="" width="50" height="50" class="round-corner" />');?>
          </div>
          
          <div class="conbg3">
            <textarea name="comment" cols="63" rows="5" class="comment_area"></textarea>
            <?php 
                                  
                  $post_user_id =  $worker_user_id;
                  $task_user = $task_user_id;
              
            ?>
             
            <input type="hidden" id="worker_id" name="worker_id" class="chbg fl" value="<?php echo $user_worker_id;?>">
            <input type="hidden" id="task_id" name="task_id" class="chbg fl" value="<?php echo $task_id;?>">
            <input type="hidden" id="post_user_id" name="post_user_id" class="chbg fl" value="<?php echo $post_user_id;?>">
            <input type="hidden" id="task_user" name="task_user" class="chbg fl" value="<?php echo $task_user;?>">
              <div class="marT10" style="padding-left:72px;">
             <?php if($task_user_id == get_authenticateUserID()) {
              if($is_accept != 1) { ?>
                  <input type="submit" id="accept" name="accept" class="btn btn-default fl mar-right-5" value="Accept Offer">
             <?php } 
             
             
             
                  $assign_time_pay_amount=0;
                  $assign_pay_status=0;
              
                  $payable_amount=0;
                  
                  $check_amount_pay=check_task_assign_amount_pay($task_user_id,$task_id);
                  
                  if($check_amount_pay)
                  {
                      $assign_pay_status=1;
                      $assign_time_pay_amount=$check_amount_pay->task_amount;
                  }
                  else
                  {
                      $payable_amount=0;
                  }
                  
                  
                  
                  
             
              if($task_detail->task_activity_status!=2 && $task_detail->task_activity_status!=3 && $task_detail->task_activity_status==1 && $task_user_id != get_authenticateUserID() && $assign_pay_status==1 && $assign_time_pay_amount>0) { ?>
              
              <input type="submit" id="complete" name="complete" class="btn btn-default fl mar-right-5" value="Complete Task">
              
              
               <input type="button" id="complete" name="complete" class="btn btn-default fl mar-right-5" value="Dispute Task" onclick="disp();">
               
              
          <?php 	}
             
             ?>
                  <input type="submit" id="send" name="send" class="btn btn-default mar-right-5" value="Send Message">
                 <?php 
             }
			 ?>
              <div class="clear"></div>
              </div>
             <?php
               /*$worker_id = $this->user_task_model->worker_id($task_detail->task_worker_id);
               
              if($worker_id->user_id==get_authenticateUserID() && $task_detail->task_activity_status==3) {?>

              <!--<input type="button" id="rate_employyer" name="rate_employyer" class="btn btn-default fl" value="Review Employer" onclick="window.location.href='<?php echo site_url('user_task/review_employer/'.$task_id) ?>'">-->
               
              <?php }*/ ?>
                 
          </div>
      </li>
   </ul>

</form>
<?php } ?>
  
         
   
</div>
</div>
      <div class="dbright-task dbright-task-main">
      	<?php echo $this->load->view($theme.'/layout/user_task/conver_side_bar.php',$data); ?>
      </div>
	<div class="clear"></div>     
<div class="clear"></div>     
 

           
          	
