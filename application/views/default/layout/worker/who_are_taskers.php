<script type="text/javascript">
$(document).ready(function() {	
	$("#various2").fancybox();
	
	$("#selmycity").fancybox();
});
</script>
<script type="text/javascript">
function conf() {
    //alert("Bye bye!");
   // var answer = confirm("You already submitted your Tasker application");
    if (confirm("You already submitted your Tasker application")){
        //alert("Bye bye!")
        window.location ='<?php echo base_url();?>dashboard';
    }
    
}
</script>
<!--banner-->
<!--<div id="acc-banners-ph" class="banner-contain">
    <div class="banner-area-for-work">
        <a href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/takser_banner.jpg" alt="" /></a>
    </div>
</div>-->
<div class="banner-contain" id="acc-banners-ph">
    <div class="container">
        <div class="banner-hw safety safety-2 safety-3">
            <p>Camellar gives an opportunity to those of you who are in between jobs,studying, retrenched or who have some spare time on hand to earn some extra money in a dignified and secure way through our easy to use online marketplace. We help you as the Tasker to boost your business by connecting you to new opportunities and enquiries everyday. </p>
            <div class="safety-buttons">
                <ul>
                    <?php if(get_authenticateUserID()=='') { ?>
                    <li><a href="<?php echo base_url(); ?>index.php/login">Start Application</a></li>
                    <?php }  else { ?>
                    <li>
                        <?php $check_is_worker=check_is_worker(get_authenticateUserID()); 
                        if($check_is_worker==2) {?>
                        <a  href="worker/apply">Start Application</a>
                        <?php } elseif($check_is_worker->worker_status==1 || $check_is_worker->worker_status==0) {?>

                        <a href="#" onclick="return conf()">Start Application</a>
                        <?php } ?>

                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="banner-area-for-work">
        <a href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/takser_banner.jpg" alt="" /></a>
    </div>
</div>
<!--banner ends-->

<!--become a tasker-->

<!--<div class="red-subtitle">Become a Tasker on Camellar and Earn some Moola!</div>
<div class="become-tasker">
<div class="container">
	<div style="visibility: visible;animation-delay: 0.4s; animation-name: fadeIn;" data-wow-delay="0.4s" class="span3 wow fadeIn animated">
        <p class="only-text">Camellar is a new service connecting trusted local neighbours,workers and friends to families and businesses that need some extra help.
        
        Camellar gives an opportunity to those of you who are in between jobs,studying, retrenched or who have some spare time on hand to earn some extra money in a dignified and secure way through our easy to use online marketplace.
        
        We help you as the Tasker to boost your business by connecting you to new opportunities and enquiries everyday.
        </p>
	</div>
</div>
</div>-->
<!--How it works ends-->
<!--two columnar section-->
<div id="two-columnar-section" style="padding-top:0px; padding-bottom:0px;">
    <div class="profile_back who-are-back">
        <div class="red-subtitle top-red-subtitle entowork-title">How Camellar can help build your business</div>
        <div class="container" style="margin-top:15px; padding-bottom:15px;">
            <div class="">
                <div class="container how-hwlp-inner-wrt">
                    <ul class="three-columnar">
                        <li class="left">
                            <div style="visibility: visible;animation-delay: 0.6s; animation-name: fadeIn;" data-wow-delay="0.6s" class="span3 wow fadeIn animated ">
                                <img src="<?php echo base_url().getThemeName(); ?>/images/find-client.png" border="0" style="margin:15px 0 25px 0">
                                <h2 style="margin:0; float:left; width:100%; text-align:center; font-size:30px" class="how-business">Finding Enquiries</h2>
                                <div class="clear"></div>
                                <div class="blogger-comment blogger-comment-wrtasker">We drive business in your direction. You set the prices and agree the terms and only take on those tasks you are comfortable with completing.</div>
                            </div>
                        </li>
                        <li class="center">
                            <div style="visibility: visible;animation-delay: 0.8s; animation-name: fadeIn;" data-wow-delay="0.8s" class="span3 wow fadeIn animated ">
                                <img src="<?php echo base_url().getThemeName(); ?>/images/payment.png" border="0" style="margin:15px 0 25px 0">
                                <h2 style="margin:0; float:left; width:100%; text-align:center; font-size:30px" class="how-business">No Payment Headaches</h2>
                                <div class="clear"></div>
                                <div class="blogger-comment blogger-comment-wrtasker">You do not need to pay anything here , all payment transaction will be handle at your end  directly from client . All you need to do is what you do best !</div>
                            </div>
                        </li>
                        <li class="right">
                            <div style="visibility: visible;animation-delay: 0.9s; animation-name: fadeIn;" data-wow-delay="0.9s" class="span3 wow fadeIn animated ">
                                <img src="<?php echo base_url().getThemeName(); ?>/images/support.png" border="0" style="margin:15px 0 27px 0">
                                <h2 style="margin:0; float:left; width:100%; text-align:center; font-size:30px" class="how-business">Support Network</h2>
                                <div class="clear"></div>
                                <div class="blogger-comment blogger-comment-wrtasker">Our staff are here to help you with any queries. If ever in doubt you can contact us directly for advice. We can also put you in touch with additional Taskers if you need it for those bigger Tasks!</div>
                            </div>
                        </li>
                    	<div class="clear"></div>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="how-started-block-wrt entowork-title-2-inner">
            <div class="red-subtitle top-gray-subtitle entowork-title entowork-title-2">How to get started</div>
            <div class="container how-hwlp-inner-wrt">
                <ul class="three-columnar three-columnar-new">
                    <div class="span3 wow fadeIn animated animated" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeIn;">
                        <li class="left">
                            <div class="process-step">
                                <div class="round-number round-number-orange">1</div>
                                <!--<img src="<?php echo base_url().getThemeName(); ?>/images/s11.png" border="0" style="margin:15px 0 20px 0">-->
                                <h2 style="margin:0; float:left; width:100%; text-align:center; font-size:24px" class="how-business">APPLY ONLINE</h2>
                                <div class="blogger-comment">Fill in this application form.</div>
                            </div>
                        </li>	
                    </div>
                    <div class="span3 wow fadeIn animated arrow arrow-2 animated" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;"></div>
                    <div class="span3 wow fadeIn animated animated" data-wow-delay="0.7s" style="visibility: visible; animation-delay: 0.7s; animation-name: fadeIn;">	
                        <li class="center">
                            <div class="process-step">
                                <div class="round-number round-number-green">2</div>
                                <!--<img src="<?php echo base_url().getThemeName(); ?>/images/s12.png" border="0" style="margin:15px 0 20px 0">-->
                                <h2 style="margin:0; float:left; width:100%; text-align:center; font-size:24px" class="how-business">GET VERIFIED</h2>
                                <div class="blogger-comment">We're big on trust and safety, so we require identity verification and appropriate documentation before we can approve your Tasker application.</div>
                            </div>
                        </li>
                    </div>
                    <div class="span3 wow fadeIn animated arrow arrow-2 animated" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeIn;"></div>
                    <div class="span3 wow fadeIn animated animated" data-wow-delay="1s" style="visibility: visible; animation-delay: 1s; animation-name: fadeIn;">
                        <li class="right">
                            <div class="process-step">
                                <div class="round-number round-number-blue">3</div>
                                <!--<img src="<?php echo base_url().getThemeName(); ?>/images/s13.png" border="0" style="margin:15px 0 20px 0">-->
                                <h2 style="margin:0; float:left; width:100%; text-align:center; font-size:24px" class="how-business">START TASKING</h2>
                                <div class="blogger-comment">Specify your skills and interests and connect with local people who want to work with you. Once approved you can start working!</div>
                            </div>
                        </li>	
                    </div>
                </ul>
                <div style="text-align:center; margin-top:60px;">
                    <div class="btn btn-default btn-default-join btn-app" >
                       
                        <?php if(get_authenticateUserID()=='') { ?>
                            <a href="<?php echo base_url(); ?>index.php/login">START APPLICATION</a>
                         <?php }  else { ?>
                            <a  <?php $check_is_worker=check_is_worker(get_authenticateUserID());if($check_is_worker=='2'){?>href="worker/apply" <?php } elseif($check_is_worker->worker_status==1 || $check_is_worker->worker_status==0) {?> href="#" onclick="return conf()" <?php } ?>>START APPLICATION</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
	<div class="clear"></div>
</div>