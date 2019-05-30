<?php
class Dispute extends CI_Controller {
	function Dispute()
	{
		 parent::__construct();	
		$this->load->model('dispute_model');
		$this->load->model('user_model');
		$this->load->model('worker_model');
		$this->load->model('task_model');
	}
	
	function index()
	{
		redirect('dispute/list_dispute');
	}
	
	
	/****how its work***/
	function how_its_work()
	{	
		$theme = getThemeName();
		
		$this->load->view($theme.'/layout/dispute/how_its_work');
	}
	
	
	function list_dispute($limit=20,$offset=0,$msg='')
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('dispute_list');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}

		$this->load->library('pagination');

		//$limit = '10';
		$config['uri_segment']='4';
		$config['base_url'] = base_url().'dispute/list_dispute/'.$limit.'/';
		$config['total_rows'] = $this->dispute_model->get_total_dispute_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->dispute_model->get_dispute_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/dispute/list_dispute',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	function conversation($task_id,$limit=20,$offset=0)
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('dispute_list');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}

		$this->load->library('pagination');

		//$limit = '10';
		$config['uri_segment']='4';
		$config['base_url'] = base_url().'dispute/conversation/'.$task_id.'/'.$limit.'/';
		$config['total_rows'] = $this->dispute_model->get_total_conversation_count($task_id);
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->dispute_model->get_conversation_result($task_id,$offset, $limit);
		
		$data['offset'] = $offset;
		$data["error"] ='';
		
		$data['limit']=$limit;
		$data['site_setting'] = site_setting();

		$data['task_details'] = $this->task_model->task_detail($task_id);
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/dispute/list_conversation',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	function dispute_win($task_id){
	
		$data["error"] ='';
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$task = $this->db->get_where("task",array('task_id'=>$task_id));
		$task_details = $task->row();
	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('win_option', 'Payment Options', 'required');
		
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			
			$this->load->library('pagination');
			$limit=20; 
			$offset=0;
			$config['uri_segment']='4';
			$config['base_url'] = base_url().'dispute/conversation/'.$task_id.'/'.$limit.'/';
			$config['total_rows'] = $this->dispute_model->get_total_conversation_count($task_id);
			$config['per_page'] = $limit;		
			$this->pagination->initialize($config);		
			$data['page_link'] = $this->pagination->create_links();
			
			$data['result'] = $this->dispute_model->get_conversation_result($task_id,$offset, $limit);
			
			$data['offset'] = $offset;
			$data['limit']=$limit;
			$data['site_setting'] = site_setting();
			$data['task_details'] = $task_details;
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			$this->template->write_view('center',$theme .'/layout/dispute/list_conversation',$data,TRUE);
			$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			$this->template->render();
			
		} else {
	
			
			$win_user_id = $this->input->post('user_id');

			if($this->input->post('win_option') == 'full_payment'){
			
				$amount = '';
				if($task_details->user_id == $win_user_id){
					$cutfee = $this->input->post('cutfee');
					$poster_user_id = $this->input->post('worker_user_id');
				} else {
					$cutfee = '';
					$poster_user_id = $this->input->post('task_user_id');
				}
			
				$data = array(
					'win_user_id' => $win_user_id,
					'dispute_status' => 2,
					'dispute_win_type'=>1
				);
				$this->db->where('task_id',$task_id);
				$this->db->update('dispute',$data);
				
				$wallet = $this->dispute_model->wallet_payment($task_details->user_id,$task_id,$cutfee,$win_user_id,$amount);
				
				
				
				$message = array(
					'act' => 'taskwin',
					'task_id' => $task_id,
					'poster_user_id' => $poster_user_id,
					'receiver_user_id' => $win_user_id,
					'is_read' => 0,
					'message_date' => date('Y-m-d H:i:s')
				);
				$this->db->insert('message', $message);
				
				$message2 = array(
					'act' => 'taskloss',
					'task_id' => $task_id,
					'poster_user_id' => $win_user_id,
					'receiver_user_id' => $poster_user_id,
					'is_read' => 0,
					'message_date' => date('Y-m-d H:i:s')
				);
				$this->db->insert('message', $message2);
				
				$update_task=array(
				   'task_close_date'=>date('Y-m-d H:i:s'),
				   'poster_agree'=>1,
				   'worker_agree'=>1
				);
		
			   $this->db->where('task_id',$task_id);
			   $this->db->update('task',$update_task);
			}
			
			if($this->input->post('win_option') == 'partial_payment'){

				///====== refunt Poster amount start 
				
				$task_user_id= $this->input->post('task_user_id');
				$worker_user_id = $this->input->post('worker_user_id');
				$asker_amount = $this->input->post('asker_amount');
				$tasker_amount = $this->input->post('tasker_amount');
				$cutfee = $this->input->post('cutfee');

				$wallet = $this->dispute_model->wallet_payment($task_details->user_id,$task_id,$cutfee,$task_user_id,$asker_amount);

				$message = array(
					'act' => 'taskcompromise',
					'task_id' => $task_id,
					'poster_user_id' => $worker_user_id,
					'receiver_user_id' => $task_user_id,
					'is_read' => 0,
					'message_date' => date('Y-m-d H:i:s')
				);
				$this->db->insert('message', $message);
				
				///====== refunt Poster amount end 
				
				///====== refunt Runner amount start 
				
				$cutfee = '';
				
				$wallet = $this->dispute_model->wallet_payment($task_details->user_id,$task_id,$cutfee,$worker_user_id,$tasker_amount);
				
				$message2 = array(
					'act' => 'taskcompromise',
					'task_id' => $task_id,
					'poster_user_id' => $task_user_id,
					'receiver_user_id' => $worker_user_id,
					'is_read' => 0,
					'message_date' => date('Y-m-d H:i:s')
				);
				$this->db->insert('message', $message2);
				
				///====== refunt Runner amount end 
				
				$data = array(
					'win_user_id' => 0,
					'dispute_status' => 2,
					'dispute_win_type'=>2
				);
				$this->db->where('task_id',$task_id);
				$this->db->update('dispute',$data);
				
				
				$update_task=array(
				   'task_close_date'=>date('Y-m-d H:i:s'),
				   'task_activity_status'=>3,
				   'poster_agree'=>1,
				   'worker_agree'=>1
				);
			   $this->db->where('task_id',$task_id);
			   $this->db->update('task',$update_task);
			}
			
			if($this->input->post('win_option') == 'resume'){
			
				
				$task_user_id= $this->input->post('task_user_id');
				$worker_user_id = $this->input->post('worker_user_id');
				
				
				$cutfee= 'no';
				
				$final_price = $this->dispute_model->offer_price($task_details->task_worker_id,$task_details->task_id);
				
				$wallet = $this->dispute_model->wallet_payment($task_details->user_id,$task_id,$cutfee,$task_details->user_id,$final_price);
				
	
				$message = array(
					'act' => 'taskresume',
					'task_id' => $task_id,
					'poster_user_id' => $worker_user_id,
					'receiver_user_id' => $task_user_id,
					'is_read' => 0,
					'message_date' => date('Y-m-d H:i:s')
				);
				$this->db->insert('message', $message);
				
				$message2 = array(
					'act' => 'taskresume',
					'task_id' => $task_id,
					'poster_user_id' => $task_user_id,
					'receiver_user_id' => $worker_user_id,
					'is_read' => 0,
					'message_date' => date('Y-m-d H:i:s')
				);
				$this->db->insert('message', $message2);
				
				
				
				
				$data = array(
					'win_user_id' => 0,
					'dispute_status' => 3,
					'dispute_win_type'=>3
				);
				$this->db->where('task_id',$task_id);
				$this->db->update('dispute',$data);
				
				
				$update_task=array(
				   'task_assigned_date'=>'0000-00-00 00:00:00',
				   'task_complete_date'=>'0000-00-00 00:00:00',
				   'task_close_date'=>'0000-00-00 00:00:00',
				   'task_activity_status'=>0,
				   'poster_agree'=>0,
				   'worker_agree'=>0
				);	
			   $this->db->where('task_id',$task_id);
			   $this->db->update('task',$update_task);
			}
	
			redirect('dispute/list_dispute');
		}
	}

}
?>
