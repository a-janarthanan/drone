<?php
class Spam_setting extends CI_Controller  {
	function Spam_setting()
	{
	    parent::__construct();	
		$this->load->model('spam_setting_model');
		$this->load->model('home_model');
		$this->load->model('user_model');
	
		
	}
	
	function index()
	{
		redirect('spam_setting/add_spam_setting');	
	}
	
	
	
	function add_spammer($limit=20)
	{
	
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$data = array();
		$check_rights= get_rights('spamer');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('spam_ip', 'Spam IP', 'required|valid_ip');
		
		
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			
				$data["spam_ip"] = $this->input->post('spam_ip');
				
				$data["permenant_spam"] = $this->input->post('permenant_spam');	
							
				
			
			$data['site_setting'] = site_setting();
			
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			$this->template->write_view('center',$theme .'/layout/spam/add_spammer',$data,TRUE);
			$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			$this->template->render();
		}else{
			
			
			$this->spam_setting_model->add_spammer();
			$offset = 0;		
			$msg = 'success';
			redirect('spam_setting/spamer/'.$limit.'/'.$offset.'/'.$msg);
			//redirect('spam/spamer/0/success');
			
			
		}		
		
		
		
	}
	
	
	function add_spam_setting()
	{
		$check_rights=get_rights('add_spam_setting');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('spam_report_total', 'Total Spam Report', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('spam_report_expire', 'Reported Expire', 'required|is_natural_no_zero');
		
		$this->form_validation->set_rules('total_register', 'Total Registration', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('register_expire', 'Registration Spam Expire', 'required|is_natural_no_zero');
		
		$this->form_validation->set_rules('total_comment', 'Total Comment', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('comment_expire', 'Comment Spam Expire', 'required|is_natural_no_zero');
		
		$this->form_validation->set_rules('total_contact', 'Total Inquiry', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('contact_expire', 'Inquiry Spam Expire', 'required|is_natural_no_zero');
		
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			if($this->input->post('spam_control_id'))
			{
				
				$spam_control = $this->spam_setting_model->get_spam_control();
				
				$data["spam_control_id"] = $this->input->post('spam_control_id');
				
				$data["spam_report_total"] = $this->input->post('spam_report_total');	
				$data["spam_report_expire"] = $this->input->post('spam_report_expire');
				
				$data["total_register"] = $this->input->post('total_register');
				$data["register_expire"] = $this->input->post('register_expire');
				
				$data["total_comment"] = $this->input->post('total_comment');
				$data["comment_expire"] = $this->input->post('comment_expire');
			
				$data["total_contact"] = $this->input->post('total_contact');
				$data["contact_expire"] = $this->input->post('contact_expire');
								
				
				
				
				
			}
			else{
				$spam_control = $this->spam_setting_model->get_spam_control();
				
				$data["spam_control_id"] = $spam_control['spam_control_id'];
				
				$data["spam_report_total"] = $spam_control['spam_report_total'];
				$data["spam_report_expire"] = $spam_control['spam_report_expire'];
				
				$data["total_register"] = $spam_control['total_register'];
				$data["register_expire"] = $spam_control['register_expire'];
				
				$data["total_comment"] = $spam_control['total_comment'];
				$data["comment_expire"] = $spam_control['comment_expire'];
				
				$data["total_contact"] = $spam_control['total_contact'];
				$data["contact_expire"] = $spam_control['contact_expire'];
				
				
				
			}
			
			
			//$data['site_setting'] = $this->home_model->select_spam_setting();
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			$this->template->write_view('center',$theme .'/layout/spam/add_spam_setting',$data,TRUE);
			$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			$this->template->render();
		}else{
			
			
			$this->spam_setting_model->spam_control_update();		
			
			
			$data["error"] = "Spam Setting has been updated successfully";
			
			$spam_control = $this->spam_setting_model->get_spam_control();
				
			$data["spam_control_id"] = $spam_control['spam_control_id'];
			
			$data["spam_report_total"] = $spam_control['spam_report_total'];
			$data["spam_report_expire"] = $spam_control['spam_report_expire'];
			
			$data["total_register"] = $spam_control['total_register'];
			$data["register_expire"] = $spam_control['register_expire'];
			
			$data["total_comment"] = $spam_control['total_comment'];
			$data["comment_expire"] = $spam_control['comment_expire'];
			
			$data["total_contact"] = $spam_control['total_contact'];
			$data["contact_expire"] = $spam_control['contact_expire'];
							
				
			//$data['site_setting'] = $this->home_model->select_site_setting();		
			
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			$this->template->write_view('center',$theme .'/layout/spam/add_spam_setting',$data,TRUE);
			$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			$this->template->render();
		}				
	}
	
	
	function spam_report($limit=20,$offset=0,$msg='')
	{
		//$check_rights=$this->home_model->get_rights('spam_report');
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('spam_report');

		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$this->load->library('pagination');

		//$limit=20;
		
		$config['uri_segment']='4';
		$config['base_url'] = base_url().'spam_setting/spam_report/'.$limit.'/';
		$config['total_rows'] = $this->spam_setting_model->get_total_spam_report_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->spam_setting_model->get_spam_report_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting'] = site_setting();
		
		/*$this->template->write('title', 'Spam Report', '', TRUE);
		$this->template->write_view('header', 'header', $data, TRUE);
		$this->template->write_view('main_content', 'list_spam_report', $data, TRUE);
		$this->template->write_view('footer', 'footer', '', TRUE);
		$this->template->render();*/
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/spam/list_spam_report',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	
	}
	
	function search_list_spam_report($limit=20,$option='',$keyword='',$offset=0,$msg='')
	{
		
		//$check_rights=$this->home_model->get_rights('list_state');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('spam_report');

		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		$this->load->library('pagination');
		
		
		if($_POST)
		{		
			$option=$this->input->post('option');
			$keyword=$this->input->post('keyword');
		}
		else
		{
			$option=$option;
			$keyword=$keyword;			
		}
		
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',trim($keyword)));
	
		$config['uri_segment']='6';
		$config['base_url'] = base_url().'spam_setting/search_list_spam_report/'.$limit.'/'.$option.'/'.$keyword.'/';
		$config['total_rows'] = $this->spam_setting_model->get_total_spam_spamreport_count($option,$keyword);
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->spam_setting_model->get_spam_spamreport_result($option,$keyword,$offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		//$data['statelist']=$this->project_category_model->get_state();
		
		$data['site_setting'] = site_setting();
		
		$data['limit']=$limit;
		$data['option']=$option;
		$data['keyword']=$keyword;
		$data['search_type']='search';
		
		/*$this->template->write('title', 'Search Spam', '', TRUE);
		$this->template->write_view('header', 'header', $data, TRUE);
		$this->template->write_view('main_content', 'list_spam_report', $data, TRUE);
		$this->template->write_view('footer', 'footer', '', TRUE);
		$this->template->render();*/
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		    $this->template->write_view('center',$theme .'/layout/spam/list_spam_report',$data,TRUE);
		    $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		    $this->template->render();
	}
	
	
	function spam_report_action()
	{
		
		//$check_rights=$this->home_model->get_rights('spam_report');
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('spam_report');

		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		$offset=$this->input->post('offset');
		$action=$this->input->post('action');
		$spam_report_ip=$this->input->post('chk');
		
					
		
		if($action=='delete')
		{			
			foreach($spam_report_ip as $ip)
			{
				$this->spam_setting_model->delete_spam_report($ip);
			}
			
			redirect('spam_setting/spam_report/'.$offset.'/delete');
		}
		
		if($action=='make_spam')
		{
			foreach($spam_report_ip as $ip)
			{
				$this->spam_setting_model->make_spam($ip);
			}
			
			redirect('spam_setting/spam_report/'.$offset.'/make_spam');
		}
		
				
	
	}
	
	
	
	
	
	
	function spamer($limit=20,$offset=0,$msg='')
	{
		//$check_rights=$this->home_model->get_rights('spamer');
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$data = array();
		$check_rights= get_rights('spamer');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$this->load->library('pagination');

		
		
		$config['uri_segment']='4';
		$config['base_url'] = base_url().'spam_setting/spamer/'.$limit.'/';
		$config['total_rows'] = $this->spam_setting_model->get_total_spamer_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->spam_setting_model->get_spamer_result($offset,$limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		
		
		//$data['site_setting'] = $this->home_model->select_site_setting();
		
		$data['site_setting'] = site_setting();
		
		/*$this->template->write('title', 'Spamer', '', TRUE);
		$this->template->write_view('header', 'header', $data, TRUE);
		$this->template->write_view('main_content', 'list_spamer', $data, TRUE);
		$this->template->write_view('footer', 'footer', '', TRUE);
		$this->template->render();*/
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/spam/list_spamer',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
	
	}
	
	function search_list_spam($limit=20,$option='',$keyword='',$offset=0,$msg='')
	{
		
		//$check_rights=$this->home_model->get_rights('list_state');
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('spamer');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		$this->load->library('pagination');
		
		
		if($_POST)
		{		
			$option=$this->input->post('option');
			$keyword=$this->input->post('keyword');
		}
		else
		{
			$option=$option;
			$keyword=$keyword;			
		}
		
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',trim($keyword)));
	
		$config['uri_segment']='6';
		$config['base_url'] = base_url().'spam_setting/search_list_spam/'.$limit.'/'.$option.'/'.$keyword.'/';
		$config['total_rows'] = $this->spam_setting_model->get_total_search_spam_count($option,$keyword);
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->spam_setting_model->get_search_spam_result($option,$keyword,$offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		//$data['statelist']=$this->project_category_model->get_state();
		
		$data['site_setting'] = site_setting();
		
		$data['limit']=$limit;
		$data['option']=$option;
		$data['keyword']=$keyword;
		$data['search_type']='search';
		
		/*$this->template->write('title', 'Search Spam', '', TRUE);
		$this->template->write_view('header', 'header', $data, TRUE);
		$this->template->write_view('main_content', 'list_spamer', $data, TRUE);
		$this->template->write_view('footer', 'footer', '', TRUE);
		$this->template->render();*/
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
        $this->template->write_view('center',$theme .'/layout/spam/list_spamer',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	function spamer_action()
	{
		
		//$check_rights=$this->home_model->get_rights('spamer');
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('spamer');
		$limit=20;
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		$offset=$this->input->post('offset');
		$action=$this->input->post('action');
		$spam_ip=$this->input->post('chk');
		
		if($action=='delete')
		{			
			foreach($spam_ip as $ip)
			{
				$this->spam_setting_model->delete_spamer($ip);
			}
			
			redirect('spam_setting/spamer/'.$limit.'/'.$offset.'/delete');
		}	
		if($action=='make_spam_permenant')
		{
			foreach($spam_ip as $ip)
			{
				$this->spam_setting_model->make_spam_permenant($ip);
			}
			
			redirect('spam_setting/spamer/'.$limit.'/'.$offset.'/make_spam_permenant');
		}
		
				
	
	}


	function spam_action()
	{
		
		//$check_rights=$this->home_model->get_rights('spamer');
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('spamer');
		$limit=20;
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		$offset=$this->input->post('offset');
		$action=$this->input->post('action');
		$spam_ip=$this->input->post('chk');
		
		
		if($action=='delete')
		{			
			foreach($spam_ip as $ip)
			{
				$this->spam_setting_model->delete_spam($ip);
			}
			
			redirect('spam_setting/spam_report/'.$limit.'/'.$offset.'/delete');
		}
		
		if($action=='make_spam_permenant')
		{
			foreach($spam_ip as $ip)
			{
				$this->spam_setting_model->make_spam_permenant($ip);
			}
			
			redirect('spam_setting/spamer/'.$limit.'/'.$offset.'/make_spam_permenant');
			
		}
		
				
	
	}
	
}

?>