<div class="main">
<div class="incon">
    	<div class="mconleft">
                
            
  <div class="padB20">
           <div id="s1postJ">Open Tasks:</div> 
           
           <ul class="ulleftmt">
           	<li>
           <?php echo anchor('worker_task/my','Mine','  class="fpass fs14"');?>
           </li>
           	<li>
           <?php echo anchor('worker_task/all','All','  class="fpass fs14"');?>
           </li>
           	<li>
           <?php echo anchor('worker_task/open','Open',' class="fpass fs14 act"');?>
           </li>
           	<li>
           <?php echo anchor('worker_task/assigned','Assigned','class="fpass fs14"');?>
           </li>
           	<li>
           <?php echo anchor('worker_task/closed','Closed',' class="fpass fs14"');?>
           </li>
           
           	<li>
           <?php echo anchor('worker_task/loss','Lost',' class="fpass fs14"');?>
           </li>
           
           
           
           	<li>
           <?php echo anchor('task/new_task','Post Task',' id="various3" class="login"');?>
           </li>
           <div class="clear"></div>
           </ul>
</div>           
                
           
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
                        <?php echo anchor('user/'.$user_detail->profile_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />',' class="fpass fs13"');?>
                    </div>
                    
                    <div class="catle3n ">
                       <?php 
						if($row->task_activity_status == 3) {
							echo anchor('tasks/'.$row->task_url_name,ucfirst($row->task_name),' class="fpass fs13 lockbg"');
						 } else{ 
						 	echo anchor('tasks/'.$row->task_url_name,ucfirst($row->task_name),' class="fpass fs13 lockbg"');
						 }
					    ?>
                       
                            <p class="colmark marT5">
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
                    </div>

                        <div class="catle3n2">
                            <ul class="ulnobor">
                                <li class="LH16" style="border-bottom:none;">
                                
                      
            
            
            
                                <p><b>Posted :</b><span class="geo"><?php echo date($site_setting->date_time_format,strtotime($row->task_post_date)); ?></span></p>
                                </li>
                                <div class="clear"></div>
                            
                              </ul>        
                            
                        </div>
                    
                    <div class="clear"></div>
            
            
            
            
                  <div class="marTB5">
        	<div class="fl wid100 marL80">
                            <p class="geo"><?php echo getDuration($row->task_post_date,$row->task_id); ?></p>
                            
                     </div>	
                     
                         <div class="fr" >
                            <div class="alignright" >
                            
                             <?php 
					
						echo anchor('worker_task/conversation/'.$row->worker_id.'/'.$row->task_id,'Conversation',' class="chbg"');
						
					
				?>
				
                            
                            <span class="chbglab">Task Price:<?php echo $site_setting->currency_symbol.$row->task_to_price.' - '.$site_setting->currency_symbol.$row->task_price;?></span>
                                         
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
 




<?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>


        
        
        	
            
            
            
            
            
            
        
        <div class="clear"></div>



    </div>
</div>