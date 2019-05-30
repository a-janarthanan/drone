<!-- aToolTip css -->
<link type="text/css" href="<?php echo base_url().getThemeName(); ?>/css/atooltip.css" rel="stylesheet"  media="screen" />
<!-- aToolTip js -->
<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/jquery.atooltip.js"></script>

<script>

$(document).ready(function(){

    $('#slideshow').cycle({

        fx:     'fade',

        speed:  'slow',

        timeout: 5000,

    });

});
function validation()
{
	if(document.quicksignupForm.email.value=="")
	{
		alert("Please Enter Your email address");
		//alert("Enter your email address to sign up");
		return false;
	}
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var address = document.quicksignupForm.email.value;
    if(reg.test(address) == false) 
	{
      alert('Invalid Email Address');
      return false;
    }
	
	var zip_code=document.quicksignupForm.zip_code.value;
	if(zip_code.search(/\S/)==-1)
	{
		alert('Please enter your post code');
		//alert('This will help to find jobs in your area');
		return false;
	}
	var filter = /^[a-zA-Z0-9]+$/;
	if(filter.test(zip_code) == false)
	{
		alert('No Blank Space Allow In Post Code');
		return false;
	}
	document.quicksignupForm.submit();
}
</script>

<!--banner-->
<!--<div id="acc-banners-ph">
<div class="banner-area"></div>
</div>-->
<div class="banner">
	<div style="visibility: visible; animation-delay: 0.4s; animation-name: fadeIn;" data-wow-delay="0.4s" class="wow fadeIn animated  animated animated">
        <div class="">
            <div id="home-slider" class="flexslider">
                <ul class="slides styled-list">
                    <?php
                    $bannerfile=$this->home_model->bannerlist();
                    foreach ($bannerfile as $banner) {   
                    ?>
                    <li class="home-slide" >
                        <a href="<?php echo $banner->link; ?>"><img src="<?php echo base_url()?>/upload/banner/<?php echo $banner->image_name; ?>" alt="" /></a>
                        <div class="container">
                            <div class="banner_detail">
                                <h1><?php echo $banner->title; ?></h1>
                                <p><?php echo $banner->description; ?></p>
                                <div class="banner-button">
                                    <?php if(get_authenticateUserID()=='') { ?>
                                    <a href="<?php echo base_url(); ?>index.php/sign_up">Get Started Now</a>
                                    <?php } else { ?>
                                    <a href="<?php echo base_url(); ?>dashboard">Get Started Now</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                    <!--<li class="home-slide" >
                        <a href="#"><img src="<?php echo base_url().getThemeName();?>/images/banner1.jpg" alt="" /></a>
                        <div class="container">
                            <div class="banner_detail">
                                <h1>Get Stuff done</h1>
                                <p>Over 330,000 trusted people ready to complete your task today - Australia Wide</p>
                                <div class="banner-button">
                                    <?php if(get_authenticateUserID()=='') { ?>
                                    <a href="<?php echo base_url(); ?>index.php/sign_up">Get Started Now</a>
                                    <?php } else { ?>
                                    <a href="<?php echo base_url(); ?>dashboard">Get Started Now</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="home-slide" >
                        <a href="#"><img src="<?php echo base_url().getThemeName();?>/images/banner1.jpg" alt="" /></a>
                        <div class="container">
                            <div class="banner_detail">
                                <h1>Get Stuff done</h1>
                                <p>Over 330,000 trusted people ready to complete your task today - Australia Wide</p>
                                <div class="banner-button">
                                    <?php if(get_authenticateUserID()=='') { ?>
                                    <a href="<?php echo base_url(); ?>index.php/sign_up">Get Started Now</a>
                                    <?php } else { ?>
                                    <a href="<?php echo base_url(); ?>dashboard">Get Started Now</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </li>-->
                </ul>
            </div>
        </div>
    </div>
</div>
<!--banner ends-->
			
<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/validation.js"></script>
        
<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/jquery.flexslider.js"></script>
    <script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/isotope.js"></script>
    <script type="text/javascript">
		jQuery('#home-slider.flexslider').flexslider({						
			  slideshow: true,
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
