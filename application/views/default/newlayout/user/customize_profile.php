<script type="text/javascript">
jQuery(function($) {
	
		$("#pupload").fancybox();
		$("#user_video").fancybox();
		$("#upload_portfolio").fancybox();

});
</script>	
<script type="text/javascript">
jQuery(document).ready(function() {

$("a[rel=example_group]").fancybox({
'transitionIn' : 'none',
'transitionOut' : 'none',
'titlePosition' : 'over',
'titleFormat' : function(title, currentArray, currentIndex, currentOpts) {
return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
}
});

});

</script>
<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->

<div>
<div>
<div class="red-subtitle top-red-subtitle">Komplettera profil : <?php echo $user_profile->first_name.' '.substr($user_profile->last_name,0,1); ?></div>
<div class="profile_back">
<div class="container">
<div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
<div class="home-signpost-content">
<div class="dbleft dbleft-main">


  <div class="padT10B20">
         
      
<?php
if($msg!='')
{ ?>
<div id="success">
<ul>
<?php if($msg=='video_delete'){ ?> <p>Video Deleted Successfully</p><?php } ?>
<?php if($msg=='photo_delete'){ ?> <p>Photo Deleted Successfully</p><?php } ?>
<?php if($msg=='video_add'){ ?><p>Video Added Successfully</p><?php } ?>
<?php if($msg=='photo_add'){ ?><p>Photo Added Successfully</p><?php } ?>

</ul></div>
<?php } ?>


                  
  <?php if($error!=''){  ?>
				<div id="error">
					<ul>
					<?php echo $error; ?>
					</ul>
				</div>
			<?php }   ?>
            
            
            
            
 <?php
 $image_settings=image_setting();
 
		$attributes = array('name'=>'customizeprofileForm','id'=>'customizeprofileForm','class'=>'form_design');
		echo form_open('customize_profile',$attributes);
	?>
            
            
         <table width="100%" border="0" cellpadding="2" cellspacing="2">
         
         <tr>
         <td width="10%"  valign="top">
          <?php
					
					if($user_profile->profile_image!='') {  
					
						if(file_exists(base_path().'upload/user/'.$user_profile->profile_image)) { ?>
                        
                        <img src="<?php echo base_url(); ?>upload/user/<?php echo $user_profile->profile_image;?>" width="<?php echo $image_settings->user_width; ?>"  alt="" class="fl"  />
                        
                        <?php } else { ?>
                        
                  <img src="<?php echo base_url(); ?>upload/no_image.png" width="<?php echo $image_settings->user_width; ?> "  alt="" class="fl"  />
                    
                    <?php } } else { ?>
                    
                    <img src="<?php echo base_url(); ?>upload/no_image.png" width="<?php echo $image_settings->user_width; ?>" alt="" class="fl"  />
                    
                    <?php } ?>
                    
     <div class="clear"></div>



         
        <?php echo anchor('user/upload_photo','<img src="'.base_url().getThemeName().'/images/camera.png" width="20" height="20"   alt="" />&nbsp;Lägg till foto',' id="pupload" class="fpass"');?>
         </td>
         
         <td width="80%" valign="top">
         
          <!-- <div><h2 class="tasksimilar"><a href="#" class="abtmove"></a></h2></div>-->
          
          
          <!--<p class="colblack">My City : 
		   
           <select name="current_city" id="current_city" class="selwid150" style="height:25px; font-size:14px;">
           
		   <?php $city_list=city_list();
		   
		   if($city_list) {  foreach($city_list as $city) { ?>
           
           
           <option value="<?php echo $city->city_id; ?>" <?php if($current_city==$city->city_id) { ?> selected <?php } ?>>
		   <?php echo $city->city_name; ?>
           </option>
           
           
           <?php } } else { ?>
           <option value="">No City</option>
           <?php } ?>
           </select>
           
       </p>-->
           
           
           </td></tr>
           
           </table>
           
           
          	<div class="marTB10">
              <fieldset>
           <div class="inside-subtitle">Beskriv dig själv</div>
		    <textarea name="about_user" id="about_user" rows="15" cols="75" style="min-height:150px"><?php echo $about_user; ?></textarea>
		        </fieldset>
             
			</div>           
                


