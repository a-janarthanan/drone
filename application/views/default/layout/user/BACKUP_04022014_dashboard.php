<link rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/js/lib/themes/base/jquery.ui.all.css">
<script type="text/javascript">

	jQuery(function() {
		jQuery("#tabs").tabs();	
		jQuery("#pupload2").fancybox();	
		 jQuery("#sprogress").fancybox();    
	});


</script>

<?php 	$site_setting=site_setting(); ?>
<div class="main">
<div class="incon">
    	<div class="mconleft">
                
               <div id="welcome">Welcome, <?php echo $this->session->userdata('full_name'); ?></div>
				<div id="welcome1"></div>
                
                
                
<div class="padT10B20">
                                <div class="btleft posrel">
									<div class="btitbg">BROWSE TASKS</div>
                                    
<div class="brmenu" id="brmenu">
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
</div>                                    
                                </div>
                     <script type="text/javascript">
						jQuery(function($) {           
                                jQuery("#selmycity2").fancybox();
							});
					</script>
                                <div class="btright">
                                <table width="100%" border="0" cellspacing="1" cellpadding="5">
                                  <tr><td><img src="<?php echo base_url().getThemeName(); ?>/images/usa.png" alt="" /></td></tr>
                                  <tr><td><div id="city">To get started, <span>please choose your City</span></div></td></tr>
                                  <tr><td align="center"><?php echo anchor('pick_city','Choose a City',' id="selmycity2" class="ncitybg marTB10"');?></td></tr>
                                </table>
                              
                                </div>
                                <div class="clear"></div>
                            </div>                
                
                
                
                
                

<script type="text/javascript">
function remove_div2(e)
{
	var pid=e.parentNode;
	var i = pid.parentNode;
	i.style.display="none";
}
</script>                  
              
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
                
<div class="padT10">                
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
        <div class="mconright">
<script type="text/javascript">
function remove_divhidertab(e)
{
var pid=e.parentNode;
var i = pid.parentNode;
i.style.display="none";
}
</script>



<div class="adpro" style="width:280px; ">
<ul>

<?php $profile_complete=user_profile_complete(); ?>



<li style="border:none;">
<div id="adid"><?php echo $this->session->userdata('full_name'); ?>.</div>
<div class="marTB5"><?php echo anchor('user/'.getUserProfileName(),'<b>View profile</b>','class="fpass"'); ?></div>



<div style="position:relative;" >
<div class="gry_bar"><div class="hyper1n" ><div class="grn_bar" style="width:<?php echo $profile_complete; ?>%;"></div></div></div>


<div style="position:absolute; top:5px; left:6px; color:#FFF;" >
Your profile is <?php echo anchor('user/complete_profile/',$profile_complete.' % complete','class="fpass" id="sprogress" style="color:#FFF;"'); ?></div>

</div>
<br />



<br />
  
    <ul>
		<?php $allmessage = $this->message_model->get_message_by_id();
        
            if($allmessage){
			
			echo anchor('message','<b class="fs15 enri">Alerts('.get_user_unread_notification().')</b>','class="fpass"');
			
                foreach($allmessage as $res){
				
					$act=$res->act;
									
						if($res->is_read == 1 ) { $color = '#000000;'; } else { $color = '#27668B;'; }
						
						$poster = $this->message_model->get_worker_details($res->poster_user_id);
						
						
						$user_image= base_url().'upload/no_image.png';
				 
						 if($poster->profile_image!='') {  
					
							if(file_exists(base_path().'upload/user/'.$poster->profile_image)) {
						
								$user_image=base_url().'upload/user/'.$poster->profile_image;
								
							}
							
						}
						
						
						switch ($act)
						{
							case 'newoffer': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />New offer has been posted on <strong class="colblue fsNorm">'.$res->task_name.'</strong> by <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'newmessage': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />New message from <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> on <strong class="colblue fsNorm">'.$res->task_name.'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'offeraccept': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />Your offer accepted by <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> on <strong class="colblue fsNorm">'.$res->task_name.'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'taskcomplete': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" /><strong class="colblue fsNorm">'.$res->task_name.'</strong> has been marked completed by <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'taskfinish': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" /><strong class="colblue fsNorm">'.$res->task_name.'</strong> is all finished by  <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'workerwallet': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />Payment for <strong class="colblue fsNorm">'.$res->task_name.'</strong> has been credited to your wallet</p>','style="color:'.$color.'"').'<div class="clear"></div></li>';
							break;
							
							case 'taskdispute':  echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" /><strong class="colblue fsNorm">'.$res->task_name.'</strong> has been disputed by  <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'newconversation': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />New Conversation message from <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> on <strong class="colblue fsNorm">'.$res->task_name.'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'taskdisputeconversation': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />New Dispute Conversation message from <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> on <strong class="colblue fsNorm">'.$res->task_name.'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							 
							  
							  
							  	case 'taskwin': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />You won the dispute <strong>'.$res->task_name.'</strong>. Amount credited to your wallet.</p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 							
							break;
							
							case 'taskloss': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />You loss the dispute <strong>'.$res->task_name.'</strong>. Amount credited to <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 																	
							break;
							
							case 'taskcompromise': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" /><strong>'.$res->task_name.'</strong> is compromised between Poster and Runner. Amount credited to your wallet. </p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 																	
							break;
							
							case 'taskresume': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />Your dispute task <strong>'.$res->task_name.'</strong> is resume.</p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 																	
							break;
							 
							 
							 
							  
							  case 'taskassign': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />Your offer accepted on <strong>'.$res->task_name.'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
	break;



							
							default:
                                        
						
						
					}
					
					
                
                }
			}
        ?>
    </ul> <br />
    <?php if($allmessage){ echo anchor('message','More...','class="chbg"');  } ?>
    
    
    
    
