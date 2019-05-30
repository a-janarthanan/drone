<script type="text/javascript" language="javascript">
function setchecked(elemName,status){
	elem = document.getElementsByName(elemName);
	for(i=0;i<elem.length;i++){
		elem[i].checked=status;
	}
}
</script>







<div id="content" align="center">


	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">Assign Rights </h2> 
			<div class="box-content">	
			  <?php
				$attributes = array('name'=>'frm_assignrights');
				echo form_open('rights/add_rights/'.$admin_id,$attributes);
			  ?>

                   <div class="box-content box-table" style="border: 1px solid #D8D8D8; border-radius:5px; ">
                      <table class="tablebox">
                          <tbody class="openable-tbody">
                          	<tr><td colspan="2" style="text-align:left;"><label class="form-label">
                            	<a href="javascript:void(0)" onclick="javascript:setchecked('rights_id[]',1)" style="color:#000;"><?php echo "Check All"; ?></a>|<a href="javascript:void(0)" onclick="javascript:setchecked('rights_id[]',0)" style="color:#000;"><?php echo "Clear All"; ?></a></label>
                            </td></tr>
                            
                     <?php												
							if($rights)
							{
								foreach($rights as $rig)
								{																
					?>														
							<tr>
								<td style="text-align:left;"><input type="checkbox" name="rights_id[]" value="<?php echo $rig->rights_id; ?>" style="width:40px;" <?php if($assign_rights) { if(in_array($rig->rights_id,$assign_rights)) { ?> checked="checked" <?php } } ?> /></td>
								<td style="text-align:left;"><label class="form-label"><?php echo str_replace('_',' ',$rig->rights_name); ?></label></td>
							</tr>
					<?php 	} 		
						} 
					?>	
                  </table>                 
                 </div>
                 
                 <label class="form-label">&nbsp;</label> 
                 <input type="hidden" name="admin_id" id="admin_id" value="<?php echo $admin_id; ?>" />													 									 				 <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
				 <input type="submit" name="submit" value="Update" class="button themed" onclick=""/>
                
				  
			  </form>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>