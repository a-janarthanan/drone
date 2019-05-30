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
                <div class="gig-detail-page">
                    <div class="gig-detail-page-left">
                    	<div class="wow fadeIn animated" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;">
                            <div class="gig-page-section">
                                <div class="gallery gallery-gig-detail">
                                    <div class="mp-gig-header">
                                        <?php //echo "<pre>"; print_r($service_details);echo "</pre>";?>
                                        <h1 class="notranslate">
                                            <span class="gig-title">
                                                    I will <?php echo $service_details->gig_title; ?>
                                            </span>
                                        </h1>
                                        <div class="header-bottom-gig">
                                            <div class="breadcrumbs-two-line pull-left" style="width:50%; float:left;">
                                                <a href="#">Graphics &amp; Design</a>
                                                
                                            </div>
                                            <div class="pull-left gig-time" style="width:50%; float:left;">
                                                <img src="<?php echo base_url().getThemeName(); ?>/images/clock_img.png" />7 Days On Average
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gig-banner-image"><img src="<?php echo base_url().getThemeName(); ?>/images/gig-banner.jpg" /></div>
                                </div>
                            </div>
                        </div>
                        <div class="wow fadeIn animated" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;">
                            <div class="gig-page-section gig-page-section-description">
                                <div class="mp-gig-header">
                                    <h4 class="gig-fancy-header">About This Gig</h4>
                                </div>
                                <div class="gig-main-desc-meta-wrapper cf">
                                    <div class="gig-main-desc-row">
                                        <p>
                                            <?php echo $service_details->gig_description;?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wow fadeIn animated" data-wow-delay="0.7s" style="visibility: visible; animation-delay: 0.7s; animation-name: fadeIn;">
                            <div class="gig-page-section gig-page-section-extras">
                                <div class="gig-order-button">
                                    <a class="btn-standard-lrg btn-green-grad js-button-order-now js-gig-price js-cart-order-now order-now js-gtm-event-auto notranslate" href="#">Order Now (<span class="js-gig-price-btn js-str-currency">SKU<?php echo $service_details->gig_price; ?></span>)</a>  
                                </div>
                            </div>
                        </div>
                        <div class="wow fadeIn animated" data-wow-delay="0.7s" style="visibility: visible; animation-delay: 0.7s; animation-name: fadeIn;">
                            <div class="gig-page-section gig-page-section-reviews last-gig-section mp-gig-review">
                                <div class="reviews-header">
                                    <div class="reviews-header-general cf ">
                                        <h4 itemprop="reviewCount" class="gig-fancy-header">807 Reviews</h4>
                                        <span class="circ-rating-s15"><img src="<?php echo base_url().getThemeName(); ?>/images/round_rating_2.png" /></span>
                                        <span itemprop="ratingValue" class="numeric-rating">5.0</span>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="reviews-header-stars cf">
                                        <div>
                                            <div class="rating-category">Seller Communication</div>
                                            <span class="circ-rating-s12"><img src="<?php echo base_url().getThemeName(); ?>/images/round_rating_2.png" width="75" /></span>
                                        </div>
                                        <div>
                                            <div class="rating-category">Service as Described</div>
                                            <span class="circ-rating-s12"><img src="<?php echo base_url().getThemeName(); ?>/images/round_rating_2.png" width="75" /></span>
                                        </div>
                                        <div>
                                            <div class="rating-category">Would Recommend</div>
                                            <span class="circ-rating-s12"><img src="<?php echo base_url().getThemeName(); ?>/images/round_rating_2.png" width="75" /></span>
                                        </div>
                                    </div>
                                </div>
                                <ul class="reviews-list js-reviews-list">    
                                    <li class="star-rating-row">
                                        <span class="user-pict-60">
                                            <img width="60" height="60" alt="freezingwreck" src="http://cdnil1.fiverrcdn.com/photos/3590057/small/203555.jpg?1408850005" data-reload="inprogress">
                                        </span>
                                        <h4>
                                            <a class="notranslate" href="/freezingwreck" rel="nofollow">freezingwreck</a>
                                            <span class="circ-rating-s9"><img src="<?php echo base_url().getThemeName(); ?>/images/round_rating_2.png" width="58" /></span>
                                        </h4>
                                        <div class="msg-body notranslate">
                                            Outstanding Experience!
                                        </div>
                                        <span class="rating-date">28 days ago</span>
                                    </li>
                                    <li class="star-rating-row rating-seller">
                                            <h4>
                                                seller's feedback
                                                <span class="circ-rating-s9"><img src="<?php echo base_url().getThemeName(); ?>/images/round_rating_2.png" width="58" /></span>
                                            </h4>
                                            <span class="user-pict-40"><img width="40" height="40" alt="applemoment" src="//cdnil0.fiverrcdn.com/photos/3026931/thumb/pp.jpg?1398601768" data-reload="inprogress"></span>
                                        <div class="msg-body notranslate">
                                            Thank you =)
                                        </div>
                                    </li>
                                    <li class="star-rating-row">
                                        <span class="user-pict-60">
                                            <img width="60" height="60" alt="freezingwreck" src="http://cdnil1.fiverrcdn.com/photos/3590057/small/203555.jpg?1408850005" data-reload="inprogress">
                                        </span>
                                        <h4>
                                            <a class="notranslate" href="/freezingwreck" rel="nofollow">freezingwreck</a>
                                            <span class="circ-rating-s9"><img src="<?php echo base_url().getThemeName(); ?>/images/round_rating_2.png" width="58" /></span>
                                        </h4>
                                        <div class="msg-body notranslate">
                                            Outstanding Experience!
                                        </div>
                                        <span class="rating-date">28 days ago</span>
                                    </li>
                                    <li class="star-rating-row rating-seller">
                                            <h4>
                                                seller's feedback
                                                <span class="circ-rating-s9"><img src="<?php echo base_url().getThemeName(); ?>/images/round_rating_2.png" width="58" /></span>
                                            </h4>
                                            <span class="user-pict-40"><img width="40" height="40" alt="applemoment" src="//cdnil0.fiverrcdn.com/photos/3026931/thumb/pp.jpg?1398601768" data-reload="inprogress"></span>
                                        <div class="msg-body notranslate">
                                            Thank you =)
                                        </div>
                                    </li>
                                    <li class="star-rating-row">
                                        <span class="user-pict-60">
                                            <img width="60" height="60" alt="freezingwreck" src="http://cdnil1.fiverrcdn.com/photos/3590057/small/203555.jpg?1408850005" data-reload="inprogress">
                                        </span>
                                        <h4>
                                            <a class="notranslate" href="/freezingwreck" rel="nofollow">freezingwreck</a>
                                            <span class="circ-rating-s9"><img src="<?php echo base_url().getThemeName(); ?>/images/round_rating_2.png" width="58" /></span>
                                        </h4>
                                        <div class="msg-body notranslate">
                                            Outstanding Experience!
                                        </div>
                                        <span class="rating-date">28 days ago</span>
                                    </li>
                                    <li class="star-rating-row rating-seller">
                                            <h4>
                                                seller's feedback
                                                <span class="circ-rating-s9"><img src="<?php echo base_url().getThemeName(); ?>/images/round_rating_2.png" width="58" /></span>
                                            </h4>
                                            <span class="user-pict-40"><img width="40" height="40" alt="applemoment" src="//cdnil0.fiverrcdn.com/photos/3026931/thumb/pp.jpg?1398601768" data-reload="inprogress"></span>
                                        <div class="msg-body notranslate">
                                            Thank you =)
                                        </div>
                                    </li>
                                </ul>
                                <div class="pagi-standard" style="display: block;">
                                    <a rel="noindex, nofollow" href="#">Show More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gig-detail-page-right">
	                    <div class="wow fadeIn animated" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;">
                            <div class="mp-gig-payment js-gig-payment">
                                <div class="mp-box mp-box-white nobot">
                                    <div class="gig-order-button">
                                        <a class="btn-standard-lrg btn-green-grad js-button-order-now js-gig-price js-cart-order-now order-now js-gtm-event-auto notranslate" href="#">
                                            Order Now (<span class="js-gig-price-btn js-str-currency">SKU<?php echo $service_details->gig_price; ?></span>)
                                        </a>
                                        <!--<button class="btn-standard-lrg btn-green-grad js-btn-cart js-cart-add-to-cart add-to-cart hint--right js-gtm-event-auto">
                                            <i class="icon"></i>
                                        </button>-->
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wow fadeIn animated" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;">
                            <div class="mp-gig-stats">
                                <div class="stats-row">
                                    <div class="value">
                                        <span class="rating-circles circ-rating-s12"><img src="<?php echo base_url().getThemeName(); ?>/images/round_rating_2.png" width="75" /></span>
                                        <span class="number">5.0</span>
                                    </div>
                                    <div class="name">
                                        <a class="gig-ratings-count js-gtm-event-auto" href="#">807 Buyer Reviews</a>
                                    </div>
                                </div>
                                <div class="stats-row">
                                    <div class="value">
                                        <span class="number">17</span>
                                    </div>
                                    <div class="name">Orders in Queue</div>
                                </div>
                            </div>
                            <div class="gig-social-bar js-gig-social-bar">
								<div class="social-share-icons">
                                    <a href="#" class="btn-share facebook-ser js-gtm-event-auto hint--bottom js-fiverr-event">Facebook</a>
                                    <a href="#" class="btn-share twitter-ser js-gtm-event-auto hint--bottom js-fiverr-event">Twitter</a>
                                    <a href="#" class="btn-share gplus-ser js-gtm-event-auto hint--bottom js-fiverr-event">Google+</a>
                                	<a href="#" class="btn-share linkedin-ser js-gtm-event-auto hint--bottom js-fiverr-event">LinkedIn</a>
                                </div>
                            </div>
                        </div>
                        <?php $user=$this->service_model->service_user($service_details->user_id);
                        ?>
                        <div class="wow fadeIn animated" data-wow-delay="0.7s" style="visibility: visible; animation-delay: 0.7s; animation-name: fadeIn;">
                            <div class="gig-seller-info">
                                <div class="seller-image">
                                    <div itemprop="logo" class="user-pict-130">
                                        <a href="#">
                                            <img width="130" height="130" src="<?php echo base_url(); ?>/upload/user/<?php echo $user->profile_image?>">
                                        </a>
                                    </div>
                                    <a class="js-gtm-event-auto seller-link notranslate" href="#"><span><?php echo $user->profile_name?></span></a>
                                    <small>Top Rated Seller</small>
                                    <a class="user-badge-round-med top_rated_seller hint--bottom" href="#"></a>
                                    <div class="clear"></div>
                                </div>
                               <!-- <ul class="seller-stats">
                                    <li>
                                        <small>From</small>
                                        Indonesia
                                    </li>
                        
                                    <li itemprop="review">
                                        <small>Positive Rating</small>
                                        100%
                                    </li>
                        
                                    <li>
                                        <small>Speaks</small>
                                        English
                                    </li>
                        
                                    <li>
                                        <small>Avg. Response Time</small>
                                        7 Hrs.
                                    </li>
                                    <div class="clear"></div>
                                </ul>-->
                                <div itemprop="description" class="seller-desc notranslate">
                                    <p><?php echo $user->about_user?></p>
                                    <div class="clear"></div>
                                </div>
                                <div class="contact-in">
                                    <a class="btn btn-default" href="#"><i class="fa fa-comment-o"></i> Contact Me</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="wow fadeIn animated" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;">
                    <div class="trending_collecction trending_collecction_1">
                        <?php $user_other_gig=$this->service_model->user_service_list($service_details->user_id);

                        ?>
                        <h2>Other Gigs By applemoment</h2>
                        <div class="featured-wrapper">
                        <?php
                        if($user_other_gig)
                        {
                        foreach ($user_other_gig as $servicelist) {
                           
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
                        <?php } } ?>
                            
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    