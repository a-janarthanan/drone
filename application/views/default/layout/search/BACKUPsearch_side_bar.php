 <div class="mconright">
        <ul class="padli10">
 
        <li><div class="estim marB5">Viewing Runner in Boston</div>
        
        	<ul class="ulmycity">
            <li>
				<?php 
                    if($cityname == 'all') {
                        echo '<span style="font-size: 15px;">All</span>';
                    } else {
                        echo anchor('search/in/all/'.$search,'All');
                    } 
                ?> 
			</li>
             <?php
			 	 $city_list=city_list();
		  		 $current_city_id=getCurrentCity();
		 
		   		 if($city_list) {  foreach($city_list as $city) { ?>
                 
                  
            		<li>
						<?php 
							if($cityname == $city->city_name) {
							 	echo '<span style="font-size: 15px;">'.$city->city_name.'</span>';
							} else {
								echo anchor('search/in/'.$city->city_name.'/'.$search,$city->city_name);
							} 
						?> 
                  </li>
           <?php } } ?>
       
                <div class="clear"></div>
            </ul>
        
        </li>
        <li><div class="estim marB5">More Coming Soon</div>
        
        	<ul class="ulmycity">
            	<li><a href="#">Austria</a></li>
                <li><a href="#">LA</a></li>
                <li><a href="#">Holland</a></li>
                <div class="clear"></div>
            </ul>
        
        </li>
			<h3 id="detail-bg1"><span class="fl"> <?php 
			
			$worker_cnt=0; 
			$worker_list=array_unique($worker_arr);
			
			if($worker_list){
				
				foreach($worker_list as $row) { 
			
				if($row != 0) {  $worker_cnt++; } } }  echo $worker_cnt;?> Runners found</span><span class="fr fs13 marT2"></span><div class="clear"></div></h3>
       
	
        <ul class="ultaskers">
       		<?php 

			
			
				if($worker_list){
				
				foreach($worker_list as $row) { 
			
				if($row != 0) { 
				
				$worker  = $this->worker_model->get_worker_info($row);
				
				$total_rate=get_user_total_rate($worker->user_id);
			
					
			?>
        	<li class="posrel">            

                       <div class="ponleft">
                         <?php 
						 
						 $user_image= base_url().'upload/no_image.png';
						 
						 if($worker->profile_image!='') {  
					
							if(file_exists(base_path().'upload/user/'.$worker->profile_image)) {
						
								$user_image=base_url().'upload/user/'.$worker->profile_image;
								
							}
							
						}
						
						echo anchor('user/'.$worker->profile_name,'<img src="'.$user_image.'" width="50" height="50" alt=""/>');?>
                            <a rel="tooltip" class="twoonepts1" title="Level <?php echo $worker->worker_level; ?> Runner"><?php echo $worker->worker_level;?></a>
                       </div>
                       <div class="ponright">
                            
                            
                        <table width="100%" border="0" cellspacing="1" cellpadding="0">
                          <tr>
                            <td width="50%"  class="padTB10"><?php echo anchor('user/'.$worker->profile_name,ucfirst($worker->first_name).' '.ucfirst(substr($worker->last_name,0,1)).'.',' class="fpass fs13" ');?></td>
                            <td width="50%">
                               
                               
                               
                                 <div class="hire_me">        
                                                <?php if(!check_user_authentication()) {  echo anchor('sign_up','<b>Hire Me</b>',' class="login" ');  }  else { echo anchor('task/new_task/'.$worker->worker_id,'<b>Hire Me</b>',' id="hireme_'.$worker->worker_id.'" class="login" '); ?>
 						   <script type="text/javascript">
								jQuery(document).ready(function() {	
									jQuery("#hireme_<?php echo $worker->worker_id;?>").fancybox();	
								});
						</script>

<?php } ?>
                           </div>
                           
                           
                              
                                
                              
                                
                                  
                            </td>
                          </tr>
                        </table>

                            <div class="str padR10"><div class="str_sel" style="width:<?php if($total_rate>5) { ?>100<?php } else { echo round($total_rate*2);?>0<?php } ?>%;"></div></div>
                       
                            <p class="marTB3 LH18"><b>Top Task Types:</b> 
							<?php 
							
							
							
							
							
							 $task_type_detail='';
			  
			 $types=$worker->worker_task_type;
			 
			 if($types!='') { 
			 
			
			 
			 $ex_type=explode(',',$types);
			 
			 foreach($ex_type as $type) 
			 {
				
				 $get_task_type=$this->worker_model->get_task_type_detail($type);
				 
				 
				 if($get_task_type)
				 {
				 	if(isset($get_task_type->task_name))				
					{
						  $task_type_detail .=$get_task_type->task_name.',';
				 	}
				}
				
			}
					
					if($task_type_detail!='') { echo  substr(substr($task_type_detail,0,-1),0,50).'...'; }  }
					
					
					
							/*
								$task_types = explode(',',$worker->worker_task_type);
								//print_r($task_types);
								foreach($task_types as $task_type){
									
									if(is_numeric(trim($task_type))){  echo $this->search_model->get_tasktypename($task_type).', '; }
									else{ echo $task_type.', '; } 
								}
								
								*/
								
								
								
							?>
                            
                            </p>
                            
                       </div>
                       <div class="clear"></div>
                   </li>
                  <?php  } } } ?>     

                   
                  </ul> 

            
            
            
        <li>
        
        
        
        </li>
        
		
        </ul>
        
        
        </div>