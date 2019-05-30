<?php
class City extends CI_Controller {
	function City()
	{
		parent::__construct();	
		$this->load->model('city_model');
		$this->load->model('home_model');
			
	}
	
	function index()
	{
		redirect('city/list_city/');
	}
	
	function add_city($limit=20)
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_city');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('city_name', 'City Name', 'required|alpha_space');
		$this->form_validation->set_rules('country_id', 'Country', 'required');
		$this->form_validation->set_rules('state_id', 'State', 'required');
		
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			$data["city_id"] = $this->input->post('city_id');
			$data["country_id"] = $this->input->post('country_id');
			$data["state_id"] = $this->input->post('state_id');
			$data["city_name"] = $this->input->post('city_name');
			$data["city_latitude"] = $this->input->post('city_latitude');
			$data["city_longitude"] = $this->input->post('city_longitude');
			$data["city_timezone"] = $this->input->post('city_timezone');
			$data["active"] = $this->input->post('active');
			$data['state'] = $this->city_model->get_state_result();
			$data['country'] = $this->city_model->get_country_result();
			
			if($this->input->post('offset')=="")
			{
				$limit = '15';
				$totalRows = $this->city_model->get_total_city_count();
				$data["offset"] = (int)($totalRows/$limit)*$limit;
			}else{
				$data["offset"] = $this->input->post('offset');
			}
			
			$data['site_setting'] = site_setting();
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		    $this->template->write_view('center',$theme .'/layout/city/add_city',$data,TRUE);
		    $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		    $this->template->render();
		}else{
			if($this->input->post('city_id'))
			{
				$this->city_model->city_update();
				$msg = "update";
			}else{
				$this->city_model->city_insert();
				$msg = "insert";
			}
			$offset = $this->input->post('offset');
			redirect('city/list_city/'.$limit.'/'.$offset.'/'.$msg);
		}				
	}
	
	function edit_city($id=0,$offset=0)
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_city');

		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$one_city = $this->city_model->get_one_city($id);
		$data["error"] = "";
		$data["city_id"] = $id;
		$data["country_id"] = $one_city['country_id'];
		$data["state_id"] = $one_city['state_id'];
		$data["city_name"] = $one_city['city_name'];
		$data["city_latitude"] = $one_city['city_latitude'];
		$data["city_longitude"] = $one_city['city_longitude'];
		$data["city_timezone"] = $one_city['city_timezone'];
		$data["active"] = $one_city['active'];
		$data["offset"] = $offset;
		$data['state'] = $this->city_model->get_state_result();
		$data['country'] = $this->city_model->get_country_result();
		
		$data['site_setting'] = site_setting();
		
		
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/city/add_city',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();	
	}
	
	function delete_city($id=0,$offset=0)
	{
		$limit=20;
		//$check_rights=$this->home_model->get_rights('list_city');
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_city');


		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		/*********delete from cache**********/
		
		$supported_cache=check_supported_cache_driver();
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
				////===load cache driver===
				$this->load->driver('cache');
				
				if($this->cache->$supported_cache->get('city'.$id))
				{
					$this->cache->$supported_cache->delete('city'.$id);	
				}
				
			}
		}
		
		/*********delete from cache**********/
		
		$this->db->delete('city',array('city_id'=>$id));
		
		
		/*********update city list**********/
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
				////===load cache driver===
				$this->load->driver('cache');				
				
					$this->db->order_by('city_name','asc');
					$query = $this->db->get_where("city",array('active'=>1));
					
					if($query->num_rows()>0)
					{
						 $this->cache->$supported_cache->save('city_list', $query->result(),CACHE_VALID_SEC);	
						
					}		
				
			}			
			
		}
		
		/*********update city list**********/
		
		redirect('city/list_city/'.$limit.'/'.$offset.'/delete');
	}
	
	function list_city($limit='20',$offset=0,$msg='')
	{
		//$check_rights=$this->home_model->get_rights('list_city');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_city');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$this->load->library('pagination');

		$config['uri_segment']='4';
		$config['base_url'] = base_url().'city/list_city/'.$limit.'/';
		$config['total_rows'] = $this->city_model->get_total_city_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->city_model->get_city_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting'] = $this->home_model->select_site_setting();
		
		/*$this->template->write('title', 'Cities', '', TRUE);
		$this->template->write_view('header', 'header', $data, TRUE);
		$this->template->write_view('main_content', 'list_city', $data, TRUE);
		$this->template->write_view('footer', 'footer', '', TRUE);
		$this->template->render();*/
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
	    $this->template->write_view('center',$theme .'/layout/city/list_city',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
	    $this->template->render();
	}
	
	
	function search_list_city($limit=20,$option='',$keyword='',$offset=0,$msg='')
	{
		//$check_rights=$this->home_model->get_rights('list_faq');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_city');

		
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
		$config['base_url'] = base_url().'city/search_list_city/'.$limit.'/'.$option.'/'.$keyword.'/';
		$config['total_rows'] = $this->city_model->get_total_search_city_count($option,$keyword);
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->city_model->get_search_city_result($option,$keyword,$offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		//$data['statelist']=$this->project_category_model->get_state();
		
		$data['site_setting'] = $this->home_model->select_site_setting();
		
		$data['limit']=$limit;
		$data['option']=$option;
		$data['keyword']=$keyword;
		$data['search_type']='search';
		
		
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		    $this->template->write_view('center',$theme .'/layout/city/list_city',$data,TRUE);
		    $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		    $this->template->render();
	}
	
	function statebycountry($country_id)
	{
		$data['state'] = $this->city_model->statebycountry($country_id);
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		$this->load->view($theme .'/layout/city/statebycountry',$data);
		
	}
	
}
?>