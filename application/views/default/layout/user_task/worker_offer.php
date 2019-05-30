<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<style>
	
.ultaskers li {
    border-bottom: 1px solid #565656;
    padding: 10px 0;
}
</style>
<div>
	<div id="two-columnar-section" class="top-cont-main-dash">
    <div class="red-subtitle top-red-subtitle">Worker Offer</div>
		 
    	<div class="db-rightinfo-dash">
        <div class="container">
        <div class="home-signpost-content dashboard-box1 dashboard-box1-1">
        <div class=""> 
    	<div class="dbleft dbleft-offer" style="padding:0px 0px 0 0px; width:100%; border:0; margin-left:0px; border-radius:10px; background:#fff;">
        	<div class="left-part-1">
            	<div class="top-name">
                    <?php
                    //echo "<pre>";print_r($task_detail);echo "</pre>";
                    ?>
                	<div class="top-task-name"><?php echo ucfirst($task_detail->task_name);?></div>
                    <div class="top-date">Date : <?php echo date("H:i d/m-Y"); ?></div>
                </div>
                <div class="top-detai">
                    <div class="inside-subtitle" style="text-align:center;"><?php echo $this->task_model->count_total_offer_on_task($task_detail->task_id); ?> Offers</div>
                    <div class="offer-data">
                        <ul class="ulsty">
                            <?php 
                                if($result) {  
                                    foreach($result as $row) {  
                                        $user_detail=$this->user_model->get_user_profile_by_id($row->user_id);
                                        $user_image= base_url().'upload/no_image.png';
                                        if($user_detail->profile_image!='') {  
                                            if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
                                                $user_image=base_url().'upload/user/'.$user_detail->profile_image;
                                            }
                                        }
                                    ?>
                                    <li class="posrel">
                                        <div class="taskphoto taskphoto-2 taskphoto-2-3" style="float:left; text-align:center;">
                                            <?php echo anchor('user/'.$row->profile_name,'<img src="'.$user_image.'" alt="" width="50" height="50" class="round-corner-2 border-img" />'); ?>
                                        </div>
                                        
                                        <div class="taskdetails">
                                            <table width="100%" border="0" cellspacing="1" cellpadding="0">
                                                <tr>
                                                    <td width="22%" class="" style="padding-bottom:3px;">
                                                        <?php echo anchor('user/'.$row->profile_name,ucfirst($row->first_name).' '.ucfirst(substr($row->last_name,0,1)).'.',' class="abmarks abmarks-2 unl" ');?>    
                                                    </td>
                                                    <td width="45%" align="right">
                                                        <div class="hire_me">
                                                        	<?php echo anchor('user_task/conversation/'.$row->worker_id.'/'.$row->task_id,'Award Task','class="btn btn-default btn-award"'); ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40%" style="padding-bottom:5px;">
                                                        <?php 
                                                        
                                                            $total_rate=get_user_total_rate($row->user_id);
                                                
                                                        $total_review=get_user_total_review($row->user_id);
                                                        
                                                         ?>
                                                        <div class="strmn fl"><div class="str_sel str_sel-2 fl" style="width:<?php if($total_rate>5) { ?>100<?php } else { echo round($total_rate*2);?>0<?php } ?>0%;"></div></div>
                                                        <div class="fl fs14" style="color:#ec6600;"><?php echo $total_rate; ?>/5(<?php echo anchor('user/'.$row->profile_name.'/reviews',$total_review.' reviews','class="fpass" style="color:#ec6600;"');  ?>)</div>
                                                    </td>
                                                    
                                                    <td align="right">
                                                        <span class="colmark-2 colmark-2-inner" style="width:auto; text-align:right; padding-top:0px;">Offer Price <br /> <b>
                                                            <?php 
                                                            $offfer_amount = $this->user_task_model->offer_price($row->worker_id, $row->task_id);
                                                                //$offfer_amount = $this->user_task_model->offer_price($row->comment_post_user_id, $row->task_id);
                                                                echo $site_setting->currency_symbol.$offfer_amount->offer_amount;
                                                            ?>
                                                        </b>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </table>
                                            
                                           <div class="clear"></div>
                                        </div>
                                        <div class="clear"></div>
                                    </li>
                                    <?php 
                                        }  
                                    } 
                                    ?>
                        </ul>
                        <?php if($total_rows>10) { ?>
                            <div class="gonext">
                            <?php echo $page_link; ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="right-part-1">
            	<div class="chat-box" style="text-align:center;">
                	<p>Please select tasker from left panel to initiate conversasation .</p>
                </div>
                <div class="detail-box detail-box-159">
                	<div style="background: #878787 none repeat scroll 0 0; border-bottom: 0 none; color: #fff; font-size: 30px; margin-bottom: 0; padding-bottom: 35px; padding-top: 35px; text-align: center; border-radius:0 10px 0 0;" class="inside-subtitle">Summary</div>
                    <div style="padding:0 10px 10px 10px;">
                        <div class="task-details-info">
                            <div class="task-details-info-left">Employer</div>
                            <div class="task-details-info-right"><?php $epmname=$this->user_model->get_user_info($task_detail->user_id); echo ucfirst($epmname->first_name).' '.ucfirst($epmname->last_name)?></div>
                        </div>
                        <div class="task-details-info">
                            <div class="task-details-info-left">Task</div>
                            <div class="task-details-info-right"><?php echo ucfirst($task_detail->task_name);?></div>
                        </div>
                        <div class="task-details-info">
                            <div class="task-details-info-left">Time</div>
                            <div class="task-details-info-right"><?php echo $task_detail->task_post_date;?></div>
                        </div>
                        <div class="task-details-info">
                            <div class="task-details-info-left">Ending Time</div>
                            <div class="task-details-info-right"><?php echo $task_detail->task_end_time;?></div>
                        </div>
                        <div class="task-details-info">
                            <div class="task-details-info-left">Offer Price</div>
                            <div class="task-details-info-right">COP <?php echo $task_detail->task_to_price;?> To COP <?php echo $task_detail->task_price;?></div>
                        </div>
                        <div class="task-details-info">
                            <div class="task-details-info-left">Location</div>
                            <div class="task-details-info-right"><?php echo $task_detail->city_name;?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        </div>
		<div class="clear"></div>

	</div>
    <div class="clear"></div>
</div>

</div>
</div>