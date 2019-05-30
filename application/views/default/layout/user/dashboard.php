<link type="text/css" rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/css/easy-responsivenew-tabsnew.css" />
<div class="body_cont body_cont-dashboard">
            <link rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/js/lib/themes/base/jquery.ui.all.css">
            <style type="text/css">    
            .flexy-menu{margin: 0!important}
            .flexy-menu{width: 100%;margin:0;padding: 0;position:relative;float:left;list-style: none;background:#565656;}
            .flexy-menu li{display:inline-block;font-size:14px;margin:0;padding:0;float:left;line-height: 20px;position:relative;}
            .flexy-menu > li > a{padding:20px 22px;color:#ccc;text-decoration:none;display:block;text-transform:uppercase;-webkit-transition:color 0.2s linear, background 0.2s linear;-moz-transition:color 0.2s linear, background 0.2s linear;-o-transition:color 0.2s linear, background 0.2s linear;transition:color 0.2s linear, background 0.2s linear;}
            .flexy-menu li:hover > a,.flexy-menu li.active a {background: #555;color: #fff;}
            .flexy-menu li.right{float: right;}
            .flexy-menu ul, .flexy-menu ul li ul{list-style: none;margin: 0;padding: 0;display: none;position: absolute;z-index: 99999;width: 132px;background: #565656;box-shadow: 0 1px 1px rgba(0,0,0,0.3)}
            .flexy-menu ul{top: 60px;left: 0}
            .flexy-menu ul li ul{top: 0;left: 100%}
            .flexy-menu ul li{clear:both;width:100%;border: none;font-size:12px;}
            .flexy-menu ul li a{padding:10px 20px;width:100%;color:#dedede;font-size:14px;text-decoration:none;display:inline-block;float:left;clear:both;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;-webkit-transition:color 0.2s linear, background 0.2s linear;-moz-transition:color 0.2s linear, background 0.2s linear;-o-transition:color 0.2s linear, background 0.2s linear;transition:color 0.2s linear, background 0.2s linear;}
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
            .orange li:hover > a, .orange li.active a{background:#ec6600;color: #fff!important}
            .flexy-menu.vertical {width: 100%}
            .flexy-menu.vertical li {width: 100%; border-bottom: 1px solid #fff}
            .flexy-menu.vertical li a {display:inline-block !important; width:100%; padding:10px 20px; box-sizing:border-box; -moz-box-sizing:border-box;-webkit-box-sizing: border-box}
            .flexy-menu.vertical ul li{width: 100%}
            .flexy-menu.vertical ul, .flexy-menu.vertical ul li ul {width: 175px}
            .flexy-menu.vertical ul {top:0; left:100%}
            .flexy-menu.vertical ul li ul{top:0}
            .flexy-menu.vertical.right {float:right !important}
            .flexy-menu.vertical.right ul{left: -150px !important;}
            .flexy-menu.vertical > li .indicator{top: 10px;right: 15px;font-size: 17px;}
            .flexy-menu.vertical ul > li .indicator{top:10px;right: 15px;}
            @media only screen and (max-width:1142px){
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
            
                jQuery(function() {
                    jQuery("#pupload2").fancybox();	
                     jQuery("#sprogress").fancybox();    
                });
            
            </script>
            <script type="text/javascript">
                                                function ser_task()
                                                {
                                                    if(document.frm_search_task_worker.search.value=="" || document.frm_search_task_worker.search.value=="Task Search")
                                                    {
                                                        alert("Please enter search value");
                                                        return false;
                                                    }
                                                }

            </script>
            <script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/responsive-verticalmenu_files/jquery-1.js"></script>

<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/responsive-verticalmenu_files/flexy-menu.js"></script>

<script type="text/javascript">$(document).ready(function(){$(".flexy-menu").flexymenu({speed: 400,type: "vertical", indicator: true});});</script>

<!--<script async src="<?php echo base_url().getThemeName(); ?>/responsive-verticalmenu_files/a.js" type="text/javascript"></script>-->
<?php 	$site_setting=site_setting();
$data['user_profile']=$user_profile;
?>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
function FacebookInviteFriends()
{
	FB.ui({
	   method: 'apprequests',
	   message: 'Come on man checkout my Website. visit <?php echo base_url() ?>'
	  },send_wall_invitation);
}
function send_wall_invitation(response) {
  	
	FB.ui({
       	method: 'send',
        name: 'Come on man checkout my Website',
		messsage: 'Come on man checkout my Website.',
        link: '<?php echo base_url(); ?>/index.php/sign_up',
        to : response.to
    });
    <?php /*?>var send_invitation_url='<?php echo base_url().getThemeName(); ?>/facebook/invite_facebook.php';
    $.ajax({
        url:send_invitation_url,
        data:{
            to:response.to
        },
        dataType:"json",
        type: 'POST',
        success: function(data){
//            alert("");
        }
    })<?php */?>
}
</script>
            <!--<div class="dashboard-title" style="margin:162px 0 0 0;font-size: 3vw;">
            <p class="dbtitle">DASHBOARD</p>
            <p class="welcome-user"><span class="welcome-text">Gaurav</span></p>
            </div>-->
            
            <div id="two-columnar-section" class="top-cont-main-dash">
                <div class="inside-task-fwidth">
                <div class="red-subtitle red-subtitle-new">Dashboard</div>
                    <div class="db-rightinfo-dash" >
                    
                    	<div class="container">
                            
                            <div class="profile-main-dash">
                                <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInLeft;" class="span3 wow fadeInLeft center animated">
                                    <div class="dashboard-leftmenu">
                                         <div class="editphoto-button">
<?php

 if($user_profile->profile_image!='') {  
					
						if(file_exists(base_path().'upload/user/'.$user_profile->profile_image)) { ?>
                        <div class="round_img cover_img">
                        	<img src="<?php echo base_url(); ?>upload/user/<?php echo $user_profile->profile_image;?>" alt="" class=""  />
                        </div>
                        <?php } else { ?>
                        
                  <img src="<?php echo base_url(); ?>upload/no_image.png" alt="" class="round_img"  />
                    
                    <?php } } else { ?>
                    
                    <img src="<?php echo base_url(); ?>upload/no_image.png" alt="" class="round_img"  />
                    
                    <?php } ?> 
                    <div class="editphoto-button editphoto-taxt editphoto-taxt-1">
                    	<a href="javascript:void(0)" id="pupload3"><img src="<?php echo base_url().getThemeName(); ?>/images/edit_pen.png" alt=""  /></a>
                    </div>
				    <!--<div class="editphoto-button editphoto-taxt">
                    <a href="user/upload_photo/dashboard" id="pupload2"><span style="color:red">Edit Photo</span></a>
                    </div>-->
					<script type="text/javascript">
                    	$(document).ready(function(){
							$("#pupload3").click(function(){
								$("#open_edit_icon").fadeIn();
								$("#fancybox-overlay").fadeIn();
							})
							$("#fancybox-overlay").click(function(){
								$("#open_edit_icon").fadeOut();
								$("#fancybox-overlay").fadeOut();
							})
							$("#fancybox-close").click(function(){
								$("#open_edit_icon").fadeOut();
								$("#fancybox-overlay").fadeOut();
							})
							
						})
                    </script>
</div>
                                        <div class="clear"></div>
                                        <div style="text-align:center;">
                                            <div class="btn btn-default btn-default-join btn-default-join-hiw btn-app btn-new-dash">
                                                <?php $check_is_worker=check_is_worker(get_authenticateUserID()); 
                                                    
                                                    if($check_is_worker=='2')
                                                    {
                                                            echo anchor('who-are-the-taskers','Become a Tasker');
                                                    }
                                                    else{ 

                                                             if($check_is_worker->worker_status==1) { 
                                                                echo anchor('worker/edit','Edit Tasker Profile');
                                                             } else if($check_is_worker->worker_status==0) {
                                                    ?>
                                                            <a href="">Application under review</a>
                                                    <?php 
                                                            } 
                                                    }
                                                    ?>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                        <ul class="dash-left-menu">
											<a href="dashboard"><li class="dash">Dashboard</li></a>
											<a href="account"><li class="myacc">My Account</li></a>
											<a href="user/<?php echo getUserProfileName() ?>"><li class="profile">My Profile</li></a>
											<a href="message/allmessage"><li class="message">Messages</li></a>
											<!--<a href="wallet"><li class="payment">Payment</li></a>-->
											<a href="home/logout" class="logout-left"><li class="logout">Logout</li></a>
										</ul>
                                        
                                    </div>
                                </div>
                                <div class="dash-right-profile">
                                	<div class="clear"></div>
                                    <div class="fleft100">
                                        <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInRight;" class="span3 wow fadeInRight center animated">
                                            <div class="welcome-top">
                                            	<div class="">
                                                	<div class="welcome-title-dash">How it works <?php echo $this->session->userdata('full_name'); ?>?
                                                        <h3>Dronework is as easy as 4 steps.</h3></div>

                                                    <div class="main-top-dash">
                                                        <div id="flexslider2" class="flexslider">
                                                            <ul class="slides styled-list">
                                                                <li>
                                                                	<div class="dashboard-slide1">
                                                                    	<a href="<?php echo base_url(); ?>index.php/task/newhome_task/c28">
                                                                            <img src="<?php echo base_url().getThemeName();?>/images/need_img1.png" alt="" />
                                                                            <div class="dashboard-title-slider">Upload</div>
                                                                            <div class="dashboard-title-slider-hover">Post Task</div>
                                                                        </a>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                	<div class="dashboard-slide1">
                                                                    	<a href="<?php echo base_url(); ?>index.php/task/newhome_task/c1">
                                                                            <img src="<?php echo base_url().getThemeName();?>/images/need_img2.png" alt="" />
                                                                            <div class="dashboard-title-slider">Find</div>
                                                                            <div class="dashboard-title-slider-hover">Post Task</div>
                                                                        </a>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                	<div class="dashboard-slide1">
                                                                    	<a href="<?php echo base_url(); ?>index.php/task/newhome_task/c115">
                                                                            <img src="<?php echo base_url().getThemeName();?>/images/need_img3.png" alt="" />
                                                                            <div class="dashboard-title-slider">Hire</div>
                                                                            <div class="dashboard-title-slider-hover">Post Task</div>
                                                                        </a>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                	<div class="dashboard-slide1">
                                                                    	<a href="<?php echo base_url(); ?>index.php/task/newhome_task/c133">
                                                                            <img src="<?php echo base_url().getThemeName();?>/images/need_img4.png" alt="" />
                                                                            <div class="dashboard-title-slider">Furniture Assembly</div>
                                                                            <div class="dashboard-title-slider-hover">Post Task</div>
                                                                        </a>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                	<div class="dashboard-slide1">
                                                                    	<a href="<?php echo base_url(); ?>index.php/task/newhome_task/c82">
                                                                            <img src="<?php echo base_url().getThemeName();?>/images/need_img5.png" alt="" />
                                                                            <div class="dashboard-title-slider">Work</div>
                                                                            <div class="dashboard-title-slider-hover">Post Task</div>
                                                                        </a>
                                                                    </div>
                                                                </li>
                                                                
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                        <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInRight;" class="span3 wow fadeInRight center animated">
                                            <div class="bottom-tabs bottom-tabs-1">
                                                <!-- tab start-->
                                                <div id="horizontalTab" class="detail-tab">
                                                    <ul class="resp-tabs-list">
                                                         <li>
                                                                <img src="<?php echo base_url().getThemeName(); ?>/images/messages_img.png" alt="" /> 
                                                                <br />
                                                                <span>My message</span>
                                                         </li>
                                                         <li>
                                                                <img src="<?php echo base_url().getThemeName(); ?>/images/my_task_history.png" alt="" /> 
                                                                <br />
                                                                <span>Task Summery</span>
                                                         </li>
                                                         <li>
                                                                <img src="<?php echo base_url().getThemeName(); ?>/images/membership_img.png" alt="" /> 
                                                                <br />
                                                                <span>My Credits</span>
                                                         </li>
                                                         <?php if($check_is_worker) { ?>
                                                         <li class="last-tab">
                                                                <img src="<?php echo base_url().getThemeName(); ?>/images/invitation_img.png" alt="" /> 
                                                                <br />
                                                                <span>Jobs with my skills</span>
                                                         </li>   
                                                         <?php } ?> 
                                                    </ul>
                                                    <div class="resp-tabs-container">
                                                        <div class="abtsty scroll_in">
                                                            <div class="home-signpost-content massage-inner-db" >
                                                                <div id="">
                                                                    <div class="content">
                                                                        <ul class="messages">
                                                                            <?php $allmessage = $this->message_model->get_message_by_id();
                                                                            
                                                                                if($allmessage){
                                                                                
                                                                                echo anchor('message','<p class="alert"><strong>Alerts</strong></p>','class="fpass"');
                                                                                
                                                                                    //echo "<pre>";print_r($allmessage);

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
                                                                                                case 'newoffer': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>New offer has been posted on <strong class="colblue fsNorm">'.$res->task_name.'</strong> by <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
                                                                                                break;
                                                                                                
                                                                                                case 'newmessage': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>New message from <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> on <strong class="colblue fsNorm">'.$res->task_name.'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
                                                                                                break;
                                                                                                
                                                                                                case 'offeraccept': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>Your offer accepted by <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> on <strong class="colblue fsNorm">'.$res->task_name.'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
                                                                                                break;
                                                                                                
                                                                                                case 'taskcomplete': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p><strong class="colblue fsNorm">'.$res->task_name.'</strong> has been marked completed by <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
                                                                                                break;
                                                                                                
                                                                                                case 'taskfinish': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p><strong class="colblue fsNorm">'.$res->task_name.'</strong> is all finished by  <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
                                                                                                break;
                                                                                                
                                                                                                //case 'workerwallet': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>Payment for <strong class="colblue fsNorm">'.$res->task_name.'</strong> has been credited to your wallet</p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>';
                                                                                                break;
                                                                                                
                                                                                                case 'taskdispute':  echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p><strong class="colblue fsNorm">'.$res->task_name.'</strong> has been disputed by  <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
                                                                                                break;
                                                                                                
                                                                                                case 'newconversation': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>New Conversation message from <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> on <strong class="colblue fsNorm">'.$res->task_name.'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
                                                                                                break;
                                                                                                
                                                                                                case 'taskdisputeconversation': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>New Dispute Conversation message from <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> on <strong class="colblue fsNorm">'.$res->task_name.'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
                                                                                                break;
                                                                                                 
                                                                                                  
                                                                                                  
                                                                                                    case 'taskwin': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>You won the dispute <strong>'.$res->task_name.'</strong>. Amount credited to your wallet.</p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 							
                                                                                                break;
                                                                                                
                                                                                                case 'taskloss': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>You loss the dispute <strong>'.$res->task_name.'</strong>. Amount credited to <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 																	
                                                                                                break;
                                                                                                
                                                                                                case 'taskcompromise': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p><strong>'.$res->task_name.'</strong> is compromised between Poster and Tasker. Amount credited to your wallet. </p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 																	
                                                                                                break;
                                                                                                
                                                                                                case 'taskresume': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />Your dispute task <strong>'.$res->task_name.'</strong> is resume.</p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 																	
                                                                                                break;
                                                                                                 
                                                                                                 
                                                                                                 
                                                                                                  
                                                                                                  case 'taskassign': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>Your offer accepted on <strong>'.$res->task_name.'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
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
                                                            <div class="clear"></div>
                                                        </div>
                                                        <div class="abttb2 abttb2-2 scroll_in">
                                                            <div class="home-signpost-content massage-inner-db" >
                                                                <div id="">
                                                                    <div class="content">
                                                                        <div class="summery-detail">
                                                                        	<script type="text/javascript">
                                                                            	$(document).ready(function(){
																					$("#task_running_click").click(function(){
																						$("#task_running").css("display","block");
																						$("#task_running_click").addClass("selected");
																						$("#task_posted").css("display","none");
																						$("#task_posted_click").removeClass("selected");
																					})
																					$("#task_posted_click").click(function(){
																						$("#task_running").css("display","none");
																						$("#task_running_click").removeClass("selected");
																						$("#task_posted").css("display","block");
																						$("#task_posted_click").addClass("selected");
																					})
																				})
                                                                            </script>
                                                                        	<div class="summery-detail-tab">
                                                                            	<ul>
                                                                                    <?php if($check_is_worker->worker_status==1) { ?>
                                                                                	<li  id="task_running_click">Task Running</li>
                                                                                    <?php } ?>
                                                                                    <li class="selected" id="task_posted_click">Tasks Posted</li>
                                                                                </ul>
                                                                            </div>
                                                                            <?php if($check_is_worker->worker_status==1) { ?>
                                                                            <div class="summery-detail-detail" id="task_running" style="display:none;">
                                                                            	<div class="bid-on-detail">
                                                                                	<div class="bid-on-detail-bar">
                                                                                    	<div class="<?php if($total_bid_task>0) { ?>yes-number  <?php } else {?>not-any-number <?php } ?> color-blue-back"></div>
                                                                                    </div>
                                                                                    <div class="bid-on-detail-text">
                                                                                    	<a href="<?php echo base_url();?>worker_task/open"><?php echo $total_bid_task; ?>
                                                                                    </div>
                                                                                    <div class="bid-on-detail-name">
                                                                                    	Bid on
                                                                                    </div>
                                                                                </div>
                                                                                <div class="bid-on-detail">
                                                                                	<div class="bid-on-detail-bar">
                                                                                    	<div class="<?php if($total_assign_task>0) { ?>yes-number  <?php } else {?>not-any-number <?php } ?> color-green-back"></div>
                                                                                    </div>
                                                                                    <div class="bid-on-detail-text">
                                                                                    	<a href="<?php echo base_url();?>worker_task/assigned"><?php echo $total_assign_task; ?></a>
                                                                                    </div>
                                                                                    <div class="bid-on-detail-name">
                                                                                    	Assigned
                                                                                    </div>
                                                                                </div>
                                                                                <!--<div class="bid-on-detail">
                                                                                	<div class="bid-on-detail-bar">
                                                                                    	<div class="not-any-number"></div>
                                                                                    </div>
                                                                                    <div class="bid-on-detail-text">
                                                                                    	0
                                                                                    </div>
                                                                                    <div class="bid-on-detail-name">
                                                                                    	Awaiting payment
                                                                                    </div>
                                                                                </div>-->
                                                                                <div class="completed-summery"> 
                                                                                	<div style="padding-top:22px;"><?php echo $total_close_task ?> <br /> Completed</div>
                                                                                </div>
                                                                            </div>
                                                                            <?php } ?>
                                                                            <div class="summery-detail-detail" id="task_posted"  >
                                                                            	<div class="bid-on-detail">
                                                                                   
                                                                                	<div class="bid-on-detail-bar">
                                                                                    	<!--<div class="not-any-number"></div>-->
                                                                                        <div class="<?php if($total_draft_task>0) { ?>yes-number  <?php } else {?>not-any-number <?php } ?> color-blue-back"></div>
                                                                                    </div>

                                                                                    <div class="bid-on-detail-text color-blue">
                                                                                    	<a href="<?php echo base_url();?>user_task/draft_tasks"><?php echo $total_draft_task;?></a>
                                                                                    </div>
                                                                                    <div class="bid-on-detail-name">
                                                                                    	Draft
                                                                                    </div>
                                                                                </div>
                                                                                <div class="bid-on-detail">
                                                                                	<div class="bid-on-detail-bar">
                                                                                    	<div class="<?php if($total_open_task>0) { ?>yes-number  <?php } else {?>not-any-number <?php } ?>  color-green-back"></div>
                                                                                    </div>
                                                                                    <div class="bid-on-detail-text color-green">
                                                                                    	<a href="<?php echo base_url();?>user_task/open_tasks"><?php echo $total_open_task;?></a>
                                                                                    </div>
                                                                                    <div class="bid-on-detail-name">
                                                                                    	Open for offers
                                                                                    </div>
                                                                                </div>
                                                                                <div class="bid-on-detail">
                                                                                	<div class="bid-on-detail-bar">
                                                                                    	<div class="<?php if($total_assigned_task>0) { ?>yes-number  <?php } else {?>not-any-number <?php } ?> color-blue-back"></div>
                                                                                    </div>
                                                                                    <div class="bid-on-detail-text color-blue">
                                                                                    	<a href="<?php echo base_url();?>user_task/assigned_task"><?php echo $total_assigned_task;?></a>
                                                                                    </div>
                                                                                    <div class="bid-on-detail-name">
                                                                                    	Assigned
                                                                                    </div>
                                                                                </div>
                                                                                <!--<div class="bid-on-detail">
                                                                                	<div class="bid-on-detail-bar">
                                                                                    	<div class="not-any-number color-orange-back"></div>
                                                                                    </div>
                                                                                    <div class="bid-on-detail-text color-orange">
                                                                                    	0
                                                                                    </div>
                                                                                    <div class="bid-on-detail-name">
                                                                                    	Awaiting payment
                                                                                    </div>
                                                                                </div>-->
                                                                                <div class="completed-summery"> 
                                                                                	<div style="padding-top:22px;"><?php echo $total_complete_task ?> <br /> Completed</div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="clear"></div>
                                                        </div>
                                                        <div class="abttb3 abttb3-2">
                                                            <div class="invite-friends-box box-border-dash">
                                                                <?php 
                                                                if($site_setting->credit_need==1) { ?>    
                                                                

                                                                <p> In order to place bid you must have credits in your account</p>
                                                                <p class="bigf33 dont_member">Currently you have <?php echo $user_profile->avilable_bid;?> Credits in your account</p>
                                                               		<div class="btn btn-default find-friends-btn" > <!--id="apply_now_button"-->
                                                                    	<a href="<?php echo base_url(); ?>user_other/Buy_credit">Get Credits Now</a> 
                                                                    </div>    
                                                                    <div class="clear"></div>
                                                                    <div class="yes_no_apply" style="display:none; padding-top:15px;">
                                                                    	<p style="padding-bottom:5px; color:#ec6600; font-weight:bold;">You will not be allow to post any task / place bids on tasks if you unscubscribe .</p>
                                                                        <p style="padding-bottom:5px; color:#ec6600; font-weight:bold;">Are you sure to Unsubscribe ?</p>
                                                                        <div class="clear"></div>
                                                                        <div style="text-align:center;">
                                                                        	<div class="btn btn-default find-friends-btn">
                                                                    			<div id="fb-root"></div>
                                                                        		<a href="<?php echo base_url(); ?>user_other/Buy_credit">Yes</a>
                                                                            </div>		 
                                                                            <div class="btn btn-default find-friends-btn">
                                                                        		<a href="javascript:void(0)" id="apply_now_button_no">No</a> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                	<?php //echo anchor('#','Check now','class="btn btn-default find-friends-btn"');?>
																	<script type="text/javascript">
                                                                        $(document).ready(function(){
                                                                            $("#apply_now_button").click(function(){
                                                                                $("#apply_now_button").slideUp('slow');
                                                                                $(".yes_no_apply").slideDown('slow');
                                                                            })
                                                                            $("#apply_now_button_no").click(function(){
                                                                                $(".yes_no_apply").slideUp('slow');
                                                                                $("#apply_now_button").slideDown('slow');
                                                                            })
                                                                                    
                                                                        })
                                                                    </script>
                                                                <?php } else {?>

                                                                <p>Introductory offer:  You do not need to purchase Bid credits Yes you read it correct!!Place bids on as many tasks as you can and grow your earning</p>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="clear"></div>
                                                        </div>
                                                        <div class="abttb4 abttb3-2 scroll_in">
                                                            <ul class="messages">
                                                                 <?php if($check_is_worker) { ?>
																<?php $task_list=$this->user_model->get_worker_city_cat_wisetasklist(get_authenticateUserID());
                                                                //echo "<pre>";print_r($task_list);
                                                                if($task_list)
                                                                {
                                                                foreach ($task_list as $key=>$val) {
                                                                    foreach ($val as $task_info) {
                                                                        
                                                                ?>
                                                                <li>
                                                                <div class="detailspart detailspart-last">
                                                                    <p>
                                                                    <a href="<?php echo site_url('task/task_detail/'.$task_info['task_url_name'].'/');?>"><?php echo ucfirst($task_info['task_name']) ?></a> 
                                                                    </p>
                                       
                                                                    <p class="item-price"> Tasks of this type: <span class="item-cost"><?php echo $site_setting->currency_symbol.$task_info['task_to_price'].' - '.$site_setting->currency_symbol.$task_info['task_price']; ?></span></p>
                                                                    <p class="item-short-des">
                                                                    <?php 
                                                                    $task_description= $task_info['task_description'];        
                                                                    $task_description=str_replace('KSYDOU','"',$task_description);
                                                                    $task_description=str_replace('KSYSING',"'",$task_description);
                                                                    $strlen = strlen($task_description);
                                                                    if($strlen > 50) { echo substr($task_description,0,50).' ...';}
                                                                    else { echo $task_description; } 
                                                                    
                                                                    ?>                                
                                                                    </p>
                                                                </div>
                                                                <div class="fr">
                                                                    <div class="btn btn-default view-map-btn-db" style="margin-top:10px;"><a href="<?php echo site_url('user_other/accept/'.$task_info['task_id'].'/');?>">Place Bid</a></div>
                                                                    <div class="btn btn-default view-map-btn-db" style="margin-top:10px;"><a href="<?php echo site_url('user_other/reject/'.$task_info['task_id'].'/');?>" onclick="return confirm('Oh !!!!  Are you sure to reject this task invitation ?')">Reject</a></div>
                                                                </div>
                                                                </li>
                                                                <?php } } } else {?> 
    
                                                                <li>
                                                                    <div style="text-align:center;">
                                                                            <p style="color:#585858; font-size:20px; padding-bottom:10px;">Sorry you did not got any task invitation</p>
                                                                    
                                                                            <p style="color:#585858; font-size:16px; padding-bottom:10px;">But good news you can still search and place bid on tasks</p>
                                                                            
                                                                            <p><?php echo anchor('task/all_task','Search now','class="btn btn-default find-friends-btn"');?></p>
            
                                                                    </div>
            
                                                                </li>
                                                            <?php } } else {?>
                                                            <li>Apply To Become a Tasker</li>
        													<?php } ?>
                                                            </ul>
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
                                                <div class="top-skill">
                                                	<?php $profile_complete=user_profile_complete(); ?>
                                                    <div class="top-skill-title">Your profile is <?php echo $profile_complete; ?>% complete</div>
                                                    <div class="db-fwidth-cont dashboard-battom-box">
                                                        <div class="clear"></div>
                                                        <!--<div style="clear: both; overflow: hidden; padding-top: 15px;">
                                                            <div class="profile-progess-bar">
                                                                <script type="text/javascript">
                                                                    jQuery(function() {
                                                                        jQuery(".meter > span").each(function() {
                                                                            jQuery(this)
                                                                                .data("origWidth", $(this).width())
                                                                                .width(0)
                                                                                .animate({
                                                                                    width: $(this).data("origWidth")
                                                                                }, 1200);
                                                                        });
                                                                    });
                                                                </script>
                                                                
                                                                <div class="meter red">
                                                                    <span style="width: <?php echo $profile_complete; ?>%"><?php echo $profile_complete; ?>%</span>
                                                                </div>
                                                                <h2><a href="http://taskit.co.za/customize_profile">Setup your Profile</a></h2>
                                                            </div>
                                                        </div>-->
                                                        <!--<p class="pr-status welcome-status-db"></p>-->
                                                        <div class="clear"></div>
                                                        <div class="welcome-top-left">
                                                            <div class="clear"></div>
                                                            <div class="profile-meter">
                                                                <ul>
                                                                    <li>
                                                                        <a href="<?php echo site_url('account/');?>">
                                                                            <img src="<?php echo base_url().getThemeName(); ?>/images/myccount_img.png" alt="" />                                                                                        	<br />                                                                                     	
                                                                            Account
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="<?php echo site_url('user/'.getUserProfileName());?>">
                                                                            <img src="<?php echo base_url().getThemeName(); ?>/images/myprofile_img.png" alt="" />
                                                                            <br />
                                                                            Profile
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <?php 
                                                                               if($check_is_worker->worker_status==1) { 
                                                                                $link=base_url().'worker/edit';
                                                                               } 
                                                                               else {
                                                                                $link=base_url().'who-are-the-taskers';
                                                                               }
                                                                        ?>
                                                                        <a href="<?php echo $link; ?>">
                                                                            <img src="<?php echo base_url().getThemeName(); ?>/images/skill_img.png" alt="" />
                                                                            <br />
                                                                            Skills
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="welcome-top-right">
                                                            <?php if($profile_complete < 100) { ?>
                                                            <div class="progress-bar position" data-percent="<?php echo $profile_complete; ?>" data-color="#0e0f19,#ec6600 "></div>
                                                            <?php } else { ?>
                                                            <div class="progress-bar position" data-percent="<?php echo $profile_complete; ?>" data-color="#00ad00,#00ad00 "></div>
                                                            <?php } ?>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                </div>
                                                <div class="clear"></div>
                                                <div class="top-skill">
                                                    <div class="top-skill-title">Earn Money! - find and bid on suitable jobs</div>
                                                    <div class="db-fwidth-cont dashboard-battom-box">
                                                        <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInLeft;" class="span3 wow fadeInLeft center animated ani-categori">
                                                            <div class="clear"></div>
                                                            <div class="browse-ts category-box-main-db">
                                                                <div id="browse-tasks" class="category-box-dashboard" >
                                                                    <div class="red-subtitle category-box-tit-db">Find jobs by category</div>
                                                                    <ul class="flexy-menu orange vertical">
                                                                    
                                                                    <?php
                                                                    
                                                                    $category_infos=get_category();
                                                                    
                                                                    if($category_infos) { $ccnti=0;
                                                                    foreach($category_infos as $category_info) {
                                                                    
                                                                    if($ccnti<5) {
                                                                    $sub_categories = sub_category($category_info->task_category_id);
                                                                    if($sub_categories){
                                                                    ?>
                                                                    <li style="display: block;"><?php echo anchor('task/all_task/'.$category_info->task_category_id,$category_info->category_name);?>
                                                                    <ul style="display: none;">
                                                                    <?php foreach($sub_categories as $sub_category) { ?>
                                                                    <li><?php echo anchor('task/all_task/'.$sub_category->task_category_id,$sub_category->category_name);?></li>
                                                                    <?php } ?>
                                                                    </ul>
                                                                    <?php } else {?>
                                                                    <li><?php echo anchor('task/all_task/'.$category_info->task_category_id,$category_info->category_name);?></li>
                                                                    <?php  }
                                                                    $ccnti++;   } } ?>
                                                                    
                                                                    <li style="display: block;"><?php echo anchor('task/all_task','View all','id="" class="view-category-btn-db"');?></li>
                                                                    
                                                                    <?php } ?>
                                                                    
                                                                    
                                                                    
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="left-bottom-db">
                                                            <div class="clear"></div>
                                                            <div style="visibility: visible; animation-delay: 0.7s; animation-name: fadeInRight;" class="span3 wow fadeInRight center animated">
                                                                <div class="search-task see-map-main-db see-map-main-db-1">
                                                                    <!--<div class="fl left-dash">
                                                                        <div class="subsection-title red-title">View Tasks on Map</div>
                                                                        <div class="clear"></div>
                                                                        <div class="mapicon-ph mapicon-db">
                                                                            <img style="margin:0 10px 0 0" src="<?php echo base_url().getThemeName(); ?>/images/map-icon.png">
                                                                        </div>
                                                                        <div class="vtaskmap">
                                                                            <div class="btn btn-default view-map-btn-db"><a href="<?php echo base_url()?>map/">View Task Map</a></div>
                                                                        </div>
                                                                    </div>
                                                                    <div style="margin-left:0px;" class="divider"><h2 style="margin-top:15.1%;">Or</h2></div>-->
                                                                    <div class="left-dash" style="margin:auto;">
                                                                        <div class="subsection-title red-title">Search Tasks</div>
                                                                        <div class="clear"></div>
                                                                        <div id="search-task" style="background:none; padding:25px 0 58px !important">
                                                                            <div class="tasksearch-inner">
                                                                                <div class="search-taskph search-taskdb">
                                                                                    <?php
                                                                                        $attributes = array('name'=>'frm_search_task_worker','onSubmit'=>'return ser_task()',);
                                                                                        echo form_open('search',$attributes); ?>
                        
                                                                                        <input type="text" class="emailid form-control form-control-search-task" onBlur="if(this.value == '') {this.value = 'Task Search'}" onFocus="if(this.value == 'Task Search') {this.value = ''}" value="Task Search" name="search">
                                                                                        <br />
                                                                                        <div class="vtaskmap">
                                                                                            <input type="submit" class="search-btn-dashb btn btn-default" value="Search Task">
                                                                                        </div>
                                                                                        
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
                                                <div class="clear"></div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
</div>
<div id="fancybox-overlay" style="background-color: rgb(119, 119, 119); opacity: 0.7; cursor: pointer; height: 100%; z-index:999999; display: none; position:fixed;"></div>                   
<div id="open_edit_icon" style=" background: #fff none repeat scroll 0 0; box-shadow: 3px 3px 15px #585858; padding: 15px; position: absolute; top: 40%; z-index: 999999999; display:none; left:30%;">
      <a id="fancybox-close" style="display: inline;"></a>
      <script type="text/javascript">
      
      
      
      function submit_image_valid()
      {
      
      
       
      frmCheckform = document.frm_addgallery;
              // assigh the name of the checkbox;
              var chks = document.getElementsByName('file_up');
       
              var hasChecked = false;
            
                  
                  
                      if (chks[0].value=='')
                      {
                              check=false;
                              var dv = document.getElementById('error');						
                              dv.style.clear = "both";
                              dv.innerHTML = '<p> Image is required.</p>';
                              dv.style.display='block';
                              
                              hasChecked = true;
                              
                              return false;
                      }
                      else 
                      {
                              
                              value = chks[0].value;
                              t1 = value.substring(value.lastIndexOf('.') + 1,value.length);
                              if( t1=='jpg' || t1=='jpeg' || t1=='gif' || t1=='png' || t1=='JPEG' || t1=='JPG'  ||  t1=='PNG' || t1=='GIF' )
                              {
                                  document.getElementById('error').style.display='none';
                                  check=true;
                              }
                              else
                              {						
                              
                                  check=false;
                                  i=0;
                                  var dv = document.getElementById('error');
              
                                  
                                  dv.style.clear = "both";							
                                  dv.innerHTML = ' <p>Image type is not valid.</p>';
                                  dv.style.display='block';
                                  hasChecked = true;
                                  
                                  return false;
                              }			
                              
                      }
                      
              
                  
              
              
      
      }
      
      
      </script>

      <script type="text/javascript">
  $(document).ready(function() {
     $("iframe").each(function(){
         var ifr_source = $(this).attr('src');
         var wmode = "wmode=transparent";
         if(ifr_source.indexOf('?') != -1) {
             var getQString = ifr_source.split('?');
             var oldString = getQString[1];
             var newString = getQString[0];
             $(this).attr('src',newString+'?'+wmode+'&'+oldString);
         }
         else $(this).attr('src',ifr_source+'?'+wmode);
     });
  });
  </script>  


      <?php if($msg=='success') { 
      
          if($ref_link!='') { $ref_link=site_url($ref_link); } else { $ref_link=site_url('customize_profile'); } 
      
      ?>

      <script type='text/javascript'>
      location.href='<?php echo $ref_link ; ?>';
      </script>
      <?php } ?>

      <?php		
                         
        $attributes = array('name'=>'uploadPhoto','id'=>'uploadPhoto','onsubmit'=>'return submit_image_valid()');
            echo form_open_multipart('user/upload_photo/'.$ref_link,$attributes); 
            
            ?>
        
               <div  id="error" class="error" style="display:none;"> </div>         
                        
      <table border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td width="120" valign="top">
          
       
          
           <?php
                          
                          if($user_profile->profile_image!='') {  
                          
                              if(file_exists(base_path().'upload/user/'.$user_profile->profile_image)) { ?>
                              
                              <img src="<?php echo base_url(); ?>upload/user/<?php echo $user_profile->profile_image;?>"  alt="" class="fl upload_img" border="0" width="100" height="100"  />
                              
                              <?php } else { ?>
                              
                        <img src="<?php echo base_url(); ?>upload/no_image.png" border="0" width="100" height="100" alt="" class="fl upload_img"  />
                          
                          <?php } } else { ?>
                          
                          <img src="<?php echo base_url(); ?>upload/no_image.png" border="0" width="100" height="100" alt="" class="fl upload_img"  />
                          
                          <?php } ?>
          
          
          </td>
          <td  valign="top" class="other-pho"><input name="file_up" type="file" id="file_up" />
          <p class="marTB10">Photos should be no larger than 1MB. Need to resize? <?php echo anchor('http://www.picresize.com','picresize.com',' class="fpass fs12"');?></p>
          <input type="hidden" name="prev_image" id="prev_image" value="<?php echo $user_profile->profile_image; ?>" />
          <input type="hidden" name="ref_link" id="ref_link" value="<?php echo $ref_link; ?>" />
          <input type="submit" name="sub_upphoto"  value="Upload Picture" class="btn btn-default" id="sub_upphoto"  />
          </td>
        </tr>
      </table>
      </form>
  </div>
<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/jquery.flexslider.js"></script>
<script type="text/javascript">
	jQuery('.flexslider').flexslider({						
		  slideshow: true,
		  itemWidth: 180,
		  itemMargin: 10,
		  minItems: 1,
		  maxItems: 4,
		  slideshowSpeed: 3500,
		  animationDuration: 1000,
		  directionNav: true,
		  controlNav: true,
		  smootheHeight:true,
		  after: function(slider) {
			slider.removeClass('loading');
		  }
			  
	});
</script>

<script src="<?php echo base_url().getThemeName(); ?>/js/easyResponsiveTabs.js" type="text/javascript"></script>  
<script type="text/javascript">
	$(function() {
		$("#tabs").tabs();		
	});
</script>
<link rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/jQuery-plugin-progressbar.css">
<script src="<?php echo base_url().getThemeName(); ?>/jQuery-plugin-progressbar.js"></script>
<script type="text/javascript">
	$(".progress-bar").loading();
</script>