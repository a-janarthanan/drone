<link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/js/css/category-slider_new2.css" />

<script type="text/javascript">
$(document).ready(function() {	
	jQuery('#show_cat').click(function (){
		jQuery('#container-cat').slideToggle("fast");
	});
	
});
</script>
<?php

$site_setting=site_setting();
$data['site_setting']=$site_setting;
$data['cityname']=$cityname;
$data['category_url_name']=$category_url_name;
$data['tasks_info']=$tasks_info;
$data['city_id']=$city_id;
$data['category_infos']=$category_infos;
?>
<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>


 <div class="profile_back">
 	<div class="red-subtitle"><?php  echo $category_infos->category_name;?> </div>
        <div class="container">
        <div >
            <div class="home-signpost-content home-signpost-content-task">
                <div class="wow fadeIn animated  animated" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeIn;">
                    <div class="border-black-main" style="margin-bottom:50px;">
                        <div class="border-black-left-main">
                            <div class="category_img">
                            	<?php
									if($category_infos->category_image!='') {  
						
										if(file_exists(base_path().'upload/category/'.$category_infos->category_image)) { 
											
											$category_image=base_url().'upload/category/'.$category_infos->category_image;
										
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
                                <img src="<?php  echo $category_image;?>" alt="" />
                            </div>
                            <div class="category_name"><?php echo $category_infos->category_name;?></div>
                            <div class="category_details"><?php echo $category_infos->category_description;?></div>
                            <!--<div class="category_btn-main"> <?php echo anchor('tags/',"Back to search","class='btn btn-default btn-category'"); ?></div>-->
                        </div>
                        <div class="border-black-right-main">  
                            <div class="category_name">Current Tasks in <?php  echo $category_infos->category_name;?></div>    
                            <div class="inner-category-info inner-category-info-pro" id="inner-category-info_1">
                                <ul class="listing">
                                <?php 
                                    if($tasks_info){
                                        foreach($tasks_info as $task_info) { 
                                            $user_image=base_url().'upload/no_image.png';
                                            if($task_info->profile_image!='') {  
                                                if(file_exists(base_path().'upload/user/'.$task_info->profile_image)) { 
                                                    $user_image=base_url().'upload/user/'.$task_info->profile_image;
                                                }
                                            }
                                            $total_rate=get_user_total_rate($task_info->user_id);
                                            ?>
                                            <li>
                            
                                <div class="imageph">
                                
                                    
                                    <?php echo anchor('user/'.$task_info->profile_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />');?>
                                    
                                    
                                </div>
                                <div class="detailspart">
                                    <?php //echo anchor('tasks/'.$task_info->task_url_name' class="fpass fs13"');?>
                                    <p class="item-title"><?php echo anchor('tasks/'.$task_info->task_url_name,ucfirst($task_info->task_name));?></p>
                                    <p class="item-short-des fs14">
                                        <?php 
                                            
                                            
                                            $task_description= $task_info->task_description;		
                                            $task_description=str_replace('KSYDOU','"',$task_description);
                                             $task_description=str_replace('KSYSING',"'",$task_description);
            
                                            $strlen = strlen($task_description);
                                            if($strlen > 50) { echo substr($task_description,0,50).' ...';}
                                            else { echo $task_description; } 
            
                                        ?>                                
                                    </p>
                                </div>
                                <div class="frightauto" style="margin-right:10px;">
                                    <div class="urgent-price" style="width:100%;">
                                        <b>Project Budget (<?php echo $site_setting->currency_symbol ?>)</b> <br>
                                        <?php echo $site_setting->currency_symbol.$task_info->task_to_price.' - '.$site_setting->currency_symbol.$task_info->task_price; ?>                   
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </li>
    
                                            <?php } } else {?>
                                                <li style="padding-left:15px; text-align:center;" ><strong>Sorry Currently there is no active job in this category</strong></li>
                                            <?php } ?>
                                            </ul>                        
                        	</div>
                            <?php if($total_rows>10) { ?>
                                <div class="gonext">
                                <?php echo $page_link; ?>
                                </div>
                            <?php } ?>
                            <div class="category_btn-main"> <?php echo anchor('tags/',"Back to search","class='btn btn-default btn-category'"); ?></div>
                        </div>
                    </div>
                </div>
            </div>	
            <div class="clear"></div>
		</div>
        <div class="clear"></div>
	</div>	 
