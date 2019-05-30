<style>
.abc{
float: left;
width: 55px;
}
</style>
<?php
$site_setting=site_setting(); 
$data['site_setting']=$site_setting;
?>
<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
<div>
<div class="red-subtitle top-red-subtitle">Entoworkers </div>
    	<div class="profile_back">
        <div class="container">
        <div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
        <div class="home-signpost-content">
<!--<div class="page-title mbot20">
			<h1 class="mleft15">Worker bees</h1>
</div>-->
    	<div class="dbleft dbleft-main">
        
        
        
        <div class="marB20" style="width: 100%;"><h3 id="detail-bg1">Möt våra Entoworkers</h3></div>

       <div class="abttb3-2">
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
            	<div class="taskphoto taskphoto-2">
                	<?php echo anchor('user/'.$tasker->profile_name,'<img src="'.$user_image.'" alt="" width="50" height="50" class="round-corner" />');?>
                    
                    <a class="tooltip tooltip-2" id="twoonebr1">Level <?php echo $tasker->worker_level;?><span>Level <?php echo $tasker->worker_level;?></span></a>
                	
                </div>
                <div class="taskdetails">
                                    
                    <table width="100%" border="0" cellspacing="1" cellpadding="0">
                      <tr>
                        <td width="22%" class="padTB10 td_width"><?php echo anchor('user/'.$tasker->profile_name,ucfirst($tasker->first_name).' '.ucfirst(substr($tasker->last_name,0,1)).'.',' class="abmarks unl"'); ?></td>
                        <td width="58%" class="td_width"><div class="strmn strmn-2" style="margin-top:2px;"><div class="str_sel str_sel-2 fl" style="width:<?php if($total_rate>5) { ?>100<?php } else { echo round($total_rate*2);?>0<?php } ?>%;"></div></div><div class="fl marL5">(<?php echo anchor('user/'.$tasker->profile_name.'/reviews',$total_review.' Omdömen','class="fpass"');  ?>)</div></td>
                        <td width="20%" class="td_width">
                                       
                                       
                                    
                                        
                                <div class="hire_me">        
                                                   <?php 
                                                   if(!check_user_authentication()) 
                                                   {  
                                                   		echo anchor('login','<b>Välj mig</b>',' class="btn btn-default btn-color fr" ');  
                                                   }  
                                                   else 
                                                   { 
                                                   		if($site_setting->subscription_need==0)
             											{
                                                   		echo anchor('task/new_task/'.$tasker->worker_id,'<b>Välj mig</b>',' id="hireme_'.$tasker->worker_id.'" class="btn btn-default btn-color fr" '); 
                                                   ?>
						 						    <script type="text/javascript">
														jQuery(document).ready(function() {	
															jQuery("#hireme_<?php echo $tasker->worker_id;?>").fancybox();	
														});
													</script>

											  <?php 	} 
											  			else
											  			{
											  				$user_setting=user_profilestatus(get_authenticateUserID());
												            if($user_setting->profile_active==1)
												            {
												            	echo anchor('task/new_task/'.$tasker->worker_id,'<b>Välj mig</b>',' id="hireme_'.$tasker->worker_id.'" class="btn btn-default btn-color fr" '); 
                                               ?>
						 						    <script type="text/javascript">
														jQuery(document).ready(function() {	
															jQuery("#hireme_<?php echo $tasker->worker_id;?>").fancybox();	
														});
													</script>
													<?php
												            }
												            else
												            {
												    ?>
												            	 <a href="javascript:void(0)" class="pupload15 btn btn-default btn-color fr" >Välj mig</a>
                                                                 <!--<a href="<?php echo base_url(); ?>dashboard#horizontalTab3" onclick="return confirm('Sorry !!! In order to hire worker you must subscribe for membership ')" class=""><b></b></a>-->
                          
												     <?php      
												            }

											  			}



													} ?>
                           </div>
                                        
                                          
                        </td>
                      </tr>
                    </table>
                    
                    <p class="abmarks abmarks-2" style="font-size:15px;">
                    <?php 
										$strlen = strlen($tasker->worker_skills);
										if($strlen > 100) { echo substr($tasker->worker_skills,0,100).' ...';}
										else { echo $tasker->worker_skills; } 
									?>
                     <?php echo anchor('user/'.$tasker->profile_name,'Läs mer',' class="unl abmarks"');?></p>
                    <p class="marT5 abmarks abmarks-2 fs14" style="padding-top:5px;"><b>Uppdragspreferenser: </b> <?php 
					
					
					
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
				 
				  		$task_type_detail .=$get_task_type->task_name.' , ';
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
		        </div>

<?php if($total_rows>10) { ?>
					<div class="gonext">
                    <?php echo $page_link; ?>
                    </div>
				<?php } ?>


        
					               

            <div class="clear"></div>

                  	 
                
                
		</div>
   </div>
   		 <div class="dbright-task dbright-task-main">
        <?php echo $this->load->view($theme.'/layout/worker/tasker_sidebar'); ?>  
      	</div>
        <div class="clear"></div>

</div>
<div class="clear"></div>

