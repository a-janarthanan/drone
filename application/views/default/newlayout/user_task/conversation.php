<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/lib/tooltip2.js"></script>
<script type="text/javascript">
	function disp()
	{
		var retVal = confirm("Do you want to continue ?");
		if( retVal == true ){
		window.location.href='<?php echo site_url('dispute/dispute_task/'.$task_id) ?>';
		}
	}
</script>
<style>
.abc{
	width:72px;
	float:left;
}
.offerbg {
float: right;
width: 90px;
color: #fff;
background-color: #f2413e;
padding: 7px 10px;
-webkit-border-radius: 6px;
-moz-border-radius: 6px;
border-radius: 6px;
border: medium none !important;
box-shadow: 0 3px 0 rgba(0, 0, 0, 0.2);
}
</style>
<script type="text/javascript">
function accept_offer() {
document.frm_new_comment.comment.value="I am awarding you task , lets start it.";    
document.frm_new_comment.accept1.value="Accept Offer";
document.getElementById('frm_new_comment').submit();
}
function check_form()
{
    if(document.frm_new_comment.comment.value="")
    {
        alert("Skriv kommentar");
        return false;
    }
}
</script>
<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
<div id="two-columnar-section" class="top-cont-main-dash">
    <div class="db-rightinfo-dash" style="background:#881926;">
    <div class="container">
        <!--<div class="red-subtitle">Konversation</div>-->
        <?php if($error!='') { ?>
			<div id="error"><ul><?php echo $error; ?></ul>
			</div>
		<?php } ?>
        <div class="home-signpost-content dashboard-box1-1" style="margin-top:40px;">
            <div class=""> 
                <div class="dbleft dbleft-offer" style="padding:0px 0px 0 0px; width:100%; border:0; margin-left:0px; background:#fff;">
                    <div class="left-part-1">
                        <div class="top-detai">
                            <div class="top-task-name"><?php echo ucfirst($task_detail->task_name);?></div>
                            <div class="offer-data offer-data-con">
                                <ul class="ulsty">
                                    <?php 
                                        //echo "<pre>";print_r($result_new);echo "</pre>";
                                        if($result_new) {  
                                            foreach($result_new as $row) {  
                                                $user_detail=$this->user_model->get_user_profile_by_id($row->user_id);
                                                $user_image= base_url().'upload/no_image.png';
                                                if($user_detail->profile_image!='') {  
                                                    if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
                                                        $user_image=base_url().'upload/user/'.$user_detail->profile_image;
                                                    }
                                                }
                                            ?>
                                            <li class="posrel posrel-conv">
                                                <div class="taskphoto taskphoto-2 taskphoto-2-3 taskphoto-conv" style="float:left; text-align:center;">
                                                    <?php echo anchor('user/'.$row->profile_name,'<img src="'.$user_image.'" alt="" width="40" height="40" class="round-corner-2 border-img-cov" />'); ?>
                                                </div>
                                                
                                                <div class="taskdetails">
                                                    <table width="100%" border="0" cellspacing="1" cellpadding="0">
                                                        <tr>
                                                            <td width="22%" class=""  style="padding-bottom:3px;" valign="top">
                                                                <?php echo anchor('user/'.$row->profile_name,ucfirst($row->first_name).' '.ucfirst(substr($row->last_name,0,1)).'.',' class="abmarks abmarks-2 abmarks-conv unl" ');?>    
                                                                <br />
                                                                <?php 
                                                                	$total_rate=get_user_total_rate($row->user_id);
                                                        			$total_review=get_user_total_review($row->user_id);
                                                                ?>
                                                                <div class="strmn"><div class="str_sel str_sel-2 fl" style="width:<?php if($total_rate>5) { ?>100<?php } else { echo round($total_rate*2);?>0<?php } ?>0%;"></div></div>
                                                                <!--<div class="fl fs14" style="color:#881926;"><?php echo $total_rate; ?>/5(<?php echo anchor('user/'.$row->profile_name.'/Omdömen',$total_review.' Omdömen','class="fpass" style="color:#881926;"');  ?>)</div>-->
                                                            </td>
                                                             <td width="30%" align="right" valign="top">
                                                                <span class="colmark-2 colmark-2-inner colmark-2-inner-conv" style="width:auto; text-align:right; padding-top:0px;">
                                                                	<b>
																		<?php 
                                                                        $offfer_amount = $this->user_task_model->offer_price($row->worker_id, $row->task_id);
                                                                            //$offfer_amount = $this->user_task_model->offer_price($row->comment_post_user_id, $row->task_id);
                                                                            echo $site_setting->currency_symbol." ".$offfer_amount->offer_amount;
                                                                        ?>
                                                                	</b>
                                                                </span>
                                                                
                                                                <div class="hire_me hire_me_conv">
                                                                <?php //echo $row->user_id;//echo anchor('user_task/conversation/'.$row->worker_id.'/'.$row->task_id,'Award Task','class="btn btn-default btn-award"'); ?>
                                                                
                                                                <a href="<?php echo base_url().'user_task/conversation/'.$row->worker_id.'/'.$row->task_id ?>" class="btn btn-default <?php if($row->worker_id==$this->uri->segment(3)) { ?>btn-crworker <?php } else { ?>btn-award <?php } ?>">Award Task</a>
    
                                                                </div>
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
                        <div class="chat-box chat-box-1">
                            <div class="top-image-user">
                                <div class="fl" style="text-align:center;font-size:15px;">
                                    <?php
                                    $epm=$this->user_model->get_user_profile_by_id($task_detail->user_id);
                                    //print_r($epm);
                                    $usernew_image= base_url().'upload/no_image.png';
                                                if($epm->profile_image!='') {  
                                                    if(file_exists(base_path().'upload/user/'.$epm->profile_image)) {
                                                        $usernew_image=base_url().'upload/user/'.$epm->profile_image;
                                                    }
                                                }
    
                                    ?>
    
                                    <a href="#"><div class="round-corner-2 border-img" style="height:100px; width:100px; overflow:hidden;"><img width="" height="100" class="" alt="" src="<?php echo $usernew_image ?>"></div></a>
                                        <?php echo $epm->first_name.' '.$epm->last_name; ?>
                               
        
                               
                                </div>
                                <div class="fl arrow_img"><a href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/right-left-arrow.png" alt="" width="65" /></a></div>
                                <div class="fr" style="text-align:center; font-size:15px;">
                                <?php if($worker_user_id)
                                      {
                                        $check_worker_detail=$this->user_model->get_user_profile_by_id($worker_user_id);
                        
                                        if($check_worker_detail) { 
                                            //print_r($check_worker_detail);
                                            $work_image= base_url().'upload/no_image.png';
                                                if($check_worker_detail->profile_image!='') {  
                                                    if(file_exists(base_path().'upload/user/'.$check_worker_detail->profile_image)) {
                                                        $work_image=base_url().'upload/user/'.$check_worker_detail->profile_image;
                                                    }
                                                }
                                ?>
                                        <a href="#"><div class="round-corner-2 border-img" style="height:100px; width:100px; overflow:hidden;"><img width="" height="100" class="" alt="" src="<?php echo $work_image ?>"></div></a>
                                        <?php echo $check_worker_detail->first_name.' '.$check_worker_detail->last_name; ?>
                               
        
                                <?php
                                         }
                                        }
                                ?>
    
                                    
                                </div>
                            </div>
                            <div class="detail-box-chat">
                                <div style="text-align:center; padding-top:0px; margin-bottom:15px;" class="inside-subtitle">Chatt</div>
                                <div class="chat_history">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                        <?php 
                                            foreach($result as $row) {
                                                $user_detail=$this->user_model->get_user_profile_by_id($row->comment_post_user_id);
                                                $user_image= base_url().'upload/no_image.png';
                                                if($user_detail->profile_image!='') {  
                                                    if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
                                                        $user_image=base_url().'upload/user/'.$user_detail->profile_image;
                                                    }
                                                }
                                        ?>
                                            <tr>
                                                <td class="user_name_in" valign="top">
                                                    <?php echo anchor('user/'.$user_detail->profile_name,'<img src="'.$user_image.'" alt="" width="50" height="50" class="round-corner-2 border-img" />');?>
                                                </td>
                                                <?php 
                                                    if($row->comment_post_user_id != get_authenticateUserID()) 
                                                    { 
                                                        $conbg =  'conbg1';
                                                    } else {
                                                        $conbg =  'conbg2';
                                                    }
                                                ?>
                                                <td class="user_message_in <?php echo $conbg;?>" valign="top">
                                                    <?php if($task_detail->task_activity_status == 1) { $is_accept = 1 ;} ?>
                                                    <?php echo $row->task_comment;?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                                <div>
                                         
                                <?php
                                $dispute = $this->dispute_model->check_dispute_task($task_id);
                                $dispute_status=0;
                                if($dispute)
                                {
                                    $dispute_status=1;
                                }
                                if($is_close != 3 && $dispute_status!=1) {
                                $attributes = array('name'=>'frm_new_comment','id'=>'frm_new_comment','class'=>'fdesign');
                                echo form_open('user_task/new_comment/'.$worker_id.'/'.$task_id,$attributes);
                                ?>  
                                    <ul class="padli10">
                                        <li>
                                            
                                            
                                            <div class="conbg3">
                                            
                                            
                                            <?php 
                                            
                                            $str='';
                                            
                                            if($task_detail->task_activity_status==2 && $task_detail->worker_agree==1) { 
                                            
                                            $task_setting=task_setting();
                                        
                                        $task_auto_complete_hour=$task_setting->task_auto_complete_hour;
                                        
                                        
                                            $task_timezone_date=date('Y-m-d H:i:s');
                                
                                        $city_detail=get_cityDetail($task_detail->task_city_id);
                                        
                                        if($city_detail)
                                        {	
                                            $dateTime = new DateTime("now", new DateTimeZone('America/Los_Angeles'));	 
                                            $task_timezone=tzOffsetToName($city_detail->city_timezone);			
                                            $dateTimeZone = new DateTimeZone($task_timezone);
                                            $dateTime->setTimezone($dateTimeZone); 
                                            $task_timezone_date= $dateTime->format("Y-m-d H:i:s");
                                            
                                        }
                                        
                                        
                                    
                                        
                                                
                                                $complete_date=$task_detail->task_complete_date;
                                                
                                                if($complete_date!='0000-00-00 00:00:00')
                                                {
                                                     $task_id=$task_detail->task_id;
                                                    
                                                
                                                      $auto_complete_date= date('Y-m-d h:i:s a',strtotime(date("Y-m-d H:i:s", strtotime($complete_date)) . " +".$task_auto_complete_hour." hours"));	
                                                
                                                
                                                //////////////
                                                
                                                
                                                
                                    
                                                
                                                
                                                
                                                $mid_date=getReverseDuration($task_timezone_date,$auto_complete_date);
                                                
                                                if($mid_date!='')
                                                {
                                                    $ex_time=explode('-',$mid_date);
                                                    
                                                    $str=$ex_time[0]." hour(s) ".$ex_time[1]." mim(s) ".$ex_time[2]." sec(s)";
                                                }
                                        
                                        
                                                
                                                /////////////////
                                                                                             
                                            }
                                                     
                                                     
                                                     
                                            if($worker_user_id)
                                            {
                                                 $check_worker_detail=$this->user_model->get_user_profile_by_id($worker_user_id);
                                                    
                                                    if($check_worker_detail) { 
                                                    ?>
                                                    
                                                
                                                     
                                         <p><?php echo anchor('user/'.$check_worker_detail->profile_name,ucfirst($check_worker_detail->first_name).' '.ucfirst(substr($check_worker_detail->last_name,0,1)),' class="dhan" ');?> marked this task completed. </p>
                                                    
                                                    <?php
                                                    }
                                            }
                                            
                                            ?>
                                            
                                          
                                            
                                            <?php } else { ?>
                                            
                                              <textarea name="comment" class="text_area_info"></textarea>
                                              
                                              
                                              <?php } ?>
                                              
                                              
                                              <?php 
                                                    $post_user_id =  $task_user_id;
                                                    $task_user = $worker_user_id;
                                              ?>
                                           
                                              <input type="hidden" id="accept1" name="accept1" class="chbg fl" value="">
                                              <input type="hidden" id="worker_id" name="worker_id" class="chbg fl" value="<?php echo $user_worker_id;?>">
                                              <input type="hidden" id="task_id" name="task_id" class="chbg fl" value="<?php echo $task_id;?>">
                                              <input type="hidden" id="post_user_id" name="post_user_id" class="chbg fl" value="<?php echo $post_user_id;?>">
                                              <input type="hidden" id="task_user" name="task_user" class="chbg fl" value="<?php echo $task_user;?>">
                                                <div class="marT10" style="padding-left:0px; padding-bottom:0px;">
                                                    <?php if($task_detail->task_activity_status!=2 && $task_detail->worker_agree!=1) {  ?>
                                                        <input type="submit" id="accept" name="accept" class="btn btn-default btn-category fr btn-category-2 marL5" style="font-size:13px;" value="Skicka meddelande">
                                                    <?php } ?>
                                                    <?php if($task_user_id == get_authenticateUserID()) { ?>
                                                   <?php
                                                   if(($task_detail->task_activity_status==1 || $task_detail->task_activity_status==2) || (($task_detail->worker_agree==0 || $task_detail->worker_agree==1) && $task_detail->task_activity_status==3) ) { ?>
                                                   
                                                   
                                                     <input type="button" id="complete" name="complete" class="btn btn-default btn-category btn-category-2 fr marL5" value="Complete Task" style="font-size:13px;" onclick="window.location.href='<?php echo site_url('user_task/complete/'.$task_id) ?>'">
                                                     
                                                     
                                                       
                                                   
                                                <?php  }   
                                                    ?>
                                                    <?php
                                                    if(($task_detail->task_activity_status==1) || (($task_detail->worker_agree==0 || $task_detail->worker_agree==1) && $task_detail->task_activity_status==2) ) { ?>
                                                
                                              <input type="button" id="complete" name="complete" class="btn btn-default btn-category btn-category-2 fr marL5" value="Dispute Task" style="font-size:13px;" onclick="disp();">
                                                  
                                                  <?php }  ?>
                                                    <?php if($str!='') { ?> <p style="float:left; clear:both; width:100%;padding-top:5px;"> <?php echo  $str; ?> Remaining to Complete or Dispute Task manually.</p> <?php } ?>
                                                  
                                                  
                                                  <?php }?>
                                                    
                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                        </li>
                                     </ul>
                                    </form>
                                <?php } ?>
                            </div>
                            </div>
                            
                        </div>
                        
                        <div class="detail-box">
                        <div style="text-align:center; padding-top:0px; margin-bottom:15px;" class="inside-subtitle">Details</div>
                        <div class="task-details-info">
                            <div class="task-details-info-left">Uppdragsgivare</div>
                            <div class="task-details-info-right"><?php $epmname=$this->user_model->get_user_info($task_detail->user_id); echo ucfirst($epmname->first_name).' '.ucfirst($epmname->last_name)?></div>
                        </div>
                        <div class="task-details-info">
                            <div class="task-details-info-left">Entoworker</div>
                            <div class="task-details-info-right"><?php echo $check_worker_detail->first_name.' '.$check_worker_detail->last_name; ?></div>
                        </div>
                        <div class="task-details-info">
                            <div class="task-details-info-left">Uppdrag</div>
                            <div class="task-details-info-right"><?php echo ucfirst($task_detail->task_name);?></div>
                        </div>
                        <div class="task-details-info">
                            <div class="task-details-info-left">Datum</div>
                            <div class="task-details-info-right"><?php echo $task_detail->task_post_date;?></div>
                        </div>
                        <div class="task-details-info">
                            <div class="task-details-info-left">Sluttid</div>
                            <div class="task-details-info-right"><?php echo $task_detail->task_end_time;?></div>
                        </div>
                        <div class="task-details-info">
                            <div class="task-details-info-left">Betalning</div>
                            <div class="task-details-info-right">SEK <?php $offfer_amount = $this->user_task_model->offer_price($user_worker_id, $task_id);
            echo $offfer_amount->offer_amount;?></div>
                        </div>
                        <div class="task-details-info">
                            <div class="task-details-info-left">Plats</div>
                            <div class="task-details-info-right"><?php echo $task_detail->city_name;?></div>
                        </div>
                        <div style="margin-top:15px;">
                                         
                                
                                                   <?php if($task_user_id == get_authenticateUserID()) {
                                                    if($is_accept != 1) { ?>
                                                        <input type="button" id="accept" name="accept" class="btn btn-default btn-category btn-category-2" value="Aktivera uppdrag" onclick="accept_offer();">
                                                    <?php } 
                                               }
                                               ?>
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