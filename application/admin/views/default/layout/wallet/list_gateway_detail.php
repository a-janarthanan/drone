<script type="text/javascript" language="javascript">
	function delete_rec(id,offset)
	{
		var ans = confirm("Are you sure to delete Gateways detail?");
		if(ans)
		{
			location.href = "<?php echo base_url(); ?>/gateways_details/delete_detail/"+id+"/"+<?php echo $payid; ?>+"/"+offset;
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
    ?>
        <div class="column full">
            <span class="message information"><strong><?php echo $error;?></strong></span>
        </div>
    <?php } ?>
	<div class="clear"></div>
	<div class="column full">
	
	<div class="box">		
		<div class="box themed_box">
		<h2 class="box-header">Gateway Detail</h2>
			
			<div class="box-content box-table">
			<table class="tablebox">
            
                <div id="topbar" style="border:#CCC solid 1px;">
                      
				 <div style="float:right;">
                                      </div>

				<thead class="table-header">
			
		  
					<tr> 
					
                    	<!--<th class="first tc"><input type="checkbox" id="checkboxall"/> </th>-->
						  <th width="10%">Value</th>
                          <th class="first tc">Label</th>
                          <th>Description</th>
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
					<tr onClick="<?php echo $cl; ?>(this);" class="<?php echo $cl; ?>">
                   		<!--<td class=" first tc"><input type="checkbox" name="checkall"/> </td>-->
						
						<td><?php echo $row->value; ?></td>
                       
                        <td><?php echo $row->label; ?></td>
                        <td><?php echo $row->description; ?></td>
                       
                       
						<td><?php echo anchor('gateways_details/edit_detail/'.$row->id.'/'.$row->payment_gateway_id.'/'.$offset,'<span class="icon_single edit"></span>','class="button white" id="editgetway_'.$row->id.'"'); ?>
                      <script>
							//jQuery("#editgetway_"+<?php echo $row->id;?>).fancybox();
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
                                    <td colspan="15" align="center" valign="middle" height="30">No Gateway Detail has been added yet.</td></tr>
								  
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