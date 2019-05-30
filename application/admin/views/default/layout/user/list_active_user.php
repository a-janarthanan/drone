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
	
	function setchecked(elemName,status){
		elem = document.getElementsByName(elemName);
		for(i=0;i<elem.length;i++){
			elem[i].checked=status;
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
			if($msg == "edit"){ $error = 'User status has been changed Successfully.';}
    ?>
        <div class="column full">
            <span class="message information"><strong><?php echo $error;?></strong></span>
        </div>
    <?php } ?>
	<div class="clear"></div>
	<div class="column full">
	
	<div class="box">		
		<div class="box themed_box">
		<h2 class="box-header">Active Poster </h2>
			
			<div class="box-content box-table">
			<table class="tablebox">
            
                <div id="topbar" style="border:#CCC solid 1px;">
                    <div style="float:left;">
                        <strong>Show</strong>
                            <?php if($search_type=='normal') { ?>
                            <select name="limit" id="limit" onchange="getlimit(this.value)" style="width:80px;">
                            <?php } if($search_type=='search') { ?>
                             <select name="limit" id="limit" onchange="getsearchlimit(this.value)" style="width:80px;">
                            <?php } ?>
                                <option value="0">Per Page</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="75">75</option>
                                <option value="100">100</option>
                            </select>
                      </div>
                    
                     <form name="frm_search" id="frm_search" method="post" action="<?php echo base_url(); ?>user/search_list_user/<?php echo $limit; ?>" onSubmit="return chk_valid();">
                     <strong>&nbsp;&nbsp;&nbsp;Search By</strong>&nbsp;
                        <select name="option" id="option" style="width:100px;" onChange="gomain(this.value)">
                            <option value="all">All</option> 
                            <option value="username" <?php if($option=='username'){?> selected="selected"<?php }?>>Username</option>
                            <!--<option value="email"  <?php if($option=='email'){?> selected="selected"<?php }?>>E-mail</option>    
                            <option value="city"  <?php if($option=='city'){?> selected="selected"<?php }?>>City</option> 
                            <option value="state"  <?php if($option=='state'){?> selected="selected"<?php }?>>State</option> 
                            <option value="country"  <?php if($option=='country'){?> selected="selected"<?php }?>>Country</option>-->        		</select>
        
                        <input type="text" name="keyword" id="keyword" value="<?php echo $keyword;?>" class="textfield"/>                
                        <input type="submit" name="submit" id="submit" value="Search" class="button themed" /> 
                     </form> 
                     <div style="float:right;">
               <form  name="frm_activeuser" id="frm_activeuser" action="<?php echo base_url();?>user/action_user/" method="post">
              <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
                <input type="hidden" name="action" id="action" />
                <input type="hidden" name="fname" value="list_active_user"/>
                
				
               <?php echo anchor('user/export_active_user/'.strtotime(date('H:i:s')),'Export CSV','class="button white" style="margin: 0px;"'); ?>
                  
               
                 <a href="javascript:void(0)"  onclick="setaction('chk[]','delete', 'Are you sure, you want to delete selected worker(s)?','frm_activeuser')" class="button white" style="margin: 0px;"><span class="icon_text cancel"></span> Delete</a>
                 
                  <a href="javascript:void(0)"  onclick="setaction('chk[]','edit', 'Are you sure, you want to Change status selected worker(s)?','frm_activeuser')" class="button white" style="margin: 0px;"><span class="icon_text cancel"></span> Change Status</a>
                 
                 </div>
                 </div>
                

				<thead class="table-header">
					<tr> 
                    	 <th class="first tc"><a href="javascript:void(0)" onClick="javascript:setchecked('chk[]',1)" style="color:#000;"><?php echo "Check All"; ?></a> |
           <a href="javascript:void(0)" onClick="javascript:setchecked('chk[]',0)" style="color:#000;"><?php echo "Clear All"; ?></a></th>
                        <th class="first tc">Poster Name</th>
                      
                        <th>Email</th>
                        
                        <th>Signup IP Address</th>                                    
                       
                        <th>Zip Code</th>
                        <th>Active</th>
                        <th>UserTpye</th>
                        <th>Registerd On</th>
                        <th>View Detail</th> 
                         <th class="tc">&nbsp;</th>   
                       
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
                   		<td><input type="checkbox" name="chk[]" id="chk" value="<?php echo $row->user_id;?>" /></td>
                        <td class="tc"><?php echo anchor(front_base_url().'user/'.$row->profile_name,ucfirst($row->first_name).' '.ucfirst(substr($row->last_name,0,1)),' style="color:#004C7A;" target="_blank"'); ?></td>
                     
                        <td><?php echo $row->email; ?></td>
                        <!--<td><?php echo $row->paypal_email; ?></td>-->
                        <td><?php echo $row->sign_up_ip; ?></td>
                       
                        <td><?php echo $row->zip_code; ?></td>
                        <td><?php if($row->user_status=="1"){ echo "Active"; }else{ echo "Inactive"; } ?></td>
                         <td>Poster
							<?php 
                                $worker = $this->user_model->check_worker($row->user_id); 
                                
                                 if($worker != "0"){
                                    echo  '/Runner';
                                }	
                            ?>
                        </td>
                        <td><?php echo date('d-m-Y',strtotime($row->sign_up_date)); ?></td>
                        <td><?php if($row->user_status=="1"){ echo anchor('user/user_detail/'.$row->user_id,'View Detail','class="button white"');} ?></td>
                        <td class="tc"><a class="button themed openable"><span class="icon_single extend"></span></a></td>
                  	</tr>
                    
                     <tr class="<?php echo $cl; ?> openable-tr">
                   		<td colspan="2" style="text-align:center;">&nbsp;</td>
						<td colspan="4" style="text-align:left;">
                        <?php 
							//$attributes = array('name'=>'frm_suspend');
							//echo form_open_multipart('user/edit_status/'.$row->user_id.'/active',$attributes);
						?>
                        <script>
						
							function suspend(status,userId)
							{
								if(status == 2) {
									document.getElementById("suspend_"+userId).style.display="block";
								} else {
									document.getElementById("suspend_"+userId).style.display="none";
								}
							}
						</script>
                        
							<div class="fl typo" style="padding:25px;">
                                <b>User Status: </b>
                                <input id="radio1" type="radio" value="0" name="user_status_<?php echo $row->user_id;?>" onclick="suspend('0','<?php echo $row->user_id;?>');" <?php if($row->user_status == 0) { echo 'checked="checked"'; } ?> /><label class="radio" for="radio1"><strong>Inactive</strong></label>
                                <input id="radio2" type="radio" value="1" name="user_status_<?php echo $row->user_id;?>" onclick="suspend('1','<?php echo $row->user_id;?>');" <?php if($row->user_status == 1) { echo 'checked="checked"'; } ?> /><label class="radio" for="radio2"><strong>Active</strong></label>
                                <input id="radio3" type="radio" value="2" name="user_status_<?php echo $row->user_id;?>" onclick="suspend('2','<?php echo $row->user_id;?>');" <?php if($row->user_status == 2) { echo 'checked="checked"'; } ?> /><label class="radio" for="radio3"><strong>Suspend</strong></label>   <br /><br />
                               
						 
                                   <span id="suspend_<?php echo $row->user_id;?>" style="display:none;">
                                    <label class="form-label">Number Of Day</label>
                                    <input type="text" name="no_of_day_<?php echo $row->user_id;?>" id="no_of_day" class="form-field"  style="width:300px;" />
                                    
                                    <label class="form-label">Suspend Reason</label>
                                    <textarea name="suspend_reason_<?php echo $row->user_id;?>" id="suspend_reason" class="" style="height:65px; width:300px; padding: 2px 0 2px 5px;
border: 1px solid silver; -webkit-border-radius: 5px; margin-bottom:10px;"></textarea>   
                                
                                    <label class="form-label">Is Permanent?</label>
                                    <input id="radio2" type="radio" value="0" name="is_permanent_<?php echo $row->user_id;?>" /><label class="radio" for="radio2"><strong>Temporary</strong></label>
                                    <input id="radio3" type="radio" value="1" name="is_permanent_<?php echo $row->user_id;?>" /><label class="radio" for="radio3"><strong>Permanent</strong></label>
   
                                   </span>
                                   
                                   <!--<label class="form-label">&nbsp;</label>
                                   <input type="hidden" name="user_id" value="<?php echo $row->user_id;?>" class="button themed" id="user_id"> 
                                   <input type="submit" name="Submit" value="Submit" class="button themed" id="Submit">-->
                            </div>
						<div class="clear"></div>
                        <!--</form>-->
						</td>
                        <td colspan="4" style="text-align:center;">&nbsp;</td>
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