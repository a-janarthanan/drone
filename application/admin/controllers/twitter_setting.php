<?php
class Twitter_setting extends CI_Controller {
	function Twitter_setting()
	{
		parent::__construct();	
		$this->load->model('twitter_setting_model');
	}
	
	/*** twitter setting home page
	**/
	function index()
	{
		redirect('twitter_setting/add_twitter_setting');
	}
	
	/** admin twitter setting display and update function
	* var integer $twitter_setting_id
	* var integer $twitter_login_enable
	* var string $consumer_key
	* var string $consumer_secret
	* var string $twitter_url
	* var string $error	
	**/
	function add_twitter_setting()
	{
		$data = array();
		$check_rights= get_rights('add_twitter_setting');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('consumer_key', 'Consumer Key', 'required');
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			if($this->input->post('twitter_setting_id'))
			{
				$data["twitter_setting_id"] = $this->input->post('twitter_setting_id');
				$data["twitter_login_enable"] = $this->input->post('twitter_login_enable');
				$data["consumer_key"] = $this->input->post('consumer_key');
				$data["consumer_secret"] = $this->input->post('consumer_secret');
				$data["twitter_url"] = $this->input->post('twitter_url');
			}else{
				$one_twitter_setting = $this->twitter_setting_model->get_one_twitter_setting();
				$data["twitter_setting_id"] = $one_twitter_setting->twitter_setting_id;
				$data["twitter_login_enable"] = $one_twitter_setting->twitter_login_enable;
				$data["consumer_key"] = $one_twitter_setting->consumer_key;
				$data["consumer_secret"] = $one_twitter_setting->consumer_secret;
				$data["twitter_url"] =$one_twitter_setting->twitter_url;
			}
			
			$data['site_setting'] = site_setting();
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			$this->template->write_view('center',$theme .'/layout/setting/add_twitter_setting',$data,TRUE);
			$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			$this->template->render();
		}else{
			$this->twitter_setting_model->twitter_setting_update();
			$data["error"] = "Twitter settings updated successfully.";
			$data["twitter_setting_id"] = $this->input->post('twitter_setting_id');
			$data["twitter_login_enable"] = $this->input->post('twitter_login_enable');
			$data["consumer_key"] = $this->input->post('consumer_key');
			$data["consumer_secret"] = $this->input->post('consumer_secret');
			$data["twitter_url"] = $this->input->post('twitter_url');
			$data['site_setting'] = site_setting();
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			$this->template->write_view('center',$theme .'/layout/setting/add_twitter_setting',$data,TRUE);
			$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			$this->template->render();
		}				
	}	
}
?>