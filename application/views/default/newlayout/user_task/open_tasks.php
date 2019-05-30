<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
	<div>
	<!--<div class="page-title mbot20">
		<h1 class="mleft15">Aktiva Uppdrag</h1>
	</div>-->
    <div class="red-subtitle top-red-subtitle" >Aktiva Uppdrag</div>
    
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
                            
                   <div class="clear"></div>
                   
            <ul class="ulsty">
               <?php if($result) {
			   			foreach($result as $row) { 
						
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
                       <?php 
						if($row->task_activity_status == 3) {
							echo anchor('tasks/'.$row->task_url_name,ucfirst($row->task_name),' class="abmarks abmarks-2"');
						 } else{ 
						 	echo anchor('tasks/'.$row->task_url_name,ucfirst($row->task_name),' class="abmarks abmarks-2"');
						 }
					    ?>
                       
                            <p class="colmark colmark-2">
								<?php if($row->task_activity_status == 3) {
									echo 'has been canceled.';
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
                            	<b>Projekt Budget (<?php echo $site_setting->currency_symbol ?>)</b> <br>
                            	<?php echo $site_setting->currency_symbol.$row->task_to_price.' - '.$site_setting->currency_symbol.$row->task_price;?>                     
                            </div>
                            <ul class="ulnobor">
                                <li class="LH16" style="border-bottom:none;">
                                <p><b>Skapad : </b><span class="geo geo-2"><?php echo date($site_setting->date_time_format,strtotime($row->task_post_date)); ?></span></p>
                                
                                </li>
                                <div class="clear"></div>
                            
                              </ul>        
                            
                        </div>
              
                   
            
            
            
                 <div class="marTB5">
        		
                     <div class="clear"></div>
                        <div class="fr" >
            	<div class="alignright">
	        	
                            
                             <?php 
									$offercount = $this->task_model->count_total_offer_on_task($row->task_id); 
									if($offercount != 0) {
										echo anchor('user_task/worker_offer/'.$row->task_id,$offercount.' Bud',' class="btn btn-default"');
									}
								
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
        </div>
        <div class="dbright-task dbright-task-main">

		<?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
        
        <div class="clear"></div>
         </div>
         
</div>
<div class="clear"></div>
    </div>
</div>