<div class="marTB10">

              <fieldset>
            <div class="padB10"><div class="inside-subtitle">Redigera portfölj</div></div>
              
		        </fieldset>
	<br/>	
<br />


    	    

<table width="100%" border="0" cellspacing="1" cellpadding="0">
<tr>
<td align="left" valign="top">
<?php
if($portfolio_photo)
{
$i=0;
foreach( $portfolio_photo as $p_photo)
{
$i++;
if($p_photo->portfolio_image!=''){
if(file_exists(base_path().'upload/user/'.$p_photo->portfolio_image)) { ?>



<?php echo anchor('user/portfolio_view/'.$p_photo->portfolio_id,'<img src="'.base_url().'upload/user/'.$p_photo->portfolio_image.'" width="150" style="margin-right:5px; margin-bottom:5px;" height="" alt="" />',' rel="example_group" ');?>




<?php } }
}}?>

</td>
</tr>

<?php 

if($portfolio_video)
{ ?>
<tr><td height="15">&nbsp;</td></tr>


<tr>
<td valign="top" align="left">
<!-- -->
<style type="text/css">iframe { width:150px; height:150px; }</style>

       <?php
   echo "<ul class='video'>";
   $i=0;
   foreach($portfolio_video as $p_video)
   {


               echo "<li>";
   $i++;
   if($p_video->portfolio_video!='')
   {

               if(substr_count($p_video->portfolio_video,'object')>0)
               {


                               echo html_entity_decode($p_video->portfolio_video);

               }

               elseif(substr_count($p_video->portfolio_video,'iframe')>0)
               {
                       if(substr_count($p_video->portfolio_video,'youtube')>0)
                       {
                               $p_video->portfolio_video;
                               $patterns[] = '/src="(.*?)"/';
                               $replacements[] = 'src="${1}?wmode=transparent"';


                               //echo html_entity_decode(preg_replace($patterns,$replacements,$p_video->portfolio_video));
                               echo html_entity_decode($p_video->portfolio_video);
                       }
                       elseif(substr_count($p_video->portfolio_video,'vimeo')>0)
                       {
                               $patterns[] = '/src="(.*?)"/';
                               preg_match('/src="(.*?)"/',$p_video->portfolio_video,$matches);
                               echo '<iframe src="'.$matches[1].'" frameborder="0"
allowTransparency="true"  style="z-index:0"
allowfullscreen></iframe>';
                       }
                       else
                       {
                               echo $p_video->portfolio_video;

                       }
               }
               else
               {
                       if(substr_count($p_video->portfolio_video,'youtu.be')>0)
                       {
                               $p_video->portfolio_video=str_replace('youtu.be','www.youtube.com/v',$p_video->portfolio_video);

                               $p_video->portfolio_video = str_replace(array("v=", "v/", "vi/"),
"v=",$p_video->portfolio_video);

                               preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#",$p_video->portfolio_video,$matches);

                               echo '<iframe
src="http://www.youtube.com/embed/'.$matches[0].'?wmode=transparent"
frameborder="0"  allowTransparency="true"  style="z-index:0"
allowfullscreen></iframe>';



                       }
                       elseif(substr_count($p_video->portfolio_video,'youtube')>0)
                       {
                               $p_video->portfolio_video = str_replace(array("v=", "v/", "vi/"),
"v=",$p_video->portfolio_video);

                               preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#",$p_video->portfolio_video,$matches);

                               echo '<iframe
src="http://www.youtube.com/embed/'.$matches[0].'?wmode=transparent"
frameborder="0"  allowfullscreen allowTransparency="true"
style="z-index:0"></iframe>';


                       }
                       elseif(substr_count($p_video->portfolio_video,'vimeo')>0)
                       {
                               $vid_code = explode("/",$p_video->portfolio_video);
                               $vid = $vid_code[count($vid_code)-1];
                               echo '<iframe
src="http://player.vimeo.com/video/'.$vid.'?title=0&byline=0&portrait=0"
 frameborder="0" allowTransparency="true"  style="z-index:0"
allowfullscreen></iframe>';

                       }
                       else
                       {
                       echo $p_video->portfolio_video;
                       }

               }
               ?>


<?php
       }
       echo '<div class="aligncen ">';
               echo anchor('user/delete_video/'.$p_video->portfolio_id,'Delete','class="link"');
       echo '</div>';
       echo "</li>";

}
echo "<div class='clear'></div>";
echo "</ul>";
?>
<!-- -->

</td>

</tr>

<?php } ?>
</table>

