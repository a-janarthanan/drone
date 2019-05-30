<div id="content">

	<?php if($msg!='') {  
        if($msg=='delete') { $error = 'Record has been deleted Successfully.';} 
        if($msg=='update') { $error = 'Record has been updated Successfully.';} 
    ?>
    <div class="column full">
        <span class="message information"><strong><?php echo $error;?></strong></span>
    </div>
    <?php } ?>
           
	<div class="clear"></div>
	<div class="column full">
	
	<div class="box">		
		<div class="box themed_box">
		<h2 class="box-header">PayPal Setting</h2>
			
			<div class="box-content box-table">
			<table class="tablebox">

				<thead class="table-header">
					<tr> 
                        <th class="first tc">No. </th>
                        <th>Site Status </th>
                        <th>Paypal Email </th>  
                        <th>Username </th>
                        <th>Preapproval </th>
                        <th>Gateway Status </th>  
                        <th class="tc">Options </th>      
					</tr>
				</thead>
				
				<tbody class="openable-tbody">
				<?php
                    if($result)
                    {
                        $i=1;
                        foreach($result as $row)
                        {
                            if($i%2=="0")
                            {
                                $cl = "even";	
                            }else{	
                                $cl = "odd";	
                            }
                  ?>
					<tr class="<?php echo $cl; ?>">
                    
                        <td class="tc"><?php echo $i; ?></div></td>
                        <td><?php echo $row->site_status; ?></td>
                        <td><?php echo $row->paypal_email; ?></td>
                        <td><?php echo $row->paypal_username; ?></td>
                        <td>
                            <?php 
                                if($row->preapproval=='1')
                                {
                                echo 'Active';
                                }
                                else
                                {
                                echo 'Inactive';
                                }
                                //echo $row->preapproval; 
                            ?>
                        </td>                                
                        <td>
                            <?php 
                                if($row->gateway_status=='1')
                                {
                                echo 'Active';
                                }
                                else
                                {
                                echo 'Inactive';
                                }
                                //echo $row->gateway_status;
                            ?>
                        </td>   
                        <td><?php echo anchor('paypal/edit_paypal/'.$row->id,'<span class="icon_single edit"></span>',' title="Edit PayPal Setting" class="button white" id="editpaypal_'.$row->id.'" ');?></td>
                        
                        <script>
							//jQuery("#editpaypal_"+<?php echo $row->id;?>).fancybox();
						</script>
                  	</tr>
				  <?php
                            $i++;
                        }
                    }
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