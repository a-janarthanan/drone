<?php  
$site_setting=site_setting(); 
$data['site_setting']=$site_setting;
//$data['category_url_name']=$category_url_name;
?>
<script type="text/javascript"> 
   jQuery(document).ready(function() { 
    jQuery("#autostart").fancybox({'overlayShow':true,frameWidth: 
838,frameHeight:540}).trigger('click'); 
  }); 
</script> 
<div class="page-title mbot20">
<h1 class="mleft15"><?php echo ucfirst($task_detail->task_name);?></h1>


</div>

<div class="details-title-ph">
<div class="user-image">
<?php
						
						$user_detail=$this->user_model->get_user_profile_by_id($task_detail->user_id);
				$user_image= base_url().'upload/no_image.png';
				 
				 if($user_detail->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$user_detail->profile_image;
						
					}
					
				} 
						 
						 
						  echo anchor('user/'.$task_user_detail->profile_name,'<img src="'.$user_image.'" width="72" height="72" alt="" style="border-radius:5px;"/>'); ?>
</div>
<div class="details-title">
<p class="option-title"><?php echo ucfirst($task_detail->task_name);?></p>
<p class="post-info">Posted <?php echo getDuration($task_detail->task_post_date,$task_id); ?> <!--year ago by --> <?php echo anchor('user/'.$task_user_detail->profile_name,ucfirst($task_user_detail->first_name).' '.ucfirst(substr($task_user_detail->last_name,0,1)).'.',' class="fpass" ');?></p>
</div>
</div>
<div class="fleftfw" style="margin-top: 5px;">
<div class="insideleft">    
<h3 class="section-title" style="width:97%">Details</h3>
<ul class="details">
<li><label class="blue-label mtop10">City:</label><span class="value mtopleft10"><?php echo ucfirst($task_detail->city_name); ?></span></li>
<li><label class="blue-label-new mtop10">Description:</label><p class="value mtop10"><?php  
					
					$task_description= $task_detail->task_description;		
					$task_description=str_replace('KSYDOU','"',$task_description);
					 $task_description=str_replace('KSYSING',"'",$task_description);				
				echo 	ucfirst($task_description);?></p></li>

<?php if($additional_information) { ?>
<li>
<label class="blue-label mtop20">Additional Information:</label>
<p class="value mtop10">
                    <?php 
						foreach($additional_information as $information) { 
							echo 'Post Date : '.date($site_setting->date_format,strtotime($information->post_date)).'<br />';
							
					$information= $information->information;		
					$information=str_replace('KSYDOU','"',$information);
					 $information=str_replace('KSYSING',"'",$information);				
				echo 	ucfirst($information);
				
				echo '<br /><br />';
						}
					?>
</span>
</li>
<?php } ?>			
</ul>
 <?php 
		   
		   $data['comments']=$comments;
		   $login_worker_id=0;
		    $check_worker_detail=$this->worker_model->check_user_worker_detail(get_authenticateUserID());
			
			if($check_worker_detail) {  $login_worker_id=$check_worker_detail->worker_id; }
			
		  // if($task_detail->task_is_private==0 || $task_detail->user_id==get_authenticateUserID() || $task_detail->task_worker_id==$login_worker_id) {  
		   
		   
		   		   if($task_detail->task_is_private==0) 
				   {  
		   
		   				if($comments) 
						{ 
					?>  
							<h3 class="section-title" style="width:97%">Conversations</h3>
							<ul class="listing mbot20 scrolling">
							<?php 
				$i= 0;
					foreach($comments as $comment) {  $i++;
					
					
				$user_detail=$this->user_model->get_user_profile_by_id($comment->comment_post_user_id);
				$user_image= base_url().'upload/no_image.png';
				 
				 if($user_detail->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$user_detail->profile_image;
						
					}
					
				}
				
				
				
				?> 
							<li>
							<div class="imageph">
							 <?php echo anchor('user/'.$user_detail->profile_name,'<img src="'.$user_image.'" alt="" width="68" height="69"/>');?>
							 <?php $check_worker_detail=$this->worker_model->check_user_worker_detail($comment->comment_post_user_id);
							 ?>
							</div>
							<div class="message-part">
							<p class="user-name"><?php echo anchor('user/'.$comment->profile_name,'<b>'.ucfirst($comment->first_name).'</b> '.ucfirst(substr($comment->last_name,0,1)),' class="col fs14 unl"'); ?></p>
							<p class="item-price"><?php echo $comment->task_comment;?></p>
							<p class="small-grey"><?php echo getDuration($comment->comment_date,$task_id); ?></p>
							</div>
							</li>

							
				<?php 	} 
				?>
				</ul>
				<?php
					} 
					}
				?>
				<?php if($similar_tasks) { ?>
        
    
<h3 class="section-title" style="width:97%">Tasks similar to this one</h3>
<ul class="listing mbot20 scrolling">
<?php  foreach($similar_tasks as $task_info) { 
		
		
			$user_detail=$this->user_model->get_user_profile_by_id($task_info->user_id);
				$user_image= base_url().'upload/no_image.png';
				 
				 if($user_detail->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$user_detail->profile_image;
						
					}
					
				}
				
			
			$total_rate=get_user_total_rate($task_info->user_id);
		
		   ?>
<li>
<div class="imageph"><?php echo anchor('user/'.$task_info->profile_name,'<img src="'.$user_image.'" width="50" height="50" alt="" />'); ?></div>
<div class="detailspart">
<p class="item-title"><?php echo anchor('tasks/'.$task_info->task_url_name,ucfirst($task_info->task_name),' class="fpass"');?></p>
<p class="item-price">Posted by <span class="item-cost"><?php echo '<b>'.ucfirst($task_info->first_name).' '.ucfirst(substr($task_info->last_name,0,1)).'.</b>'; ?></span> in <?php echo $task_info->city_name; ?></p>
<p class="item-short-des"><span class="item-cost"><?php echo $site_setting->currency_symbol.$task_info->task_price; ?></span> for Tasks of this type</p>
</div>
<div class="frightauto">
<div class="str"><div class="str_sel" style="width:<?php if($total_rate>5) { ?>100<?php } else { echo round($total_rate*2);?>0<?php } ?>%;"></div></div>
<?php  if(!check_user_authentication()) {  echo anchor('sign_up','Post similar task',' class="cm temp"'); } else { echo anchor('task/update_task_step_zero/'.$task_info->task_id.'/copy','Post similar task','  class="cm temp"  id="copy_'.$task_info->task_id.'"  ');}?>
<script type="text/javascript">
								jQuery(document).ready(function() {	
									jQuery("#copy_<?php echo $task_info->task_id;?>").fancybox();	
								});
						</script>
</div>
</li>
<?php } ?>
</ul>
<?php } ?>
</div>
<div class="insideright">
        <?php echo $this->load->view($theme.'/layout/task/task_detail_side_bar',$data); ?> 
</div>
</div>