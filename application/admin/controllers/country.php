<?php
class Country extends CI_Controller {
	function Country()
	{
		parent::__construct();	
		$this->load->model('country_model');
		$this->load->model('home_model');
		
	}
	
	function index()
	{
		redirect('country/list_country/');
	}
	
	function add_country($limit=20)
	{
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_country');
		
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('country_name', 'Country Name', 'required|alpha_space');
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			$data["country_id"] = $this->input->post('country_id');
			$data["country_name"] = $this->input->post('country_name');
			$data["active"] = $this->input->post('active');
			
			if($this->input->post('offset')=="")
			{
				$limit = '15';
				$totalRows = $this->country_model->get_total_country_count();
				$data["offset"] = (int)($totalRows/$limit)*$limit;
			}else{
				$data["offset"] = $this->input->post('offset');
			}
			
			$data['site_setting'] = site_setting();
			
			
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		    $this->template->write_view('center',$theme .'/layout/country/add_country',$data,TRUE);
		    $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		    $this->template->render();
		}
		else{
			if($this->input->post('country_id'))
			{
				$this->country_model->country_update();
				$msg = "update";
			}else{
				$this->country_model->country_insert();
				$msg = "insert";
			}
			$offset = $this->input->post('offset');
			redirect('country/list_country/'.$limit.'/'.$offset.'/'.$msg);
		}				
	}
	
	function edit_country($id=0,$offset=0)
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_country');
		
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$one_country = $this->country_model->get_one_country($id);
		$data["error"] = "";
		$data["country_id"] = $id;
		$data["country_name"] = $one_country['country_name'];
		$data["active"] = $one_country['active'];
		$data["offset"] = $offset;
		
		$data['site_setting'] = site_setting();
		
		
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/country/add_country',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	function delete_country($id=0,$offset=0)
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_country');
		
		$limit=20;
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$this->db->delete('country',array('country_id'=>$id));
		redirect('country/list_country/'.$limit.'/'.$offset.'/delete');
	}
	
	function list_country($limit='20',$offset=0,$msg='')
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_country');
		
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		$this->load->library('pagination');

		$config['uri_segment']='4';
		$config['base_url'] = base_url().'country/list_country/'.$limit.'/';
		$config['total_rows'] = $this->country_model->get_total_country_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->country_model->get_country_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting']=site_setting();
		
		
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/country/list_country',$data,TRUE);
	    $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	function search_list_country($limit=20,$option='',$keyword='',$offset=0,$msg='')
	{

		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_country');
		
		
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
		$config['base_url'] = base_url().'country/search_list_country/'.$limit.'/'.$option.'/'.$keyword.'/';
		$config['total_rows'] = $this->country_model->get_total_search_country_count($option,$keyword);
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->country_model->get_search_country_result($option,$keyword,$offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		
		
		$data['site_setting'] = site_setting();
		
		$data['limit']=$limit;
		$data['option']=$option;
		$data['keyword']=$keyword;
		$data['search_type']='search';
		
		
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/country/list_country',$data,TRUE);
	    $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
}
?>