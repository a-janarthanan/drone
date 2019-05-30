<script type="text/javascript">
jQuery(document).ready(function() {	
	
	jQuery("#learnmore").fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});
	
  
});
function showtasker()
{
	
	/*if(document.showtask.sug.value=='1')
	{
			
			document.getElementById("showtask").submit();
	}
	else
	{*/
		location.href ="http://www.entowork.se/user_task/all_tasks";
	//}
}
</script>
<!--banner-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
<div>

 <div id="two-columnar-section" class="top-cont-main-dash">
 	<div class="db-rightinfo-dash">
        <div class="container">
        <div class="red-subtitle"><div class="count-number-1">4</div>Uppdraget är nu skapat!</div>
        <div class="home-signpost-content dashboard-box1 dashboard-box1-1">
		<?php
        $site_setting=site_setting();
         $data['task_detail']=$task_detail;
          $data['site_setting']=$site_setting;
        //print_r($task_detail);
        ?>
		<?php
            $attributes = array('id'=>'showtask','name'=>'showtask');
            echo form_open('task/relatedworker/'.$task_id,$attributes);
        ?>
		<input type="hidden" value="<?php echo $task_id;?>" id="task_id" name="task_id" />
    	<div class="dbleft" style="padding:0px 0px 0 0px; width:100%; border:0; margin-left:0px;">
            <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;" data-wow-delay="0.5s" class="span3 wow fadeIn animated">
                <div class="tabs1">
                	<div class="left-part" style="min-height:235px;">
                        <h2 class="colora">Äntligen! <br />Nu är uppdraget ute på Entowork. Snart kommer bud, så var aktiv på hemsidan och på mailen!</h2><br />
                        <div class="detail-infor">Uppdraget kan du kika på här: <strong><?php echo anchor('tasks/'.$task_detail->task_url_name,ucfirst($task_detail->task_name),'class="fpass"');?>.</strong></div>
                    
                <!--<div class="inside-subtitle" style="padding-top:20px;">What would you prefer ?</div>-->
                    <?php
                    $site_setting=site_setting();
                    $task_setting=task_setting();
                    $total=0;
                    if($task_detail->extra_cost>0) {
                    
                    $total=$total+$task_detail->extra_cost;
                    
                    }
                    
                    
                    
                
                 
                     $total=$total+$task_detail->task_price;
                     
                     
                     
                     if($task_setting->task_post_fee>0) {
                     
                     $task_site_fee=number_format((($task_setting->task_post_fee*$total) / 100),2); 
                
                         $total=$total+$task_site_fee;
                
                    }
                     
                     
                     $total=number_format($total,2);
                     
                     $wallet_amount=my_wallet_amount();
                    
                
                    
                    if($total>$wallet_amount)
                    {
                        ?>
                        <br>
            
                        <p><span class="colora"><b>Observera :</b></span> Ditt saldo är för lågt just nu. Vänligen överför  <b class="colora"><?php echo $site_setting->currency_symbol.$total;?></b> till ditt konto innan du anlitar en Entoworker.</p>
                        
                        <div class="marTB10" style="text-align:center; margin-bottom:30px;">
                            
                            <?php echo anchor('wallet/add_wallet','Gör insättning','class="btn btn-default btn-default-join btn-app"'); ?>
                        </div>
                      <?php 
                    }
                    
                    ?>
                       <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;" data-wow-delay="0.5s" class="span3 wow fadeIn animated">
                    <div>
                    
                     <?php
                     /*if($task_location)
                        {
                            foreach($task_location as $loc) 
                            {
                                
                                
                                
                                if($loc->user_location_id>0)
                                {
                                    
                                    $get_user_location=$this->user_model->get_user_location_detail($loc->user_location_id);
                                    
                                    if($get_user_location) 
                                    {
                                        $zipc=$get_user_location->location_zipcode;
                                    }
                                }
                            }
                        }*/
                        
                     $day_task= date('l',strtotime(date("Y-m-d", strtotime($task_detail->task_post_date)) . " +".$task_detail->task_start_day."days"));
                     $taskcatid=$task_detail->task_category_id;
                     $taskcity=$task_detail->task_city_id;
                     ?>
                     <input type="hidden" name="cat" value="<?php echo $taskcatid ?>" />
                     <input type="hidden" name="day_task" value="<?php echo $day_task ?>" />
                     <input type="hidden" name="taskcity" value="<?php echo $taskcity ?>" />
                        
                        <!--<p class="detail-infor"><input type="radio" name="sug" value="2" /><span style="margin-left:10px">I will select the best suited Tasker for the job</span></p></br>
                        <p style="padding-bottom:5px;" class="detail-infor"><input type="radio" name="sug" value="1" /><span style="margin-left:10px;">Let TASKIT suggest a Tasker for the job </span></p>-->
                        
                     </div>   
                </div>      
                    </div>
                    <div class="right-part">
            			<div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInRight;" data-wow-delay="0.5s" class="span3 wow fadeInRight animated dbright-task-1 dbright-task-13 dbright-task-132">               
                            <div class="dbright-task" style="margin-bottom:0px !important;">
                             <?php echo $this->load->view($theme.'/layout/task/step_pay_side_bar',$data); ?>  
                            </div>
                            <div class="clear"></div>
                            <div class="marT10" style="text-align:center; ">
                                <input type="button" name="btn" value="Klar" onclick="showtasker()" class="btn btn-default btn-default-join btn-default-join2 btn-app"/>
                            </div>
                        </div>        
                    </div>
                    <div class="clear"></div>
            	</div>
                <div class="clear"></div>
			</div>
            
        
        <div class="clear"></div>



    </div>
    	<div class="clear"></div>
</div>
  </div>
</div>
<link href="<?php echo base_url().getThemeName(); ?>/css/new_me.css" rel="stylesheet" type="text/css">


</section>