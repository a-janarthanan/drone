<div class="mconright">
<?php $site_setting=site_setting(); ?>
            	<div class="estim marB5">Your Task So Far</div>
        <div class="sofar LH18">
        
        	 	<div class="soleft" style="background:#FFFFFF;"><img src="<?php echo $category_image; ?>" alt="" width="48" height="40" /></div>
            
            <div class="soright">
            	<div id="lesf" ><a href="<?php echo base_url().'task/update_task_step_zero/'.$task_id;?>" id="various5" class="col unl"><?php echo $task_detail->category_name; ?></a></div>
                <?php if($task_detail->task_repeat==1) { ?>
                This Task repeats every <?php echo $task_detail->task_repeat_week; ?> weeks
                <?php } else { ?>
                <div>This Task does not repeat</div>
                <?php } ?>
                
            </div>
            <div class="clear"></div>
            
            <div><b>Assignment: </b> <a href="<?php echo base_url().'task/update_task_step_zero/'.$task_id;?>" id="various3" class="fpass">
            
           <?php if($task_detail->task_auto_assignment==2) { ?> 
           
           Let me review  </a> the Runner
           
            <?php } elseif($task_detail->task_auto_assignment==3) {?>
            
            <?php $worker_detail=$this->worker_model->get_worker_info($task_detail->task_assing_worker);
				
				echo 'Notify '. ucfirst($worker_detail->first_name).' '.ucfirst($worker_detail->last_name); ?> </a> first
            
            <?php } else { ?>
            
             Auto-assign </a> the Runner
            
            <?php } ?>
            
            </div>
            
			
       	  <span class="int" >For Runner in <br/><?php echo ucfirst($task_detail->city_name); ?></span>
          <a href="<?php echo base_url().'task/update_task_step_zero/'.$task_id;?>" id="various4" class="fr chbg LH13">Change</a>
          <div class="clear"></div>
            
      </div>
   		
        
        <?php
		
		$post_date=date('Y-m-d H:i:s');
		
		$city_detail=get_cityDetail($task_detail->task_city_id);
		
		if($city_detail)
		{	
			$dateTime = new DateTime("now", new DateTimeZone('America/Los_Angeles'));	 
			$task_timezone=tzOffsetToName($city_detail->city_timezone);			
			$dateTimeZone = new DateTimeZone($task_timezone);
			date_default_timezone_set($task_timezone);
			$post_date= $dateTime->format("Y-m-d H:i:s");
			
		}
		
		
		?>
		<div class="estim">Deadline:</div>
     
  		<div class="deadline">
   	  <ul>
            	<li id="hline" >
      	        	<div class="dat" ></div>

                    <div class="confi">
                        I need this task done by<br/><div id="cline1">
                        <span id="lesf" class="col fs12 curpoint"><?php 
						if($task_end_day>0)
						{
						echo date('l',strtotime("+".$task_end_day." days"));
						}
						else
						{
							echo date('l');
						}
						 ?> at                       
                        <?php $total_hours=4;
						
						
						
						if($task_start_time>0) 
						{
							$current_hour_minute=$task_start_time;
						}
						else
						{
						 	$current_hour_minute=date('H')*60;
						}
						 
						 if($task_end_time>0)
						 {
						 	$add_hour_minute=$task_end_time;
						 }
						 else
						 {						 
						 	$add_hour_minute=date('H',strtotime("+".$total_hours." hours"))*60;
						 }
						
						 $added_hour=date('h A',strtotime("+".$total_hours." hours"));
						
						 	$check_minute=date('H',strtotime("+".$total_hours." hours"))*60; 
						
						if($task_end_time!=$check_minute && $task_end_time!='' && $task_end_time!=0)
						{		
							echo date('h A',mktime(0,$task_end_time,0,0,0,0));			
						}
						else 
						{
							echo $added_hour;							
						}
						
						?> </span></div>
                    </div>
					<a href="#" class="fr marR5 chbg" id="cline">Change</a>
                    <div class="clear"></div>
                </li>
                <li id="sline" class="LH20" style="display:none;" >
               		<div class="dat" ></div>
                    <div class="confi">
                   	  

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="">
	<tr>
    	<td colspan="2">I need a confirmed <?php echo $site_setting->site_name;?> by</td>
    </tr>
  <tr>
    <td>
    <select name="task_start_day" id="task_start_day" >
		<option value="0" <?php if($task_start_day==0) { ?>selected="selected" <?php } ?>>Today</option>
		<option value="1" <?php if($task_start_day==1) { ?>selected="selected" <?php } ?>>Tomorrow</option>
		<option value="2" <?php if($task_start_day==2) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+2 days"));?></option>
		<option value="3" <?php if($task_start_day==3) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+3 days"));?></option>
		<option value="4" <?php if($task_start_day==4) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+4 days"));?></option>
		<option value="5" <?php if($task_start_day==5) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+5 days"));?></option>
		<option value="6" <?php if($task_start_day==6) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+6 days"));?></option>
		<option value="7" <?php if($task_start_day==7) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+7 days"));?></option>
		<option value="8" <?php if($task_start_day==8) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+8 days"));?></option>
		<option value="9" <?php if($task_start_day==9) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+9 days"));?></option>
		<option value="10" <?php if($task_start_day==10) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+10 days"));?></option>
		<option value="11" <?php if($task_start_day==11) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+11 days"));?></option>
		<option value="12" <?php if($task_start_day==12) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+12 days"));?></option>
		<option value="13" <?php if($task_start_day==13) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+13 days"));?></option>
		<option value="14" <?php if($task_start_day==14) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+14 days"));?></option>
