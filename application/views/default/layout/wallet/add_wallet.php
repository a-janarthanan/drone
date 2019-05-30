<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
	<div>
	<!--<div class="page-title mbot20">
		<h1 class="mleft15">Add Amount to Your Wallet</h1>
	</div>-->
    <div class="red-subtitle top-red-subtitle" >Add Amount to Your Wallet</div>
          <div class="profile_back">
<div class="container">
<div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
<div class="home-signpost-content home-signpost-content-new-section"> 
    	<div class="dbleft dbleft-main">



<?php if($error!='') { ?> 
<div class="marTB10" id="error"><p><?php echo $error; ?></p></div><?php } ?>



        


          
<div class="borrdercol">

	<div class="alignright">
		<?php echo anchor('wallet/','Wallet History('.$site_setting->currency_symbol.$total_wallet_amount.')','class="btn btn-default mar-bot-5"'); ?> &nbsp;|&nbsp;
      
      
        <?php if($total_wallet_amount>$wallet_setting->wallet_minimum_amount) { ?>
        
	        <?php echo anchor('wallet/withdraw_wallet','Withdraw','class="btn btn-default mar-bot-5"'); ?> &nbsp;|&nbsp;
              <?php echo anchor('wallet/my_withdraw','Withdrawal History','class="btn btn-default mar-bot-5"'); ?> 
         <?php } ?>
         
      
        
	</div>


<?php
	$attributes = array('name'=>'frmAddWallet','id'=>'frmAddWallet','class'=>'form_design');
	echo form_open('wallet/add_wallet',$attributes);
?>




<div id="detail-bg2" class="padTB10">
	<div class="fl" style="color:#FF0000; padding-right:10px;">Note : </div>
    <div class="fl"> 
         Transaction Fees <b class="colblack"><?php echo $wallet_setting->wallet_add_fees; ?>(%)</b> is added on the Total Wallet or Transaction Amount. Minimum <b class="colblack"><?php echo $site_setting->currency_symbol.$wallet_setting->wallet_minimum_amount; ?></b> is required.
	</div>
</div>

<br />
<br />

<div class="bye-credit-box" style="margin: 0px auto 10px auto;">
	<div class="bye-paypla"><img src="<?php echo base_url().getThemeName()?>/images/paypal_image.png" width="130"></div>
    <div class="clear"></div>
    <div class="bye-price-tag">
    	<div class="Price-main">
            <div class="Price-main-title" style="margin-bottom:8px;">Diposite Money</div>
            <div class="Price-main-amount">
            	<div style="background:#fff; color:#4ca0c6; padding:5px 9px 4px 8px; font-weight:bold; margin-right:10px; float:left;"><?php echo $site_setting->currency_symbol ?></div>
            	<input type="text" value="<?php echo $credit ;?>" id="credit" name="credit" class="ntext" placeholder="Enter Amount to Deposit" style="margin-bottom:0px; width:170px;">
            </div>
        </div>
        <div class="Price-main">
            <div class="Price-main-title style="margin-bottom:8px;"">Payment Gateway</div>
            <div class="Price-main-amount">
				<?php	
	
					if($payment)
					{
						$i=0;
						foreach($payment as $row)
						{
						$check='';
						//var_dump($payment);exit;
						 if($gateway_type==$row->id)$check='checked=checked';
							else if($i==0)$check='checked=checked';
							?>					 
							<p class="fs13" style="font-size:16px;"><!--<input type="radio" name="gateway_type" id="gateway_type" value="<?php echo $row->id; ?>" <?php echo $check;?> /> --><?php //echo $row->name; ?> 
                            <input type="hidden" name="gateway_type" id="gateway_type" value="<?php echo $row->id; ?>" />
                            </p>
														
						<?php
						}
					}
					
					?>    
            </div>
        </div>
    </div>
    <div class="bye-btns">
    	<div class="bye-btn-main">
            <input type="submit" value="Proceed" class="btn btn-default btn-default-join btn-app bye-btn" name="add_detail">
            <div class="cancel-rpo">or <a href="<?php echo base_url()?>wallet">Cancel Process</a></div>
        </div>
        <div class="clear"></div>
        <div class="secure-start">
        	<img src="<?php echo base_url().getThemeName()?>/images/paypal_logos.png" width="300">
        </div>
    </div>
    <div class="clear"></div>
</div>



</form>    
  
                
</div>                

    
  </div>      
                
                
		
        
        
        </div>
        <div class="dbright-task dbright-task-main" >
        <?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
        </div>
    </div>
		
        </div>
        <div class="clear"></div>
    </div>




