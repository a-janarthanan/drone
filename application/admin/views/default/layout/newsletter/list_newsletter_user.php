<script type="text/javascript" language="javascript">
function setchecked(elemName,status){
	elem = document.getElementsByName(elemName);
	for(i=0;i<elem.length;i++){
		elem[i].checked=status;
	}
}

/*function setaction(elename, actionval, actionmsg, formname) {
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
}*/
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
			window.location.href='<?php echo base_url();?>newsletter/list_newsletter_user/'+limit;
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
			
			window.location.href='<?php echo base_url();?>newsletter/search_newsletter_user/'+limit+'/<?php echo $option.'/'.$keyword; ?>';
		}
	
	}
	
	function gomain(x)
	{
		
		if(x == 'all')
		{
			window.location.href= '<?php echo base_url();?>newsletter/list_newsletter_user';
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
		<h2 class="box-header">Newsletters User List</h2>
			
			<div class="box-content box-table">
			<table class="tablebox">
            
                <div id="topbar" style="border:#CCC solid 1px;">
                    <div style="float:left;">
                       <strong>Show</strong>
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
                    
                    <form name="frm_search" id="frm_search" method="post" action="<?php echo base_url(); ?>newsletter/search_newsletter_user/" onSubmit="return chk_valid();">
                
                <select name="option" id="option" style="width:100px;" onchange="gomain(this.value)">
                <option value="all">All</option> 
                	<option value="user_name" <?php if($option=='user_name'){?> selected="selected"<?php }?>>Username</option>
                    <option value="email" <?php if($option=='email'){?> selected="selected"<?php }?>>Email</option>
                </select>
                
                
                 <input type="text" name="keyword" id="keyword" value="<?php echo $keyword;?>" />              
                <input type="submit" name="submit" id="submit" class="button themed" value="GO" />
                
                </form> 
				 <div style="float:right;">
                 <form name="frm_listuser" id="frm_listuser" action="<?php echo base_url();?>newsletter/action_newsletter_user" method="post">
				 &nbsp;<?php echo anchor('newsletter/add_newsletter_user','<span class="icon_text addnew"></span>add new','class="button white"  style="margin: 0px;"'); ?>
				<input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
				<input type="hidden" name="action" id="action" />
				 <a href="javascript:void(0)"  onclick="setaction('chk[]','delete', 'Are you sure, you want to delete selected record(s)?', 'frm_listuser')" class="button white" style="margin: 0px;"><span class="icon_text cancel"></span> Delete</a>
                 <!--<a href="javascript:void(0)"  onclick="setaction('chk[]','delete', 'Are you sure, you want to delete selected record(s)?', 'frm_listuser')" class="button white"  style="margin: 0px;"><span class="icon_text cancel"></span> Delete</a>-->
                 <?php echo anchor('newsletter/export_newsletter_user/'.strtotime(date('H:i:s')),'Export CSV','class="button white"  style="margin: 0px;"'); ?>
                 <?php echo anchor('newsletter/import_newsletter_user','Import CSV','class="button white"  style="margin: 0px;"'); ?>
                 </div>
 
                    
                 </div>

				<thead class="table-header">
				
		  
					<tr><th width="10%"><a href="javascript:void(0)" onclick="javascript:setchecked('chk[]',1)" style="color:#000;"><?php echo "Check All"; ?></a>|<a href="javascript:void(0)" onclick="javascript:setchecked('chk[]',0)" style="color:#000;"><?php echo "Clear All"; ?></a></th>
                        <th class="first tc">Name</th>
                        <th>Email</th>
                        <th>Signup IP Address</th>
                        <th>Date</th>                                    
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
                   		
						<td><input type="checkbox" name="chk[]" id="chk" value="<?php   echo $row->newsletter_user_id;?>" /></td>
                        <td class="tc"><?php if($row->user_name=='') { echo "N/A"; } else { echo $row->user_name; }?></td>
                        <td><?php echo $row->email; ?></td>
                        <td><?php echo $row->user_ip; ?></td>
                       
                        <td><?php echo date('d M,Y H:i:s',strtotime($row->user_date)); ?></td>
						<td>
							<?php echo anchor('newsletter/edit_newsletter_user/'.$row->newsletter_user_id.'/'.$offset,'<span class="icon_single edit"></span>','class="button white"  title="Edit NewsLettwer"'); ?>
						</td>
                     
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