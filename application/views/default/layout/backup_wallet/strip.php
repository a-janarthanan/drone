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
            if($this->session->userdata('packid')) 
            {
              $packidnew=$this->session->userdata('packid');
            }
            else
            {
              $packidnew=$this->uri->segment(3, 0);
            }
              

           
            $packsecid = $this->session->set_userdata(array(
                            'packid'        => $packidnew
                    ));
            $packid =$this->session->userdata('packid');
            //echo $packid;
            $price=$this->wallet_model->getNameTable("trc_membership","price","id",$packid);
            $finalprice=$price*100;
?>      
<div style=" color: #666; font-size: 25px; line-height: 40px; padding: 30px 0 50px; text-align: center;">
	You have selected Paypal as a payment method to purchase bid Credits . <br />
	  Please click on below button to complete your purchase .
</div>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">  
          <input type="hidden" name="business" value="herschelgomez@xyzzyu.com">
          <!-- Specify a Buy Now button. -->
          <input type="hidden" name="cmd" value="_xclick">

          <!-- Specify details about the item that buyers will purchase. -->
          <input type="hidden" name="item_name" value="Buy Bid Credit">
          <input type="hidden" name="amount" value="<?php echo $price; ?>">
          <input type="hidden" name="currency_code" value="USD">

        <?php
        $attributes = array('name'=>'frm_withdrawwallet','id'=>'frm_withdrawwallet','class'=>'form_design','onsubmit'=>'retun frm_withdarw()'); 
            $this->load->library('session');
            //echo '----'.$this->uri->segment(3, 0);
            //echo '===='.$this->session->userdata('packid');
            if($this->uri->segment(3, 0)==$this->session->userdata('packid') || $this->uri->segment(3, 0)==0) 
            {
              $packidnew=$this->session->userdata('packid');
            }
            else
            {
              $packidnew=$this->uri->segment(3, 0);
            }

            //echo $packidnew;
              

           
            $packsecid = $this->session->set_userdata(array(
                            'packid'        => $packidnew
                    ));
            $packid =$this->session->userdata('packid');
            //echo $packid;
            $price=$this->wallet_model->getNameTable("trc_membership","price","id",$packid);
            $bid=$this->wallet_model->getNameTable("trc_membership","numbid","id",$packid);
            

            ?>
            <input type="hidden" name="packid" value="<?php echo $packid ?>">

<div id="detail-bg2" class="padTB10">
  <!--<div class="fl" style="color:#FF0000; padding-right:10px;">Note : </div>-->
    <div class="fl"> 
      <!--
        Administrator Transaction Fees <b class="colblack"><?php echo $wallet_setting->wallet_donation_fees; ?>(%)</b> is added on the Total Withdrawal also Transaction Charges cut from the withdrawal Amount.<br />Minimum <b class="colblack"><?php echo  $site_setting->currency_symbol.$wallet_setting->wallet_minimum_amount; ?></b> is required.
         Transaction charge of R10.00 Will be deducted from the withdrawal amount of less than R300.00 <br />
         Minimum Withdrawal Amount R80 is required.-->
  </div>
</div>


<div class="clear"></div>
<div class="bye-credit-box">
  <div class="bye-paypla"><img src="<?php echo base_url().getThemeName()?>/images/paypal_image.png" width="130"></div>
    <div class="clear"></div>
    <div class="bye-price-tag">
      <!--<div class="Price-main">
            <div class="Price-main-title">Price</div>
            <div class="Price-main-amount">kr <?php echo $price; ?></div>
            <input type="hidden" value="<?php echo $price; ?>" id="amount" name="amount">
        </div>-->
        <div class="Price-main">
            <!--<div class="Price-main-title">Number of Bid</div>
            <div class="Price-main-amount"><?php echo $bid; ?></div>-->
            <input type="hidden" value="<?php echo $bid; ?>" id="amount" name="amount">
            <input type="hidden" name="gateway_type" id="gateway_type" value="1" >
            <input type="hidden" name="withdraw_method"  value="gateway"  id="withdraw_method" >
        </div>
    </div>
    <div class="bye-btns">
      <div class="bye-btn-main">
            <input type="submit" value="Purchase" class="btn btn-default btn-default-join btn-app bye-btn" name="sub_detail">
            
        </div>
        <div class="clear"></div>
        <div class="secure-start">
          <img src="<?php echo base_url().getThemeName()?>/images/paypal_logos.png" width="300">
        </div>
    </div>
    <div class="clear"></div>
</div>
</form>
<div style="font-size: 19px; padding: 45px 0 15px; text-align: center;">
<a href="<?php echo base_url() ?>user_other/Buy_credit">Go back</a>
</div>

</div>   