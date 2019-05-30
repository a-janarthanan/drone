<?php
$site_setting=site_setting();  
$site_timezone=tzOffsetToName($site_setting->site_timezone);
date_default_timezone_set($site_timezone);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
   <title><?php echo $pageTitle; ?></title> 
   <link rel="icon" href="<?php echo base_url().getThemeName()?>/images/fav_icon.png"> 
    <meta name="description" content="<?php echo $metaDescription; ?>" />
	<meta name="keywords" content="<?php echo $metaKeyword; ?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,300' rel='stylesheet' type='text/css'>
    
   <script type="application/javascript">
		var baseUrl='<?php echo base_url(); ?>';
		var baseThemeUrl='<?php echo base_url().getThemeName(); ?>';
	</script>
    <style>
    	span.footer-i{ float:none !important; display:inline-block !important;}
    </style>

	<?php   
	if($_SERVER['REQUEST_URI']=="/index.php/dashboard" || $_SERVER['REQUEST_URI']=="/dashboard") { ?>
    <!--<link href="<?php echo base_url().getThemeName(); ?>/css/styles_new_v119.css" rel="stylesheet" type="text/css">-->
    <link href="<?php echo base_url().getThemeName(); ?>/css/styles_new_dashboard.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url().getThemeName(); ?>/css/styles_new_30.css" rel="stylesheet" type="text/css">
	<?php } 
	elseif($_SERVER['REQUEST_URI']=="/index.php/how_it_works" ||$_SERVER['REQUEST_URI']=="/how_it_works")
	{
	?>
	
    <link href="<?php echo base_url().getThemeName(); ?>/css/styles_new_30.css" rel="stylesheet" type="text/css">
	<?php
	}
	elseif($_SERVER['REQUEST_URI']=="" || $_SERVER['REQUEST_URI']=="/" ||$_SERVER['REQUEST_URI']=="/index.php" ||$_SERVER['REQUEST_URI']=="/index.php/" || $_SERVER['REQUEST_URI']=="/home" || $_SERVER['REQUEST_URI']=="/index.php/login"||$_SERVER['REQUEST_URI']=="/login" ||$_SERVER['REQUEST_URI']=="/index.php/sign_up" ||$_SERVER['REQUEST_URI']=="/sign_up")
	{
	?>
    <link href="<?php echo base_url().getThemeName(); ?>/css/styles_new_30.css" rel="stylesheet" type="text/css">
	<?php } else { ?>
	<!--<link href="<?php echo base_url().getThemeName(); ?>/css/styles_new_v22.css" rel="stylesheet" type="text/css">-->
    <link href="<?php echo base_url().getThemeName(); ?>/css/styles_new_30.css" rel="stylesheet" type="text/css">
    <?php } ?>
	<link rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/css/responsivemobilemenu.css" type="text/css"/>
	
	<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/lib/jquery-1.7.1.js"></script>
	<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/rmm-js/responsivemobilemenu.js"></script>
    
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
		.z-accordion.transition.vertical > section.no-padding > .z-content > .z-auto-g{
			padding:0;
		}
	   	.z-demo-accordion .z-content ul, .z-demo-accordion .z-content ol {
			margin: 0 0 5px 0px;
		}
		.z-demo-accordion.z-accordion.vertical > section > h3,   
		.z-demo-accordion.z-accordion.horizontal > section > h3 > .z-title{       
			letter-spacing: 0;
			font-family:  sans-serif;
			text-rendering: optimizeLegibility;
			-webkit-font-smoothing: antialiased;
		}
		.z-demo-accordion.z-accordion.horizontal > section > h3 > .z-title{
			text-transform: uppercase;
		}
	</style>
	<link href="<?php echo base_url().getThemeName(); ?>/scrollbar/perfect-scrollbar.css" rel="stylesheet">
	<script src="<?php echo base_url().getThemeName(); ?>/scrollbar/perfect-scrollbar.js"></script>
        <style>
          .contentHolder { position:relative; margin:0px auto; padding:0px; width:100%; height: 420px; overflow: hidden; }
          .contentHolder .content { background-image: url('./azusa.jpg'); width: 100%; height: 420px; }
          .spacer { text-align:center }
        </style>
    <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#Default').perfectScrollbar();
        $('#LongThumb').perfectScrollbar({minScrollbarLength:100});
      });
    </script>
    

 <!--<link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/css/style.css" />-->
 <link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/css/commonnew_v17.css" />

