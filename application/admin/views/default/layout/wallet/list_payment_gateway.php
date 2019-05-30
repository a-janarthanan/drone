<script type="text/javascript" language="javascript">
	function delete_rec(id,offset)
	{
		var ans = confirm("Are you sure to delete Payment Gateway?");
		if(ans)
		{
			location.href = "<?php echo base_url(); ?>/payments_gateways/delete_payment/"+id+"/"+offset;
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
		    if($msg == "status"){ $error = 'Status has been updated Successfully.';}
    ?>
        <div class="column full">
            <span class="message information"><strong><?php echo $error;?></strong></span>
        </div>
    <?php } ?>
	<div class="clear"></div>
	<div class="column full">
	
	<div class="box">		
		<div class="box themed_box">
		<h2 class="box-header">Payment Gateway
 </h2>
			
			<div class="box-content box-table">
            <form  name="frm_listuser" id="frm_listuser" action="<?php echo base_url();?>newsletter/action_newsletter_user" method="post">
			<table class="tablebox">
            
                <div id="topbar" style="border:#CCC solid 1px;">
                      
				
                   
				
                 </div>
				
				 <script>
							//jQuery("#paymentsgateways").fancybox();
				</script>
                  

				<thead class="table-header">
			
		  
					<tr> 
					
                    	<!--<th class="first tc"><input type="checkbox" id="checkboxall"/> </th>-->
						  <th class="first tc">Name</th>
                       
                        <th>Function Name</th>
                        <th>Support Masspayment</th>
                        <!--<th>Paypal Email ID</th>-->
                         <th>Status</th>
                         <th>Gateways Details</th>                                
                       <th>Action</th>
                       
						
						
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
					<tr onclick="<?php echo $cl; ?>(this);" class="<?php echo $cl; ?>">
                   		<!--<td class=" first tc"><input type="checkbox" name="checkall"/> </td>-->
						<td>	<?php
								  
								//  echo $row->status;
								$stat='Apply Status';
								  if($row->status=='Active')$stat='Inactive';
								   		 if($row->status=='Inactive')$stat='Active';
									//echo $stat;	
										
										?>
									<?php echo $row->name; ?></td>
                       
                        <td><?php echo $row->function_name; ?></td>
                        <td><?php echo $row->suapport_masspayment; ?></td>
                        <td style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php 
							if($row->status == 'Active') { 
								echo  anchor('payments_gateways/edit_status/'.$row->id.'/'.$offset,'<span class="bullet bullet-green"></span>&nbsp;').''; 
							} else { 
								echo anchor('payments_gateways/edit_status/'.$row->id.'/'.$offset,'<span class="bullet bullet-red"></span>&nbsp;').'';; 
							}
						
                       		echo ucfirst($row->status); 
						?>
                        </td>
                        <td><?php echo anchor('gateways_details/list_gateway_detail/'.$row->id.'/'.$offset,'Gateways Details','class="button white"'); ?></td>
                       
						<td><?php echo anchor('payments_gateways/edit_payment/'.$row->id.'/'.$offset,'<span class="icon_single edit"></span>','class="button white" id="editpayment_'.$row->id.'"'); ?>
                       <script>
							///jQuery("#editpayment_"+<?php echo $row->id;?>).fancybox();
						</script>
						
                     
						
						
						
						</td>
                  	</tr>
				  <?php
                            $i++;
                        }
                    }
                   else {
								  ?>        
								  
								  <tr class="alter">
                                    <td colspan="15" align="center" valign="middle" height="30">No Payment Gateway has been added yet.</td></tr>
								  
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