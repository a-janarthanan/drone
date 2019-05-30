<link rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/js/lib/themes/base/jquery.ui.all.css">
<script type="text/javascript">

	jQuery(function() {
		jQuery("#tabs").tabs();	
		jQuery("#pupload2").fancybox();	
		 jQuery("#sprogress").fancybox();    
	});


</script>

<?php 	$site_setting=site_setting(); ?>
<div class="db-title mbot20">
<h1 class="welcome">Welcome <span style="font-size:30px"><?php echo $this->session->userdata('full_name'); ?></span></h1>
</div>
<div class="dbleft">
<div class="fleftauto"><img src="images/unknown.png" border="0" align="left" style="padding:0 10px 0 0" /></div>
<div class="fleft59">
<p class="sec-title">Upload Your Profile Picture</p>
<p class="common-text">Runners feel better about working with you when they can see your face.</p>
<?php echo anchor('user/upload_photo/dashboard','<b>Upload a photo</b>',' id="pupload2" class="yellow-button"');?>

</div>
</div>
<div class="dbcenter">
<p class="pr-status">Your Profile is <span class="bigf33"><?php echo anchor('user/complete_profile/',$profile_complete.' % complete','class="fpass" id="sprogress" style="color:#FFF;"'); ?></span>&nbsp;Completed</p>
<div class="statusbar-ph">
<div class="statusbar"></div>
</div>
<?php echo anchor('user/'.getUserProfileName(),'<b>View profile</b>','class="yellow-button"'); ?>
</div>
<div class="dbright">
<p class="sec-title">View Tasks with our new Task Map!</p>
<img src="images/mapicon.jpg" align="left" style="margin:0 10px 0 0" />
<div class="fleft45">
<p class="common-text">Want a way to see all the current Tasks on a fun map?</p>
<?php echo anchor('map/','<b>View the Task Map</b>',' class="yellow-button"');?>
</div>
</div>
<div class="shade-divider"></div>
<div class="browse-task-section">
<div class="btitbg">BROWSE TASKS</div>
<ul class="bgcol">

<?php

$category_infos=get_category();

if($category_infos) { $ccnti=0;
foreach($category_infos as $category_info) {

if($ccnti<9) {
$sub_categories = sub_category($category_info->task_category_id);
if($sub_categories){
?>
<li><?php echo anchor('tags/'.$category_info->category_url_name,'<h3>'.$category_info->category_name.'</h3><span>></span><div class="clear"></div>');?>
<ul class="subcat">
<?php foreach($sub_categories as $sub_category) { ?>
<li><?php echo anchor('tags/'.$sub_category->category_url_name,$sub_category->category_name);?></li>
<?php } ?>
</ul>
<?php } else {?>
<li><?php echo anchor('tags/'.$category_info->category_url_name,'<h3>'.$category_info->category_name.'</h3><span></span><div class="clear"></div>');?></li>
<?php  }
$ccnti++;   } } ?>

<li><?php echo anchor('tags','View full directory','id="fdir" class="marL10"');?></li>

<?php } ?>


