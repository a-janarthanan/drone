<script type="text/javascript" language="javascript">
	function delete_rec(id,offset)
	{
		var ans = confirm("Are you sure to delete Task Category?");
		if(ans)
		{
			location.href = "<?php echo base_url(); ?>task_category/delete_task_category/"+id+"/"+offset;
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
		<h2 class="box-header">Categories</h2>
			
			<div class="box-content box-table">
			<table class="tablebox">
            
                <div id="topbar" style="border:#CCC solid 1px;">
                    <div style="float:left;">
                  <span class="tag tag-red">NOTE : </span> <span class="typo"><a class="spam">You can delete the category which have No Tasks or No Sub Categories.</a></span>
                      </div>
                    
                  
			 
			 <div style="float:right;">
              <form name="frm_listuser" id="frm_listuser" action="<?php echo base_url();?>newsletter/action_newsletter" method="post">
          <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
           <input type="hidden" name="action" id="action" />
				 &nbsp;<?php echo anchor('task_category/add_task_category','<span class="icon_text addnew"></span>Add Category','class="button white" style="margin: 0px;" id="AddNewsletter" title="Add Category"'); ?>
						 <script>
							//jQuery("#AddNewsletter").fancybox();
						</script>
               
             
                 
                 </div>
                 </div>

				<thead class="table-header">
				
		  
					<tr> 
						<th class="first tc">image</th>
                        <th>Category</th>
                           <th>Parent Category</th>
                        <th>Total Task</th>
                     
						
                          <th>Status</th>                                    
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
                    
                   
                   		<td  class="thumb-td tc"><a class="lightbox" href="<?php echo front_base_url();?>upload/category_orig/<?php echo $row->category_image;?>" title="<?php echo $row->category_image;?>"><img src="<?php echo front_base_url();?>upload/category/<?php echo $row->category_image;?>" alt="image-gallery"/></a></td>
                        <td><?php echo $row->category_name; ?></td>
                      
                        <td><?php
										$res_pr=$this->task_category_model->get_one_task_category($row->category_parent_id);
									
										if($res_pr)
										{											
											echo $res_pr['category_name'];
										}else{
											echo "Main";
										}
									?></td>
                                    
                                    
                                      <td align="center" valign="middle"><?php echo $row->total_task; ?></td>
                                      
                                      
                       <td><?php if($row->category_status=="1"){ echo "Active"; }else{ echo "Inactive"; } ?></td>
                      
					  
					   <td><?php echo anchor('task_category/edit_task_category/'.$row->task_category_id.'/'.$offset,'<span class="icon_single edit"></span>','class="button white" id="cat_'.$row->task_category_id.'" title="Edit Category"'); ?>
					   
					   
					<?php
					
					$check_sub_category=$this->task_category_model->check_category_have_sub_category($row->task_category_id);
					
					 if($row->total_task=='' || $row->total_task==0) { if($check_sub_category==0) { ?>   <a href="#" onClick="delete_rec('<?php echo $row->task_category_id; ?>','<?php echo $offset; ?>')" class="button white"><span class="icon_single cancel"></span></a>
                    <?php } } ?>
                    
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