<?php


$site_setting=site_setting(); 
$data['site_setting']=$site_setting;

?>
<style>
.seemore_sel{ float:right;}
</style>
<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
<div>

<div class="red-subtitle top-red-subtitle"><?php echo $user_info->first_name.' '.$user_info->last_name; ?></div>
<div class="profile_back">
<div class="container">
<div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
<div class="home-signpost-content">
<div class="dbleft dbleft-main">

<?php if($msg!='') { ?>

	<div id="success">
					<ul>
<?php if($msg=='password_change') { ?>

<p>Successfully changed your password!</p>

<?php } ?>

</ul></div>
<?php } ?>




  <div class="padB20">
          	<div class="marB10">
	            <div class="inside-subtitle">Information om konto <?php echo anchor('user/edit','Redigera','class="btn btn-default btn-edit fr"');?></div>   
				<div class="account-det">
                    <div class="fleft100">
                        <div class="acc-subtitle acc-subtitle-1"><div class="acc-subtitle-1-title fl">Namn:</div> <?php echo $user_info->first_name.' '.$user_info->last_name; ?></div>
                    </div>
                    <div class="fleft100 mtop5">
                        <div class="acc-subtitle acc-subtitle-1"><div class="acc-subtitle-1-title fl">E-mail:</div> <a href="mailto:<?php echo $user_info->email; ?>" class="fpass"><?php echo $user_info->email; ?></a></div>
                    </div>
                    <div class="fleft100 mtop5">
                        <div class="acc-subtitle acc-subtitle-1"><div class="acc-subtitle-1-title fl">Postkod: </div><?php if($user_info->zip_code=='') { echo anchor('user/edit','add','class="fpass"'); } else { echo $user_info->zip_code; } ?></div>
                    </div>
                    <div class="fleft100 mtop5">
                        <div class="acc-subtitle acc-subtitle-1"><div class="acc-subtitle-1-title fl">Telefon: </div><?php echo $user_info->mobile_no; ?></div>
                    </div>          
                </div>
			</div>           
                


<!--<div class="marTB10">
	            <h3 id="detail-bg1"><div class="fl">Location</div><div class="fr"><?php echo anchor('user_other/locations','Edit','class="Aedit unl"');?></div><div class="clear"></div></h3>  -->
                <div class="space-bte"></div>
                <div class="inside-subtitle">Plats <?php echo anchor('user_other/locations','Redigera','class="btn btn-default btn-edit fr"');?></div>
   
			<?php if($location) {	?>
            <div class="fleft100">
            <table width="100%" border="0" cellspacing="1" cellpadding="5">
           
           <?php foreach($location as $loc) {  ?>
           
              <tr>
                <td width="5%" style="text-align:center;"><img src="<?php echo base_url().getThemeName(); ?>/images/loc_pin.png" alt="" /></td>
                <td width="92%" style="color:#565656; font-size:14px; padding-bottom:5px;">
					 <?php                       
							echo '<b style="color:#333; font-size:16px;">'.$loc->location_name.'</b><br/>';
					   
							$address= $loc->location_address;
							$city = $loc->location_city;
							$state = $loc->location_state;
							$zipcode = $loc->location_zipcode;
							
							if($address != '') { echo $address.', ';} 
							if($city != '') { echo $city.', ';}
							if($state != '') { echo $state.', ';}
							if($zipcode != '') { echo $zipcode;}						
                    ?>
               </td>
              </tr>
              
              <?php } ?>
   			</table>  
            </div>
            <?php }  ?> 
                
</div>      

<!--<div class="marTB10">
	           <div class="inside-subtitle">Live Activity Feed</div>
                
