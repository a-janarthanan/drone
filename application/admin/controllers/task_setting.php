<?php
class task_setting extends CI_Controller
{
     
   function task_setting()
   {
    parent::__construct();
	$this->load->model('task_setting_model');
  }
  function index()
 {
    redirect('task_setting/add_task_setting');    
 }
 
 function add_task_setting()
 {
       
		
		$check_rights=get_rights('add_task_setting');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$data = array();
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('task_setting_id', 'Task Setting Id', 'required');
		$this->form_validation->set_rules('comment_auto_publish', 'Comment Auto Publish', 'required');
		$this->form_validation->set_rules('post_task_enable', 'Post Task Enable', 'required');
		$this->form_validation->set_rules('task_post_fee', 'Admin Fee For Post Task', 'required');
		$this->form_validation->set_rules('task_worker_fee', 'Admin Fee For Runner', 'required');
		$this->form_validation->set_rules('task_auto_complete_hour', 'Task Auto Complete', 'required|numeric');
		$this->form_validation->set_rules('task_post_refund_fee', 'Admin Fee For Poster', 'required');
		
		
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}
			else{
				$data["error"] = "";
			}
			

              $task_setting1 = $this->task_setting_model->get_task_setting();
			  
			  
			  if(count($task_setting1)>0)
			  {
			    $data['task_setting_id']=$task_setting1->task_setting_id;
			    $data['comment_auto_publish']=$task_setting1->comment_auto_publish;
			    $data['post_task_enable']=$task_setting1->post_task_enable;
				$data['task_post_fee']=$task_setting1->task_post_fee;
			    $data['task_worker_fee']=$task_setting1->task_worker_fee;
			    $data['task_auto_complete_hour']=$task_setting1->task_auto_complete_hour;
				$data['task_post_refund_fee']=$task_setting1->task_post_refund_fee;
			 }
			
 			}
            else
			{  
			   if($this->input->post('task_setting_id'))
			   {
			       
				   
				   $data_update=array(
				   		'comment_auto_publish'=>$this->input->post('comment_auto_publish'),
				        'post_task_enable'=>$this->input->post('post_task_enable'),	
						'task_post_fee'=>$this->input->post('task_post_fee'),
				        'task_worker_fee'=>$this->input->post('task_worker_fee'),
						'task_auto_complete_hour'=>$this->input->post('task_auto_complete_hour'),	
						'task_post_refund_fee'=>$this->input->post('task_post_refund_fee')	
						);
									   
				  
				   $this->input->post('task_setting_id');
				   $this->db->where('task_setting_id',$this->input->post('task_setting_id'));
				   $this->db->update('task_setting',$data_update);	
				  
			
				    $task_setting = $this->task_setting_model->get_task_setting();
					
					$data["error"]="Task settings updated successfully.";
					$data['task_setting_id']=$task_setting->task_setting_id;
			        $data['comment_auto_publish']=$task_setting->comment_auto_publish;
			        $data['post_task_enable']=$task_setting	->post_task_enable;
					$data['task_post_fee']=$task_setting->task_post_fee;
			        $data['task_worker_fee']=$task_setting->task_worker_fee;
			        $data['task_auto_complete_hour']=$task_setting->task_auto_complete_hour;
					$data['task_post_refund_fee']=$task_setting->task_post_refund_fee;
					
					
					}
			   
			 
 
 }
 
  			 $this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/setting/add_task_setting',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
 
 }
 
 
 function add_dispute_setting()
 {
		$check_rights=get_rights('add_dispute_setting');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
       $data = array();
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('total_comment_limit', 'Dispute Comment Limit', 'required|numeric');
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}
			else{
				$data["error"] = "";
			}
			

              $dispute_setting = $this->task_setting_model->get_dispute_setting();
			  
			 
			  if(count($dispute_setting)>0)
			  {
			    $data['dispute_setting_id']=$dispute_setting->dispute_setting_id;
			    $data['total_comment_limit']=$dispute_setting->total_comment_limit;
			 }
			
 			}
            else
			{  
			   if($this->input->post('dispute_setting_id'))
			   {
			       
				   
				   $data_update=array('total_comment_limit'=>$this->input->post('total_comment_limit'));
									   
				  
				   $this->input->post('dispute_setting_id');
				   $this->db->where('dispute_setting_id',$this->input->post('dispute_setting_id'))	;
				   $this->db->update('dispute_setting',$data_update);	
				  
			
				    $dispute_setting1 = $this->task_setting_model->get_dispute_setting();
					
					$data["error"]="Dispute settings updated successfully.";
					$data['dispute_setting_id']=$dispute_setting1->dispute_setting_id;
			        $data['total_comment_limit']=$dispute_setting1->total_comment_limit;
			       
					
					
					}
			   
			  
 
 }
 
  			 $this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/setting/add_dispute_setting',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
 
 }

}
?>