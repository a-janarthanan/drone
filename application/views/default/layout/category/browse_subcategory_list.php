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
                        <div class="border-black-main">
                            <div class="border-black-left-main-2">
                                <div class="category_img">
                                <?php
                                    if($maincategoriesdetails->category_image!='') {  
                                                
                                                    if(file_exists(base_path().'upload/category/'.$maincategoriesdetails->category_image)) { 
                                                        
                                                        $category_image=base_url().'upload/category/'.$maincategoriesdetails->category_image;
                                                    
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
                                    <img src="<?php echo $category_image ?>" alt="" />
                                </div>
                                <div class="category_name"> <?php echo anchor('tags/'.$maincategoriesdetails->category_url_name,$maincategoriesdetails->category_name); ?></div>
                                <div class="category_btn-main"> <?php echo anchor('tags/'.$maincategoriesdetails->category_url_name,$maincategoriesdetails->category_name,"class='btn btn-default btn-category'"); ?></div>
                            </div>
                            <div class="border-black-right-main">  
                                <div class="category_name">Sub Categories</div>    
                                <div class="inner-category-info" id="inner-category-info_1">
                                    <?php

                                    if($all_subcategories)
                                    {
                                    ?>
                                    <!--<ul>-->
                                        <?php
                                            $category_image='';
                                            $i=0;
                                            $count_fewer = count($all_subcategories);
                                            foreach($all_subcategories as $all_cats)
                                            { 
                                                $i++;
                                                
                                                
                                               
                                                if($all_cats['category_image']!='') {  
                                                
                                                    if(file_exists(base_path().'upload/category/'.$all_cats['category_image'])) { 
                                                        
                                                        $category_image=base_url().'upload/category/'.$all_cats['category_image'];
                                                    
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
                                                                <?php echo anchor('tags/'.$all_cats['category_url_name'],$all_cats['category_name']); ?>
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



