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
}
</script>
<script type="text/javascript">
	$(function(){ 
		$('#email.normalTip').aToolTip();
		$('#zip_code1.normalTip').aToolTip();
		$('#quicksign_up.normalTip').aToolTip();
	}); 
</script>
<div class="banner">

            <div class="over_write">

            <!--<p>THE BETTER WAY</br>TO FIND A VIRTUAL ASSISTANT</p>-->
		<p>&nbsp;</p>	<p>&nbsp;</p> 
			<form action="<?php echo base_url(); ?>index.php/sign_up" method="post" id="quicksignupForm" name="quicksignupForm" onsubmit="return validation();">
            <div class="email_cont">

            	<input class="normalTip email" name="email" id="email" title="Enter your email address to sign up" placeholder="EMAIL" style="border: 3px solid rgb(255, 205, 6);padding-left: 5px;"  />

            </div>

            <div class="zip_cont">

            <input class="normalTip zipcode" name="zip_code" id="zip_code1" title="This will help to find jobs in your area" placeholder="POST CODE" style="border: 3px solid rgb(255, 205, 6);" />

            </div>

             <input class="normalTip inpt_join" value="JOIN US" title="It&#39;s free to join" type="submit" id="quicksign_up" />
			</form>
            </div><!--over_write ends here-->

           

            	<!--slide images-->

                <div id="slideshow">

                        <div class="slider-item"><a href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/banner9.jpg" width="988" border="0" alt="banner9" /></a></div>

                        <div class="slider-item"><a href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/banner10.jpg" width="988" border="0" alt="banner10" /></a></div>
						<div class="slider-item"><a href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/banner11.jpg" width="988" border="0" alt="banner11" /></a></div>
						<div class="slider-item"><a href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/banner12.jpg" width="988" border="0" alt="banne12" /></a></div>
						<div class="slider-item"><a href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/banner13.jpg" width="988"  border="0" alt="banner13" /></a></div>
						<div class="slider-item"><a href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/banner14.jpg" width="988"  border="0" alt="banner14" /></a></div>
                      

                     </div>

                <!--slide images-->

            

            </div><!--banner ends here-->
			
			<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/validation.js"></script>
			
