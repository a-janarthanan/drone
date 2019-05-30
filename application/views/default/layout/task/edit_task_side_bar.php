<div class="mconright">
<?php $site_setting=site_setting(); ?>
<!--<div id="needhelp-ph">
	<div class="inside-subtitle inside-subtitle-12">More details for task </div>
    <div class="border-bot"></div>
</div>-->
<div id="right-panel-bg">
        <!--<div class="sofar LH18">
        
        	 	<div class="soleft" style="background:#FFFFFF;"><img src="<?php echo $category_image; ?>" alt="" width="48" height="40" /></div>
            
            <div class="soright">
            	<div id="lesf" ><a href="<?php echo base_url().'task/edit_task_top/'.$task_id;?>" id="various5" class="col unl"><?php echo $task_detail->category_name; ?></a></div>
                <?php if($task_detail->task_repeat==1) { ?>
                This Task repeats every <?php echo $task_detail->task_repeat_week; ?> weeks
                <?php } else { ?>
                <div>This Task does not repeat</div>
                <?php } ?>
                
            </div>
            <div class="clear"></div>
            
            <div><b>Assignment: </b> <a href="<?php echo base_url().'task/edit_task_top/'.$task_id;?>" id="various3" class="fpass">
            
           <?php if($task_detail->task_auto_assignment==2) { ?> 
           
           Let me review  </a> the Worker bee
           
            <?php } elseif($task_detail->task_auto_assignment==3) {?>
            
            <?php $worker_detail=$this->worker_model->get_worker_info($task_detail->task_assing_worker);
				
				echo 'Notify '. ucfirst($worker_detail->first_name).' '.ucfirst($worker_detail->last_name); ?> </a> first
            
            <?php } else { ?>
            
             Auto-assign </a> the Worker bee
            
            <?php } ?>
            
            </div>
            
			
       	  <span class="int" >For Worker bee> in <br/><?php echo ucfirst($task_detail->city_name); ?></span>
          <a href="<?php echo base_url().'task/edit_task_top/'.$task_id;?>" id="various4" class="fr chbg LH13">Change</a>
          <div class="clear"></div>
            
      </div>-->
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
		<div class="estim" style="color:#585858; float:left; width:100%; text-align:left; margin:0px 0 10px 0;font-size:20px;">Task needs to be done by</div>
            <div class="deadline" style="border-top: none;">
                <ul>
                    <!--<li id="hline" style="padding: 0;">
                        <div class="confi">
                           <div class="done-task"> I need this task done by :</div>
                           <div class="clear"></div>
                           <div id="cline1" class="done-task">
                            <span id="lesf" class="curpoint"><?php 
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
                        <div class="clear"></div>
                    </li>-->
                    <li id="sline" class="LH20" style="display:block; clear:both; padding:0px; margin-bottom:20px;" >
                        <!--<div class="dat" ></div>-->
                        <div class="confi">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="" style="float:left; clear:both;">
                                <tr>
                                  <tr>
                                    <td height="40px" style="color:#585858;">I need this Task done by</td>
                                    <td height="40px" style="color:#585858;">Please Select Time</td>
                                  </tr>	
                                </tr>
                                <tr>
                                    <td class="text-done-1" >
                                        <input type="text" class="form-control text-done select-width-4" name="task_end_day" id="task_end_day" value="<?php if($task_end_day) echo  date("d-m-Y", strtotime($task_end_day)) ?>">
                                </td>
                                <td class="text-done-1">
                                        <input type="text" class="form-control text-done select-width-4" name="task_end_time" id="task_end_time" value="<?php echo ($task_end_time!='')?$task_end_time:'' ?>">
                                </td>
                                  <!--<td>
                                  <select name="task_end_day" id="task_end_day" class="form-control" style="float: left; padding-left: 5px; width: 244px; border-color:#666;">
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
                                  </select><label style="float:left; padding:7px 1px 0 6px; color:#fff;">&nbsp;at&nbsp;</label>
                                  </td>
                                  <td>
                                  <select name="task_end_time" id="task_end_time" class="form-control" style="width:148px; float:left; padding-left: 5px; border-color:#666;" >
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
                              </td>-->
                                </tr>
                            </table>
                        </div>
                        <div class="clear"></div>
                    </li>
                </ul>
                <div class="clear"></div>
            </div> 
        </div>
        <div class="urgent-task">
        	<div class="check-boxes"><input type="checkbox" name="task_urgent" value='1' <?php if($task_detail->task_urgent=="1") { ?> checked="check" <?php } ?>/></div>
            <div class="urgent-task-1"><div class="Urgent-title">Urgent</div></div>
            <div class="urgent-task-detail">I want my project to be marked as an urgent project ( For task to be done directly )</div>
        </div>
        
        </div>
		  <script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/jquery.timepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().getThemeName(); ?>/css/jquery.timepicker.css" />
        <script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/bootstrap-datepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().getThemeName(); ?>/css/bootstrap-datepicker.css" />
         <script>
                $(function() {
                    $('#task_end_time').timepicker();
                    $('#task_end_day').datepicker({
                        'format': 'd-m-yyyy',
                        'todayBtn':true,
                        'todayHighlight':true,
                        'autoclose': false
                    });
                });
		</script>