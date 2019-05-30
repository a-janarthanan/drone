<script type="text/javascript">
function display()
{
   
    document.getElementById("tabs-4").style.display="block";
	document.getElementById("tabs-3").style.display="none";
}

function display1()
{
    
    document.getElementById("tabs-4").style.display="none";
	document.getElementById("tabs-3").style.display="block";
}
</script>
<div id="content">

	<?php  if($msg == 'valid'){ ?>
		<span class="message information"><strong>You have logged in successfully.</strong></span>
	<?php } if($msg == 'no_rights') {?>
   	 <span class="message information"><strong>You do not have permmission to access this area.</strong></span>
    <?php } ?>
	
	<?php
	
	$site_setting=site_setting();
	$task_setting=task_setting();
	
	?>
    
    
    
    <div class="clear"></div>
    
	<!-- user/worker-->
	<div class="box tabs black_box">
		<h2 class="box-header">Transactions</h2>
		
		<div class="box-content box-table">
		<div id="tabs-7">
		<table class="tablebox">
		<thead class="table-header">
		<tr>
			<td align="left" valign="middle" style="background:#FFFFFF; text-align:left !important; padding:0px 0px 0px 20px;width: 131px;" colspan="2"><b>Payout :: </b> Worker <b><?php echo $task_setting->task_worker_fee;?>%</b> &nbsp;|&nbsp; Task Poster <b><?php echo $task_setting->task_post_fee;?>%</b> &nbsp;|&nbsp; Refund <b><?php echo $task_setting->task_post_refund_fee;?>%</b></td>
			<th>Today(<?php echo $site_setting->currency_symbol;?>)</th>
			<th>This Week(<?php echo $site_setting->currency_symbol;?>)</th>
			<th>This Month(<?php echo $site_setting->currency_symbol;?>)</th>
			<th>This Year(<?php echo $site_setting->currency_symbol;?>)</th>
			
		</tr>
		</thead>
		<tbody>
			<tr class="even">
				
				<td class="tc" colspan="2" ><b>Earning</b></td>
				<td>
				<?php $daily_post_task_earning=get_daily_earning_on_post_task(); 
					$daily_runner_pay_earning=get_daily_earning_on_runner_pay();
					
					echo number_format(($daily_post_task_earning+$daily_runner_pay_earning),2);
					
					?>
				 </td>
                <td><?php 
				
				$weekly_post_task_earning=get_weekly_earning_on_post_task(); 
					$weekly_runner_pay_earning=get_weekly_earning_on_runner_pay();
					
					echo number_format(($weekly_post_task_earning+$weekly_runner_pay_earning),2);
					
				
				?></td>
				<td><?php $monthly_post_task_earning=get_monthly_earning_on_post_task(); 
					$monthly_runner_pay_earning=get_monthly_earning_on_runner_pay();
					
					echo number_format(($monthly_post_task_earning+$monthly_runner_pay_earning),2);
					
					?>  </td>
                <td><?php $yearly_post_task_earning=get_yearly_earning_on_post_task(); 
					$yearly_runner_pay_earning=get_yearly_earning_on_runner_pay();
					
					echo number_format(($yearly_post_task_earning+$yearly_runner_pay_earning),2);
					
					?> </td>
				
			</tr>	
			
			<tr class="odd">
				
				<td class="tc" colspan="2"><b>Escrow</b></td>
				<td><?php echo get_daily_escrow_pay(); ?> </td>
                <td><?php echo get_weekly_escrow_pay(); ?></td>
				<td><?php echo get_monthly_escrow_pay(); ?> </td>
                <td><?php echo get_yearly_escrow_pay(); ?></td>
				
			</tr>	
			<tr class="even">
				
				<td class="tc" colspan="2"><b>Pay</b></td>
				<td><?php echo get_daily_runner_pay(); ?> </td>
                <td><?php echo get_weekly_runner_pay(); ?> </td>
				<td><?php echo get_monthly_runner_pay(); ?> </td>
                <td><?php echo get_yearly_runner_pay(); ?></td>
				
			</tr>
			
		</tbody>
		</table>
		</div>
		
	
        
        
		</div>
	</div>
	<div class="clear"></div>
	
	<!--end user/worker-->
    
    
    
	<div class="column full" style="width:50%; float:right;">
	
	<div class="box">		
		<div class="box themed_box">
		<h2 class="box-header">Heighest Task City</h2>
			
			<div class="box-content box-table">
			
			<table class="tablebox">

				<thead class="table-header">
				
					<tr>  
                        <th>City</th>
						<th>No Of Tasks</th>
                        
					</tr>
				</thead>
				
				<tbody class="openable-tbody">
				<?php
                    if($city)
                    {
                        $i=0;
                        foreach($city as $c)
                        {
                            if($i%2=="0")
                            {
                                $cl = "odd";	
                            }else{	
                                $cl = "even";	
                            }
                  ?>
				 
					<tr class="<?php echo $cl; ?>">
                        <td class="tc"><?php echo $c->city_name; ?></td>
						 <td class="tc"><?php echo $c->total; ?></td>
                        
                  	</tr>
				  <?php
                            $i++;
                        }
						
						
                    }
                  ?>	
				  
				  
				</tbody>
			</table>
			
			
			
                
			</div>
		</div>
		
	</div>
