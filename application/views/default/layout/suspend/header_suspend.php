<!-- used in index -->
<script type="text/javascript">
            jQuery(function($) {
/**/
    jQuery('.select_city .city').click(function (){         
        jQuery('.select_city ul').slideToggle(100);
        //jQuery('.wrap').show();
    });


    jQuery('.select_city li a').click(function (){
        var val = $(this).text();
        $('.select_city .city').text(val);
        jQuery('.select_city ul').hide("fast");
        //jQuery('.wrap').hide();       
    });


/**/
            });
</script>

<style>
/** user open menu s **/
.acc_div{
    width:150px;
    position:absolute;
    background:url(<?php echo base_url().getThemeName()?>/images/ul_bg.jpg) repeat-x bottom #ebf3f8;
    border:1px solid #b0cfe2;
    border-radius:0px 0px 10px 10px;
    -moz-border-radius:0px 0px 10px 10px;
    padding:5px;
    display:none;
}
.acc_div li{
    padding:5px 10px;
    border-bottom:1px solid #cbdbe6;
    font-size:13px;
    color:#6a6a6a;
    font-weight:bold;
}
.acc_div li a,.acc_div li a:visited{
    color:#000000;
    font-size:11px;
}
.acc_div ul li a:hover{ color:#000000;}

.hidden { display:none; }

/** user open menu e **/
</style>
<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/script.js"></script>
<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/animatedcollapse.js"></script>
<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/jquery.flexisel_new.js"></script>
<script type="text/javascript">

animatedcollapse.addDiv('jason', 'fade=1,persist=0,hide=1')
animatedcollapse.addDiv('kelly', 'fade=1,height=100px')
animatedcollapse.addDiv('michael', 'fade=1,height=120px')
animatedcollapse.addDiv('cat', 'fade=0,speed=400,group=pets,persist=0,hide=1')
animatedcollapse.addDiv('cat1', 'fade=0,speed=400,group=pets')
animatedcollapse.addDiv('dog', 'fade=0,speed=400,group=pets,persist=1,hide=1')
animatedcollapse.addDiv('dog1', 'fade=0,speed=400,group=pets,persist=1,hide=1')
animatedcollapse.addDiv('rabbit', 'fade=0,speed=400,group=pets,hide=1')

animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
    //$: Access to jQuery
    //divobj: DOM reference to DIV being expanded/ collapsed. Use "divobj.id" to get its ID
    //state: "block" or "none", depending on state
}

animatedcollapse.init()
function toggleDiv(divId) {
   $("#"+divId).toggle();
}
</script>
  <?php
  
    $data = array(
        'facebook'      => $this->fb_connect->fb,
        'fbSession'     => $this->fb_connect->fbSession,
        'user'          => $this->fb_connect->user,
        'uid'           => $this->fb_connect->user_id,
        'fbLogoutURL'   => $this->fb_connect->fbLogoutURL,
        'fbLoginURL'    => $this->fb_connect->fbLoginURL,   
        'base_url'      => site_url('home/facebook'),
        'appkey'        => $this->fb_connect->appkey,
    );
    
?>      
     
<div>
<?php if($_SERVER['REQUEST_URI']!="/index.php/how_it_works") { ?>
<div id="header">
<header>
<div class="container">
<div id="logo-placing"><a href="<?php echo base_url(); ?>index.php"><img src="<?php echo base_url().getThemeName()?>/images/logo_new.png"></a></div>
 <?php if(get_authenticateUserID()=='') { ?>
<div class="login-sigup">
<div class="signup-ph btn btn-default"><a href="<?php echo base_url(); ?>index.php/sign_up">SIGNUP</a></div>
<div class="login-ph btn btn-default"><a href="<?php echo base_url(); ?>index.php/login">LOGIN</a></div>
<!--<div id="flag-ph"><img src="<?php echo base_url().getThemeName()?>/images/flag.jpg"></div>-->
</div>
<?php } else {?>
<div class="login-sigup login-sigup-db">
    <div id="flag-ph"><!--<img src="<?php echo base_url().getThemeName()?>/images/flag.jpg">-->
        <span class="wallet_balance">Wallet Balance R.<?php echo getwallet_amount() ?></span>
    </div>
</div>
<div id="flag-ph" style="padding:5px 0 0 0">
<?php 
        
            
        
     if(get_authenticateUserID()!='') { 
     
     
     
//$check_suspend=check_user_suspend();

//if($check_suspend!=0) {  redirect('suspend'); }

 ?> 
        
             
      <script type="application/javascript">

function update_city(city_id)
{
        
        
        if(city_id=='' || city_id==0)
        {   
            return false;
        }
            
        var strURL='<?php echo base_url().'user/update_city/';?>'+city_id;
            
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
                    //document.getElementById("favorite").innerHTML=xmlhttp.responseText;
                    window.parent.document.location.reload();
                }       
            }
          }
        xmlhttp.open("GET",strURL,true);
        xmlhttp.send();

}

</script>     

<?php

$city_name='Pick a City';

$current_city_id=getCurrentCity();
if($current_city_id>0)
{
$current_city_name=getCityName($current_city_id);

if(isset($current_city_name)) {  $city_name=$current_city_name; }
}

?>

           
        
        <?php //echo anchor('pick_city',$city_name.'&nbsp;<img src="'.base_url().getThemeName().'/images/city_arrow.png" alt="" />',' id="selmycity" class="pickcity" style="color:white"');?>
      
       
       
      <?php } ?> 
