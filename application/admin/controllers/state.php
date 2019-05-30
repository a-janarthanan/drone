<?php
class State extends CI_Controller {
	function State()
	{
		parent::__construct();	
		$this->load->model('state_model');
		$this->load->model('home_model');
		
	}
	
	function index()
	{
		redirect('state/list_state/');
	}
	
	function add_state($limit=20)
	{

		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_state');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('state_name', 'State Name', 'required|alpha_space');
		$this->form_validation->set_rules('country_id', 'Country', 'required');
		
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			$data["state_id"] = $this->input->post('state_id');
			$data["country_id"] = $this->input->post('country_id');
			$data["state_name"] = $this->input->post('state_name');
			$data["active"] = $this->input->post('active');
			$data['country'] = $this->state_model->get_country_result();
			
			if($this->input->post('offset')=="")
			{
				$limit = '15';
				$totalRows = $this->state_model->get_total_state_count();
				$data["offset"] = (int)($totalRows/$limit)*$limit;
			}else{
				$data["offset"] = $this->input->post('offset');
			}
			
			$data['site_setting'] = site_setting();
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		    $this->template->write_view('center',$theme .'/layout/state/add_state',$data,TRUE);
		    $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		    $this->template->render();
		}
		else
		{
			if($this->input->post('state_id'))
			{
				$this->state_model->state_update();
				$msg = "update";
			}else{
				$this->state_model->state_insert();
				$msg = "insert";
			}
			$offset = $this->input->post('offset');
			redirect('state/list_state/'.$limit.'/'.$offset.'/'.$msg);
		}				
	}
	
	function edit_state($id=0,$offset=0)
	{
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_state');
		
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		$one_state = $this->state_model->get_one_state($id);
		$data["error"] = "";
		$data["state_id"] = $id;
		$data["country_id"] = $one_state['country_id'];
		$data["state_name"] = $one_state['state_name'];
		$data["active"] = $one_state['active'];
		$data["offset"] = $offset;
		$data['country'] = $this->state_model->get_country_result();
		
		$data['site_setting'] = site_setting();
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
	    $this->template->write_view('center',$theme .'/layout/state/add_state',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	function delete_state($id=0,$offset=0)
	{
		$limit=20;
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_state');
		
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$this->db->delete('state',array('state_id'=>$id));
		redirect('state/list_state/'.$limit.'/'.$offset.'/delete');
	}
	
	function list_state($limit='20',$offset=0,$msg='')
	{
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_state');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		$this->load->library('pagination');

		//$limit = '15';
		$config['uri_segment']='4';
		$config['base_url'] = base_url().'state/list_state/'.$limit.'/';
		$config['total_rows'] = $this->state_model->get_total_state_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->state_model->get_state_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting'] = site_setting();
		
		
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
	    $this->template->write_view('center',$theme .'/layout/state/list_state',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	
	function search_list_state($limit=20,$option='',$keyword='',$offset=0,$msg='')
	{
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_state');
		
		
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
		$config['base_url'] = base_url().'state/search_list_state/'.$limit.'/'.$option.'/'.$keyword.'/';
		$config['total_rows'] = $this->state_model->get_total_search_state_count($option,$keyword);
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->state_model->get_search_state_result($option,$keyword,$offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		
		
		$data['site_setting'] = site_setting();
		
		$data['limit']=$limit;
		$data['option']=$option;
		$data['keyword']=$keyword;
		$data['search_type']='search';
		
		
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
	    $this->template->write_view('center',$theme .'/layout/state/list_state',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
}
?>