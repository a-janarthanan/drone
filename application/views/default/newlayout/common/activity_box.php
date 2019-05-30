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
		alert("Ange Epost-adress");
		//alert("Ange epost-adress för att bli medlem.");
		return false;
	}
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var address = document.quicksignupForm.email.value;
    if(reg.test(address) == false) 
	{
      alert('Felaktig email-adress');
      return false;
    }
	
	var zip_code=document.quicksignupForm.zip_code.value;
	if(zip_code.search(/\S/)==-1)
	{
		alert('Vänligen ange postkod');
		//alert('Detta hjälper dig att hitta jobb i rätt område.');
		return false;
	}
	var filter = /^[a-zA-Z0-9]+$/;
	if(filter.test(zip_code) == false)
	{
		alert('Skriv postkoden utan mellanslag!');
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
        <div id="home-slider" class="flexslider">
            <ul class="slides styled-list">
                <li class="home-slide" ><a href="#"><img src="<?php echo base_url().getThemeName();?>/images/entowork_banner.jpg" alt="" /></a></li>
                <li class="home-slide" ><a href="#"><img src="<?php echo base_url().getThemeName();?>/images/entowork_banner1.jpg" alt="" /></a></li>
                <li class="home-slide" ><a href="#"><img src="<?php echo base_url().getThemeName();?>/images/entowork_banner2.jpg" alt="" /></a></li>
            </ul>
        </div>
        <div class="container">
            <div class="banner_detail">
                <h1>Lansering  14/1-16 </h1>
                <p>Vi lanserar en helt ny marknadsplats för innovation och mikrojobb - Vi börjar med Lund!</p>
                <div class="banner-button">
                	<?php if(get_authenticateUserID()=='') { ?>
                	<a href="<?php echo base_url(); ?>index.php/sign_up">Bli medlem nu</a>
                	<?php } else { ?>
                	<a href="<?php echo base_url(); ?>dashboard">Visa Aktivitetsprofil</a>
                	<?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--banner ends-->
			
<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/validation.js"></script>
        
<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/jquery.flexslider-min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/isotope.js"></script>
    <script type="text/javascript">
		jQuery('#home-slider.flexslider').flexslider({						
			  animation: "swing",
			  direction: "vertical", 
			  slideshow: true,
			  slideshowSpeed: 3500,
			  animationDuration: 1000,
			  directionNav: false,
			  controlNav: true,
			  smootheHeight:true,
			  after: function(slider) {
				slider.removeClass('loading');
			  }
				  
		});
    </script>			
