
<link rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/js/lib/themes/base/jquery.ui.all.css">
<script type="text/javascript">


	$(function() {
		$("#tabs").tabs();		
	});

jQuery(document).ready(function() {

/**/
   $("a.link1").mouseover(function () {
    $("#roboho1").show("fast");
    });

	$("a.link1").mouseout(function () {
    $("#roboho1").hide("fast");
    });

  	$("a.link2").mouseover(function () {
    $("#roboho2").show("fast");
    });

	$("a.link2").mouseout(function () {
    $("#roboho2").hide("fast");
    });

  	$("a.link3").mouseover(function () {
    $("#roboho3").show("fast");
    });

	$("a.link3").mouseout(function () {
    $("#roboho3").hide("fast");
    });
  	$("a.link4").mouseover(function () {
    $("#roboho4").show("fast");
    });

	$("a.link4").mouseout(function () {
    $("#roboho4").hide("fast");
    });
/**/



	
});




function un_favorite(id)
{
	
		var strURL='<?php echo base_url().'user/un_favorite/';?>'+id;
		var xmlhttp;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  
		  }
		xmlhttp.onreadystatechange=function()
		  {
			 
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{	
			///alert(xmlhttp.responseText);
				if(xmlhttp.responseText=='login_failed')
				{
					window.location.href='<?php echo base_url().'sign_up/'; ?>';				
				}
				else
				{
					document.getElementById("favorite").innerHTML=xmlhttp.responseText;
				}		
			}
		  }
		xmlhttp.open("GET",strURL,true);
		xmlhttp.send();
}

function make_favorite(id)
{
		var strURL='<?php echo base_url().'user/make_favorite/';?>'+id;
		var xmlhttp;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  
		  }
		xmlhttp.onreadystatechange=function()
		  {
			 
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{	
			//alert(xmlhttp.responseText);
				if(xmlhttp.responseText=='login_failed')
				{
					window.location.href='<?php echo base_url().'sign_up/'; ?>';				
				}
				else
				{
					document.getElementById("favorite").innerHTML=xmlhttp.responseText;
				}		
			}
		  }
		xmlhttp.open("GET",strURL,true);
		xmlhttp.send();
}

</script>

<?php


$site_setting=site_setting(); 
$data['site_setting']=$site_setting;

$data['reviews']=$reviews;
$data['user_profile']=$user_profile;

?>

