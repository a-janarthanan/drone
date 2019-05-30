<?php  
$site_setting=site_setting(); 
$data['site_setting']=$site_setting;
?>


<link type="text/css" rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/js/css/innerpage-slider.css" />
<style>
#askquestion{ margin-left:9px;}
/* Outer */
.popup {
    width:100%;
    height:100%;
    display:none;
    position:fixed;
    top:0px;
    left:0px;
    background:rgba(0,0,0,0.75);
}
 
/* Inner */
.popup-inner {
    max-width:800px;
    width:90%;
    padding:40px;
    position:absolute;
    top:50%;
    left:50%;
    -webkit-transform:translate(-50%, -50%);
    transform:translate(-50%, -50%);
    box-shadow:0px 2px 6px rgba(0,0,0,1);
    border-radius:3px;
    background:#fff;
}
.popup-inner img {
    display: block;
    margin-left: auto;
    margin-right: auto;
}
/* Close Button */
.popup-close {
    width:30px;
    height:30px;
    padding-top:4px;
    display:inline-block;
    position:absolute;
    top:0px;
    right:0px;
    transition:ease 0.25s all;
    -webkit-transform:translate(50%, -50%);
    transform:translate(50%, -50%);
    border-radius:1000px;
    background:rgba(0,0,0,0.8);
    font-family:Arial, Sans-Serif;
    font-size:20px;
    text-align:center;
    line-height:100%;
    color:#fff;
}
 
.popup-close:hover {
    -webkit-transform:translate(50%, -50%) rotate(180deg);
    transform:translate(50%, -50%) rotate(180deg);
    background:rgba(0,0,0,1);
    text-decoration:none;
}
</style>
<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div class="red-subtitle top-red-subtitle" >Posted Task Details</div>
<div>

