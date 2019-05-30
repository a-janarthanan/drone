<?php
$site_setting=site_setting();
$data['site_setting']=$site_setting;
?>
<div class="main">
<div class="incon">
    	<div class="mconleft">

       <div id="s1postJ" class="fl">Search:</div>
       <?php
			$attributes = array('name'=>'frm_search_task_worker','class'=>'fr marT10');
			
			
			if($cityname!='') 
			{ 
				echo form_open('search/in/'.$cityname,$attributes);
			}
			else
			{
				echo form_open('search',$attributes);
			}
			
			
	   ?>
            <input type="text" name="search" id="search" class="hsearchbg1"  placeholder="Enter your text search" value="<?php echo urldecode($search); ?>" />
            <input type="submit" class="submbgsearch" value="Search">
        </form>
        <div class="clear"></div>
        
        
        
        <h3 id="detail-bg1"><span class="fl"> <?php echo $total_rows; ?> Tasks found</span><span class="fr"><?php if($total_rows != 0) { echo '1-'.$total_rows.' of '.$total_rows; }?></span><div class="clear"></div></h3>
        
<ul class="ulsty">

						<?php 
						
						$worker_arr=array();
						
							if($result) {
									foreach($result as $row) { 
									
									$worker_arr[]=$row->task_worker_id;
									
									
									
									
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
                            	<?php echo anchor('user/'.$row->profile_name,'<img src="'. $user_image.'" alt="" width="50" height="50" />');?>
                            </div>
                        	<div class="catle2 LH18">
                            	<?php echo anchor('tasks/'.$row->task_url_name,$row->task_name,' class="fpass fs13"');?>
                                <p>
									<?php                                            
										$task_description= $row->task_description;		
										$task_description=str_replace('KSYDOU','"',$task_description);
										$task_description=str_replace('KSYSING',"'",$task_description);
		
										$strlen = strlen($task_description);
										if($strlen > 50) { echo substr($task_description,0,80).' ...';}
										else { echo $task_description; } 
                                    ?>   
								</p>
                                <span class="geo">
                                <?php  
									$taskdate = $row->task_post_date;
									echo getDuration($taskdate);
								?>
                                </span>
                                
                               <span class="marL20">Tasks of this type: <span class="orange"><?php echo $site_setting->currency_symbol.$row->task_to_price.' - '.$site_setting->currency_symbol.$row->task_price;?></span>
                            </div>
                           
                           
                            <div class="fr wid120">
                       
                    
                         <?php if(!check_user_authentication()) {  echo anchor('sign_up','Use Template',' class="cm temp" ');  }  else { echo anchor('task/update_task_step_zero/'.$row->task_id.'/copy','Use Template',' id="copytask_'.$row->task_id.'" class="cm temp" '); ?>
 						   <script type="text/javascript">
								jQuery(document).ready(function() {	
									jQuery("#copytask_<?php echo $row->task_id;?>").fancybox();	
								});
						</script>

<?php } ?>
                        
                        
                            </div>
                            <div class="clear"></div>
                        </li>
                        
                        <?php } }
						
						$data['worker_arr']=$worker_arr;
						
						 ?>
            		</ul>

					 <?php if($total_rows>10) { ?>
					<div class="gonext">
                    <?php echo $page_link; ?>
                    </div>
				<?php } ?>
                    <div class="clear"></div>
        
                
		</div>
     
    <?php echo $this->load->view($theme.'/layout/search/search_side_bar',$data); ?>  
        <div class="clear"></div>



    </div>
</div>

