<div class="clear"></div>
<div class="footer-main">
	<div class="footer-main-top">
    	<div class="container">
        	<div style="visibility: visible; animation-delay: 0.4s; animation-name: fadeIn;" data-wow-delay="0.4s" class="wow fadeIn animated  animated animated">
                <div class="footer-1">
                    <h1>Allmänt</h1>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>index.php/content/about_us">Om Entowork</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/how_it_works">Hur det fungerar</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/who-are-the-taskers">Bli en Entoworker</a></li>
                    </ul>
                </div>
            </div>
            <div style="visibility: visible; animation-delay: 0.6s; animation-name: fadeIn;" data-wow-delay="0.6s" class="wow fadeIn animated  animated animated">
                <div class="footer-1">
                    <h1>Regler</h1>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>index.php/content/marketplace_rules">Regler för marknadsplats</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/content/terms_of_use">Användarvilkor</a></li>
                        <!--<li><a href="<?php echo base_url(); ?>blog/">Blog</a></li>-->
                        <li><a href="<?php echo base_url(); ?>index.php/contact_us">Kontakta oss</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/content/privacy">Sekretesspolicy</a></li>
                    </ul>
                </div>
            </div>
            <div style="visibility: visible; animation-delay: 0.8s; animation-name: fadeIn;" data-wow-delay="0.8s" class="wow fadeIn animated  animated animated">
                <div class="footer-1">
                    <h1>Information</h1>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>index.php/content/trustsafety">Säkerhet</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/how_it_works">Hur används Entowork?</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/content/help">FAQ</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/business">Entowork för företag</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/content/payments">Betalningar</a></li>
                    </ul>
                </div>
            </div>
            <div style="visibility: visible; animation-delay: 1s; animation-name: fadeIn;" data-wow-delay="1s" class="wow fadeIn animated  animated animated">
                <div class="footer-1 footer-lats">
                    <?php
                        $t_setting = twitter_setting();	
                        $f_setting = facebook_setting();	
                        $fb_link='javascript:void(0)';
                        if($f_setting->facebook_url!='') { $fb_link = $f_setting->facebook_url; } 
                        $tw_link='javascript:void(0)';
                        if($t_setting->twitter_url!='') { $tw_link = $t_setting->twitter_url; } 
                    ?>
                    <h1>Sociala Medier</h1>
                    <div id="social-nav">
                        <ul>
                            <li class="facebook-color">
                                <a class="social-media" target="_blank" href="http://www.facebook.com/entowork "></a>
                            </li>
                            <!--<li class="twitter-color">
                                <a class="social-media" target="_blank" href="http://www.instagram.com/entowork"></a>
                            </li>-->
                            <li class="instra-color">
                                <a class="social-media" target="_blank" href="http://www.instagram.com/entowork"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    	<div class="clear"></div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            Entowork AB 559029-6850, All rights reserved©
        </div>
    </div>
</div>


<!--footer-->
		
    <script src="<?php echo base_url().getThemeName(); ?>/js/wow.js"></script>
	<script type="text/javascript">
		new WOW().init();
    </script>                    
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
	


<?php /*?><canvas id='s'>This application requires a (fast) HTML5 compliant browser.</canvas>
<script type="text/javascript" src="<?php echo base_url().getThemeName();?>/js/animation_grass.js"></script>
<?php */?>


<?php

$site_setting=site_setting();
if($site_setting->site_tracker!='') { 

?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo trim($site_setting->site_tracker); ?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<?php } ?>