<?php
class Pages extends CI_Controller {
	function Pages()
	{
		parent::__construct();
		$this->load->model('pages_model');
		$this->load->model('home_model');
			
	}
	
	function index()
	{ 
		redirect('pages/list_pages'); 
	}
	
	
	
	
	function home_page()
	{
		
		//$check_rights=$this->home_model->get_rights('home_page');
		$data = array();
		$check_rights= get_rights('home_page');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');

		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('home_description', 'Description', 'required');		
		$this->form_validation->set_rules('home_title', 'Title', 'required');
		
		
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			
			if($this->input->post('home_id'))
			{
				$data["home_description"] = $this->input->post('home_description');
				$data["home_title"] = $this->input->post('home_title');
				$data["active"] = $this->input->post('active');				
				$data["home_id"] = $this->input->post('home_id');
				
				
			}else{
				$home_page= $this->db->query("select * from home_page where home_id='1'");
				
				$get_home_page=$home_page->row_array();
				
				$data["home_id"] = $get_home_page['home_id'];
				$data["home_description"] = $get_home_page['home_description'];
				$data["home_title"] = $get_home_page['home_title'];
				$data["active"] = $get_home_page['active'];				
			}
			
			
			$data['site_setting'] = $this->home_model->select_site_setting();
			
			/*$this->template->write('title', 'Home Page', '', TRUE);
			$this->template->write_view('header', 'header', $data, TRUE);
			$this->template->write_view('main_content', 'home_page', $data, TRUE);
			$this->template->write_view('footer', 'footer', '', TRUE);
			$this->template->render();*/
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/page/home_page',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
		}else{
			
		
			$this->db->query("update home_page set home_title='".$this->input->post('home_title')."', home_description='".$this->input->post('home_description')."',active='".$this->input->post('active')."' where home_id='1'");
			
			$data["error"] = "Home Page updated successfully";
			$data["home_description"] = $this->input->post('home_description');
			$data["home_title"] = $this->input->post('home_title');
			$data["active"] = $this->input->post('active');	
			$data["home_id"] = $this->input->post('home_id');
				
			$data['site_setting'] = $this->home_model->select_site_setting();	
				
			/*$this->template->write('title', 'Home Page', '', TRUE);
			$this->template->write_view('header', 'header', $data, TRUE);
			$this->template->write_view('main_content', 'home_page', $data, TRUE);
			$this->template->write_view('footer', 'footer', '', TRUE);
			$this->template->render();*/
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/page/home_page',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
			
		}				
	}
	
