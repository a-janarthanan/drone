<script type="text/javascript">
  function show_status(val)
	{	
		document.forms["frm_daily_search"].submit();
	}   
</script>
<div style=" margin-left:49px;"><br />
<?php  
	   $this->active = $this->uri->uri_string();
	   $this->strdd = explode("/",$this->active);
	   
	   if($this->strdd[1] == 'daily_report') { $class_day = 'themed'; } else { $class_day= 'white'; }
	   if($this->strdd[1] == 'monthly_report') { $class_month = 'themed'; } else { $class_month= 'white'; }
	   if($this->strdd[1] == 'yearly_report') { $class_year = 'themed'; } else { $class_year= 'white'; }
	   
	   
	   $check_daily_report=get_rights('list_daily_report');
	    $check_monthly_report=get_rights('list_monthly_report');
		 $check_yearly_report=get_rights('list_yearly_report');
	   
	   
	   if($check_daily_report==1) { 
	   echo anchor('wallet_report/daily_report','Daily Report',' title="Daily Report" class="button '.$class_day.'"').'&nbsp';
	   }
	   
	    if($check_monthly_report==1) { 
	   
	   echo anchor('wallet_report/monthly_report','Monthly Report',' title="Monthly Report" class="button '.$class_month.'"').'&nbsp';
	   
	   }
	   
	     if($check_yearly_report==1) { 
	   echo anchor('wallet_report/yearly_report','Yearly Report',' title="Yearly Report" class="button '.$class_year.'"');
	   }
