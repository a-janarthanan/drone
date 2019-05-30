

<div id="content" align="center">

 	

	<div align="left" class="column half" style="width:60%;">
		<div class="box">
			<h2 class="box-header"><?php echo anchor(front_base_url().'tasks/'.$row->task_url_name,ucfirst($row->task_name),' style="color:#004C7A;" target="_blank"'); ?></h2> 
			<div class="box-content">
			
			 <?php if($row){?>
           
			  <table class="tablebox" border="0" cellpadding="5" cellspacing="3">
                  <tbody class="tbody">
                      
                      
                      
                        <tr>
                          <td style="text-align:left;"><label class="form-label">Task Category </label></td>
                          <td style="text-align:left;">: <?php echo get_category_name($row->task_category_id);?></td>
                      </tr>
                      <tr>
                          <td style="text-align:left;"><label class="form-label">Posted in City </label></td>
                          <td style="text-align:left;">: <?php echo get_city_name($row->task_city_id);?></td>
                      </tr>
                 
                 	
                      <tr>
                          <td style="text-align:left;"><label class="form-label">Task Repeat </label></td>
                          <td style="text-align:left;">: <?php if($row->task_repeat == 1) { echo 'Yes'; } else { echo 'No'; }?></td>
                      </tr>
                       <tr>
                          <td style="text-align:left; vertical-align:top;"><label class="form-label">Task online </label></td>
                          <td style="text-align:left;">: <?php if($row->task_online == 1) { echo 'Yes'; } else { echo 'No'; }?></td>
                      </tr>
                      
                      
                      
                      
                 
                      <tr>
                          <td style="text-align:left;" valign="top"><label class="form-label">Dead Line </label></td>
                          
                        <td style="text-align:left;" valign="top">:
                        
                      If unassigned, Task will expire on: <b>
        
      
						 <?php	
                         
                         echo date('M d',strtotime(date("Y-m-d", strtotime($row->task_post_date)) . " +".$row->task_start_day."days")).',&nbsp;';	
                        
                        echo date('h A',mktime(0,$row->task_start_time,0,0,0,0));	
                        ?>
                        
                        
                        </b><br />&nbsp; Task should be completed by: <b>
                        
                        <?php	
                             echo date('M d',strtotime(date("Y-m-d", strtotime($row->task_post_date)) . " +".$row->task_end_day."days")).',&nbsp;';		
                        echo date('h A',mktime(0,$row->task_end_time,0,0,0,0));	
                        ?>
                        
                        
                        
                        </b>
                        
                        </td>
                        </tr>
                      
                      
                      
                       
                     
                      
                      
                     <tr><td colspan="2"> <hr/></td></tr>
                     
                      
                   <tr>
                   <td colspan="2">
                   
                   
                   
                   <table border="0" cellpadding="4" cellspacing="2" width="100%">
                   
                   
                   <tr>
                   
                   
                   <!-- user detail-->
                   
                   <td align="left" valign="top">
                    
                    
                    <table border="0" cellpadding="3" cellspacing="3" height="120" >
                    
                    <?php  $user = $this->user_model->get_one_user($row->user_id); ?>
                    <tr><td style="text-align:left;" valign="top" height="20"><label class="form-label">User : <?php echo '&nbsp;&nbsp;'.anchor(front_base_url().'user/'.$user->profile_name,ucfirst($user->first_name).' '.ucfirst(substr($user->last_name,0,1)),' style="color:#004C7A;" target="_blank"'); ?></label></td></tr>
                    <tr><td style="text-align:left;" valign="top">
                           	<?php 
														 
								 if($user->profile_image!='') {
									 echo '<img src="'.front_base_url().'upload/user/'.$user->profile_image.'" style="border-radius:5px; width:50px; height:50px;"/>';
								} else {
									 echo '<img src="'.front_base_url().'upload/no_image.png" style="border-radius:5px; width:50px; height:50px;"/>';
								}
								
							?>
                           </td>
                      </tr>
                      
                      </table>
                      
                      
                      
                      <?php if($row->task_worker_id > 0 && $row->task_activity_status>0) { 
					  
					  	$worker = $this->worker_model->view_worker_result($row->task_worker_id);
						
						?>
                        <hr/>
                        
                         <table border="0" cellpadding="3" cellspacing="3" >
                         
 						
                      <tr><td style="text-align:left;" valign="top"><label class="form-label">Worker : <?php echo '&nbsp;&nbsp;'.anchor(front_base_url().'user/'.$worker->profile_name,ucfirst($worker->first_name).' '.ucfirst(substr($worker->last_name,0,1)),' style="color:#004C7A;" target="_blank"'); ?> </label></td></tr>
                        <tr><td style="text-align:left;" valign="top"> 
						  	<?php  
								
								

										if($worker->profile_image!='') {
											 echo '<img src="'.front_base_url().'upload/user/'.$worker->profile_image.'" style="border-radius:5px; width:50px; height:50px;"/>';
									  	} else {
											 echo '<img src="'.front_base_url().'upload/no_image.png" style="border-radius:5px; width:50px; height:50px;"/>';
									  	}	
										
								
							?>
                          </td>
                      </tr>
                      
                       </table>
                      <?php } ?>
                      
                     
                   
                   </td>
					
                    <!-- user detail-->
                    
                   <!-- task price-->
                    
                    <td align="left" valign="top" style="border-left:1px solid #CCCCCC; ">
                     <table border="0" cellpadding="0" cellspacing="0" style="vertical-align:top;padding-left:10px;" height="120">
                     
                     
                      <tr>
                          <td style="text-align:left;" valign="top"><label class="form-label">Task Status </label></td>
                          <td style="text-align:left;" valign="top">: 
						 	 <?php 
							 	if($row->task_status == 1) { $task_status = 'Active'; }
								elseif($row->task_status == 0) { $task_status = 'Inactive'; }
								elseif($row->task_status == 2) { $task_status = 'Draft'; }
								
								echo $task_status;
							?>
                          </td>          
                      </tr>
                      
                      
                      
                       <tr>
                          <td style="text-align:left;" valign="top"><label class="form-label">Task Price </label></td>
                          <td style="text-align:left;" valign="top">: <?php echo $site_setting->currency_symbol.$row->task_to_price.' - '.$site_setting->currency_symbol.$row->task_price;?></td> 
                      </tr>
                      
                      
                       <?php if($row->extra_cost>0) { ?>
                       <tr>
                          <td style="text-align:left;" valign="top"><label class="form-label">Extra Cost </label></td>
                          <td style="text-align:left;" valign="top">: <?php echo $site_setting->currency_symbol.$row->extra_cost;?></td>
                      </tr>
                      
                      <?php } ?>
                      
                      
                       <?php if($row->other_cost>0) { ?>
                       <tr>
                          <td style="text-align:left;" valign="top"><label class="form-label">Other Cost </label></td>
                          <td style="text-align:left;" valign="top">: <?php echo $site_setting->currency_symbol.$row->other_cost;?></td>
                      </tr>
                      
                      <?php } ?>
                      </table>
                      
                      
                      <?php if($row->task_worker_id > 0  && $row->task_activity_status>0) { ?>
                      
                      
                       <hr/>
                       
                       <table border="0" cellpadding="0" cellspacing="0" style="vertical-align:top;padding-left:10px;">
                     
                       
                      <tr>
                          <td style="text-align:left;" valign="top"><label class="form-label">Final Price </label></td>
                          <td style="text-align:left;" valign="top">: <b style="color: #009900;">
						  <?php 
						  		$price = $this->task_model->offer_price($row->task_worker_id,$row->task_id); 
								if(!empty($price)) { 
									echo $site_setting->currency_symbol.$price->offer_amount; 
								} else { 
									echo $site_setting->currency_symbol.'0.00'; 
								}
						  ?>
                          </b>
                          
                          </td> 
                      </tr>
                       </table>
                      <?php } ?>
                     
                                         
                    </td>
                    <!-- task price-->
                    
                    
                    
                    <!-- status dates-->
                    <td align="left" valign="top" style="border-left:1px solid #CCCCCC;">
                   <table border="0" cellpadding="3" cellspacing="3" height="120" style="padding-left:10px;">
                   
                   
                      <tr>
                          <td style="text-align:left;" valign="top"><label class="form-label">Activity Status </label></td>
                          <td style="text-align:left;" valign="top">: <b style="color: #004C7A;">
						 	 <?php 
							 	if($row->task_activity_status == 0) { $task_activity_status = 'Post'; }
								elseif($row->task_activity_status == 1) { $task_activity_status = 'Assign'; }
								elseif($row->task_activity_status == 2) { $task_activity_status = 'Complete'; }
								elseif($row->task_activity_status == 3) { $task_activity_status = 'Close'; }
								elseif($row->task_activity_status == 4) { $task_activity_status = 'Suspend'; }
								
								echo $task_activity_status;
							 ?></b>
                          </td>
                      </tr>
                      
                      
                      <tr>
                          <td style="text-align:left;" valign="top"><label class="form-label">Posted Date </label></td>
                          <td style="text-align:left;" valign="top">: <?php if($row->task_post_date != '0000-00-00 00:00:00') { echo date($site_setting->date_time_format,strtotime($row->task_post_date)); }?></td>
                      </tr>
                      
                  
                      
                      
                      
                      <?php if($row->task_assigned_date != '0000-00-00 00:00:00') { ?>
                      <tr>
                          <td style="text-align:left;" valign="top"><label class="form-label">Assign Date </label></td>
                          <td style="text-align:left;" valign="top">: <?php if($row->task_assigned_date != '0000-00-00 00:00:00') { echo date($site_setting->date_time_format,strtotime($row->task_assigned_date)); }?></td>
                      </tr>
                      
                  <?php }  if($row->task_complete_date != '0000-00-00 00:00:00') { ?>
                      
                      <tr>
                          <td style="text-align:left;" valign="top"><label class="form-label">Complete Date </label></td>
                          <td style="text-align:left;" valign="top">: <?php if($row->task_complete_date != '0000-00-00 00:00:00') { echo date($site_setting->date_time_format,strtotime($row->task_complete_date)); }?></td>          
                      </tr>
                      
                        <?php }  if($row->task_close_date != '0000-00-00 00:00:00') { ?>
                        
                      <tr>
                          <td style="text-align:left;" valign="top"><label class="form-label">Close Date </label></td>
                          <td style="text-align:left;" valign="top">: <?php if($row->task_close_date != '0000-00-00 00:00:00') { echo date($site_setting->date_time_format,strtotime($row->task_close_date)); }?></td>
                      </tr> 
                      
                      <?php  }  ?>
                      
                      
                      </table>
                      
                      <hr/>
                       <table border="0" cellpadding="3" cellspacing="3" style="padding-left:10px;">
                   
                     
                       
                       
                        <tr>
                          <td style="text-align:left;" valign="top"><label class="form-label">Work Status Of User </label></td>
                          <td style="text-align:left;" valign="top">: <?php if($row->poster_agree == "1"){ ?>
                          <span style="color:#009900;">Agree</span>
                          <?php }else{ ?>
                         <span style="color:#FF0000; font-weight:bold;">Disagree</span>
                          <?php } ?></td>
                      </tr>
                      
                       <tr>
                          <td style="text-align:left;" valign="top"><label class="form-label">Work Status Of Worker </label></td>
                          <td style="text-align:left;" valign="top">: <?php if($row->worker_agree=="1"){  ?>
                          <span style="color:#009900;">Agree</span>
                          <?php }else{ ?>
                         <span style="color:#FF0000; font-weight:bold;">Disagree</span>
                          <?php } ?></td>
                      </tr>
                      
                      
                   
                   
                   </table>
                    </td>
                     <!-- status dates-->
                     
                     
                     
                    </tr>
                                          
                   </table>
                      
                      
                      
                      </td>
                      </tr>
                      
                      
                      
                       <tr><td colspan="2"> <hr/></td></tr>
                       
                       
                       
                      <tr>
                          <td style="text-align:left;width:21%;"><label class="form-label">Task Description </label></td>
                          <td style="text-align:left; width:65%;">: <?php echo ucfirst($row->task_description);?></td>
                      </tr>
                      
                      <?php if($row->more_details!='') { ?>
                      <tr>
                          <td style="text-align:left;"><label class="form-label">Private Notes </label></td>
                          <td style="text-align:left;">: <?php echo ucfirst($row->more_details);?></td>
                      </tr>
                      <?php } ?>
                      
                  	
                      
                      
                      <?php if($row->extra_cost>0) { ?>
                      
                         <tr><td colspan="2"> <hr/></td></tr>
                         
                       <tr>
                          <td style="text-align:left;"><label class="form-label">Extra Cost </label></td>
                          <td style="text-align:left;">: <?php echo $site_setting->currency_symbol.$row->extra_cost;?></td>
                      </tr>
                       <tr>
                          <td style="text-align:left; vertical-align:top;"><label class="form-label">Extra Cost Description </label></td>
                          <td style="text-align:left;">: <?php echo ucfirst($row->extra_cost_description);?></td>
                      </tr>
                      
                      <?php } ?>
                      
                      
                      
                         <?php if($row->other_cost>0) { ?>
                         
                            <tr><td colspan="2"> <hr/></td></tr>
                            
                            
                       <tr>
                          <td style="text-align:left;"><label class="form-label">Other Cost </label></td>
                          <td style="text-align:left;">: <?php echo $site_setting->currency_symbol.$row->other_cost;?></td>
                      </tr>
                       <tr>
                          <td style="text-align:left; vertical-align:top;"><label class="form-label">Other Cost Description </label></td>
                          <td style="text-align:left;">: <?php echo ucfirst($row->other_cost_description);?></td>
                      </tr>
                      
                      <?php } ?>
                      
                      
                      <?php  if($task_location) { ?>
                                
                      
                      <tr><td colspan="2"> <hr/></td></tr>
                    
                      <tr>
                          <td style="text-align:left; vertical-align:top;"><label class="form-label">Location </label></td>
                          <td style="text-align:left;"> : <div style="margin-left: 10px;margin-top: -15px;">
                          	<?php 
                               	$l =0 ;
                                    foreach($task_location as $loc) 
                                    {  $l++;
                                        if($loc->user_location_id>0)
                                        { 
                                            $get_user_location=$this->task_model->get_user_location_detail($loc->user_location_id);
                                            
                                            if($get_user_location) 
                                            {
                                                $loc_full='';
                                                
                                                echo '<p>'.$l.') ';
                                                if($get_user_location->location_name!='') { echo $get_user_location->location_name; }
                                                echo '</p>';
                                                
                                                echo '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                                if($get_user_location->location_address!='') { $loc_full.=$get_user_location->location_address.','; }
                                                
                                                if($get_user_location->location_zipcode!='') { $loc_full.=$get_user_location->location_zipcode; }
                                                
                                                echo $loc_full.'</p><p>&nbsp;</p>';
                                            }  
                                        }
                                        else
                                        {     
                                            $loc_full='';
                                                
                                            echo '<p>'.$l.') ';
                                            if($loc->location_name!='') { echo $loc->location_name; }
                                            echo '</p>';
                                            
                                            echo '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                            if($loc->location_address!='') { $loc_full.=$loc->location_address.','; }
                    
                                            if($loc->location_zip!='') { $loc_full.=$loc->location_zip; }
                                             
                                            echo $loc_full.'</p><p>&nbsp;</p>';    
                                        }
                                    }
                                    
                              
                            ?></div>  
                          </td>
                      </tr>
                     
                     <?php } ?>
                     
                     <?php if($offers_on_task) { ?>
               	
                 <tr><td colspan="2"> <hr/></td></tr>      
                		<tr><td colspan="2">
					   <h2 style="color: #0669AF; font-size:14px; font-weight: bold;line-height:55px; "> <?php echo $total_offers_on_task; ?> Bid(s) on this Task</h2>
					  </td></tr>
                      
                	 
                       
                     <tr><td colspan="2" align="left" valign="top">
                     <table border="0" cellpadding="3" cellspacing="3" width="100%">
                     
                    <?php 
				$i= 0;
					foreach($offers_on_task as $offers) {  $i++;
					
					
						
				$user_image= front_base_url().'upload/no_image.png';
				 
				 if($offers->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$offers->profile_image)) {
				
						$user_image=front_base_url().'upload/user/'.$offers->profile_image;
						
					}
					
				}
				
				
				
				?>      
                     
                <tr <?php if($row->task_worker_id==$offers->worker_id) { ?> bgcolor="#efefef"<?php } ?>>
                <td align="left" valign="top" width="80" <?php if($row->task_worker_id==$offers->worker_id) { ?> style="padding:10px 0px 0px 5px;" <?php } ?>>				   
					     <?php echo anchor(front_base_url().'user/'.$offers->profile_name,'<img src="'.$user_image.'" alt="" width="68" height="69"/>',' target="_blank"');?>
                    <br />

                         <b>  Level : </b><?php echo $offers->worker_level;?>
                    </td>
                    
                    
                    <td align="left" valign="top" <?php if($row->task_worker_id==$offers->worker_id) { ?> style="padding:10px 0px 0px 0px;" <?php } ?>>
                    <p style="line-height:13px;"> <b><?php echo anchor(front_base_url().'user/'.$offers->profile_name,ucfirst($offers->first_name).' '.ucfirst(substr($offers->last_name,0,1)),' target="_blank"'); ?></b></p>
                      
                    <p style="line-height:13px;"><b>City : </b> <?php if($offers->current_city>0) { $city_name=get_city_name($offers->current_city); if($city_name) { echo $city_name; } } ?> 
                    </p>
                       
                   
                   
                   <p style="line-height:13px;"> <b>Contact : </b> <?php echo $offers->mobile_no.','.$offers->phone_no; ?>  </p>
                          
                   <p style="line-height:20px;"> <b>Offer : </b><span style="color:#009900; font-weight:bold;"><?php echo $site_setting->currency_symbol.$offers->offer_amount; ?></span> </p>

					<p><?php echo $offers->task_comment;?></p>   
                          
					<p><i style="color:#666666;">at <?php echo date($site_setting->date_time_format,strtotime($offers->comment_date)); ?></i>
                                
                                
                   </td></tr>
                                 
                   <tr><td colspan="2"> <hr/></td></tr>          
                
                
			<?php }   ?>
            
            </table>
                
                     
                     </td></tr>
                     
                     <?php } ?>
                     
                     
                     
                      
                  </tbody>
			  	 </table>   
           
              <?php } ?> 


			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>