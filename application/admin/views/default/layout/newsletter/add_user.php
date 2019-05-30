<script type="text/javascript">

function setchecked(elemName,status){
	elem = document.getElementsByName(elemName);
	for(i=0;i<elem.length;i++){
		elem[i].checked=status;
	}
}
</script>

<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header"> <?php if($newsletter_user_id==""){ echo 'Add '; } else { echo 'Edit '; }?>Newsletter User</h2> 
			<div class="box-content">
			
			  <?php
				$attributes = array('name'=>'frm_user_setting');
				echo form_open('newsletter/add_newsletter_user',$attributes);
				
				
			  ?>
			  
			  	  <label class="form-label">Username </label>
                  
				   <input type="text" name="user_name" class="form-field width40" id="user_name" value="<?php echo $user_name; ?>" onfocus="show_bg('user_name')" onblur="hide_bg('user_name')"/>
				 
                  <label class="form-label">Email </label>
			  <input type="text" name="email" class="form-field width40" id="email" value="<?php echo $email; ?>" onfocus="show_bg('email')" onblur="hide_bg('email')"/>
				  									
				
				<div style="padding-top:5px;">
								<?php if($all_newsletter) { ?>	<h3>Subscribe Newsletter</h3>

 <div style="float:left;"> 
                  <a href="javascript:void(0)" onclick="javascript:setchecked('newsletter_id[]',1)" style="color:#000;"><?php echo "Check All"; ?></a>&nbsp; |&nbsp; 
           <a href="javascript:void(0)" onclick="javascript:setchecked('newsletter_id[]',0)" style="color:#000;"><?php echo "Clear All"; ?></a>
                     
            </div>
           <div style="clear:both; height:15px;"></div>
		   
		   
		    <?php } ?>
                    <table border="0" cellpadding="2" cellspacing="2" align="left">
                    
                    
                    <?php if($all_newsletter) {  $cnt=0;  ?>
                            <tr>																					
                        <?php foreach($all_newsletter as $alnw) { ?>
                        
                        <td align="left" valign="top" style="padding:0px 5px 5px 5px;"><input type="checkbox" name="newsletter_id[]" id="newsletter_id" value="<?php echo $alnw->newsletter_id;?>" <?php if($all_subscription) { if(in_array($alnw->newsletter_id,$all_subscription)) { ?> checked="checked" <?php } } ?> style="width:30px;" /></td><td align="left" valign="top"><?php echo $alnw->subject; ?></td>						
                        
                        <?php $cnt++; if($cnt>4) { echo "</tr><tr>"; $cnt=0; }  
                            }
                         ?>
                         </tr>
                         
                         <?php } ?>
                        
                            
                    
                    
                    </table>									
									
				</div>
									
				
				  <br /> <br /><br /><label class="form-label">&nbsp;</label>
				 <input type="hidden" name="newsletter_user_id" id="newsletter_user_id" value="<?php echo $newsletter_user_id; ?>" />
				 <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
					 <?php
						if($newsletter_user_id=="")
						{
						?>				  
									  
                             <input type="submit" class="button themed" name="submit" value="Submit" />
				<?php }
				 else{?>
				            
				        <input type="submit" class="button themed" name="submit" value="Update" />
						<?php } ?>
						
						
				<input type="button" name="cancel" value="Cancel" class="button themed"  onClick="location.href='<?php echo base_url(); ?>newsletter/list_newsletter_user'"/>
			  </form>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>