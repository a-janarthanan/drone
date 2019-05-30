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
		 
    	<div class="db-rightinfo-dash">
        <div class="container">
        	<div class="red-subtitle">Bud från Entoworkers</div>
        <div class="home-signpost-content dashboard-box1 dashboard-box1-1">
        <div class=""> 
    	<div class="dbleft dbleft-offer" style="padding:0px 0px 0 0px; width:100%; border:0; margin-left:0px; background:#fff;">
        	<div class="left-part-1">
            	<div class="top-name">
                    <?php
                    //echo "<pre>";print_r($task_detail);echo "</pre>";
                    ?>
                	<div class="top-task-name"><?php echo ucfirst($task_detail->task_name);?></div>
                    <div class="top-date">Date : <?php echo date("H:i d/m-Y"); ?></div>
                </div>
                <div class="top-detai">
                    <div class="inside-subtitle" style="text-align:center;"><?php echo $this->task_model->count_total_offer_on_task($task_detail->task_id); ?> Bud</div>
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
                                                        <div class="strmn"><div class="str_sel str_sel-2 fl" style="width:<?php if($total_rate>5) { ?>100<?php } else { echo round($total_rate*2);?>0<?php } ?>0%;"></div></div>
                                                        <div class="fl fs14" style="color:#881926;"><?php echo $total_rate; ?>/5(<?php echo anchor('user/'.$row->profile_name.'/reviews',$total_review.' Omd.','class="fpass" style="color:#881926;"');  ?>)</div>
                                                    </td>
                                                    
                                                    <td>
                                                        <span class="colmark-2 colmark-2-inner" style="width:auto; text-align:right; padding-top:0px;">Bud: <b>
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
                	<p>Vänligen välj Entoworker från den vänstra panelen. Klicka på den röda bocken för att välja!</p>
                </div>
                <div class="detail-box detail-box-159">
                	<div style="text-align:center; padding-top:0px; margin-bottom:15px;" class="inside-subtitle">Detaljer</div>
                    <div class="task-details-info">
                    	<div class="task-details-info-left">Uppdragsgivare</div>
                        <div class="task-details-info-right"><?php $epmname=$this->user_model->get_user_info($task_detail->user_id); echo ucfirst($epmname->first_name).' '.ucfirst($epmname->last_name)?></div>
                    </div>
                    <div class="task-details-info">
                    	<div class="task-details-info-left">Uppdrag</div>
                        <div class="task-details-info-right"><?php echo ucfirst($task_detail->task_name);?></div>
                    </div>
                    <div class="task-details-info">
                    	<div class="task-details-info-left">Tid</div>
                        <div class="task-details-info-right"><?php echo $task_detail->task_post_date;?></div>
                    </div>
                    <div class="task-details-info">
                    	<div class="task-details-info-left">Sluttid</div>
                        <div class="task-details-info-right"><?php echo $task_detail->task_end_time;?></div>
                    </div>
                    <div class="task-details-info">
                    	<div class="task-details-info-left">Betalning</div>
                        <div class="task-details-info-right">SEK <?php echo $task_detail->task_to_price;?> To SEK <?php echo $task_detail->task_price;?></div>
                    </div>
                    <div class="task-details-info">
                    	<div class="task-details-info-left">Område</div>
                        <div class="task-details-info-right"><?php echo $task_detail->city_name;?></div>
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