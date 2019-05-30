



<script type="text/javascript">
$(document).ready(function() {	
	$("#various2").fancybox();
	
	$("#selmycity").fancybox();


	
});
</script>
<script type="text/javascript">
function conf() {
    //alert("Bye bye!");
   // var answer = confirm("Du har redan ansökt om att bli en Entoworker!");
    if (confirm("Du har redan ansökt om att bli en Entoworker!")){
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
            <p>Entowork erbjuder en marknadsplats där du kan frilansa med dina kompetenser och din arbetskraft. Vi försöker ständigt att hitta på nya sätt för dig att tjäna några extra slantar i månaden. Genom att bli medlem så kommer du i kontakt med ett brett nätverk av andra människor i samma syfte: Att utbyta mikrotjänster med varandra.  </p>
            <div class="safety-buttons">
                <ul>
                    <?php if(get_authenticateUserID()=='') { ?>
                    <li><a href="<?php echo base_url(); ?>index.php/login">Bli en Entoworker</a></li>
                    <?php }  else { ?>
                    <li>
                        <?php $check_is_worker=check_is_worker(get_authenticateUserID()); 
                        if($check_is_worker==2) {?>
                        <a  href="worker/apply">Bli en Entoworker</a>
                        <?php } elseif($check_is_worker->worker_status==1 || $check_is_worker->worker_status==0) {?>

                        <a href="#" onclick="return conf()">Bli en Entoworker</a>
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

<!--Bli en Entoworker-->

<!--<div class="red-subtitle">Bli en Entoworker och börja tjäna pengar!</div>
<div class="become-tasker">
<div class="container">
	<div style="visibility: visible;animation-delay: 0.4s; animation-name: fadeIn;" data-wow-delay="0.4s" class="span3 wow fadeIn animated">
        <p class="only-text">Entowork is a new service connecting trusted local neighbours,workers and friends to families and businesses that need some extra help.
        
        Entowork gives an opportunity to those of you who are in between jobs,studying, retrenched or who have some spare time on hand to earn some extra money in a dignified and secure way through our easy to use online marketplace.
        
        We help you as the Tasker to boost your business by connecting you to new opportunities and enquiries everyday.
        </p>
	</div>
</div>
</div>-->
<!--How it works ends-->
<!--two columnar section-->
<div id="two-columnar-section" style="padding-top:0px; padding-bottom:0px;">
<div class="profile_back">
<div class="red-subtitle top-red-subtitle">Entoworkers</div>
<div class="container" style="margin-top:15px; padding-bottom:15px;">
<div class="white-layout">

    <div class="container white-inner">
        <ul class="three-columnar">
        <li class="left">
        	<div style="visibility: visible;animation-delay: 0.6s; animation-name: fadeIn;" data-wow-delay="0.6s" class="span3 wow fadeIn animated ">
                <img src="<?php echo base_url().getThemeName(); ?>/images/find-client.png" border="0" style="margin:15px 0 25px 0">
                <h2 style="margin:0; float:left; width:100%; text-align:center; font-size:24px" class="how-business">Hitta uppdrag</h2>
                <div class="blogger-comment">Låt våra matchningsalgoritmer jobba åt dig. Hittar vi ett jobb som passar dig så kontaktar vi er. Självklart kan ni aktivt söka bland lediga uppdrag också!</div>
			</div>
        </li>
        <li class="center">
        	<div style="visibility: visible;animation-delay: 0.8s; animation-name: fadeIn;" data-wow-delay="0.8s" class="span3 wow fadeIn animated ">
                <img src="<?php echo base_url().getThemeName(); ?>/images/payment.png" border="0" style="margin:15px 0 25px 0">
                <h2 style="margin:0; float:left; width:100%; text-align:center; font-size:24px" class="how-business">Lägg bud på intressanta uppdrag</h2>
                <div class="blogger-comment">När ett uppdrag dyker upp som passar dig så kan du välja att skicka iväg ett erbjudande om att anta jobbet. Skulle du sedan bli tilldelad uppdraget så startas en konversation mellan dig och uppdragsgivaren.</div>
            </div>
        </li>
        <li class="right">
        	<div style="visibility: visible;animation-delay: 0.9s; animation-name: fadeIn;" data-wow-delay="0.9s" class="span3 wow fadeIn animated ">
                <img src="<?php echo base_url().getThemeName(); ?>/images/support.png" border="0" style="margin:15px 0 27px 0">
                <h2 style="margin:0; float:left; width:100%; text-align:center; font-size:24px" class="how-business">Slutför jobbet</h2>
                <div class="blogger-comment">När du har utfört jobbet och båda godkänt att uppdraget har utförts så skickas pengarna över från vårt konto till din digitala plånbok på Entowork.</div>
            </div>
        </li>
        </ul>
    </div>
</div>
<div class="white-layout">
<div class="red-subtitle top-red-subtitle">Hur du kommer igång!</div>
<div class="container white-inner" style="padding-bottom:70px">
<ul class="three-columnar three-columnar-new">
                                            <div class="span3 wow fadeIn animated animated" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeIn;">
                                                <li class="left">
                                                    <div class="process-step">
                                                        <div class="round-number">01</div>
                                                        <!--<img src="<?php echo base_url().getThemeName(); ?>/images/s11.png" border="0" style="margin:15px 0 20px 0">-->
                                                        <h2 style="margin:0; float:left; width:100%; text-align:center; font-size:24px" class="how-business">Skicka in en ansökan</h2>
                                                        <div class="blogger-comment">Fyll i formuläret och låt oss bearbeta din ansökan. </div>
                                                    </div>
                                                </li>	
                                            </div>
                                            <div class="span3 wow fadeIn animated arrow arrow-2 animated" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;"></div>
                                            <div class="span3 wow fadeIn animated animated" data-wow-delay="0.7s" style="visibility: visible; animation-delay: 0.7s; animation-name: fadeIn;">	
                                                <li class="center">
                                                	<div class="process-step">
                                                        <div class="round-number">02</div>
                                                        <!--<img src="<?php echo base_url().getThemeName(); ?>/images/s12.png" border="0" style="margin:15px 0 20px 0">-->
                                                        <h2 style="margin:0; float:left; width:100%; text-align:center; font-size:24px" class="how-business">Bli Verifierad</h2>
                                                        <div class="blogger-comment">När vi har gått igenom din ansökan och sett att allting stämmer så kommer vi att verifiera ditt konto. Detta kan ta ett par timmar upp till några dagar. </div>
                                                    </div>
                                                </li>
                                            </div>
                                            <div class="span3 wow fadeIn animated arrow arrow-2 animated" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeIn;"></div>
                                            <div class="span3 wow fadeIn animated animated" data-wow-delay="1s" style="visibility: visible; animation-delay: 1s; animation-name: fadeIn;">
                                                <li class="right">
                                                	<div class="process-step">
                                                        <div class="round-number">03</div>
                                                        <!--<img src="<?php echo base_url().getThemeName(); ?>/images/s13.png" border="0" style="margin:15px 0 20px 0">-->
                                                        <h2 style="margin:0; float:left; width:100%; text-align:center; font-size:24px" class="how-business">Börja Jobba</h2>
                                                        <div class="blogger-comment">När din profil är verifierad så får du ett emblem och kan nu börja lägga bud på olika uppdrag. </div>
                                                    </div>
                                                </li>	
                                            </div>
                                        </ul>
<div style="text-align:center; margin-top:60px;">
<div class="btn btn-default btn-default-join btn-app" >
   
    <?php if(get_authenticateUserID()=='') { ?>
        <a href="<?php echo base_url(); ?>index.php/login">Fyll i formuläret</a>
     <?php }  else { ?>
        <a  <?php $check_is_worker=check_is_worker(get_authenticateUserID());if($check_is_worker=='2'){?>href="worker/apply" <?php } elseif($check_is_worker->worker_status==1 || $check_is_worker->worker_status==0) {?> href="#" onclick="return conf()" <?php } ?>>Fyll i formuläret</a>
    <?php } ?>
</div>
</div>

</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>