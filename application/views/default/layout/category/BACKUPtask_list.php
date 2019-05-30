<link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/js/css/category-slider.css" />

<script type="text/javascript">
$(document).ready(function() {	
	jQuery('#show_cat').click(function (){
		jQuery('#container-cat').slideToggle("fast");
	});
	
});
</script>

<div class="main">
<div class="incon">
    	<div class="mconleft">
        
<?php

$site_setting=site_setting();
$data['site_setting']=$site_setting;
$data['cityname']=$cityname;
$data['category_url_name']=$category_url_name;
$data['tasks_info']=$tasks_info;
$data['city_id']=$city_id;
$data['category_infos']=$category_infos;
?>

<!-- cat slider s -->

<a style="cursor:pointer;" id="show_cat" class="fpass">More Categories<img alt="" src="<?php echo base_url().getThemeName(); ?>/images/city_arrow.png"></a>

<?php 

$categories=get_category();

 if($categories) {	 $cat_cnt=0; ?>
<div id="container-cat" style="display:none; border-bottom:1px solid #E5E4E5;">
    <div id="carousel-cat">
    	
        
        <?php   foreach($categories as $all_category){ $cat_cnt++;
		
		
		
		
		$category_image=base_url().'upload/category/no_image.png';

		
					if($all_category->category_image!='') {  
					
						if(file_exists(base_path().'upload/category/'.$all_category->category_image)) { 
							
							$category_image=base_url().'upload/category/'.$all_category->category_image;
						
						}
						
					}
					
					
					 ?>
        
        
    	<div class="slidecat"><?php echo anchor('tags/'.$all_category->category_url_name,'
            <div class="scleft">
           		<img src="'.$category_image.'" width="48" height="48" alt="" />
            </div>
            <div class="scright">
            	<h3>'.ucfirst($all_category->category_name).'</h3>
            </div>
            <div class="clear"></div>');?>
        </div>   
        
        
        <?php }?>
        
        

    	
        
    </div>
    <?php if($cat_cnt>3) { ?>
    <a href="#" id="ui-carousel-next-cat"><span>next</span></a>
    <a href="#" id="ui-carousel-prev-cat"><span>prev</span></a>
    <?php } ?>
    
</div>

<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/lib/category-slider.js"></script>

		<script type="text/javascript">
			jQuery(function( $ ) {
				$("#carousel-cat").rcarousel({
					width: 200,
					height: 70,
					auto: {
						enabled: true,
						interval: 1000,
						direction: "next"
					}
				});
				
				$("#ui-carousel-next-cat")
					.add("#ui-carousel-prev-cat")
					.hover(
						function(){
							$(this).css("opacity",0.7);
						},
						function(){
							$(this).css("opacity",1.0);
						}
					);				
			});
		</script>
        
        
        <?php  } ?>
        
<!-- cat slider e -->        

	
         <div class="marTB10 title2"><?php  echo $category_infos->category_name;?></div>
        
        <ul class="cathc padB20">
				 <?php $active='';
				   if($all_categories) {	 foreach($all_categories as $all_category){
					 	if($all_category->category_name == $category_name->category_name) { 
				   ?>        
        	<li class="fpass act"><?php echo $all_category->category_name;?></li>
            <?php } else { ?>
        	<li><?php  echo anchor('tags/'.$all_category->category_url_name,$all_category->category_name,' class="fpass" ');?></li>
					<?php } ?>
				   <?php }   } ?>
                   
			<?php if($category_infos->category_name == $category_name->category_name) {?>
			<li>Other</li>                   
                    <?php } ?>
                                       
                    
            <div class="clear"></div>
        </ul>
        
        <h3 id="detail-bg1">Recent <?php echo $category_name->category_name;?> Examples</h3>
 
        
<ul class="ulsty">
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
                        
                        	<div class="abct3">
                            
                                
                                <?php echo anchor('user/'.$task_info->profile_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />');?>
                                
                                
                            </div>
                        	<div class="catle2 LH18">
                            	<?php echo anchor('tasks/'.$task_info->task_url_name,ucfirst($task_info->task_name),' class="fpass fs13"');?><br/>
                       
                                <div class="strmn padR10"><div class="str_sel" style="width:<?php if($total_rate>5) { ?>100<?php } else { echo round($total_rate*2);?>0<?php } ?>%;"></div></div>
                                Tasks of this type: <span class="orange"><?php echo $site_setting->currency_symbol.$task_info->task_to_price.' - '.$site_setting->currency_symbol.$task_info->task_price; ?></span>
                                <p>
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
                            <div class="fr wid125">
                            	
 <?php if(!check_user_authentication()) {  echo anchor('sign_up','Use Template',' class="cm temp" ');  }  else { echo anchor('task/update_task_step_zero/'.$task_info->task_id.'/copy','Use Template',' id="copytask_'.$task_info->task_id.'" class="cm temp" '); ?>
 
 						   <script type="text/javascript">
								jQuery(document).ready(function() {	
									jQuery("#copytask_<?php echo $task_info->task_id;?>").fancybox();	
								});
						</script>

<?php } ?>
								
                                 
                            </div>
                            <div class="clear"></div>
                        </li>

						<?php } } else {?>
							<li><strong>No Tasks</strong></li>
						<?php } ?>

                        
</ul>                        

  
  
  <?php if($total_rows>10) { ?>
					<div class="gonext">
                    <?php echo $page_link; ?>
                    </div>
				<?php } ?>
                
                      
	
		

            	

			</div>
			
			<?php echo $this->load->view($theme.'/layout/category/task_list_sidebar',$data); ?>  
			
			

     
                
		
        <div class="clear"></div>



    </div>
</div>