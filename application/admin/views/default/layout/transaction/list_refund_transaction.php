<div id="content">        
 
	<div class="clear"></div>
	<div class="column full">
	
	<div class="box">		
		<div class="box themed_box">
		<h2 class="box-header">transaction List</h2>
			
			<div class="box-content box-table">
			<table class="tablebox">
            
				<thead class="table-header">
					<tr> 
                        <th class="first tc">Task Name</th>                                 
                        <th>Poster Name</th>
                        <th>Amount in escrow</th>   
                        <th>Earning</th> 
                        <th>Refund</th>   
                        <th class="tc">Posted On</th>              
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
                  		<td class="tc"><?php echo anchor(front_base_url().'tasks/'.$row->task_url_name,ucfirst($row->task_name),' style="color:#004C7A;" target="_blank"'); ?></td>   
                        <td><?php echo get_user_name($row->user_id);?></td>
                        <td><?php echo $site_setting->currency_symbol.$row->task_amount; ?></td>
                        <td><?php echo $site_setting->currency_symbol.$row->total_cut_price;  ?></td> 
                         <td><?php echo $site_setting->currency_symbol.$row->debit;  ?></td> 
                        <td><?php echo date($site_setting->date_time_format,strtotime($row->wallet_date)); ?></td>
                  </tr>
                  
                  <?php
                            $i++;
                        }
                    }
					 else {
								  ?>        
								  
								  <tr class="alter">
                                    <td colspan="15" align="center" valign="middle" height="30">No Transaction has been added yet.</td></tr>
								  
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