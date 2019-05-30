<div class="main">
<div class="incon">
    	<div class="mconleft">
        
      <div id="s1postJ" class="padB10 enri">Alerts(<?php echo get_user_unread_notification(); ?>)</div>
				<div class="marB30">
                    
                    <ul class="padli10 marT10">
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
							case 'newoffer': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />New offer has been posted on <strong class="colblue fsNorm">'.$res->task_name.'</strong> by <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'newmessage': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />New message from <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> on <strong class="colblue fsNorm">'.$res->task_name.'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'offeraccept': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />Your offer accepted by <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> on <strong class="colblue fsNorm">'.$res->task_name.'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'taskcomplete': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" /><strong class="colblue fsNorm">'.$res->task_name.'</strong> has been marked completed by <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'taskfinish': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" /><strong class="colblue fsNorm">'.$res->task_name.'</strong> is all finished by  <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'workerwallet': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />Payment for <strong class="colblue fsNorm">'.$res->task_name.'</strong> has been credited to your wallet</p>','style="color:'.$color.'"').'<div class="clear"></div></li>';
							break;
							
							case 'taskdispute':  echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" /><strong class="colblue fsNorm">'.$res->task_name.'</strong> has been disputed by  <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'newconversation': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />New Conversation message from <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> on <strong class="colblue fsNorm">'.$res->task_name.'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							
							case 'taskdisputeconversation': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />New Dispute Conversation message from <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong> on <strong class="colblue fsNorm">'.$res->task_name.'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
							break;
							 
							    case 'taskassign': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />Your offer accepted on <strong>'.$res->task_name.'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 
	break;

							
							
										  
							  	case 'taskwin': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />You won the dispute <strong>'.$res->task_name.'</strong>. Amount credited to your wallet.</p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 							
							break;
							
							case 'taskloss': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />You loss the dispute <strong>'.$res->task_name.'</strong>. Amount credited to <strong class="colblue fsNorm">'.$poster->first_name.' '.substr($poster->last_name,0,1).'</strong></p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 																	
							break;
							
							case 'taskcompromise': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" /><strong>'.$res->task_name.'</strong> is compromised between Poster and Runner. Amount credited to your wallet. </p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 																	
							break;
							
							case 'taskresume': echo '<li>'.anchor('message/read/'.$res->message_id,'<p class="geo colgray fl"><img src="'.$user_image.'" alt="" width="40" height="40" class="fl marR5" />Your dispute task <strong>'.$res->task_name.'</strong> is resume.</p>','style="color:'.$color.'"').'<div class="clear"></div></li>'; 																	
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
        <?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
        <div class="clear"></div>
    </div>
</div>



