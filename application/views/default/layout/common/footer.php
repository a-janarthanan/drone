<div class="clear"></div>
<div class="footer-main">
	<div class="footer-main-top">
    	<div class="container">
        	<div style="visibility: visible; animation-delay: 0.2s; animation-name: fadeIn;" data-wow-delay="0.2s" class="wow fadeIn animated  animated animated">
                <div class="footer-1 footer-lats">
                    <?php
                        $t_setting = twitter_setting();	
                        $f_setting = facebook_setting();	
                        $fb_link='javascript:void(0)';
                        if($f_setting->facebook_url!='') { $fb_link = $f_setting->facebook_url; } 
                        $tw_link='javascript:void(0)';
                        if($t_setting->twitter_url!='') { $tw_link = $t_setting->twitter_url; } 
                    ?>
                    <h1><img src="<?php echo base_url().getThemeName()?>/images/footer_logo.png"></h1>
                    <div class="social-navigation">
                        <ul>
                            <li>
                                <a target="_blank" href="#"><img src="<?php echo base_url().getThemeName()?>/images/social_1.png"></a>
                            </li>
                            <li>
                                <a target="_blank" href="#"><img src="<?php echo base_url().getThemeName()?>/images/social_2.png"></a>
                            </li>
                            <li>
                                <a target="_blank" href="#"><img src="<?php echo base_url().getThemeName()?>/images/social_3.png"></a>
                            </li>
                            <li>
                                <a target="_blank" href="#"><img src="<?php echo base_url().getThemeName()?>/images/social_4.png"></a>
                            </li>
                            <li>
                                <a target="_blank" href="#"><img src="<?php echo base_url().getThemeName()?>/images/social_5.png"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div style="visibility: visible; animation-delay: 0.4s; animation-name: fadeIn;" data-wow-delay="0.4s" class="wow fadeIn animated  animated animated">
                <div class="footer-1">
                    <h1>General Links</h1>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>index.php/content/about_us">About Company Name</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/how_it_works">Post a Job</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/who-are-the-taskers">Find Jobs</a></li>
                    </ul>
                </div>
            </div>
            <div style="visibility: visible; animation-delay: 0.6s; animation-name: fadeIn;" data-wow-delay="0.6s" class="wow fadeIn animated  animated animated">
                <div class="footer-1">
                    <h1>Company</h1>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>index.php/content/marketplace_rules">Rules</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/content/terms_of_use">Terms & Conditions</a></li>
                        <!--<li><a href="<?php echo base_url(); ?>blog/">Blog</a></li>-->
                        <li><a href="<?php echo base_url(); ?>index.php/contact_us">Contact Us</a></li>
                        
                    </ul>
                </div>
            </div>
            <div style="visibility: visible; animation-delay: 0.8s; animation-name: fadeIn;" data-wow-delay="0.8s" class="wow fadeIn animated  animated animated">
                <div class="footer-1">
                    <h1>Quick Links</h1>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>index.php/content/trustsafety">Trust &amp; Safety</a></li>
                        <!--<li><a href="<?php echo base_url(); ?>index.php/how_it_works">How does Sitename work</a></li>-->
                        <li><a href="<?php echo base_url(); ?>index.php/content/help">Help - FAQ</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/content/privacy">Privacy Policy</a></li>
                        <!--<li><a href="<?php echo base_url(); ?>index.php/business">Camellar for Business</a></li>-->
                        <!--<li><a href="<?php echo base_url(); ?>index.php/content/payments">Payments</a></li>-->
                    </ul>
                </div>
            </div>
            <!--<div style="visibility: visible; animation-delay: 1s; animation-name: fadeIn;" data-wow-delay="1s" class="wow fadeIn animated  animated animated">
                <div class="footer-1">
                    <h1>Questions? Need help?</h1>
                    <ul>
                        <li><a href="#">Help center</a></li>
                        <li><a href="#">Contact Thumbtack</a></li>
                    </ul>
                </div>
            </div>-->
        </div>
    	<div class="clear"></div>
    </div>
    <!--<div class="footer-copyright">
        <div class="container">
            © 2016 sitename <br />
            <a href="#">Privacy policy</a> | <a href="#">Terms of use</a>
        </div>
    </div>-->
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