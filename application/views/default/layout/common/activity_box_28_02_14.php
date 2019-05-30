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
		return false;
	}
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var address = document.quicksignupForm.email.value;
    if(reg.test(address) == false) 
	{
      alert('Invalid Email Address');
      return false;
    }
	if(document.quicksignupForm.zip_code.value=="")
	{
		alert('Please enter your zip code');
		return false;
	}
}
</script>
<div class="banner">

            <div class="over_write">

            <!--<p>THE BETTER WAY</br>TO FIND A VIRTUAL ASSISTANT</p>-->
		<p>&nbsp;</p>	<p>&nbsp;</p> 
			<form action="<?php echo base_url(); ?>index.php/sign_up" method="post" id="quicksignupForm" name="quicksignupForm" onsubmit="return validation();">
            <div class="email_cont">

            	<input class="email" name="email" id="email" placeholder="EMAIL" style="border: 3px solid rgb(255, 205, 6);padding-left: 5px;"  />

            </div>

            <div class="zip_cont">

            <input class="zipcode" name="zip_code" id="zip_code" placeholder="POST CODE" style="border: 3px solid rgb(255, 205, 6);" />

            </div>

             <input class="inpt_join" value="JOIN US FREE NOW" type="submit" id="quicksign_up" />
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