<link href='http://fonts.googleapis.com/css?family=Enriqueta:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Macondo+Swash+Caps' rel='stylesheet' type='text/css'>






<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/lib/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/lib/jquery.ui.widget.js"></script>


<script type="text/javascript">
        jQuery(function() {
            jQuery(".pupload13").click(function(){
				jQuery("#open_post_task").fadeIn();
                jQuery("#fancybox-overlay").fadeIn();
            })
            jQuery("#fancybox-overlay").click(function(){
                jQuery("#open_post_task").fadeOut();
                jQuery("#fancybox-overlay").fadeOut();
            })
            jQuery(".fancybox-close").click(function(){
                jQuery("#open_post_task").fadeOut();
                jQuery("#fancybox-overlay").fadeOut();
            })
            
        })
    </script>
    <script type="text/javascript">
        jQuery(function() {
            jQuery(".pupload14").click(function(){
				jQuery("#open_post_task_placebid").fadeIn();
                jQuery("#fancybox-overlay").fadeIn();
            })
            jQuery("#fancybox-overlay").click(function(){
                jQuery("#open_post_task_placebid").fadeOut();
                jQuery("#fancybox-overlay").fadeOut();
            })
            jQuery(".fancybox-close").click(function(){
                jQuery("#open_post_task_placebid").fadeOut();
                jQuery("#fancybox-overlay").fadeOut();
            })
            
        })
    </script>
    <script type="text/javascript">
        jQuery(function() {
            jQuery(".pupload15").click(function(){
				jQuery("#open_post_task_hire").fadeIn();
                jQuery("#fancybox-overlay").fadeIn();
            })
            jQuery("#fancybox-overlay").click(function(){
                jQuery("#open_post_task_hire").fadeOut();
                jQuery("#fancybox-overlay").fadeOut();
            })
            jQuery(".fancybox-close").click(function(){
                jQuery("#open_post_task_hire").fadeOut();
                jQuery("#fancybox-overlay").fadeOut();
            })
            
        })
    </script>
<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/lib/ui/jquery.ui.tabs.js"></script>
<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/lib/tooltip.js"></script>

<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/jquery.cycle.all.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url().getThemeName(); ?>/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
	jQuery(function() {

		jQuery("html, body").click(function(e) {
			if (jQuery(e.target).hasClass('top_login')) {
				return false;
			}
			$("#jason").css("display","none");
		});
	});
</script>
<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript">
			jQuery(function() {
				
		jQuery("#various2").fancybox();
	jQuery("#various3").fancybox();
	jQuery("#various5").fancybox();
	
	jQuery("#selmycity").fancybox();		
	

	jQuery('.wrap').click(function (){	
		jQuery('.acc_div').hide();
		jQuery('.wrap').hide();		
	});

	jQuery('.acc_link').click(function (){			
		jQuery('.acc_div').slideToggle(100);
		jQuery('.wrap').show();
	});		
	
	 
	
	
	
	
		
					
			});
		</script>

<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/function.js"></script>
<!--[if IE]>
<link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/css/iestyle.css"/>
<![endif]-->

<!--[if IE 7]>
<link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/css/ie7.css"/>
<![endif]-->

   
   <?= $_scripts ?>
   <?= $_styles ?>
<link rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/css/animate.css">
 <!-- HEADER TOP SLIDER START -->
    <link rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/js/flexslider.css" type="text/css">
	
    <!-- HEADER TOP SLIDER END -->
 <!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');

