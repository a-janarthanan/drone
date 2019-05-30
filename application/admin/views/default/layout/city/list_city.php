<script type="text/javascript" language="javascript">
	function delete_rec(id,offset)
	{
		var ans = confirm("Are you sure to delete city?");
		if(ans)
		{
			location.href = "<?php echo base_url(); ?>city/delete_city/"+id+"/"+offset;
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
			window.location.href='<?php echo base_url();?>city/list_city/'+limit;
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
			
			window.location.href='<?php echo base_url();?>city/search_list_city/'+limit+'/<?php echo $option.'/'.$keyword; ?>';
		}
	
	}
	
	function gomain(x)
	{
		
		if(x == 'all')
		{
			window.location.href= '<?php echo base_url();?>city/list_city';
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
		<h2 class="box-header">Cities
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
                    
                <form name="frm_search" id="frm_search" method="post" action="<?php echo base_url(); ?>city/search_list_city/<?php echo $limit; ?>" onSubmit="return chk_valid();">
                
                <select name="option" id="option" style="width:100px;" onchange="gomain(this.value)">
                <option value="all">All</option> 
                	<option value="statename" <?php if($option=='statename'){?> selected="selected"<?php }?>>State Name</option>  
               		<option value="countryname" <?php if($option=='countryname'){?> selected="selected"<?php }?>>Country Name</option>
                    <option value="cityname" <?php if($option=='cityname'){?> selected="selected"<?php }?>>City Name</option>                  
                </select>
                
                
                <input type="text" name="keyword" id="keyword" value="<?php echo $keyword;?>" />        
                <input type="submit" name="submit" id="submit" class="button themed" value="GO" />
                
                </form> 
				 <div style="float:right;">
                <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
           <input type="hidden" name="action" id="action" />
				 &nbsp;<?php echo anchor('city/add_city','<span class="icon_text addnew"></span>add new','class="button white" id="city" title="Add City"  style="margin: 0px;"'); ?>
				 
						<script>
							//jQuery("#city").fancybox();
						</script>

                 
              
                 
                 </div>
                 
			
          
			
                 </div>

				<thead class="table-header">
	              <tr>
                  <th>City Name</th> 
                    <th>State</th>
					<th>Country</th>
                        <th>Active</th>
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
                        <th width="20%"><?php echo $row->city_name; ?></th>
						<td width="20%"><?php echo $row->state_name; ?></td>
                        <td width="20%"><?php echo $row->country_name; ?></td>
                        <td width="20%"><?php if($row->active=="1"){ echo "Active"; }else{ echo "Inactive"; } ?></td>
                       
                      
                      <td width="20%">
					  <?php echo anchor('city/edit_city/'.$row->city_id.'/'.$offset,'<span class="icon_single edit"></span>','class="button white" id="city_'.$row->city_id.'" title="Edit City"'); ?>
					  
					    <script>
							//jQuery("#city_"+<?php echo $row->city_id;?>).fancybox();
						</script>
					  
					    <a href="#" onClick="delete_rec('<?php echo $row->city_id; ?>','<?php echo $offset; ?>')" class="button white"><span class="icon_single cancel"></span></a></td>
					
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