</li>






<li>
<div class="uyp"><h3>Upload your profile picture</h3>
<a class="hidertab" href="javascript:void();" onclick="remove_divhidertab(this)"><img src="<?php echo base_url().getThemeName(); ?>/images/close.png" alt="Close"></a>
<div class="clear"></div>
</div>
<div class="trf padB10"><h4>Runners feel better about working with you when they can see your face.</h4><div class="imgst"><img src="<?php echo base_url().getThemeName(); ?>/images/dig_pic.png" width="94" height="94" alt="" /></div><div class="clear"></div>
</div>


<div class="padB5"><?php echo anchor('user/upload_photo/dashboard','<b>Upload a photo</b>',' id="pupload2" class="chbg fs14"');?></div>



</li>
<li>
<div class="uyp"><h3>View Tasks with our new Task Map!</h3>
<a class="hidertab" href="javascript:void();" onclick="remove_divhidertab(this)"><img src="<?php echo base_url().getThemeName(); ?>/images/close.png" alt="Close"></a>

<div class="clear"></div>
</div>
<div class="trf padB10"><h4>Want a way to see all the current Tasks on a fun map?</h4><div class="imgst"><img src="<?php echo base_url().getThemeName(); ?>/images/vmap.png" height="94" width="94" alt="" /></div><div class="clear"></div>
</div>

<div class="padB5"><?php echo anchor('map/','<b>View the Task Map</b>',' class="chbg fs14"');?></div>


</li>


   <?php $check_worker_detail=$this->worker_model->check_user_worker_detail(get_authenticateUserID());
					
					if(!$check_worker_detail) { 
                    ?>

<li>
<div class="uyp"><h3>Want to become a Runner?</h3>
<a class="hidertab" href="javascript:void();" onclick="remove_divhidertab(this)"><img src="<?php echo base_url().getThemeName(); ?>/images/close.png" alt="Close"></a>

<div class="clear"></div>
</div>
<div class="trf padB10"><h4>Think you've got what it takes to hop to Tasks and join the ranks of our friendly neighborhood Runners?</h4><div class="imgst"><img src="<?php echo base_url().getThemeName(); ?>/images/medal1.png" width="94" height="94" alt="" /></div><div class="clear"></div>
</div>

<div class="padB5"><?php echo anchor('who-are-the-taskers','<b>Apply to be a Runner</b>','class="chbg"');?></div>

</li>


<?php } ?>



</ul>


</div>









<div class="marB20 marT10">


<?php if($map_tasklists) {

$user_current_city_id= getCurrentCity();

$city_latlong=get_cityDetail($user_current_city_id);


if($city_latlong)
	{
		$city_latitude = $city_latlong->city_latitude;
		$city_longitude = $city_latlong->city_longitude;
	}
	else
	{
			$city_latitude = DEFAULT_CITY_LAT;
		$city_longitude =	DEFAULT_CITY_LANG;
	}
	
	
	}
	else
	{
			$city_latitude = DEFAULT_CITY_LAT;
		$city_longitude =	DEFAULT_CITY_LANG;
	}
	

 ?>

<script type="text/javascript" src="http://www.google.com/jsapi?key=<?php echo GOOGLE_MAP_KEY;?>"></script>
   
  
   
       
		<script type="text/javascript">
			google.load("maps", "2.x");
			
			var city_lat='<?php echo $city_latitude;?>';
			var city_lang='<?php echo $city_longitude;?>';
			
		</script>
        
		<link href="<?php echo base_url().getThemeName(); ?>/js/map/tooltipv2.css">
        
		<style type="text/css" media="screen">
			#map {  width:280px; height:253px; }			
			#add-point { float:left; }
		
			#markerList { display:none; float:right; height:500px; overflow:scroll; width:25%;}
			#markerList dl { list-style:none;  }
			
		</style>
 

