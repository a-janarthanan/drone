<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
	<div>
	<!--<div class="page-title mbot20">
		<h1 class="mleft15">Alerts(<?php echo get_user_unread_notification(); ?>)</h1>
	</div>-->
    <div class="red-subtitle top-red-subtitle">My Alerts (<?php echo get_user_unread_notification(); ?>)</div>
    	<div class="profile_back">
        <div class="container">
        <div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
        <div class="home-signpost-content home-signpost-content-new-section">
    	<div class="dbleft dbleft-main">
        
      
				<div class="marB30">
                    
                    <ul class="padli10 marT10 main-ij">
						<?php 
                        
                            if($result){
                                foreach($result as $res){
                                
                                    $act=$res->act;
									
									if($res->is_read == 1 ) { $color = '#000000;'; } else { $color = '#27668B;'; }
                                    
                                    $poster = $this->message_model->get_worker_details($res->poster_user_id);
                                    
									
									$user_image= base_url().'upload/no_image.png';
				 
								 if($poster->profile_image!='') {  
							
									if(file_exists(base_path().'upload/user/'.$poster->profile_image)) {
								
										$user_image=base_url().'upload/user/'.$poster->profile_image;
										
									}
									
								}
						
						
                                    switch ($act)
                                    {
							case 'newoffer': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>New offer has been posted on <strong class="colblue fsNorm">'.$res->task_name.'</strong> by <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'newmessage': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>New message from <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> on <strong class="colblue fsNorm">'.$res->task_name.'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'offeraccept': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>Your offer accepted by <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> on <strong class="colblue fsNorm">'.$res->task_name.'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'taskcomplete': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p><strong class="colblue fsNorm">'.$res->task_name.'</strong> has been marked completed by <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'taskfinish': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p><strong class="colblue fsNorm">'.$res->task_name.'</strong> is all finished by  <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'workerwallet': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>Payment for <strong class="colblue fsNorm">'.$res->task_name.'</strong> has been credited to your wallet</p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>';
							break;
							
							case 'taskdispute':  echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p><strong class="colblue fsNorm">'.$res->task_name.'</strong> has been disputed by  <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'newconversation': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>New Conversation message from <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> on <strong class="colblue fsNorm">'.$res->task_name.'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'taskdisputeconversation': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>New Dispute Conversation message from <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> on <strong class="colblue fsNorm">'.$res->task_name.'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							 
							    case 'taskassign': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>Your offer accepted on <strong>'.$res->task_name.'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
	break;

							
							
										  
							  	case 'taskwin': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>You won the dispute <strong>'.$res->task_name.'</strong>. Amount credited to your wallet.</p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 							
							break;
							
							case 'taskloss': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>You loss the dispute <strong>'.$res->task_name.'</strong>. Amount credited to <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 																	
							break;
							
							case 'taskcompromise': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p><strong>'.$res->task_name.'</strong> is compromised between Poster and Worker bee. Amount credited to your wallet. </p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 																	
							break;
							
							case 'taskresume': echo '<li>'.anchor('message/read/'.$res->message_id,'<div class="colgray fl user-pic-massage-db"><img src="'.$user_image.'" alt="" width="60" height="60" class="fl marR5" /><p>Your dispute task <strong>'.$res->task_name.'</strong> is resume.</p></div>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 																	
							break;
							 
							 
							 
							 

							
							default:
                                        
						
						
					}
                                
                                }
                            }
                        ?>
                    </ul>
                    <div class="clear"></div>
                </div>
      
		</div>
        </div>
        <div class="dbright-task dbright-task-main">
        <?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
        </div>
        <div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>



