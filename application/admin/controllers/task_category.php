<?php
class task_category extends CI_Controller {
	function Task_category()
	{
		parent::__construct();
		$this->load->model('task_category_model');
		$this->load->model('home_model');
		
		
	}
	
	function index()
	{
		
		redirect('task_category/list_task_category');
	}
	
	
	
	function list_task_category($offset=0,$msg='')
	{
		
		$data = array();
	     $theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
	
		$check_rights= get_rights('list_task_category'); 
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$this->load->library('pagination');

		$limit = '10';
		
		$config['base_url'] = base_url().'task_category/list_task_category/';
		$config['total_rows'] = $this->task_category_model->get_total_task_category_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['site_setting'] = site_setting();
		
		$data['result'] = $this->task_category_model->get_task_category_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
	
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
	    $this->template->write_view('center',$theme .'/layout/category/list_task_category',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
		
		
	}
	
	function add_task_category()
	{
		
		
		 $data = array();
	     $theme = getThemeName();
		 $this->template->set_master_template($theme .'/template.php');

		 $check_rights= get_rights('list_task_category');

		if(	$check_rights==0) {	
			echo "<script>parent.window.location.href='".base_url()."home/dashboard/no_rights'</script>";
			
		}
		
		$this->form_validation->set_rules('category_name', 'Category Name', 'required|alpha_numeric_space');
		
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
		
			$data["task_category_id"] = $this->input->post('task_category_id ');
			$data["category_name"] = $this->input->post('category_name');
			$data["category_parent_id"] = $this->input->post('category_parent_id');
			$data["category_status"] = $this->input->post('category_status');
			$data["category_url_name"] = $this->input->post('category_url_name');
			$data["category_description"] = $this->input->post('category_description');
			$data["category_average_price"] = $this->input->post('category_average_price');
			$data["category_image"] = $this->input->post('category_image');

			$data['all_category'] = $this->task_category_model->get_parent_category();
			
			$data["active"] = $this->input->post('active');
			if($this->input->post('offset')=="")
			{
				$limit = '10';
				$totalRows = $this->task_category_model->get_total_task_category_count();
				$data["offset"] = (int)($totalRows/$limit)*$limit;
			}else{
				$data["offset"] = $this->input->post('offset');
			}
			
			
			$data['site_setting'] = site_setting();

			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
	        $this->template->write_view('center',$theme .'/layout/category/add_task_category',$data,TRUE);
		    $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		    $this->template->render();
			
		}
		else{
			if($this->input->post('task_category_id'))
			{
				$this->task_category_model->task_category_update();
				$msg = "update";
			}else{
				$this->task_category_model->task_category_insert();
				$msg = "insert";
			}
			$offset = $this->input->post('offset');
			redirect('task_category/list_task_category/'.$offset.'/'.$msg);
		}				
	}
	
	function edit_task_category($id=0,$offset=0)
	{
		  $data = array();
	     $theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');

		$check_rights= get_rights('list_task_category');

		
		if(	$check_rights==0) {			
		redirect('home/dashboard/no_rights');	
		}
		$one_project_category = $this->task_category_model->get_one_task_category($id);
		
			$data["error"] = "";
			$data['task_category_id']=$id;
			$data["category_name"] = $one_project_category['category_name'];
			$data["category_parent_id"] = $one_project_category['category_parent_id'];
			$data["category_status"] = $one_project_category['category_status'];
			$data["category_url_name"] = $one_project_category['category_url_name'];
			$data["category_description"] = $one_project_category['category_description'];
			$data["category_average_price"] = $one_project_category['category_average_price'];
			$data["category_image"] = $one_project_category['category_image'];
			$data["offset"] = $offset;
			$data['all_category'] = $this->task_category_model->get_parent_category();
		    $data['site_setting'] = site_setting();
		    $this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
	        $this->template->write_view('center',$theme .'/layout/category/add_task_category',$data,TRUE);
		    $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		    $this->template->render();
	}
	function delete_task_category($id=0,$offset=0)
	{
			
		
		
		
		$pid=$id;
		
		
		$supported_cache=check_supported_cache_driver();
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
				////===load cache driver===
				$this->load->driver('cache');				
				
				
				/********update sub category list********/
				
				
		
					if($this->cache->$supported_cache->get('getsubcategory'.$pid))
					{
						$this->cache->$supported_cache->delete('getsubcategory'.$pid);	
						 
					}	
				
				
				
				
				/********update parent category list********/
				
				 $query = $this->db->get_where("task_category",array('category_status'=>1,'category_parent_id'=>0));
		
					if($query->num_rows()>0)
					{
						$this->cache->$supported_cache->save('getparentcategory', $query->result(),CACHE_VALID_SEC);	
					
					}
					
					
				
				/********update all category list********/
				
					$this->db->order_by('category_name','asc');
				   $query = $this->db->get_where("task_category",array('category_status'=>1));
				   
				   if($query->num_rows()>0)
				   {
						 $this->cache->$supported_cache->save('getallcategory', $query->result(),CACHE_VALID_SEC);	

					}		
				
			}			
			
		}
		
		
		
		
	   $this->db->delete('task_category',array('task_category_id'=>$id));
		redirect('task_category/list_task_category/'.$offset.'/delete');
	}
	
}
?>