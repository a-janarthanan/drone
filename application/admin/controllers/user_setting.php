<?php
class user_setting extends CI_Controller
{
     
   function user_setting()
   {
    parent::__construct();
	$this->load->model('user_setting_model');
  }
  function index()
 {
    redirect('user_setting/add_user_setting');    
 }
 
function add_user_setting()
 {
 		$check_rights=get_rights('add_user_setting');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
        $data = array();
		
		$theme = getThemeName();
		//$this->template->set_master_template($theme .'/template.php');
		
		$this->load->library('form_validation');
		
		//$this->form_validation->set_rules('user_setting_id ','User Setting Id','required');
		$this->form_validation->set_rules('sign_up_auto_active', 'Sign Up Auto Active', 'required');
	    $this->form_validation->set_rules('user_task_auto_active', 'User Task Auto Active', 'required');
		$this->form_validation->set_rules('no_task_after_auto_active', 'No Task After Auto Active', 'required');
		$this->form_validation->set_rules('delete_user_login_day', 'Days Of Delete User Login Delete', 'required|integer');
		$this->form_validation->set_rules('delete_admin_login_day', 'Days Of Delete Admin Login Delete', 'required|integer');
		
		if($this->form_validation->run() == FALSE)
		{			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}
			else
			{
				$data["error"] = "";
			}
			

             $user_setting = $this->user_setting_model->get_user_setting();
			  
			
			  if(count($user_setting)>0)
			  {
			    $data['user_setting_id']=$user_setting->user_setting_id;
			    $data['sign_up_auto_active']=$user_setting->sign_up_auto_active;
			    $data['user_task_auto_active']=$user_setting->user_task_auto_active;
				 $data['no_task_after_auto_active']=$user_setting->no_task_after_auto_active;
				$data['delete_user_login_day']=$user_setting->delete_user_login_day;
				$data['delete_admin_login_day']=$user_setting->delete_admin_login_day;
				
			 }
			
			
		}
            else
			{  
		       if($this->input->post('user_setting_id'))
			   {
			       
				   
				   $data_update= array(			
			                   'user_setting_id' => $this->input->post('user_setting_id'),
			                   'sign_up_auto_active' => $this->input->post('sign_up_auto_active'),
			                   'user_task_auto_active' => $this->input->post('user_task_auto_active'),
			                   'no_task_after_auto_active' => $this->input->post('no_task_after_auto_active'),   
							   'delete_user_login_day' => $this->input->post('delete_user_login_day'),
			                   'delete_admin_login_day' => $this->input->post('delete_admin_login_day'),
			                 );
									   
				  // $this->input->post('user_setting_id');
				   $this->db->where('user_setting_id',$this->input->post('user_setting_id'))	;
				   $this->db->update('user_setting',$data_update);	
				  
				  
				  
					$supported_cache=check_supported_cache_driver();
						
						if(isset($supported_cache))
						{
							if($supported_cache!='' && $supported_cache!='none')
							{
								
								////===load cache driver===
								$this->load->driver('cache');				
								
								$query = $this->db->get("user_setting");
													
								$this->cache->$supported_cache->save('user_setting', $query->row(),CACHE_VALID_SEC);		
								
							}			
							
						}
		
	
			
				    $user = $this->user_setting_model->get_user_setting();
					
					$data["error"]="User settings updated successfully.";
					$data['user_setting_id']=$user->user_setting_id;
			        $data['sign_up_auto_active']=$user->sign_up_auto_active;
			        $data['user_task_auto_active']=$user->user_task_auto_active;
				    $data['no_task_after_auto_active']=$user->no_task_after_auto_active;
					$data['delete_user_login_day']=$user->delete_user_login_day;
				    $data['delete_admin_login_day']=$user->delete_admin_login_day;
					
					
					}
			   
			  //end update code
 
 }
 
  			 $this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/setting/add_user_setting',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
 
 }

}
?>