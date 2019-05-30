<div class="clear"></div>
<div style="height:66px;"></div>

<div class="footer">

<div class="footer_full">

	<div class="footer_wrapper">

    	<div class="ftr_links">

        	<ul>

            	<li><a href="<?php echo base_url(); ?>content/about_us">About Us</a></li>

                <li><a href="<?php echo base_url(); ?>content/terms">Terms</a></li>

                <li><a href="<?php echo base_url(); ?>content/privacy">Privacy</a></li>
				<?php if(get_authenticateUserID()=='') { ?>
                <li><a href="<?php echo base_url(); ?>sign_up">Join Us</a></li>
				<?php } ?>
                <li><a href="<?php echo base_url(); ?>how_it_works">How it Works</a></li>

                <li><a href="<?php echo base_url(); ?>content/trustsafety">Safety Policy</a></li>

                <li><a href="<?php echo base_url(); ?>content/help">Help</a></li>

            </ul>

        </div><!--ftr_links ends-->

        

        <div class="ftr_social_link">
		
        	<ul>
				<?php
					
				$t_setting = twitter_setting();	
            
               $f_setting = facebook_setting();	
			   
			    $fb_link='javascript:void(0)';
			    if($f_setting->facebook_url!='') { $fb_link = $f_setting->facebook_url; } 
				
				  $tw_link='javascript:void(0)';
				  if($t_setting->twitter_url!='') { $tw_link = $t_setting->twitter_url; } 
				
			   
			   ?>

            	<li><a href="<?php echo $tw_link; ?>"><img src="<?php echo base_url().getThemeName();?>/images/twitter_circle.png" height="32" width="32" border="0" alt="twitter.com" /></a></li>

                <li><a href="#"><img src="<?php echo base_url().getThemeName();?>/images/google_circle.png" height="32" width="32" border="0" alt="google plus" /></a></li>

                <li><a href="<?php echo $fb_link; ?>"><img src="<?php echo base_url().getThemeName();?>/images/fb_circle.png" height="32" width="32" border="0" alt="fb.com" /></a></li>

            </ul>

        </div><!--ftr_social_link ends here-->

       

    </div><!--footer wrapper ends here-->

    <div class="clear"></div>

    <div class="footer_wrapper"> <p class="copyright_txt">&copy; Bumblebeeme <?php echo date('Y') ?></p></div>

    </div><!--footer_full ends-->

    <div class="clear"></div>

</div><!--footer ends-->



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