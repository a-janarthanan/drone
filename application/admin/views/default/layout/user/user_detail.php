<div id="content" align="center">

	<div align="left" class="column half">
		<div class="box">	
            <h2 class="box-header"><?php echo anchor(front_base_url().'user/'.$row->profile_name,ucfirst($row->first_name).' '.ucfirst(substr($row->last_name,0,1)),' style="color:#004C7A;" target="_blank"'); ?></h2> 
			<div class="box-content">
			
			 
            
			  <table class="tablebox">
                  <tbody class="openable-tbody">
                  
                     <tr><td colspan="2" align="left" valign="top">
                      
                      <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      
                      <tr>
                      
                     	 <td align="left" valign="top" width="150">
                        <?php if($row->profile_image!='') {?>
                                 <img src="<?php echo front_base_url();?>upload/user/<?php echo $row->profile_image;?>" style="border-radius:5px; width:120px; height:120px;"/>
                          <?php } else {?>
                                  <img src="<?php echo front_base_url();?>upload/no_image.png" style="border-radius:5px; width:120px; height:120px;"/>
                          <?php }?>
                          
                          </td>
                          
                          <td align="left" valign="top">
                      
                       <table border="0" cellpadding="0" cellspacing="0" width="70%">
                       <tr>
                          <td style="text-align:left; width:35%"><label class="form-label">User Name </label></td>
                          <td style="text-align:left; width:65%">: <?php echo anchor(front_base_url().'user/'.$row->profile_name,ucfirst($row->full_name),' style="color:#004C7A;" target="_blank"'); ?></td>
                      </tr>
                      
                       <tr>
                          <td style="text-align:left;"><label class="form-label">Firstname </label></td>
                          <td style="text-align:left;">: <?php echo $row->first_name;?></td>
                      </tr>
                      
                       <tr>
                          <td style="text-align:left;"><label class="form-label">Lastname </label></td>
                          <td style="text-align:left;">: <?php echo $row->last_name;?></td>
                      </tr>
                      
                      
                       <tr>
                          <td style="text-align:left;"><label class="form-label">Email </label></td>
                          <td style="text-align:left;">: <?php echo $row->email;?></td>
                      </tr>
                      
                      <tr>
                          <td style="text-align:left;"><label class="form-label">Current City </label></td>
                          <td style="text-align:left;">: <?php if($row->current_city != '' && $row->current_city != 0) { echo get_city_name($row->current_city); }?></td>
                      </tr>
                      
                      </table>
                      
                      
                    	  </td>
                      
                      </tr>
                      </table>
                      
                      
                      </td></tr>
                      
                       <tr><td colspan="2"><hr/></td></tr>
                       
                       <tr>
                          <td style="text-align:left; width:30%;"><label class="form-label">Mobile Number </label></td>
                          <td style="text-align:left;width:70%;">: <?php echo $row->mobile_no;?></td>
                      </tr>
                      
                  	  <tr>
                          <td style="text-align:left;"><label class="form-label">About User </label></td>
                          <td style="text-align:left;">: <?php echo $row->about_user;?></td> 
                      </tr>
                      
                      <tr><td colspan="2"><hr/></td></tr>
                      
                      <tr>
                          <td style="text-align:left;"><label class="form-label">Facebook Link </label></td>
                          <td style="text-align:left;">: <?php echo $row->facebook_link;?></td>
                      </tr>
                      <tr>
                          <td style="text-align:left;"><label class="form-label">Linkedin Link </label></td>
                          <td style="text-align:left;">: <?php echo $row->linkedin_link;?></td>
                      </tr>
                      <tr>
                          <td style="text-align:left;"><label class="form-label">Twitter Link </label></td>
                          <td style="text-align:left;">: <?php echo $row->twitter_link;?></td>
                      </tr>
                      <tr>
                          <td style="text-align:left;"><label class="form-label">Youtube Link </label></td>
                          <td style="text-align:left;">: <?php echo $row->youtube_link;?></td>
                      </tr>
                      <tr>
                          <td style="text-align:left;"><label class="form-label">Own Site Link </label></td>
                          <td style="text-align:left;">: <?php echo $row->own_site_link;?></td>          
                      </tr>
                      <tr>
                          <td style="text-align:left;"><label class="form-label">Blog Link </label></td>
                          <td style="text-align:left;">: <?php echo $row->blog_link;?></td>
                      </tr> 
                      <tr>
                          <td style="text-align:left;"><label class="form-label">Yelp Link </label></td>
                          <td style="text-align:left;">: <?php echo $row->yelp_link;?></td>          
                      </tr>
                      <tr>
                          <td style="text-align:left;"><label class="form-label">Digg Link </label></td>
                          <td style="text-align:left;">: <?php echo $row->digg_link;?></td>
                      </tr>
                      
                       <tr>
                          <td style="text-align:left;"><label class="form-label">Stumblupon Link </label></td>
                          <td style="text-align:left;">: <?php echo $row->stumblupon_link;?></td>
                      </tr>
                      
                       <tr><td colspan="2"><hr/></td></tr>
                       <tr>
                          <td style="text-align:left; vertical-align:top;"><label class="form-label">Portfolio </label></td>
                          <td style="text-align:left;">: 
                          
                          	<table width="100%" border="0" cellspacing="1" cellpadding="0">
                    <?php if($portfolio_photo) { ?>
                        <tr>
                            <td  align="left" valign="top">
                            <?php
                                $i=0;
                                foreach( $portfolio_photo as $p_photo)
                                {
                                    $i++;
                                        if($p_photo->portfolio_image!=''){
                                            if(file_exists(base_path().'upload/user/'.$p_photo->portfolio_image)) { 
                            ?>
                                <a href="<?php echo front_base_url().'upload/user_orig/'.$p_photo->portfolio_image; ?>" rel="example_group"><img src="<?php echo front_base_url().'upload/user/'.$p_photo->portfolio_image; ?>" width="100" height="100" alt="" /></a>
                            <?php } } } ?>
                            </td>
                        </tr>
                    <?php  } ?>


                    <?php if($portfolio_video) { ?>
                    	<tr><td height="15">&nbsp;</td></tr>
                        <tr>
                        	<td  valign="top" align="center">
							<?php
                            
								$i=0;
								foreach($portfolio_video as $p_video)
								{
									$i++;
									if($p_video->portfolio_video!=''){
								
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
											echo '<iframe src="'.$matches[1].'" frameborder="0" allowfullscreen></iframe>';
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
										
										$p_video->portfolio_video = str_replace(array("v=", "v/", "vi/"), "v=",$p_video->portfolio_video);
								
								
										preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#",$p_video->portfolio_video,$matches);
										
										echo '<iframe src="http://www.youtube.com/embed/'.$matches[0].'?wmode=transparent" frameborder="0" allowfullscreen></iframe>';
										
									}
								
								elseif(substr_count($p_video->portfolio_video,'youtube')>0)
								{
									$p_video->portfolio_video = str_replace(array("v=", "v/", "vi/"), "v=",$p_video->portfolio_video);
									
									preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#",$p_video->portfolio_video,$matches);
									
									echo '<iframe src="http://www.youtube.com/embed/'.$matches[0].'?wmode=transparent" frameborder="0" allowfullscreen></iframe>';
								
								}
								elseif(substr_count($p_video->portfolio_video,'vimeo')>0)
								{
								
									$vid_code = explode("/",$p_video->portfolio_video);
									$vid = $vid_code[count($vid_code)-1];
									echo '<iframe src="http://player.vimeo.com/video/'.$vid.'?title=0&byline=0&portrait=0" frameborder="0"></iframe>';
								}
								
								else
								{
									echo $p_video->portfolio_video;
								}
								
								}
                             }
                            echo "<br /><br />";
                            }?>
							</td>
						</tr>
					<?php }?>
                </table>
                          
                          </td>
                      </tr>
                      
                       <tr><td colspan="2"><hr/></td></tr>
                      <tr>
                          <td style="text-align:left;"><label class="form-label">Howmany time Suspend?</label></td>
                          <td style="text-align:left;"> : <?php echo $this->user_model->get_suspend_user_count($row->user_id);?></td>
                      </tr>
                      
                  </tbody>
			  	 </table>   
             </div>
              


			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>