</div>	
<!--min task city-->
<div class="column full" style="width:50%;">
	
	<div class="box">		
		<div class="box themed_box">
		<h2 class="box-header">Minimum Task City</h2>
			
			<div class="box-content box-table">
			
			<table class="tablebox">

				<thead class="table-header">
				
					<tr>  
                        <th>City</th>
						<th>No Of Tasks</th>
                        
					</tr>
				</thead>
				
				<tbody class="openable-tbody">
				<?php
                    if($min_city)
                    {
                        $i=0;
                        foreach($min_city as $min_c)
                        {
                            if($i%2=="0")
                            {
                                $cl = "odd";	
                            }else{	
                                $cl = "even";	
                            }
                  ?>
				 
					<tr class="<?php echo $cl; ?>">
                        <td class="tc"><?php echo $min_c->city_name; ?></td>
						 <td class="tc"><?php echo $min_c->total; ?></td>
                        
                  	</tr>
				  <?php
                            $i++;
                        }
						
						
                    }
                  ?>	
				  
				  
				</tbody>
			</table>
                
			</div>
		</div>
	</div>
</div>	
<!--enf min task city-->
    
	
	<div class="clear"></div>
    
	<!-- user/worker-->
	<div class="box tabs black_box">
		<h2 class="box-header">Posters/Workers</h2>
		<ul class="tabs-nav">
		<li class="tab first"><a href="#tabs-3" onclick="display1()">Latest 10 Posters</a></li>
		<li class="tab"><a href="#tabs-4" onclick="display();">Latest 10 Runners</a></li>
		</ul>
		<div class="box-content box-table">
		<div id="tabs-3" style="display:block;">
		<table class="tablebox">
		<thead class="table-header">
		<tr>
			    <th class="first tc">Poster Name</th>
                        <th>Email</th>
                        <th>Signup IP Address</th>                                    
                        <th>Zip Code</th>
                        <th>Active</th>
                        <th class="tc">Registerd On</th>   
		</tr>
		</thead>
		<tbody>
			<?php
                    if($users)
                    {
                        $i=0;
                        foreach($users as $row)
                        {
                            if($i%2=="0")
                            {
                                $cl = "odd";	
                            }else{	
                                $cl = "even";	
                            }
                  ?>
					<tr class="<?php echo $cl; ?>">
                        <td class="tc">
						<?php 
							if($row->first_name != ''){
								echo anchor(front_base_url().'user/'.$row->profile_name,ucfirst($row->first_name).' '.ucfirst(substr($row->last_name,0,1)),' style="color:#004C7A;" target="_blank"');
							} else { 
								echo anchor(front_base_url().'user/'.$row->profile_name,ucfirst($row->full_name),' style="color:#004C7A;" target="_blank"');
							}
						?>
                        </td>
                        <td><?php echo $row->email; ?></td>
                        <td><?php echo $row->sign_up_ip; ?></td>
                        <td><?php echo $row->zip_code; ?></td>
                        <td><?php if($row->user_status=="1"){ echo "Active"; }else{ echo "Inactive"; } ?></td>
                        <td><?php echo date('d-m-Y',strtotime($row->sign_up_date)); ?></td>
                  	</tr>
				  <?php
                            $i++;
                        }
                    }
                  ?>	
		</tbody>
		</table>
		</div>
		
		<div id="tabs-4" style="display:none;">
		<table cellpadding="0" cellspacing="0" border="0" class="tablebox">
		<thead class="table-header">
		<tr>
			<th class="first tc">Runner Name</th>
                        <th>Email</th>
                        <th>Signup IP Address</th>                                    
                        <th>Zip Code</th>
                        <th>Active</th>
                        <th class="tc">Registerd On</th>   
		</tr>
		</thead>
		<tbody>
			<?php
                    if($workers)
                    {
                        $i=0;
                        foreach($workers as $row)
                        {
                            if($i%2=="0")
                            {
                                $cl = "odd";	
                            }else{	
                                $cl = "even";	
                            }
                  ?>
					<tr class="<?php echo $cl; ?>">
                        <td class="tc">
                        <?php 
							if($row->first_name != ''){
								echo anchor(front_base_url().'user/'.$row->profile_name,ucfirst($row->first_name).' '.ucfirst(substr($row->last_name,0,1)),' style="color:#004C7A;" target="_blank"');
							} else { 
								echo anchor(front_base_url().'user/'.$row->profile_name,ucfirst($row->full_name),' style="color:#004C7A;" target="_blank"');
							}
						?>
                        
                        </td>
                        <td><?php echo $row->email; ?></td>
                        <td><?php echo $row->sign_up_ip; ?></td>
                        <td><?php echo $row->zip_code; ?></td>
                        <td><?php if($row->user_status=="1"){ echo "Active"; }else{ echo "Inactive"; } ?></td>
                        <td><?php echo date('d-m-Y',strtotime($row->sign_up_date)); ?></td>
                  	</tr>
				  <?php
                            $i++;
                        }
                    }
                  ?>	
			
		</tbody>
		</table>
		</div>
		</div>
	</div>
	<div class="clear"></div>
	
	<!--end user/worker-->
    

