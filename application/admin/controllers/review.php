<?php
class Review extends CI_Controller
{
     
  	function Review()
    {
    	parent::__construct();
		$this->load->model('review_model');
		$this->load->model('worker_model');
 	}
  
  	function index()
	{
		redirect('review/list_review');
	}
 
	function list_review($offset=0,$msg='')
 	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		//$check_rights=get_rights('list_review');
		
		//if(	$check_rights==0) {			
			//redirect('home/dashboard/no_rights');	
		//}
		
		$this->load->library('pagination');

		$limit = '20';
		$config['base_url'] = base_url().'review/list_review/';
		$config['total_rows'] = $this->review_model->get_total_review_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->review_model->get_all_review($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		$data['limit']=$limit;
		
		
		
		
		
		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/review/list_review',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	function edit_review($cid,$offset=0)
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		$data["error"] = "";
		
		//$check_rights=get_rights('list_review');
		
		//if(	$check_rights==0) {			
			//redirect('home/dashboard/no_rights');	
		//}
		
		
		$data['cid'] = $cid;
		$data['offset'] = $offset;
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('task_comment', 'Task Comment', 'required');
		
		
		
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			if($this->input->post('task_comment_id'))
			{

				$data["task_comment_id"] = $this->input->post('task_comment_id');
				$data["task_comment"] = $this->input->post('task_comment');
				$data["comment_rate"] = $this->input->post('comment_rate');
				
			}else{
				$one_review = $this->review_model->get_one_review($cid);

				$data["task_comment_id"] = $one_review->task_comment_id;
				$data["task_comment"] = $one_review->task_comment;	
				$data["comment_rate"] =  $one_review->comment_rate;
				
			}

			
			$data['site_setting'] = site_setting(); 
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			$this->template->write_view('center',$theme .'/layout/review/edit_review',$data,TRUE);
			$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			$this->template->render();
			
		}else{
			$this->review_model->edit_review();
			
			redirect('review/list_review/'.$offset.'/update');	
		}				

		
	}
	
	function delete_review($cid,$offset=0){
	
		$this->db->delete('worker_comment',array('task_comment_id'=>$cid));
		
		redirect('review/list_review/'.$offset.'/delete');	
	
	}
}
?>