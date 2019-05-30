<script type="text/javascript" language="javascript">
	function delete_rec(id,offset)
	{
		var ans = confirm("Are you sure to delete pages?");
		if(ans)
		{
			location.href = "<?php echo base_url(); ?>pages/delete_pages/"+id+"/"+offset;
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
			window.location.href='<?php echo base_url();?>pages/list_pages/'+limit;
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
			
			window.location.href='<?php echo base_url();?>pages/search_list_pages/'+limit+'/<?php echo $option.'/'.$keyword; ?>';
		}
	
	}
	
	function gomain(x)
	{
		
		if(x == 'all')
		{
			window.location.href= '<?php echo base_url();?>pages/list_pages';
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
		<h2 class="box-header">Pages
 </h2>
			
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
                    
                    <form name="frm_search" id="frm_search" method="post" action="<?php echo base_url(); ?>pages/search_list_pages/<?php echo $limit; ?>" onSubmit="return chk_valid();">
                
                <select name="option" id="option" style="width:100px;" onChange="gomain(this.value)">
                <option value="all">All</option> 
                	<option value="title" <?php if($option=='title'){?> selected="selected"<?php }?>>Page Title</option>  
                </select>
                
                
                 <input type="text" name="keyword" id="keyword" value="<?php echo $keyword;?>" />              
                <input type="submit" name="submit" id="submit" class="button themed" value="GO" />
                
                </form> 
				 <div style="float:right;">
                <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
                <input type="hidden" name="action" id="action" />
				 &nbsp;<?php echo anchor('pages/add_pages','<span class="icon_text addnew"></span>add new','class="button white"  style="margin: 0px;"'); ?>
                 
              
                 
                 </div>
                 
			
          
			
                 </div>

				<thead class="table-header">
			
		  
					<tr> 
					
                    	<!--<th class="first tc"><input type="checkbox" id="checkboxall"/> </th>-->
						 
                        <th class="first tc">Pages Title</th>
                        <th>Header</th>
                        <th>Left Sid</th>
                        <!--<th>Paypal Email ID</th>-->
                        <th>Right Side</th>                                    
                       <th>Footer</th>
                       <th>Active</th>
                       <th>Action</th>
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
						
                        <td class="tc"><?php echo $row->pages_title; ?></td>
                        <td><?php if($row->header_bar=='yes') { echo $row->header_bar; } ?></td>
                        <td><?php  if($row->left_side=='yes') { echo $row->left_side; } ?></td>
                        <!--<td><?php //echo $row->paypal_email; ?></td>-->
                        <td><?php  if($row->right_side=='yes') { echo $row->right_side; } ?></td>
						<td><?php  if($row->footer_bar=='yes') { echo $row->footer_bar; } ?></td>
                      <td><?php if($row->active=="1"){ echo "Active"; }else{ echo "Inactive"; } ?></td>
                      <td><?php echo anchor('pages/edit_pages/'.$row->pages_id.'/'.$offset,'<span class="icon_single edit"></span>','class="button white"'); ?>  <a href="#" onclick="delete_rec('<?php echo $row->pages_id; ?>','<?php echo $offset; ?>')" class="button white"><span class="icon_single cancel"></span></a></td>
					
                  	</tr>
				  <?php
                            $i++;
                        }
                    }
                   else {
								  ?>        
								  
								  <tr class="alter">
                                    <td colspan="15" align="center" valign="middle" height="30">No Page has been added yet.</td></tr>
								  
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