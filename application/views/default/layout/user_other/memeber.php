<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<style>
.ultaskers li {
border-bottom: 1px #f2413e solid;
padding: 10px 0px;
}
.abc{
float: left;
width: 55px;
}
</style>
<div>
	<div>
		<!--<div class="page-title mbot20">
			<h1 class="mleft15">Favourite Worker bees: <?php echo anchor('user/'.getUserProfileName(),$this->session->userdata('full_name'),' style="color:black" ');?></h1>
		</div>-->
        <div class="red-subtitle top-red-subtitle" >Select the best plan for your needs</div>
        <div class="profile_back">
            <div class="container">
                <div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
                    <div class="home-signpost-content home-signpost-content-pricing"> 
                        <div class="dbleft dbleft-main dbleft-main-pricing">
                        	<div class="abttb3-2 abttb3-2-price">
                                <ul class="ultaskers">
                                    <?php 
									$k = 0;
									if($result) {  foreach($result as $row) { 
									$k++;
                                    ?> 
                                    <li class="posrel-pricing-box <?php if($k == 1 ) { ?> posrel-pricing-box-orange <?php } elseif($k == 2 ) { ?> posrel-pricing-box-green <?php } elseif($k == 3 ) { ?> posrel-pricing-box-blue <?php }?> pull-left">
                                        <div class="pricing-box-inner">
                                        	<div class="pricing-box-title <?php if($k == 1 ) { ?>  <?php } elseif($k == 2 ) { ?> pricing-box-title-green <?php } elseif($k == 3 ) { ?> pricing-box-title-blue <?php }?>"><?php echo $row->title;?></div>
                                            <div class="mplan-price-row <?php if($k == 1 ) { ?>  <?php } elseif($k == 2 ) { ?> mplan-price-row-green <?php } elseif($k == 3 ) { ?> mplan-price-row-blue <?php }?>"><?php echo $row->price;?></div>
                                            <div class="pricing-box-info">
                                            	<div class="mplan-info-pricing"><?php echo $row->description;?></div>
                                                <div class="mplan-price-btn"><a href="<?php echo base_url() ?>wallet/buy_credit/<?php echo $row->id;?>" class="btn btn-default btn-default-price">Buy Now</a></div>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </li>
                                    
                                    <?php } } ?>
                                    <div class="clear"></div>
                                </ul>
                            </div>
                            <div class="plan-active-box-info-pricep">Currently You have <span><?php echo $this->user_other_model->getNameTable('trc_user','avilable_bid','user_id',get_authenticateUserID());?></span> available Bids in your account</div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
               <div class="clear"></div>   
            </div>
        </div>
	</div>
</div>