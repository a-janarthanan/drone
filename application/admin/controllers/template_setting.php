<?php
class Template_setting extends CI_Controller {
	function Template_setting()
	{
		parent::__construct();	
		$this->load->model('template_setting_model');
	}
	
	/*** twitter setting home page
	**/
	function index()
	{
		redirect('template_setting/list_template');
	}
	
	
	function list_template($msg='')
	{
	
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_template_manager');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$data['template'] = $this->template_setting_model->get_all_template();
		$data['msg'] = $msg;

		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/template/list_template.php',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	
	/** admin template setting display and update function
	* var integer $twitter_setting_id
	* var integer $twitter_login_enable
	* var string $consumer_key
	* var string $consumer_secret
	* var string $twitter_url
	* var string $error	
	**/
	function add_template_setting($id)
	{
		$data = array();
		$check_rights= get_rights('add_template_setting');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('template_name', 'Template Name', 'required');
		
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			if($this->input->post('template_id'))
			{
				$data["template_id"] = $this->input->post('template_id');
				$data["template_name"] = $this->input->post('template_name');
				$data["template_logo"] = $this->input->post('template_logo');
				$data["template_logo_hover"] = $this->input->post('template_logo_hover');
				$data["active_template"] = $this->input->post('active_template');
				
				$one_template_setting = $this->template_setting_model->get_one_template_setting($id);
				
				$data["is_admin_template"] =$one_template_setting->is_admin_template;
			}else{
				
				$one_template_setting = $this->template_setting_model->get_one_template_setting($id);
				$data["template_id"] = $one_template_setting->template_id;
				$data["template_name"] = $one_template_setting->template_name;
				$data["template_logo"] = $one_template_setting->template_logo;
				$data["template_logo_hover"] = $one_template_setting->template_logo_hover;
				$data["active_template"] =$one_template_setting->active_template;
				$data["is_admin_template"] =$one_template_setting->is_admin_template;
			}
			
			$data['site_setting'] = site_setting();
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			$this->template->write_view('center',$theme .'/layout/template/add_template_setting',$data,TRUE);
			$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			$this->template->render();
		}else{
			$this->template_setting_model->template_setting_update();
			redirect('template_setting/list_template/update');

			
		}				
	}	
}
?>