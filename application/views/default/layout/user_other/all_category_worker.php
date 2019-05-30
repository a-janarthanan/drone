<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->

<div>
	<div>
		<!--<div class="page-title mbot20">
			<h1 class="mleft15">Favourite Worker bees: <?php echo anchor('user/'.getUserProfileName(),$this->session->userdata('full_name'),' style="color:black" ');?></h1>
		</div>-->
        <div class="red-subtitle top-red-subtitle" >All Category Listing</div>
        <div class="profile_back">
            <div class="container">
                <div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
                    <div class="home-signpost-content"> 
                        <div class="dbleft dbleft-main dbleft-main-pricing">
                            <div class="need-detail">
            <ul>
                
                <?php
                //echo "<pre>";print_r($result);

                foreach ($result as $all_cats) {
                  
                if($all_cats->category_image!='') {  
                                                
                 if(file_exists(base_path().'upload/category/'.$all_cats->category_image)) { 
                                                        
                  $category_image=base_url().'upload/category/'.$all_cats->category_image;
                                                    
                   }else
                   {
                           $category_image=base_url().'upload/category/no_image.png';
                     }
                                                    
                  }
                   else
                    {
                         $category_image=base_url().'upload/category/no_image.png';
                     }
             ?>

                <li>
                    <div style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;" data-wow-delay="0.4s" class="wow fadeIn animated  animated animated">
                        <a href="<?php echo base_url();?>taskers/category/<?php echo $all_cats->category_url_name; ?>">
                            <div class="need-img"><img alt="" src="<?php echo $category_image; ?>" /></div>
                            <div class="need-img-detail">
                                <h3><?php echo $all_cats->category_name; ?></h3>
                                <h4>eg. <?php echo $all_cats->category_name; ?></h4>
                            </div>
                        </a>
                    </div>
                </li>
            <?php } ?>
               
            </ul>
           
        </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
               <div class="clear"></div>   
            </div>
        </div>
	</div>
</div>