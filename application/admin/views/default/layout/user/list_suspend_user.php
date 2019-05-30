<script type="text/javascript" language="javascript">
	function delete_rec(id,offset)
	{
		var ans = confirm("Are you sure to delete user?");
		if(ans)
		{
			location.href = "<?php echo base_url(); ?>/user/delete_user/"+id+"/"+offset;
		}else{
			return false;
		}
	}
	
	function getlimit(limit)
	{
		if(limit=='0')
		{
		return false;
		}
		else
		{
			window.location.href='<?php echo base_url();?>user/list_active_user/'+limit;
		}
	
	}	
	
	function getsearchlimit(limit)
	{
		if(limit=='0')
		{
		return false;
		}
		else
		{
			
			window.location.href='<?php echo base_url();?>user/search_list_user/'+limit+'/<?php echo $option.'/'.$keyword; ?>';
		}
	
	}
	
	function gomain(x)
	{
		
		if(x == 'all')
		{
			window.location.href= '<?php echo base_url();?>user/list_user';
		}
	}
	function setaction(elename, actionval, actionmsg, formname) {
	vchkcnt=0;
	elem = document.getElementsByName(elename);
	
	for(i=0;i<elem.length;i++){
		if(elem[i].checked) vchkcnt++;	
	}
	if(vchkcnt==0) {
		alert('Please select a record')
	} else {
		
		if(confirm(actionmsg))
		{
			document.getElementById('action').value=actionval;	
			document.getElementById(formname).submit();
		}		
		
	}
}
</script>

<div id="content">        
	<?php if($msg != ""){
            if($msg == "insert"){ $error = 'New Record has been added Successfully.';}
            if($msg == "update"){ $error = 'Record has been updated Successfully.';}
            if($msg == "delete"){ $error = 'User has been deleted Successfully.';}
    ?>
        <div class="column full">
            <span class="message information"><strong><?php echo $error;?></strong></span>
        </div>
    <?php } ?>
	<div class="clear"></div>
	<div class="column full">
	
	<div class="box">		
		<div class="box themed_box">
		<h2 class="box-header">Suspend Poster </h2>
			
			<div class="box-content box-table">
			<table class="tablebox">

				<thead class="table-header">
					<tr> 
                    	<th class="first tc">User Name</th>
                        <th>Email</th> 
                        <th>Signup IP Address</th>                                    
                        <th>Zip Code</th>
                        <th>Active</th>
                        <th>UserTpye</th>
                        <th>Registerd On</th>
                        <th>View Detail</th>
                        <th>Conversation</th>
                        <th class="tc"></th>   
                       
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
                    
                     <td class="tc"><?php echo anchor(front_base_url().'user/'.$row->profile_name,ucfirst($row->first_name).' '.ucfirst(substr($row->last_name,0,1)),' style="color:#004C7A;" target="_blank"'); ?></td>
                        <td><?php echo $row->email; ?></td>
                        <td><?php echo $row->sign_up_ip; ?></td>
                        <td><?php echo $row->zip_code; ?></td>
                        <td><?php if($row->user_status=="1"){ echo "Active"; } elseif($row->user_status=="2"){ echo 'Suspend'; } else{ echo "Inactive"; } ?></td>
                        <td>Poster
							<?php 
                                $worker = $this->user_model->check_worker($row->user_id); 
                                
                                 if($worker != "0"){
                                    echo  '/Runner';
                                }	
                            ?>
                        </td>
                        <td><?php echo date('d-m-Y',strtotime($row->sign_up_date)); ?></td>
                         <td><?php  echo anchor('user/user_detail/'.$row->user_id,'View Detail','class="button white"');?></td>
                         
                        <td><?php  echo anchor('suspend/index/'.$row->user_id,'Conversation','class="button white"'); ?></td>
                        <td class="tc"><a class="button themed openable"><span class="icon_single extend"></span></a></td>  
                  	</tr>
                    
                    <tr class="<?php echo $cl; ?> openable-tr">	
						<td colspan="9" style="text-align:left; padding:15px;">
							<div class="fl typo" style="padding:10px; width:98%">
                                <div class="fl typo"><b>Suspend Reason: </b><?php echo $row->suspend_reason; ?></div>
                                <div class="s_3"></div>
                            	<div class="fl typo"><b> From date: </b><?php echo date('d-m-Y',strtotime($row->suspend_from_date)); ?></div>
                                <div class="s_3"></div>
								<div class="fl"><b>To Date: </b><?php echo date('d-m-Y',strtotime($row->suspend_to_date)); ?></div>
                                <div class="s_3"></div>
								<div class="fl"><b>Is Permanent?: </b><?php if($row->is_permanent == 1) { echo 'Permanent'; } else { echo 'Temporary'; } ?></div>
							</div>
                            
                            <?php 
								$attributes = array('name'=>'frm_suspend');
								echo form_open_multipart('user/edit_status/'.$row->user_id.'/suspend',$attributes);
								
							?>
                            <div class="fl typo" style="padding:10px; width:98%">
                                <b>User Status: </b>
                                
                                <input id="radio2" type="radio" value="1" name="user_status" /><label class="radio" for="radio2" <?php if($row->user_status=="1") { echo 'checked="checked"'; } ?> ><strong>Active</strong></label>
                                <input id="radio1" type="radio" value="0" name="user_status" /><label class="radio" for="radio1" <?php if($row->user_status=="0") { echo 'checked="checked"'; } ?> ><strong>Inactive</strong></label>
                             
                             <label class="form-label">&nbsp;</label>
                                   <input type="hidden" name="user_id" value="<?php echo $row->user_id;?>" class="button themed" id="user_id"> 
                                   <input type="submit" name="Submit" value="Submit" class="button themed" id="Submit">
                            </div>
                            </form>
						<div class="clear"></div>
                       		</td>
                      </tr>
                      
                      
				  <?php
                            $i++;
                        }
                    }
                 else { ?>
						<tr class="alter"><td colspan="15" align="center" valign="middle" height="30">No user has been added yet</td></tr>
					<?php 	}
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