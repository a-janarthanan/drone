<style>
.mc li {
    float: left;
    font-family: arial;
    font-size: 13px;
    list-style: outside none none;
    padding: 5px 0;
    width: 192px;
}
.mc li a{ color:#000;}
</style>
<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
	<div>
	
    
    <div class="profile_back">
    	<div class="red-subtitle top-red-subtitle">Browse tasks </div>    	
        <div class="container">
    		
        <div class="">
        <div class="">
            <div class="">
            <form>
            <div class="" style="padding-bottom:50px;">
            
            
            
                    <div class="wow fadeIn animated  animated" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeIn;">
                        <div class="border-black-main"> <!-- border-black-main-category-->
                            <div class="border-black-left-main-2"> <!--border-black-left-->
                                <div class="category_img">
                                    <img src="<?php echo base_url().getThemeName()?>/images/left_img_category.png" alt="" />
                                </div>
                                <div class="category_name">Details</div>
                                <div class="category_details">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book when an unknown printer took a galley of type and scrambled it to make a type specimen book. </div>
                            </div>
                            <div class="border-black-right-main">  <!--border-black-right-->
                                <div class="category_name">Categories</div>    
                                <div class="inner-category-info" id="inner-category-info_1">
                                    <?php
									if($all_categories)
									{
									?>
									<!--<ul>-->
										<?php
											$category_image='';
											$i=0;
											$count_fewer = count($all_categories);
											foreach($all_categories as $all_cats)
											{ 
												$i++;
												
												$sub=sub_category($all_cats->task_category_id);
												
												$nmore= $all_cats->task_category_id;
												
												/*$count_fewer=0;
												if($sub)
												{
												
													foreach($sub as $sub_cats)
													{
														$count_fewer++;
													}
												}*/
												
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
                                            <div class="inner_category_detail">
                                                <div class="inner_category_img">
                                                    <img src="<?php echo $category_image; ?>" alt="" />
                                                </div>
                                                <div class="inner_category_name">
                                                    <table height="77" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td valign="middle">
                                                                <?php echo anchor('category/subcategory_list/'.$all_cats->task_category_id,$all_cats->category_name); ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
											<?php
                                            }
                                            ?>
                                        </div>
                                        <?php
										if($count_fewer>4){
										?>
										<script type="text/javascript">
											$(document).ready(function() {
												$('#more<?php echo $nmore; ?>').click(function() {
													jQuery('#fewer<?php echo $nmore; ?>').show();
													jQuery('#more<?php echo $nmore; ?>').hide();
													jQuery('#inner-category-info_1').css('overflow-y','scroll');
													jQuery('#fewer<?php echo $nmore; ?>').css("display","inline-block");
												});
												$('#fewer<?php echo $nmore; ?>').click(function() {
													jQuery('#fewer<?php echo $nmore; ?>').hide();
													jQuery('#more<?php echo $nmore; ?>').show();
													jQuery('#inner-category-info_1').css('overflow-y','hidden');
												});
											});
											</script>
											<a class="more" id="more<?php echo $nmore; ?>" href="javascript:void(this);" style="display: inline-block; padding: 11px 0 3px; text-align: center; width: 100%;">
												<img src="<?php echo base_url().getThemeName()?>/images/down_arrow.png" width="30" alt="" />
											</a>
											<a class="more" id="fewer<?php echo $nmore; ?>" href="javascript:void(this);" style="display: none; padding: 11px 0 3px; text-align: center; width: 100%;">
												<img src="<?php echo base_url().getThemeName()?>/images/up_down_arrow.png" width="30" alt="" />
											</a>
										<?php
										}
										?>
                                  <?php
								    }
                                    ?>
                            </div>
                        </div>
                        <!--<div class="category_button_right">
                        	<a href="map" class="btn btn-default btn-category-btn">Find by location</a>
                            <a href="search" class="btn btn-default btn-category-btn">Current tasks</a>
                        </div>-->
                    </div>
            	<div class="clear"></div>
            <!--</ul>-->
           
            
            </div>
            
            
            </form>
            
            </div>
		</div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>



