<?php
class Facebook_setting extends CI_Controller {
	function Facebook_setting()
	{
		parent::__construct();	
		$this->load->model('facebook_setting_model');
	}
	
	/*** facebook setting home page
	**/
	function index()
	{
		redirect('facebook_setting/add_facebook_setting');	
	}
	
	/** admin facebook setting display and update function
	* var integer $facebook_application_id
	* var integer $facebook_login_enable
	* var string $facebook_api_key
	* var string $facebook_secret_key	
	* var string $facebook_url
	* var string $error		
	**/
	function add_facebook_setting()
	{
		$data = array();
		$check_rights= get_rights('add_facebook_setting');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('facebook_application_id', 'Facebook Application Id', 'required');
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			if($this->input->post('facebook_setting_id'))
			{
				$data["facebook_setting_id"] = $this->input->post('facebook_setting_id');
				$data["facebook_application_id"] = $this->input->post('facebook_application_id');
				$data["facebook_login_enable"] = $this->input->post('facebook_login_enable');
				$data["facebook_api_key"] = $this->input->post('facebook_api_key');
				$data["facebook_secret_key"] = $this->input->post('facebook_secret_key');
				$data["facebook_url"] = $this->input->post('facebook_url');
			}else{
				$one_facebook_setting = $this->facebook_setting_model->get_one_facebook_setting();
				$data["facebook_setting_id"] = $one_facebook_setting->facebook_setting_id;
				$data["facebook_application_id"] = $one_facebook_setting->facebook_application_id;
				$data["facebook_login_enable"] = $one_facebook_setting->facebook_login_enable;
				$data["facebook_api_key"] = $one_facebook_setting->facebook_api_key;
				$data["facebook_secret_key"] = $one_facebook_setting->facebook_secret_key;
				$data["facebook_url"] = $one_facebook_setting->facebook_url;
			}
			
			$data['site_setting'] = site_setting();
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			$this->template->write_view('center',$theme .'/layout/setting/add_facebook_setting',$data,TRUE);
			$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			$this->template->render();
			
		}else{
			$this->facebook_setting_model->facebook_setting_update();
			$data["error"] = "Facebook settings updated successfully.";
			$data["facebook_setting_id"] = $this->input->post('facebook_setting_id');
			$data["facebook_application_id"] = $this->input->post('facebook_application_id');
			$data["facebook_login_enable"] = $this->input->post('facebook_login_enable');
			$data["facebook_api_key"] = $this->input->post('facebook_api_key');
			$data["facebook_secret_key"] = $this->input->post('facebook_secret_key');
			$data["facebook_url"] = $this->input->post('facebook_url');
			$data['site_setting'] = site_setting();
		
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			$this->template->write_view('center',$theme .'/layout/setting/add_facebook_setting',$data,TRUE);
			$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			$this->template->render();

		}				
	}
	
}
?>