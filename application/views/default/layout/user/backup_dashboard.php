<link rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/js/lib/themes/base/jquery.ui.all.css">
<style type="text/css">    

.flexy-menu{margin: 0!important}

.flexy-menu{width: 100%;margin:0;padding: 0;position:relative;float:left;font-family: "Source Sans Pro", Segoe UI, Arial;list-style: none;

background:#666;}

.flexy-menu li{display:inline-block;font-size:14px;margin:0;padding:0;float:left;line-height: 20px;position:relative;}

.flexy-menu > li > a{padding:20px 22px;color:#ccc;text-decoration:none;display:block;text-transform:uppercase;-webkit-transition:color 0.2s linear, background 0.2s linear;-moz-transition:color 0.2s linear, background 0.2s linear;-o-transition:color 0.2s linear, background 0.2s linear;transition:color 0.2s linear, background 0.2s linear;}

.flexy-menu li:hover > a,.flexy-menu li.active a {background: #555;color: #fff;}

.flexy-menu li.right{float: right;}

.flexy-menu ul, .flexy-menu ul li ul{list-style: none;margin: 0;padding: 0;display: none;position: absolute;z-index: 99999;width: 132px;background: #333333;box-shadow: 0 1px 1px rgba(0,0,0,0.3)}

.flexy-menu ul{top: 60px;left: 0}

.flexy-menu ul li ul{top: 0;left: 100%}

.flexy-menu ul li{clear:both;width:100%;border: none;font-size:12px;}

.flexy-menu ul li a{padding:10px 20px;width:100%;color:#dedede;font-size:13px;text-decoration:none;display:inline-block;float:left;clear:both;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;-webkit-transition:color 0.2s linear, background 0.2s linear;-moz-transition:color 0.2s linear, background 0.2s linear;-o-transition:color 0.2s linear, background 0.2s linear;transition:color 0.2s linear, background 0.2s linear;}

.flexy-menu > li .indicator{position: absolute;color: #dedede;top: 20px;right: 8px;font-size: 17px;}

.flexy-menu ul > li .indicator{top: 10px;right: 8px}

.thin > li > a{padding: 10px 22px}

.thin ul{top: 40px}

.thin > li .indicator{top: 10px}

.thick > li > a{padding: 40px 22px}

.thick ul{top: 100px}

.thick > li .indicator{top: 40px}

.flexy-menu i{line-height: 20px !important; margin-right: 6px;font-size:14px; float:left; font-style:normal}

.flexy-menu > li.showhide{display: none;width: 100%;height: 50px;cursor: pointer;color:#dedede;border-bottom: solid 1px rgba(0, 0, 0, 0.1);background: #333333}

.flexy-menu > li.showhide span.title {margin: 16px 0 0 25px;float: left}

.flexy-menu > li.showhide span.icon {margin:17px 20px; float:right}

.flexy-menu > li.showhide .icon em {margin-bottom: 3px; display: block; width:20px; height:2px; background:#ccc}

.orange li:hover > a, .orange li.active a{background:#f2413e;color: #fff!important}

.flexy-menu.vertical {width: 100%}

.flexy-menu.vertical li {width: 100%; border-bottom: 1px solid #fff}

.flexy-menu.vertical li a {display:inline-block !important; width:100%; padding:10px 20px; box-sizing:border-box; -moz-box-sizing:border-box;-webkit-box-sizing: border-box}

.flexy-menu.vertical ul li{width: 100%}

.flexy-menu.vertical ul, .flexy-menu.vertical ul li ul {width: 150px}

.flexy-menu.vertical ul {top:0; left:100%}

.flexy-menu.vertical ul li ul{top:0}

.flexy-menu.vertical.right {float:right !important}

.flexy-menu.vertical.right ul{left: -150px !important;}

.flexy-menu.vertical > li .indicator{top: 10px;right: 15px;font-size: 17px;}

.flexy-menu.vertical ul > li .indicator{top:10px;right: 15px;}

@media only screen and (max-width:1142px)

{

.flexy-menu.vertical{width: 100%}

.flexy-menu li{display: block;width: 100%}

.flexy-menu > li > a{padding-top:15px;padding-bottom:15px;padding-left: 25px}

.flexy-menu a{width: 100%;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box}

.flexy-menu ul, .flexy-menu ul li ul,.flexy-menu.vertical ul, .flexy-menu.vertical ul li ul{width: 100%;left: 0;border-left: none;position: static;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box}

.flexy-menu ul li{border-left: none;border-right: none}

.flexy-menu ul li a, .flexy-menu.vertical ul li a{padding-top:10px;padding-bottom:10px}

.flexy-menu ul > li > a {padding-left: 40px !important}

.flexy-menu > li .indicator{top: 15px;right: 25px;font-size: 17px}

.flexy-menu ul > li .indicator{right: 24px}

.flexy-menu.vertical ul > li .indicator{top: 10px;right: 15px}

.flexy-menu > li > ul > li > a {padding-left: 40px !important}

.flexy-menu > li > ul > li > ul > li > a {padding-left: 60px !important}

.flexy-menu > li > ul > li > ul > li > ul > li > a {padding-left: 80px !important;}

}

</style>


<script type="text/javascript">
	  jQuery.noConflict();
      jQuery(document).ready(function ($) {

        "use strict";

        $('#Default').perfectScrollbar();

        $('#LongThumb').perfectScrollbar({minScrollbarLength:100});

      });

	

    </script>
    <script type="text/javascript">

	jQuery(function() {
		jQuery("#tabs").tabs();	
		jQuery("#pupload2").fancybox();	
		 jQuery("#sprogress").fancybox();    
	});


</script>
<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/responsive-verticalmenu_files/jquery-1.js"></script>

<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/responsive-verticalmenu_files/flexy-menu.js"></script>

<script type="text/javascript">$(document).ready(function(){$(".flexy-menu").flexymenu({speed: 400,type: "vertical", indicator: true});});</script>

<script async src="<?php echo base_url().getThemeName(); ?>/responsive-verticalmenu_files/a.js" type="text/javascript"></script>
<?php 	$site_setting=site_setting(); 
$data['user_profile']=$user_profile;
?>

<!--<div class="dashboard-title" style="margin:162px 0 0 0;font-size: 3vw;">

<p class="dbtitle">DASHBOARD</p>

<p class="welcome-user"><span class="welcome-text"><?php echo $this->session->userdata('full_name'); ?></span></p>

</div>-->
<div id="two-columnar-section" style="margin:160px 0 0 0">
<div class="inside-task-fwidth">
<div class="db-rightinfo" style="width:100%; margin:0">
<div class="home-signpost-content">
<div class="dashboard-leftmenu">
<div class="editphoto-button">
<?php

 if($user_profile->profile_image!='') {  
					
						if(file_exists(base_path().'upload/user/'.$user_profile->profile_image)) { ?>
                        
                        <img src="<?php echo base_url(); ?>upload/user/<?php echo $user_profile->profile_image;?>" width="150" height="" alt="" class="fl" style="padding-left:65px;"  />
                        
                        <?php } else { ?>
                        
                  <img src="<?php echo base_url(); ?>upload/no_image.png" width="150" height="" alt="" class="fl" style="padding-left:65px;"  />
                    
                    <?php } } else { ?>
                    
                    <img src="<?php echo base_url(); ?>upload/no_image.png" width="150" height="" alt="" class="fl" style="padding-left:65px;"  />
                    
                    <?php } ?> 
				    <div class="editphoto-button">
                    <a href="user/upload_photo/dashboard" id="pupload2"><span style="color:red">Edit Photo</span></a>
                    </div>

</div>
<ul class="dash-left-menu">
<a href="dashboard"><li class="dash">Dashboard</li></a>
<a href="account"><li class="myacc">My Account</li></a>
<a href="user/<?php echo getUserProfileName() ?>"><li class="profile">My Profile</li></a>
<a href="message/allmessage"><li class="message">Messages</li></a>
<a href="wallet"><li class="payment">Payment</li></a>
<a href="home/logout"><li class="logout">Logout</li></a>
</ul>
<div style="height:10px;clear: both;">&nbsp;</div>
<div>
 <?php $check_is_worker=check_is_worker(get_authenticateUserID()); ?>
 <?php if($check_is_worker) { ?>
						<?php echo anchor('worker/edit','Tasker Profile','class="b-button"');?>
                    <?php } else {?>
						<?php echo anchor('who-are-the-taskers','Become a Tasker','class="b-button"');?>
					<?php } ?>
</div>
</div>
<div class="dash-right">
<div class="subsection-title">Dashboard</div>
<div class="fleft100 mtop15">
<div class="welcome-box">
<p class="pr-status" style="margin:15px; text-align:center; float:left; width:91%; text-align:center; padding:0">Welcome <?php echo $user_profile->first_name; ?></p>
<span class="bigf33" style="float:left; width:99%; font-family:Arial, Helvetica, sans-serif; margin:15px 0 0 0; padding:0; font-size:16px; text-align:center">What do you need done today?</span>
<div class="fleft100 mtop30"><a href="<?php echo base_url()?>task/newhome_task"><img src="<?php echo base_url().getThemeName(); ?>/images/posttasknew.png" border="0"></a></div>
</div>

<div class="fleft48" style="border:#ccc 1px solid">
<div class="subsection-title">Messages</div>
<div class="home-signpost-content" style="width:98%">
<div id="Default" class="contentHolder" style="float:left; height:250px">
<div class="content" style="float:left; height:225px; text-align:left">
<ul class="messages" style="height:225px; overflow:auto">
		<?php $allmessage = $this->message_model->get_message_by_id();
        
            if($allmessage){
			
			echo anchor('message','<p class="alert"><strong>Alerts('.get_user_unread_notification().')</strong></p>','class="fpass"');
			
                foreach($allmessage as $res){
				
					$act=$res->act;
									
						if($res->is_read == 1 ) { $color = '#000000;'; } else { $color = '#27668B;'; }
						
						$poster = $this->message_model->get_worker_details($res->poster_user_id);
						
						
						$user_image= base_url().'upload/no_image.png';
				 
						 if($poster->profile_image!='') {  
					
							if(file_exists(base_path().'upload/user/'.$poster->profile_image)) {
						
								$user_image=base_url().'upload/user/'.$poster->profile_image;
								
							}
							
						}
						
						
						switch ($act)
						{
							case 'newoffer': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />New offer has been posted on <strong class="colblue fsNorm">'.$res->task_name.'</strong> by <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'newmessage': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />New message from <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> on <strong class="colblue fsNorm">'.$res->task_name.'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'offeraccept': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />Your offer accepted by <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> on <strong class="colblue fsNorm">'.$res->task_name.'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'taskcomplete': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" /><strong class="colblue fsNorm">'.$res->task_name.'</strong> has been marked completed by <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'taskfinish': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" /><strong class="colblue fsNorm">'.$res->task_name.'</strong> is all finished by  <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'workerwallet': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />Payment for <strong class="colblue fsNorm">'.$res->task_name.'</strong> has been credited to your wallet</p>','style="color:'.$color.'"').'<div class="clear"></div></li>';
							break;
							
							case 'taskdispute':  echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" /><strong class="colblue fsNorm">'.$res->task_name.'</strong> has been disputed by  <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'newconversation': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />New Conversation message from <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> on <strong class="colblue fsNorm">'.$res->task_name.'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'taskdisputeconversation': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />New Dispute Conversation message from <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> on <strong class="colblue fsNorm">'.$res->task_name.'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							 
							  
							  
							  	case 'taskwin': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />You won the dispute <strong>'.$res->task_name.'</strong>. Amount credited to your wallet.</p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 							
							break;
							
							case 'taskloss': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />You loss the dispute <strong>'.$res->task_name.'</strong>. Amount credited to <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 																	
							break;
							
							case 'taskcompromise': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" /><strong>'.$res->task_name.'</strong> is compromised between Poster and Tasker. Amount credited to your wallet. </p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 																	
							break;
							
							case 'taskresume': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />Your dispute task <strong>'.$res->task_name.'</strong> is resume.</p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 																	
							break;
							 
							 
							 
							  
							  case 'taskassign': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />Your offer accepted on <strong>'.$res->task_name.'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
	break;



							
							default:
                                        
						
						
					}
					
					
                
                }
			}
			else
			{
        ?>
		<li>No message avilable</li>
		<?php } ?>
    </ul>
</div>

</div>

</div>

</div>

<div class="fright48" style="border:#ccc 1px solid">
<div class="subsection-title">Task history</div>
<div class="home-signpost-content" style="width:98%">
<div id="Default1" class="contentHolder" style="float:left; height:250px">
<div class="content" style="float:left; height:225px; text-align:left; overflow:auto">
<ul class="messages">
<?php if($my_task) { ?>
           <?php foreach($my_task as $mtask) {
		   
		   $close_status='';
		   
		   if($mtask->task_activity_status==3) { $close_status='lockbg '; } 
		   
		    ?>         	
                        
                        
                        <li>
                             	<div class="taskhleft">
                                	<div><?php echo anchor('tasks/'.$mtask->task_url_name,ucfirst($mtask->task_name),' class="'.$close_status.'homepick"');?></div>
                                   	<div>
                                   
                                   
                                     <span class="geo">
                                   <?php if($mtask->task_status==2) { ?>
                                   Drafted <?php echo getDuration($mtask->task_post_date); ?>
                                   <?php } else {
								   
								   				if($mtask->task_activity_status==0) { ?>
                                                
                                                 Posted <?php echo getDuration($mtask->task_post_date); ?>
								   
								   			<?php } if($mtask->task_activity_status==1) { ?>
                                            Assigned <?php echo getDuration($mtask->task_assigned_date); ?>
                                            
                                            <?php } if($mtask->task_activity_status==2) { ?>
                                            
                                            Completed <?php echo getDuration($mtask->task_complete_date); ?>
                                            
                                              <?php } if($mtask->task_activity_status==3) { ?>
                                              Closed about <?php echo getDuration($mtask->task_close_date); ?>
                                              
                                              <?php } if($mtask->task_activity_status==4) { ?>
                                              Cancelled about <?php echo getDuration($mtask->task_cancel_date); ?>
											  <?php }
											  
							   } ?>
								 </span>  
								
                                    
                                    
                                    
                                    
                                    </div>
                                </div>
                             	<div class="taskhrig">
                                	 <a href="javascript:void();" class="fr"  onclick="remove_div2(this)"><img src="<?php echo base_url().getThemeName(); ?>/images/close.png" alt="Close"></a><div class="clear"></div>
								
                                
                                	<?php if($mtask->task_status==2 || $mtask->task_status==3) { echo anchor('task/step_one/'.$mtask->task_id,'post it!',' id="postit"'); } ?>
                                    
                                    
                                    
                                </div>
                                <div class="clear"></div>
                      </li>
                      
                      
               <?php } 
			   
			    } else {?>                   
                      
          <li style="padding:5px 0 0 0;">No Task History Available </li>          
                    
			<?php } ?>
                    </ul>


 </div>
</div>
</div>
</div>


</div>
</div>
</div>
</div>

<div class="db-fullwidth" style="margin:25px 0 0 0">
<div class="subsection-title">Earn some moola! &#45; find and bid on suitable jobs</div>
<div class="db-fwidth-cont">
<div class="browse-ts">
<div id="browse-tasks" style="margin:25px 0 0 0">
<div class="red-subtitle" style="background:#363636">Find jobs by category</div>
<ul class="flexy-menu orange vertical">

<?php

$category_infos=get_category();

if($category_infos) { $ccnti=0;
foreach($category_infos as $category_info) {

if($ccnti<5) {
$sub_categories = sub_category($category_info->task_category_id);
if($sub_categories){
?>
<li style="display: block;"><?php echo anchor('tags/'.$category_info->category_url_name,$category_info->category_name);?>
<ul style="display: none;">
<?php foreach($sub_categories as $sub_category) { ?>
<li><?php echo anchor('tags/'.$sub_category->category_url_name,$sub_category->category_name);?></li>
<?php } ?>
</ul>
<?php } else {?>
<li><?php echo anchor('tags/'.$category_info->category_url_name,$category_info->category_name);?></li>
<?php  }
$ccnti++;   } } ?>

<li style="display: block;"><?php echo anchor('tags','View all','id="" style="padding:10px 0 10px 130px"');?></li>

<?php } ?>



</ul>

</div>
</div>


<div class="search-task">
<div class="mapicon-ph ">
<img style="margin:0 10px 0 0" src="<?php echo base_url().getThemeName(); ?>/images/map-icon.png">
</div>
<div class="vtaskmap">
<div class="view-map-button"><a href="map/"><img src="<?php echo base_url().getThemeName(); ?>/images/view-task-map-new.png" border="0"></a></div>
</div>
</div>

<div class="search-map">
<div id="search-task">
<div class="tasksearch-inner">
    	<div class="search-taskph">
        <?php
			$attributes = array('name'=>'frm_search_task_worker',);
			
			
			
				echo form_open('search',$attributes);
			
			
			
	   ?>
		<input type="text" class="emailid" onBlur="if(this.value == '') {this.value = 'Task Search'}" onFocus="if(this.value == 'Task Search') 
        {this.value = ''}" value="Task Search" name="search" style="width:55%; float:left; margin:0;">
        <input type="submit" class="submbgsearchnew" value="Search">
         </form>
        </div>        
</div>
</div>
</div>

</div>
</div>
</div>
</div>
<div class="clear"></div>
</div>