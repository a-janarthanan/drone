<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
	<div>
	<!--<div class="page-title mbot20">
		<h1 class="mleft15">Tilldelade Uppdrag</h1>
	</div>-->
    <div class="red-subtitle top-red-subtitle">Tilldelade Uppdrag</div>
    	<div class="profile_back">
        <div class="container">
        <div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
        <div class="home-signpost-content"> 
    	<div class="dbleft dbleft-main">
                
            
  <div class="inside-subtitle">
                   
                   
                    <ul class="filtration">
                    
                   <?php //echo anchor('user_task/mytasks','<li>Mine </li>');?>
                  
                    
                   <?php echo anchor('user_task/all_tasks','<li>Alla</li>');?>
                   
                   
                   <?php echo anchor('user_task/open_tasks',' <li>Aktiva</li>');?>
                   
                    
                   <?php echo anchor('user_task/assigned_task','<li>Tilldelade</li>','class="fpass fs14"');?>
                   
                   
                   <?php echo anchor('user_task/closed_tasks',' <li>Avslutade</li>');?>
                   
                    <li>
                   <?php //echo anchor('task/new_task','Post Task',' id="various3" class="login"');?>
                   </li>
                   <div class="clear"></div>
                   </ul>
            </div>           
                
           
           
<ul class="ulsty">
<?php

		$site_setting=site_setting();
		
		
	 if($result) {
		foreach($result as $row) {
		
		
		$assign_time_pay_amount=0;
		$assign_pay_status=0;
	
		$payable_amount=0;
		
		$check_amount_pay=check_task_assign_amount_pay($row->user_id,$row->task_id);
		
		if($check_amount_pay)
		{
			$assign_pay_status=1;
			$assign_time_pay_amount=$check_amount_pay->task_amount;
		}
		else
		{
			$task_setting=task_setting();
		
						$total=0;
						
						if($row->extra_cost>0) {
						
						$total=$total+$row->extra_cost;
						
						}
						
						
						
						
						if($row->task_worker_id>0)
						{
						 	$price = $this->user_task_model->offer_price($row->task_worker_id,$row->task_id); 					 
						 	$total=$total+$price->offer_amount;
						 
						 }
						 
						 
						 if($task_setting->task_post_fee>0) {
						 
						 $task_site_fee=number_format((($task_setting->task_post_fee*$total) / 100),2); 
					
							 $total=$total+$task_site_fee;
					
						}
						 
						 
						 $total=number_format($total,2);
		 
		 
						$payable_amount= $total;
		}
		
		
			$user_detail=$this->user_model->get_user_profile_by_id($row->user_id);
				$user_image= base_url().'upload/no_image.png';
				 
				 if($user_detail->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$user_detail->profile_image;
						
					}
					
				}
				
				
				
				
				
				
	?>    
    <li>
        <div class="abct3">
            <?php echo anchor('user/'.$row->profile_name,'<img src="'.$user_image.'" alt="" width="50" height="50" class="round-corner" />');?>
        </div>
        <div class="catle3n ">
        	<?php echo anchor('tasks/'.$row->task_url_name,ucfirst($row->task_name),' class="abmarks abmarks-2"'); ?>
           
                <p class="colmark colmark-2 marT5">
					<?php 
							$task_description= $row->task_description;		
							$task_description=str_replace('KSYDOU','"',$task_description);
							$task_description=str_replace('KSYSING',"'",$task_description);
		
							$strlen = strlen($task_description);
							if($strlen > 50) { echo substr($task_description,0,80).' ...';}
							else { echo $task_description; } 	                                     
                    ?>
                </p>
                <p class="geo geo-2"><?php echo getDuration($row->task_post_date,$row->task_id);?></p>
                
        </div>
        <div class="catle3n2">
        	<div class="urgent-price urgent-price-2">
                            	<b>Projekt Budget (<?php echo $site_setting->currency_symbol ?>)</b> <br>
                            	<?php echo $site_setting->currency_symbol.$row->task_to_price.' - '.$site_setting->currency_symbol.$row->task_price;?>                     
                            </div>
<ul class="ulnobor">
	
			<li class="LH16" style="border-bottom:none;">
            <?php if($assign_pay_status==1 && $assign_time_pay_amount>0) { ?>
            
          <p class="marB5"><b>Betalt: </b><span class="fpass fs14 colora"> <?php echo $site_setting->currency_symbol.$assign_time_pay_amount; ?></span></p>
          
            
            <?php } else { ?>
            
              <p class="marB5"><span class="fpass fs14 colora"> <?php echo anchor('user_task/pay_now/'.$row->task_id,'Klicka här för att lägga till summan:  '.$site_setting->currency_symbol.$payable_amount,'class="fpass colora"'); ?></span></p>.
            
            <?php } ?>
            
            
            
            
            
              
              
            
            
            <?php
			
				
				
				
				$dispute = $this->dispute_model->check_dispute_task($row->task_id);
			
			 if(($row->worker_agree == 1) && ($row->poster_agree == 1)) {?>
                    <p class="marB5"><b>Utförd: </b><span class="fpass fs14 colora"> Ja</span>
            <?php } elseif(!empty($dispute)) {
						echo '<p class="marB5"><b>Utförd: </b>'.anchor('dispute/dispute_task/'.$row->task_id,'Dispute','class="fpass fs14 colora"'); 
				  } else { ?>
            	<p class="marB5"><b>Utförd:</b>    
               <?php 
			   		if(($row->worker_agree == 1) && ($row->task_activity_status == 2)){ 
			   			echo anchor('user_task/complete/'.$row->task_id,'Yes','class="fpass fs14 colora"'); 
					} else {
						echo '<span class="fpass fs14 colora">Nej</span>'; 
					}
				}
			   ?>
                </p>
	           
                <p><b>Skapad : </b><span class="geo geo-2"><?php echo date($site_setting->date_time_format,strtotime($row->task_post_date)); ?></span></p>
                
                <?php  
						$is_assign = $row->task_activity_status;
						$asssign_user = $this->worker_model->get_worker_info($row->task_worker_id);
				?>
					<p><b>Entoworker: </b> <span class="geo geo-2"><?php echo anchor('user/'.$asssign_user->profile_name,$asssign_user->first_name.' '.substr($asssign_user->last_name,0,1),'class="fpass"'); ?></span></p>
				<?php if(($is_assign == 1) || ($is_assign == 2)) { ?>
					<p><b>Tilldelad : </b> <span class="geo geo-2"><?php echo date($site_setting->date_time_format,strtotime($row->task_assigned_date)); ?></span></p>
				<?php } 
					if($is_assign == 2) {
				?>
					<p><b>Completed : </b> <span class="geo geo-2"><?php echo date($site_setting->date_time_format,strtotime($row->task_complete_date)); ?></span></p>
				<?php } 
					if($is_assign == 3) {
				?>
					<p><b>Closed : </b> <span class="geo geo-2"><?php echo date($site_setting->date_time_format,strtotime($row->task_close_date)); ?></span></p>
				<?php } ?>
                                
                                
            </li>
            
            
            <div class="clear"></div>
        </ul>        
	       	
        </div>
       




		<div class="marTB5">
            <div class="clear"></div>
             <div class="fr" >
            	<div class="alignright">
	        	
    	        <?php
					$worker = $this->worker_model->get_worker_info($row->task_worker_id);
					 //echo anchor('user_task/conversation/'.$row->task_worker_id.'/'.$row->task_id,'Konversation',' class="chbg"');
					 echo anchor('user_task/conversation/'.$row->task_worker_id.'/'.$row->task_id,'Konversation',' class="btn btn-default"');
			   ?>
                
                
               
	           <?php $price = $this->user_task_model->offer_price($row->task_worker_id,$row->task_id);?>
               <span class="btn btn-default">Pris:  <?php echo $site_setting->currency_symbol.$price->offer_amount;?></span>              
                
                </div>
            </div>
            <div class="clear"></div>    
        </div>
        
        <div class="clear"></div>
        
        
    </li>
	<?php }  } ?>
</ul>                

             
                 
                     		        

<?php if($total_rows>10) { ?>
					<div class="gonext">
                    <?php echo $page_link; ?>
                    </div>
				<?php } ?>
                
		</div>
 

		</div>
        <div class="dbright-task dbright-task-main">
        
        <?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>

		</div>
        
        <div class="clear"></div>



    
</div><div class="clear"></div>