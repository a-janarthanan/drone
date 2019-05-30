<div id="content">        
	<?php if($error != ""){ ?>
        <div class="column full">
            <span class="message information"><strong><?php echo $error;?></strong></span>
        </div>
    <?php } ?>
	<div class="clear"></div>
	<div class="column full">
	
	<div class="box">		
		<div class="box themed_box">
		<h2 class="box-header">Email Templates </h2>
			
			<div class="box-content box-table">
			<table class="tablebox">

				<thead class="table-header">
					<tr> 
                        <th class="first tc">Sr. No</th>
                        <th style="text-align:left; padding-left:20px;">Email Template Name</th>
                        <th class="tc">Action</th>        
					</tr>
				</thead>
				
				<tbody class="openable-tbody">
				<?php
                    if($template)
                    {
                        $i=1;
                        foreach($template as $row)
                        {
                            if($i%2=="0")
                            {
                                $cl = "even";	
                            }else{	
                                $cl = "odd";	
                            }
                  ?>
					<tr class="<?php echo $cl; ?>">
                        <td class="tc"><?php echo $i;?></td>
                        <td style="text-align:left; padding-left:20px;"><?php echo $row->task;?></td> 
                        <td><?php echo anchor('email_template/add_email_template/'.$row->email_template_id,'<span class="icon_single edit"></span>',' title="Edit Email Tamplate" class="button white" id="editTemplate_'.$row->email_template_id.'" ');?></td>
                        
                        <script>
							jQuery("#editTemplate_"+<?php echo $row->email_template_id;?>).fancybox();
						</script>
                  	</tr>
				  <?php
                            $i++;
                        }
                    }
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