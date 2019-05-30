<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
	<div>
	
    	<div class="red-subtitle top-red-subtitle" >Open Tasks</div>
    	<div class="profile_back">
        <div class="container">
        <div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
        <div class="home-signpost-content" style="background:#e7e7e7; border-radius:10px;"> 
        	<div class="dbright-task dbright-task-main dbright-task-main-posted-final fl" style="border-radius:0;">
                  <div class="mconright dbright-task-main-posted">
                      <div class="" style="text-align:center;">
                          <div class="list-loadmore-ptd" style="text-align:center; padding-left:0px; font-size:17px;">My Running Tasks</div>
                          <div class="fleft100">
                              <?php echo anchor('worker_task/all','All','class="b-button b-button-2" style="border-top:1px solid #d6d6d6; text-align:center; padding-left:0px;"');?>
                              <?php echo anchor('worker_task/open','Open','class="b-button b-button-2 selected-task" style="text-align:center; padding-left:0px;"');?>
                              <?php echo anchor('worker_task/assigned','Assigned','class="b-button b-button-2" style="text-align:center; padding-left:0px;"');?>
                              <?php echo anchor('worker_task/closed','Closed','class="b-button b-button-2" style="text-align:center; padding-left:0px;"');?>
                          </div>
                      </div>
                  </div>
              </div>
    		<div class="dbleft dbleft-main posted-task-right fr">
          <div class="clear"></div>
          
<ul class="ulsty">
    
    
    <?php if($result) {
			   			foreach($result as $row) { 
						
						
						
						
						
						$work_task_detail=$this->task_model->get_tasks_detail_by_id($row->task_id);			
					
					$assign_time_pay_amount=0;
					$assign_pay_status=0;
				
					$payable_amount=0;
					
					$check_amount_pay=check_task_assign_amount_pay($work_task_detail->user_id,$row->task_id);
					
					if($check_amount_pay)
					{
						$assign_pay_status=1;
						$assign_time_pay_amount=$check_amount_pay->task_amount;
					}
					else
					{
						$payable_amount=0;
					}
					
		
		
		
				$taskdetail=$this->task_model->get_tasks_detail_by_id($row->task_id);
		
						
				$user_detail=$this->user_model->get_user_profile_by_id($taskdetail->user_id);
				$user_image= base_url().'upload/no_image.png';
				 
				 if($user_detail->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$user_detail->profile_image;
						
					}
					
				}?> 
   
               <li>
                    <div class="abct3">
                        <?php echo anchor('user/'.$user_detail->profile_name,'<img src="'.$user_image.'" alt="" width="50" height="50" class="round-corner" />');?>
                    </div>
                    
                    <div class="catle3n ">
                       <?php 
						if($row->task_activity_status == 3) {
							echo anchor('tasks/'.$row->task_url_name,ucfirst($row->task_name),' class="abmarks abmarks-2"');
						 } else{ 
						 	echo anchor('tasks/'.$row->task_url_name,ucfirst($row->task_name),' class="abmarks abmarks-2"');
						 }
					    ?>
                       
                            <p class="colmark colmark-2">
								<?php if($row->task_activity_status == 3) {
									echo 'has been cancelled.';
								  } else {
								  	$task_description= $row->task_description;		
									$task_description=str_replace('KSYDOU','"',$task_description);
									$task_description=str_replace('KSYSING',"'",$task_description);
	
									$strlen = strlen($task_description);
									if($strlen > 50) { echo substr($task_description,0,80).' ...';}
									else { echo $task_description; } 
								  }		                                     
								?>
                            </p> 
                            <p class="geo geo-2"><?php echo getDuration($row->task_post_date,$row->task_id); ?></p>  
                    </div>

                        <div class="catle3n2">
                        	<div class="urgent-price urgent-price-2">
                            	<b>Project Budget (<?php echo $site_setting->currency_symbol ?>)</b> <br>
                            	<?php echo $site_setting->currency_symbol.$row->task_to_price.' - '.$site_setting->currency_symbol.$row->task_price;?>                     
                            </div>
                            <ul class="ulnobor">
                                <li class="LH16" style="border-bottom:none;">
                                
                      
            
            
            
                                <p><b>Posted : </b><span class="geo geo-2"><?php echo date($site_setting->date_time_format,strtotime($row->task_post_date)); ?></span></p>
                                </li>
                                <div class="clear"></div>
                            
                              </ul>        
                            
                        </div>
                    
                    <div class="clear"></div>
            
            
            
            
                  <div class="marTB5">
        		
                     
                         <div class="fr" >
                            <div class="alignright" >
                            
                             <?php 
					
						echo anchor('worker_task/conversation/'.$row->worker_id.'/'.$row->task_id,'Conversation',' class="btn btn-default"');
						
					
				?>
				
                            
                            
                                         
                            </div>
                        </div>
                        <div class="clear"></div>    
                    </div>
                    <div class="clear"></div>
                    
                    
                </li>
 			<?php } }?>

</ul>                

                
                
                
                
       
                
                
                <?php if($total_rows>10) { ?>
					<div class="gonext">
                    <?php echo $page_link; ?>
                    </div>
				<?php } ?>       
       
                
              
     
                
		</div>
        <div class="clear"></div>
 		</div>
</div>
<div class="clear"></div>
		</div>