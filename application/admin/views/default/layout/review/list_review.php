<script type="text/javascript" language="javascript">
	function delete_rec(id,offset)
	{
		var ans = confirm("Are you sure to delete Review Comment?");
		if(ans)
		{
			location.href = "<?php echo base_url(); ?>review/delete_review/"+id+"/"+offset;
		}else{
			return false;
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
		<h2 class="box-header">Tasks </h2>
			
			<div class="box-content box-table">
			<table class="tablebox" >
               

				<thead class="table-header"  >
					<tr> 
                        <th class="first tc">TaskName</th> 
                        <th>Price</th>
                        <th>Category</th> 
                      	<th>Message</th>                              
                        <th>Post User</th>
                        <th>To User</th>  
                        <th>Runner's Rate</th>
                        <th>Posted On</th> 
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
                        <td class="tc" style="text-align:left;"><?php echo anchor(front_base_url().'tasks/'.$row->task_url_name,ucfirst($row->task_name),' style="color:#004C7A;" target="_blank"'); ?></td>    
                        <td><?php echo $site_setting->currency_symbol.$row->task_price; ?></td>
                        <td><?php echo get_category_name($row->task_category_id); ?></td>  
                        <td style="text-align:left;"><?php echo $row->task_comment;?> </td>
                        <td><?php echo get_user_name($row->comment_post_user_id);?> </td>
                        <td><?php echo get_user_name($row->comment_to_user_id);?> </td>
                        <td>
						   <?php $comment_rate = $row->comment_rate;
                                if($comment_rate==1) { echo 'Poor'; }
                                elseif($comment_rate==2) { echo 'Fair'; }
                                elseif($comment_rate==3) { echo 'Average'; }
                                elseif($comment_rate==4) { echo 'Very Good'; }           
                                elseif($comment_rate==5) { echo 'Excellent'; }
                            ?> 
                        </td>
                        
                        
                        <td><?php echo date($site_setting->date_time_format,strtotime($row->comment_date)); ?></td>
                        <td>
                        	<?php echo anchor('review/edit_review/'.$row->task_comment_id.'/'.$offset,'<span class="icon_single edit"></span>','class="button white" id="review_'.$row->task_comment_id.'" title="Edit Revier"'); ?>
							<a href="#" onClick="delete_rec('<?php echo $row->task_comment_id; ?>','<?php echo $offset; ?>')" class="button white" title="Delete Revier"><span class="icon_single cancel"></span></a>
                        </td>
                        
                        	
                  	</tr>
				  <?php
                            $i++;
                        }
                    } else {
				  ?>        
								  
                  	<tr class="alter">
                    	<td colspan="15" align="center" valign="middle" height="30">No Review has been added yet.</td>
                    </tr>
                  
                  <?php } ?> 
                  
				</tbody>
			</table>
            <ul class="pagination">
            	<?php echo $page_link;?>
            </ul>
           
			</div>
		</div>
	</div>
</div>