fbq('init', '1636717566544899');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1636717566544899&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
</head>
<body>
 
 <?php 
 if($site_setting->site_online==0) {
$theme_url= base_url().getThemeName().'/404/';
header('Location: '.$theme_url);

} 
 
 $spamer=spam_protection();
      if($spamer==1 || $spamer=='1') { ?>
	<div class="spam_report">

<b>Your IP has been Band due to spam. Please contact web master.</b>

</div>
<?php } ?>

<div id="container">

<?php echo $header; ?>

	<div class="body_cont">
	<?php
		echo $banner;

		echo $content_center;
		echo $content_left;
		echo $content_side;

		echo $activity_box;
		echo $campaign_box;
		echo $press_release;

	//echo $footer_capaign;
	?>
	</div>
</div>



<?php echo $footer; ?>
<div id="fancybox-overlay" style="background-color: rgb(119, 119, 119); opacity: 0.7; cursor: pointer; height: 100%; z-index:999999; display: none; position:fixed;"></div>                   
<div id="open_post_task" style=" background: #fff none repeat scroll 0 0; box-shadow: 3px 3px 15px #585858; padding: 10px; position: absolute; top: 40%; z-index: 999999999; display:none; left:30%;">
      <a id="fancybox-close" class="fancybox-close" style="display: inline;"></a>
      <div class="border-over">
          <p style="padding-bottom:5px; padding-top:15px; color:#ec6600; font-weight:bold; text-align:center;">Sorry !!! In order to post task you must subscribe for membership</p>
          <div class="clear"></div>
          <div style="text-align:center;">
              <div class="btn btn-default find-friends-btn">
                  <a href="<?php echo base_url(); ?>dashboard#horizontalTab3" class="fancybox-close">Yes</a>
              </div>		 
              <div class="btn btn-default find-friends-btn">
                  <a href="javascript:void(0)" class="fancybox-close">No</a> 
              </div>
          </div>
      </div>
</div>
<div id="open_post_task_placebid" style=" background: #fff none repeat scroll 0 0; box-shadow: 3px 3px 15px #585858; padding: 10px; position: absolute; top: 40%; z-index: 999999999; display:none; left:30%;">
      <a id="fancybox-close" class="fancybox-close" style="display: inline;"></a>
      <div class="border-over">
          <p style="padding-bottom:5px; padding-top:15px; color:#ec6600; font-weight:bold; text-align:center;">In order to place bid you must have bid credits in your account</p>
          <div class="clear"></div>
          <div style="text-align:center;">
              <div class="btn btn-default find-friends-btn">
                  <a href="<?php echo base_url(); ?>user_other/Buy_credit" class="fancybox-close">Yes</a>
              </div>		 
              <div class="btn btn-default find-friends-btn">
                  <a href="<?php echo base_url(); ?>dashboard#horizontalTab3" class="fancybox-close">No</a> 
              </div>
          </div>
      </div>
</div>
<div id="open_post_task_hire" style=" background: #fff none repeat scroll 0 0; box-shadow: 3px 3px 15px #585858; padding: 10px; position: absolute; top: 40%; z-index: 999999999; display:none; left:30%;">
      <a id="fancybox-close" class="fancybox-close" style="display: inline;"></a>
      <div class="border-over">
          <p style="padding-bottom:5px; padding-top:15px; color:#ec6600; font-weight:bold; text-align:center;">Sorry !!! In order to hire worker you must subscribe for membership</p>
          <div class="clear"></div>
          <div style="text-align:center;">
              <div class="btn btn-default find-friends-btn">
                  <a href="<?php echo base_url(); ?>dashboard#horizontalTab3" class="fancybox-close">Yes</a>
              </div>		 
              <div class="btn btn-default find-friends-btn">
                  <a href="javascript:void(0)" class="fancybox-close">No</a> 
              </div>
          </div>
      </div>
</div>
   
</body>
</html>