<div class="fleft100">
<ul class="ulsty">


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
                            <div class="taskphoto taskphoto-2">
                                   <?php 
								   
								   
							$user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" class="round-corner" width="50" height="50" />'); 
							
							
							if(isset($custom_msg)) { if($custom_msg!='') { ?>
							
							 <a class="tooltip tooltip-2" id="twoonebr1">Level <?php echo $custom_msg;?><span>Level <?php echo $custom_msg.' '.$site_setting->site_name; ?></span></a>
                             
                             <?php } } ?>
                                    
                            </div>
                            <div class="taskdetails">
                            	<?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="abmarks abmarks-2 unl"'); ?>
                                <div class="colmark colmark-2 padTB3">Welcome!</div>
                              	<div class="geo geo-2"><?php echo $activity_date; ?></div>
                            </div>
                            
                           
                            <div class="clear"></div>
                        </li>
						  
						  
						<?php  
						  
						  break;
						  
						  
						  
						  case 'workersignup':
						  
						  ?>
						  	<li class="posrel">
                            <div class="taskphoto taskphoto-2">
                                   <?php 
								   
								   
							$user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" class="round-corner" width="50" height="50" />'); 
							
							
							if(isset($custom_msg)) { if($custom_msg!='') { ?>
							
                            <a class="tooltip tooltip-2" id="twoonebr1">Level <?php echo $custom_msg;?><span>Level <?php echo $custom_msg.' '.$site_setting->site_name; ?></span></a>	
                                
                             
                             <?php } } ?>
                                    
                            </div>
                            <div class="taskdetails">
                            	<?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="abmarks abmarks-2 unl"'); ?>
                                <div class="colmark colmark-2 padTB3">has signed up to be a TASKIT Time to get moving.</div>
                              	<div class="geo geo-2"><?php echo $activity_date; ?></div>
                            </div>
                            
                           
                            <div class="clear"></div>
                        </li>
						  
						  
						<?php  
						  
						  break;
						  
						case 'posttask':
						 
						 ?>
						 
						 <li class="posrel">
                            <div class="taskphoto taskphoto-2">
                                    <?php 
								   
								   
							$user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" class="round-corner" width="50" height="50" />'); 
							
							
							if(isset($key_id)) { if($key_id!='') {
													
							 ?>
							
                            <a class="tooltip tooltip-2" id="twoonebr1">Level <?php echo $key_id;?><span>Level <?php echo $key_id.' '.$site_setting->site_name; ?></span></a>
							 
                             
                             <?php } } ?>
                                    
                            </div>
                            <div class="taskdetails">
                            	<?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="abmarks abmarks-2 unl"'); ?>
                                <div class="colmark colmark-2 padTB3">posted by <?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="colgreen"'); 
                                
                              
                                
                                
                                
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
                                
                                 expires in <?php 
								
								
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
                              	<div class="geo geo-2"><?php echo $activity_date; ?></div>
                            </div>
                            
                         
	                         
                            <div class="clear"></div>
                        </li>
						 
						 
						 <?php
						 
						  break;
						  
						  case 'workerposttask':
						 ?>
                         
                         
                         <li class="posrel">
                            <div class="taskphoto taskphoto-2">
                                    <?php 
								   
								   
							$user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" class="round-corner" width="50" height="50" />'); 
							
							
							if(isset($key_id)) { if($key_id!='') {
													
							 ?>
							<a class="tooltip tooltip-2" id="twoonebr1">Level <?php echo $key_id;?><span>Level <?php echo $key_id.' '.$site_setting->site_name; ?></span></a>
                             
                             <?php } } ?>
                                    
                            </div>
                            <div class="taskdetails">
                            	<?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="abmarks abmarks-2 unl"'); ?>
                                <div class="colmark colmark-2 padTB3">posted by <?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="colgreen"'); 
                                
                              
                                
                                
                                
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
                              	<div class="geo geo-2"><?php echo $activity_date; ?></div>
                            </div>
                            
                          
	                         
                            <div class="clear"></div>
                        </li>
                         
                         <?php
						  break;
						  
						case 'assigntask':
						
						?>
                        
						<li class="posrel">
                            <div class="taskphoto taskphoto-2">
                                    <?php 
								   
								   
							$user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" class="round-corner" alt="" width="50" height="50" />'); 
							
							
							if(isset($key_id)) { if($key_id!='') {
													
							 ?>
							<a class="tooltip tooltip-2" id="twoonebr1">Level <?php echo $key_id;?><span>Level <?php echo $key_id.' '.$site_setting->site_name; ?></span></a>
                             
                             <?php } } ?>
                                    
                            </div>
                            <div class="taskdetails">
                            	<?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,' class="abmarks abmarks-2 unl"'); ?>
                                <div class="colmark colmark-2 padTB3">accepted the offer from <?php 
                              
                                
                                
                                
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
                              	<div class="geo geo-2"><?php echo $activity_date; ?></div>
                            </div>
                            
                             
                            <div class="clear"></div>
                        </li>
						
						
						
						<?php
						  break;
						  
						case 'workerassigntask':
						?>
                        
                        
                        <li class="posrel">
                            <div class="taskphoto taskphoto-2">
                                    <?php 
								   
								   
							$user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" class="round-corner" alt="" width="50" height="50" />'); 
							
							
							if(isset($key_id)) { if($key_id!='') {
													
							 ?>
							<a class="tooltip tooltip-2" id="twoonebr1">Level <?php echo $key_id;?><span>Level <?php echo $key_id.' '.$site_setting->site_name; ?></span></a>
                             
                             <?php } } ?>
                                    
                            </div>
                            <div class="taskdetails">
                            	<?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,' class="abmarks abmarks-2 unl"'); ?>
                                <div class="colmark colmark-2 padTB3">accepted the offer from <?php 
                              
                                
                                
                                
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
                              	<div class="geo geo-2"><?php echo $activity_date; ?></div>
                            </div>
                            
                         
	                         
                            <div class="clear"></div>
                        </li>
                        
                        <?php
						  break;
						  
						case 'completetask':
						?>
                        
                        
                        <li class="posrel">
                            <div class="taskphoto taskphoto-2">
                                    <?php 
								   
								   
							$user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" class="round-corner" alt="" width="50" height="50" />'); 
							
							
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
							<a class="tooltip tooltip-2" id="twoonebr1">Level <?php echo $worker_level;?><span>Level <?php echo $worker_level.' '.$site_setting->site_name; ?></span></a>
							 
                             
                             <?php } } ?>
                                    
                            </div>
                            <div class="taskdetails">
                            	<?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="abmarks abmarks-2 unl"'); ?>
                                <div class="colmark colmark-2 padTB3">has been marked completed by <?php 
                              
                                
                            echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="colgreen"');
							
						?>
                                
                               </div>
                              	<div class="geo geo-2"><?php echo $activity_date; ?></div>
                            </div>
                            
                          
	                         
                            <div class="clear"></div>
                        </li>
                        
                        <?php
						  break;
						  
						case 'workercompletetask':
						?>
                        
                        <li class="posrel">
                            <div class="taskphoto taskphoto-2">
                                    <?php 
								   
								   
							$user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" class="round-corner" alt="" width="50" height="50" />'); 
							
							
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
							<a class="tooltip tooltip-2" id="twoonebr1">Level <?php echo $worker_level;?><span>Level <?php echo $worker_level.' '.$site_setting->site_name; ?></span></a>
                             
                             <?php } } ?>
                                    
                            </div>
                            <div class="taskdetails">
                            	<?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="abmarks abmarks-2 unl"'); ?>
                                <div class="colmark colmark-2 padTB3">has been marked completed by <?php 
                              
                                
                            echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="colgreen"');
							
						?>
                                
                               </div>
                              	<div class="geo geo-2"><?php echo $activity_date; ?></div>
                            </div>
                            
                         
	                         
                            <div class="clear"></div>
                        </li>
                        
                        <?php
						  break;
						  
						
						case 'finishtask':
					
					?>
					
					
					<li class="posrel">
                            <div class="taskphoto taskphoto-2">
                                    <?php 
								   
								   
							$user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" class="round-corner" alt="" width="50" height="50" />'); 
							
							
								if(isset($key_id)) { if($key_id!='') {
													
							 ?>
							<a class="tooltip tooltip-2" id="twoonebr1">Level <?php echo $key_id;?><span>Level <?php echo $key_id.' '.$site_setting->site_name; ?></span></a>
                             
                             <?php } } ?>
                                    
                            </div>
                            <div class="taskdetails">
                            	<?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="abmarks abmarks-2 unl"'); ?>
                                <div class="colmark colmark-2 padTB3">has been finished by <?php 
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
                              	<div class="geo geo-2"><?php echo $activity_date; ?></div>
                            </div>
                            
                        
	                         
                            <div class="clear"></div>
                        </li>
					
					
                    <?php
					
						  break;
						  
						case 'workerfinishtask':
						?>
                        
                        <li class="posrel">
                            <div class="taskphoto taskphoto-2">
                                    <?php 
								   
								   
							$user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" class="round-corner" alt="" width="50" height="50" />'); 
							
							
								if(isset($key_id)) { if($key_id!='') {
													
							 ?>
							<a class="tooltip tooltip-2" id="twoonebr1">Level <?php echo $key_id;?><span>Level <?php echo $key_id.' '.$site_setting->site_name; ?></span></a>
                             
                             <?php } } ?>
                                    
                            </div>
                            <div class="taskdetails">
                            	<?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="abmarks abmarks-2 unl"'); ?>
                                <div class="colmark colmark-2 padTB3">has been finished by <?php 
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
                              	<div class="geo geo-2"><?php echo $activity_date; ?></div>
                            </div>
                            
                         
	                         
                            <div class="clear"></div>
                        </li>
                        
                        <?php
						  break;
						  
						case 'newcomment':
						?>
                        
                        <li class="posrel">
                <div class="taskphoto taskphoto-2">
              
              
              
              
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
								
								
										   
							
 
							
							
							
							
							echo anchor('user/'.$comment_profile_url,'<img src="'.$comment_user_image.'" class="round-corner" alt="" width="50" height="50" />'); 
							
							
							if(isset($comment_level)) { if($comment_level!='') {
													
							 ?>
							<a class="tooltip tooltip-2" id="twoonebr1">Level <?php echo $comment_level;?><span>Level <?php echo $comment_level.' '.$site_setting->site_name; ?></span></a>
                             
                             <?php }  }   
							 
							 
							 
							 }} ?>
                                    
              
              
              
              
                </div>
                
                <div class="taskdetails">
                
                <div><span class="newrep">New comment on</span> <?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="unl abmarks abmarks-2"');?></div>
                
                <div class="posrel marTB10 abttb2-2-2">
                <div class="taskphoto taskphoto-2">
               
               <?php
               
               $user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" class="round-corner" alt="" width="50" height="50" />'); 
                         
						 
						  	if(isset($key_id)) { if($key_id!='') {
													
							 ?>
							<a class="tooltip tooltip-2" id="twooneanj">Level <?php echo $key_id;?><span>Level <?php echo $key_id.' '.$site_setting->site_name; ?></span></a>
                             <?php }  } ?>
                
                
                
                
                </div>
                <div class="wid350 marL5" style="padding-left:50px;" >
                <?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="abmarks abmarks-2 unl"');?><br/>
                <p class="colmark colmark-2"><?php echo $custom_msg2; ?></p>
                <div class="geo geo-2"><?php echo $activity_date; ?></div>
                </div>
                <div class="clear"></div>
                </div>
                
                </div>
               
                <div class="clear"></div>
                </li>
                        
                        
                        <?php
						  break;
						  
						case 'newreply':
					?>
                    
                    <li class="posrel">
                <div class="taskphoto taskphoto-2">
              
              
              
              
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
								
								
										   
							
 
							
							
							
							
							echo anchor('user/'.$comment_profile_url,'<img src="'.$comment_user_image.'" class="round-corner" alt="" width="50" height="50" />'); 
							
							
							if(isset($comment_level)) { if($comment_level!='') {
													
							 ?>
							<a class="tooltip tooltip-2" id="twoonebr1">Level <?php echo $comment_level;?><span>Level <?php echo $comment_level.' '.$site_setting->site_name; ?></span></a>
                             
                             <?php }  }   
							 
							 
							 
							 }} ?>
                                    
              
              
              
              
                </div>
                
                <div class="taskdetails">
                
                <div><span class="newrep">New reply on</span> <?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="unl abmarks abmarks-2"');?></div>
                
                <div class="posrel marTB10 abttb2-2-2">
                <div class="taskphoto taskphoto-2">
               
               <?php
               
               $user_image= base_url().'upload/no_image.png';
 
							 if($profile_user_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
							
									$user_image=base_url().'upload/user/'.$profile_user_image;
									
								}
								
							}
							
							
							
							echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" class="round-corner" alt="" width="50" height="50" />'); 
                         
						 
						  	if(isset($key_id)) { if($key_id!='') {
													
							 ?>
							<a class="tooltip tooltip-2" id="twooneanj">Level <?php echo $key_id;?><span>Level <?php echo $key_id.' '.$site_setting->site_name; ?></span></a>
							
                             <?php }  } ?>
                
                
                
                
                </div>
                <div class="wid350 marL5" style="padding-left:50px;"  >
                <?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="abmarks abmarks-2 unl"');?><br/>
                <p class="colmark colmark-2"><?php echo $custom_msg2; ?></p>
                <div class="geo geo-2"><?php echo $activity_date; ?></div>
                </div>
                <div class="clear"></div>
                </div>
                
                </div>
               
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
                    </div>
               <div style="text-align:center;"><?php echo anchor('user/'.$user_info->profile_name.'/activities/','See more',' class="btn btn-default btn-default-see-more"');?></div>    
                
</div>-->                


            
            
         
  </div>      
                
                
		</div>
<div class="dbright-task dbright-task-main">        
        <?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
		
</div>       
   </div>
</div>
<div class="clear"></div>     
    </div>
</div>

