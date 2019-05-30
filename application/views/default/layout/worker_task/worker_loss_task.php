<div>
	<div>
	
    	<div class="red-subtitle" style="margin:162px 0 0 0">My Tasks</div>
    	<div id="two-columnar-section">
        
        <div class="db-rightinfo" style="width:100%; margin:25px 0 0 0">
        <div class="home-signpost-content home-signpost-content-new-section"> 
        
    	<div class="dbleft">
 <div class="inside-subtitle">
          
           <ul class="filtration">
           
         
           
           	
           <?php echo anchor('worker_task/all','<li>All</li>','  class="fpass fs14"');?>
           
           
           <?php echo anchor('worker_task/open','<li>Open</li>',' class="fpass fs14"');?>
          
           	
           <?php echo anchor('worker_task/assigned','<li>Assigned</li>','class="fpass fs14"');?>
           
           	
           <?php echo anchor('worker_task/closed','<li>Closed</li>',' class="fpass fs14"');?>
           
           
           	
          
           
           
          
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
					
				} 
   ?>  
    <li>
        <div class="abct3">
            <?php echo anchor('user/'.$user_detail->profile_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />');?>
        </div>
        <div class="catle3n ">
            <?php echo anchor('tasks/'.$row->task_url_name,ucfirst($row->task_name),' class="fpass fs13 lockbg"');?>
           
                <p class="colmark marT5">
                <?php 
					$task_description= $row->task_description;		
					$task_description=str_replace('KSYDOU','"',$task_description);
					$task_description=str_replace('KSYSING',"'",$task_description);

					$strlen = strlen($task_description);
					if($strlen > 50) { echo substr($task_description,0,80).' ...';}
					else { echo $task_description; }                                      
				?>
                </p>
                
                
        </div>
        <div class="catle3n2">
        <?php 
			
			 $dispute = $this->dispute_model->check_dispute_task($row->task_id);
			 $is_assign = $row->task_activity_status;
			 $status = '';
					   
					   
			 if($is_assign == 1){
				$status .='Assigned';
				
			 } elseif($is_assign == 2){
				
				 if(($row->worker_agree == 1) && ($row->poster_agree == 1)) {
			 
				$status .='Completed';
				
				} elseif(!empty($dispute)) {
				
					$status .='Dispute';
					
				 } else {
					
					$status .='Completed';
				 }
				
			 } elseif($is_assign == 3){
				$status .='Closed';
				
			 }elseif($is_assign == 0){
				$status .='Posted';
			 }
		 ?>
		
        <ul class="ulnobor">
			<li class="LH16" style="border-bottom:none;">
            

            
            
            
            	<p>Task Status: <span class="colora"><b><?php echo $status; ?></b></span></p>
            	<p><b>Posted :</b> <span class="geo"><?php echo date($site_setting->date_time_format,strtotime($row->task_post_date));?></span></p>
	           
                <?php 
					
					
					
					 if($row->task_worker_id!='' && $row->task_worker_id>0) 
					{ 
					
						$asssign_user = $this->worker_model->get_worker_info($row->task_worker_id);
				?>
					<p><b>Assigned To:</b> <?php echo anchor('user/'.$asssign_user->profile_name,$asssign_user->first_name.' '.substr($asssign_user->last_name,0,1),'class="fpass"'); ?></p>
                    <p><b>Assigned :</b> <span class="geo"><?php echo date($site_setting->date_time_format,strtotime($row->task_assigned_date)); ?></span></p>
                    
				<?php } ?>
            </li>
            <div class="clear"></div>
        </ul>        
	       	
        </div>
        <div class="clear"></div>



<div class="marTB5">
        	<div class="fl wid100 marL80">
                <p class="geo"><?php echo getDuration($row->task_post_date,$row->task_id); 
			
				?> </p>
                
            </div>	
            <div class="fr" >
            	<div class="alignright">
	        	
              
				
				<span class="chbglab">Task Price:<?php echo $site_setting->currency_symbol.$row->task_to_price.' - '.$site_setting->currency_symbol.$row->task_price;?></span>
				                
                </div>
            </div>
            <div class="clear"></div>    
        </div>



		
        <div class="clear"></div>
        
        
    </li>
	<?php } } ?>
</ul>                

                
                
                
         
				<?php if($total_rows>10) { ?>
					<div class="gonext">
                    <?php echo $page_link; ?>
                    </div>
				<?php } ?>       
       
                
                
                
              
     
                
		</div>
 


<div class="dbright-task">

<?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>

</div>
        
        
        	
            
            
            
            
            
            
        
        <div class="clear"></div>



    </div>
</div>