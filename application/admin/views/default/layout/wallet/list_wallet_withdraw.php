<script type="text/javascript">


function withdraw_detail(id)
{

if(id=='')
{
	return false;
}

var url="<?php echo base_url(); ?>wallet/withdraw_detail/"+id;
window.open(url,'Withdraw Details','height=600,width=550,top=50,left=150');
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
		<h2 class="box-header">Wallet Withdraw 
 
 </h2>
			
			<div class="box-content box-table">
			<table class="tablebox">
            
                <div id="topbar" style="border:#CCC solid 1px;">
                    <div style="float:left;">
                       
                      </div>
                    
                   <form name="frm_search" id="frm_search" method="post" action="<?php echo base_url(); ?>wallet/search_withdrawal" onSubmit="return chk_valid();">
                    <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
                 <label><b>Search By :</b></label>
                <select name="option" id="option" style="width:100px;">
               		<option value="full_name">Name</option>                    
                   <option value="email">User Email</option>   
					<option value="withdraw_method">Withdraw Method</option>
					<option value="withdraw_status">Withdraw Status</option> 
					<option value="withdraw_ip">Withdraw IP</option>                    
					
                </select>
                
                
                <input type="text" name="keyword" id="keyword" value="" />             
                <input type="submit" name="submit" id="submit" class="button themed" value="GO" />
			 </form>
			 
			 <div style="float:right;">
               <form  name="frm_listproject" id="frm_listproject" action="<?php echo base_url();?>wallet/action_withdraw" method="post">
              <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
                <input type="hidden" name="action" id="action" />
				
               
                  <a href="javascript:void(0)"  onclick="setaction('chk[]','delete', 'Are you sure, you want to delete selected record(s)?', 'frm_listproject')" class="button white" style="margin: 0px;"><span class="icon_text cancel"></span> Delete</a>
                  <a href="javascript:void(0)"  onclick="setaction('chk[]','Confirm', 'Are you sure, you want to confirm selected record(s)?', 'frm_listproject')" class="button white" style="margin: 0px;"><span class="icon_text accept"></span> Confirm</a>
                  
                 
                 </div>
                 </div>

				<thead class="table-header">
					<tr> 
						  <th width="10%"><a href="javascript:void(0)" onClick="javascript:setchecked('chk[]',1)" style="color:#000;"><?php echo "Check All"; ?></a>|<a href="javascript:void(0)" onClick="javascript:setchecked('chk[]',0)" style="color:#000;"><?php echo "Clear All"; ?></a></th>
                        <th class="first tc">Name</th>
                        <th>Email</th>
                        <th>Withdraw Request(<?php echo $site_setting->currency_symbol; ?>)</th>                                    
                       <th>Amount to Pay(<?php echo $site_setting->currency_symbol; ?>)</th>
                        <th>Withdraw Method</th>
                        <th>Details</th>
                        <th>Date</th>
                        <th>IP</th>
                        <th>Status</th>
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
                   		
						<td><input type="checkbox" name="chk[]" id="chk" value="<?php echo $row->withdraw_id;?>" /></td>
                        <td><?php  
							if($row->user_id != '' && $row->user_id != 0) {
								echo get_user_name($row->user_id);	
							} 
						?></td>
                        <td><?php echo $row->email;?> </td>
                        <td><?php echo $row->withdraw_amount; ?></td>
                        <td><?php
									
							$donation_charge=$wallet_setting->wallet_donation_fees;
							
							if($donation_charge==0)
							{
								 echo $row->withdraw_amount;
							}
							else
							{
								$donation_charge_fee= number_format((($row->withdraw_amount*$donation_charge)/100),2);								
								echo $amount_to_pay = number_format(($row->withdraw_amount-$donation_charge_fee),2);
							}		
									
									
									 
									  ?></td>
                        <td><?php if($row->withdraw_method=='bank') { ?>By Net Banking<?php } 
										 if($row->withdraw_method=='check') { ?>By Check <?php } 
										  if($row->withdraw_method=='gateway') { ?>By paypal<?php } ?></td>
						
                        <td><a href="javascript:void()" onclick="withdraw_detail(<?php echo $row->withdraw_id; ?>)" class="button white"><span class="icon_text accept"></span>Details</a>
                       
                        </td>
                       
                       
                       <td><?php echo date($site_setting->date_format, strtotime($row->withdraw_date)); ?></td>
                        
                        <td><?php echo $row->withdraw_ip; ?></td>
                        <td><?php echo $row->withdraw_status; ?></td>
                      
                  	</tr>
				  <?php
                            $i++;
                        }
                    }
                   else {
								  ?>        
								  
								  <tr class="alter">
                                    <td colspan="15" align="center" valign="middle" height="30">No Wallet Withdraw has been added yet.</td></tr>
								  
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