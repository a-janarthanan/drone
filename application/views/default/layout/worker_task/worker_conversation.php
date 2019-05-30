<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/lib/tooltip2.js"></script>
<script type="text/javascript">
	function disp()
	{
		var retVal = confirm("Do you want to continue ?");
		if( retVal == true ){
		window.location.href='<?php echo site_url('dispute/dispute_task/'.$task_id) ?>';
		}
	}
    function complete()
    {
        document.frm_new_comment.submit();
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
	<div id="two-columnar-section" class="top-cont-main-dash">
    <div class="red-subtitle top-red-subtitle" style="margin-bottom:0px;">Conversation</div>
<div class="db-rightinfo-dash">
<div class="container">
	
    <?php
	if($error!='') { ?>
	<div id="error"><ul><?php echo $error; ?></ul>
	</div>
	<?php } ?>
	<div class="home-signpost-content dashboard-box1 dashboard-box1-1">
	<div class="">
    <div class="dbleft dbleft-offer" style="padding:0px 0px 0 0px; width:100%; border:0; margin-left:0px; background:#fff;">
		<div class="">
            <div class="chat-box chat-box-1">
                <div class="top-image-user">
                    <div class="fl user_image_conv" style="text-align:center;font-size:15px;">
                        <?php
                        $epm=$this->user_model->get_user_profile_by_id($task_detail->user_id);
                        //print_r($epm);
                        $usernew_image= base_url().'upload/no_image.png';
                                    if($epm->profile_image!='') {  
                                        if(file_exists(base_path().'upload/user/'.$epm->profile_image)) {
                                            $usernew_image=base_url().'upload/user/'.$epm->profile_image;
                                        }
                                    }

                        ?>

                        <a href="#"><div class="round-corner-2 border-img" style="height:100px; width:100px; overflow:hidden;"><img width="" height="100" class="" alt="" src="<?php echo $usernew_image ?>"></div></a>
                            <?php echo $epm->first_name.' '.$epm->last_name; ?>
                   

                   
                    </div>
                    <div class="fl arrow_img"><a href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/right-left-arrow.png" alt="" width="65" /></a></div>
                    <div class="fr user_image_conv" style="text-align:center; font-size:15px;">
                    <?php if($worker_user_id)
                          {
                            $check_worker_detail=$this->user_model->get_user_profile_by_id($worker_user_id);
            
                            if($check_worker_detail) { 
                                //print_r($check_worker_detail);
                                $work_image= base_url().'upload/no_image.png';
                                    if($check_worker_detail->profile_image!='') {  
                                        if(file_exists(base_path().'upload/user/'.$check_worker_detail->profile_image)) {
                                            $work_image=base_url().'upload/user/'.$check_worker_detail->profile_image;
                                        }
                                    }
                    ?>
                            <a href="#"><div class="round-corner-2 border-img" style="height:100px; width:100px; overflow:hidden;"><img width="" height="100" class="" alt="" src="<?php echo $work_image ?>"></div></a>
                            <?php echo $check_worker_detail->first_name.' '.$check_worker_detail->last_name; ?>
                   

                    <?php
                             }
                            }
                    ?>

                        
                    </div>
                </div>
                <div class="detail-box-chat">
                
                    <div style="text-align:center; padding-top:0px; margin-bottom:15px;" class="inside-subtitle">Chat</div>
                    <div class="chat_history">
                        <table cellpadding="0" cellspacing="0" width="100%">
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
                                <tr>
                                    <td class="user_name_in" valign="top">
                                        <?php echo anchor('user/'.$user_detail->profile_name,'<img src="'.$user_image.'" alt="" width="50" height="50" class="round-corner-2 border-img" />');?>
                                    </td>
                                    <?php 
                                        if($row->comment_post_user_id != get_authenticateUserID()) 
                                        { 
                                            $conbg =  'conbg1';
                                        } else {
                                            $conbg =  'conbg2';
                                        }
                                    ?>
                                    <td class="user_message_in <?php echo $conbg;?>" valign="top">
                                    	<?php if($row->is_accept == 1) { $is_accept = 1 ;} ?>
                      					<?php echo $row->task_comment;?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <div>
                             
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
                                <div class="conbg3">
                                    <?php if($task_detail->task_activity_status!=3) {
                                     ?>
                                <textarea name="comment" class="text_area_info"></textarea>
                                  
                                  
                                  <?php 
                                        $post_user_id =  $worker_user_id;
                                  		$task_user = $task_user_id;
                                  ?>
                               
                                  <input type="hidden" id="worker_id" name="worker_id" class="chbg fl" value="<?php echo $user_worker_id;?>">
                                <input type="hidden" id="task_id" name="task_id" class="chbg fl" value="<?php echo $task_id;?>">
                                <input type="hidden" id="post_user_id" name="post_user_id" class="chbg fl" value="<?php echo $post_user_id;?>">
                                <input type="hidden" id="task_user" name="task_user" class="chbg fl" value="<?php echo $task_user;?>">
                            		
                                     <div class="marT10" style="padding-left:0px; padding-bottom:0px;">
                                        
										  <input type="submit" id="send" name="send" class="btn btn-default btn-category fr btn-category-2 marL5 btn-default-join-hiw" value="Send Message">
										
                                        
                                        <div class="clear"></div>
                                    </div>
                                 <?php 
                                     }
                                     ?>
                                </div>
                                <div class="clear"></div>
                            </li>
                         </ul>
                        </form>
                    <?php } ?>
                </div>
                </div>
                
            </div>
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
						  
								 
		<!--<div id="s1postJ" class="padB10"><b>Conversation with: <?php echo anchor('user/'.$check_user_detail->profile_name,ucfirst($check_user_detail->first_name).' '.ucfirst(substr($check_user_detail->last_name,0,1)),' style="color:black" ');?></b></div>-->
						  
						  <?php
						  }
				  }
			 ?>
            <div class="detail-box detail-box-worker">
                <div style="background: #878787 none repeat scroll 0 0; border-bottom: 0 none; color: #fff; font-size: 30px; margin-bottom: 0; padding-bottom: 35px; padding-top: 35px; text-align: center; border-radius:0 10px 0 0;" class="inside-subtitle">Summary</div>
                <div style="padding:0 10px 10px 10px;">
                    <div class="task-details-info">
                        <div class="task-details-info-left">Task Name</div>
                        <div class="task-details-info-right"><?php echo ucfirst($task_detail->task_name);?></div>
                    </div>
                    <div class="task-details-info">
                        <div class="task-details-info-left">Description</div>
                        <div class="task-details-info-right"><?php 
                          $task_description= $task_detail->task_description;		
                          $task_description=str_replace('KSYDOU','"',$task_description);
                          echo $task_description=str_replace('KSYSING',"'",$task_description);
                       ?></div>
                    </div>
                    <div class="task-details-info">
                        <div class="task-details-info-left">Offer Price</div>
                        <div class="task-details-info-right"><?php 
							  //$worker_id =
							  $offfer_amount = $this->user_task_model->offer_price($user_worker_id, $task_id);
							  echo $site_setting->currency_symbol.$offfer_amount->offer_amount;
						  ?></div>
                    </div>
                    <div class="task-details-info">
                    	<div class="task-details-info-left">Share with Friends</div>
                        <div class="task-details-info-right">
                            <a href="javascript:void()" onClick="window.open('http://twitter.com/home?status=<?php echo $task_detail->task_name; ?> <?php echo site_url('tasks/'.$task_detail->task_url_name);?>','Share on Twitter','height=300,width=600,top=50,left=300');"><img src="<?php echo base_url().getThemeName(); ?>/images/twitter-o.png" alt="" width="30" height="30"/></a>
                            
                            <a href="javascript:void()" onClick="window.open('http://www.facebook.com/share.php?u=<?php echo site_url('tasks/'.$task_detail->task_url_name);?>&amp;t=<?php echo $task_detail->task_name; ?>','Share on Facebook','height=300,width=600,top=50,left=300');"><img src="<?php echo base_url().getThemeName(); ?>/images/facebook-o.png" alt=""  width="30" height="30"/></a>
                            
                            <a href="https://plus.google.com/share?url={<?php echo site_url('tasks/'.$task_detail->task_url_name);?>}" onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo base_url().getThemeName(); ?>/images/googleplus.png" alt="Share on Google+"  width="30" height="30"/></a>
                            
                            <a href="javascript:void()" onClick="window.open('https://www.linkedin.com/shareArticle?mini=true&url=https://www.linkedin.com/&title=&summary=&source=','Share on Linkedin','height=300,width=600,top=50,left=300');"><img src="<?php echo base_url().getThemeName(); ?>/images/linkedin.png" alt="" width="30" height="30"/></a>
                         </div>
                    </div>
                    <div style="margin-top:15px;">
                    	 <a href="<?php echo base_url(); ?>worker_task/my" class="btn btn-default btn-category fr btn-category-2 marL5 btn-default-join-hiw">Back to My Task</a>
						 <?php 
                         
                         if($task_user_id != get_authenticateUserID()) {
                           
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
                                         
									  if($task_detail->task_activity_status!=2 && $task_detail->task_activity_status!=3 && $task_detail->task_activity_status==1 && $task_user_id != get_authenticateUserID()) { ?>
									  
									 <!-- <input type="button" id="complete" name="complete" class="btn btn-default btn-category btn-category-2 fr marL5 btn-default-join-hiw" value="Complete Task" onclick="complete();">
									  
									  
									   <input type="button" id="complete" name="complete" class="btn btn-default fl mar-right-5" value="Dispute Task" onclick="disp();">-->
									   
									  
								  <?php 	}
									 
									 ?>
										 <?php 
									 }
									 ?>
                         
						 <?php if($task_user_id == get_authenticateUserID()) { ?>
                             <?php if($is_accept != 1) { ?>
                                  <!--<input type="button" id="accept" name="accept" class="btn btn-default btn-category btn-category-2 btn-default-join-hiw" value="Accept Offer" >-->
                              <?php } 
                         }
                         ?>
                     </div>
                </div>
            </div>
            
        </div>
    </div>
	</div>
	<div class="clear"></div>     
<div class="clear"></div>     
 

           
          	
