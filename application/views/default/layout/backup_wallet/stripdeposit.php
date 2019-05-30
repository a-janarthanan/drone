<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
	<div>
	<!--<div class="page-title mbot20">
		<h1 class="mleft15">Add Amount to Your Wallet</h1>
	</div>-->
    <div class="red-subtitle top-red-subtitle">Payment towards credit purchase</div>
          <div class="profile_back">
<div class="container">
<div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
<div class="home-signpost-content home-signpost-content-new-section" style="text-align:center; width:97% !important;"> 
<?php
            $this->load->library('session');
            //echo $packid;
            
            $price=  $this->input->post('credit');

           
           
            $finalprice=$price*100;
?>      
<div style=" color: #666; font-size: 25px; line-height: 40px; padding: 30px 0 50px; text-align: center;">
	You have selected Stripe as a payment method to purchase bid Credits . <br />
	  Please click on below button to complete your purchase .
</div>
<form action="<?php echo base_url() ?>wallet/pay_strip" method="POST">
  <input type="hidden" name="price_new" value="<?php echo $price ?>">
  <input type="hidden" name="packid" value="<?php echo $packidnew ?>">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_uyHqJ6na8UIjYGm0b4RUfdL6"
    data-image="<?php echo base_url().getThemeName()?>/images/logo_new.png"
    data-name="Carmeller"
    data-description="Buy Credit"
    data-amount="<?php echo $finalprice ?>"
    data-locale="auto">
  </script>
</form>
<div style="font-size: 19px; padding: 45px 0 15px; text-align: center;">
<a href="<?php echo base_url() ?>user_other/Buy_credit">Go back</a>
</div>

</div>   