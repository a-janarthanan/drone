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
            .orange li:hover > a, .orange li.active a{background:#881926;color: #fff!important}
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


$(document).ready(function() {
    $('#unsub').click(function() {

       window.location.href = "<?php echo base_url();?>user/unsubscribr;
       
    });
});

            

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
                    <div class="db-rightinfo-dash" >
                    	<div class="container">
                            <div class="red-subtitle">Översikt</div>
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
                    <a href="user/upload_photo/dashboard" id="pupload2"><span style="color:red">Redigera foto</span></a>
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
                                            <div class="btn btn-default btn-tasker-profile btn-tasker-profile-12">
                                                <?php $check_is_worker=check_is_worker(get_authenticateUserID()); 
                                                    
                                                    if($check_is_worker=='2')
                                                    {
                                                            echo anchor('who-are-the-taskers','Bli en Entoworker');
                                                    }
                                                    else{ 

                                                             if($check_is_worker->worker_status==1) { 
                                                                echo anchor('worker/edit','Redigera min profil');
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
											<a href="dashboard"><li class="dash">Översikt</li></a>
											<a href="account"><li class="myacc">Mitt Konto</li></a>
											<a href="user/<?php echo getUserProfileName() ?>"><li class="profile">Min Profil</li></a>
											<a href="message/allmessage"><li class="message">Meddelanden</li></a>
											<a href="wallet"><li class="payment">Betalningar</li></a>
											<a href="home/logout"><li class="logout">Logga ut</li></a>
										</ul>
                                        
                                    </div>
                                </div>
                                <div class="dash-right-profile">
                                	<div class="clear"></div>
                                    <div class="fleft100">
                                        <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInRight;" class="span3 wow fadeInRight center animated">
                                            <div class="welcome-top">
                                            	<div class="welcome-top-left">
                                                    <p class="pr-status welcome-status-db">Välkommen <?php echo $user_profile->first_name; ?></p>
                                                    <span class="bigf33 welcome-status-db2">Vad behöver du hjälp med idag?</span>
                                                    <div class="clear"></div>
                                                    <div class="post-task-btn-db btn btn-default" >
                                                        <?php if($site_setting->subscription_need==0) {?>
                                                        <a href="<?php echo base_url()?>task/newhome_task">Skapa Uppdrag</a>
                                                        <?php } elseif($site_setting->subscription_need==1) { 

                                                                if($user_profile->profile_active==1)
                                                                {
                                                                    ?>
                                                                    <a href="<?php echo base_url()?>task/newhome_task">Skapa Uppdrag</a>

                                                        <?php

                                                                }
                                                                else
                                                                {
                                                        ?>
                                                        			<a href="javascript:void(0)" class="pupload13" >Skapa Uppdrag</a>
                                                                    
                                

                                                        <?php } } ?>
                                                    <script type='text/javascript'>
                                                    if (top.location!= self.location)
                                                    {
                                                    top.location = self.location
                                                    }
                                                    </script>
    
                                                    </div>
                                                </div>
                                                <div class="welcome-top-right">
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
                                                            <?php $profile_complete=user_profile_complete(); ?>
                                                            <div class="meter red">
                                                                <span style="width: <?php echo $profile_complete; ?>%"><?php echo $profile_complete; ?>%</span>
                                                            </div>
                                                            <h2><a href="http://taskit.co.za/customize_profile">Ändra profilinställningar</a></h2>
                                                        </div>
                                                    </div>-->
                                                    
                                                    <div class="progress-bar position" data-percent="<?php echo $profile_complete; ?>" data-color="#0e0f19,#881926 "></div>
                                                    <div class="profile-progess-bar">
                                                        <h2><a href="<?php echo base_url() ?>customize_profile">Ändra profilinställningar</a></h2>
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
                                                                <span>Mina meddelanden</span>
                                                         </li>
                                                         <li>
                                                                <img src="<?php echo base_url().getThemeName(); ?>/images/my_task_history.png" alt="" /> 
                                                                <br />
                                                                <span>Uppdragshistorik</span>
                                                         </li>
                                                         <li>
                                                                <img src="<?php echo base_url().getThemeName(); ?>/images/membership_img.png" alt="" /> 
                                                                <br />
                                                                <span>Medlemskap</span>
                                                         </li>
                                                         <?php if($check_is_worker) { ?>
                                                         <li class="last-tab">
                                                                <img src="<?php echo base_url().getThemeName(); ?>/images/invitation_img.png" alt="" /> 
                                                                <br />
                                                                <span>Mina inbjudningar</span>
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
                                                                                
                                                                                echo anchor('message','<p class="alert"><strong>Notifikationer('.get_user_unread_notification().')</strong></p>','class="fpass"');
                                                                                
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
                                                                                                case 'newoffer': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>Ett bud har lagts på <strong class="colblue fsNorm">'.$res->task_name.'</strong> av <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
                                                                                                break;
                                                                                                
                                                                                                case 'newmessage': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>Nytt meddelande från <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> on <strong class="colblue fsNorm">'.$res->task_name.'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
                                                                                                break;
                                                                                                
                                                                                                case 'offeraccept': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>Ditt bud har accepterats av <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> på <strong class="colblue fsNorm">'.$res->task_name.'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
                                                                                                break;
                                                                                                
                                                                                                case 'taskcomplete': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p><strong class="colblue fsNorm">'.$res->task_name.'</strong> har markerats som slutförd <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
                                                                                                break;
                                                                                                
                                                                                                case 'taskfinish': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p><strong class="colblue fsNorm">'.$res->task_name.'</strong> är avslutad av  <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
                                                                                                break;
                                                                                                
                                                                                                case 'workerwallet': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>Betalningen för <strong class="colblue fsNorm">'.$res->task_name.'</strong> har lagts till i ditt saldo.</p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>';
                                                                                                break;
                                                                                                
                                                                                                case 'taskdispute':  echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p><strong class="colblue fsNorm">'.$res->task_name.'</strong> has been disputed by  <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
                                                                                                break;
                                                                                                
                                                                                                case 'newconversation': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>Nytt meddelande från <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> om <strong class="colblue fsNorm">'.$res->task_name.'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
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
                                                                            <li>Du har inga nya meddelanden. </li>
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
                                                                        <ul class="messages">
                                                                        <?php if($my_task) { ?>
                                                                                   <?php foreach($my_task as $mtask) {
                                                                                   
                                                                                   $close_status='';
                                                                                   
                                                                                   if($mtask->task_activity_status==3) { $close_status='lockbg '; } 
                                                                                   
                                                                                    ?>         	
                                                                                                
                                                                                                
                                                                                                <li>
                                                                                                        <div class="taskhleft">
                                                                                                            <div class="history-post-title"><?php echo anchor('tasks/'.$mtask->task_url_name,ucfirst($mtask->task_name),' class="'.$close_status.'homepick"');?></div>
                                                                                                            <div>
                                                                                                           
                                                                                                           
                                                                                                             <span class="geo">
                                                                                                           <?php if($mtask->task_status==2) { ?>
                                                                                                           Drafted <?php echo getDuration($mtask->task_post_date); ?>
                                                                                                           <?php } else {
                                                                                                           
                                                                                                                        if($mtask->task_activity_status==0) { ?>
                                                                                                                        
                                                                                                                         Skapad <?php echo getDuration($mtask->task_post_date); ?>
                                                                                                           
                                                                                                                    <?php } if($mtask->task_activity_status==1) { ?>
                                                                                                                    Tilldelad <?php echo getDuration($mtask->task_assigned_date); ?>
                                                                                                                    
                                                                                                                    <?php } if($mtask->task_activity_status==2) { ?>
                                                                                                                    
                                                                                                                    Completed <?php echo getDuration($mtask->task_complete_date); ?>
                                                                                                                    
                                                                                                                      <?php } if($mtask->task_activity_status==3) { ?>
                                                                                                                      Stängd <?php echo getDuration($mtask->task_close_date); ?>
                                                                                                                      
                                                                                                                      <?php } if($mtask->task_activity_status==4) { ?>
                                                                                                                      Cancelled about <?php echo getDuration($mtask->task_cancel_date); ?>
                                                                                                                      <?php }
                                                                                                                      
                                                                                                       } ?>
                                                                                                         </span>  
                                                                                                        
                                                                                                            
                                                                                                            
                                                                                                            
                                                                                                            
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="taskhrig">
                                                                                                             <a href="javascript:void();" class="fr"  onclick="remove_div2(this)"><img src="<?php echo base_url().getThemeName(); ?>/images/close.png" alt="Close"></a><div class="clear"></div>
                                                                                                        
                                                                                                        
                                                                                                            <?php if($mtask->task_status==2 || $mtask->task_status==3) { echo anchor('task/step_one/'.$mtask->task_id,'post it!',' id="postit" class="post-status-db"'); } ?>
                                                                                                            
                                                                                                            
                                                                                                            
                                                                                                        </div>
                                                                                                        <div class="clear"></div>
                                                                                              </li>
                                                                                              
                                                                                              
                                                                                       <?php } 
                                                                                       
                                                                                        } else {?>                   
                                                                                              
                                                                                  <li style="padding:5px 0 0 0;">Du har ingen uppdragshistorik. </li>          
                                                                                            
                                                                                    <?php } ?>
                                                                                            </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="clear"></div>
                                                        </div>
                                                        <div class="abttb3 abttb3-2">
                                                            <div class="invite-friends-box box-border-dash">
                                                                <?php if($user_profile->profile_active==0) { ?>    
                                                                <p>Hjälp oss att utveckla Entowork. I dagsläget så är tjänsten helt gratis!</p>
                                                                <p class="bigf33 dont_member">Har du inget medlemskap än? </p>
                                                                
                                                                <?php
                                                                $paypal_url ='https://www.paypal.com/cgi-bin/webscr';
                                                                //Here we can used seller email id.
                                                                $merchant_email = 'foretag@entowork.se';
                                                                //here we can put cancel URL when payment is not completed.
                                                                $cancel_return = 'http://www.entowork.se/user_other/cancelsub';
                                                                //here we can put cancel URL when payment is Successful.
                                                                $success_return = "http://www.entowork.se/user_other/sucesssub";
                                                                
                                                                $product_name='Payment for acctivate account';
                                                                $total_cycle='';
                                                                $cycle_amount=$site_setting->subscription_price;
                                                                $cycle=$site_setting->subscription_time;
                                                                $product_currency='USD';
                                                                ?>
                                                                <form name = "myform" action = "<?php echo $paypal_url; ?>" method = "post" target = "_top">
                                                                <input type="hidden" name="cmd" value="_xclick-subscriptions">
                                                                <input type = "hidden" name = "business" value = "<?php echo $merchant_email; ?>">
                                                                <input type="hidden" name="lc" value="IN">
                                                                <input type = "hidden" name = "item_name" value = "<?php echo $product_name; ?>">
                                                                <input type="hidden" name="no_note" value="1">
                                                                <input type="hidden" name="src" value="1">
                                                                <?php if (!empty($total_cycle)) { ?>
                                                                <input type="hidden" name="srt" value="<?php echo $total_cycle; ?>">
                                                                <?php } ?>
                                                                <input type="hidden" name="a3" value="<?php echo $cycle_amount; ?>">
                                                                <input type="hidden" name="p3" value="1">
                                                                <input type="hidden" name="t3" value="<?php echo $cycle; ?>">
                                                                <input type="hidden" name="currency_code" value="<?php echo $product_currency; ?>">
                                                                <input type = "hidden" name = "cancel_return" value = "<?php echo $cancel_return ?>">
                                                                <input type = "hidden" name = "return" value = "<?php echo $success_return; ?>">
                                                                <input type="hidden" name="bn" value="PP-SubscriptionsBF:btn_subscribeCC_LG.gif:NonHostedGuest">
                                                                	<div class="btn btn-default find-friends-btn" id="apply_now_button">
                                                                    	<a href="javascript:void(0)">Starta här</a> 
                                                                    </div>    
                                                                    <div class="clear"></div>
                                                                    <div class="yes_no_apply" style="display:none; padding-top:15px;">
                                                                    	<p style="padding-bottom:5px; color:#881926; font-weight:bold;">Vi tar en blygsam avgift på <?php echo $site_setting->subscription_price; ?> kr/mån för att kunna fortsätta att utveckla Entowork </p>
                                                                        <p style="padding-bottom:5px; color:#881926; font-weight:bold;">Klicka på JA för att fortsätta! </p>
                                                                        <div class="clear"></div>
                                                                        <div style="text-align:center;">
                                                                        	<div class="btn btn-default find-friends-btn">
                                                                    			<div id="fb-root"></div>
                                                                        		<a href="javascript:void(0)" onclick="document.myform.submit();">JA</a>
                                                                            </div>		 
                                                                            <div class="btn btn-default find-friends-btn">
                                                                        		<a href="javascript:void(0)" id="apply_now_button_no">NEJ</a> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
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

                                                                <p>In order to Post / Apply for Jobs you need to have membership of ENTOWORK</p>
                                                                <p class="bigf33 dont_member">Good news!  You are already subscribed for membership</p>
                                                               		<div class="btn btn-default find-friends-btn" id="apply_now_button">
                                                                    	<a href="javascript:void(0)">Usubscribe now </a> 
                                                                    </div>    
                                                                    <div class="clear"></div>
                                                                    <div class="yes_no_apply" style="display:none; padding-top:15px;">
                                                                    	<p style="padding-bottom:5px; color:#881926; font-weight:bold;">You will not be allow to post any task / place bids on tasks if you unscubscribe .</p>
                                                                        <p style="padding-bottom:5px; color:#881926; font-weight:bold;">Are you sure to Unsubscribe ?</p>
                                                                        <div class="clear"></div>
                                                                        <div style="text-align:center;">
                                                                        	<div class="btn btn-default find-friends-btn">

                                                                    			<div id="fb-root"></div>
                                                                        		<a href="<?php echo base_url();?>user_other/unsubscribr" id="unsub" >Yes</a>
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
                                                                <a href="<?php echo site_url('task_detail/'.$task_info['task_url_name'].'/');?>"><?php echo ucfirst($task_info['task_name']) ?></a> 
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
                                                            	<div class="btn btn-default view-map-btn-db" style="margin-top:10px;"><a href="<?php echo site_url('user_other/accept/'.$task_info['task_id'].'/');?>">Accept</a></div>
                                                                <div class="btn btn-default view-map-btn-db" style="margin-top:10px;"><a href="<?php echo site_url('user_other/reject/'.$task_info['task_id'].'/');?>" onclick="return confirm('Oh !!!!  Are you sure to reject this task invitation ?')">Reject</a></div>
                                                            </div>
                                                    		</li>
                                                    <?php } } } else {?> 

                                                    <li>
                                                        <div style="text-align:center;">
                                                                <p style="color:#585858; font-size:20px; padding-bottom:10px;">Du har tyvärr ingen aktiv inbjudan just nu.</p>
                                                        
                                                                <p style="color:#585858; font-size:16px; padding-bottom:10px;">Men oroa dig inte! Du kan fortfarande söka bland lediga uppdrag.</p>
                                                                
                                                                <p><?php echo anchor('tags/','Hitta Uppdrag','class="btn btn-default find-friends-btn"');?></p>

                                                        </div>

                                                    </li>


                                                    <?php } } else {?>
                                                    <li>Ansök om att bli en Entoworker</li>

                                                    <?php } ?>
                                                            
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
                                                    <div class="top-skill-title">Tjäna pengar! Hitta och buda på mikrojobb som finns tillgänliga. </div>
                                                    <div class="db-fwidth-cont dashboard-battom-box">
                                                        <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInLeft;" class="span3 wow fadeInLeft center animated ani-categori">
                                                            <div class="clear"></div>
                                                            <div class="browse-ts category-box-main-db">
                                                                <div id="browse-tasks" class="category-box-dashboard" >
                                                                    <div class="red-subtitle category-box-tit-db">Hitta uppdrag efter kategori</div>
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
                                                                    
                                                                    <li style="display: block;"><?php echo anchor('tags','Visa alla','id="" class="view-category-btn-db"');?></li>
                                                                    
                                                                    <?php } ?>
                                                                    
                                                                    
                                                                    
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="left-bottom-db">
                                                            <div class="clear"></div>
                                                            <div style="visibility: visible; animation-delay: 0.7s; animation-name: fadeInRight;" class="span3 wow fadeInRight center animated">
                                                                <div class="search-task see-map-main-db see-map-main-db-1">
                                                                    <div class="fl left-dash">
                                                                        <div class="subsection-title red-title">Hitta Uppdrag Via Kartan</div>
                                                                        <div class="clear"></div>
                                                                        <div class="mapicon-ph mapicon-db">
                                                                            <img style="margin:0 10px 0 0" src="<?php echo base_url().getThemeName(); ?>/images/map-icon.png">
                                                                        </div>
                                                                        <div class="vtaskmap">
                                                                            <div class="btn btn-default view-map-btn-db"><a href="<?php echo base_url()?>map/">Visa uppdragskarta</a></div>
                                                                        </div>
                                                                    </div>
                                                                    <div style="margin-left:0px;" class="divider"><h2 style="margin-top:15.1%;">Alt</h2></div>
                                                                    <div class="fr left-dash">
                                                                        <div class="subsection-title red-title">Sök Uppdrag</div>
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
                                                                                            <input type="submit" class="search-btn-dashb btn btn-default" value="Sök Uppdrag">
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
          <p class="marTB10">Fotot får ej överstiga 1MB i storlek. Behöver du ändra den? ? <?php echo anchor('http://www.picresize.com','picresize.com',' class="fpass fs12"');?></p>
          <input type="hidden" name="prev_image" id="prev_image" value="<?php echo $user_profile->profile_image; ?>" />
          <input type="hidden" name="ref_link" id="ref_link" value="<?php echo $ref_link; ?>" />
          <input type="submit" name="sub_upphoto"  value="Ladda upp foto" class="btn btn-default" id="sub_upphoto"  />
          </td>
        </tr>
      </table>
      </form>
  </div>
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