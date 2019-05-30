<script type="text/javascript" language="javascript">
	function delete_rec(id,offset)
	{
		var ans = confirm("Are you sure to delete user?");
		if(ans)
		{
			location.href = "<?php echo base_url(); ?>/cronjob/delete_cronjob/"+id+"/"+offset;
		}else{
			return false;
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
			
			window.location.href='<?php echo base_url();?>cronjob/list_cronjob/'+limit+'/<?php echo $option; ?>';
		}
	
	}
	
	function gomain(x)
	{
		
		if(x == 'all')
		{
			window.location.href= '<?php echo base_url();?>cronjob/list_cronjob';
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
		<h2 class="box-header">Cronjob </h2>
			
			<div class="box-content box-table">
			<table class="tablebox">
            
                <div id="topbar" style="border:#CCC solid 1px;">
                   <div style="float:left; width:135px;">
					   <strong>Show :</strong>
                            <?php if($search_type=='normal') { ?>
                            <select name="limit" id="limit" onchange="getlimit(this.value)" style="width:80px;">
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
                   
                     <form name="frm_search" id="frm_search" method="post" action="<?php echo base_url(); ?>cronjob/run/<?php echo $limit; ?>" onSubmit="return chk_valid();">
                     <strong>&nbsp;&nbsp;&nbsp;Search By</strong>&nbsp;
                        <select name="option" id="option" style="width:216px;" onChange="gomain(this.value)">
                             <option value="">Select Cron Job</option>
					  <?php
                      	foreach($crons as $cr){
							?>
								<option value="<?php echo $cr->cron_function; ?>"><?php echo $cr->cron_title; ?></option>
							<?php
						}
					  ?>
                        </select>
        
                       <!-- <input type="text" name="keyword" id="keyword" value="<?php //echo $keyword;?>" class="textfield"/>-->                
                        <input type="submit" name="submit" id="submit" value="Run" class="button themed" /> 
                     </form> 

                 </div>

				<thead class="table-header">
					<tr> 
                        <th class="first tc">Cron Job</th>
                        <th>User Name</th>
                        <th>Last Run Time</th>                                    
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
					<tr class="<?php echo $cl; ?>">
                        <td class="tc"><?php echo $row->cron_title; ?></td>
                        <td><?php if($row->user_id > 0) { echo $row->username; } else{ echo 'SERVER'; }  ?></td>              
                        <td><?php echo date('d M,Y H:i:s',strtotime($row->date_run)); ?></td>
                        <td><?php if($row->status=='1'){  echo 'Records updated by this cronjob';	}else{ echo 'No Records updated by this cronjob';	 } ?></td>
                       
                  	</tr>
				  <?php
                            $i++;
                        }
                    } else { ?>
							<tr class="odd">
                                <td colspan="8">No Cronjob found .</td>
                            </tr>
					<?php }
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

<script type="text/javascript">
function getlimit(limit)
	{
		if(limit=='0')
		{
		return false;
		}
		else
		{
			window.location.href='<?php echo base_url();?>cronjob/list_cronjob/'+limit;
		}
	
	}	
</script>