<div class="box tabs black_box">
		<h2 class="box-header">Tasks</h2>
		<ul class="tabs-nav">
		<li class="tab first"><a href="#tabs-1">Latest 10 Complete Tasks</a></li>
		<li class="tab"><a href="#tabs-2">Latest 10 Posted Tasks</a></li>
		</ul>
		<div class="box-content box-table">
		<div id="tabs-1">
		<table class="tablebox">
		<thead class="table-header">
		<tr>
			 <th class="first tc">Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>City</th>                                    
                        <th>Poster Name</th>
                        <th>Assing Worker</th>
                        <th class="tc">Posted On</th>  
		</tr>
		</thead>
		<tbody>
			<?php
                    if($complete_task)
                    {
                        $i=0;
                        foreach($complete_task as $row)
                        {
                            if($i%2=="0")
                            {
                                $cl = "odd";	
                            }else{	
                                $cl = "even";	
                            }
                  ?>
					<tr class="<?php echo $cl; ?>">
                        <td class="tc"><?php echo anchor(front_base_url().'tasks/'.$row->task_url_name,ucfirst($row->task_name),' style="color:#004C7A;" target="_blank"'); ?></td>
                        <td>$<?php echo $row->task_price; ?></td>
                        <td><?php echo get_category_name($row->task_category_id); ?></td>
                        <td><?php echo get_city_name($row->task_city_id); ?></td>
                        <td><?php echo get_user_name($row->user_id);?></td>
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
                       
                        <td><?php echo date('d-m-Y',strtotime($row->task_post_date)); ?></td>
                  	</tr>
				  <?php
                            $i++;
                        }
                    }
                  ?>	
		</tbody>
		</table>
		</div>
		
		<div id="tabs-2">
		<table cellpadding="0" cellspacing="0" border="0" class="tablebox">
		<thead class="table-header">
		<tr>
			<th class="first tc">Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>City</th>                                    
                        <th>Poster Name</th>
                       <!-- <th>Assing Worker</th>-->
                        <th>Active</th>
                        <th class="tc">Posted On</th> 
		</tr>
		</thead>
		<tbody>
			<?php
                    if($tasks)
                    {
                        $i=0;
                        foreach($tasks as $row)
                        {
                            if($i%2=="0")
                            {
                                $cl = "odd";	
                            }else{	
                                $cl = "even";	
                            }
                  ?>
					<tr class="<?php echo $cl; ?>">
                        <td class="tc"><?php echo anchor(front_base_url().'tasks/'.$row->task_url_name,ucfirst($row->task_name),' style="color:#004C7A;" target="_blank"'); ?></td>
                        <td>$<?php echo $row->task_price; ?></td>
                        <td><?php echo get_category_name($row->task_category_id); ?></td>
                        <td><?php echo get_city_name($row->task_city_id); ?></td>
                        <td><?php //echo get_user_name($row->user_id); ?>
                        <?php echo get_user_name($row->user_id);?></td>
                        <td><?php if($row->task_status=="1"){ echo "Active"; }else{ echo "Inactive"; } ?></td>
                        <td><?php echo date('d-m-Y',strtotime($row->task_post_date)); ?></td>
                  	</tr>
				  <?php
                            $i++;
                        }
                    }
                  ?>	
			
		</tbody>
		</table>
		</div>
		</div>
	</div>
	<div class="clear"></div>
</div>