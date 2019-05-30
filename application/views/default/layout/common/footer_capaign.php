<link type="text/css" rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/js/css/recent-task-vertical.css" />
<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/lib/recent-task-vertical.js"></script>




<?php $recent_task=recent_task(); ?>
<div class="main">

<ul class="rtt">
	<li>
    
    	<div class="indmap">
        <div class="tit2 aligncen marB10">RECENT TASKS</div>
    <?php $site_setting=site_setting(); 	 ?>
    	  <div class="recsty" id="recid">
               
                <div id="container-vertical">
                    <div id="carousel-vertical">

                        <?php if($recent_task) {
					
								foreach($recent_task as $rtask) { 
								 $user_image= base_url().'upload/no_image.png';
						 
								 if($rtask->profile_image!='') {  
							
									if(file_exists(base_path().'upload/user/'.$rtask->profile_image)) {
								
										$user_image=base_url().'upload/user/'.$rtask->profile_image;
									}
								}
								?>


                    <div class="<?php if(count($recent_task)>3) { ?>slideVer<?php } else { ?>slide2<?php } ?>">
                            <div class="t1left">
                                 <img src="<?php echo $user_image;?>" width="48" height="46" alt="" />
                            </div>
                            <div class="t1right">
                                <h4><?php echo anchor('tasks/'.$rtask->task_url_name,$site_setting->currency_symbol.$rtask->task_price,'class="col1"');?>  -  <?php echo anchor('map/in/'.$rtask->city_name,strtoupper($rtask->city_name),'class="col2"');?></h4>
                                <p><?php echo anchor('tasks/'.$rtask->task_url_name,ucfirst($rtask->task_name));?></p>
                            </div>
                            <div class="clear"></div>
                    </div>
					<?php }  } ?>
                    
                         </div>
                    <?php if($recent_task) { if(count($recent_task)>3) {  ?> 
                    <a style="cursor:pointer;" id="ui-carousel-next-vertical"><span>next</span></a>
                    <a style="cursor:pointer;" id="ui-carousel-prev-vertical"><span>prev</span></a>
                     <?php } } ?>
                </div>                    


<?php if($recent_task) { if(count($recent_task)>3) { ?>
		<script type="text/javascript">
			jQuery(function($) {

				jQuery("#carousel-vertical").rcarousel({
					orientation: "vertical",
					visible: <?php if($recent_task) { if(count($recent_task)>3) { ?>3<?php } else { ?>1<?php } } else { ?>1<?php } ?>
					
				});
		
				jQuery("#ui-carousel-next-vertical")
					.add("#ui-carousel-prev-vertical")
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
<?php } } ?>               
            </div>
        </div>    
    </li>
	<li>
    <div class="indmap" style="background:none;">
        <div class="tit2 aligncen marB10">SHARE TASK ON SOCIAL NETWORK</div>
        <div class="marL18 wid280">
            <p class="padTB10 LH15">Become the office hero when you set your company
    up with our <?php echo anchor('#','Employee Perks Program','class="perk"');?>.</p>
    <center>
    <img src="<?php echo base_url().getThemeName();?>/images/gohand.png" alt="" />
    </center>
		</div>
	</div>        
    </li>
	<li>
<link type="text/css" rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/js/css/top-runner-vertical.css" />
<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/lib/top-runner-vertical.js"></script>


<div class="indmap">
        <div class="tit2 aligncen marB10">TOP WORKER BEES</div>
    <?php $top_worker=get_top_worker(10); ?>
    	  <div class="recsty" id="recid">
               
                <div id="container-top-vertical">
                    <div id="carousel-top-vertical">

                        <?php if($top_worker) {
					
								foreach($top_worker as $twork) { 
								
								 $user_image= base_url().'upload/no_image.png';
						 
								 if($twork->profile_image!='') {  
							
									if(file_exists(base_path().'upload/user/'.$twork->profile_image)) {
								
										$user_image=base_url().'upload/user/'.$twork->profile_image;
									}
								}
								
								$total_rate=get_user_total_rate($twork->user_id);
								?>


                    <div class="<?php if(count($top_worker)>3) { ?>slideVerT<?php } else { ?>slide2T<?php } ?>">
                            <div class="t1leftT">
                                 <img src="<?php echo $user_image;?>" width="48" height="46" alt="" />
                            </div>
                            <div class="t1rightT">
                                <h4><?php echo anchor('user/'.$twork->profile_name,ucfirst($twork->first_name).' '.ucfirst(substr($twork->last_name,0,1)),'class="col1" style="float:left; padding:0px 5px 0px 0px;"');?>
                                
                                
                                <div class="strmn"><div class="str_sel" style="width:<?php if($total_rate>5) { ?>100<?php } else { echo round($total_rate*2);?>0<?php } ?>%;"></div></div>
                                
                                </h4> 
                                <div class="clear"></div>
                                
                                
                                <p style="width:200px; word-wrap:break-word;"><?php 
					
					
					
					  $task_type_detail='';
			  
			 $types=$twork->worker_task_type;
			 
			 if($types!='') { 
			 
			
			 
			 $ex_type=explode(',',$types);
			 
			 foreach($ex_type as $type) 
			 {
				
				 $get_task_type=$this->worker_model->get_task_type_detail($type);
				 if($get_task_type){
				 	if($get_task_type->task_name != ''){
					  $task_type_detail .=trim($get_task_type->task_name).',';
				 	}
				}

			}
					
					if($task_type_detail!='') { echo  substr(substr($task_type_detail,0,-1),0,60).'...'; }  }
					
					?></p>
                                
                            </div>
                            <div class="clear"></div>
                    </div>
					<?php }  } ?>
                    
                         </div>
                    <?php if($top_worker) { if(count($top_worker)>3) {  ?> 
                    <a style="cursor:pointer;" id="ui-carousel-next-top-vertical"><span>next</span></a>
                    <a style="cursor:pointer;" id="ui-carousel-prev-top-vertical"><span>prev</span></a>
                     <?php } } ?>
                </div>                    


<?php if($top_worker) { if(count($top_worker)>3) { ?>
		<script type="text/javascript">
			jQuery(function($) {

				jQuery("#carousel-top-vertical").rcarouselT({
					orientation: "vertical",
					visible: <?php if($top_worker) { if(count($top_worker)>3) { ?>3<?php } else { ?>1<?php } } else { ?>1<?php } ?>
				});
		
				jQuery("#ui-carousel-next-top-vertical")
					.add("#ui-carousel-prev-top-vertical")
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
<?php } } ?>               
            </div>
        </div>    
   
  
    </li>
    <div class="clear"></div>
</ul>    





</div>