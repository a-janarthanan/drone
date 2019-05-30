<script type="text/javascript" language="javascript">
	function gomain(x)
	{
		
		if(x == 'all')
		{
			window.location.href= '<?php echo base_url();?>dispute/list_dispute';
		}
	}
</script>

<div id="content">        
	<?php if($msg != ""){
            if($msg == "insert"){ $error = 'New Record has been added Successfully.';}
            if($msg == "update"){ $error = 'Record has been updated Successfully.';}
            if($msg == "delete"){ $error = 'Record has been deleted Successfully.';}
    ?>
        <div class="column full">
            <span class="message information"><strong><?php echo $error;?></strong></span>
        </div>
    <?php } ?>
	<div class="clear"></div>
	<div class="column full">
	
	<div class="box">		
		<div class="box themed_box">
		<h2 class="box-header">Dispute Manager </h2>
			
			<div class="box-content box-table">
            
            
            
			<table class="tablebox">
            
                <div id="topbar" style="border:#CCC solid 1px;">
                
                
                 <div style="float:left;">
                  <span class="tag tag-green">NOTE : </span> Click here to know "How dispute Work?" <a href="<?php echo base_url(); ?>dispute/how_its_work"  id="work_dispute" style="margin:0px; padding:0px;"><img src="<?php echo base_url();?>default/gfx/ques.png" border="0" /></a>
                   <script>
							jQuery("#work_dispute").fancybox();
						</script>
                     
                        
                      </div>
                      
                      
              

                 </div>

				<thead class="table-header">
					<tr> 
                        <th class="first tc">Task Name</th>   
                        <th>Poster Name</th>
                        <th>Runner Name</th>
                        <th>Task Price</th>                                    
                        <th>Final Price</th> 
                        <th>Dispute Date</th> 
                        <th>Dispute BY</th>
                        <th class="tc">Action</th>        
					</tr>
				</thead>
				
				<tbody class="openable-tbody">
				<?php
                    if($result)
                    {
                        $i=0;
                        foreach($result as $row)
                        {
							
                            if($i%2=="0")
                            {
                                $cl = "odd";	
                            }else{	
                                $cl = "even";	
                            }
                  ?>
					<tr class="<?php echo $cl; ?>">
                        <td class="tc"><?php echo anchor(front_base_url().'tasks/'.$row->task_url_name,ucfirst($row->task_name),' style="color:#004C7A;" target="_blank"'); ?></td>
                        <td>
							<?php 
								 echo get_user_name($row->user_id);
							?>
                        </td>
                        <td>
						<?php  
							$worker = $this->worker_model->view_worker_result($row->task_worker_id);
							echo '&nbsp;&nbsp;'.anchor(front_base_url().'user/'.$worker->profile_name,ucfirst($worker->first_name).' '.ucfirst(substr($worker->last_name,0,1)),' style="color:#004C7A;" target="_blank"');
								
						?>
                        </td> 
                        <td><?php echo $site_setting->currency_symbol.$row->task_price; ?></td>
                        <td><?php echo $site_setting->currency_symbol.$this->dispute_model->offer_price($row->task_worker_id,$row->task_id); ?></td>
                        <td><?php echo date($site_setting->date_time_format,strtotime($row->dispute_date)); ?></td>
                        
                        <td>
						<?php 
							$dispute_by = $this->dispute_model->get_first_dispute_comment($row->dispute_id);
							if($dispute_by){

								echo get_user_name($dispute_by->comment_post_user_id);
							}
						?>
                        </td>
                        <td>
                        <?php 
						$win_msg= 'Conversation';
						
							if($row->dispute_status == 2 &&  $row->win_user_id>0 && $row->dispute_win_type==1) {
								
									$win_msg= 'Win <i>"'.get_user_name($row->win_user_id).'"</i>';	
								}
								
								if($row->dispute_status == 2 &&  $row->win_user_id==0 && $row->dispute_win_type==2) {
									
									$win_msg=  'Partial Payment';
								}
							 
							 
							 
							if($row->dispute_status == 3 &&  $row->win_user_id==0 && $row->dispute_win_type==3) {
								
								
								$win_msg=  'Resumed';
								
							}
							
							
							echo anchor('dispute/conversation/'.$row->task_id,$win_msg,'class="button white" id="conversation_'.$row->task_id.'"');
							
							
						 ?>
                     	
                        </td>
                  	</tr>
				  <?php
                            $i++;
                        }
                    } else { ?>
                    <tr class="odd">
                   	 	<td colspan="8">No dispute has been added yet.</td>
                    </tr>
                   <?php }
					
					
                  ?>	
				</tbody>
			</table>
                <ul class="pagination">
					<?php echo $page_link; ?>
                </ul>
			</div>
		</div>
	</div>
</div>