<div class="main">
	<div class="incon">
    
    
           
            
            
		<div class="mconleft">

            
            

				<div class="marB20">
                <div class="imgleft"  style="position:relative;">
                  
                    <?php
					
					if($user_profile->profile_image!='') {  
					
						if(file_exists(base_path().'upload/user/'.$user_profile->profile_image)) { ?>
                        
                        <img src="<?php echo base_url(); ?>upload/user/<?php echo $user_profile->profile_image;?>" width="72" height="72" alt="" class="fl"  />
                        
                        <?php } else { ?>
                        
                  <img src="<?php echo base_url(); ?>upload/no_image.png" width="72" height="72" alt="" class="fl"  />
                    
                    <?php } } else { ?>
                    
                    <img src="<?php echo base_url(); ?>upload/no_image.png" width="72" height="72" alt="" class="fl"  />
                    
                    <?php } ?>
                    
                 
                  
                     <?php $check_worker_detail=$this->worker_model->check_user_worker_detail($user_profile->user_id);
					
					if($check_worker_detail) { 
                    ?>
                      
                        <a rel="tooltip" id="twoone1br" title="Level <?php echo $check_worker_detail->worker_level;?> Worker bee"><?php echo $check_worker_detail->worker_level;?></a>

                    <?php } ?>   
                    
                    
                 
                    
                    
                    
                </div>
                <div class="areanm" style="width:294px;">
                <div><a href="#" class="abtmove"><?php echo $user_profile->first_name.' '.substr($user_profile->last_name,0,1); ?></a></div>
                   
                  <?php if($check_worker_detail) { 
				  
				  		$worker_cities=$this->worker_model->get_worker_cities($check_worker_detail->worker_id);
						
				  if($worker_cities) { ?>
                  <div>
                  <?php $city_list='';
				  
				   foreach($worker_cities as $wc) {   
                   
				   $city_list .=ucfirst($wc->city_name).',';
				   
                   }  
				   
				   echo substr($city_list,0,-1); 
				   
				   ?>
                   </div>
                   <?php } else { ?>
                   
                    <span class="req"><?php  if($user_profile->current_city>0) { echo getCityName($user_profile->current_city); } ?></span>
                    

<?php } } else { ?>
                    <span class="req"><?php  if($user_profile->current_city>0) { echo getCityName($user_profile->current_city); } ?></span>
                    
                    
                 <?php } 
				 
				 
			 if($check_worker_detail) { 
			 
			  $worker_transportation_detail='';
			  
			 $types=$check_worker_detail->worker_transportation;
			 
			 if($types!='') { 
			 
			
			 
			 $ex_type=explode(',',$types);
			 
			 foreach($ex_type as $type) 
			 {
				
				 $get_transportation=get_transportation_detail($type);
				 
				 if($get_transportation)
				 {
					 if(isset($get_transportation->name)) { 
					  $worker_transportation_detail .=$get_transportation->name.',';
					  }
				}
				 
				
			}
			?>
            
            <div class="marT5"><?php if($worker_transportation_detail!='') { echo "I do Tasks: ". substr($worker_transportation_detail,0,-1); } ?></div>
			
		<?php 	}
			
			
			
			} ?>

                    
                    
                </div>
                <div class="areaface">
                       
					   <?php if(get_authenticateUserID()=='') { ?>
                           <div id="favorite">
                            <input name="" type="submit" class="favbtnbg" onClick="make_favorite(<?php echo $user_profile->user_id;?>)" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add as Favourite" />
                            </div>
                            
                            <?php } elseif(get_authenticateUserID()==$user_profile->user_id) { 
							
							echo anchor('account','Edit Name &amp; Account','class="profile_edit_link"') ;
							
							} else { 
							
							
							
							 if($check_worker_detail) { 
							 
							 
							$chk_login_user_favorite=check_user_favorite($user_profile->user_id);
							
							if($chk_login_user_favorite) {
							?>
                            <div id="favorite">
                              <input name="" type="submit" class="myfavbtnbg" onClick="un_favorite(<?php echo $user_profile->user_id;?>)" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; My Favourite" />
                              </div>
                            
                            <?php } else { ?>
                            
                            <div id="favorite">
                              <input name="" type="submit" class="favbtnbg" onClick="make_favorite(<?php echo $user_profile->user_id;?>)" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add as Favourite" />
                            </div>
                            
                            <?php }  } 	} ?> 
                       
                        <div style="float:left;">
                        <style type="text/css">
						.fr { float:left; padding-left:5px; }
						.areaface { width:246px; } 
						</style>
                        
                        
                        <?php if($user_profile->own_site_link!='') { ?>
                        
                        <a href="<?php echo $user_profile->own_site_link; ?>" target="_blank"><img src="<?php echo base_url().getThemeName(); ?>/images/home.png" alt="" width="30" height="30" class="fr" /></a>
                        <?php } if($user_profile->facebook_link!='') { ?>
                        <a href="<?php echo $user_profile->facebook_link; ?>" target="_blank"><img src="<?php echo base_url().getThemeName(); ?>/images/fb_p.png" alt="" width="30" height="30" class="fr" /></a> 		
						<?php } if($user_profile->twitter_link!='') { ?>
                         <a href="<?php echo $user_profile->twitter_link; ?>" target="_blank"><img src="<?php echo base_url().getThemeName(); ?>/images/twitter_p.png" alt="" width="30" height="30" class="fr" /></a>
                         <?php } if($user_profile->linkedin_link!='') { ?>
                         
                         <a href="<?php echo $user_profile->linkedin_link; ?>" target="_blank"><img src="<?php echo base_url().getThemeName(); ?>/images/linkedin.png" alt="" width="30" height="30" class="fr" /></a>
                         <?php }if($user_profile->youtube_link!='') { ?>
                         
                         <a href="<?php echo $user_profile->youtube_link; ?>" target="_blank"><img src="<?php echo base_url().getThemeName(); ?>/images/youtube.png" alt="" width="30" height="30" class="fr" /></a>
                         <?php } if($user_profile->yelp_link!='') { ?>
                         
                        
                            <a href="<?php echo $user_profile->yelp_link; ?>" target="_blank"><img src="<?php echo base_url().getThemeName(); ?>/images/yelp.png" alt="" width="30" height="30" class="fr" /></a>  
                         <?php } if($user_profile->blog_link!='') { ?>
                         
                         <a href="<?php echo $user_profile->blog_link; ?>" target="_blank"><img src="<?php echo base_url().getThemeName(); ?>/images/rss.png" alt="" width="30" height="30" class="fr" /></a>	
                         <?php } ?>
                         
                         </div>
                         
                         
                            
                              
                </div>
                
                  

                <div class="clear"></div>
				</div>
                
             

