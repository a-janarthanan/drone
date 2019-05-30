<script type="text/javascript" language="javascript">
	function delete_rec(id,offset)
	{
		var ans = confirm("Are you sure to delete Administrator?");
		if(ans)
		{
			location.href = "<?php echo base_url(); ?>admin/delete_admin/"+id+"/"+offset;
		}else{
			return false;
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
			window.location.href='<?php echo base_url();?>admin/list_admin/'+limit;
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
			
			window.location.href='<?php echo base_url();?>admin/search_list_admin/'+limit+'/<?php echo $option.'/'.$keyword; ?>';
		}
	
	}
	
	function gomain(x)
	{
		
		if(x == 'all')
		{
			window.location.href= '<?php echo base_url();?>admin/list_admin';
		}
		if(x == 'superadmin')
		{
			
			window.location.href= '<?php echo base_url();?>admin/list_admin_superadmin';
		}
		if(x == 'admin')
		{
			
			window.location.href= '<?php echo base_url();?>admin/list_admin_admin';
		}
		
	}
</script>
<div id="content">  
	<?php if($msg != ""){
            if($msg == "insert"){ $error = 'New Record has been added Successfully.';}
            if($msg == "update"){ $error = 'Record has been updated Successfully.';}
            if($msg == "delete"){ $error = 'Record has been deleted Successfully.';}
			if($msg == "rights") {  $error = 'Rights has been updated Successfully.';}
    ?>
        <div class="column full">
            <span class="message information"><strong><?php echo $error;?></strong></span>
        </div>
    <?php } ?>
	<div class="clear"></div>
	<div class="column full">
	
	<div class="box">		
		<div class="box themed_box">
		<h2 class="box-header">Users </h2>
			
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
                    
                    <form name="frm_search" id="frm_search" method="post" action="<?php echo base_url(); ?>admin/search_list_admin/<?php echo $limit; ?>" onSubmit="return chk_valid();">
                		 <strong>&nbsp;&nbsp;&nbsp;Search By</strong>&nbsp;
                            <select name="option" id="option" style="width:100px;" onchange="gomain(this.value)">
                            	<option value="all">All</option> 
                                <option value="username" <?php if($option=='username'){?> selected="selected"<?php }?>>User Name</option>  
                                <option value="superadmin" <?php if($option=='superadmin'){?> selected="selected"<?php }?>>Super Admin</option>
                                <option value="admin" <?php if($option=='admin'){?> selected="selected"<?php }?>>Admin</option>
                                <option value="email" <?php if($option=='email'){?> selected="selected"<?php }?>>E-mail</option>                   
                            </select>
                
                
                            <input type="text" name="keyword" id="keyword" value="<?php echo $keyword;?>" />                
                            <input type="submit" name="submit" id="submit" value="Search" class="button themed" /> 
                
                	</form>
                    
                    <div style="float:right;"><?php echo anchor('admin/add_admin','<span class="icon_text addnew"></span>Add New', 'class="button white" id="addadmin" style="margin:0px;"'); ?>	</div>
                    
                 
					   
							<script>
                                //jQuery("#addadmin").fancybox();
                            </script>
                    
                </div>
          		<thead class="table-header">
					<tr> 
                        <th class="first tc">Username</th>
                        <th>Password</th>
                        <th>Admin Type</th>
                        <th>Email</th>                                  
                        <th>Signup IP Address</th>                                    
                       
                        <th>Active</th>
                        <th>Registerd On</th> 
                        
                    	<?php 
							$assign_rights=get_rights('assign_rights');
                       			 if($assign_rights==1) { 
						?>
                        <th width="7%">Rigths</th>
                        <?php } ?>                      
                        <th class="tc">Action</th>                                  
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
                   		<td><?php echo $row->username; ?></td>
                        <td><?php echo $row->password; ?></td>
                        <td><?php if($row->admin_type==1) { echo "Super Admin"; } elseif($row->admin_type==2){ echo "Administrator"; } ?></td>
						<td><?php echo $row->email; ?></td>
						<td align="center" valign="middle"><?php echo $row->login_ip; ?></td>                                
                        <td align="center" valign="middle"><?php if($row->active=="1"){ echo "Active"; }else{ echo "Inactive"; } ?></td>
                        <td align="center" valign="middle"><?php echo date('d-m-Y',strtotime($row->date_added)); ?></td>
                        
						<?php 
							$assign_rights=get_rights('assign_rights');
								if(	$assign_rights==1) { 
						?>
							<td align="center" valign="middle"><?php echo anchor('rights/assign_rights/'.$row->admin_id.'/'.$offset,'<img src="'. base_url().getThemeName().'/images/admin_rights.jpg" border="0" />'); ?></td>
						<?php } ?>
									
						<td>
                        	<?php echo anchor('admin/edit_admin/'.$row->admin_id.'/'.$offset,'<span class="icon_single edit"></span>','class="button white" id="admin_'.$row->admin_id.'" title="Edit Admin"'); ?>
					   
						
                        
					   		<a href="#" onClick="delete_rec('<?php echo $row->admin_id; ?>','<?php echo $offset; ?>')" class="button white"><span class="icon_single cancel"></span></a>
                       </td>
                    </tr>
					<?php
							$i++;
							}
						} else { ?>
						<tr class="alter"><td colspan="15" align="center" valign="middle" height="30">No Admin has been added yet</td></tr>
					<?php 	}
					?> 
                  	</tr>
                </tbody>
                </table>
                <ul class="pagination">
					<?php echo $page_link; ?>
                </ul>

           </div>
       </div>
    </div>
</div>