</ul>
<div class="botbg"></div>
<div class="job-panel">
<h2 class="gapjob">Job Search</h2>
<input type="text" class="jobsearch" />
<a href="#" class="yellow-button m15">Find Job</a>
</div>
<div class="notification-ph">
<h2 class="notifications">Job Search</h2>
<ul class="notification-list">
<li>
<p class="notif">Lorem ipsum dolor sit amet, consectetur</p>
<p class="author">Suman</p>
</li>
<li>
<p class="notif">Lorem ipsum dolor sit amet, consectetur</p>
<p class="author">Suman</p>
</li>
<li>
<p class="notif">Lorem ipsum dolor sit amet, consectetur</p>
<p class="author">Suman</p>
</li>
<li>
<p class="notif">Lorem ipsum dolor sit amet, consectetur</p>
<p class="author">Suman</p>
</li>
<li>
<p class="notif">Lorem ipsum dolor sit amet, consectetur</p>
<p class="author">Suman</p>
</li>
</ul>
</div>
<?php if($my_task) { ?>
              
<h3 id="detail-bg1">Task History</h3>
                
<div class="taskhist" >
                	<ul>

           <?php foreach($my_task as $mtask) {
		   
		   $close_status='';
		   
		   if($mtask->task_activity_status==3) { $close_status='lockbg '; } 
		   
		    ?>         	
                        
                        
                        <li>
                             	<div class="taskhleft">
                                	<div><?php echo anchor('tasks/'.$mtask->task_url_name,ucfirst($mtask->task_name),' class="'.$close_status.'homepick"');?></div>
                                   	<div>
                                   
                                   
                                     <span class="geo">
                                   <?php if($mtask->task_status==2) { ?>
                                   Drafted <?php echo getDuration($mtask->task_post_date); ?>
                                   <?php } else {
								   
								   				if($mtask->task_activity_status==0) { ?>
                                                
                                                 Posted <?php echo getDuration($mtask->task_post_date); ?>
								   
								   			<?php } if($mtask->task_activity_status==1) { ?>
                                            Assigned <?php echo getDuration($mtask->task_assigned_date); ?>
                                            
                                            <?php } if($mtask->task_activity_status==2) { ?>
                                            
                                            Completed <?php echo getDuration($mtask->task_complete_date); ?>
                                            
                                              <?php } if($mtask->task_activity_status==3) { ?>
                                              Closed about <?php echo getDuration($mtask->task_close_date); ?>
                                              
                                              <?php } if($mtask->task_activity_status==4) { ?>
                                              Cancelled about <?php echo getDuration($mtask->task_cancel_date); ?>
											  <?php }
											  
							   } ?>
								 </span>  
								
                                    
                                    
                                    
                                    
                                    </div>
                                </div>
                             	<div class="taskhrig">
                                	 <a href="javascript:void();" class="fr"  onclick="remove_div2(this)"><img src="<?php echo base_url().getThemeName(); ?>/images/close.png" alt="Close"></a><div class="clear"></div>
								
                                
                                	<?php if($mtask->task_status==2 || $mtask->task_status==3) { echo anchor('task/step_one/'.$mtask->task_id,'post it!',' id="postit"'); } ?>
                                    
                                    
                                    
                                </div>
                                <div class="clear"></div>
                      </li>
                      
                      
               <?php } ?>       
                      
                      
                      
                      
                    
                    

                    </ul>
                </div>                
                
   <?php } ?> 
div class="padT10">                
              <h3 id="detail-bg1">Site Activity</h3>   
<!-- tab s -->                

		
	<div  id="tabs">
			<ul>
				<li><a href="#tabs-1">Top Task</a></li>
				<li><a href="#tabs-2">Newest</a></li>
			</ul>
            
            
            
         
    
    
			
			
			 
			<div id="tabs-1">
            
