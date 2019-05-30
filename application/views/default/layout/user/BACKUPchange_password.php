

<div class="main">
<div class="incon">
    	<div class="mconleft">


  <div class="padT10B20">
           <div id="s1postJ">Change Password : <?php echo $user_info->email; ?></div>
         
          	<div class="marTB10">
            
          
  <?php if($error!=''){ ?>
				<div id="error">
					<ul>
					<?php  echo $error; ?>
					</ul>
				</div>
			<?php }  ?>
            
            
 <?php
		$attributes = array('name'=>'changepasswordForm','id'=>'changepasswordForm','class'=>'form_design');
		echo form_open('change_password',$attributes);
	?>
            
            
              <fieldset>
         
        
            <table width="80%" border="0" cellspacing="0" cellpadding="5">
    
     <tr id="passwordTR">
        <td valign="top" width="28%"><label class="lab1">New Password</label></td>
        <td width="72%"><input type="password" name="password" id="password" value=""  class="ntext"  /><br />

       <span id="passwordInfo"></span>
        </td>
      </tr>
      
      </table>
        </fieldset>
             
			</div>           
                


                

<div class="marTB10">
	           
          <input type="submit" value="Change" class="submbg2" name="changepasswordbtn" id="changepasswordbtn">     
               
            </form>   
               
</div>            


                


            
            
         
  </div>      
                
                
		</div>
        
        <?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
		
        
        
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/validation.js"></script>