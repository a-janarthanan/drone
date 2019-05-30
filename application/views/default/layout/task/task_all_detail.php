<?php  
$site_setting=site_setting(); 
$data['site_setting']=$site_setting;
?>


<link type="text/css" rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/js/css/innerpage-slider.css" />
<style>
#askquestion{ margin-left:9px;}
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
				$category_id =$this->uri->segment(3);
                if($category_id)
                {
                    $tasks_info  =$this->task_model->get_category_task_list($category_id);
                }
                else
                {
                    $tasks_info  =$this->task_model->get_fullall_task_list();
                }
                //echo "<pre>";print_r($tasks_info);
				?>
                <div class="clear"></div>
				<div id="ajax_data_div">
                <div class="list-loadmore-ptd">There are <? if($tasks_info=='0') { echo "0" ; } else { echo sizeof($tasks_info); } ?> new tasks available</div>
                <div class="task-list-left-ptd">
                	<div class="list-splitter-ptd">Tasks</div>
                    <div class="post-task-list-ptd">
                    	<ul>
                            <?php
                             
                            foreach ($tasks_info as $key => $taskinfo) {
                             $city        =get_cityDetail($taskinfo->task_city_id);
                             $user_detail=$this->user_model->get_user_profile_by_id($taskinfo->user_id);
                             $user_image= base_url().'upload/no_image.png';
                             
                             if($user_detail->profile_image!='') {  
                        
                                if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
                            
                                    $user_image_new='/upload/user/'.$user_detail->profile_image;
                                    
                                }
                                else
                                {
                                    $user_image_new='upload/no_image.png';
                                }
                                
                            }
                           
                            ?>
                        	<li>
                            	<a href="<?php echo base_url().'tasks/'.$taskinfo->task_url_name?>">
                                    <div class="post-task1-ptd">
                                        <div class="post-tasker-img-ptd"><img src="<?php echo base_url().$user_image_new ?>" width="72" height="72" alt="" style="border-radius:5px;"/></div>
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
	  data: { 'task_title': task_title,'task_status': task_status,'task_type': task_type, 'sort_by':sort_by,'cat_name':cat_name, 'location_name':location_name } ,
	  success:function(msg){
	  //alert(msg);
			$('#ajax_data_div').html(msg);
		}
	});
	$("#setting_task_ptd").slideToggle();
}
</script>

