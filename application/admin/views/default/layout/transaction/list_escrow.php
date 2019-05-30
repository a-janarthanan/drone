<script type="text/javascript" language="javascript">
	function gomain(x)
	{
		if(x == 'all')
		{
			window.location.href= '<?php echo base_url();?>transaction/list_escrow';
		}
	}
	
	
	function getlimit(limit)
	{
		if(limit=='0'){
			return false;
		} else {
			window.location.href='<?php echo base_url();?>transaction/list_escrow/'+limit;
		}
	}	
	
	function getsearchlimit(limit)
	{
		if(limit=='0'){
			return false;
		} else {
			window.location.href='<?php echo base_url();?>transaction/list_escrow/'+limit+'/<?php echo $option.'/'.$keyword; ?>';
		}
	}
	
</script>



<div id="content">        
 
	<div class="clear"></div>
	<div class="column full">
	
	<div class="box">		
		<div class="box themed_box">
		<h2 class="box-header">Escrow List</h2>
			
			<div class="box-content box-table">
			<table class="tablebox">

            <div id="topbar" style="border:#CCC solid 1px;">
                    <div style="float:left; width:135px;">
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
                    <div style="float:left; width: 770px;">
                     <form name="frm_search" id="frm_search" method="post" action="<?php echo base_url(); ?>transaction/list_escrow/<?php echo $limit; ?>" >
                     <strong style="float:left; margin-bottom:10px; margin-top:6px;">&nbsp;&nbsp;&nbsp;Search By &nbsp;</strong>&nbsp;&nbsp;
                        <select name="option" id="option" style="width:100px; float:left;" onChange="gomain(this.value)">
                            <option value="all">All</option> 
                            <option value="taskname" <?php if($option=='taskname'){?> selected="selected"<?php }?>>Task name</option>
							<option value="askername" <?php if($option=='askername'){?> selected="selected"<?php }?>>Poster Name</option>
							<option value="taskername" <?php if($option=='taskername'){?> selected="selected"<?php }?>>Runner Name</option>
						</select>
					   
                       &nbsp;&nbsp; <input type="text" name="keyword" id="keyword" value="<?php echo $keyword;?>" class="textfield" style="float:left; display:block; margin-top:4px; margin-left:3px;"/> 
					          
                        <input type="submit" name="submit" id="submit" value="Search" class="button themed"/> 
                     </form>
                     </div>
                     
					</div>

				<thead class="table-header">
					<tr> 
                        <th class="first tc" style="text-align:left; padding-left:10px;">Task Name</th>                                 
                        <th>Poster Name</th>
                        <th>Runner Name</th>
                        <th>Amount in escrow</th>    
                        <th class="tc">Transaction Date</th>              
					</tr>
				</thead>
				
				<tbody class="openable-tbody">
                 <?php
                    if($result)
                    {
                        $i=0;
                        foreach($result as $row)
                        {
							//echo '<pre>'; print_r($row);
                            if($i%2=="0")
                            {
                                $cl = "odd";	
                            }else{	
                                $cl = "even";	
                            }	
							
                  ?>
                  <tr class="<?php echo $cl; ?>">
                  		<td class="tc" style="text-align:left; padding-left:10px;"><?php echo anchor(front_base_url().'tasks/'.$row->task_url_name,ucfirst($row->task_name),' style="color:#004C7A;" target="_blank"'); ?></td>   
                        
                        <td>
							<?php 
                                $user = $this->transaction_model->get_user_by_task($row->task_id); 
                                echo  anchor(front_base_url().'user/'.$user->profile_name,ucfirst($user->first_name).' '.ucfirst(substr($user->last_name,0,1)),' style="color:#004C7A;" target="_blank"');
                            
                            ?>
                        </td>
                        
                        <td>
						<?php 
							if($row->task_worker_id != 0 || $row->task_worker_id == ''){
							
								$worker = $this->worker_model->view_worker_result($row->task_worker_id);
                                    echo anchor(front_base_url().'user/'.$worker->profile_name,ucfirst($worker->first_name).' '.ucfirst(substr($worker->last_name,0,1)),' style="color:#004C7A;" target="_blank"');
							} else { 
								echo 'Not Assign';
							}
						
						?>  
                        </td>
                        
                        <td><?php echo $site_setting->currency_symbol.$row->task_amount; ?></td>
                        
                        <td><?php echo date($site_setting->date_time_format,strtotime($row->transaction_date_time)); ?></td>
                  </tr>
                  
                  <?php
                            $i++;
                        }
                    } else {
				  ?>        
								  
                   <tr class="alter">
                   		<td colspan="15" align="center" valign="middle" height="30">No Escrow has been added yet.</td>
                   </tr>
                  
                  <?php } ?>
				
				</tbody>
			</table>
            
                 <ul class="pagination">
                		 <?php echo $page_link; ?>
            	</ul>
			</div>
		</div>
	</div>
</div>