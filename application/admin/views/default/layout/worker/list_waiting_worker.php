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
			window.location.href='<?php echo base_url();?>worker/list_waiting_worker/'+limit;
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
			
			window.location.href='<?php echo base_url();?>worker/list_waiting_worker/'+limit+'/<?php echo $option.'/'.$keyword; ?>';
		}
	
	}
	
	function gomain(x)
	{
		
		if(x == 'all')
		{
			window.location.href= '<?php echo base_url();?>worker/list_waiting_worker';
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
            if($msg == "delete"){ $error = 'Record has been deleted Successfully.';}
			 if($msg == "active"){ $error = 'Worker Activate Successfully.';}
			  if($msg == "reject"){ $error = 'Worker Rejected Succesfully.';}
    ?>
        <div class="column full">
            <span class="message information"><strong><?php echo $error;?></strong></span>
        </div>
    <?php } ?>
	<div class="clear"></div>
	<div class="column full">
	
	<div class="box">		
		<div class="box themed_box">
		<h2 class="box-header">Waiting Runners </h2>
			
			<div class="box-content box-table">
			<table class="tablebox">
            
                <div id="topbar" style="border:#CCC solid 1px;">
                    <div style="float:left;">
                        <strong>Show :</strong>
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
                    
                  
                     <div style="float:right;">
               <form  name="frm_waiting" id="frm_waiting" action="<?php echo base_url();?>worker/action_worker/" method="post">
              <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
                <input type="hidden" name="action" id="action" />
                <input type="hidden" name="fname" value="list_waiting_worker"/>
                
				
               <?php echo anchor('worker/export_waiting_worker/'.strtotime(date('H:i:s')),'Export CSV','class="button white" style="margin: 0px;"'); ?>
                  
                  <a href="javascript:void(0)"  onclick="setaction('chk[]','active', 'Are you sure, you want to Active selected worker(s)?', 'frm_waiting')" class="button white"  style="margin: 0px;"><span class="icon_text accept"></span> Active Worker</a>
				   <a href="javascript:void(0)"  onclick="setaction('chk[]','reject', 'Are you sure, you want to Reject selected worker(s)?', 'frm_waiting')" class="button white" style="margin: 0px;"><span class="icon_text cancel"></span> Reject Worker	</a>
                 <a href="javascript:void(0)"  onclick="setaction('chk[]','delete', 'Are you sure, you want to delete selected worker(s)?', 'frm_waiting')" class="button white" style="margin: 0px;"><span class="icon_text cancel"></span> Delete</a>
                 
                 </div>
                 </div>

				<thead class="table-header">
					<tr> 
                    	
						 <th class="first tc"><a href="javascript:void(0)" onClick="javascript:setchecked('chk[]',1)" style="color:#000;"><?php echo "Check All"; ?></a> |
           <a href="javascript:void(0)" onClick="javascript:setchecked('chk[]',0)" style="color:#000;"><?php echo "Clear All"; ?></a></th>
                        <th class="first tc">Runner Name</th>
                  
                        <th>Email</th>
                        <th>Signup IP Address</th>                                    
                         <th>Zip Code</th>
                        <th>Active</th>
                        <th>Registerd On</th> 
                        <th class="tc">View Detail</th>      
                        
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
                   		<td><input type="checkbox" name="chk[]" id="chk" value="<?php echo $row->worker_id;?>" /></td>
                        <td class="tc"><?php echo anchor(front_base_url().'user/'.$row->profile_name,ucfirst($row->first_name).' '.ucfirst(substr($row->last_name,0,1)),' style="color:#004C7A;" target="_blank"'); ?></td>
                        <td><?php echo $row->email; ?></td>
                        <td><?php echo $row->sign_up_ip; ?></td>
                         <td><?php echo $row->zip_code; ?></td>
                        <td><?php if($row->worker_status =="1"){ echo "Active"; }else{ echo "Inactive"; } ?></td>
                        <td><?php echo date('d-m-Y',strtotime($row->sign_up_date)); ?></td>
                        <td><?php echo anchor('worker/view_worker/'.$row->worker_id,'View Detail','class="button white"'); ?></td>
                    
                  	</tr>
				  <?php
                            $i++;
                        }
                    }
					else { ?>
							<tr class="odd">
                                <td colspan="8">No Worker has been added yet.</td>
                            </tr>
					<?php }?>	
				</tbody>
			</table>
				
                <ul class="pagination">
                    <?php echo $page_link; ?>
				</ul>
                
                </form>
			</div>
		</div>
	</div>
</div>