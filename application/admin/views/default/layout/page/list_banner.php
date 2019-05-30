<script type="text/javascript" language="javascript">
	function delete_rec(id,offset)
	{
		var ans = confirm("Are you sure to delete Banner Image?");
		if(ans)
		{
			location.href = "<?php echo base_url(); ?>pages/delete_banner/"+id+"/"+offset;
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
		<h2 class="box-header">Banner</h2>
			
			<div class="box-content box-table">
			<table class="tablebox">
            
                <div id="topbar" style="border:#CCC solid 1px;">
                    
                    
                  
			 
			 <div style="float:right;">
              <form name="frm_listuser" id="frm_listuser" action="<?php echo base_url();?>newsletter/action_newsletter" method="post">
          <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
           <input type="hidden" name="action" id="action" />
				 &nbsp;<?php echo anchor('pages/add_banner','<span class="icon_text addnew"></span>Add Banner','class="button white" style="margin: 0px;" id="AddNewsletter" title="Add Banner"'); ?>
						 <script>
							//jQuery("#AddNewsletter").fancybox();
						</script>
               
             
                 
                 </div>
                 </div>

				<thead class="table-header">
				
		  
					<tr> 
						<th class="first tc">image</th>
                        <th>Title</th>
                                                              
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
                    
                   
                   		<td  class="thumb-td tc"><a class="lightbox" href="<?php echo front_base_url();?>upload/banner/<?php echo $row->image_name	;?>" title="<?php echo $row->image_name	;?>"><img src="<?php echo front_base_url();?>upload/banner/<?php echo $row->image_name	;?>" alt="image-gallery"/></a></td>
                        
                                    
                                    
                        <td align="center" valign="middle"><?php echo $row->title; ?></td>
                                      
                                      
                       
					   <td><?php echo anchor('pages/edit_banners/'.$row->id.'/'.$offset,'<span class="icon_single edit"></span>','class="button white" id="banner_'.$row->id.'" title="Edit Banner"'); ?>
					   
					   
					 <a href="#" onClick="delete_rec('<?php echo $row->id; ?>','<?php echo $offset; ?>')" class="button white"><span class="icon_single cancel"></span></a>
                    
                    
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