<div class="dashsty">
                	
                       <?php if($top_task) {  ?>
                    
                    <ul>
                    	
					  		<?php foreach($top_task as $ttask) {
							
							
							
							
		 $user_image= base_url().'upload/no_image.png';
 
		 if($ttask->profile_image!='') {  
	
			if(file_exists(base_path().'upload/user/'.$ttask->profile_image)) {
		
				$user_image=base_url().'upload/user/'.$ttask->profile_image;
				
			}
			
		}
		
							
							
							 ?>  
                        
                        <li>
                            <div class="dimleft">
                             <?php echo anchor('user/'.$ttask->profile_name,'<img src="'.$user_image.'" height="47" width="47" alt="" />'); ?>
                            </div>
                            <div class="dimright">
                            	<div><?php echo anchor('tasks/'.$ttask->task_url_name,ucfirst($ttask->task_name),' class="homepick"');?></div>
                                <div class="marT5"><?php echo substr(ucfirst($ttask->task_description),0,50).'...'; ?></div>
                              	
                            </div>
                             <?php echo anchor('task/update_task_step_zero/'.$ttask->task_id.'/copy','<b>Post Similat Task </b>',' id="copytask_'.$ttask->task_id.'" class="cm temp" ');?>
                           
                             <script type="text/javascript">
								jQuery(document).ready(function() {	
									jQuery("#copytask_<?php echo $ttask->task_id;?>").fancybox();	
								});
						</script>
                        
                        
                            <div class="clear"></div>
                        </li>
                        
                        
                        <?php } ?>
                        
                        
                        
                    </ul>
                    <?php echo anchor('search/top','See more',' class="seemore_sel"');?>
                   
                   
                   <?php } else { ?>
                   
                 <ul><li style="color:#000000; font-weight:bold;">No task has been added yet.</li></ul>
                   
                   <?php } ?>
                   
                    <div class="clear"></div>
                </div>            
            	

				
			</div>
			
			<div id="tabs-2">
				<div class="dashsty">
                
                <?php if($new_task) { ?>
                
                	<ul>
                    	
                       
                       <?php foreach($new_task as $ntask) { 
					   
					   $task_post_date=$ntask->task_post_date;
					   
					   
					     $task_end_day=$ntask->task_end_day;
						$task_end_time=$ntask->task_end_time;				
						
						$task_end_date=date('l, M d',strtotime(date("Y-m-d", strtotime($task_post_date)) . " +".$task_end_day."days"));				
						$task_end_hour=date('h A',mktime(0,$task_end_time,0,0,0,0));	
								
						$user_image= base_url().'upload/no_image.png';
 
						 if($ntask->profile_image!='') {  
					
							if(file_exists(base_path().'upload/user/'.$ntask->profile_image)) {
						
								$user_image=base_url().'upload/user/'.$ntask->profile_image;
								
							}
							
						}
		
			
					   ?>
                        
                        
                        <li>
                            <div class="dimleft">
                              <?php echo anchor('user/'.$ntask->profile_name,'<img src="'.$user_image.'" height="47" width="47" alt="" />'); ?>
                            </div>
                            <div class="dimright">
                            <div><?php echo anchor('tasks/'.$ntask->task_url_name,ucfirst($ntask->task_name),' class="homepick"');?></div>
                            
                            
                              <?php /*?> <div class="marT5"><?php echo substr(ucfirst($ntask->task_description),0,150); ?></div><?php */?>
                              	<div class="colblack">
                              
                              
                               <?php if($ntask->task_assing_worker>0 && $ntask->task_auto_assignment==3 && $ntask->task_activity_status==0) {                               	
								
								$worker_detail=$this->worker_model->get_worker_info($ntask->task_assing_worker);			
						
                               		?>
                                    	 
                                posted by <?php echo anchor('user/'.$ntask->profile_name,ucfirst($ntask->first_name).' '.ucfirst(substr($ntask->last_name,0,1)).'.','class="fpass"');?> for <?php echo anchor('user/'.$worker_detail->profile_name,ucfirst($worker_detail->first_name).' '.ucfirst(substr($worker_detail->last_name,0,1)).'.','class="fpass"');?> and needs to be assigned by <?php echo $task_end_date.', '.$task_end_hour;	?>
                
            
                                
								
								<?php } 
								
								if($ntask->task_activity_status==0 && $ntask->task_auto_assignment!=3) { ?>
                                
                                                                
                
 posted by <?php echo anchor('user/'.$ntask->profile_name,ucfirst($ntask->first_name).' '.ucfirst(substr($ntask->last_name,0,1)).'.','class="fpass"');?> and needs to be assigned by <?php echo $task_end_date.', '.$task_end_hour;	?>
 
 
 
<?php } 

if(($ntask->task_activity_status==1 || $ntask->task_activity_status==2 || $ntask->task_activity_status==3) && $ntask->task_worker_id>0) 
{ 
		$worker_detail=$this->worker_model->get_worker_info($ntask->task_worker_id);
?>

is getting done. <?php echo anchor('user/'.$worker_detail->profile_name,ucfirst($worker_detail->first_name).' '.ucfirst(substr($worker_detail->last_name,0,1)).'.','class="fpass"');?> is helping out <?php echo anchor('user/'.$ntask->profile_name,ucfirst($ntask->first_name).' '.ucfirst(substr($ntask->last_name,0,1)).'.','class="fpass"');?>


<?php } ?>

 
</div>
   
   
 <div class="geo">about <?php echo getDuration($task_post_date); ?></div>
     
     
                             </div>
                            
                           
                            
                            
                              <?php echo anchor('task/update_task_step_zero/'.$ntask->task_id.'/copy','<b>Post Similat Task </b>',' id="copynewtask_'.$ntask->task_id.'" class="cm temp" ');?>
                           
                           
                             <script type="text/javascript">
								jQuery(document).ready(function() {	
									jQuery("#copynewtask_<?php echo $ntask->task_id;?>").fancybox();	
								});
						</script>
                            <div class="clear"></div>
                        </li>
                        
                        
                        <?php } ?>
                       
                     
                     
                     
                    </ul>
                    <?php echo anchor('search/newest','See more',' class="seemore_sel"');?>
                    
                    <?php } else { ?>
                    
                    <ul><li style="color:#000000; font-weight:bold;">No new task added in last 24 hours.</li></ul>
                    
                    <?php } ?>
                    
                    
                    
                    <div class="clear"></div>
                    
                    
                </div>		
			</div>
			
			

		</div>
       
 <!-- tab end-->
</div>              
     
                
		</div>   
