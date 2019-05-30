<script type="text/javascript">

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

function chk_valid()
	{
		
		var keyword = document.getElementById('keyword').value;
		
		if(keyword=='')
		{
			alert('Please enter search keyword');	
			return false;
			
		}
		
		else
		{
			return true;			
		}
		
		
		
	}

</script>


<div id="content">        
	<?php if($msg != ""){
            if($msg == "insert"){ $error = 'New Record has been added Successfully.';}
            if($msg == "update"){ $error = 'Record has been updated Successfully.';}
            if($msg == "delete"){ $error = 'Record has been deleted Successfully.';}
			 if($msg == "review"){ $error = 'Record has been reviewd Successfully.';}
			  if($msg == "confirm"){ $error = 'Record has been confirmed Successfully.';}
    ?>
        <div class="column full">
            <span class="message information"><strong><?php echo $error;?></strong></span>
        </div>
    <?php } ?>
	<div class="clear"></div>
	<div class="column full">
	
	<div class="box">		
		<div class="box themed_box">
		<h2 class="box-header">Wallet Review 
 
 </h2>
			
			<div class="box-content box-table">
			<table class="tablebox">
            
                <div id="topbar" style="border:#CCC solid 1px;">
                    <div style="float:left;">
                       
                      </div>
                    
                   <form name="frm_search" id="frm_search" method="post" action="<?php echo base_url(); ?>wallet/search_walletreview" onSubmit="return chk_valid();">
                <label><b>Search By :</b></label>
                <select name="option" id="option" style="width:100px;">
               		<option value="full_name">Name</option>                    
                    <option value="email">User Email</option>   
					<option value="wallet_payee_email">Payee Email</option>
					<option value="wallet_transaction_id">TransactionID</option> 
					<option value="admin_status">Status</option> 
					<option value="wallet_ip">Wallet IP</option>                
					
                </select>
                
                
                <input type="text" name="keyword" id="keyword" value="" />             
                <input type="submit" name="submit" id="submit" class="button themed" value="GO" />
			 </form>
			 
			 <div style="float:right;">
               <form name="frm_listproject" id="frm_listproject" action="<?php echo base_url();?>wallet/action_review" method="post">
              <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
                <input type="hidden" name="action" id="action" />
				
               
                 <!-- <a href="javascript:void(0)"  onclick="setaction('chk[]','delete', 'Are you sure, you want to delete selected record(s)?', 'frm_listproject')" class="button white"  style="margin: 0px;"><span class="icon_text cancel" ></span> Delete</a>-->
                  
                   <a href="javascript:void(0)"  onclick="setaction('chk[]','delete', 'Are you sure, you want to delete selected record(s)?', 'frm_listproject')" class="button white"  style=""><span class="icon_text cancel" style="height:13px;width:13px;"></span> &nbsp;Delete</a>
                  
                  <a href="javascript:void(0)"  onclick="setaction('chk[]','Confirm', 'Are you sure, you want to confirm selected record(s)?', 'frm_listproject')" class="button white"  style=""><span class="bullet bullet-green" style="height:13px;width:13px;"></span>Confirm</a>
 
                  <a href="javascript:void(0)"  onclick="setaction('chk[]','Review', 'Are you sure, you want to review selected record(s)?', 'frm_listproject')" class="button white"  style=""><span class="bullet bullet-red" style="height:13px;width:13px;"></span>Review</a>
                 
                 </div>
                 </div>

				<thead class="table-header">
				
		  
					<tr> 

						  <th width="10%"><a href="javascript:void(0)" onClick="javascript:setchecked('chk[]',1)" style="color:#000;"><?php echo "Check All"; ?></a>|<a href="javascript:void(0)" onClick="javascript:setchecked('chk[]',0)" style="color:#000;"><?php echo "Clear All"; ?></a></th>
                        <th class="first tc">Name</th>
                        <th>Email</th>
                        <th>Amount Added(<?php echo $site_setting->currency_symbol; ?>)</th>                                    
                       <th>Transaction ID</th>
                        <th>Gateway</th>
                        <th>Payee Email</th>
                        <th>IP</th>
                        <th>Status</th>
                        <th>Date</th>
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
                   		
						<td><input type="checkbox" name="chk[]" id="chk" value="<?php echo $row->id;?>" /></td>
                        <td>
						<?php  
							if($row->user_id != '' && $row->user_id != 0) {
								echo get_user_name($row->user_id);
							} 
						?>
                        </td>
                        <td><?php echo $row->email; ?></td>
                        <td><?php echo $row->debit; ?></td>
                        <td><?php echo $row->wallet_transaction_id; ?></td>
						
                        <td><?php 
									
									if($row->gateway_id==0 || $row->gateway_id=='0') { echo "Internal"; } else {
									
									$gateway=$this->wallet_model->get_gateway_name($row->gateway_id); echo $gateway->name;
									} ?></td>
                       
                       <td><?php echo $row->wallet_payee_email; ?></td>
                        <td><?php echo $row->wallet_ip; ?></td>
                        <td><?php if($row->admin_status=='Confirm'){ ?>
                                    
                                    
                                    <!-- <span style="padding-left:25px;" class="icon_single accept"></span>-->
                                     
                                     <span class="bullet bullet-green"></span>
                                    
                                    <?php }	if($row->admin_status=='Review'){ ?>
								
									
									 <span class="bullet bullet-red"></span>
									
									<?php }	?></td>
                        <td><?php echo date($site_setting->date_format, strtotime($row->wallet_date)); ?></td>
                      
                  	</tr>
				  <?php
                            $i++;
                        }
                    }
                   else {
								  ?>        
								  
								  <tr class="alter">
                                    <td colspan="15" align="center" valign="middle" height="30">No Wallet Review has been added yet.</td></tr>
								  
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