</div>
<div class="top_login">
<a href="javascript:toggleDiv('jason');"  class="settings" rel="toggle[jason]" data-openimage="<?php echo base_url().getThemeName(); ?>/images/user_img.png" data-closedimage="<?php echo base_url().getThemeName(); ?>/images/user_img.png">
<img src="<?php echo base_url().getThemeName(); ?>/images/user_img.png" border="0">
</a>
<div id="jason" class="collapsable-panel1 hidden">
<div class="settingstoparrow"></div>
<ul class="dropdown" >
<li class="login-user-name"><?php echo $this->session->userdata('full_name'); ?></li>
                     <li class="dropdown-dashboard"><?php echo anchor('dashboard','Dashboard');?></li>
                    <li class="dropdown-profile"><?php echo anchor('user/'.getUserProfileName(),'My Profile');?></li>
                    <li class="dropdown-account"><?php echo anchor('account','My Account'); ?></li>
                    <li class="dropdown-posttask"><?php echo anchor('user_task/mytasks','My Posted Tasks');?></li>
                     
                       <?php 
                    
                    $check_is_worker=check_is_worker(get_authenticateUserID());
                    
                    if($check_is_worker) { ?>
                     <li class="dropdown-posttask"><?php echo anchor('worker_task/my','My Running Tasks');?></li>
                    <?php } ?>
                    <li class="dropdown-alerts"><?php echo anchor('message/allmessage','My Alerts');?></li>
                      
                   
                    <li class="dropdown-history"><?php //echo anchor('stored_card','My Credit Card');?></li>
                     <li class="dropdown-history"><?php echo anchor('wallet','Transaction History');?></li>
                     
                     
                 
                  
                     <li class="dropdown-notification"><?php echo anchor('notifications','Notifications');?></li>
                  <li class="dropdown-posttask"><?php echo anchor('user_other/favorites','Favourite Tasker');?></li>
                    <li class="terminal dropdown-logout"><?php 
                        if($this->session->userdata('facebook_id') != 0 && $this->session->userdata('facebook_id') != '' )
                        {
                            echo anchor($data['fbLogoutURL'],'Logout');
                        } else {
                            echo anchor('home/logout','Logout'); 
                        }
                    ?></li>
                        
</ul>
</div>
</div>

<?php } ?>
<div class="rmm login-sigup-2">
                            <ul>
                                <!--<li><a href='<?php echo base_url(); ?>index.php' class="active">Home</a></li>-->
                                <li>
                                <?php 
                                $site_setting=site_setting();

                                if($site_setting->subscription_need==0) 
                                {
                                    if(!check_user_authentication()) { ?>
                                    <a href="<?php echo base_url(); ?>index.php/login">Post a task</a>
                                    <?php } else { ?>
                                    <a href="<?php echo base_url(); ?>index.php/task/newhome_task">Post a task</a>
                                <?php } 
                                }
                                elseif($site_setting->subscription_need==1) { 
                                
                                    if(!check_user_authentication()) { ?>
                                    <a href="<?php echo base_url(); ?>index.php/login">Post a task</a>
                                    <?php } else { 
                                        $user_setting=user_profilestatus(get_authenticateUserID());
                                        if($user_setting->profile_active==1)
                                        {
                                    ?>
                                            <a href="<?php echo base_url(); ?>index.php/task/newhome_task">Post a task</a>
                                
                                <?php   } else {

                                ?>
                                            <a href="<?php echo base_url(); ?>dashboard#horizontalTab3" onclick="return confirm('Sorry !!! In order to post task you must subscribe for membership ')">Post a task</a>
                                
                                
                                <?php

                                    }

                                    }
                                }
                                ?>
                                </li>
                                <li><a href="<?php echo base_url(); ?>index.php/tags">Find a task</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/how_it_works">How it works</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/who-are-the-taskers">Become a tasker</a></li>
                            <script type="text/javascript">
                                window.fbAsyncInit = function() {
                                    FB.init({appId: '1682994578600469', status: true, cookie: true, xfbml: true});
                         
                                    /* All the events registered */
                                    FB.Event.subscribe('auth.login', function(response) {
                                        // do something with response
                                     //   login();
                                    });
                        
                                    FB.Event.subscribe('auth.logout', function(response) {
                                    // do something with response
                                       // logout();
                                    });
                                };
                                (function() {
                                    var e = document.createElement('script');
                                    e.type = 'text/javascript';
                                    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
                                    e.async = true;
                                   // document.getElementById('fb-root').appendChild(e);
                                }());
                                function login(){
                                    //document.location.href = "";
                                }
                                function logout(){
                                    //document.location.href = "";
                                }
                            </script>          
                     </ul>
                        </div>
</div>
</header>
</div>
<?php } ?>
<!--do not remove this div its use for menu close-->
<div class="wrap"></div>
<!--do not remove this div its use for menu close-->



    
        <!--<?php if(get_authenticateUserID()=='') { ?>
                <a href="<?php echo base_url(); ?>" class="logo_cont">Bumblebeeme</a>
        <?php } else {?>
                <a href="<?php echo base_url(); ?>" class="logo_cont">Bumblebeeme</a>
        <?php } ?>-->
       
        
        
        <!--<div id="menubar">
                <div class="container">
                </div>
            </div>-->
</div>
    
     
    <div class="clear"></div>
 <?php   
/*    
$langs=get_supported_lang();

 get_current_language();

$lang_switch_uri= get_switch_uri();

if($langs)
{
    foreach($langs as $lang_prefix => $lang_name)
    {
        ?>
        <a href="<?php echo $lang_switch_uri.$lang_prefix; ?>"><?php echo strtoupper($lang_name); ?></a>
        <?php
    }
    
}



 echo $this->lang->line('user.first_name'); */?>