<div class="profile_back">
<div class="container">
<div class="db-rightinfo db-rightinfo-inner db-rightinfo-inner-round" style="width:100%; margin:0px 0 0 0; background:#e7e7e7 !important; border-radius:10px;">
	<div class="home-signpost-content">
    	<div class="dbleft dbleft-main post-task-main-psd">
			<div class="post-task-left-ptd">
            	<div class="post-task-tab-ptd">
                	<script>
                    	$(document).ready(function(){
							$("#search_task_ptd_open").click(function(){
								$("#search_task_ptd").slideDown();
								$("#setting_task_ptd").slideUp();
							})
						})
						$(document).ready(function(){
							$("#setting_task_ptd_open").click(function(){
								$("#setting_task_ptd").slideToggle();
							})
						})
                        function rest_search()
                        {
                            <?php
                            $this->load->library('session');
                            $this->session->unset_userdata('task_title');
                            $this->session->unset_userdata('task_status');
                            $this->session->unset_userdata('task_type');
                            $this->session->unset_userdata('sort_by');
                            $this->session->unset_userdata('cat_name');
                            $this->session->unset_userdata('location_name');
                            ?>
                            //window.location.href = "<?php echo site_url('task/all_task');?>";
                            window.location.reload();
                        }
                    </script>
                	<ul>
                    	<!--<li><a href="javascript:void(0)" id="search_task_ptd_open"><img src="<?php echo base_url().getThemeName(); ?>/images/search_icon_pt.png" alt="" /> Search</a></li>-->
                        <li><a href="javascript:void(0)" id="setting_task_ptd_open"><img src="<?php echo base_url().getThemeName(); ?>/images/setting_icon_pt.png" alt="" /> Search</a></li>
                    </ul>
                    <div class="post-task-tab-inn-ptd">
                    	<!--<div class="search-ptask-ptd"  id="search_task_ptd" style="display:none;">
                        	<div class="search-box-ptask-ptd pull-left"><input type="text" placeholder="Search Tasks..." onblur="placeholder='Search Tasks...'" onclick="placeholder=''"  /></div>
                            <div class="search-icon-ptask-ptd pull-right"><a href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/search_icon_pt.png" alt="" /></a></div>
                            <div class="clear"></div>
                        </div>-->
                        <div class="setting-ptask-ptd" id="setting_task_ptd" style="display:none;">
                        	<div class="search-box-ptask-ptd pull-left"><input type="text" name="task_title" id="task_title" placeholder="Search Tasks By Name..." onblur="placeholder='Search Tasks By Name...'" onclick="placeholder=''"  /></div>
                            <!--<div class="search-icon-ptask-ptd pull-right"><a href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/search_icon_pt.png" alt="" /></a></div>-->
                            <div class="clear"></div>
                            <div class="settings-inner-ptd">
                            	<div class="search-inn-option-ptd">
                                	<div class="search-field-ptd">Task Status</div>
                                    <div class="button-bar">
										<div class="fl" style="margin-right:10px;"><input type="radio" name="task_status" value="" checked> All</div>
  										<div class="fl"><input type="radio" name="task_status" value="1" <? if($task_status=='1') echo 'checked'; ?>  />Open</div>
                                    	<!--<a class="half selected">All</a>
                                    	<a class="half">Open</a>-->
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="search-inn-option-ptd">
                                	<div class="search-field-ptd">Task Type</div>
                                    <div class="button-bar">
										<div class="fl" style="margin-right:10px;"><input type="radio" name="task_type" value="All" checked> All</div>
  									<!--<input type="radio" name="task_type" value="task_loc" <? if($task_type=='task_loc') echo 'checked'; ?>> Tasks with Location-->
										<div class="fl"><input type="radio" name="task_type" value="online_task" <? if($task_type=='online_task') echo 'checked'; ?>> Online Tasks</div>
                                    	<!--<a class="half selected">All</a>
                                    	<a class="half">Tasks with Location</a>
                                        <a class="half">Online Tasks</a>-->
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="search-inn-option-ptd">
                                	<div class="search-field-ptd">Sort by</div>
                                    <div class="custom-select-ptd">
                                    	<select name="sort_by" id="sort_by">
                                        	<option value="task_id desc" selected="">Most Recent</option>
                                            <!--<option value="distance">Distance</option>-->
                                            <option value="task_status" <? if($sort_by=='task_status') echo 'selected'; ?>>Task Status</option>
                                            <option value="task_to_price asc" <? if($sort_by=='task_to_price asc') echo 'selected'; ?>>Price Ascending</option>
                                            <option value="task_to_price desc" <? if($sort_by=='task_to_price desc') echo 'selected'; ?>>Price Descending</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="search-inn-option-ptd">
                                    <div class="search-field-ptd">Category</div>
                                    <div class="custom-select-ptd">
                                        <? 
                                           $task_category_list =get_category();
                                           //echo "<pre>";print_r($task_category_list);
                                        ?>
                                        <select name="cat_name" id="cat_name">
                                            <option value="" selected="">Select Category</option>
                                           <? 
                                           //$task_category_list =get_category();
                                           //echo "<pre>";print_r($task_category_list);
                                           foreach($task_category_list as $category_info){ ?>
                                           <option value="<?=$category_info->task_category_id;?>" <? if($cat_name==$category_info->task_category_id) echo 'selected'; ?>><?=$category_info->category_name?></option>
                                           
                                           <? } ?>
                                        </select>
                                        <!--<input name="location_name" id="location_name" value="<? echo $location_name ?>" type="text" placeholder="Enter a location">-->
                                        <!--<div class="at-icon-remove-ptd"><img src="<?php echo base_url().getThemeName(); ?>/images/remove_icon_ptd.png" alt="" /></div>-->
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="search-inn-option-ptd">
                                	<div class="search-field-ptd">City</div>
                                    <div class="custom-select-ptd">
										<select name="location_name" id="location_name">
                                        	<option value="" selected="">Select City</option>
                                           <? foreach($task_city_list as $city_idd=>$city_namee){ ?>
										   <option value="<?=$city_idd?>" <? if($location_name==$city_idd) echo 'selected'; ?>><?=$city_namee?></option>
										   
										   <? } ?>
                                        </select>
                                    	<!--<input name="location_name" id="location_name" value="<? echo $location_name ?>" type="text" placeholder="Enter a location">-->
                                        <!--<div class="at-icon-remove-ptd"><img src="<?php echo base_url().getThemeName(); ?>/images/remove_icon_ptd.png" alt="" /></div>-->
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <!--<div class="search-inn-option-ptd">
                                	<div class="search-field-ptd">Show Tasks Within</div>
                                    <div class="custom-select-ptd">
                                    	<select>
                                        	<option value="5km" selected="">5km</option>
                                            <option value="10km">10km</option>
                                            <option value="15km">15km</option>
                                            <option value="25km_asc">25km</option>
                                            <option value="50km">50km</option>
                                            <option value="100km">100km</option>
                                            <option value="Everywhere">Everywhere</option>
                                        </select>
                                    </div>
                                </div>-->
                                <div class="setting-last-btns-ptd">
                                	<div class="btn btn-default sett-update-btn-ptd">
                                    	<a href="javascript:;" onclick="getajaxdata()">Update</a>
                                    </div>
                                    <div class="btn btn-default sett-reset-btn-ptd">
                                    	<a href="#" onclick="rest_search()">Reset</a>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<?php
                
                    $tasks_info  =$this->task_model->get_fullall_task_list();
                
                
				?>
                <div class="clear"></div>
				<div id="ajax_data_div">
                <div class="list-loadmore-ptd">There are <? echo sizeof($tasks_info) ?> new tasks available</div>
                <div class="task-list-left-ptd">
                	<div class="list-splitter-ptd">Tasks</div>
                    <div class="post-task-list-ptd">
                    	<ul>
                            <?php
                             
                            foreach ($tasks_info as $key => $taskinfo) {
                             $city        =get_cityDetail($taskinfo->task_city_id);
                             $user_detail=$this->user_model->get_user_profile_by_id($taskinfo->user_id);
                             $user_image_new= base_url().'upload/no_image.png';
                             
                             if($user_detail->profile_image!='') {  
                        
                                if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
                            
                                    $user_image_new=base_url().'/upload/user/'.$user_detail->profile_image;
                                    
                                }
                                
                            }
                            
                                $link=base_url().'tasks/'.$taskinfo->task_url_name;
                           
                           
                            ?>
                        	<li>
                            	<a href="<?php echo $link ?>">
                                    <div class="post-task1-ptd">
                                        <div class="post-tasker-img-ptd"><img src="<?php echo $user_image_new ?>" width="72" height="72" alt="" style="border-radius:5px;"/></div>
                                        <div class="post-task-info-ptd">
                                            <div class="post-task-info-left-ptd">
                                                <h2><?php echo $taskinfo->task_name ?></h2>
                                                <p><img src="<?php echo base_url().getThemeName(); ?>/images/pin_icon_pt.png" alt="" /><?php echo $city->city_name ?></p>
                                            </div>
                                            <div class="post-task-price-ptd">
                                                <div class="post-task-budget-ptd"><?php echo $site_setting->currency_symbol ?> <br /> <?php echo $taskinfo->task_to_price ?></div>
                                                <div class="ptask-earn-btn-ptd">Earn</div>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </a>
                            </li>
                            <?php } ?>
                            
                        </ul>
                    </div>
                </div>
           		</div>
				</div>
            <div class="post-task-right-ptd">
				<?php if($msg!='') { 
                    
                            if($msg=='no') { 
                ?>
                <div id="error"><ul><p>You have not sufficient amount to assign task to a Worker bee.</p></ul></div>
                <script type="text/javascript"> 
                   jQuery(document).ready(function() { 
                    jQuery("#autostart").fancybox({'overlayShow':true,frameWidth: 
                838,frameHeight:540}).trigger('click'); 
                  }); 
                </script> 
                <a id="autostart" href="<?php echo site_url('task/add_amount/'.$task_id.'/'.$task_comment_id);?>"></a> 
                <?php } if($msg=='assign') { ?>
                <div id="success"><ul><p>Task has been assigned to a Worker bee successfully..</p></ul></div>
                <?php } if($msg=='fail') { ?>
                <div id="error"><ul><p>Transaction process failed please try again.</p></ul></div>
                <?php } if($msg=='remove') { ?>
                <div id="success"><ul><p>Offer has been removed successfully.</p></ul></div>
                <?php }  if($msg=='fail_remove') { ?>
                <div id="error"><ul><p>Unable to remove your offer, please try again.</p></ul></div>
                <?php }  if($msg=='offer_update') { ?>
                <div id="success"><ul><p>Offer has been updated successfully.</p></ul></div>
                <?php }  if($msg=='fail_update') { ?>
                <div id="error"><ul><p>Unable to update your offer, please try again.</p></ul></div>
                <?php } } ?>
				<div class="">
                    <ul class="taskname">
                    <!--<li class="photo">
                         <?php
						
						    $user_detail=$this->user_model->get_user_profile_by_id($task_detail->user_id);
							$user_image= base_url().'upload/no_image.png';
							 
							 if($user_detail->profile_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
							
									$user_image=base_url().'upload/user/'.$user_detail->profile_image;
									
								}
								
							} 
						 
						 
						  echo anchor('user/'.$task_user_detail->profile_name,'<img src="'.$user_image.'" width="72" height="72" alt="" style="border-radius:5px;"/>'); ?>
                    </li>-->
                    <li class="taskn fl urgent_task urgent_task-detail" >
                        <div class="imgright imgright-12">
                            <div id="s1post"><h2 class="taskname" style="margin-bottom:10px; font-size:26px;"><?php echo ucfirst($task_detail->task_name);?></h2></div>
							<div>
                            	<div class="pull-left">
									<?php
                                        $user_detail=$this->user_model->get_user_profile_by_id($task_detail->user_id);
                                        $user_image= base_url().'upload/no_image.png';
                                        if($user_detail->profile_image!='') {  
                                            if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
                                                $user_image=base_url().'upload/user/'.$user_detail->profile_image;
                                            }
                                            
                                        } 
                                        echo anchor('user/'.$task_user_detail->profile_name,'<img src="'.$user_image.'" width="40" height="40" alt="" style="border-radius:5px;"/>'); 
                                    ?>
                                </div>
                                <span class="days pull-left" style="padding:10px 0 0 10px;">by 
                                	<?php echo anchor('user/'.$task_user_detail->profile_name,ucfirst($task_user_detail->first_name).' '.ucfirst(substr($task_user_detail->last_name,0,1)).'.',' class="fpass" ');?>
                                 </span>
                             </div>
                            <div class="clear"></div>
                            <div class="job-status-main-block" style="border:0px;">
                            	<ul>
                                	<li>
                                    	<div class="posted-bar-line-jp posted-bar-line-first-jp <?php if($task_detail->task_activity_status==0) { ?> active-post-jp <?php } ?>"></div> <!--****** 'active-post-jp' add this class for selected  ******-->
                                        <div class="posted-bar-text-jp">Open</div>
                                    </li>
                                    <li>
                                    	<div class="posted-bar-line-jp <?php if($task_detail->task_activity_status==1) { ?> active-post-jp <?php } ?>"></div>
                                        <div class="posted-bar-text-jp">Accepted</div>
                                    </li>
                                    <li>
                                    	<div class="posted-bar-line-jp posted-bar-line-last-jp <?php if($task_detail->task_activity_status==3) { ?> active-post-jp <?php } ?>"></div>
                                        <div class="posted-bar-text-jp">Complete</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="<?php if($task_detail->done_online==1) echo "Online_class";?>"></div>
                        <div class="<?php if($task_detail->task_urgent==1) echo "Urgent_class";?>"></div>
                        <div class="post-task-info-right-ptd">
                            <div class="urgent-price urgent-price-detail">
                                <b>Project Budget (<?php echo $site_setting->currency_symbol ?>)</b> <br />
                                <?php echo $site_setting->currency_symbol.$task_detail->task_to_price.' - '.$site_setting->currency_symbol.$task_detail->task_price; ?>
                            </div>
                            <div class="clear"></div>
                            <?php
							
                            if(check_user_authentication()) { 
                                          
								$check_worker_detail=$this->worker_model->check_user_worker_detail(get_authenticateUserID());
								
								if($check_worker_detail) { 
							 
								if(get_authenticateUserID() != $task_detail->user_id) { 
									$get_worker_bid=$this->task_model->get_worker_bid_on_task($task_id);
									
									if($get_worker_bid)
									{
															
									}	 					
									else {
									
									 if($task_detail->task_activity_status==0) {

										if($site_setting->credit_need==1)
										{
											$user_setting=user_profilestatus(get_authenticateUserID());
                                            $user_info = $this->user_model->get_user_info(get_authenticateUserID());
                                           
											//echo "<pre>";print_r($user_info);

                                            if($user_info->avilable_bid>=2)
											{
												echo anchor('task/offer_task/'.$task_id,'Make an Offer',' id="offer_task" class="btn btn-default make-offer-btn-ptd" ');
											}
											else
											{
										?>
											<a href="javascript:void(0)" class="btn btn-default pupload14 make-offer-btn-ptd"><b>Make an Offer</b></a>
										<?php
											}
										}
										else
										{
											echo anchor('task/offer_task/'.$task_id,'Make an Offer',' id="offer_task" class="btn btn-default make-offer-btn-ptd" ');
										}
	
										//echo "<span style='padding-left:5px;'>OR</span>"; 
										
	
									  }
								  
								  
								}
								/* if($task_detail->task_activity_status==0) {
								
													  
								  echo anchor('task/ask_question/'.$task_id,'<b>Ask for question</b>',' id="askquestion" class="btn btn-default marR5 make-offer-btn-ptd" ');
								 
								 } */
								
								?>
								  <script type="text/javascript">
											jQuery(document).ready(function() {	
												jQuery("#offer_task").fancybox();	
											   // jQuery("#askquestion").fancybox();	
												
											});
									</script>
									
									
								<?php } } }
								 
							/*  if(check_user_authentication()) { 
                                          
                                                $check_worker_detail=$this->worker_model->check_user_worker_detail(get_authenticateUserID());
                                                
                                                if($check_worker_detail) { 
                                             
                                                if(get_authenticateUserID() != $task_detail->user_id) { 
                                                
                                            
                                            
                                            
                                              
                                              
                                                
                                     
                                                    $get_worker_bid=$this->task_model->get_worker_bid_on_task($task_id);
                                                    
                                                    if($get_worker_bid)
                                                    {
                                                                            
                                                    }	 					
                                                    else {
                                                    
                                                     if($task_detail->task_activity_status==0) {
                                                     
                                                         echo anchor('task/offer_task/'.$task_id,'Make an Offer',' id="offer_task" class="btn btn-default make-offer-btn-ptd" ');
                                                 echo "<span style='padding-left:5px;'>OR</span>";
                                                      }
                                                  
                                                  
                                                }
                                                 if($task_detail->task_activity_status==0) {
                                                
                                                                      
                                                  echo anchor('task/ask_question/'.$task_id,'<b>Ask for question</b>',' id="askquestion" class="btn btn-default marR5" ');
                                                 
                                                 } 
                                                
                                                ?>
                                                  <script type="text/javascript">
                                                            jQuery(document).ready(function() {	
                                                                jQuery("#offer_task").fancybox();	
                                                                jQuery("#askquestion").fancybox();	
                                                                
                                                            });
                                                    </script>
                                                    
                                                    
                                                <?php } } }    */
							?>
                            
                            
                            <?php   if(check_user_authentication()) { 
			  
			  		$check_worker_detail=$this->worker_model->check_user_worker_detail(get_authenticateUserID());
					
					if($check_worker_detail) { 
                 
				 	if(get_authenticateUserID() != $task_detail->user_id) { 
						
		 			
						$offer_user_detail=$this->user_model->get_user_profile_by_id(get_authenticateUserID());
						
						
		 				$get_worker_bid=$this->task_model->get_worker_bid_on_task($task_id);
						
						if($get_worker_bid)
						{  ?>
                            <div class="estim colgreen fs14 fl" style="width:100%;">
                                <!--<p class="marB5"><?php  echo anchor('user/'.$offer_user_detail->profile_name,'<b>'.ucfirst($offer_user_detail->first_name).'</b> '.ucfirst(substr($offer_user_detail->last_name,0,1)),' class="col fs14 unl"'); ?></p>-->
                    
                                <p class="marB5">Your Offer : <?php echo $site_setting->currency_symbol.$get_worker_bid->offer_amount;
                      				if($task_detail->task_activity_status==0) { 
                        
                             echo anchor('task/edit_offer_on_task/'.$task_id.'/'.$get_worker_bid->task_comment_id,'Edit Offer',' id="edit_offer" class="btn btn-default make-offer-btn-ptd" style=" margin-top:5px;" ');
                             
                             ?>
                             
                                <script type="text/javascript">
                                        jQuery(document).ready(function() {	
                                            jQuery("#edit_offer").fancybox();										
                                        });
                                </script>
                                            
                                            
                             <?php
                       }
                      				?>
                      			</p>
                            </div>
                            <?php } } } } ?>
                            <div class="clear"></div>
                            <script type="text/javascript" >
								$(document).ready(function()
								{
								$(".sett-drop-account-tcr").click(function()
								{
								var X=$(this).attr('id');
								if(X==1)
								{
									$(".drop-set-submenu-tcr").hide();
									$(this).attr('id', '0');	
									$(".sett-drop-account-tcr").removeClass("sett-drop-active-class");
								}
								else
								{
									$(".drop-set-submenu-tcr").show();
									$(this).attr('id', '1');
									$(".sett-drop-account-tcr").addClass("sett-drop-active-class");
								}
								});
								//Mouseup textarea false
								$(".drop-set-submenu-tcr").mouseup(function()
								{
								return false
								});
								$(".sett-drop-account-tcr").mouseup(function()
								{
								return false
								});
								$(document).mouseup(function()
								{
									$(".drop-set-submenu-tcr").hide();
									$(".sett-drop-account-tcr").attr('id', '');
									$(".sett-drop-account-tcr").removeClass("sett-drop-active-class");
								});
									
							});
							</script>
                            <div class="more-opt-dropmenu-ptd">
                                <div class="dropdown-setting-tcr">
                                    <a class="sett-drop-account-tcr" >
                                        <span>More Options</span>
                                    </a>
                                    <div class="drop-set-submenu-tcr" style="display: none;">
                                        <ul class="root">
                                            <li>
												<?php 
                                                     if(!check_user_authentication()) 
                                                     {  
                                                        echo anchor('sign_up','Post Similar Job ',' class="post-similar-job-btn-ptd" ');  
                                                     }  
                                                     else 
                                                     { 
                                                        if($site_setting->subscription_need==0)
                                                        {
                                                        echo anchor('task/update_task_step_zero/'.$task_detail->task_id.'/copy','Post Similar Job ',' id="copytask" class="post-similar-job-btn-ptd" '); 
                                        
                                                        ?>
                                         
                                                                   <script type="text/javascript">
                                                                        jQuery(document).ready(function() {	
                                                                            jQuery("#copytask").fancybox();	
                                                                        });
                                                                </script>
                                        
                                                    <?php 
                                                        } 
                                                        else
                                                        {
                                        
                                                            $user_setting=user_profilestatus(get_authenticateUserID());
                                                            if($user_setting->profile_active==1)
                                                            {
                                                            echo anchor('task/update_task_step_zero/'.$task_detail->task_id.'/copy','Post Similar Job',' id="copytask" class="post-similar-job-btn-ptd" '); 
                                        
                                                        ?>
                                         
                                                                   <script type="text/javascript">
                                                                        jQuery(document).ready(function() {	
                                                                            jQuery("#copytask").fancybox();	
                                                                        });
                                                                </script>
                                        
                                                    <?php 
                                                            }
                                                            else
                                                            {
                                                    ?>
                                                                    <a href="javascript:void(0)" class="post-similar-job-btn-ptd"><b>Post Similar Job</b></a>    
                                                    <?php		
                                                            }
                                        
                                        
                                                        }
                                                    }
                                                    ?>
                                            </li>
                                            <!--<li>
                                            	<?php if(!check_user_authentication()) 
												   {  echo anchor('sign_up','Copy Job','class="copy-job-btn-ptd"');  }  else { echo anchor('task/update_task_step_zero/'.$task_detail->task_id.'/copy','Copy Task',' id="copytask1" class="copy-job-btn-ptd"'); ?>
						 
												   <script type="text/javascript">
														jQuery(document).ready(function() {	
															jQuery("#copytask1").fancybox();	
														});
												</script>
											<?php } ?>
                                            </li>-->
                                            <li>
                                            	<?php   if(check_user_authentication()) { 
			  
											$check_worker_detail=$this->worker_model->check_user_worker_detail(get_authenticateUserID());
											
											if($check_worker_detail) { 
										 
											if(get_authenticateUserID() != $task_detail->user_id) { 
												
											
												$offer_user_detail=$this->user_model->get_user_profile_by_id(get_authenticateUserID());
												
												
												$get_worker_bid=$this->task_model->get_worker_bid_on_task($task_id);
												
												if($get_worker_bid)
												{  ?>
                                            	<?php   if($task_detail->task_activity_status==0) {
			
													echo anchor('task/remove_offer_on_task/'.$task_id,'Remove Offer',' class="remove-offer-btn-ptd" ');
												  } }}}}										
												  ?>
                                            </li>
                                            <li>
                                            	<?php  $chk_bid=0;
					  
												$chk_worker_bid=check_worker_bid_on_task($task_detail->task_id);
												
												if($chk_worker_bid)
												{
													$chk_bid=1;
												}
												
										  
												if($task_detail->user_id == get_authenticateUserID() && $task_detail->task_activity_status==0 && $chk_bid==0) { ?>
										   		<?php 
													echo anchor('task/edit_task/'.$task_detail->task_id,'Edit Task','class="copy-job-btn-ptd"'); ?>
										   		<?php } ?>
                                            </li>
                                            <li>
                                            	<a href="javascript:void()" onClick="window.open('http://www.facebook.com/share.php?u=<?php echo site_url('tasks/'.$task_detail->task_url_name);?>&amp;t=<?php echo $task_detail->task_name; ?>','Share on Facebook','height=300,width=600,top=50,left=300');" class="fb-shareicon-ptd">Share on Facebook</a>
                                            </li>
                                            <li>
                                            	<a href="javascript:void()" onClick="window.open('http://twitter.com/home?status=<?php echo $task_detail->task_name; ?> <?php echo site_url('tasks/'.$task_detail->task_url_name);?>','Share on Twitter','height=300,width=600,top=50,left=300');" class="twitter-shareicon-ptd">Share on Twitter</a>
                                            </li>
                                            <li>
                                            	<a href="https://plus.google.com/share?url=<?php echo site_url('tasks/'.$task_detail->task_url_name);?>" onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="gplus-shareicon-ptd">Share on google+</a>
                                            </li>
                                            <li>
                                            	<a href="javascript:void()" onClick="window.open('https://www.linkedin.com/shareArticle?mini=true&url=https://www.linkedin.com/&title=&summary=&source=','Share on Linkedin','height=300,width=600,top=50,left=300');" class="linkdin-shareicon-ptd">Share on Linkedin</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class=""></div>
                            </div>
                            <?php 
							if(check_user_authentication()) {
							$check_is_worker=$this->worker_model->check_is_worker_new(get_authenticateUserID());
							
							 if($check_is_worker==0) {
							?>
								 <div class="pricing_pro" style="text-align:center;">
									<p style="font-size: 14px;margin: 5px auto;">Note: You must apply to become a Helper before bidding!</p>
									<?php   echo anchor('who-are-the-taskers','Apply','class="" style="font-weight:bold; color:#ec6600;"'); ?>
								 </div>
							<?php } 
							}
							else
							{
							?>
							<div class="pricing_pro" style="text-align:center;">
								<p style="font-size: 14px;margin: 5px auto;">Note: You must apply to become a Helper before bidding!</p>
								<?php   echo anchor('login','Apply','class="" style="font-weight:bold; color:#ec6600;"'); ?>
							</div>
							<?php } ?>
                        </div>
                        <div class="clear"></div>
                        <div  style="float:right; margin-top:10px;">
                            <?php 
							  /*if(check_user_authentication()) { 
                                          
                                                $check_worker_detail=$this->worker_model->check_user_worker_detail(get_authenticateUserID());
                                                
                                                if($check_worker_detail) { 
                                             
                                                if(get_authenticateUserID() != $task_detail->user_id) { 
                                                
                                            
                                            
                                            
                                              
                                              
                                                
                                     
                                                    $get_worker_bid=$this->task_model->get_worker_bid_on_task($task_id);
                                                    
                                                    if($get_worker_bid)
                                                    {
                                                                            
                                                    }	 					
                                                    else {
                                                    
                                                     if($task_detail->task_activity_status==0) {

                                                        if($site_setting->subscription_need==1)
                                                        {
                                                            $user_setting=user_profilestatus(get_authenticateUserID());
                                                            if($user_setting->profile_active==1)
                                                            {
                                                                echo anchor('task/offer_task/'.$task_id,'<b>Place Bid</b>',' id="offer_task" class="btn btn-default" ');
                                                                
                                                            }
                                                            else
                                                            {
                                                    ?>
                                                    		<a href="<?php echo base_url(); ?>dashboard#horizontalTab3" onclick="return confirm('Sorry !!! In order to place your offer , you must subscribe for membership')" class="btn btn-default pupload14"><b>Place Bid</b></a>
                                                            
                                
                                                       <?php
                                                            }
                                                        }
                                                        else
                                                        {
                                                            echo anchor('task/offer_task/'.$task_id,'<b>Place Bid</b>',' id="offer_task" class="btn btn-default" ');
                                                                
                                                        }

                                                        echo "<span style='padding-left:5px;'>OR</span>"; 
                                                        

                                                      }
                                                  
                                                  
                                                }
                                                 if($task_detail->task_activity_status==0) {
                                                
                                                                      
                                                  echo anchor('task/ask_question/'.$task_id,'<b>Ask for question</b>',' id="askquestion" class="btn btn-default marR5" ');
                                                 
                                                 } 
                                                
                                                ?>
                                                  <script type="text/javascript">
                                                            jQuery(document).ready(function() {	
                                                                jQuery("#offer_task").fancybox();	
                                                                jQuery("#askquestion").fancybox();	
                                                                
                                                            });
                                                    </script>
                                                    
                                                    
                                                <?php } } }  
                              		/*if(get_authenticateUserID() == $task_detail->user_id && $task_detail->task_activity_status==0 ) { 
                                            
                                              echo anchor('task/post_message/'.$task_id,'<b>Post Message</b>',' id="postmessage" class="cm login marR5" ');
                                              
                                              ?>
                                              
                                              <script type="text/javascript">
                                                            jQuery(document).ready(function() {	
                                                                jQuery("#postmessage").fancybox();										
                                                            });
                                                    </script>
                                                    
                                                  
                                                <?php }  */ ?>  
                        </div>
                    </li>
                    </ul>
                    <div class="clear"></div>
                </div>
				<div class="marB20">
                	<div class="inside-subtitle">Task Description</div>
					
                	<div>
                    	<div class="fleft100"> <label class="city city-main" style="width:10%">City : </label><span id="need" style="font-weight:normal;"><?php echo ucfirst($task_detail->city_name); ?></span></div>
                    	<br />
                        <div class="fleft100"> <label class="city city-main" style="width:10%">Time :</label><span id="need" style="font-weight:normal;"><?php if($task_detail->task_end_day ) { ?><?php echo date("d/m/Y", strtotime($task_detail->task_end_day)); } ?>&nbsp;&nbsp;<?php echo $task_detail->task_end_time; ?></span></div>
                	</div>                
                    <div class="fleft100 mtop30">
                        <div class="inside-subtitle">Description</div>
                        <p class=""><?php  
                      
                            $task_description= $task_detail->task_description;		
                            $task_description=str_replace('KSYDOU','"',$task_description);
                            $task_description=str_replace('KSYSING',"'",$task_description);				
                            echo 	ucfirst($task_description);?>
                        </p><br><br>
                        <!-- <b>Can be done:</b> Online or by phone-->
						<div>
							<?php if($task_detail->task_imgname) { ?>
							  <a data-popup-open="popup-1" href="#" /><img src="<?php echo base_url(); ?>/upload/task_image/<?php echo $task_detail->task_imgname ?>" height="150px" width="200px"></a>
							  <div class="popup" data-popup="popup-1">
								<div class="popup-inner">
								   <img src="<?php echo base_url(); ?>/upload/task_image/<?php echo $task_detail->task_imgname ?>" align="middle"/>
								   <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
								</div>
							  </div>
							<?php } ?>
							<script type="text/javascript">
							$(function() {
									//----- OPEN
									$('[data-popup-open]').on('click', function(e)  {
										var targeted_popup_class = jQuery(this).attr('data-popup-open');
										$('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
								 
										e.preventDefault();
									});
								 
									//----- CLOSE
									$('[data-popup-close]').on('click', function(e)  {
										var targeted_popup_class = jQuery(this).attr('data-popup-close');
										$('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
								 
										e.preventDefault();
									});
								});
							</script>
					</div>
                    </div> 
					<?php if($task_detail->task_work_doc!="") { ?>
                    <div class="fleft100 mtop30">
                        <div class="inside-subtitle">Attachment</div>
                        <p><a href="<?php echo base_url();?>task/download/<?php echo rawurlencode($task_detail->task_work_doc) ?>" > <img src="<?php echo base_url().getThemeName(); ?>/images/downloading-updates.png" alt="" /></a></p> 
                        <br><br>
                    </div>
                    <?php } ?>
                    
				</div>
                
                
                
				<!--<div class="marB20">
                <h3 id="detail-bg1">Multimedia Attachments</h3>
                <div class="multiimg">
                    <a href="#"><img width="100" height="100" alt="" src="<?php echo base_url().getThemeName(); ?>/images/dash_r2.png"></a>
                    <a href="#"><img width="100" height="100" alt="" src="<?php echo base_url().getThemeName(); ?>/images/dash_r3.png"></a>
                    <a href="#"><img width="100" height="100" alt="" src="<?php echo base_url().getThemeName(); ?>/images/dash_r1.png"></a>
                </div>                
                </div>-->
			   
         <?php 
		   
		   $data['offers_on_task']=$offers_on_task;
		  
		  if(get_authenticateUserID() == $task_detail->user_id ) { 
		  
		   				if($offers_on_task) { ?>    

			<div class="marB20">
                <div class="inside-subtitle">Offers</div>
                <!--<ul class="ulsty2">
				<?php 
				$i= 0;
					foreach($offers_on_task as $offers) {  $i++;
					
					
					
						
				$user_image= base_url().'upload/no_image.png';
				 
				 if($offers->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$offers->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$offers->profile_image;
						
					}
					
				}
				
				
				
				?>                
                               
                
                <li class="posrel">
                    <div class="taskphoto taskphoto-2">
                      					   
					     <?php echo anchor('user/'.$offers->profile_name,'<img src="'.$user_image.'" alt="" width="60" height="60" class="round-corner"  /> ');?>
                    
                           <a class="tooltip tooltip-2" id="twoonebr1">Level <?php echo $offers->worker_level;?><span>Level <?php echo $offers->worker_level;?> Worker bee</span></a>

                	</div>
                    
                    <div class="taskdetails taskdetails-15">
                    	<div class="fl taskdetails-15-15">
                      		<?php echo anchor('user/'.$offers->profile_name,ucfirst($offers->first_name).' '.ucfirst(substr($offers->last_name,0,1)),' class="abmarks abmarks-2 unl"'); ?>
                      		<p class="colmark colmark-2" style="width:338px;"><?php echo $offers->task_comment;?></p>
                            <p class="geo geo-2"><?php echo getDuration($offers->comment_date,$task_id); ?></p>   
                        </div>
                        <div class="catle3n2 fr" style="width:196px; color:#585858;">
                            <ul class="ulnobor">
                                <li style="border-bottom:none;" class="LH16">
                                    <p class="marB5 fs14"><b>Offer Amount : </b><span class="fpass fs14 colora"><?php echo $site_setting->currency_symbol.$offers->offer_amount; ?></span></p>
                                    <p class="fs14"><b>Offer On : </b><?php echo date($site_setting->date_time_format,strtotime($offers->comment_date)); ?></p>
                                </li>
                                <div class="clear"></div>
                              </ul>        
                        </div>
                    </div>
                   		
                                        <div class="clear"></div>
            
            
            
            
                  <div class="marTB5">
        		
                     
                         <div class="runlright runlright-1" style="width: 58%;">
            	<div class="alignright" >
                
                 <?php 
					$worker_detail = $this->worker_model->check_user_worker_detail($offers->comment_post_user_id);
				?>
	        	
             <?php echo anchor('user_task/conversation/'.$worker_detail->worker_id.'/'.$task_id,'Conversation',' class="btn btn-default mar-bot-5" '); ?>       
	        	
             <?php if($task_detail->task_activity_status==0 ) { echo anchor('task/accept_offer/'.$task_id.'/'.$offers->task_comment_id,'Accept Offer',' class="btn btn-default mar-bot-5" '); }
			 
			 
			 if($task_detail->task_activity_status==1 && $task_detail->task_worker_id==$offers->worker_id) {
			 
			  echo anchor('user_task/complete/'.$task_id,'Complete Task',' class="btn btn-default mar-bot-5" '); 
			 
			 
			 echo anchor('dispute/dispute_task/'.$task_id,'Dispute Task',' class="btn btn-default mar-bot-5" ');
			 
			 }
			 
			 
			 
			  ?>
                                          
                            </div>
                        </div>
                        <div class="clear"></div>    
                    </div>
                    <div class="clear"></div>
                    
                    
                </li>
                
                
			<?php }   ?>
            
            
            
                
                
                
                
                
                
                
                
                
                
                
                
                </ul>-->
                	<p style="color:#585858; text-align:center; font-size:17px; padding:0 0 20px 0;"><?php echo anchor('user_task/worker_offer/'.$task_id,'Click here','style="color:#881926; font-weight:bold;"'); ?> to check all offers placed on this task</p>
                </div>
         <?php } 
		 
		 
		 } ?>
         
         
         <!--<?php if($similar_tasks) { 
        
       		 if(count($similar_tasks)>2) { ?>
        <div class="inside-subtitle">TASKS SIMILAR TO THIS ONE</div>
		<div class="fleft100">
			<ul class="tasks-status">
                <?php  foreach($similar_tasks as $task_info) { 
		
		
			$user_detail=$this->user_model->get_user_profile_by_id($task_info->user_id);
				$user_image= base_url().'upload/no_image.png';
				 
				 if($user_detail->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$user_detail->profile_image;
						
					}
					
				}
				
			
			$total_rate=get_user_total_rate($task_info->user_id);
		
		   ?>
                <li class="posrel">
                <div class="taskphoto taskphoto-2"><?php echo anchor('user/'.$task_info->profile_name,'<img src="'.$user_image.'" width="60" height="60" alt="" class="round-corner" />'); ?></div>
                <div class="taskdetails">
                <h2 class="abmarks abmarks-2 unl"><?php echo anchor('tasks/'.$task_info->task_url_name,ucfirst($task_info->task_name));?></h2>
                <p class="colmark colmark-2"><span class="nelly">posted by <?php echo '<b>'.ucfirst($task_info->first_name).' '.ucfirst(substr($task_info->last_name,0,1)).'.</b>'; ?></span> <span class="newyorkc">in <?php echo $task_info->city_name; ?></span></p>
                <div class="strmn strmn-2"><div class="str_sel str_sel-2 fl" style="width:<?php if($total_rate>5) { ?>100<?php } else { echo round($total_rate*2);?>0<?php } ?>%;"></div></div>
                </div>
                </li>
			<?php  } ?>    
            </ul>
            </div>
         
       <?php  }
	 
	 } ?>-->     
         
			<?php 
           
           $data['comments']=$comments;
           $login_worker_id=0;
            $check_worker_detail=$this->worker_model->check_user_worker_detail(get_authenticateUserID());
            
            if($check_worker_detail) {  $login_worker_id=$check_worker_detail->worker_id; }
            
            // if($task_detail->task_is_private==0 || $task_detail->user_id==get_authenticateUserID() || $task_detail->task_worker_id==$login_worker_id) {  
           ?>
           
            <div class="marB20">
                <div class="clear"></div>
                <div class="inside-subtitle comm-inside-subtitle-ptd">Comments</div>
                <?php
                    echo anchor('task/ask_question/'.$task_id,'<b>Ask for question</b>',' id="askquestion" class="btn btn-default marR5 pull-right ask-question-btn-ptd " ');
                ?>
                <script type="text/javascript">
                    jQuery(document).ready(function() {	
                        jQuery("#askquestion").fancybox();	
                    });
                </script>
                <?php if($task_detail->task_is_private==0) {  
                if($comments) { ?>
                    <div class="task-comments-block-ptd">
                        <?php 
                        $i= 0;
                            foreach($comments as $comment) {  $i++;
                        $user_detail=$this->user_model->get_user_profile_by_id($comment->comment_post_user_id);
                        $user_image= base_url().'upload/no_image.png';
                         if($user_detail->profile_image!='') {  
                    
                            if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
                        
                                $user_image=base_url().'upload/user/'.$user_detail->profile_image;
                                
                            }
                            
                        }
                        
                        ?>
                        <div class="task-comm-box1-ptd">
                            <div class="comm-tasker-img-ptd pull-left">
                                <?php echo anchor('user/'.$user_detail->profile_name,'<img src="'.$user_image.'" alt="" class="round-corner" />');?>
                            </div>
                            <div class="task-comm-detail-ptd pull-right">
                                <div class="comment-top-title-ptd">
                                    <h2><?php echo anchor('user/'.$comment->profile_name,'<b>'.ucfirst($comment->first_name).'</b> '.ucfirst(substr($comment->last_name,0,1)),' class=""'); ?></h2>
                                    <h3><?php echo getDuration($comment->comment_date,$task_id); ?></h3>
                                    <div class="clear"></div>
                                </div>
                                <div class="comment-area-ptd">
                                    <p><?php echo $comment->task_comment;?></p>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                            <div class="fl" style="margin-top:7px; overflow:hidden;" >
                                    <?php
                                    
                                    $reply_already=0;
                                    
                                    
                                    $check_already_reply=$this->task_model->check_public_message_reply($comment->task_comment_id);
                                    
                                    if($check_already_reply)
                                    {
                                    $reply_already=1;
                                    }
                                    
                                    
                                    if(get_authenticateUserID() == $task_detail->user_id && $task_detail->task_activity_status==0 && $reply_already==0) {
                                    
                                    echo anchor('task/post_message/'.$task_id.'/'.$comment->task_comment_id,'Reply',' id="postmessage_'.$comment->task_comment_id.'" class="btn btn-default" ');
                                    
                                    ?>
                                
                                    <script type="text/javascript">
                                    jQuery(document).ready(function() {
                                    jQuery("#postmessage_<?php echo $comment->task_comment_id; ?>").fancybox();
                                    });
                                    </script>
                                    
                                    
                                    <?php } ?>
                                </div>
                            <div class="clear"></div>
                            <?php if($reply_already==1) {
                            
                            $get_reply=$this->task_model->get_owner_public_reply($task_id,$comment->task_comment_id);
                            
                            if($get_reply)
                            {
                            
                            
                            $reply_user_detail=$this->user_model->get_user_profile_by_id($get_reply->comment_post_user_id);
                            $reply_user_image= base_url().'upload/no_image.png';
                            
                            if($reply_user_detail->profile_image!='') {
                            
                            if(file_exists(base_path().'upload/user/'.$reply_user_detail->profile_image)) {
                            
                            $reply_user_image=base_url().'upload/user/'.$reply_user_detail->profile_image;
                            
                            }
                            
                            }
                            ?>
                            <!-- ans s -->
                            <div class="posrel posrel-1">
                                <div class="taskphoto taskphoto-2">
                                    <?php echo anchor('user/'.$reply_user_detail->profile_name,'<img src="'.$reply_user_image.'" alt="" width="60" height="60" class="round-corner" />');?>
                                    <?php $check_worker_detail=$this->worker_model->check_user_worker_detail($get_reply->comment_post_user_id);
                                    if($check_worker_detail) {
                                    ?>
                                    <a class="tooltip tooltip-2" id="twoonebr1">Level <?php echo $check_worker_detail->worker_level;?><span>Level <?php echo $check_worker_detail->worker_level;?> Worker bee</span></a>
                                    <?php } ?>
                                </div>
                                <div class="taskdetails">
                                    <div ><?php echo anchor('user/'.$get_reply->profile_name,'<b>'.ucfirst($get_reply->first_name).'</b> '.ucfirst(substr($get_reply->last_name,0,1)),' class="abmarks abmarks-2 unl"'); ?></div>
                                    <div>
                                        <p class="colmark colmark-2"><?php echo $get_reply->task_comment;?></p>
                                        <p class="geo geo-2"><?php echo getDuration($get_reply->comment_date,$task_id); ?></p>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <?php } } ?>
                        <?php }   ?>
                    </div>
                <?php } } ?>
            </div>
            
         
         
    
   <?php /*?><?php if($similar_tasks) { 
        
       		 if(count($similar_tasks)>2) { ?>
                 
<div class="task_new">
	<h3 id="detail-bg1">Tasks similar to this one</h3>



<div id="container-inner">
    <div id="carousel-inner">
      
       
		<?php  foreach($similar_tasks as $task_info) { 
		
		
			$user_detail=$this->user_model->get_user_profile_by_id($task_info->user_id);
				$user_image= base_url().'upload/no_image.png';
				 
				 if($user_detail->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$user_detail->profile_image;
						
					}
					
				}
				
			
			$total_rate=get_user_total_rate($task_info->user_id);
		
		   ?>
           <div class="taskoneN1">
                <div class="taskoneleft">
                    <div><?php echo anchor('user/'.$task_info->profile_name,'<img src="'.$user_image.'" width="50" height="50" alt="" />'); ?></div>
                    <div class="str"><div class="str_sel" style="width:<?php if($total_rate>5) { ?>100<?php } else { echo round($total_rate*2);?>0<?php } ?>%;"></div></div>
                </div>
                 <div class="taskoneright">
                    <div style="height:40px"><?php echo anchor('tasks/'.$task_info->task_url_name,ucfirst($task_info->task_name),' class="fpass"');?></div>
                    <h4 style="height:30px"><span class="nelly">posted by <?php echo '<b>'.ucfirst($task_info->first_name).' '.ucfirst(substr($task_info->last_name,0,1)).'.</b>'; ?></span> <span class="newyorkc">in <?php echo $task_info->city_name; ?></span></h4>
                    <h4 style="height:30px"><span class="nelly"><?php echo $site_setting->currency_symbol.$task_info->task_price; ?></span> <!--<span class="newyorkc">for Tasks of this type</span>--></h4><br/>
                      
					  
					  <div style="height:20px">
					  <?php  if(!check_user_authentication()) {  echo anchor('sign_up','Copy',' class="chbg"'); } else { echo anchor('task/update_task_step_zero/'.$task_info->task_id.'/copy','Copy','  class="chbg"  id="copy_'.$task_info->task_id.'"  ');?>
                      </div>
                      
                      <script type="text/javascript">
								jQuery(document).ready(function() {	
									jQuery("#copy_<?php echo $task_info->task_id;?>").fancybox();	
								});
						</script>
                        
                        <?php    }?>
                      
                </div>
                <div class="clear"></div>
            </div>                
      
			<?php  } ?>        
   
                  
                    
				</div>
                
             
    <a href="#" id="ui-carousel-next-inner"><span>next</span></a>
    <a href="#" id="ui-carousel-prev-inner"><span>prev</span></a>
   
     
			</div>	


		<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/lib/innerpage-slider.js"></script>
		<script type="text/javascript">
			jQuery(function($) {
				$("#carousel-inner").rcarousel({
					visible: 2,
					step: 1,
					width: 250,
					height: 150,
					auto: {
						enabled: true,
						interval: 3000,
						direction: "next"
					}
				});
				
				$("#ui-carousel-next-inner")
					.add("#ui-carousel-prev-inner")
					.hover(
						function(){
							$(this).css("opacity",0.7);
						},
						function(){
							$(this).css("opacity",1.0);
						}
					);				
			});
		</script>
        
       
     
<!-- slider e-->              
</div>                

     <?php  }
	 
	 } ?><?php */?>          
                
                
               </div>
            <div class="clear"></div>
		</div>
        <div class="clear"></div>
        <!--<div class="similar-job-block-ptd">
        	<?php if($similar_tasks) { 
        
       		 if(count($similar_tasks)>2) { ?>
                <div class="inside-subtitle">TASKS SIMILAR TO THIS ONE</div>
                <div class="fleft100">
                    <ul class="tasks-status">
                        <?php  foreach($similar_tasks as $task_info) { 
                
                
                    $user_detail=$this->user_model->get_user_profile_by_id($task_info->user_id);
                        $user_image= base_url().'upload/no_image.png';
                         
                         if($user_detail->profile_image!='') {  
                    
                            if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
                        
                                $user_image=base_url().'upload/user/'.$user_detail->profile_image;
                                
                            }
                            
                        }
                        
                    
                    $total_rate=get_user_total_rate($task_info->user_id);
                
                   ?>
                        <li class="posrel">
                        <div class="taskphoto taskphoto-2"><?php echo anchor('user/'.$task_info->profile_name,'<img src="'.$user_image.'" width="60" height="60" alt="" class="round-corner" />'); ?></div>
                        <div class="taskdetails">
                        <h2 class="abmarks abmarks-2 unl"><?php echo anchor('tasks/'.$task_info->task_url_name,ucfirst($task_info->task_name));?></h2>
                        <p class="colmark colmark-2"><span class="nelly">posted by <?php echo '<b>'.ucfirst($task_info->first_name).' '.ucfirst(substr($task_info->last_name,0,1)).'.</b>'; ?></span> <span class="newyorkc">in <?php echo $task_info->city_name; ?></span></p>
                        <div class="strmn strmn-2"><div class="str_sel str_sel-2 fl" style="width:<?php if($total_rate>5) { ?>100<?php } else { echo round($total_rate*2);?>0<?php } ?>%;"></div></div>
                        </div>
                        </li>
                    <?php  } ?>    
                    </ul>
                    </div>
                 
               <?php  }
             
             } ?>
        </div>-->
        <div class="clear"></div>
	</div>
    <div class="clear"></div>
    <!--<div class="dbright-task dbright-task-main">
        <?php //echo $this->load->view($theme.'/layout/task/task_detail_side_bar',$data); ?>  
    </div>-->
</div>
<div class="clear"></div>
        </div>
        <div class="clear"></div>



    </div>
</div>

<script>
//set ajax for search result from left menu
function getajaxdata(){

    var task_title = $( "#task_title" ).val();
	var task_status = $("input[name='task_status']:checked").val();
	var task_type = $("input[name='task_type']:checked").val();
	var sort_by = $( "#sort_by" ).val();
    var cat_name =$( "#cat_name" ).val();
	var location_name = $( "#location_name" ).val();
	$.ajax({
	  type: "POST",
	  url: '<? echo $task_ajax_link?>',
	  data: { 'task_title': task_title,'task_status': task_status,'task_type': task_type, 'sort_by':sort_by,'cat_name':cat_name,'location_name':location_name } ,
	  success:function(msg){
	  //alert(msg);
			$('#ajax_data_div').html(msg);
		}
	});
	$("#setting_task_ptd").slideToggle();
}
</script>

