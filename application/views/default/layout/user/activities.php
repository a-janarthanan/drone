<?php echo "hii"; ?>

<!--<link rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/js/lib/themes/base/jquery.ui.all.css">-->
<link type="text/css" rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/css/easy-responsivenew-tabsnew.css" />
<script src="<?php echo base_url().getThemeName(); ?>/js/easyResponsiveTabs.js" type="text/javascript"></script>  
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
<style>
.details-title-ph {
float: left;
width: 100%;
margin: 0 0 20px 0;
border-bottom: #CCC 1px dashed;
}

.user-image{
float: left;
margin: 8px 15px 8px 8px;
width: auto;
}
.details-title {
float: left;
margin: 8px 0;
width: 60%;
}
.areaface {
float: right;
width: 150px;
}
.col{
	color:#f2413e !important;
}
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
                            	<div class="round_img cover_img_1">
                                	<img src="<?php echo base_url(); ?>upload/user/<?php echo $user_profile->profile_image;?>" class=""  />
                                </div>
                                <?php } else { ?>
                                <img src="<?php echo base_url(); ?>upload/no_image.png" class="round_img"  />
                                <?php } } else { ?>
                                <img src="<?php echo base_url(); ?>upload/no_image.png" class="round_img"  />
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
                            
                            <div class="starmenu marB10 fl" >
                                <?php

                                $total_rate=get_user_total_rate($user_profile->user_id);

                                $total_review=get_user_total_review($user_profile->user_id);

                                ?>
                                	<div class="strmn strmn-2"><div class="str_sel str_sel-2 fl" style="width:<?php if($total_rate>5) { ?>100<?php } else { echo round($total_rate*2);?>0<?php } ?>%; "></div></div>
                                    <div class="rate rate-info fl" style="clear: both; margin:5px auto 0; overflow: hidden; text-align:center;"><p class="normal-text"><?php echo $total_rate; ?>/5  ( <span><?php echo anchor('user/'.$user_profile->profile_name.'/reviews',$total_review.' reviews');  ?> </span> )</p></div>
                                    <div class="clear"></div>
                                </div> 
                            <!--<div class="roboimg icon-profile">
                                <?php 
                                $check_is_worker=check_is_worker($user_profile->user_id);
                                if($check_is_worker) { ?>
                                <a href="#" class="link1 tooltip">
                                    <img alt="" src="<?php echo base_url().getThemeName(); ?>/images/user_icon1.png">
                                    <span>Tasker</span>
                                </a>
                                <?php 
                                }
                                if($check_worker_detail->worker_background_approved==1) { ?>
                                <a href="#" class="link2 tooltip">
                                    <img alt="" src="<?php echo base_url().getThemeName(); ?>/images/shild_icon1.png">
                                    <span>Background Check</span>
                                </a>
                                <?php } if($user_profile->mobile_no!='' || $user_profile->phone_no!='') { ?>
                                <a href="#" class="link3 tooltip">
                                    <img alt="" src="<?php echo base_url().getThemeName(); ?>/images/phone_icon1.png">
                                    <span>Contact Verified</span>
                                </a>
                                <?php } ?>
                                <div class="clear"></div>
                            </div>-->
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
                    </div>
                    <div class="bottom-tabs">
                        <!-- tab start-->
                        <div id="horizontalTab" class="detail-tab">
                            <ul class="resp-tabs-list">
                                 <li>
                                 		<img src="<?php echo base_url().getThemeName(); ?>/images/user_img_pro.png" alt="" /> 
                                        <br />
                                        <span>About</span>
                                 </li>
                                 <li>
                                 		<img src="<?php echo base_url().getThemeName(); ?>/images/portfolio_img.png" alt="" /> 
                                        <br />
                                    	<span>Portfolio</span>
                                 </li>
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
                                <div class="abtsty">
                                    <p class="about-detail"> <?php    $content=$user_profile->about_user;
                                $content=str_replace('KSYDOU','"',$content);
                                $content=str_replace('KSYSING',"'",$content); 
                                
                                echo $content; ?> </p>
                                </div>
                                <div class="abttb2 abttb2-2" style="padding-left:10px;">
                                	<script type="text/javascript">
                                        jQuery(document).ready(function() {
                                            $("a[rel=example_group]").fancybox({
                                                'transitionIn' : 'none',
                                                'transitionOut' : 'none',
                                                'titlePosition' : 'over',
                                                'titleFormat' : function(title, currentArray, currentIndex, currentOpts) {
                                                return '&lt;span id="fancybox-title-over"&gt;Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &amp;nbsp; ' + title : '') + '&lt;/span&gt;';
                                                }
                                                });
                                            });
                                    </script>
                                    <div class="clear"></div>
                                    <div class="marTB10">
                                        <table width="100%" cellspacing="1" cellpadding="0" border="0">
                                             <?php if($portfolio_photo) { ?>
                                            <tr>
                                                <td valign="top" width="19%" align="left">
                                                   <?php
        
                                                        $i=0;
                                                        foreach( $portfolio_photo as $p_photo)
                                                        {
                                                        $i++;
                                                        if($p_photo->portfolio_image!=''){
                                                        if(file_exists(base_path().'upload/user/'.$p_photo->portfolio_image)) { ?>
                                                        
                                                        
                                                        
                                                        <a href="<?php echo base_url().'upload/user_orig/'.$p_photo->portfolio_image; ?>" rel="example_group"><img src="<?php echo base_url().'upload/user/'.$p_photo->portfolio_image; ?>" width="280" style="margin:0 2px 0 2px;" height="" class="round-corner" alt="" /></a>
                                                        
                                                        
                                                        
                                                        
                                                        <?php } }
                                                        }?>
                                                </td>
                                            </tr>
                                             <?php  } ?>
                                             <?php
                            if($portfolio_video) { ?>
                                             <tr>
                                                <td valign="top" width="19%" align="left">
                                                   <?php
        
        $i=0;
        foreach($portfolio_video as $p_video)
        {
        $i++;
        if($p_video->portfolio_video!=''){
        
        if(substr_count($p_video->portfolio_video,'object')>0)
        {
        echo html_entity_decode($p_video->portfolio_video);
        }
        
        elseif(substr_count($p_video->portfolio_video,'iframe')>0)
        {
        if(substr_count($p_video->portfolio_video,'youtube')>0)
        {
        $p_video->portfolio_video;
        $patterns[] = '/src="(.*?)"/';
        $replacements[] = 'src="${1}?wmode=transparent"';
        
        //echo html_entity_decode(preg_replace($patterns,$replacements,$p_video->portfolio_video));
        echo html_entity_decode($p_video->portfolio_video);
        }
        elseif(substr_count($p_video->portfolio_video,'vimeo')>0)
        {
        $patterns[] = '/src="(.*?)"/';
        preg_match('/src="(.*?)"/',$p_video->portfolio_video,$matches);
        echo '<iframe src="'.$matches[1].'" frameborder="0" allowfullscreen></iframe>';
        }
        else
        {
        echo $p_video->portfolio_video;
        }
        }
        else
        {
        if(substr_count($p_video->portfolio_video,'youtu.be')>0)
        {
        
        $p_video->portfolio_video=str_replace('youtu.be','www.youtube.com/v',$p_video->portfolio_video);
        
        $p_video->portfolio_video = str_replace(array("v=", "v/", "vi/"), "v=",$p_video->portfolio_video);
        
        
        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#",$p_video->portfolio_video,$matches);
        
        echo '<iframe src="http://www.youtube.com/embed/'.$matches[0].'?wmode=transparent" frameborder="0" allowfullscreen></iframe>';
        
        }
        
        elseif(substr_count($p_video->portfolio_video,'youtube')>0)
        {
        $p_video->portfolio_video = str_replace(array("v=", "v/", "vi/"), "v=",$p_video->portfolio_video);
        
        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#",$p_video->portfolio_video,$matches);
        
        echo '<iframe src="http://www.youtube.com/embed/'.$matches[0].'?wmode=transparent" frameborder="0" allowfullscreen></iframe>';
        
        }
        elseif(substr_count($p_video->portfolio_video,'vimeo')>0)
        {
        
        $vid_code = explode("/",$p_video->portfolio_video);
        $vid = $vid_code[count($vid_code)-1];
        echo '<iframe src="http://player.vimeo.com/video/'.$vid.'?title=0&byline=0&portrait=0" frameborder="0"></iframe>';
        }
        
        else
        {
        echo $p_video->portfolio_video;
        }
        
        }
        ?>
        
        
        
        
        <?php }
        echo "<br /><br />";
        }?>
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </div>
                                </div>
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
                        <!-- tab end -->
                        <div class="clear"></div>
                        <?php if($check_worker_detail) { ?>
                        <div class="top-skill">
                            
                        	<div class="top-skill-title">My Skill</div>
                            <div class="skill-btn">
                            <?php
                              $workerskill1=$check_worker_detail->worker_task_type;
                              $workerskill=explode(',',$workerskill1);
                                 
                              foreach($workerskill as $skills) 
                              {
                                    
                                     $get_skilname=$this->worker_model->get_skilname($skills);
                               ?> 
                               <div class="skills">     
                                 <?php echo anchor('tags/'.$get_skilname->category_url_name,$get_skilname->category_name); ?>
                                </div>     
                               <?php     
                              }
                            ?>
                            </div>
                            <div class="clear"></div>
                            <?php if($user_profile->user_id==get_authenticateUserID()) {?>
                            <div style="text-align:center; margin:15px 0px;">
                            	<?php echo anchor('worker/edit/','Edit Skill',' class="btn btn-default btn-seemore"');?>
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="dbright-task dbright-task-10 dbright-task-10-new">
                    <?php  echo $this->load->view($theme.'/layout/user/profile_sidebar',$data); ?>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>  