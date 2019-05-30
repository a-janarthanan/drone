<link type="text/css" rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/css/easy-responsivenew-tabsnew.css" />
<script src="<?php echo base_url().getThemeName(); ?>/js/easyResponsiveTabs.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/js/lib/themes/base/jquery.ui.all.css">
<script type="text/javascript">


	$(function() {
		$("#tabs").tabs();		
	});

jQuery(document).ready(function() {

/**/
   $("a.link1").mouseover(function () {
    $("#roboho1").show("fast");
    });

	$("a.link1").mouseout(function () {
    $("#roboho1").hide("fast");
    });

  	$("a.link2").mouseover(function () {
    $("#roboho2").show("fast");
    });

	$("a.link2").mouseout(function () {
    $("#roboho2").hide("fast");
    });

  	$("a.link3").mouseover(function () {
    $("#roboho3").show("fast");
    });

	$("a.link3").mouseout(function () {
    $("#roboho3").hide("fast");
    });
  	$("a.link4").mouseover(function () {
    $("#roboho4").show("fast");
    });

	$("a.link4").mouseout(function () {
    $("#roboho4").hide("fast");
    });
/**/



	
});




function un_favorite(id)
{
	
		var strURL='<?php echo base_url().'user/un_favorite/';?>'+id;
		var xmlhttp;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  
		  }
		xmlhttp.onreadystatechange=function()
		  {
			 
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{	
			///alert(xmlhttp.responseText);
				if(xmlhttp.responseText=='login_failed')
				{
					window.location.href='<?php echo base_url().'sign_up/'; ?>';				
				}
				else
				{
					document.getElementById("favorite").innerHTML=xmlhttp.responseText;
				}		
			}
		  }
		xmlhttp.open("GET",strURL,true);
		xmlhttp.send();
}

function make_favorite(id)
{
		var strURL='<?php echo base_url().'user/make_favorite/';?>'+id;
		var xmlhttp;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  
		  }
		xmlhttp.onreadystatechange=function()
		  {
			 
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{	
			//alert(xmlhttp.responseText);
				if(xmlhttp.responseText=='login_failed')
				{
					window.location.href='<?php echo base_url().'sign_up/'; ?>';				
				}
				else
				{
					document.getElementById("favorite").innerHTML=xmlhttp.responseText;
				}		
			}
		  }
		xmlhttp.open("GET",strURL,true);
		xmlhttp.send();
}

</script>
<style type="text/css">
.rmm {max-width:1083px !important}
.z-section > h3 i {
font-size: 14px;
display: inline;
width: auto;
height: auto;
line-height: normal;
}
.z-section > h3 span.z-icon {
width: 22px;
display: inline-block;
margin-left: 5px;
}
.z-accordion.transition.vertical > section.no-padding > .z-content > .z-auto-g
{padding:0}

.z-demo-accordion .z-content ul, .z-demo-accordion .z-content ol {
margin: 0 0 5px 0px;
}

    .z-demo-accordion.z-accordion.vertical > section > h3,   
    .z-demo-accordion.z-accordion.horizontal > section > h3 > .z-title
    {       
        letter-spacing: 0;
        font-family:  sans-serif;
        text-rendering: optimizeLegibility;
        -webkit-font-smoothing: antialiased;
    }
    .z-demo-accordion.z-accordion.horizontal > section > h3 > .z-title
    {               
        text-transform: uppercase;
    }
	 .demo {
            width: 980px;
            margin: 0px auto;
        }
        .demo h1 {
                margin:33px 0 25px;
            }
        .demo h3 {
                margin: 10px 0;
            }
        pre {
            background: #fff;
        }
        @media only screen and (max-width: 780px) {
        .demo {
                margin: 5%;
                width: 90%;
         }
        .how-use {
                float: left;
                width: 300px;
                display: none;
            }
        }
        #tabInfo {
            display: none;
        }
		.seemore_sel{ float:right;}
		.profile_edit_link1 { font-weight:bold;}
</style>

<?php


$site_setting=site_setting(); 
$data['site_setting']=$site_setting;

$data['reviews']=$reviews;
$data['user_profile']=$user_profile;

?>
<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->

