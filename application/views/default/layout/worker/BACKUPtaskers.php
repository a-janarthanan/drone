<?php
$site_setting=site_setting(); 
$data['site_setting']=$site_setting;
?>
<div class="main">
<div class="incon">
    	<div class="mconleft">
        
        
        <div id="s1post">Runners</div>
        <div class="marTB20"><h3 id="detail-bg1">Meet our Runners</h3></div>

       
        <ul class="ultaskers">
        <?php if($taskers) { foreach($taskers as $tasker) {
		
		
		 $user_image= base_url().'upload/no_image.png';
 
		 if($tasker->profile_image!='') {  
	
			if(file_exists(base_path().'upload/user/'.$tasker->profile_image)) {
		
				$user_image=base_url().'upload/user/'.$tasker->profile_image;
				
			}
			
		}
		
		
		$total_rate=get_user_total_rate($tasker->user_id);

		$total_review=get_user_total_review($tasker->user_id);
		
		?>
        	<li class="posrel">
            	<div class="abc">
                	<?php echo anchor('user/'.$tasker->profile_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />');?>
                    
                    
                	<a title="<?php echo 'Level '.$tasker->worker_level;?> Runner" class="twoonepts1" rel="tooltip"><?php echo $tasker->worker_level;?></a>
                </div>
                <div class="fl wid550 marL5">
                                    
                    <table width="100%" border="0" cellspacing="1" cellpadding="0">
                      <tr>
                        <td width="22%" class="padTB10"><?php echo anchor('user/'.$tasker->profile_name,ucfirst($tasker->first_name).' '.ucfirst(substr($tasker->last_name,0,1)).'.',' class="abmarks unl"'); ?></td>
                        <td width="58%"><div class="strmn"><div class="str_sel" style="width:<?php if($total_rate>5) { ?>100<?php } else { echo round($total_rate*2);?>0<?php } ?>%;"></div></div><div class="fl marL5">(<?php echo anchor('user/'.$tasker->profile_name.'/reviews',$total_review.' reviews','class="fpass"');  ?>)</div></td>
                        <td width="20%">
                                       
                                       
                                    
                                        
                                <div class="hire_me">        
                                                   <?php if(!check_user_authentication()) {  echo anchor('sign_up','<b>Hire Me</b>',' class="login" ');  }  else { echo anchor('task/new_task/'.$tasker->worker_id,'<b>Hire Me</b>',' id="hireme_'.$tasker->worker_id.'" class="login" '); ?>
 
 						   <script type="text/javascript">
								jQuery(document).ready(function() {	
									jQuery("#hireme_<?php echo $tasker->worker_id;?>").fancybox();	
								});
						</script>

<?php } ?>
                           </div>
                                        
                                          
                        </td>
                      </tr>
                    </table>
                    
                    <p class="LH18">
                    <?php 
										$strlen = strlen($tasker->worker_skills);
										if($strlen > 100) { echo substr($tasker->worker_skills,0,100).' ...';}
										else { echo $tasker->worker_skills; } 
									?>
                     <?php echo anchor('user/'.$tasker->profile_name,'more',' class="unl abmarks"');?></p>
                    <p class="marT5"><b>Top Task Types: </b> <?php 
					
					
					
					  $task_type_detail='';
			  
			 $types=$tasker->worker_task_type;
			 
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
					
					if($task_type_detail!='') { echo  substr(substr($task_type_detail,0,-1),0,120).'...'; }  }
					
					?></p>

             
                </div>
                <div class="clear"></div>
            </li>
             <?php } } else { ?>
<li> No worker has been added yet.</li>
                         <?php } ?>             
        	
  
        	
  
     
        </ul>
		        

<?php if($total_rows>10) { ?>
					<div class="gonext">
                    <?php echo $page_link; ?>
                    </div>
				<?php } ?>


        
					               

            <div class="clear"></div>

                  	 
                
                
		</div>
   
        <?php echo $this->load->view($theme.'/layout/worker/tasker_sidebar'); ?>  
      
        <div class="clear"></div>



    </div>
</div>