<script>	
	function loadMap(){
	
	
		var baseUrl='<?php echo base_url(); ?>';
		var baseThemeUrl='<?php echo base_url().getThemeName(); ?>';
		
		
		if(!GBrowserIsCompatible()){
			alert('Sorry, the Google Maps API is not compatible with this browser.');
			return;
		}else{
			createMap();
	
		
			
				
			<?php 
			
			if($map_tasklists) {
			
				foreach($map_tasklists as $tasklist){ 
				
				$taskid = $tasklist->task_id;
				$task_url_name = $tasklist->task_url_name;
				$userid = $tasklist->user_id;
				
			
				$location ='';
				
					$task_map_location=get_map_task_location($taskid);
				
				if($task_map_location!='')
				{
					
					$location=$task_map_location;
					
					
						
						
						
				
			
			?>
			
				var content1;	
			
			var location = '<?php echo $location;?>';
			

			var taskname = '<?php echo str_replace("'",'',$tasklist->task_name);?>';
							 content1 = {
									el:'li',att:{id:'lipanel'},ch:[{el:'div',att:{id:'panel'},ch:[	
										{
											el:'div',att:{id:'leftPane1'},ch:[{
											//el:'a',att:{href:baseUrl+'category/task/<?php //echo $taskid;?>'},ch:[{
											el:'img',att:{src:baseThemeUrl+'/images/per.jpg',width:'50',height:'50',border:'0'}
										}]
										//}]
										},{el:'div',att:{id:'rightPane1'},ch:[{
											el:'a',att:{href:baseUrl+'tasks/<?php echo $task_url_name;?>'},ch:[{
											txt:taskname}] },{el:'br'},{txt:'Tasks of this type: <?php echo $site_setting->currency_symbol.$tasklist->task_price;?>'}]
										}
									]}]
								};	

					var pin_icon_img= baseThemeUrl+'/js/map/blue_star.png';
							
					mapmake(map,location,baseUrl+'tasks/<?php echo $task_url_name;?>',baseThemeUrl+'/images/per.jpg',taskname,'Click for more details',content1,'','',pin_icon_img);	
						
						
						<?php   	
				}
			}  
		} ?>   						
										
		//	lii.innerHTML=oTbl;
		}
	}
</script>

<br />
<br />

		
		<div class=""><ul id="markerList" style="border:1px solid #CCC; margin-top:5px;"></ul></div>
        <div id="map"></div>
		<div id="message"></div>
        
        <script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/map/globals.js"></script>
		<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/map/Tooltip.v2.js"></script>
         <script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/map/eshapes.js"></script>
		<script type="text/javascript" >
		
		
		/**
 * @author Marco Alionso Ramirez, marco@onemarco.com
 * @url http://onemarco.com
 * This code is public domain
 */

//load and unload the map

GEvent.addDomListener(window,'load',loadMap);
GEvent.addDomListener(window,'unload',GUnload);

var map ;
//check for google maps compatibility, if so, load xml
//create map icon and sidebar
function createMap(){
	
	map = new GMap2(document.getElementById('map'));
	map.setCenter(new GLatLng(city_lat,city_lang),12);
	//map.addControl(new GMapTypeControl());
	//map.addControl(new GLargeMapControl());
	
	 
	
	}
	
	function mapmake(map,addres,map_listing_url,imagee,txt1,txt2,labell,mlat,mlang,pin_icon_img)
	{
	
		if(pin_icon_img=='')
		{
			pin_icon_img="marker.png";
		}
	
	var icon = new GIcon();
	icon.image = pin_icon_img;
	icon.shadow = "marker_shadow.png";
	icon.iconSize = new GSize(30, 38);
	icon.shadowSize = new GSize(30, 27);
	icon.iconAnchor = new GPoint(10, 25);
	icon.infoWindowAnchor = new GPoint(10, 0);
	icon.infoShadowAnchor = new GPoint(23, 13);

	//var icon = G_DEFAULT_ICON;
	
	var sidebarList = document.getElementById('markerList');
	
	var content = {
		el:'dl',ch:[
			{el:'dt',ch:[
				{txt:'University of Washington'}
			]},
			{el:'dd',ch:[
				{txt:'I graduated from this university in 2006.'}
			]}
		]
	};
	
	/*var spaceNeedleContent = {
		el:'img',att:{src:'images/index2.jpg',width:'82',height:'150'}
	}*/
	
	var content1 = {
		el:'dl',ch:[{el:'dt',ch:[{el:'a',att:{href:map_listing_url},ch:[{
											txt:txt1}]  }]},
			{
				//el:'img',att:{src:imagee,width:'50',height:'50'}
			},{el:'dt',ch:[
				{txt:txt2}
			]}
		]
	};
		
var geo = new GClientGeocoder();		
geo.getLocations(addres, function(addresses){
    if(addresses.Status.code != 200){
      //alert("D'oh!\n " + query);
	  return;
    }else{
     // marker = pin_||createMarker();
      var result = addresses.Placemark[0];
	  var lat = result.Point.coordinates[1];
      var lng = result.Point.coordinates[0];
		//alert(lat+'fgfgfgf'+lng);
		
		
		
		 // === Filled Circle ===
      //var point = new GLatLng(lat,lng);
     //map.addOverlay(GPolygon.Circle(point,1000,"#009FBB",1,1,"#79EBFF",0.3));
	  
	  
	  
		if(mlat=='' || mlang=='')
		{
			
	  		createMarker(map,lat, lng,labell,icon,content1,sidebarList);
		}
		else
		{
			createMarker(map,mlat,mlang,labell,icon,content1,sidebarList);
		}
	//  createMarker(map,lat, lng,'The Space Needle',icon,spaceNeedleContent,sidebarList);

	  }
	  }
	  );

	}

