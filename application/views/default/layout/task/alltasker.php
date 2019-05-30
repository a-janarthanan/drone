<style>
.ultaskers li {
border-bottom: 1px #f2413e solid;
padding: 10px 0px;
}
.abc{
float: left;
width: 55px;
}
</style>
<?php
$site_setting=site_setting(); 
$data['site_setting']=$site_setting;
?>
<div>
<div>
<div class="red-subtitle" style="margin:172px 0 0 0">Tasker </div>
	<div id="two-columnar-section">
    	<div class="task-layout">
            <div class="db-rightinfo" style="width:100%; margin:25px 0 0 0">
                <div class="home-signpost-content">
                    <!--<div class="page-title mbot20">
                        <h1 class="mleft15">Worker bees</h1>
                    </div>-->
                    <div class="dbleft">
                        <div class="marTB20" style="width: 100%;"><h3 id="detail-bg1">Meet our Tasker</h3></div>
                        <ul class="ultaskers">
                            <?php if($taskers) { foreach($taskers as $tasker) {
                            
                            
                             $user_image= base_url().'upload/no_image.png';
                     
                             if($tasker->profile_image!='') {  
                        
                                if(file_exists(base_path().'upload/user/'.$tasker->profile_image)) {
                            
                                    $user_image=base_url().'upload/user/'.$tasker->profile_image;
                                    
                                }
                                
                            }
                            
                            
                            $total_rate=get_user_total_rate($tasker->user_id);
                    
                            $total_review=get_user_total_review($tasker->user_id);
                            
                        ?>
                            <li class="posrel">
                                <div class="abc">
                                    <?php echo anchor('user/'.$tasker->profile_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />');?>
                                    
                                    
                                    <a title="<?php echo 'Level '.$tasker->worker_level;?> Worker bee" class="twoonepts1" rel="tooltip"><?php echo $tasker->worker_level;?></a>
                                </div>
                                <div class="fl wid550 marL5">
                                                    
                                    <table width="100%" border="0" cellspacing="1" cellpadding="0">
                                      <tr>
                                        <td width="22%" class="padTB10"><?php echo anchor('user/'.$tasker->profile_name,ucfirst($tasker->first_name).' '.ucfirst(substr($tasker->last_name,0,1)).'.',' class="abmarks unl"'); ?></td>
                                        <td width="58%"><div class="strmn"><div class="str_sel" style="width:<?php if($total_rate>5) { ?>100<?php } else { echo round($total_rate*2);?>0<?php } ?>%;"></div></div><div class="fl marL5">(<?php echo anchor('user/'.$tasker->profile_name.'/reviews',$total_review.' reviews','class="fpass"');  ?>)</div></td>
                                        <td width="20%">
                                                       
                                                       
                                                    
                                                        
                                                <div class="hire_me">        
                                                                   <?php if(!check_user_authentication()) {  echo anchor('sign_up','<b>Invite</b>',' class="login" ');  }  else { echo anchor('task/invite/'.$task_id.'/'.$tasker->worker_id,'<b>Invite</b>',' id="hireme_'.$tasker->worker_id.'" class="login" '); ?>
                 
                                           <script type="text/javascript">
                                                jQuery(document).ready(function() {	
                                                    jQuery("#hireme_<?php echo $tasker->worker_id;?>").fancybox();	
                                                });
                                        </script>
                
                <?php } ?>
                                           </div>
                                                        
                                                          
                                        </td>
                                      </tr>
                                    </table>
                                    
                                    <p class="LH18">
                                    <?php 
                                                        $strlen = strlen($tasker->worker_skills);
                                                        if($strlen > 100) { echo substr($tasker->worker_skills,0,100).' ...';}
                                                        else { echo $tasker->worker_skills; } 
                                                    ?>
                                     <?php echo anchor('user/'.$tasker->profile_name,'more',' class="unl abmarks"');?></p>
                                    <p class="marT5" style="padding-top:5px;"><b>Top Task Types: </b> <?php 
                                    
                                    
                                    
                                      $task_type_detail='';
                              
                             $types=$tasker->worker_task_type;
                             
                             if($types!='') { 
                             
                            
                             
                             $ex_type=explode(',',$types);
                             
                             foreach($ex_type as $type) 
                             {
                                
                                 $get_task_type=$this->worker_model->get_task_type_detail($type);
                                 
                                 if($get_task_type)
                                 {
                                    if(isset($get_task_type->task_name))				
                                    {
                                 
                                        $task_type_detail .=$get_task_type->task_name.',';
                                    }
                                 }
                                 
                                
                            }
                                    
                                    if($task_type_detail!='') { echo  substr(substr($task_type_detail,0,-1),0,120).'...'; }  }
                                    
                                    ?></p>
                
                             
                                </div>
                                <div class="clear"></div>
                            </li>
                            <?php } } else { ?>
                                <li> No tasker avilable</li>
                            <?php } ?>
                        </ul>
                        <div class="clear"></div>
                    </div>
                    <div class="dbright-task">
                        <?php echo $this->load->view($theme.'/layout/worker/tasker_sidebar'); ?>  
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>



