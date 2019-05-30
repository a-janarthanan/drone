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
	
function getlimit(limit)
	{
		if(limit=='0')
		{
		return false;
		}
		else
		{
			window.location.href='<?php echo base_url();?>newsletter/newsletter_job/'+limit;
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
			
			window.location.href='<?php echo base_url();?>newsletter/search_newsletter_job/'+limit+'/<?php echo $option.'/'.$keyword; ?>';
		}
	
	}
	
	function gomain(x)
	{
		
		if(x == 'all')
		{
			window.location.href= '<?php echo base_url();?>newsletter/newsletter_job';
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
		<h2 class="box-header">Newsletters Jobs List</h2>
			
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
                    
                      <form name="frm_search" id="frm_search" method="post" action="<?php echo base_url(); ?>newsletter/search_newsletter_job/" onSubmit="return chk_valid();">
                
                <select name="option" id="option" style="width:100px;" onchange="gomain(this.value)">
                <option value="all">All</option> 
                    <option value="subject" <?php if($option=='subject'){?> selected="selected"<?php }?>>Subject</option>         
                </select>
                
                <input type="text" name="keyword" id="keyword" value="<?php echo $keyword;?>" />               
                <input type="submit" name="submit" id="submit" value="GO" />
                
                </form> 
				
				 <div style="float:right;">
                <form  name="frm_listuser" id="frm_listuser" action="<?php echo base_url();?>newsletter/action_newsletter_job" method="post">
                <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
           <input type="hidden" name="action" id="action" />
				 &nbsp;<?php echo anchor('newsletter/add_newsletter_job','<span class="icon_text addnew"></span>add new','class="button white" style="margin:0px;"'); ?>
                 
                 <a href="javascript:void(0)"  onclick="setaction('chk[]','delete', 'Are you sure, you want to delete selected record(s)?', 'frm_listuser')" class="button white" style="margin:0px;"><span class="icon_text cancel"></span> Delete</a>
                 
                 </div>
			
          
			  <!--<spam style="padding-left:55px;">
			   <form name="frm_listuser" id="frm_listuser" action="<?php //echo base_url();?>newsletter/action_newsletter" method="post">
          <input type="hidden" name="offset" id="offset" value="<?php //echo $offset; ?>" />
           <input type="hidden" name="action" id="action" />
			 <?php //echo //anchor('newsletter/add_newsletter','Add','style="text-decoration:none;color:#000000;font-size:13px; font-weight:bold;"'); ?>	
			
			  <a href="javascript:void(0)"  onclick="setaction('chk[]','delete', 'Are you sure, you want to delete selected record(s)?', 'frm_listuser')" style="text-decoration:none;color:#000000;font-size:16px; font-weight:bold;" > Delete</a>
            </spam>-->
						
                     
                     <!--<form name="frm_listuser" id="frm_listuser" action="<?php //echo base_url();?>project_category/action_project/<?php //echo $limit; ?>" method="post">
        					<input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
           					<input type="hidden" name="action" id="action" />
          			 </form>-->
                    <!--<div style="float:right;"><a class="button white" href="<?php echo base_url().'user/add_user';?>"><span class="icon_text addnew"></span>Add New</a></div>-->
                 </div>

				<thead class="table-header">
			
		  
					<tr> 
					
                    	
						  <th class="first tc"> <a href="javascript:void(0)" onClick="javascript:setchecked('chk[]',1)" style="color:#000;"><?php echo "Check All"; ?></a>|<a href="javascript:void(0)" onClick="javascript:setchecked('chk[]',0)" style="color:#000;"><?php echo "Clear All"; ?></a></th>
                        <th class="first tc">Subject</th>
                        <th>Start Date</th>
                        <th>Statistics</th>
                        <!--<th>Paypal Email ID</th>-->
                        <th>Subscriber</th>                                    
                       <th>Send</th>
                       <th>Open</th>
                       <th>Fail</th>
                       <th>Create Date</th>
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
						<td><input type="checkbox" name="chk[]" id="chk" value="<?php echo $row->job_id;?>" /></td>
                        <td class="tc"><?php echo $row->subject; ?></td>
                        <td><?php echo date($site_setting->date_format,strtotime($row->job_start_date)); ?></td>
                        <td><div class="pad-left" style="float:none; text-align:center;"><a href="<?php echo base_url(); ?>newsletter/newsletter_statistics/<?php echo $row->job_id.'/'.$row->newsletter_id;?>" id="various<?php echo $row->job_id; ?>">View</a>
                         <script type="text/javascript">
		
												$("#various<?php echo $row->job_id; ?>").fancybox({
													'width'				: '85%',
													'height'			: '90%',
													'autoScale'			: true,
													'transitionIn'		: 'none',
													'transitionOut'		: 'none',
													'type'				: 'iframe'
												});			
		
												</script>
                        </td>
                        <!--<td><?php //echo $row->paypal_email; ?></td>-->
                        <td><div class="pad-left" style="float:none; text-align:center;" align="center"><?php $total_subscription=$this->newsletter_model->get_total_subscription($row->newsletter_id);
									if($total_subscription>0)
									{
									echo '('.$this->newsletter_model->get_total_subscription($row->newsletter_id).')';
									} else { echo "(0)"; }
									 ?></div></td>
						<td><?php $total_send=$this->newsletter_model->get_total_job_send($row->job_id);
						
						if($total_send>0) {	
									
									echo '('.$this->newsletter_model->get_total_job_send($row->job_id).')';
							} else { echo "(0)"; }
							
						  ?></div></td>
                          <td>
                          <div class="pad-left" style="float:none; text-align:center;" align="center"><?php $total_read=$this->newsletter_model->get_total_job_open($row->job_id);
							
						if($total_read>0) {		
									
									echo '('.$this->newsletter_model->get_total_job_open($row->job_id).')';
							} else { echo "(0)"; }
							
						 ?></div>
                          </td>
                          <td><div class="pad-left" style="float:none; text-align:center;" align="center"><?php $total_fail=$this->newsletter_model->get_total_job_fail($row->job_id);
						
						if($total_fail>0) {			
									
									echo '('.$this->newsletter_model->get_total_job_fail($row->job_id).')';
						} else { echo "(0)"; }  ?></div></td>
                         <td><?php echo date($site_setting->date_format,strtotime($row->job_date)); ?></td>
                       <!-- <td><?php //echo $row->address; ?></td>
                        <td><?php //echo $row->city; ?></td>
                        <td><?php //echo $row->state; ?></td>
                        <td><?php // echo $row->country; ?></td>-->
                       <!-- <td><?php //echo $row->zip_code; ?></td>
                        <td><?php //if($row->user_status=="1"){ echo "Active"; }else{ echo "Inactive"; } ?></td>
                        <td><?php //echo date('d-m-Y',strtotime($row->sign_up_date)); ?></td>
                       <!-- <td>
                         		 <a class="button white" href="#" onclick="delete_rec('<?php //echo $row->user_id; ?>','<?php echo $offset; ?>')"><span class="icon_single cancel"></span></a>                       
                      			 <a class="button white" href="<?php// echo base_url().'user/edit_user/'.$row->user_id.'/'.$offset;?>"><span class="icon_single edit"></span></a>
                        </td>-->
                  	</tr>
				  <?php
                            $i++;
                        }
                    }
                   else {
								  ?>        
								  
								  <tr class="alter">
                                    <td colspan="15" align="center" valign="middle" height="30">No Records found.</td></tr>
								  
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