?>
</div>
<div id="content">        
  
	<div class="clear"></div>
	<div class="column full">
	
	<div class="box">		
		<div class="box themed_box">
      
		<h2 class="box-header">Yearly Earning Report <span style="float:right; margin-right:10px;">Total : <?php echo $site_setting->currency_symbol.$this->wallet_report_model->total_earning($option);?></span></h2>
			
			<div class="box-content box-table">
			<table class="tablebox">
            
               <div id="topbar" style="border:#CCC solid 1px;">

                     <form name="frm_daily_search" id="frm_daily_search" method="post" action="<?php echo base_url(); ?>wallet_report/yearly_report">
                     <strong style="float:left; margin-bottom:10px; margin-top:4px;">&nbsp;&nbsp;&nbsp;Search By &nbsp;</strong>&nbsp;&nbsp;
                     
                       <select name="option" id="option" style="width:110px; float:left;" onChange="javascript:show_status(this.value);">
                            <option value="current_year" <?php if($option=='current_year'){?> selected="selected"<?php }?>>Current Year</option> 
                            <option value="one_year" <?php if($option=='one_year'){?> selected="selected"<?php }?>>Last 1 Year</option>
							<option value="two_year" <?php if($option=='two_year'){?> selected="selected"<?php }?>>Last 2 Years</option>
                            <option value="three_year" <?php if($option=='three_year'){?> selected="selected"<?php }?>>Last 3 Years</option>
                             <option value="six_year" <?php if($option=='six_year'){?> selected="selected"<?php }?>>Last 6 Years</option>
							<option value="all" <?php if($option=='all'){?> selected="selected"<?php }?>>All</option>
                       </select> 
                     </form>
					 </div> 

                
		
      
				<thead class="table-header">
					<tr> 
                        <th class="first tc" style="text-align:left; padding-left:10px;">Task Name</th>          
                        <th>Poster Name</th>
                        <th>Runner Name</th>
                        <th>Task Price</th>     
                        <th>Worker Pay</th>   
                        <th>Earning</th>     
					</tr>
				</thead>
				
				<tbody class="openable-tbody">
                
                 <?php 
                    if($result)
                    {	
						$year_showdate =''; $year_counter = 0; $year_showhedder=''; 
						$month_showdate =''; $month_counter = 0; $month_showhedder=''; 
						$showdate=''; $counter = 0; $showhedder=''; 
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
							
							
							$tasker_name = '';
							$earning_price= '0.00';
							$worker_pay = '0.00';
							
							
							if($row->task_worker_id !=0) {
								 $worker_wallet = $this->transaction_model->worker_pay($row->task_worker_id,$row->task_id);
								 //echo '<pre>'; print_r($worker_wallet); 
								 if($worker_wallet) {
								 
									 $tasker_name = anchor(front_base_url().'user/'.$worker_wallet->profile_name,ucfirst($worker_wallet->first_name).' '.ucfirst(substr($worker_wallet->last_name,0,1)),' style="color:#004C7A;" target="_blank"');
									 
									if($worker_wallet->total_cut_price != ''){
										$earning_price = $worker_wallet->total_cut_price;
									} else {
									 	 $earning_price = '0.00';
									}
									
									
									if($worker_wallet->debit != ''){
										 $worker_pay = $worker_wallet->debit;
									} else {
									 	 $worker_pay = '0.00';
									}
									
								}
								 
							}
							//==================== Year Header Display  Start================//
							
								if($year_showdate == '') {
								
									$total_daily_earning = $this->wallet_report_model->total_daily_earning(date('Y',strtotime($row->transaction_date_time)));
									
									$year_showdate = date('Y',strtotime($row->transaction_date_time));
									echo $year_showhedder = '<tr><th colspan="7" class="cat-header" style="background:#292929; border: 1px solid #292929; text-align:left;  padding-left:20px; ">'.date('Y',strtotime($row->transaction_date_time)).'<span style="float:right; margin-right:35px;">Total : '.$site_setting->currency_symbol.$total_daily_earning.'</span></th></tr>';	
								}
	
								
								if($year_showdate != date('Y',strtotime($row->transaction_date_time))){
									
									$total_daily_earning = $this->wallet_report_model->total_daily_earning(date('Y-m',strtotime($row->transaction_date_time)));
	
									$year_showdate = date('Y',strtotime($row->transaction_date_time));
									$year_showhedder = '<tr><th colspan="7" class="cat-header"  style="background:#292929; border: 1px solid #292929;text-align:left; padding-left:20px; ">'.date('Y',strtotime($row->transaction_date_time)).'<span style="float:right; margin-right:35px;">Total : '.$site_setting->currency_symbol.$total_daily_earning.'</span></th></tr>';	
									
									if($year_counter == 0) { $year_counter = 1;}
									
								} else { 
									$year_counter = 0; 
								}	
							
								if($year_counter == 1){ 
									echo $year_showhedder;								
								}
							
							//==================== Year Header Display  end================//
							
							
							//==================== Month Header Display  Start================//
							if($month_showdate == '') {
							
								$total_daily_earning = $this->wallet_report_model->total_daily_earning(date('Y-m',strtotime($row->transaction_date_time)));
								
								$month_showdate = date('Y-m',strtotime($row->transaction_date_time));
								echo $month_showhedder = '<tr><th colspan="7" class="cat-header" style="text-align:left; padding-left:20px; ">'.date('M, Y',strtotime($row->transaction_date_time)).'<span style="float:right; margin-right:35px;">Total : '.$site_setting->currency_symbol.$total_daily_earning.'</span></th></tr>';	
							}

							
							if($month_showdate != date('Y-m',strtotime($row->transaction_date_time))){
								
								$total_daily_earning = $this->wallet_report_model->total_daily_earning(date('Y-m',strtotime($row->transaction_date_time)));

								$month_showdate = date('Y-m',strtotime($row->transaction_date_time));
								$month_showhedder = '<tr><th colspan="7" class="cat-header"  style="text-align:left; padding-left:20px; ">'.date('M, Y',strtotime($row->transaction_date_time)).'<span style="float:right; margin-right:35px;">Total : '.$site_setting->currency_symbol.$total_daily_earning.'</span></th></tr>';	
								
								if($month_counter == 0) { $month_counter = 1;}
								
							} else { 
								$month_counter = 0; 
							}	
						
							if($month_counter == 1){ 
								echo $month_showhedder;	
							}
						//==================== Month Header Display  end================//
						
							
						//==================== Day Header Display  Start================//
							if($showdate == '') {
							
								$total_daily_earning = $this->wallet_report_model->total_daily_earning(date('Y-m-d',strtotime($row->transaction_date_time)));
								
								$showdate = date('Y-m-d',strtotime($row->transaction_date_time));
								echo $showhedder = '<tr><th colspan="7" class="cat-header"  style="background:#ececec; border: 1px solid #d8d8d8; text-align:left; color:#0669AF;padding-left:20px; ">'.date($site_setting->date_format,strtotime(date('Y-m-d',strtotime($row->transaction_date_time)))).'<span style="float:right; margin-right:35px;">Total : '.$site_setting->currency_symbol.$total_daily_earning.'</span></th></tr>';	
							}

							
							if($showdate != date('Y-m-d',strtotime($row->transaction_date_time))){
								
								$total_daily_earning = $this->wallet_report_model->total_daily_earning(date('Y-m-d',strtotime($row->transaction_date_time)));

								$showdate = date('Y-m-d',strtotime($row->transaction_date_time));
								$showhedder = '<tr><th colspan="7" class="cat-header"  style="background:#ececec; border: 1px solid #d8d8d8; text-align:left; color:#0669AF;padding-left:20px;">'.date($site_setting->date_format,strtotime(date('Y-m-d',strtotime($row->transaction_date_time)))).'<span style="float:right; margin-right:35px;">Total : '.$site_setting->currency_symbol.$total_daily_earning.'</span></th></tr>';	
								if($counter == 0) { $counter = 1;}
							} else { 
								$counter = 0; 
							}
							
							if($counter == 1){ 
								echo $showhedder;
							}
						//==================== Day Header Display  End================//
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
                       
                        <td><?php echo $site_setting->currency_symbol.$worker_pay;  ?></td>
                         <td><?php echo $site_setting->currency_symbol.$earning_price;  ?></td>
                        <!--<td><?php //echo date($site_setting->date_time_format,strtotime($row->transaction_date_time)); ?></td>-->
                  </tr>   
                  <?php
                            $i++;
                        }
                    }
					 else {
								  ?>        
								  
								  <tr class="alter">
                                    <td colspan="15" align="center" valign="middle" height="30">No Daily Report has been added yet.</td></tr>
								  
								  <?php } ?>
				
				</tbody>
			</table>
            
           
			</div>
		</div>
	</div>
</div>