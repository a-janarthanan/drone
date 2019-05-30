
<div class="main">
<div class="incon">
    	<div class="mconleft">

<?php if($msg!='') { ?>

	<div id="success">
					<ul>
<?php if($msg=='password_change') { ?>

<p>Successfully changed your password!</p>

<?php } ?>

</ul></div>
<?php } ?>


<?php


$site_setting=site_setting(); 
$data['site_setting']=$site_setting;

?>

  <div class="padT10B20">
           <div id="s1postJ"><?php echo $user_info->first_name.' '.$user_info->last_name; ?></div>
          
          	<div class="marTB10">
	            <h3 id="detail-bg1"><div class="fl">Account Information</div><div class="fr"><?php echo anchor('user/edit','Edit','class="Aedit unl"'); ?></div><div class="clear"></div></h3>   

                <ul class="Acul1">
                    <li><span class="about">Name :</span> <?php echo $user_info->first_name.' '.$user_info->last_name; ?></li>
                    <li><span class="about">Email :</span>  <a href="mailto:<?php echo $user_info->email; ?>" class="fpass"><?php echo $user_info->email; ?></a></li>
                    <li><span class="about">Zip code :</span> <span class="fpass"><?php if($user_info->zip_code=='') { echo anchor('user/edit','add','class="fpass"'); } else { echo $user_info->zip_code; } ?></span></li>
                    <li><span class="about">Mobile phone :</span> <?php if($user_info->mobile_no=='') { echo anchor('user/edit','add','class="fpass"'); } else { ?>  <span class="fpass"><?php echo $user_info->mobile_no; ?> </span> <?php } ?></li>
                </ul>           
			</div>           
                


<div class="marTB10">
	            <h3 id="detail-bg1"><div class="fl">Location</div><div class="fr"><?php echo anchor('user_other/locations','Edit','class="Aedit unl"');?></div><div class="clear"></div></h3>  
   
			<?php if($location) {	?>
            <table width="100%" border="0" cellspacing="1" cellpadding="5">
           
           <?php foreach($location as $loc) {  ?>
           
              <tr>
                <td width="8%"><img src="<?php echo base_url().getThemeName(); ?>/images/loc_pin.png" alt="" /></td>
                <td width="92%">
					 <?php                       
							echo '<b>'.$loc->location_name.'</b><br/>';
					   
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
            <?php }  ?> 
                
</div>      




<?php  $t_setting = twitter_setting();	
            
         $f_setting = facebook_setting();	
			   
			   
			   
 if($f_setting->facebook_login_enable == '1' ||  $t_setting->twitter_login_enable == '1') { ?>
                         

<div class="marTB10">
	            <h3 id="detail-bg1" >Connected Websites</h3>
                <div class="padT10B20">
                
                
                <?php
				
		if($f_setting->facebook_login_enable == '1'){
		
		
			$data = array(
				'facebook'		=> $this->fb_connect->fb,
				'fbSession'		=> $this->fb_connect->fbSession,
				'user'			=> $this->fb_connect->user,
				'uid'			=> $this->fb_connect->user_id,
				'fbLogoutURL'	=> $this->fb_connect->fbLogoutURL,
				'fbLoginURL'	=> $this->fb_connect->fbLoginURL,	
				'base_url'		=> site_url('home/facebook'),
				'appkey'		=> $this->fb_connect->appkey,
			);
	
	if($user_info->fb_id != '' && $user_info->fb_id !=0) {
		
		echo anchor('home/remove_fb','<img src="'.base_url().getThemeName().'/images/fb.png" class="marB_3 marR5"  alt="Remove Facebook Connection" />Remove Facebook Connection','class="fbtn"');       
              } else {
	
		 echo anchor($data['fbLoginURL'],'<img src="'.base_url().getThemeName().'/images/fb.png" class="marB_3 marR5" alt="Make Facebook Connection" />Make Facebook Connection','class="fbtn"');        
 
	 } 

	}  if($t_setting->twitter_login_enable == '1'){
	
		
		
		echo "&nbsp;&nbsp;";
		
		if($user_info->tw_id != '' && $user_info->tw_id !=0) {
	
		echo anchor('home/remove_tw','<img src="'.base_url().getThemeName().'/images/twi.png" class="marB_3 marR5"  alt="Remove Twitter Connection" />Remove Twitter Connection','class="fbtn"');       
              } else {
		
		 echo anchor('home/twitter_auth','<img src="'.base_url().getThemeName().'/images/twi.png" class="marB_3 marR5" alt="Make Twitter Connection" />Make Twitter Connection','class="fbtn"');        
 
	 } 
	 
	 
	
	
	}
	
	
	
	

?>

</div>
</div>            


 <?php } ?>
 
 

<div class="marTB10">
	            <h3 id="detail-bg1">Live Activity Feed</h3> 
                

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
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $custom_msg.' '.$site_setting->site_name;?>"><?php echo $custom_msg; ?></a>
                             
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
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $custom_msg.' '.$site_setting->site_name;?>"><?php echo $custom_msg; ?></a>
                             
                             <?php } } ?>
                                    
                            </div>
                            <div class="abtb2info">
                            	<?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="abmarks unl"'); ?>
                                <div class="colmark padTB3">has signed up to be a Runner! Time to get moving.</div>
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
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $key_id.' '.$site_setting->site_name;?>"><?php echo $key_id; ?></a>
                             
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
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $key_id.' '.$site_setting->site_name;?>"><?php echo $key_id; ?></a>
                             
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
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $key_id.' '.$site_setting->site_name;?>"><?php echo $key_id; ?></a>
                             
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
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $key_id.' '.$site_setting->site_name;?>"><?php echo $key_id; ?></a>
                             
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
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $worker_level.' '.$site_setting->site_name;?>"><?php echo $worker_level; ?></a>
                             
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
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $worker_level.' '.$site_setting->site_name;?>"><?php echo $worker_level; ?></a>
                             
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
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $key_id.' '.$site_setting->site_name;?>"><?php echo $key_id; ?></a>
                             
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
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $key_id.' '.$site_setting->site_name;?>"><?php echo $key_id; ?></a>
                             
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
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $comment_level.' '.$site_setting->site_name;?>"><?php echo $comment_level; ?></a>
                             
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
							
							 <a id="twooneanj" rel="tooltip" title="Level <?php echo $key_id.' '.$site_setting->site_name;?>"><?php echo $key_id; ?></a>  
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
							
							 <a id="twoonebr1" rel="tooltip" title="Level <?php echo $comment_level.' '.$site_setting->site_name;?>"><?php echo $comment_level; ?></a>
                             
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
							
							 <a id="twooneanj" rel="tooltip" title="Level <?php echo $key_id.' '.$site_setting->site_name;?>"><?php echo $key_id; ?></a>  
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
               <div><?php echo anchor('user/'.$user_info->profile_name.'/activities/','See more',' class="seemore_sel"');?></div>    
                
</div>                


            
            
         
  </div>      
                
                
		</div>
        
        <?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
		
        
        
    </div>
</div>

