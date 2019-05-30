<script type="text/javascript" language="javascript">
	function gomain(x)
	{
		
		if(x == 'all')
		{
			window.location.href= '<?php echo base_url();?>task/list_task';
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

function getlimit(limit)
	{
		if(limit=='0')
		{
		return false;
		}
		else
		{
			window.location.href='<?php echo base_url();?>task/close_task/'+limit;
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
			
			window.location.href='<?php echo base_url();?>task/close_task/'+limit+'/<?php echo $option.'/'.$keyword; ?>';
		}
	
	}
</script>

<div id="content">        
	<?php if($msg != ""){
          
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
		<h2 class="box-header">Closed Tasks </h2>
			
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
               <form  name="frm_closetask" id="frm_closetask" action="<?php echo base_url();?>task/action_task/" method="post">
              <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
                <input type="hidden" name="action" id="action" />
				
               
                  
                   <?php echo anchor('task/export_close_task/'.strtotime(date('H:i:s')),'Export CSV','class="button white" style="margin: 0px;"'); ?>
                 <a href="javascript:void(0)"  onclick="setaction('chk[]','delete', 'Are you sure, you want to delete selected record(s)?', 'frm_closetask')" class="button white" style="margin: 0px;"><span class="icon_text cancel"></span> Delete</a>
                 
                 </div>

                 </div>

				<thead class="table-header">
					<tr> 
                      <th class="first tc"><a href="javascript:void(0)" onClick="javascript:setchecked('chk[]',1)" style="color:#000;"><?php echo "Check All"; ?></a>|<a href="javascript:void(0)" onClick="javascript:setchecked('chk[]',0)" style="color:#000;"><?php echo "Clear All"; ?></a></th>
                        <th class="first tc">Task Name</th>
                        <th>Task Price</th>                                    
                        <th>Poster Name</th>
                        <th>No Of Bids</th>
                        <th>Assigned Runner</th>  
                        <th>Posted On</th>     
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
                    <td><input type="checkbox" name="chk[]" id="chk" value="<?php echo $row->task_id;?>" /></td>
                        <td class="tc"><?php echo anchor(front_base_url().'tasks/'.$row->task_url_name,ucfirst($row->task_name),' style="color:#004C7A;" target="_blank"'); ?></td> 
                        <td><?php echo $site_setting->currency_symbol.$row->task_price; ?></td>
                        <td><?php echo get_user_name($row->user_id);?></td>
                        <td><?php echo $this->task_model->get_no_of_bids($row->task_id); ?></td>
                        <td>
							<?php 
							$wid = $row->task_worker_id;
							if($wid == 0) { echo 'Not Assign'; }
							else { 
								$worker = $this->worker_model->view_worker_result($row->task_worker_id);
								echo anchor(front_base_url().'user/'.$worker->profile_name,ucfirst($worker->first_name).' '.ucfirst(substr($worker->last_name,0,1)),' style="color:#004C7A;" target="_blank"');
										
							}
						?>
                        </td> 
                        <td><?php echo date($site_setting->date_time_format,strtotime($row->task_post_date)); ?></td>
                         <td><?php echo anchor('task/task_detail/'.$row->task_id,'View Detail','class="button white"'); ?></td>
                  	</tr>
				  <?php
                            $i++;
                        }
                    }
					 else {
				  ?>        
								  
                  	<tr class="alter">
                    	<td colspan="15" align="center" valign="middle" height="30">No Task has been added yet.</td>
                    </tr>
                  
                  <?php } ?>  

				</tbody>
			</table>
            </form>
           	  <ul class="pagination">
                <?php echo $page_link; ?>
              </ul>
			</div>
		</div>
	</div>
</div>