<div >
	<div>
    <div class="red-subtitle" style="margin:172px 0 0 0">Activity</div>
    	<div class="profile_back">
        <div class="task-layout">
        <div class="container">
        <div class="profile-main"> 
        	<div class="profile-main-inner">    
                <div class="profile-top">
        				<div class="user-image">
                            <?php
                        if($user_profile->profile_image!='') {  
                            if(file_exists(base_path().'upload/user/'.$user_profile->profile_image)) { ?>
                                <img src="<?php echo base_url(); ?>upload/user/<?php echo $user_profile->profile_image;?>" class="fl round-corner"  />
                                <?php } else { ?>
                                <img src="<?php echo base_url(); ?>upload/no_image.png" class="fl round-corner"  />
                                <?php } } else { ?>
                                <img src="<?php echo base_url(); ?>upload/no_image.png" class="fl round-corner"  />
                                <?php } ?>
                                <?php $check_worker_detail=$this->worker_model->check_user_worker_detail($user_profile->user_id);
                                //print_r($check_worker_detail);
                               
                                if($check_worker_detail) { 
                                ?>
                    		<?php } ?>  
                        </div>
                        <div class="details-title-info details-title-info-all">
                        	<div class="tasksimilar">
                                <a href="#" class="abtmove"><?php echo $user_profile->first_name.' '.substr($user_profile->last_name,0,1); ?> </a>
                            </div>
                            <div class="clear"></div>
                            <div class="city-name">
                            <?php if($check_worker_detail) { 
                                      
                                            $worker_cities=$this->worker_model->get_worker_cities($check_worker_detail->worker_id);
                                            
                                       ?>
                           
                                <b>Areas :</b>

                                    <?php 
                                    if($worker_cities) {
                                    $city_list='';
                                      
                                       foreach($worker_cities as $wc) {   
                                       
                                       $city_list .=ucfirst($wc->city_name).',';
                                       
                                       }  
                                       
                                       echo substr($city_list,0,-1); 
                                       
                                       ?>
                                       
                                       <?php } else { ?>
                                       
                                        <?php  if($user_profile->current_city>0) { echo getCityName($user_profile->current_city); } ?>
                                        
                    
                    <?php } } else { ?>
                                        <?php  if($user_profile->current_city>0) { echo getCityName($user_profile->current_city); } ?>
                                        
                                        
                                     <?php } ?>
                            </div>
                            <div class="city-name">
                                <b>I do Tasks :</b> <?php

                                 if($check_worker_detail) { 
                                 
                                  $worker_transportation_detail='';
                                  
                                 $types=$check_worker_detail->worker_transportation;
                                 
                                 if($types!='') { 
                                 
                                
                                 
                                 $ex_type=explode(',',$types);
                                 
                                 foreach($ex_type as $type) 
                                 {
                                    
                                     $get_transportation=get_transportation_detail($type);
                                     
                                     if($get_transportation)
                                     {
                                         if(isset($get_transportation->name)) { 
                                          $worker_transportation_detail .=$get_transportation->name.',';
                                          }
                                    }
                                     
                                    
                                }
                                ?>
                                
                                <?php if($worker_transportation_detail!='') { echo substr($worker_transportation_detail,0,-1); } ?>
                                
                                
                            <?php   }
                                
                                
                                
                                } ?>
                            </div>  
                        </div>
                        <div class="clear"></div>
                        </div>
                        <div class="bottom-tabs bottom-tabs1">
                            <!-- tab s-->
                            <div id="horizontalTab" class="detail-tab">
                                <ul class="resp-tabs-list">
                                     <li>
                                            <img src="<?php echo base_url().getThemeName(); ?>/images/recent_img.png" alt="" /> 
                                            <br />
                                            <span>Recent Activity</span>
                                     </li>
                                     <li>
                                            <img src="<?php echo base_url().getThemeName(); ?>/images/review_img.png" alt="" /> 
                                            <br />
                                            <span>Reviews</span>
                                     </li>    
                                </ul>
                                <div class="resp-tabs-container">
                                	<div class="abttb3 abttb3-2">
                                    <ul class="top-in">
                                        <?php if($activities) {  
               
                    foreach($activities as $res)
                    {
                    
                        
                        $act=$res->act;
                        
                        
                        $activity_name = $res->activity_name;
                        $activity_url_name = $res->activity_url_name;
                        $activity_date  = getDuration($res->activity_date);
                        $key_id =$res->key_id;
                        $profile_user_url_name = $res->profile_user_url_name;
                        
                        
                        if(substr_count($res->profile_user_name,' ')>=1)
                        {
                            $ex_name=explode(' ',$res->profile_user_name);
                        
                            $user_name=ucfirst($ex_name[0]).' ';
                            
                            if(isset($ex_name[1])) 
                            {               
                                $user_name .= substr(ucfirst($ex_name[1]),0,1).'.';             
                            }
                        
                        }
                        else
                        {
                            $user_name=$res->profile_user_name;
                        }
                        
                        
                        $profile_user_name = $user_name;
                        $profile_user_image = $res->profile_user_image;
                        $custom_msg =  $res->custom_msg;
                        $custom_msg2 = $res->custom_msg2;
                    
                    
                        
                        switch ($act)
                        {
                                case 'signup':
                                  
                                  ?>
                                    <li class="posrel">
                                    <div class="taskphoto taskphoto-2">
                                           <?php 
                                           
                                           
                                    $user_image= base_url().'upload/no_image.png';
         
                                     if($profile_user_image!='') {  
                                
                                        if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
                                    
                                            $user_image=base_url().'upload/user/'.$profile_user_image;
                                            
                                        }
                                        
                                    }
                                    
                                    
                                    
                                    echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" class="round-corner" width="60" height="60" />'); 
                                    
                                    
                                    if(isset($custom_msg)) { if($custom_msg!='') { ?>
                                    
                                     <br><a id="twoonebr1" class="tooltip tooltip-2">Level <?php echo $custom_msg; ?><span>Level <?php echo $custom_msg;?> Tasker</span></a>
                                     
                                     <?php } } ?>
                                            
                                    </div>
                                    <div class="taskdetails">
                                        <?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="abmarks abmarks-2 unl"'); ?>
                                        <div class="colmark colmark-2">Welcome!</div>
                                        <div class="geo geo-2"><?php echo $activity_date; ?></div>
                                    </div>
                                    
                                   
                                    <div class="clear"></div>
                                </li>
                                  
                                  
                                <?php  
                                  
                                  break;
                                  case 'workersignup':
                                  
                                  ?>
                                    <li class="posrel">
                                   <div class="taskphoto taskphoto-2">
                                           <?php 
                                           
                                           
                                    $user_image= base_url().'upload/no_image.png';
         
                                     if($profile_user_image!='') {  
                                
                                        if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
                                    
                                            $user_image=base_url().'upload/user/'.$profile_user_image;
                                            
                                        }
                                        
                                    }
                                    
                                    
                                    
                                    echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" class="round-corner" width="60" height="60" />'); 
                                    
                                    
                                    if(isset($custom_msg)) { if($custom_msg!='') { ?>
                                    
                                      <br><a id="twoonebr1" class="tooltip tooltip-2">Level <?php echo $custom_msg; ?><span>Level <?php echo $custom_msg;?> Tasker</span></a>
                                     
                                     <?php } } ?>
                                            
                                    </div>
                                    <div class="taskdetails">
                                        <?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="abmarks abmarks-2 unl"'); ?>
                                        <div class="colmark colmark-2">has signed up to be a Tasker Time to get moving.</div>
                                        <div class="geo geo-2"><?php echo $activity_date; ?></div>
                                    </div>
                                    
                                   
                                    <div class="clear"></div>
                                </li>
                                  
                                  
                                <?php  
                                  
                                  break;
                                  
                                case 'posttask':
                                 
                                 ?>
                                 
                                 <li class="posrel">
                                    <div class="taskphoto taskphoto-2">
                                            <?php 
                                           
                                           
                                    $user_image= base_url().'upload/no_image.png';
         
                                     if($profile_user_image!='') {  
                                
                                        if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
                                    
                                            $user_image=base_url().'upload/user/'.$profile_user_image;
                                            
                                        }
                                        
                                    }
                                    
                                    
                                    
                                    echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" class="round-corner" width="60" height="60" />'); 
                                    
                                    
                                    if(isset($key_id)) { if($key_id!='') {
                                                            
                                     ?>
                                    
                                      <br><a id="twoonebr1" class="tooltip tooltip-2">Level <?php echo $key_id; ?><span>Level <?php echo $key_id;?> Tasker</span></a>
                                     
                                     <?php } } ?>
                                            
                                    </div>
                                    <div class="taskdetails">
                                        <?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="abmarks abmarks-2 unl"'); ?>
                                        <div class="colmark colmark-2">posted by <?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="colgreen"'); 
                                        
                                      
                                        
                                        
                                        
                                    if(isset($custom_msg)) { if($custom_msg!='') {
                                    
                                    $worker_level=0;
                                    $worker_name='';
                                    $worker_profile_url='';
                                    
                                        if(substr_count($custom_msg,',')>=1)
                                        {
                                            $ex_worker=explode(',',$custom_msg);
                                            
                                            
                                            if(isset($ex_worker[0])) 
                                            {
                                                $worker_profile_url=$ex_worker[0];
                                            }
                                            
                                            
                                                $worker_name=ucfirst($ex_worker[1]).' ';
                                                
                                                if(isset($ex_worker[2])) 
                                                {               
                                                    $worker_name .= substr(ucfirst($ex_worker[2]),0,1).'.';             
                                                }
                                                                                                                
                                            
                                        }
                                        
                                        if($worker_name!='' && $worker_profile_url!='') 
                                        { 
                                        
                                            echo 'for '.anchor('user/'.$worker_profile_url,$worker_name,'class="colgreen"');
                                        
                                        }
                                        
                                        
                                }   }
                                ?>
                                        
                                        <!-- expires in--> <?php 
                                        
                                        
                                        $task_start_day=0;
                                        $task_start_time=0;
                                        
                                        
                                        if(isset($custom_msg2)) { 
                                        
                                            
                                            if(substr_count($custom_msg2,',')>=1)
                                            {
                                                $ex_date=explode(',',$custom_msg2);
                                            
                                                $task_start_day=$ex_date[0];
                                                
                                                if(isset($ex_date[1])) 
                                                {               
                                                    $task_start_time = $ex_date[1];             
                                                }
                                            
                                            }
                                            
                        
                                        }
                                        
                                       // echo getDuration(date('Y-m-d',strtotime(date("Y-m-d", strtotime($res->activity_date)) . " +".$task_start_day."days")).'-'.date('H',mktime(0,$task_start_time,0,0,0,0)));    ?></div>
                                        <div class="geo geo-2"><?php echo $activity_date; ?></div>
                                    </div>
                                    
                                  <!--  <a href="javascript:void();" class="cm chbg"><b>Use Template</b></a>-->
                                     
                                    <div class="clear"></div>
                                </li>
                                 
                                 
                                 <?php
                                 
                                  break;
                                  
                                  case 'workerposttask':
                                 ?>
                                 
                                 
                                 <li class="posrel">
                                    <div class="taskphoto taskphoto-2">
                                            <?php 
                                           
                                           
                                    $user_image= base_url().'upload/no_image.png';
         
                                     if($profile_user_image!='') {  
                                
                                        if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
                                    
                                            $user_image=base_url().'upload/user/'.$profile_user_image;
                                            
                                        }
                                        
                                    }
                                    
                                    
                                    
                                    echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" class="round-corner" width="60" height="60" />'); 
                                    
                                    
                                    if(isset($key_id)) { if($key_id!='') {
                                                            
                                     ?>
                                    
                                      <br><a id="twoonebr1" class="tooltip tooltip-2">Level <?php echo $key_id; ?><span>Level <?php echo $key_id;?> Tasker</span></a>
                                     
                                     <?php } } ?>
                                            
                                    </div>
                                    <div class="taskdetails">
                                        <?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="abmarks abmarks-2 unl"'); ?>
                                        <div class="colmark colmark-2">posted by <?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="colgreen"'); 
                                        
                                      
                                        
                                        
                                        
                                    if(isset($custom_msg)) { if($custom_msg!='') {
                                    
                                    $worker_level=0;
                                    $worker_name='';
                                    $worker_profile_url='';
                                    
                                        if(substr_count($custom_msg,',')>=1)
                                        {
                                            $ex_worker=explode(',',$custom_msg);
                                            
                                            
                                            if(isset($ex_worker[0])) 
                                            {
                                                $worker_profile_url=$ex_worker[0];
                                            }
                                            
                                            
                                                $worker_name=ucfirst($ex_worker[1]).' ';
                                                
                                                if(isset($ex_worker[2])) 
                                                {               
                                                    $worker_name .= substr(ucfirst($ex_worker[2]),0,1).'.';             
                                                }
                                                                                                                
                                            
                                        }
                                        
                                        if($worker_name!='' && $worker_profile_url!='') 
                                        { 
                                        
                                            echo 'for '.anchor('user/'.$worker_profile_url,$worker_name,'class="colgreen"');
                                        
                                        }
                                        
                                        
                                }   }
                                ?>
                                        
                                         and needs to be assigned by <?php 
                                        
                                        
                                        $task_start_day=0;
                                        $task_start_time=0;
                                        
                                        
                                        if(isset($custom_msg2)) { 
                                        
                                            
                                            if(substr_count($custom_msg2,',')>=1)
                                            {
                                                $ex_date=explode(',',$custom_msg2);
                                            
                                                $task_start_day=$ex_date[0];
                                                
                                                if(isset($ex_date[1])) 
                                                {               
                                                    $task_start_time = $ex_date[1];             
                                                }
                                            
                                            }
                                            
                        
                                        }
                                        
                                        echo getDuration(date('Y-m-d',strtotime(date("Y-m-d", strtotime($res->activity_date)) . " +".$task_start_day."days")).'-'.date('H',mktime(0,$task_start_time,0,0,0,0)));    ?></div>
                                        <div class="geo geo-2"><?php echo $activity_date; ?></div>
                                    </div>
                                    
                                  <!--  <a href="javascript:void();" class="cm chbg"><b>Use Template</b></a>-->
                                     
                                    <div class="clear"></div>
                                </li>
                                 
                                 <?php
                                  break;
                                  
                                case 'assigntask':
                                
                                ?>
                                
                                <li class="posrel">
                                    <div class="taskphoto taskphoto-2">
                                            <?php 
                                           
                                           
                                    $user_image= base_url().'upload/no_image.png';
         
                                     if($profile_user_image!='') {  
                                
                                        if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
                                    
                                            $user_image=base_url().'upload/user/'.$profile_user_image;
                                            
                                        }
                                        
                                    }
                                    
                                    
                                    
                                    echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" class="round-corner" width="60" height="60" />'); 
                                    
                                    
                                    if(isset($key_id)) { if($key_id!='') {
                                                            
                                     ?>
                                    
                                     <br> <a id="twoonebr1" rel="tooltip" title="Level <?php echo $key_id;?> Tasker">Level <?php echo $key_id; ?></a>
                                     
                                     <?php } } ?>
                                            
                                    </div>
                                    <div class="taskdetails">
                                        <?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,' class="abmarks abmarks-2 unl"'); ?>
                                        <div class="colmark colmark-2">accepted the offer from <?php 
                                      
                                        
                                        
                                        
                                    if(isset($custom_msg)) { if($custom_msg!='') {
                                    
                                    $worker_level=0;
                                    $worker_name='';
                                    $worker_profile_url='';
                                    
                                        if(substr_count($custom_msg,',')>=1)
                                        {
                                            $ex_worker=explode(',',$custom_msg);
                                            
                                            
                                            if(isset($ex_worker[0])) 
                                            {
                                                $worker_profile_url=$ex_worker[0];
                                            }
                                            
                                            
                                                $worker_name=ucfirst($ex_worker[1]).' ';
                                                
                                                if(isset($ex_worker[2])) 
                                                {               
                                                    $worker_name .= substr(ucfirst($ex_worker[2]),0,1).'.';             
                                                }
                                                                                                                
                                            
                                        }
                                        
                                        if($worker_name!='' && $worker_profile_url!='') 
                                        { 
                                        
                                            echo anchor('user/'.$worker_profile_url,$worker_name,'class="colgreen"');
                                        
                                        }
                                        
                                        
                                }   }
                                ?>
                                        
                                         for  <?php
                                         
                                         echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),'class="colgreen"');  
                                        
                                            ?></div>
                                        <div class="geo geo-2"><?php echo $activity_date; ?></div>
                                    </div>
                                    
                                  <!--  <a href="javascript:void();" class="cm chbg"><b>Use Template</b></a>-->
                                     
                                    <div class="clear"></div>
                                </li>
                                
                                
                                
                                <?php
                                  break;
                                  
                                case 'workerassigntask':
                                ?>
                                
                                
                                <li class="posrel">
                                    <div class="taskphoto taskphoto-2">
                                            <?php 
                                           
                                           
                                    $user_image= base_url().'upload/no_image.png';
         
                                     if($profile_user_image!='') {  
                                
                                        if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
                                    
                                            $user_image=base_url().'upload/user/'.$profile_user_image;
                                            
                                        }
                                        
                                    }
                                    
                                    
                                    
                                    echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" class="round-corner" width="60" height="60" />'); 
                                    
                                    
                                    if(isset($key_id)) { if($key_id!='') {
                                                            
                                     ?>
                                    
                                      <br><a id="twoonebr1" class="tooltip tooltip-2">Level <?php echo $key_id; ?><span>Level <?php echo $key_id;?> Tasker</span></a>
                                     
                                     <?php } } ?>
                                            
                                    </div>
                                    <div class="taskdetails">
                                        <?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,' class="abmarks abmarks-2 unl"'); ?>
                                        <div class="colmark colmark-2">accepted the offer from <?php 
                                      
                                        
                                        
                                        
                                    if(isset($custom_msg)) { if($custom_msg!='') {
                                    
                                    $worker_level=0;
                                    $worker_name='';
                                    $worker_profile_url='';
                                    
                                        if(substr_count($custom_msg,',')>=1)
                                        {
                                            $ex_worker=explode(',',$custom_msg);
                                            
                                            
                                            if(isset($ex_worker[0])) 
                                            {
                                                $worker_profile_url=$ex_worker[0];
                                            }
                                            
                                            
                                                $worker_name=ucfirst($ex_worker[1]).' ';
                                                
                                                if(isset($ex_worker[2])) 
                                                {               
                                                    $worker_name .= substr(ucfirst($ex_worker[2]),0,1).'.';             
                                                }
                                                                                                                
                                            
                                        }
                                        
                                        if($worker_name!='' && $worker_profile_url!='') 
                                        { 
                                        
                                            echo anchor('user/'.$worker_profile_url,$worker_name,'class="colgreen"');
                                        
                                        }
                                        
                                        
                                }   }
                                ?>
                                        
                                         for  <?php
                                         
                                         echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),'class="colgreen"');  
                                        
                                            ?></div>
                                        <div class="geo geo-2"><?php echo $activity_date; ?></div>
                                    </div>
                                    
                                  <!--  <a href="javascript:void();" class="cm chbg"><b>Use Template</b></a>-->
                                     
                                    <div class="clear"></div>
                                </li>
                                
                                <?php
                                  break;
                                  
                                case 'completetask':
                                ?>
                                
                                
                                <li class="posrel">
                                    <div class="taskphoto taskphoto-2">
                                            <?php 
                                           
                                           
                                    $user_image= base_url().'upload/no_image.png';
         
                                     if($profile_user_image!='') {  
                                
                                        if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
                                    
                                            $user_image=base_url().'upload/user/'.$profile_user_image;
                                            
                                        }
                                        
                                    }
                                    
                                    
                                    
                                    echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" class="round-corner" width="60" height="60" />'); 
                                    
                                    
                                    if(isset($custom_msg)) { if($custom_msg!='') {
                                    
                                    $worker_level=0;
                                    
                                        if(substr_count($custom_msg,',')>=1)
                                        {
                                            $ex_worker=explode(',',$custom_msg);
                                            
                                            
                                            if(isset($ex_worker[4])) 
                                            {
                                                $worker_level=$ex_worker[4];
                                            }                               
                                        }
                                                            
                                     ?>
                                    
                                      <br><a id="twoonebr1" class="tooltip tooltip-2">Level <?php echo $worker_level; ?><span>Level <?php echo $worker_level;?> Tasker</span></a>
                                     
                                     <?php } } ?>
                                            
                                    </div>
                                    <div class="taskdetails">
                                        <?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="abmarks unl"'); ?>
                                        <div class="colmark colmark-2">has been marked completed by <?php 
                                      
                                        
                                    echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="colgreen"');
                                    
                                ?>
                                        
                                       </div>
                                        <div class="geo geo-2"><?php echo $activity_date; ?></div>
                                    </div>
                                    
                                  <!--  <a href="javascript:void();" class="cm chbg"><b>Use Template</b></a>-->
                                     
                                    <div class="clear"></div>
                                </li>
                                
                                <?php
                                  break;
                                  
                                case 'workercompletetask':
                                ?>
                                
                                <li class="posrel">
                                    <div class="taskphoto taskphoto-2">
                                            <?php 
                                           
                                           
                                    $user_image= base_url().'upload/no_image.png';
         
                                     if($profile_user_image!='') {  
                                
                                        if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
                                    
                                            $user_image=base_url().'upload/user/'.$profile_user_image;
                                            
                                        }
                                        
                                    }
                                    
                                    
                                    
                                    echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" class="round-corner" width="60" height="60" />'); 
                                    
                                    
                                    if(isset($custom_msg)) { if($custom_msg!='') {
                                    
                                    $worker_level=0;
                                    
                                        if(substr_count($custom_msg,',')>=1)
                                        {
                                            $ex_worker=explode(',',$custom_msg);
                                            
                                            
                                            if(isset($ex_worker[4])) 
                                            {
                                                $worker_level=$ex_worker[4];
                                            }                               
                                        }
                                                            
                                     ?>
                                    
                                     <br> <a id="twoonebr1" class="tooltip tooltip-2">Level <?php echo $worker_level; ?><span>Level <?php echo $worker_level;?> Tasker</span></a>
                                     
                                     <?php } } ?>
                                            
                                    </div>
                                    <div class="taskdetails">
                                        <?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="abmarks abmarks-2 unl"'); ?>
                                        <div class="colmark colmark-2">has been marked completed by <?php 
                                      
                                        
                                    echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="colgreen"');
                                    
                                ?>
                                        
                                       </div>
                                        <div class="geo geo-2"><?php echo $activity_date; ?></div>
                                    </div>
                                    
                                  <!--  <a href="javascript:void();" class="cm chbg"><b>Use Template</b></a>-->
                                     
                                    <div class="clear"></div>
                                </li>
                                
                                <?php
                                  break;
                                  
                                
                                case 'finishtask':
                            
                            ?>
                            
                            
                            <li class="posrel">
                                    <div class="taskphoto taskphoto-2">
                                            <?php 
                                           
                                           
                                    $user_image= base_url().'upload/no_image.png';
         
                                     if($profile_user_image!='') {  
                                
                                        if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
                                    
                                            $user_image=base_url().'upload/user/'.$profile_user_image;
                                            
                                        }
                                        
                                    }
                                    
                                    
                                    
                                    echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" class="round-corner" width="60" height="60" />'); 
                                    
                                    
                                        if(isset($key_id)) { if($key_id!='') {
                                                            
                                     ?>
                                    
                                      <br><a id="twoonebr1" class="tooltip tooltip-2">Level <?php echo $key_id; ?><span>Level <?php echo $key_id;?> Tasker</span></a>
                                     
                                     <?php } } ?>
                                            
                                    </div>
                                    <div class="taskdetails">
                                        <?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="abmarks abmarks-2 unl"'); ?>
                                        <div class="colmark colmark-2">has been finished by <?php 
                                        if(isset($custom_msg)) { if($custom_msg!='') {
                                    
                                    $worker_level=0;
                                    $worker_name='';
                                    $worker_profile_url='';
                                    
                                        if(substr_count($custom_msg,',')>=1)
                                        {
                                            $ex_worker=explode(',',$custom_msg);
                                            
                                            
                                            if(isset($ex_worker[0])) 
                                            {
                                                $worker_profile_url=$ex_worker[0];
                                            }
                                            
                                            
                                                $worker_name=ucfirst($ex_worker[1]).' ';
                                                
                                                if(isset($ex_worker[2])) 
                                                {               
                                                    $worker_name .= substr(ucfirst($ex_worker[2]),0,1).'.';             
                                                }
                                                                                                                
                                            
                                        }
                                        
                                        if($worker_name!='' && $worker_profile_url!='') 
                                        { 
                                        
                                            echo anchor('user/'.$worker_profile_url,$worker_name,'class="colgreen"');
                                        
                                        }
                                        
                                        
                                }   }
                                    
                                ?>
                                        
                                       </div>
                                        <div class="geo geo-2"><?php echo $activity_date; ?></div>
                                    </div>
                                    
                                  <!--  <a href="javascript:void();" class="cm chbg"><b>Use Template</b></a>-->
                                     
                                    <div class="clear"></div>
                                </li>
                            
                            
                            <?php
                            
                                  break;
                                  
                                case 'workerfinishtask':
                                ?>
                                
                                <li class="posrel">
                                    <div class="taskphoto taskphoto-2">
                                            <?php 
                                           
                                           
                                    $user_image= base_url().'upload/no_image.png';
         
                                     if($profile_user_image!='') {  
                                
                                        if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
                                    
                                            $user_image=base_url().'upload/user/'.$profile_user_image;
                                            
                                        }
                                        
                                    }
                                    
                                    
                                    
                                    echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" class="round-corner" width="60" height="60" />'); 
                                    
                                    
                                        if(isset($key_id)) { if($key_id!='') {
                                                            
                                     ?>
                                    
                                      <br><a id="twoonebr1" class="tooltip tooltip-2">Level <?php echo $key_id; ?><span>Level <?php echo $key_id;?> Tasker</span></a>
                                     
                                     <?php } } ?>
                                            
                                    </div>
                                    <div class="taskdetails">
                                        <?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="abmarks abmarks-2 unl"'); ?>
                                        <div class="colmark colmark-2">has been finished by <?php 
                                        if(isset($custom_msg)) { if($custom_msg!='') {
                                    
                                    $worker_level=0;
                                    $worker_name='';
                                    $worker_profile_url='';
                                    
                                        if(substr_count($custom_msg,',')>=1)
                                        {
                                            $ex_worker=explode(',',$custom_msg);
                                            
                                            
                                            if(isset($ex_worker[0])) 
                                            {
                                                $worker_profile_url=$ex_worker[0];
                                            }
                                            
                                            
                                                $worker_name=ucfirst($ex_worker[1]).' ';
                                                
                                                if(isset($ex_worker[2])) 
                                                {               
                                                    $worker_name .= substr(ucfirst($ex_worker[2]),0,1).'.';             
                                                }
                                                                                                                
                                            
                                        }
                                        
                                        if($worker_name!='' && $worker_profile_url!='') 
                                        { 
                                        
                                            echo anchor('user/'.$worker_profile_url,$worker_name,'class="colgreen"');
                                        
                                        }
                                        
                                        
                                }   }
                                    
                                ?>
                                        
                                       </div>
                                        <div class="geo geo-2"><?php echo $activity_date; ?></div>
                                    </div>
                                    
                                  <!--  <a href="javascript:void();" class="cm chbg"><b>Use Template</b></a>-->
                                     
                                    <div class="clear"></div>
                                </li>
                                
                                <?php
                                  break;
                                  
                                case 'newcomment':
                                ?>
                                
                                <li class="posrel">
                                    <div class="taskphoto taskphoto-2">
                      
                      
                      
                      
                           <?php 
                                           
                                if(isset($custom_msg)) { if($custom_msg!='') {
                                    
                                    $comment_level='';
                                    $comment_name='';
                                    $comment_profile_url='';
                                    $comment_user_image= base_url().'upload/no_image.png';
                                    
                                        if(substr_count($custom_msg,',')>=1)
                                        {
                                            $ex_comment=explode(',',$custom_msg);
                                            
                                            
                                            if(isset($ex_comment[0])) 
                                            {
                                                $comment_profile_url=$ex_comment[0];
                                            }
                                            
                                            
                                                $comment_name=ucfirst($ex_comment[1]).' ';
                                                
                                                if(isset($ex_comment[2])) 
                                                {               
                                                    $comment_name .= substr(ucfirst($ex_comment[2]),0,1).'.';               
                                                }
                                                
                                                
                                                
                                                if(isset($ex_comment[3])) 
                                                {               
                                                     if($ex_comment[3]!='') {  
                                
                                                        if(file_exists(base_path().'upload/user/'.$ex_comment[3])) {
                                                    
                                                            $comment_user_image=base_url().'upload/user/'.$ex_comment[3];
                                                            
                                                        }
                                                        
                                                    }           
                                                }
                                                
                                                
                                                
                                                if(isset($ex_comment[4])) 
                                                {
                                                    $comment_level=$ex_comment[4];
                                                }
                                                
                                                
                                                                                                                
                                            
                                        }
                                        
                                        
                                                   
                                    
         
                                    
                                    
                                    
                                    
                                    echo anchor('user/'.$comment_profile_url,'<img src="'.$comment_user_image.'" alt="" class="round-corner" width="60" height="60" />'); 
                                    
                                    
                                    if(isset($comment_level)) { if($comment_level!='') {
                                                            
                                     ?>
                                    
                                      <br><a id="twoonebr1" class="tooltip tooltip-2">Level <?php echo $comment_level; ?><span>Level <?php echo $comment_level;?> Tasker</span></a>
                                     
                                     <?php }  }   
                                     
                                     
                                     
                                     }} ?>
                                            
                      
                      
                      
                      
                        </div>
                        
                        <div class="taskdetails">
                        
                        <div><span class="newrep">New comment on</span> <?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="unl abmarks abmarks-2"');?></div>
                        
                        <div class="posrel marTB10 abttb2-2-2">
                        <div class="taskphoto taskphoto-2">
                       
                       <?php
                       
                       $user_image= base_url().'upload/no_image.png';
         
                                     if($profile_user_image!='') {  
                                
                                        if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
                                    
                                            $user_image=base_url().'upload/user/'.$profile_user_image;
                                            
                                        }
                                        
                                    }
                                    
                                    
                                    
                                    echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" class="round-corner" width="60" height="60" />'); 
                                 
                                 
                                    if(isset($key_id)) { if($key_id!='') {
                                                            
                                     ?>
                                    
                                     <a id="twooneanj" class="tooltip tooltip-2">Level <?php echo $key_id; ?><span>Level <?php echo $key_id;?> Worker bee</span></a>  
                                     <?php }  } ?>
                        
                        
                        
                        
                        </div>
                        <div class="wid350 marL5" style="padding-left:50px;" >
                        <?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="abmarks abmarks-2 unl"');?><br/>
                        <p class="colmark colmark-2"><?php echo $custom_msg2; ?></p>
                        <div class="geo geo-2"><?php echo $activity_date; ?></div>
                        </div>
                        <div class="clear"></div>
                        </div>
                        
                        </div>
                       <!-- <a href="javascript:void();" class="cm chbg"><b>Use Template</b></a>-->
                        <div class="clear"></div>
                        </li>
                                
                                
                                <?php
                                  break;
                                  
                                case 'newreply':
                            ?>
                            
                            <li class="posrel">
                        <div class="taskphoto taskphoto-2">
                      
                      
                      
                      
                           <?php 
                                
                        
                                if(isset($custom_msg)) { if($custom_msg!='') {
                                    
                                    $comment_level='';
                                    $comment_name='';
                                    $comment_profile_url='';
                                    $comment_user_image= base_url().'upload/no_image.png';
                                    
                                    
                                        if(substr_count($custom_msg,',')>=1)
                                        {
                                            $ex_comment=explode(',',$custom_msg);
                                            
                                            
                                            if(isset($ex_comment[0])) 
                                            {
                                                $comment_profile_url=$ex_comment[0];
                                            }
                                            
                                            
                                                $comment_name=ucfirst($ex_comment[1]).' ';
                                                
                                                if(isset($ex_comment[2])) 
                                                {               
                                                    $comment_name .= substr(ucfirst($ex_comment[2]),0,1).'.';               
                                                }
                                                
                                                
                                                
                                                if(isset($ex_comment[3])) 
                                                {               
                                                     if($ex_comment[3]!='') {  
                                
                                                        if(file_exists(base_path().'upload/user/'.$ex_comment[3])) {
                                                    
                                                            $comment_user_image=base_url().'upload/user/'.$ex_comment[3];
                                                            
                                                        }
                                                        
                                                    }           
                                                }
                                                
                                                
                                                
                                                if(isset($ex_comment[4])) 
                                                {
                                                    $comment_level=$ex_comment[4];
                                                }
                                                
                                                
                                                                                                                
                                            
                                        }
                                        
                                        
                                                   
                                    
         
                                    
                                    
                                    
                                    
                                    echo anchor('user/'.$comment_profile_url,'<img src="'.$comment_user_image.'" alt="" class="round-corner" width="60" height="60" />'); 
                                    
                                    
                                    if(isset($comment_level)) { if($comment_level!='') {
                                                            
                                     ?>
                                    
                                     <br> <a id="twoonebr1" class="tooltip tooltip-2">Level <?php echo $comment_level; ?><span>Level <?php echo $comment_level;?> Tasker</span></a>
                                     
                                     <?php }  }   
                                     
                                     
                                     
                                     }} ?>
                                            
                      
                      
                      
                      
                        </div>
                        
                        <div class="taskdetails">
                        
                        <?php    if($activities) {  ?>
                        
                        <div><span class="newrep">New reply on</span> <?php echo anchor('tasks/'.$activity_url_name,ucfirst($activity_name),' class="unl abmarks abmarks-2"');?></div>
                        <?php } ?>
                        
                        <div class="posrel marTB10 abttb2-2-2">
                        <div class="taskphoto taskphoto-2">
                       
                       <?php
                       
                       $user_image= base_url().'upload/no_image.png';
         
                                     if($profile_user_image!='') {  
                                
                                        if(file_exists(base_path().'upload/user/'.$profile_user_image)) {
                                    
                                            $user_image=base_url().'upload/user/'.$profile_user_image;
                                            
                                        }
                                        
                                    }
                                    
                                    
                                    
                                    echo anchor('user/'.$profile_user_url_name,'<img src="'.$user_image.'" alt="" class="round-corner" width="60" height="60" />'); 
                                 
                                 
                                    if(isset($key_id)) { if($key_id!='') {
                                                            
                                     ?>
                                    
                                     <br> <a id="twooneanj" class="tooltip tooltip-2">Level <?php echo $key_id; ?><span>Level <?php echo $key_id;?> Tasker</span></a>  
                                     <?php }  } ?>
                        
                        
                        
                        
                        </div>
                        <div class="wid350 marL5" style="padding-left:50px;" >
                        <?php echo anchor('user/'.$profile_user_url_name,$profile_user_name,'class="abmarks abmarks-2 unl"');?><br/>
                        <p class="colmark colmark-2"><?php echo $custom_msg2; ?></p>
                        <div class="geo geo-2"><?php echo $activity_date; ?></div>
                        </div>
                        <div class="clear"></div>
                        </div>
                        
                        </div>
                       <!-- <a href="javascript:void();" class="cm chbg"><b>Use Template</b></a>-->
                        <div class="clear"></div>
                        </li>
                        
                        <?php
                                  break;
                                  
                                
                                default:
                                 // echo "No number between 1 and 3";
                        }
                        
                        
                   
               ?>
            
            
            
            
            
            <?php }
            
            } ?>
                                    </ul>
                                    <div style="text-align:center;">
                                                <?php echo anchor('user/'.$user_profile->profile_name.'/activities/','See more',' class="btn btn-default btn-seemore"');?>
                                    </div>
                                </div>
                                    <div class="abttb4 abttb3-2">
                                        <ul>
                                            <?php if($reviews) { 
                                
                                
                                        foreach($reviews as $review) { 
                                        
                                        
                                        
                                         $user_image= base_url().'upload/no_image.png';
                                         
                                         if($review->profile_image!='') {  
                                    
                                            if(file_exists(base_path().'upload/user/'.$review->profile_image)) {
                                        
                                                $user_image=base_url().'upload/user/'.$review->profile_image;
                                                
                                            }
                                            
                                        }
                                    
                                    
                                    
                                    
                                    ?>
                                        
                                    <li class="posrel">
                                        <div class="taskphoto taskphoto-2">
                                        
                                        
                                        <?php echo anchor('user/'.$review->profile_name,'<img src="'.$user_image.'" alt="" class="round-corner" width="60" height="60" />'); ?>
                                        
                                        
                                        </div>
                                        <div class="taskdetails">
                                            <div class="abmarks-2">Review for <?php echo anchor('tasks/'.$review->task_url_name,ucfirst($review->task_name),' class="unl"'); ?></div>
                                          
                                            <div class="strmn strmn-2 fl"><div class="str_sel str_sel-2 fl" style="width:<?php if($review->comment_rate>5) { ?>100<?php } else { echo $review->comment_rate*2;?>0<?php } ?>%;"></div></div>
                                                <div class="strig">
                                                    <div id="very" class="colmark-2"><?php echo $review->task_comment; ?></div>
                                                   
                                                </div>
                                                 
                                                 <div class="geo geo-2">about <?php echo getDuration($review->comment_date); ?></div>
                                            </div>    
                                                
                                        
                                        <div class="clear"></div>
                                    </li>
                                    
                                    
                                    <?php }
                                    
                                 } else {?>
                                 
                                 <li>You have no Reviews since you have not run or post any Tasks that have been marked as completed</li>
                                 
                                 <?php } ?>
                                        </ul>
                                        <div style="text-align:center;"><?php echo anchor('user/'.$user_profile->profile_name.'/reviews/','See more',' class="btn btn-default btn-seemore"');?></div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
								<script type="text/javascript">
                                    $(document).ready(function () {
                                        $('#horizontalTab').easyResponsiveTabs({
                                            type: 'default', //Types: default, vertical, accordion           
                                            width: 'auto', //auto or any width like 600px
                                            fit: true,   // 100% fit in a container
                                            closed: 'accordion', // Start closed if in accordion view
                                            activate: function(event) { // Callback function if tab is switched
                                                var $tab = $(this);
                                                var $info = $('#tabInfo');
                                                var $name = $('span', $info);
                                
                                                $name.text($tab.text());
                                
                                                $info.show();
                                            }
                                        });
                                
                                        $('#verticalTab').easyResponsiveTabs({
                                            type: 'vertical',
                                            width: 'auto',
                                            fit: true
                                        });
                                    });
                                </script>       
                            	<div class="clear"></div>
                    			<!-- tab end -->    
                            </div>
		                </div>
            		</div>
                    <div class="dbright-task dbright-task-10 dbright-task-10-new">
                        <?php  echo $this->load->view($theme.'/layout/user/profile_sidebar',$data); ?>
                        <div class="clear"></div>
                    </div>
        		</div>
    		</div>
 		</div>
	</div>