function add_pages($limit=20)
	{
		
		
		$data = array();
		$check_rights= get_rights('list_pages');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');

		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('pages_title', 'Pages Title', 'required');
		$this->form_validation->set_rules('external_link', 'External URL', 'valid_url');
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			$data["pages_id"] = $this->input->post('pages_id');
			$data["pages_title"] = $this->input->post('pages_title');
			$data["description"] = $this->input->post('description');
			$data["slug"] = $this->input->post('slug');
			$data["active"] = $this->input->post('active');
			
			$data["header_bar"] = $this->input->post('header_bar');
			$data["footer_bar"] = $this->input->post('footer_bar');
			$data["left_side"] = $this->input->post('left_side');
			$data["right_side"] = $this->input->post('right_side');
			$data["external_link"] = $this->input->post('external_link');
			
			$data["meta_keyword"] = $this->input->post('meta_keyword');
			$data["meta_description"] = $this->input->post('meta_description');
			if($this->input->post('offset')=="")
			{
				$limit = '10';
				$totalRows = $this->pages_model->get_total_pages_count();
				$data["offset"] = (int)($totalRows/$limit)*$limit;
			}else{
				$data["offset"] = $this->input->post('offset');
			}
			
			$data['site_setting'] = site_setting();
			
			/*$this->template->write('title', 'Pages', '', TRUE);
			$this->template->write_view('header', 'header', $data, TRUE);
			$this->template->write_view('main_content', 'add_pages', $data, TRUE);
			$this->template->write_view('footer', 'footer', '', TRUE);
			$this->template->render();*/
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/page/add_pages',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
			
		}else{
			if($this->input->post('pages_id'))
			{
				$this->pages_model->pages_update();
				$msg = "update";
			}else{
				$this->pages_model->pages_insert();
				$msg = "insert";
			}
			$offset = $this->input->post('offset');
			redirect('pages/list_pages/'.$limit.'/'.$offset.'/'.$msg);
		}				
	}
	
	function edit_pages($id=0,$offset=0)
	{
		
		//$check_rights=$this->home_model->get_rights('list_pages');
		$data = array();
		$check_rights= get_rights('list_pages');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');

		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		$one_pages = $this->pages_model->get_one_pages($id);
		$data["error"] = "";
		$data["pages_id"] = $id;
		$data["pages_title"] = $one_pages['pages_title'];
		$data["description"] = $one_pages['description'];
		$data["slug"] = $one_pages['slug'];
		$data["active"] = $one_pages['active'];
		$data["meta_keyword"] = $one_pages['meta_keyword'];
		$data["meta_description"] = $one_pages['meta_description'];
		$data["offset"] = $offset;
		
		$data["header_bar"] = $one_pages['header_bar'];
		$data["footer_bar"] = $one_pages['footer_bar'];
		$data["left_side"] = $one_pages['left_side'];
		$data["right_side"] =$one_pages['right_side'];
		$data["external_link"] =$one_pages['external_link'];
		$data["base_url"] = base_url();
		//$data['site_setting'] = $this->home_model->select_site_setting();
		
		$data['site_setting']=site_setting();
		
		/*$this->template->write('title', 'Pages', '', TRUE);
		$this->template->write_view('header', 'header', $data, TRUE);
		$this->template->write_view('main_content', 'add_pages', $data, TRUE);
		$this->template->write_view('footer', 'footer', '', TRUE);
		$this->template->render();*/
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/page/add_pages',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
	}
	
	function delete_pages($id=0,$offset=0)
	{
		$limit=20;
		//$check_rights=$this->home_model->get_rights('list_pages');
		$data = array();
		$check_rights= get_rights('list_pages');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');

		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$this->db->delete('pages',array('pages_id'=>$id));
		redirect('pages/list_pages/'.$limit.'/'.$offset.'/delete');
	}
	
	function list_pages($limit='20',$offset=0,$msg='')
	{
		
		//$check_rights=$this->home_model->get_rights('list_pages');
		
		$data = array();
		$check_rights= get_rights('list_pages');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		$this->load->library('pagination');

		$config['uri_segment']='4';
		$config['base_url'] = base_url().'page/list_pages/'.$limit.'/';
		$config['total_rows'] = $this->pages_model->get_total_pages_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->pages_model->get_pages_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting'] = site_setting();
		
		
		/*$this->template->write('title', 'Pages', '', TRUE);
		$this->template->write_view('header', 'header',$data, TRUE);
		$this->template->write_view('main_content', 'list_pages', $data, TRUE);
		$this->template->write_view('footer', 'footer', '', TRUE);
		$this->template->render();*/
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/page/list_pages',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	function search_list_pages($limit=20,$option='',$keyword='',$offset=0,$msg='')
	{
		
		//$check_rights=$this->home_model->get_rights('list_state');
		$data = array();
		$check_rights= get_rights('list_pages');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');

		
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
		$config['base_url'] = base_url().'pages/search_list_pages/'.$limit.'/'.$option.'/'.$keyword.'/';
		$config['total_rows'] = $this->pages_model->get_total_search_pages_count($option,$keyword);
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->pages_model->get_search_pages_result($option,$keyword,$offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		//$data['statelist']=$this->project_category_model->get_state();
		
		$data['site_setting'] = $this->home_model->select_site_setting();
		
		$data['limit']=$limit;
		$data['option']=$option;
		$data['keyword']=$keyword;
		$data['search_type']='search';
		
		/*$this->template->write('title', 'Search State', '', TRUE);
		$this->template->write_view('header', 'header', $data, TRUE);
		$this->template->write_view('main_content', 'list_pages', $data, TRUE);
		$this->template->write_view('footer', 'footer', '', TRUE);
		$this->template->render();*/
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/page/list_pages',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	function list_members($limit='20',$offset=0,$msg='')
	{
		
		//$check_rights=$this->home_model->get_rights('list_pages');
		
		$data = array();
		//$check_rights= get_rights('list_pages');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		//if(	$check_rights==0) {			
			//redirect('home/dashboard/no_rights');	
		//}
		
		
		
		$this->load->library('pagination');

		$config['uri_segment']='4';
		$config['base_url'] = base_url().'page/list_members/'.$limit.'/';
		$config['total_rows'] = $this->pages_model->get_total_members_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->pages_model->get_members_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting'] = site_setting();
		
		
		/*$this->template->write('title', 'Pages', '', TRUE);
		$this->template->write_view('header', 'header',$data, TRUE);
		$this->template->write_view('main_content', 'list_pages', $data, TRUE);
		$this->template->write_view('footer', 'footer', '', TRUE);
		$this->template->render();*/
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/page/list_membership',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}

	function add_members($limit=20)
	{
		
		
		$data = array();
		//$check_rights= get_rights('list_pages');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');

		
		//if(	$check_rights==0) {			
			//redirect('home/dashboard/no_rights');	
		//}
		
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('title', 'Title', 'required');
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			$data["id"] = $this->input->post('id');
			$data["title"] = $this->input->post('pages_title');
			$data["description"] = $this->input->post('description');
			$data["price"] = $this->input->post('price');
			$data["numbid"] = $this->input->post('numbid');
			$data["active"] = $this->input->post('active');
			
			
			if($this->input->post('offset')=="")
			{
				$limit = '10';
				$totalRows = $this->pages_model->get_total_members_count();
				$data["offset"] = (int)($totalRows/$limit)*$limit;
			}else{
				$data["offset"] = $this->input->post('offset');
			}
			
			$data['site_setting'] = site_setting();
			
			/*$this->template->write('title', 'Pages', '', TRUE);
			$this->template->write_view('header', 'header', $data, TRUE);
			$this->template->write_view('main_content', 'add_pages', $data, TRUE);
			$this->template->write_view('footer', 'footer', '', TRUE);
			$this->template->render();*/
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/page/add_membership',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
			
		}else{
			if($this->input->post('id'))
			{
				$this->pages_model->membership_update();
				$msg = "update";
			}else{
				$this->pages_model->membership_insert();
				$msg = "insert";
			}
			$offset = $this->input->post('offset');
			redirect('pages/list_members/'.$limit.'/'.$offset.'/'.$msg);
		}				
	}
	function edit_members($id=0,$offset=0)
	{
		
		//$check_rights=$this->home_model->get_rights('list_pages');
		$data = array();
		//$check_rights= get_rights('list_pages');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');

		
		//if(	$check_rights==0) {			
			//redirect('home/dashboard/no_rights');	
		//}
		
		
		
		$one_pages = $this->pages_model->get_one_membership($id);
		$data["error"] = "";
		$data["id"] = $id;
		$data["title"] = $one_pages['title'];
		$data["description"] = $one_pages['description'];
		$data["price"] = $one_pages['price'];
		$data["active"] = $one_pages['status'];
		$data["numbid"] = $one_pages['numbid'];
		$data["offset"] = $offset;
		
		$data["base_url"] = base_url();
		//$data['site_setting'] = $this->home_model->select_site_setting();
		
		$data['site_setting']=site_setting();
		
		/*$this->template->write('title', 'Pages', '', TRUE);
		$this->template->write_view('header', 'header', $data, TRUE);
		$this->template->write_view('main_content', 'add_pages', $data, TRUE);
		$this->template->write_view('footer', 'footer', '', TRUE);
		$this->template->render();*/
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/page/add_membership',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
	}
	function delete_member($id=0,$offset=0)
	{
		$limit=20;
		//$check_rights=$this->home_model->get_rights('list_pages');
		$data = array();
		//$check_rights= get_rights('list_pages');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');

		
		//if(	$check_rights==0) {			
			//redirect('home/dashboard/no_rights');	
		//}
		
		$this->db->delete('membership',array('id'=>$id));
		redirect('pages/list_members/'.$limit.'/'.$offset.'/delete');
	}

	function list_banner($limit='20',$offset=0,$msg='')
	{
		
		//$check_rights=$this->home_model->get_rights('list_pages');
		
		$data = array();
		//$check_rights= get_rights('list_pages');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		//if(	$check_rights==0) {			
			//redirect('home/dashboard/no_rights');	
		//}
		
		
		
		$this->load->library('pagination');

		$config['uri_segment']='4';
		$config['base_url'] = base_url().'page/list_banner/'.$limit.'/';
		$config['total_rows'] = $this->pages_model->get_total_banner_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->pages_model->get_banner_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting'] = site_setting();
		
		
		/*$this->template->write('title', 'Pages', '', TRUE);
		$this->template->write_view('header', 'header',$data, TRUE);
		$this->template->write_view('main_content', 'list_pages', $data, TRUE);
		$this->template->write_view('footer', 'footer', '', TRUE);
		$this->template->render();*/
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/page/list_banner',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}

	function add_banner($limit=20)
	{
		
		
		$data = array();
		//$check_rights= get_rights('list_pages');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');

		
		//if(	$check_rights==0) {			
			//redirect('home/dashboard/no_rights');	
		//}
		
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('title', 'Title', 'required');
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			$data["id"] = $this->input->post('id');
			$data["title"] = $this->input->post('title');
			$data["description"] = $this->input->post('description');
			$data["image_name"] = $this->input->post('image_name');
			$data["link"] = $this->input->post('link');
			
			
			if($this->input->post('offset')=="")
			{
				$limit = '10';
				$totalRows = $this->pages_model->get_total_banner_count();
				$data["offset"] = (int)($totalRows/$limit)*$limit;
			}else{
				$data["offset"] = $this->input->post('offset');
			}
			
			$data['site_setting'] = site_setting();
			
			/*$this->template->write('title', 'Pages', '', TRUE);
			$this->template->write_view('header', 'header', $data, TRUE);
			$this->template->write_view('main_content', 'add_pages', $data, TRUE);
			$this->template->write_view('footer', 'footer', '', TRUE);
			$this->template->render();*/
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/page/add_banner',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
			
		}else{
			if($this->input->post('id'))
			{
				$this->pages_model->addbanner_update();
				$msg = "update";
			}else{
				$this->pages_model->addbanner_insert();
				$msg = "insert";
			}
			$offset = $this->input->post('offset');
			redirect('pages/list_banner/'.$limit.'/'.$offset.'/'.$msg);
		}				
	}
	function edit_banners($id=0,$offset=0)
	{
		
		//$check_rights=$this->home_model->get_rights('list_pages');
		$data = array();
		//$check_rights= get_rights('list_pages');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');

		
		//if(	$check_rights==0) {			
			//redirect('home/dashboard/no_rights');	
		//}
		
		
		
		$one_pages = $this->pages_model->get_one_banner($id);
		$data["error"] = "";
		$data["id"] = $id;
		$data["title"] = $one_pages['title'];
		$data["description"] = $one_pages['description'];
		$data["image_name"] = $one_pages['image_name'];
		$data["link"] = $one_pages['link'];
		$data["offset"] = $offset;
		
		$data["base_url"] = base_url();
		//$data['site_setting'] = $this->home_model->select_site_setting();
		
		$data['site_setting']=site_setting();
		
		/*$this->template->write('title', 'Pages', '', TRUE);
		$this->template->write_view('header', 'header', $data, TRUE);
		$this->template->write_view('main_content', 'add_pages', $data, TRUE);
		$this->template->write_view('footer', 'footer', '', TRUE);
		$this->template->render();*/
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/page/add_banner',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
	}
	function delete_banner($id=0,$offset=0)
	{
		$limit=20;
		//$check_rights=$this->home_model->get_rights('list_pages');
		$data = array();
		//$check_rights= get_rights('list_pages');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');

		
		//if(	$check_rights==0) {			
			//redirect('home/dashboard/no_rights');	
		//}
		
		$this->db->delete('banner',array('id'=>$id));
		redirect('pages/list_banner/'.$limit.'/'.$offset.'/delete');
	}
}
?>