</select>&nbsp;at&nbsp;</td>
    
    <td><select name="task_start_time" id="task_start_time" >
    
    
		  <option value="60" <?php if($current_hour_minute==60) { ?> selected="selected" <?php } ?>>1 am</option>
		  <option value="120" <?php if($current_hour_minute==120) { ?> selected="selected" <?php } ?>>2 am</option>
		  <option value="180" <?php if($current_hour_minute==180) { ?> selected="selected" <?php } ?>>3 am</option>
		  <option value="240" <?php if($current_hour_minute==240) { ?> selected="selected" <?php } ?>>4 am</option>
		  <option value="300" <?php if($current_hour_minute==300) { ?> selected="selected" <?php } ?>>5 am</option>
		  <option value="360" <?php if($current_hour_minute==360) { ?> selected="selected" <?php } ?>>6 am</option>
		  <option value="420" <?php if($current_hour_minute==420) { ?> selected="selected" <?php } ?>>7 am</option>
		  <option value="480" <?php if($current_hour_minute==480) { ?> selected="selected" <?php } ?>>8 am</option>
		  <option value="540" <?php if($current_hour_minute==540) { ?> selected="selected" <?php } ?>>9 am</option>
		  <option value="600" <?php if($current_hour_minute==600) { ?> selected="selected" <?php } ?>>10 am</option>
		  <option value="660" <?php if($current_hour_minute==660) { ?> selected="selected" <?php } ?>>11 am</option>
		  <option value="720" <?php if($current_hour_minute==720) { ?> selected="selected" <?php } ?>>noon</option>
		  <option value="780" <?php if($current_hour_minute==780) { ?> selected="selected" <?php } ?>>1 pm</option>
		  <option value="840" <?php if($current_hour_minute==840) { ?> selected="selected" <?php } ?>>2 pm</option>
		  <option value="900" <?php if($current_hour_minute==900) { ?> selected="selected" <?php } ?>>3 pm</option>
		  <option value="960" <?php if($current_hour_minute==960) { ?> selected="selected" <?php } ?>>4 pm</option>
		  <option value="1020" <?php if($current_hour_minute==1020) { ?> selected="selected" <?php } ?>>5 pm</option>
		  <option value="1080" <?php if($current_hour_minute==1080) { ?> selected="selected" <?php } ?>>6 pm</option>
		  <option value="1140" <?php if($current_hour_minute==1140) { ?> selected="selected" <?php } ?>>7 pm</option>
		  <option value="1200" <?php if($current_hour_minute==1200) { ?> selected="selected" <?php } ?>>8 pm</option>
		  <option value="1260" <?php if($current_hour_minute==1260) { ?> selected="selected" <?php } ?>>9 pm</option>
		  <option value="1320" <?php if($current_hour_minute==1320) { ?> selected="selected" <?php } ?>>10 pm</option>
		  <option value="1380" <?php if($current_hour_minute==1380) { ?> selected="selected" <?php } ?>>11 pm</option>
		  <option value="1440" <?php if($current_hour_minute==1440) { ?> selected="selected" <?php } ?>>midnight</option>
          
          
    </select></td>
  </tr>
  <tr>
  	<td colspan="2">I need this Task done by</td>
  </tr>
  <tr>
  	<td>
    <select name="task_end_day" id="task_end_day" class="">
		<option value="0" <?php if($task_end_day==0) { ?>selected="selected" <?php } ?>>Today</option>
		<option value="1" <?php if($task_end_day==1) { ?>selected="selected" <?php } ?>>Tomorrow</option>
		<option value="2" <?php if($task_end_day==2) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+2 days"));?></option>
		<option value="3" <?php if($task_end_day==3) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+3 days"));?></option>
		<option value="4" <?php if($task_end_day==4) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+4 days"));?></option>
		<option value="5" <?php if($task_end_day==5) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+5 days"));?></option>
		<option value="6" <?php if($task_end_day==6) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+6 days"));?></option>
		<option value="7" <?php if($task_end_day==7) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+7 days"));?></option>
		<option value="8" <?php if($task_end_day==8) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+8 days"));?></option>
		<option value="9" <?php if($task_end_day==9) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+9 days"));?></option>
		<option value="10" <?php if($task_end_day==10) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+10 days"));?></option>
		<option value="11" <?php if($task_end_day==11) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+11 days"));?></option>
		<option value="12" <?php if($task_end_day==12) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+12 days"));?></option>
		<option value="13" <?php if($task_end_day==13) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+13 days"));?></option>
		<option value="14" <?php if($task_end_day==14) { ?>selected="selected" <?php } ?>><?php echo date('l, M d',strtotime("+14 days"));?></option>
	</select>&nbsp;at&nbsp;
    </td>
    <td>
    <select name="task_end_time" id="task_end_time" class="">
         <option value="60" <?php if($add_hour_minute==60) { ?> selected="selected" <?php } ?>>1 am</option>
		  <option value="120" <?php if($add_hour_minute==120) { ?> selected="selected" <?php } ?>>2 am</option>
		  <option value="180" <?php if($add_hour_minute==180) { ?> selected="selected" <?php } ?>>3 am</option>
		  <option value="240" <?php if($add_hour_minute==240) { ?> selected="selected" <?php } ?>>4 am</option>
		  <option value="300" <?php if($add_hour_minute==300) { ?> selected="selected" <?php } ?>>5 am</option>
		  <option value="360" <?php if($add_hour_minute==360) { ?> selected="selected" <?php } ?>>6 am</option>
		  <option value="420" <?php if($add_hour_minute==420) { ?> selected="selected" <?php } ?>>7 am</option>
		  <option value="480" <?php if($add_hour_minute==480) { ?> selected="selected" <?php } ?>>8 am</option>
		  <option value="540" <?php if($add_hour_minute==540) { ?> selected="selected" <?php } ?>>9 am</option>
		  <option value="600" <?php if($add_hour_minute==600) { ?> selected="selected" <?php } ?>>10 am</option>
		  <option value="660" <?php if($add_hour_minute==660) { ?> selected="selected" <?php } ?>>11 am</option>
		  <option value="720" <?php if($add_hour_minute==720) { ?> selected="selected" <?php } ?>>noon</option>
		  <option value="780" <?php if($add_hour_minute==780) { ?> selected="selected" <?php } ?>>1 pm</option>
		  <option value="840" <?php if($add_hour_minute==840) { ?> selected="selected" <?php } ?>>2 pm</option>
		  <option value="900" <?php if($add_hour_minute==900) { ?> selected="selected" <?php } ?>>3 pm</option>
		  <option value="960" <?php if($add_hour_minute==960) { ?> selected="selected" <?php } ?>>4 pm</option>
		  <option value="1020" <?php if($add_hour_minute==1020) { ?> selected="selected" <?php } ?>>5 pm</option>
		  <option value="1080" <?php if($add_hour_minute==1080) { ?> selected="selected" <?php } ?>>6 pm</option>
		  <option value="1140" <?php if($add_hour_minute==1140) { ?> selected="selected" <?php } ?>>7 pm</option>
		  <option value="1200" <?php if($add_hour_minute==1200) { ?> selected="selected" <?php } ?>>8 pm</option>
		  <option value="1260" <?php if($add_hour_minute==1260) { ?> selected="selected" <?php } ?>>9 pm</option>
		  <option value="1320" <?php if($add_hour_minute==1320) { ?> selected="selected" <?php } ?>>10 pm</option>
		  <option value="1380" <?php if($add_hour_minute==1380) { ?> selected="selected" <?php } ?>>11 pm</option>
		  <option value="1440" <?php if($add_hour_minute==1440) { ?> selected="selected" <?php } ?>>midnight</option>
	</select>
