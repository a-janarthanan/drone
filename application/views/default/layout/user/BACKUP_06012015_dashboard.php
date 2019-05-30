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

<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/responsive-verticalmenu_files/jquery-1.js"></script>

<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/responsive-verticalmenu_files/flexy-menu.js"></script>

<script type="text/javascript">$(document).ready(function(){$(".flexy-menu").flexymenu({speed: 400,type: "vertical", indicator: true});});</script>

<script async src="<?php echo base_url().getThemeName(); ?>/responsive-verticalmenu_files/a.js" type="text/javascript"></script>
<script type="text/javascript">

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
<?php 	$site_setting=site_setting(); 
$data['user_profile']=$user_profile;
?>

<div class="dashboard-title" style="margin:162px 0 0 0;font-size: 3vw;">

<p class="dbtitle">DASHBOARD</p>

<p class="welcome-user"><span class="welcome-text"><?php echo $this->session->userdata('full_name'); ?></span></p>

</div>
<div id="two-columnar-section">

<div class="inside-task">



<div class="db-rightinfo" style="width:100%; margin:25px 0 0 0">

<div class="subsection-title">PERSONAL INFO</div>

<div class="home-signpost-content">
<div class="dbleft">
<div style="float:left; width:150px">

      <?php

 if($user_profile->profile_image!='') {  
					
						if(file_exists(base_path().'upload/user/'.$user_profile->profile_image)) { ?>
                        
                        <img src="<?php echo base_url(); ?>upload/user/<?php echo $user_profile->profile_image;?>" width="150" height="" alt="" class="fl"  />
                        
                        <?php } else { ?>
                        
                  <img src="<?php echo base_url(); ?>upload/no_image.png" width="150" height="" alt="" class="fl"  />
                    
                    <?php } } else { ?>
                    
                    <img src="<?php echo base_url(); ?>upload/no_image.png" width="150" height="" alt="" class="fl"  />
                    
                    <?php } ?> 
				    <div class="editphoto-button">
                    <a href="user/upload_photo/dashboard" id="pupload2"><img src="<?php echo base_url().getThemeName(); ?>/images/edit-photo.png" border="0"></a>
                    </div>

</div>
<div class="profile-completeness">
<?php $profile_complete=user_profile_complete(); ?>
<p class="pr-status">Your Profile is<br><span class="bigf33"><?php echo anchor('user/complete_profile/',$profile_complete.' % complete','class="fpass" id="sprogress" style="font-size: 25px;" '); ?></span></p>
<div class="statusbar-ph">
<div style="width:<?php echo $profile_complete; ?>%;" class="statusbar"></div>
<div class="view-profile-button" style="margin-top:45px;"><a href="user/<?php echo getUserProfileName() ?>">
<img src="<?php echo base_url().getThemeName(); ?>/images/view-profile.png" border="0"></a></div>
</div>
</div>
<!--<div class="fleft59" style="padding-left: 10px;">
<p class="sec-title">Update Your Profile Picture</p>
<p class="common-text" style="font-size: 15px;">Worker bees feel better about working with you when they can see your face.</p>
<?php //echo anchor('user/upload_photo/dashboard','Update photo',' id="pupload2" class="yellow-button"');?>
<a href="user/upload_photo/dashboard" style="margin:30px 0 0 0; float:left" id="pupload2"><img src="<?php echo base_url().getThemeName(); ?>/images/update-photo.png" border="0"></a>
</div>-->
</div>

<!--<div class="dbcenter">
<?php $profile_complete=user_profile_complete(); ?>
<p class="pr-status">Your Profile is <span class="bigf33"><?php echo anchor('user/complete_profile/',$profile_complete.' % complete','class="fpass" id="sprogress" style="font-size: 25px;" '); ?></span></p>
<div class="statusbar-ph">
<div class="statusbar" style="width:<?php echo $profile_complete; ?>%;"></div>
</div>
<div style="float:left; margin-top:50px; margin-left:125px;"><?php echo anchor('user/'.getUserProfileName(),'View profile','class="yellow-button"'); ?></div>

</div>-->

<div class="dbright">
<a href="<?php echo base_url(); ?>task/newhome_task"><img src="<?php echo base_url().getThemeName(); ?>/images/post-task1.png" border="0"></a>

</div>

<div class="fullwidthlayout" style="margin:25px 0 0 0; height:280px">

<div class="subsection-title">MESSAGES</div>

<div class="home-signpost-content" style="width:98%">

<div id="Default" class="contentHolder" style="float:left; height:225px">

<div class="content" style="float:left; height:225px">

<ul class="messages">
		<?php $allmessage = $this->message_model->get_message_by_id();
        
            if($allmessage){
			
			echo anchor('message','<b class="fs15 enri">Alerts('.get_user_unread_notification().')</b>','class="fpass"');
			
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
							
							case 'taskcompromise': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" /><strong>'.$res->task_name.'</strong> is compromised between Poster and Worker bee. Amount credited to your wallet. </p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 																	
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





<div id="browse-tasks" style="margin:25px 0 0 0">

<div class="red-subtitle" style="background:#363636">BROWSE TASKS</div>





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

<li style="display: block;"><?php echo anchor('tags','View all','id="" style="padding:10px 0 10px 83px"');?></li>

<?php } ?>



</ul>

</div>



<div class="db-rightinfo" style="margin:25px 0 0 0">

<div class="subsection-title">Search Task To Work</div>

<div class="home-signpost-content">

<div class="dbleft-ts" style="margin:0">

<div id="search-task">

	<div class="tasksearch-inner">

    	<div class="search-taskph">

		<table>
 <?php
			$attributes = array('name'=>'frm_search_task_worker',);
			
			
			
				echo form_open('search',$attributes);
			
			
			
	   ?>
           <tr><td><p> <input type="text" name="search" id="search" class="emailid"  placeholder="Enter your text search" value="" /></p></td></tr>
           <tr><td><p style="padding-left: 15px;">  <input type="submit" class="submbgsearch" value="Search"></p></td></tr>
        </form>
</table>

        </div>

        <!--<div style="float:left; width:100%; margin:15px 0 0 0"><a href="#"><img src="images/big-search.png" border="0">

	</div>-->

</div>

</div>

</div>



<div class="dbright-ts">

<div class="fleftauto">

<img align="left" style="margin:0 10px 0 0" src="<?php echo base_url().getThemeName(); ?>/images/map-icon.png">

</div>

<div class="fleft59 w85-vt">

<p class="sec-title">Search Task On Map</p>

</div>

<div class="vtaskmap">

<p style="font-size: 15px; margin-bottom:18px; color:#000" class="normal-text">See all current tasks on a map</p>

<div class="fright"><a href="map/"><img src="<?php echo base_url().getThemeName(); ?>/images/view-task-map.png" border="0"></a></div>

</div>

</div>

</div>



</div>



<div class="db-rightinfo" style="margin:25px 0 0 0; height:280px">

<div class="subsection-title">TASK HISTORY</div>

<div class="home-signpost-content" style="width:98%">

<div id="Default1" class="contentHolder" style="float:left; height:225px">

<div class="content" style="float:left; height:225px">


<ul>
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
<div class="clear"></div>
</div>