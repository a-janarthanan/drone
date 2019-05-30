<link href="<?php echo base_url().getThemeName(); ?>/jquery.megamenu.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/jquery.megamenu.js"></script>
<script type="text/javascript">
	jQuery(function(){
		jQuery(".megamenu").megamenu();
	});
</script>
	<div class="body_cont">
        <div>
            <!--banner-->
            <div id="acc-banners-ph" class="banner-contain" style="position:relative;">
            </div>
            <div class="clear"></div>
            <div style="height:80px; background:#881926;"></div>
            <div class="clear"></div>
            <div class="mp-box-white">
                <div class="container">
                    <ul class="megamenu">
                        <?php
                            foreach($all_categories as $all_cats)
                            {
                                $sub=$this->service_model->sub_category($all_cats->task_category_id);
                        ?>
                        <li>
                            <a href="javascript:void(0)"><?php echo $all_cats->category_name; ?></a>
                            <div class="main_hover">
                                <div class="menu-cont">
                                    <ul>
                                        <?php 
                                        foreach($sub as $sub_cats)
                                        {
                                        ?>
                                        <li><a href="#"><?php echo $sub_cats['category_name'] ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <!--banner ends-->
        </div>	
	</div>
    <div class="profile_back">
    	<div class="container">
            <div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
                 <div class="wow fadeIn animated" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;">
                    <div class="trending_collecction trending_collecction_1">
                       
                        <?php
                      //print_r($all_service_list);
                      if($all_service_list)
                      {
                        foreach ($all_service_list as $servicelist) {
                           
                        ?>   
                        <div class="featured-wrapper">
                            <div class="featured-wrapper-slide">
                                <div class="gig-seller">
                                    by <a class="seller-name" href="#"><?php echo $servicelist['gig_user_name'];?></a>
                                    <span class="pull-right">
                                        <span class="ratings-count"><img src="<?php echo base_url().getThemeName(); ?>/images/round_rating.png"> (70)</span>
                                    </span>
                                </div>
                                <a class="gig-link-main" href="<?php echo base_url()?>service/service_details/<?php echo $servicelist['id'] ?>">
                                    <span class="gig-pict-222"><img src="<?php echo base_url(); ?>/upload/gig_img/<?php echo $servicelist['gig_img']?>"></span>
                                    <h3 class="notranslate"><?php echo $servicelist['gig_title'];?></h3>
                                </a>
                                <aside class="card-badges cf">
                                    <!--<span class="gig-badges featured">featured</span>
                                    <span class="top-rated">Fiverr Top Rated Seller!</span>-->
                                </aside>
                                <div class="gig-sub cf">
                                    <a class="gig-price" href="#"><small itemprop="price"></small><span itemprop="price">SKU<?php echo $servicelist['gig_price'];?></span></a>
                                    <!--<aside class="gig-collect js-gig-collect">
                                        <a class="icn-heart hint--top js-open-popup-join" href="#"><span></span></a>
                                    </aside>-->
                                </div>
                            </div>
                            
                            
                        </div>
                        <?php } } else {?>
                        <p>No Service post yeat.</p>
                        <?php } ?>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    