<?php echo anchor('user/user_video','Lägg till video','id="user_video" class="btn btn-default"');?>
              <?php echo anchor('user/upload_portfolio','Lägg till bild','id="upload_portfolio" class="btn btn-default marL5"');?>


                
</div>                



<?php  /*$t_setting = twitter_setting();	
            
         $f_setting = facebook_setting();	
			   
			   
			   
 if($f_setting->facebook_login_enable == '1' ||  $t_setting->twitter_login_enable == '1') { ?>
 
 
<div class="marTB10">
	           
              <fieldset>
            <div class="padB10"><h3 id="detail-bg1" class="padB20">Connected Websites</h3></div>
            
                <?php
				
		if($f_setting->facebook_login_enable == '1'){
		
		
			$data = array(
				'facebook'		=> $this->fb_connect->fb,
				'fbSession'		=> $this->fb_connect->fbSession,
				'user'			=> $this->fb_connect->user,
				'uid'			=> $this->fb_connect->user_id,
				'fbLogoutURL'	=> $this->fb_connect->fbLogoutURL,
				'fbLoginURL'	=> $this->fb_connect->fbLoginURL,	
				'base_url'		=> site_url('home/facebook'),
				'appkey'		=> $this->fb_connect->appkey,
			);
	
	if($user_info->fb_id != '' && $user_info->fb_id !=0) {
		
		echo anchor('home/remove_fb/1','<img src="'.base_url().getThemeName().'/images/fb2.png" class="marB_3 marR5"  alt="Remove Facebook Connection" />','class=""');       
              } else {
	
		 echo anchor($data['fbLoginURL'],'<img src="'.base_url().getThemeName().'/images/fb2.png" class="marB_3 marR5" alt="Make Facebook Connection" />','class=""');        
 
	 } 

	}  //if($t_setting->twitter_login_enable == '1'){
//	
//		
//		
//		echo "&nbsp;&nbsp;";
//		
//		if($user_info->tw_id != '' && $user_info->tw_id !=0) {
//	
//		echo anchor('home/remove_tw/1','<img src="'.base_url().getThemeName().'/images/twi.png" class="marB_3 marR5"  alt="Remove Twitter Connection" />Remove Twitter Connection','class="fbtn"');       
//              } else {
//		
//		 echo anchor('home/twitter_auth','<img src="'.base_url().getThemeName().'/images/twi.png" class="marB_3 marR5" alt="Make Twitter Connection" />Make Twitter Connection','class="fbtn"');        
// 
//	 } 
//	 
//	 
//	
//	
//	}
	
	
	
	

?>
            
		        </fieldset>
          
               
</div>            


 <?php }*/ ?>
 
 <div align="center" class="btn-480" style="padding-left: 90px;">
        <input type="submit" name="customizebtn" id="customizebtn" value="Spara ändringar" class="btn btn-default btn-post"  />
        </div>
         
  </div>      
                
                
		</div>
</div>
        <div class="dbright-task dbright-task-main">
		<?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
		</div>
        </div>
        <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/validation.js"></script>