<!-- tab s-->
<div  id="tabs">
			<ul>
			
				<li><a href="#tabs-1"><img src="<?php echo base_url().getThemeName(); ?>/images/recent_act.png" alt="" /> Recent Activity</a></li>
				<li><a href="#tabs-3"><img src="<?php echo base_url().getThemeName(); ?>/images/review-star.png" alt="" /> Reviews</a></li>	
			</ul>
			<!--<div class="clear"></div>
            <div class="bgline"></div>-->
            
            
			
			
			<div id="tabs-1">
				<div class="abttb2">
                	<ul>
                    
                    
	   <?php //echo "<pre>"; print_r($activities);
       
       
       
       
       if($activities) {  
       
            foreach($activities as $res)
            {
            
				
				$act=$res->act;
				
				
				$activity_name = $res->activity_name;
				$activity_url_name = $res->activity_url_name;
				$activity_date  = getDuration($res->activity_date);
				$key_id =$res->key_id;
				$profile_user_url_name = $res->profile_user_url_name;
				
				
				if(substr_count($res->profile_user_name,' ')>=1)
				{
					$ex_name=explode(' ',$res->profile_user_name);
				
					$user_name=ucfirst($ex_name[0]).' ';
					
					if(isset($ex_name[1])) 
					{				
						$user_name .= substr(ucfirst($ex_name[1]),0,1).'.';				
					}
				
				}
				else
				{
					$user_name=$res->profile_user_name;
				}
				
				
				$profile_user_name = $user_name;
				$profile_user_image = $res->profile_user_image;
				$custom_msg =  $res->custom_msg;
				$custom_msg2 = $res->custom_msg2;
			
			
				
				switch ($act)
				{
						case 'signup':
						  
						  ?>
						  	<li class="posrel">
                            <div class="abc">
                                   <?php 
								   
								   
							$user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />'); 
							
							
							if(isset($custom_msg)) { if($custom_msg!='') { ?>
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $custom_msg;?> Worker bee"><?php echo $custom_msg; ?></a>
                             
                             <?php } } ?>
                                    
                            </div>
                            <div class="abtb2info">
                            	<?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="abmarks unl"'); ?>
                                <div class="colmark padTB3">Welcome!</div>
                              	<div class="geo"><?php echo $activity_date; ?></div>
                            </div>
                            
                           
                            <div class="clear"></div>
                        </li>
						  
						  
						<?php  
						  
						  break;
						  
						  
						  
						  case 'workersignup':
						  
						  ?>
						  	<li class="posrel">
                            <div class="abc">
                                   <?php 
								   
								   
							$user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />'); 
							
							
							if(isset($custom_msg)) { if($custom_msg!='') { ?>
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $custom_msg;?> Worker bee"><?php echo $custom_msg; ?></a>
                             
                             <?php } } ?>
                                    
                            </div>
                            <div class="abtb2info">
                            	<?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="abmarks unl"'); ?>
                                <div class="colmark padTB3">has signed up to be a Worker bee! Time to get moving.</div>
                              	<div class="geo"><?php echo $activity_date; ?></div>
                            </div>
                            
                           
                            <div class="clear"></div>
                        </li>
						  
						  
						<?php  
						  
						  break;
						  
						case 'posttask':
						 
						 ?>
						 
						 <li class="posrel">
                            <div class="abc">
                                    <?php 
								   
								   
							$user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />'); 
							
							
							if(isset($key_id)) { if($key_id!='') {
													
							 ?>
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $key_id;?> Worker bee"><?php echo $key_id; ?></a>
                             
                             <?php } } ?>
                                    
                            </div>
                            <div class="abtb2info">
                            	<?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="abmarks unl"'); ?>
                                <div class="colmark padTB3">posted by <?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="colgreen"'); 
                                
                              
                                
                                
                                
							if(isset($custom_msg)) { if($custom_msg!='') {
							
							$worker_level=0;
							$worker_name='';
							$worker_profile_url='';
							
								if(substr_count($custom_msg,',')>=1)
								{
									$ex_worker=explode(',',$custom_msg);
									
									
									if(isset($ex_worker[0])) 
									{
										$worker_profile_url=$ex_worker[0];
									}
									
									
										$worker_name=ucfirst($ex_worker[1]).' ';
										
										if(isset($ex_worker[2])) 
										{				
											$worker_name .= substr(ucfirst($ex_worker[2]),0,1).'.';				
										}
																										
									
								}
								
								if($worker_name!='' && $worker_profile_url!='') 
								{ 
								
									echo 'for '.anchor('user/'.$worker_profile_url,$worker_name,'class="colgreen"');
								
								}
								
								
						}   }
						?>
                                
                                 and needs to be assigned by <?php 
								
								
								$task_start_day=0;
								$task_start_time=0;
								
								
								if(isset($custom_msg2)) { 
								
									
									if(substr_count($custom_msg2,',')>=1)
									{
										$ex_date=explode(',',$custom_msg2);
									
										$task_start_day=$ex_date[0];
										
										if(isset($ex_date[1])) 
										{				
											$task_start_time = $ex_date[1];				
										}
									
									}
									
				
								}
								
								echo getDuration(date('Y-m-d',strtotime(date("Y-m-d", strtotime($res->activity_date)) . " +".$task_start_day."days")).'-'.date('H',mktime(0,$task_start_time,0,0,0,0)));	?></div>
                              	<div class="geo"><?php echo $activity_date; ?></div>
                            </div>
                            
                          <!--  <a href="javascript:void();" class="cm chbg"><b>Use Template</b></a>-->
	                         
                            <div class="clear"></div>
                        </li>
						 
						 
						 <?php
						 
						  break;
						  
						  case 'workerposttask':
						 ?>
                         
                         
                         <li class="posrel">
                            <div class="abc">
                                    <?php 
								   
								   
							$user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />'); 
							
							
							if(isset($key_id)) { if($key_id!='') {
													
							 ?>
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $key_id;?> Worker bee"><?php echo $key_id; ?></a>
                             
                             <?php } } ?>
                                    
                            </div>
                            <div class="abtb2info">
                            	<?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="abmarks unl"'); ?>
                                <div class="colmark padTB3">posted by <?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="colgreen"'); 
                                
                              
                                
                                
                                
							if(isset($custom_msg)) { if($custom_msg!='') {
							
							$worker_level=0;
							$worker_name='';
							$worker_profile_url='';
							
								if(substr_count($custom_msg,',')>=1)
								{
									$ex_worker=explode(',',$custom_msg);
									
									
									if(isset($ex_worker[0])) 
									{
										$worker_profile_url=$ex_worker[0];
									}
									
									
										$worker_name=ucfirst($ex_worker[1]).' ';
										
										if(isset($ex_worker[2])) 
										{				
											$worker_name .= substr(ucfirst($ex_worker[2]),0,1).'.';				
										}
																										
									
								}
								
								if($worker_name!='' && $worker_profile_url!='') 
								{ 
								
									echo 'for '.anchor('user/'.$worker_profile_url,$worker_name,'class="colgreen"');
								
								}
								
								
						}   }
						?>
                                
                                 and needs to be assigned by <?php 
								
								
								$task_start_day=0;
								$task_start_time=0;
								
								
								if(isset($custom_msg2)) { 
								
									
									if(substr_count($custom_msg2,',')>=1)
									{
										$ex_date=explode(',',$custom_msg2);
									
										$task_start_day=$ex_date[0];
										
										if(isset($ex_date[1])) 
										{				
											$task_start_time = $ex_date[1];				
										}
									
									}
									
				
								}
								
								echo getDuration(date('Y-m-d',strtotime(date("Y-m-d", strtotime($res->activity_date)) . " +".$task_start_day."days")).'-'.date('H',mktime(0,$task_start_time,0,0,0,0)));	?></div>
                              	<div class="geo"><?php echo $activity_date; ?></div>
                            </div>
                            
                          <!--  <a href="javascript:void();" class="cm chbg"><b>Use Template</b></a>-->
	                         
                            <div class="clear"></div>
                        </li>
                         
                         <?php
						  break;
						  
						case 'assigntask':
						
						?>
                        
						<li class="posrel">
                            <div class="abc">
                                    <?php 
								   
								   
							$user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />'); 
							
							
							if(isset($key_id)) { if($key_id!='') {
													
							 ?>
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $key_id;?> Worker bee"><?php echo $key_id; ?></a>
                             
                             <?php } } ?>
                                    
                            </div>
                            <div class="abtb2info">
                            	<?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,' class="abmarks unl"'); ?>
                                <div class="colmark padTB3">accepted the offer from <?php 
                              
                                
                                
                                
							if(isset($custom_msg)) { if($custom_msg!='') {
							
							$worker_level=0;
							$worker_name='';
							$worker_profile_url='';
							
								if(substr_count($custom_msg,',')>=1)
								{
									$ex_worker=explode(',',$custom_msg);
									
									
									if(isset($ex_worker[0])) 
									{
										$worker_profile_url=$ex_worker[0];
									}
									
									
										$worker_name=ucfirst($ex_worker[1]).' ';
										
										if(isset($ex_worker[2])) 
										{				
											$worker_name .= substr(ucfirst($ex_worker[2]),0,1).'.';				
										}
																										
									
								}
								
								if($worker_name!='' && $worker_profile_url!='') 
								{ 
								
									echo anchor('user/'.$worker_profile_url,$worker_name,'class="colgreen"');
								
								}
								
								
						}   }
						?>
                                
                                 for  <?php
								 
								 echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),'class="colgreen"');  
								
									?></div>
                              	<div class="geo"><?php echo $activity_date; ?></div>
                            </div>
                            
                          <!--  <a href="javascript:void();" class="cm chbg"><b>Use Template</b></a>-->
	                         
                            <div class="clear"></div>
                        </li>
						
						
						
						<?php
						  break;
						  
						case 'workerassigntask':
						?>
                        
                        
                        <li class="posrel">
                            <div class="abc">
                                    <?php 
								   
								   
							$user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />'); 
							
							
							if(isset($key_id)) { if($key_id!='') {
													
							 ?>
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $key_id;?> Worker bee"><?php echo $key_id; ?></a>
                             
                             <?php } } ?>
                                    
                            </div>
                            <div class="abtb2info">
                            	<?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,' class="abmarks unl"'); ?>
                                <div class="colmark padTB3">accepted the offer from <?php 
                              
                                
                                
                                
							if(isset($custom_msg)) { if($custom_msg!='') {
							
							$worker_level=0;
							$worker_name='';
							$worker_profile_url='';
							
								if(substr_count($custom_msg,',')>=1)
								{
									$ex_worker=explode(',',$custom_msg);
									
									
									if(isset($ex_worker[0])) 
									{
										$worker_profile_url=$ex_worker[0];
									}
									
									
										$worker_name=ucfirst($ex_worker[1]).' ';
										
										if(isset($ex_worker[2])) 
										{				
											$worker_name .= substr(ucfirst($ex_worker[2]),0,1).'.';				
										}
																										
									
								}
								
								if($worker_name!='' && $worker_profile_url!='') 
								{ 
								
									echo anchor('user/'.$worker_profile_url,$worker_name,'class="colgreen"');
								
								}
								
								
						}   }
						?>
                                
                                 for  <?php
								 
								 echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),'class="colgreen"');  
								
									?></div>
                              	<div class="geo"><?php echo $activity_date; ?></div>
                            </div>
                            
                          <!--  <a href="javascript:void();" class="cm chbg"><b>Use Template</b></a>-->
	                         
                            <div class="clear"></div>
                        </li>
                        
                        <?php
						  break;
						  
						case 'completetask':
						?>
                        
                        
                        <li class="posrel">
                            <div class="abc">
                                    <?php 
								   
								   
							$user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />'); 
							
							
							if(isset($custom_msg)) { if($custom_msg!='') {
							
							$worker_level=0;
							
								if(substr_count($custom_msg,',')>=1)
								{
									$ex_worker=explode(',',$custom_msg);
									
									
									if(isset($ex_worker[4])) 
									{
										$worker_level=$ex_worker[4];
									}								
								}
													
							 ?>
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $worker_level;?> Worker bee"><?php echo $worker_level; ?></a>
                             
                             <?php } } ?>
                                    
                            </div>
                            <div class="abtb2info">
                            	<?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="abmarks unl"'); ?>
                                <div class="colmark padTB3">has been marked completed by <?php 
                              
                                
                            echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="colgreen"');
							
						?>
                                
                               </div>
                              	<div class="geo"><?php echo $activity_date; ?></div>
                            </div>
                            
                          <!--  <a href="javascript:void();" class="cm chbg"><b>Use Template</b></a>-->
	                         
                            <div class="clear"></div>
                        </li>
                        
                        <?php
						  break;
						  
						case 'workercompletetask':
						?>
                        
                        <li class="posrel">
                            <div class="abc">
                                    <?php 
								   
								   
							$user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />'); 
							
							
							if(isset($custom_msg)) { if($custom_msg!='') {
							
							$worker_level=0;
							
								if(substr_count($custom_msg,',')>=1)
								{
									$ex_worker=explode(',',$custom_msg);
									
									
									if(isset($ex_worker[4])) 
									{
										$worker_level=$ex_worker[4];
									}								
								}
													
							 ?>
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $worker_level;?> Worker bee"><?php echo $worker_level; ?></a>
                             
                             <?php } } ?>
                                    
                            </div>
                            <div class="abtb2info">
                            	<?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="abmarks unl"'); ?>
                                <div class="colmark padTB3">has been marked completed by <?php 
                              
                                
                            echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="colgreen"');
							
						?>
                                
                               </div>
                              	<div class="geo"><?php echo $activity_date; ?></div>
                            </div>
                            
                          <!--  <a href="javascript:void();" class="cm chbg"><b>Use Template</b></a>-->
	                         
                            <div class="clear"></div>
                        </li>
                        
                        <?php
						  break;
						  
						
						case 'finishtask':
					
					?>
					
					
					<li class="posrel">
                            <div class="abc">
                                    <?php 
								   
								   
							$user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />'); 
							
							
								if(isset($key_id)) { if($key_id!='') {
													
							 ?>
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $key_id;?> Worker bee"><?php echo $key_id; ?></a>
                             
                             <?php } } ?>
                                    
                            </div>
                            <div class="abtb2info">
                            	<?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="abmarks unl"'); ?>
                                <div class="colmark padTB3">has been finished by <?php 
                              	if(isset($custom_msg)) { if($custom_msg!='') {
							
							$worker_level=0;
							$worker_name='';
							$worker_profile_url='';
							
								if(substr_count($custom_msg,',')>=1)
								{
									$ex_worker=explode(',',$custom_msg);
									
									
									if(isset($ex_worker[0])) 
									{
										$worker_profile_url=$ex_worker[0];
									}
									
									
										$worker_name=ucfirst($ex_worker[1]).' ';
										
										if(isset($ex_worker[2])) 
										{				
											$worker_name .= substr(ucfirst($ex_worker[2]),0,1).'.';				
										}
																										
									
								}
								
								if($worker_name!='' && $worker_profile_url!='') 
								{ 
								
									echo anchor('user/'.$worker_profile_url,$worker_name,'class="colgreen"');
								
								}
								
								
						}   }
							
						?>
                                
                               </div>
                              	<div class="geo"><?php echo $activity_date; ?></div>
                            </div>
                            
                          <!--  <a href="javascript:void();" class="cm chbg"><b>Use Template</b></a>-->
	                         
                            <div class="clear"></div>
                        </li>
					
					
                    <?php
					
						  break;
						  
						case 'workerfinishtask':
						?>
                        
                        <li class="posrel">
                            <div class="abc">
                                    <?php 
								   
								   
							$user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />'); 
							
							
								if(isset($key_id)) { if($key_id!='') {
													
							 ?>
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $key_id;?> Worker bee"><?php echo $key_id; ?></a>
                             
                             <?php } } ?>
                                    
                            </div>
                            <div class="abtb2info">
                            	<?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="abmarks unl"'); ?>
                                <div class="colmark padTB3">has been finished by <?php 
                              	if(isset($custom_msg)) { if($custom_msg!='') {
							
							$worker_level=0;
							$worker_name='';
							$worker_profile_url='';
							
								if(substr_count($custom_msg,',')>=1)
								{
									$ex_worker=explode(',',$custom_msg);
									
									
									if(isset($ex_worker[0])) 
									{
										$worker_profile_url=$ex_worker[0];
									}
									
									
										$worker_name=ucfirst($ex_worker[1]).' ';
										
										if(isset($ex_worker[2])) 
										{				
											$worker_name .= substr(ucfirst($ex_worker[2]),0,1).'.';				
										}
																										
									
								}
								
								if($worker_name!='' && $worker_profile_url!='') 
								{ 
								
									echo anchor('user/'.$worker_profile_url,$worker_name,'class="colgreen"');
								
								}
								
								
						}   }
							
						?>
                                
                               </div>
                              	<div class="geo"><?php echo $activity_date; ?></div>
                            </div>
                            
                          <!--  <a href="javascript:void();" class="cm chbg"><b>Use Template</b></a>-->
	                         
                            <div class="clear"></div>
                        </li>
                        
                        <?php
						  break;
						  
						case 'newcomment':
						?>
                        
                        <li class="posrel">
                <div class="abc">
              
              
              
              
                   <?php 
								   
						if(isset($custom_msg)) { if($custom_msg!='') {
							
							$comment_level='';
							$comment_name='';
							$comment_profile_url='';
							$comment_user_image= base_url().'upload/no_image.png';
							
								if(substr_count($custom_msg,',')>=1)
								{
									$ex_comment=explode(',',$custom_msg);
									
									
									if(isset($ex_comment[0])) 
									{
										$comment_profile_url=$ex_comment[0];
									}
									
									
										$comment_name=ucfirst($ex_comment[1]).' ';
										
										if(isset($ex_comment[2])) 
										{				
											$comment_name .= substr(ucfirst($ex_comment[2]),0,1).'.';				
										}
										
										
										
										if(isset($ex_comment[3])) 
										{				
											 if($ex_comment[3]!='') {  
						
												if(file_exists(base_path().'upload/user/'.$ex_comment[3])) {
											
													$comment_user_image=base_url().'upload/user/'.$ex_comment[3];
													
												}
												
											}			
										}
										
										
										
										if(isset($ex_comment[4])) 
										{
											$comment_level=$ex_comment[4];
										}
										
										
																										
									
								}
								
								
										   
							
 
							
							
							
							
							echo anchor('user/'.$comment_profile_url,'<img src="'.$comment_user_image.'" alt="" width="50" height="50" />'); 
							
							
							if(isset($comment_level)) { if($comment_level!='') {
													
							 ?>
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $comment_level;?> Worker bee"><?php echo $comment_level; ?></a>
                             
                             <?php }  }   
							 
							 
							 
							 }} ?>
                                    
              
              
              
              
                </div>
                
                <div class="abtb2info">
                
                <div><span class="newrep">New comment on</span> <?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="unl abmarks"');?></div>
                
                <div class="posrel marTB10">
                <div class="fl wid30">
               
               <?php
               
               $user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" width="30" height="30" />'); 
                         
						 
						  	if(isset($key_id)) { if($key_id!='') {
													
							 ?>
							
							 <a id="twooneanj" rel="tooltip" title="Level <?php echo $key_id;?> Worker bee"><?php echo $key_id; ?></a>  
                             <?php }  } ?>
                
                
                
                
                </div>
                <div class="fr wid350 marL5" >
                <?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="fpass"');?><br/>
                <p><?php echo $custom_msg2; ?></p>
                </div>
                <div class="clear"></div>
                </div>
                <div class="geo"><?php echo $activity_date; ?></div>
                </div>
               <!-- <a href="javascript:void();" class="cm chbg"><b>Use Template</b></a>-->
                <div class="clear"></div>
                </li>
                        
                        
                        <?php
						  break;
						  
						case 'newreply':
					?>
                    
                    <li class="posrel">
                <div class="abc">
              
              
              
              
                   <?php 
								   
						if(isset($custom_msg)) { if($custom_msg!='') {
							
							$comment_level='';
							$comment_name='';
							$comment_profile_url='';
							$comment_user_image= base_url().'upload/no_image.png';
							
								if(substr_count($custom_msg,',')>=1)
								{
									$ex_comment=explode(',',$custom_msg);
									
									
									if(isset($ex_comment[0])) 
									{
										$comment_profile_url=$ex_comment[0];
									}
									
									
										$comment_name=ucfirst($ex_comment[1]).' ';
										
										if(isset($ex_comment[2])) 
										{				
											$comment_name .= substr(ucfirst($ex_comment[2]),0,1).'.';				
										}
										
										
										
										if(isset($ex_comment[3])) 
										{				
											 if($ex_comment[3]!='') {  
						
												if(file_exists(base_path().'upload/user/'.$ex_comment[3])) {
											
													$comment_user_image=base_url().'upload/user/'.$ex_comment[3];
													
												}
												
											}			
										}
										
										
										
										if(isset($ex_comment[4])) 
										{
											$comment_level=$ex_comment[4];
										}
										
										
																										
									
								}
								
								
										   
							
 
							
							
							
							
							echo anchor('user/'.$comment_profile_url,'<img src="'.$comment_user_image.'" alt="" width="50" height="50" />'); 
							
							
							if(isset($comment_level)) { if($comment_level!='') {
													
							 ?>
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $comment_level;?> Worker bee"><?php echo $comment_level; ?></a>
                             
                             <?php }  }   
							 
							 
							 
							 }} ?>
                                    
              
              
              
              
                </div>
                
                <div class="abtb2info">
                
                <div><span class="newrep">New reply on</span> <?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="unl abmarks"');?></div>
                
                <div class="posrel marTB10">
                <div class="fl wid30">
               
               <?php
               
               $user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" width="30" height="30" />'); 
                         
						 
						  	if(isset($key_id)) { if($key_id!='') {
													
							 ?>
							
							 <a id="twooneanj" rel="tooltip" title="Level <?php echo $key_id;?> Worker bee"><?php echo $key_id; ?></a>  
                             <?php }  } ?>
                
                
                
                
                </div>
                <div class="fr wid350 marL5" >
                <?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="fpass"');?><br/>
                <p><?php echo $custom_msg2; ?></p>
                </div>
                <div class="clear"></div>
                </div>
                <div class="geo"><?php echo $activity_date; ?></div>
                </div>
               <!-- <a href="javascript:void();" class="cm chbg"><b>Use Template</b></a>-->
                <div class="clear"></div>
                </li>
                
                <?php
						  break;
						  
						
						default:
						 // echo "No number between 1 and 3";
				}
				
				
		   
       ?>
    
    
    
    
    
    <?php }
    
    } ?>
    
                  

  	
                        
                    	
                    	

                    	
            		</ul>
                   
                   
                    <div>
					
					
					 <?php if($total_rows>$limit) { ?>
					<div class="gonext">
                    <?php echo $page_link; ?>
                    </div>
				<?php } ?>
                
                
				</div>
                    
                    
                    
                    
                    
                    <div class="clear"></div>
                </div>		
			</div>
			
			<div id="tabs-3">
				<div class="abttb3">
                	<ul>
                    
                    <?php if($reviews) { 
					
					
							foreach($reviews as $review) { 
							
							
							
							 $user_image= base_url().'upload/no_image.png';
							 
							 if($review->profile_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$review->profile_image)) {
							
									$user_image=base_url().'upload/user/'.$review->profile_image;
									
								}
								
							}
						
						
						
						
						?>
                            
                    	<li>
                            <div class="abc">
                            
                            
                            <?php echo anchor('user/'.$review->profile_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />'); ?>
                            
                            
                            </div>
                            <div class="abct3rig">
                            	<div class="revfor">Review for <?php echo anchor('tasks/'.$review->task_url_name,ucfirst($review->task_name),' class="unl"'); ?></div>
                              
                                <div class="strmn"><div class="str_sel" style="width:<?php if($review->comment_rate>5) { ?>100<?php } else { echo $review->comment_rate*2;?>0<?php } ?>%;"></div></div>
                                	<div class="strig">
                                        <div id="very"><b><?php echo $review->task_comment; ?></b></div>
                                     
                                	</div>
                                    
                                     <div class="clear"></div>
                                     <div class="geo">about <?php echo getDuration($review->comment_date); ?></div>
                                     
                                     
                                </div>    
                                    
                            
                            <div class="clear"></div>
                        </li>
                        
                    	
                        <?php }
						
					 } ?>
                     
            		</ul>

					<div><?php echo anchor('user/'.$user_profile->profile_name.'/reviews/','See more',' class="seemore_sel"');?></div>
                    <div class="clear"></div>
                    
 	                </div>	
                   
                  
                    
			</div>
			

		</div>
        
        
        
        

        <div class="clear"></div>
<!-- tab end -->

                
		</div>
        
        
         <?php  echo $this->load->view($theme.'/layout/user/profile_sidebar',$data); ?>


    </div>
</div>