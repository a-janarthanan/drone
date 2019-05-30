<?php
error_reporting(E_ALL ^ E_NOTICE);
$site_setting=site_setting();
$data['site_setting']=$site_setting;
?>
<!--<style type="text/css">
.gonext {
float: right;
display: block;
width: 575px;
margin: 10px 0px;
}
.onefv {
    float: left;
    font-family: arial;
    font-size: 13px;
    padding: 5px;
}
a.nextN {
float: left;
-moz-border-radius: 10px;
-webkit-border-radius: 10px;
border-radius: 5px;
background-color: #fff;
text-align: center;
padding: 3px 0px;
border: 1px solid #cbcbcb;
width: 80px;
font-size: 12px;
font-weight: bold;
margin-right: 9px;
}
.onefv a span {
margin: 0px 10px;
}
.onefv a {
color: red;
}
</style>-->
<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
<div>
<div class="red-subtitle top-red-subtitle">Aktiva uppdrag</div>
<div class="profile_back">
<div class="container">
<div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
<div class="home-signpost-content">

    	<div class="dbleft dbleft-main dbleft-main-1 " style="float:none; margin:auto; padding:0px !important; min-height:400px; ">

       	<div class="search-form">
			<?php
                $attributes = array('name'=>'frm_search_task_worker','class'=>'marT15');
                
                
                if($cityname!='') 
                { 
                    echo form_open('search/in/'.$cityname,$attributes);
                }
                else
                {
                    echo form_open('search',$attributes);
                }
            ?>
                <input type="text" name="search" id="search" class="hsearchbg1 hsearchbg1-1 fl" autocomplete="off" style="margin-top: 0px !important; width:190px; height:24px;"  placeholder="Sök bland uppdrag" onclick="this.placeholder=''" onblur="this.placeholder='Sök bland uppdrag'" value="<?php echo urldecode($search); ?>" />
                <input type="submit" class="btn btn-default fr" value="Sök">
            </form>
        </div>
        <div class="clear"></div>
        
        
        
        <h3 id="detail-bg1"><span class="fl"> <?php echo $total_rows; ?> Aktiva jobb</span><span class="fr"><?php if($total_rows != 0) { echo '1-'.$total_rows.' of '.$total_rows; }?></span><div class="clear"></div></h3>
        
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
                            	<?php echo anchor('user/'.$row->profile_name,'<img src="'. $user_image.'" alt="" class="round-corner" width="60" height="60" class="round-corner" />');?>
                            </div>
                        	<div class="catle2 LH18 fl">
                            	<?php echo anchor('tasks/'.$row->task_url_name,$row->task_name,' class="abmarks abmarks-2"');?>
                                <p class="colmark colmark-2">
									<?php                                            
										$task_description= $row->task_description;		
										$task_description=str_replace('KSYDOU','"',$task_description);
										$task_description=str_replace('KSYSING',"'",$task_description);
		
										$strlen = strlen($task_description);
										if($strlen > 50) { echo substr($task_description,0,80).' ...';}
										else { echo $task_description; } 
                                    ?>   
								</p>
                                <span class="colmark colmark-2">Ersättning för uppdrag: <?php echo $site_setting->currency_symbol.$row->task_to_price.' - '.$site_setting->currency_symbol.$row->task_price;?></span>
                                <br />
                                <span class="geo geo-2">
                                <?php  
									$taskdate = $row->task_post_date;
									echo getDuration($taskdate);
								?>
                                </span>
                                
                               
                            </div>
                           	
                            <div class="btn-top" style="margin-top:16px; float:right;">
                       
                    
                         <?php 
                         if(!check_user_authentication()) 
                         {  
                         	echo anchor('sign_up','Kopiera uppdrag',' class="btn btn-default" ');  
                         }  
                         else 
                         { 
                         	if($site_setting->subscription_need==0)
             				{
                         	echo anchor('task/update_task_step_zero/'.$row->task_id.'/copy','Kopiera uppdrag',' id="copytask_'.$row->task_id.'" class="btn btn-default" '); ?>
 						    <script type="text/javascript">
								jQuery(document).ready(function() {	
									jQuery("#copytask_<?php echo $row->task_id;?>").fancybox();	
								});
							</script>

						<?php 
						    }
						    else
						    {
						    	$user_setting=user_profilestatus(get_authenticateUserID());
			                    if($user_setting->profile_active==1)
			                    {
			                    	echo anchor('task/update_task_step_zero/'.$row->task_id.'/copy','Kopiera uppdrag',' id="copytask_'.$row->task_id.'" class="btn btn-default" '); ?>
		 						    <script type="text/javascript">
										jQuery(document).ready(function() {	
											jQuery("#copytask_<?php echo $row->task_id;?>").fancybox();	
										});
									</script>
								<?php

			                    }
			                    else
			                    {
			                    ?>
                                <a href="javascript:void(0)" class="btn btn-default pupload13"><b>Kopiera uppdrag</b></a>
			                    <?php
			                    }
						    }


						 } 

						?>
                        
                        
                            </div>
                            <?php if($row->done_online==1) { ?>
                            <div class="fr" style="margin-right: 70px; margin-top: 20px;"><img src="<?php echo base_url().getThemeName()?>/images/online_switch.png"></div>
                            <?php } ?>
                            <div class="clear"></div>
                        </li>
                        
                        <?php } }
						
						$data['worker_arr']=$worker_arr;
						
						 ?>
            		</ul>
<div class="clear"></div>
					 <?php if($total_rows>10) { ?>
					<div class="gonext">
                    <?php echo $page_link; ?>
                    </div>
				<?php } ?>
                    <div class="clear"></div>
        
                
		</div>
        <div class="clear"></div>
     <!--<div class="dbright-task dbright-task-main">
    <?php //echo $this->load->view($theme.'/layout/search/search_side_bar',$data); ?> 
    </div>-->
    </div>
    <div class="clear"></div>
 </div> 
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>

