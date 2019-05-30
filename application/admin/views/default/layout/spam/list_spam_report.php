<script type="text/javascript" language="javascript">

	
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
			window.location.href='<?php echo base_url();?>spam_setting/spam_report/'+limit;
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
			
			window.location.href='<?php echo base_url();?>spam_setting/search_list_spam_report/'+limit+'/<?php echo $option.'/'.$keyword; ?>';
		}
	
	}
	
	function gomain(x)
	{
		
		if(x == 'all')
		{
			window.location.href= '<?php echo base_url();?>spam_setting/spam_report';
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
		<h2 class="box-header">Spam Report 

 </h2>
			
			<div class="box-content box-table">
			<table class="tablebox">
            
                <div id="topbar" style="border:#CCC solid 1px;">
                    <div style="float:left;">
                       <strong>Show</strong>
                            <?php if($search_type=='normal') { ?>
                            <select name="limit" id="limit" onChange="getlimit(this.value)" style="width:80px;">
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
                    
                     <form name="frm_search" id="frm_search" method="post" action="<?php echo base_url(); ?>spam_setting/search_list_spam_report/<?php echo $limit; ?>" onSubmit="return chk_valid();">
                
                <select name="option" id="option" style="width:100px;" onchange="gomain(this.value)">
                <option value="all">All</option> 
                	<option value="ip" <?php if($option=='ip'){?> selected="selected"<?php }?>>Spam IP</option>  
                </select>
                
                
                <input type="text" name="keyword" id="keyword" value="<?php echo $keyword;?>" />                     
                <input type="submit" name="submit" id="submit" class="button themed" value="GO" />
                
                </form> 
				 
				 <div style="float:right;">
				 <form name="frm_listspamer" id="frm_listspamer" action="<?php echo base_url();?>spam_setting/spam_action" method="post">
            
           
           
          <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
           <input type="hidden" name="action" id="action" />
          
		  
                 
                 <a href="javascript:void(0)"  onclick="setaction('chk[]','delete', 'Are you sure, you want to delete selected record(s)?', 'frm_listspamer')" class="button white" style="margin: 0px;"><span class="icon_text cancel"></span> Delete</a>
				 
				 <!--<a href="javascript:void(0)"  onclick="setaction('chk[]','make_spam', 'Are you sure, you want to make spamer selected record(s)?', 'frm_listspamer')" class="button white" style="margin: 0px;"><span class="icon_text cancel"></span> Make Spam</a>-->
                
           
                 </div>

                 </div>

				<thead class="table-header">
					<tr> 
					
                    	<!--<th class="first tc"><input type="checkbox" id="checkboxall"/> </th>-->
						  <th width="10%"><a href="javascript:void(0)" onClick="javascript:setchecked('chk[]',1)" style="color:#000;"><?php echo "Check All"; ?></a>|<a href="javascript:void(0)" onClick="javascript:setchecked('chk[]',0)" style="color:#000;"><?php echo "Clear All"; ?></a></th>
                        <th class="first tc">Spam IP</th>
                        <th>Total Report</th>
                        <th>Spam By</th>
                        <!--<th>Paypal Email ID</th>-->
                        <th>Report By</th>                                    
                       
                        <!-- <th>City</th>
                        <th>State</th>
                        <th>Country</th>
                        <th>Zip Code</th>
                        <th>Active</th>
                        <th class="tc">Registerd On</th>   
                        <!--<th class="tc">Action</th>-->
						
						
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
					<tr onClick="<?php echo $cl; ?>(this);" class="<?php echo $cl; ?>">
                   		<!--<td class=" first tc"><input type="checkbox" name="checkall"/> </td>-->
						<td><input type="checkbox" name="chk[]" id="chk" value="<?php echo $row->spam_report_id;?>" /></td>
                        <td class="tc"><?php echo $row->spam_ip; ?></td>
                        <td><?php echo $row->total_spam; ?></td>
                        <td>
							<?php $spam_by=$this->user_model->get_one_user($row->spam_user_id); ?>
							<a href="<?php echo base_url().'member/'.$row->spam_user_id; ?>" target="_blank"><?php echo $spam_by->full_name; ?></a>
                        </td>
                        
                        <td>
						<?php 
							if($row->reported_user_id!='' && $row->reported_user_id!='0' && $row->reported_user_id!=0) {
								 $report_by=$this->user_model->get_one_user($row->reported_user_id); 
						?>
							<a href="<?php echo base_url().'member/'.$row->reported_user_id; ?>" target="_blank"><?php echo $report_by->full_name; ?></a>
						<?php } else { echo "N/A"; } ?>
                        </td>
						
                  	</tr>
				  <?php
                            $i++;
                        }
                    }
                   else {
				 ?>        
					<tr class="alter"><td colspan="15" align="center" valign="middle" height="30">No Spam Report has been added yet.</td></tr>
								  
								  <?php } ?>  
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