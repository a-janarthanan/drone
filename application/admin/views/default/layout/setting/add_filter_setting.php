<div id="con-tabs">
          <ul>
           
		    <?php  $check_site_rights=$this->home_model->get_rights('add_site_setting');
		 		$check_meta_rights=$this->home_model->get_rights('add_meta_setting');
				$check_fb_rights=$this->home_model->get_rights('add_facebook_setting');
				$check_tw_rights=$this->home_model->get_rights('add_twitter_setting');
				$check_em_rights=$this->home_model->get_rights('add_email_setting');
				$check_filter_rights=$this->home_model->get_rights('add_filter_setting');
				$check_img_rights=$this->home_model->get_rights('add_image_setting');
			
			if($check_site_rights==1) {		?>
		   
		    <li><span style="cursor:pointer;"><?php echo anchor('site_setting/add_site_setting','Site'); ?></span></li>
			
			 <?php } if($check_meta_rights==1) { ?>
			
			<li><span style="cursor:pointer;"><?php echo anchor('meta_setting/add_meta_setting','Meta','id="sp_2"'); ?></span></li>
			
				<?php } if($check_fb_rights==1) { ?>
			
			<li><span style="cursor:pointer;"><?php echo anchor('facebook_setting/add_facebook_setting','Facebook'); ?></span></li>
			
			<?php } if($check_tw_rights==1) { ?>
			
			<li><span style="cursor:pointer;"><?php echo anchor('twitter_setting/add_twitter_setting','Twitter'); ?></span></li>
			
			<?php } if($check_em_rights==1) { ?>
			
			<li><span style="cursor:pointer;"><?php echo anchor('email_setting/add_email_setting','Email'); ?></span></li>  
			
			<?php }  if($check_filter_rights==1) { ?>
			
			<li><span style="cursor:pointer;"><?php echo anchor('site_setting/add_filter_setting','Filter','id="sp_1" style="color:#364852;background:#ececec;"'); ?></span></li>  
			
			<?php } if($check_img_rights==1) { ?>
            
               <li><span style="cursor:pointer;"><?php echo anchor('site_setting/add_image_setting','Image Size'); ?></span></li>      
               
               <?php } ?>
          </ul>
          <script language="javascript" src="<?php echo base_url(); ?>js/Tooltip.js"></script>
          <div id="text">
            <div id="1">
            
            <?php if($error != "")
					{?>
						<div style="text-align:center;" class="msgdisp">Record has been updated Successfully.</div>
					<?php }
			?>	
              <div class="fleft" style="width:100%;">
                <div style="height:10px;"></div>
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><img src="<?php echo base_url(); ?>images/c2-t-l.jpg" alt="" height="4" width="7" /></td>
                    <td background="<?php echo base_url(); ?>images/c2-t.jpg" width="99%"></td>
                    <td><img src="<?php echo base_url(); ?>images/c2-t-r.jpg" alt="" height="4" width="7" /></td>
                  </tr>
                  <tr>
                    <td background="<?php echo base_url(); ?>images/c2-l.jpg"></td>
                    <td valign="top" bgcolor="#FFFFFF"><div id="deal-tabs">
						<div id="deal-con">
							<div id="2" style="">
							  <div align="center">
								<div id="add-deal">
								  <?php
									$attributes = array('name'=>'frm_site_setting');
									echo form_open_multipart('site_setting/add_filter_setting',$attributes);
								  ?>
									<fieldset class="step">
									<div style="clear:both;"></div>
									<div class="fleft">
									  <label>Ending Soon(Days)<span>&nbsp;</span></label>
									  <span onmouseover="show_bg('ending_soon')" onmouseout="hide_bg('ending_soon')">
									  <input type="text" name="ending_soon" id="ending_soon" value="<?php echo $ending_soon; ?>" onfocus="show_bg('ending_soon')" onblur="hide_bg('ending_soon')"/>
									  </span>
									</div>
									
										<div style="clear:both;"></div>
									<div class="fleft">
									  <label>Small Project(<?php echo $site_setting['currency_code']; ?>)<span>&nbsp;</span></label>
									  <span onmouseover="show_bg('small_project')" onmouseout="hide_bg('small_project')">
									  <input type="text" name="small_project" id="small_project" value="<?php echo $small_project; ?>" onfocus="show_bg('small_project')" onblur="hide_bg('small_project')"/>
									  </span>
									</div>
									
									
									
									<div style="clear:both;"></div>
									<div class="fleft">
									  <label>Popular(%)<span>&nbsp;</span></label>
									  <span onmouseover="show_bg('popular')" onmouseout="hide_bg('popular')">
									  <input type="text" name="popular" id="popular" value="<?php echo $popular; ?>" onfocus="show_bg('popular')" onblur="hide_bg('popular')"/>
									  </span>
									</div>
									
									
									<div style="clear:both;"></div>
									<div class="fleft">
									  <label>Successful(%)<span>&nbsp;</span></label>
									  <span onmouseover="show_bg('successful')" onmouseout="hide_bg('successful')">
									  <input type="text" name="successful" id="successful" value="<?php echo $successful; ?>" onfocus="show_bg('successful')" onblur="hide_bg('successful')"/>
									  </span>
									</div>
									
									<div style="clear:both;"></div>
								
									<div style="clear:both;"></div>
									<div class="fleft">
									  <label>&nbsp;<span>&nbsp;</span></label>
									  <div class="submit">
										<input type="submit" name="submit" value="Update" style="background:none; border:none; width:150px; color:#FFFFFF; font-size:14px; padding-top:7px; cursor:pointer; " onclick=""/>
                                        
                                        <input type="hidden" name="site_setting_id" id="site_setting_id" value="<?php echo $site_setting_id; ?>" />												
									  </div>
									</div>
									</fieldset>
								  </form>
								</div>
							  </div>
							</div>
						</div>
					</div></td>
                    <td background="<?php echo base_url(); ?>images/c2-r.jpg"></td>
                  </tr>
                  <tr>
                    <td><img src="<?php echo base_url(); ?>images/c2-b-l.jpg" alt="" height="4" width="7" /></td>
                    <td background="<?php echo base_url(); ?>images/c2-b.jpg"></td>
                    <td><img src="<?php echo base_url(); ?>images/c2-b-r.jpg" alt="" height="4" width="7" /></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
        
        
        
        <div id="a" style="background-color:#FFFFFF; width:400px;  height:80px;  color:#000000; padding:5px; border: solid 1px gray; font-size:13px; text-align:left;filter: alpha(Opacity=80);opacity:0.8;">
Translucent tooltip !
</div>	

<script>
var t1=null;

var auto_target_achive_info=" <b>YES :</b> All Preapprove Transaction commit When Project achieve its goal before its expiry date.<br /><br /><b>NO :</b> All Preapprove Transaction commit if project achieve its goal at expire date.";

function init()
{
 t1 = new ToolTip("a",true,40);
}


window.onload=function() { init() } 
</script>