</td>
  </tr>
  
</table>
                  </div>
                    <div class="clear"></div>
           
                 
                    
        </li>
            </ul>
            <div class="clear"></div>
        </div> 
   
   		<div class="estim">More details:</div>
   		<div class="morede borbotno">
          <ul>
           <li class="posrel">     
              <label class="fl" >
                <input type="checkbox" name="task_is_private" value="1" id="task_is_private" <?php if($task_is_private==1) { ?> checked="checked" <?php } ?> />
                This Task is Private</label>
                <a href="javascript:void();" id="mdprivate" class="fl marL5"><div class="questions"></div></a>
            	<div class="clear"></div>
                
                <div id="dialog-form-mdprivate">
                    <h3 class="fl">Private Tasks</h3>
                    <a href="javascript:void();" class="fr" id="closemdprivate" title="close" ><div class="closebg" ></div></a><div class="clear"></div>
                    <p class="padTB5">Your Task will be visible only to <?php echo $site_setting->site_name;?>.</p>
                </div>
                
            </li>
            <li>
              <label>
                <input type="checkbox" name="task_large_vehicals" value="1" id="task_large_vehicals" <?php if($task_large_vehicals==1) { ?> checked="checked" <?php } ?>  />
                Task requires a large truck/SUV</label>
           </li>
           
           
            <li>
              <label>
                <input type="checkbox" name="task_online" value="1" id="task_online" <?php if($task_online==1) { ?> checked="checked" <?php } ?> />
                This Task can be completed remotely</label>
           </li>
           
           
           </ul> 
   		</div>
   
   
	
     <!--   <div class="estim">Task Examples:</div>
		<div class="morede borbotno">
          <ul>
           <li>     
                <table width="100%" border="0" cellspacing="1" cellpadding="0">
                  <tr>
                    <td width="24%"><a href="#"><img src="<?php //echo base_url().getThemeName(); ?>/images/ori_mac.jpg" width="50" height="50" alt="" /></a></td>
                    <td width="76%"><a href="#" class="fpass"><b>$117</b></a><br/>Handyman</td>
                  </tr>
                </table>
            </li>
            <li>
                <table width="100%" border="0" cellspacing="1" cellpadding="0">
                  <tr>
                    <td width="24%"><a href="#"><img src="<?php //echo base_url().getThemeName(); ?>/images/ori_mac.jpg" width="50" height="50" alt="" /></a></td>
                    <td width="76%"><a href="#" class="fpass"><b>$13</b></a><br/>South End Lunch Delivery</td>
                  </tr>
                </table>
           </li>
           </ul> 
   		</div>        
        
-->
        
        </div>