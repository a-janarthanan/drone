<?php
class Admin extends  CI_Controller {
	function Admin()
	{
		 parent::__construct();	
		$this->load->model('admin_model');	
	}
	
	function index()
	{
		redirect('admin/list_admin');	
	}
	
	
	function list_admin($limit='20',$offset=0,$msg='')
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		 $check_rights=get_rights('list_admin');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$this->load->library('pagination');

		//$limit = '10';
		$config['uri_segment']='4';
		$config['base_url'] = base_url().'admin/list_admin/'.$limit.'/';
		$config['total_rows'] = $this->admin_model->get_total_admin_count();
	
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->admin_model->get_admin_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/admin/list_admin',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	function list_admin_superadmin($limit='20',$offset=0,$msg='')
	{
		
		
		 $check_rights=get_rights('list_admin');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_admin');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$this->load->library('pagination');

		//$limit = '10';
		
		$config['base_url'] = base_url().'admin/list_admin/';
		$config['total_rows'] = $this->admin_model->get_total_superadmin_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->admin_model->get_superadmin_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting'] = site_setting();
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/admin/list_admin',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	 
	function list_admin_admin($limit='20',$offset=0,$msg='')
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_admin');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$this->load->library('pagination');

		//$limit = '10';
		
		$config['base_url'] = base_url().'admin/list_admin/';
		$config['total_rows'] = $this->admin_model->get_total_adninistrator_admin_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->admin_model->get_adninistrator_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/admin/list_admin',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	} 
	function search_list_admin($limit=20,$option='',$keyword='',$offset=0,$msg='')
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_admin');
		
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
		$config['base_url'] = base_url().'admin/search_list_admin/'.$limit.'/'.$option.'/'.$keyword.'/';
		$config['total_rows'] = $this->admin_model->get_total_search_admin_count($option,$keyword);
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->admin_model->get_search_admin_result($option,$keyword,$offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		//$data['statelist']=$this->project_category_model->get_state();
		
		$data['site_setting'] = site_setting();
		
		$data['limit']=$limit;
		$data['option']=$option;
		$data['keyword']=$keyword;
		$data['search_type']='search';
		
		
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/admin/list_admin',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	
	function username_check($username)
	{
		$username = $this->admin_model->user_unique($username);
		if($username == TRUE)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('username_check', 'There is an existing account associated with this Username');
			return FALSE;
		}
	}	
	
	
	
	function add_admin($limit='20')
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_admin');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('username', 'User Name', 'required|alpha_numeric|callback_username_check');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[12]');
		//$this->form_validation->set_rules('login_ip', 'Login IP', 'required|valid_ip');	
		
		
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			$data["admin_id"] = $this->input->post('admin_id');
			$data["email"] = $this->input->post('email');
			$data["username"] = $this->input->post('username');
			$data["password"] = $this->input->post('password');
			$data["login_ip"] = $this->input->post('login_ip');
			$data["admin_type"] = $this->input->post('admin_type');		
			$data["active"] = $this->input->post('active');
			
			$data['site_setting'] = site_setting();
		
			if($this->input->post('offset')=="")
			{
				$limit = '10';
				$totalRows = $this->admin_model->get_total_admin_count();
				$data["offset"] = (int)($totalRows/$limit)*$limit;
			}else{
				$data["offset"] = $this->input->post('offset');
			}
			
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			$this->template->write_view('center',$theme .'/layout/admin/add_admin',$data,TRUE);
			$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			$this->template->render();
		}else{
				
			if($this->input->post('admin_id')!='')
			{	
				$this->admin_model->admin_update();
				$msg = "update";
			}else{
				$this->admin_model->admin_insert();			
				$msg = "insert";
			}
			$offset = $this->input->post('offset');
			redirect('admin/list_admin/'.$limit.'/'.$offset.'/'.$msg);
		}				
	}
	
	function edit_admin($id=0,$offset=0)
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_admin');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		$one_user = $this->admin_model->get_one_admin($id);
		$data["error"] = "";
		$data["admin_id"] = $id;
		$data["email"] = $one_user['email'];
		$data["username"] = $one_user['username'];
		$data["password"] = $one_user['password'];
		$data["login_ip"] = $one_user['login_ip'];
		$data["admin_type"] = $one_user['admin_type'];
		$data["active"] = $one_user['active'];
		
				
		
		
		$data['site_setting'] = site_setting();
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/admin/add_admin',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	function delete_admin($id=0,$offset=0)
	{
		$check_rights=get_rights('list_admin');
		$limit='20';
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		$this->db->delete('rights_assign',array('admin_id'=>$id));
		$this->db->delete('admin',array('admin_id'=>$id));
		redirect('admin/list_admin/'.$limit.'/'.$offset.'/delete');
	}
	
	
	function admin_login($offset=0,$msg='')
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('admin_login');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		$this->load->library('pagination');

		$limit = '20';
		
		$config['base_url'] = base_url().'admin/admin_login/';
		$config['total_rows'] = $this->admin_model->get_total_adminlogin_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->admin_model->get_adminlogin_result($offset, $limit);
		$data['offset'] = $offset;
		
		$data['site_setting'] = site_setting();
		
		$data['msg']=$msg;
		

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/admin/list_admin_login',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	
	function action_login()
	{
		$check_rights=get_rights('admin_login');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		$offset=$this->input->post('offset');
		$action=$this->input->post('action');
		$login_id=$this->input->post('chk');
			
		
		if($action=='delete')
		{		
			foreach($login_id as $id)
			{			
				$this->db->query("delete from ".$this->db->dbprefix('admin_login')." where login_id='".$id."'");
			}
			
			redirect('admin/admin_login/'.$offset.'/delete');
		}	
		
		
		
	}
	
	
}
?>