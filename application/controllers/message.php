<?php
class Message extends ROCKERS_Controller 
{
	
	/*
	Function name :Message()
	Description :Its Default Constuctor which called when message object initialzie.its load necesary models
	*/
	
	function Message()
	{
		 parent::__construct();	
		$this->load->model('message_model');
		$this->load->model('user_task_model');
		$this->load->model('task_model');
		$this->load->model('worker_model');
		$this->load->model('user_task_model');
		$this->load->model('search_model');
		$this->load->model('home_model');	
		$this->load->model('user_model');	
	}
	
	
	
	/*
	Function name :index()
	Parameter :none
	Return : none
	Use : redirect to user all messages
	Description : none
	*/
	
	function index()
	{
		redirect('message/allmessage');
	}
	
	
	/*
	Function name :allmessage()
	Parameter :$offset(for paging)
	Return : array of all message
	Use : get user all alret message
	Description : get user all message this function called by http://hostname/message/allmessage
	*/
	
	
	function allmessage($offset=0)
	{
	
		$this->load->library('pagination');
		
		$limit = '10';
		$config['uri_segment']='3';
		$config['base_url'] = site_url('message/allmessage');
		$config['total_rows'] = $this->message_model->get_count_message();
		$config['per_page'] = $limit;
				
		$this->pagination->initialize($config);		
		
		$data['page_link'] = $this->pagination->create_links();
		$data['result'] =$this->message_model->get_all_message($offset,$limit);
		$data['total_rows']=$config['total_rows'];

		
		$data['site_setting']=site_setting();
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		$data['theme']=$theme;
		$meta_setting=meta_setting();
		
		$pageTitle='All Messages for - '.$meta_setting->title;
		$metaDescription='All Messages for - '.$meta_setting->meta_description;
		$metaKeyword='All Messages for - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/message/message',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	
	}
	
	
	
	/*
	Function name :read()
	Parameter :$id(message id)
	Return : none
	Use : unread the user message once click on the message link
	Description : all unread message status change by clicking on this function called by http://hostname/message/read/$id
	*/
	
	
	function read($id)
	{
		
		$message = $this->message_model->get_message_detail($id);
		
		$poster = $this->message_model->get_worker_details($message->poster_user_id);

		$data_read=array(
			'is_read'=>1
		) ;
		$this->db->where('message_id',$id);
		if($this->db->update('message',$data_read)){
		
			if(($message->act == 'newoffer') || ($message->act == 'taskfinish') || ($message->act == 'taskcomplete') || ($message->act == 'offeraccept') || ($message->act == 'newmessage') || ($message->act == 'taskassign') ){ 
			
				redirect('tasks/'.$message->task_url_name);
			}
			

			if(($message->act == 'workerwallet') || ($message->act == 'taskcompromise') || ($message->act == 'taskwin') || ($message->act == 'taskloss')){ redirect('wallet'); }
			
			if($message->act == 'taskdispute'){ redirect('dispute/dispute_task/'.$message->task_id); }
			
			if($message->act == 'newconversation'){ redirect('user_task/conversation/'.$poster->worker_id.'/'.$message->task_id); }
			
			if($message->act == 'taskdisputeconversation'){ redirect('dispute/dispute_task/'.$message->task_id); }
			
		
		}
	
	}
}
?>