//create the marker
function createMarker(map,lat,lng,title,icon,content,list){
	
	var marker = new GMarker(new GLatLng(lat,lng),{icon:icon});
	 map.addOverlay(marker);
	marker.tooltip = new Tooltip(marker,jsonToDom(content),5);
	createTab(marker,content);
	marker.isInfoWindowOpen = true;
	
//	var sidebarLink = jsonToDom({el:'li',ch:[{txt:'University of Washington'}]});

//var sidebarLink = jsonToDom({el:'li',ch:[{el:'table',ch:[{el:'tr',ch:[{el:'td',ch:[{txt:'University of Washington'}]}]}]}]});
//alert(sidebarLink.innerHTML)
	//list.appendChild(sidebarLink);
	
	var sidebarLink =jsonToDom(title);
	//alert(sidebarLink.innerHTML)
	list.appendChild(sidebarLink);
    //var theBR = document.createElement('br');

	//list.appendChild(theBR);
	
	
	var ttmover = GEvent.callbackArgs(marker,tooltipMouseover,sidebarLink);
	var ttmout = GEvent.callbackArgs(marker,tooltipMouseout,sidebarLink);
	var mclick = GEvent.callback(marker,markerClick);
	
	//GEvent.addDomListener(sidebarLink,'mouseover',ttmover);
	GEvent.addDomListener(sidebarLink,'mouseover',mclick);
	GEvent.addDomListener(sidebarLink,'mouseout',ttmout);
	GEvent.addDomListener(sidebarLink,'click',mclick);	
	
	
	//GEvent.addListener(marker,'mouseover',ttmover);
	//GEvent.addListener(marker,'mouseout',ttmout);	
	
	GEvent.addListener(marker,'mouseover',mclick);
	GEvent.addListener(marker,'mouseout',ttmout);	
	GEvent.addListener(marker,'click',mclick);
	
	
	
	GEvent.addListener(marker,'infowindowopen',GEvent.callbackArgs(marker,infoWindowOpen,sidebarLink));
	GEvent.addListener(marker,'infowindowclose',GEvent.callbackArgs(marker,infoWindowClose,sidebarLink));
	
	map.addOverlay(marker);	
	map.addOverlay(marker.tooltip);
	map.setCenter(marker.getPoint());
	
	return marker;
}

//create the tab(s) for the GInfoWindow
function createTab(marker,content){
	var element = jsonToDom(
		{el:'div',att:{Class:'googleMarkerTab'},ch:[
			{el:'div',att:{Class:'content'},ch:[
				content
			]}
		]});
	marker.tab = [new GInfoWindowTab('Address',element)];
}

//makrer,sidebar mouseover handler
function tooltipMouseover(sidebarLink){
	if(!(this.isInfoWindowOpen) && !(this.isHidden())){
		this.tooltip.show();
	}
}

//marker,sidebar mouseout handler
function tooltipMouseout(sidebarLink){
	this.tooltip.hide();
}

//marker click handler
function markerClick(){
	this.tooltip.hide();
	this.openInfoWindowTabs(this.tab);
}

//infowindowopen handler
function infoWindowOpen(sidebarLink){
	this.isInfoWindowOpen = true;	
}

//infowindowclose handler
function infoWindowClose(sidebarLink){
	this.isInfoWindowOpen = false;
}
</script>
   
        <!----map--->

    

</div>



</div>


        <div class="clear"></div>



    </div>
</div>