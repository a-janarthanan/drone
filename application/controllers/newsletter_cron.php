<?php
class Newsletter_cron extends ROCKERS_Controller 
{
	
	/*
	Function name :Newsletter_cron()
	Description :Its Default Constuctor which called when newsletter_cron object initialzie.its load necesary models
	*/
	
	function Newsletter_cron()
	{
		parent::__construct();	

		$this->load->model('newsletter_model');
		$this->load->model('home_model');
		$this->load->model('user_model');		

	}
	
	
	/*
	Function name :index()
	Parameter :none
	Return : none
	Use : redirect to home
	Description : none
	*/
	
	function index()
	{
		redirect('home/');	
	}
	
	
	
	/*
	Function name :send()
	Parameter :none
	Return : none
	Use : this function use for sending email to subscriber
	Description : sending email to subscriber by this function which is called by http://hostname/newsletter_cron/send
	
	NOTE : set cron job for automatically sending the email to subscriber by setting this URL to server cron job  http://hostname/newsletter_cron/send
	*/
	
	function send()
	{
		
		$CI =& get_instance();
		$base_path = $CI->config->slash_item('base_path');
		
		
		$newsletter_control=$this->db->query("select * from ".$this->db->dbprefix('newsletter_setting'));
		$newsletter_setting=$newsletter_control->row();
				
		
			
				///////////////////============Email Setting===================================
							
			$this->load->library('email');
				
			
			///////====smtp====
			
			if($newsletter_setting->mailer=='smtp')
			{
			
				$config['protocol']='smtp';  
				$config['smtp_host']=trim($newsletter_setting->smtp_host);  
				$config['smtp_port']=trim($newsletter_setting->smtp_port);  
				$config['smtp_timeout']='30';  
				$config['smtp_user']=trim($newsletter_setting->smtp_email);  
				$config['smtp_pass']=trim($newsletter_setting->smtp_password);  
						
			}
			
			/////=====sendmail======
			
			elseif(	$newsletter_setting->mailer=='sendmail')
			{	
			
				$config['protocol'] = 'sendmail';
				$config['mailpath'] = trim($newsletter_setting->sendmail_path);
				
			}
			
			/////=====php mail default======
			
			else
			{
			
			}
				
				
			$config['wordwrap'] = TRUE;	
			$config['mailtype'] = 'html';
			$config['crlf'] = '\n\n';
			$config['newline'] = '\n\n';
			
			$this->email->initialize($config);
			
			$email_address_from=$newsletter_setting->newsletter_from_address;
			$email_from_name=$newsletter_setting->newsletter_from_name;
			
			$email_address_reply=$newsletter_setting->newsletter_reply_name;
			$email_reply_name=$newsletter_setting->newsletter_reply_address;
			
			
		
		///////////////////============Email Setting===================================
		
		
		
				
		$chk_job=$this->db->query("select * from ".$this->db->dbprefix('newsletter_job')." where job_start_date='".date('Y-m-d')."'");
		
		if($chk_job->num_rows()>0)
		{
			
			$job_list=$chk_job->result();
			
						
			foreach($job_list as $job)
			{
			
				///////////================job details===============	
				$get_job_details=$this->db->query("select * from ".$this->db->dbprefix('newsletter_job')." where job_id='".$job->job_id."'");
				$job_details=$get_job_details->row();
				
				if($job_details->newsletter_id!='' && $job_details->newsletter_id > 0)
				{ 
					///////////================newsletter details===============
					$get_newsletter_details=$this->db->query("select * from ".$this->db->dbprefix('newsletter_template')." where newsletter_id='".$job_details->newsletter_id."'");					
					$newsletter_details=$get_newsletter_details->row();
					
					
					
					///////////================subscriber details===============									
					$chk_newsletter_subscriber=$this->db->query("select * from ".$this->db->dbprefix('newsletter_subscribe')." where newsletter_id='".$job_details->newsletter_id."'");	
					$count_total_subscriber=$chk_newsletter_subscriber->num_rows();
					
					if($count_total_subscriber>0)
					{
					
					//////////////==========check sending total if send all then stop otherwise continue
					if($job_details->send_total<$count_total_subscriber)
					{
						$get_newsletter_subscriber=$this->db->query("select * from ".$this->db->dbprefix('newsletter_subscribe')." where newsletter_id='".$job_details->newsletter_id."' LIMIT ".$newsletter_setting->number_of_email_send." OFFSET ".$job_details->send_total);
						
						
						if($get_newsletter_subscriber->num_rows()>0)
						{
							$newsletter_subscriber=$get_newsletter_subscriber->result();
							$cnt=0;
							foreach($newsletter_subscriber as $subscribe)
							{
								
								////get user email details and newsletter template and add track code and subscibe,unscribe link make report id and status fail and sucess and generate 
								
								$get_newsletter_user_details=$this->db->query("select * from ".$this->db->dbprefix('newsletter_user')." where newsletter_user_id='".$subscribe->newsletter_user_id."'");
								
								if($get_newsletter_user_details->num_rows()>0)
								{
									$newsletter_user_details=$get_newsletter_user_details->row();
									
									if($newsletter_user_details->email!='')
									{
										
										$email_subject=$newsletter_details->subject;				
										$email_message=$newsletter_details->template_content;
										$attach_file=$newsletter_details->attach_file;
										$allow_subscribe_link=$newsletter_details->allow_subscribe_link;
										$allow_unsubscribe_link=$newsletter_details->allow_unsubscribe_link;
										
										$subscribe_link='<a href="'.base_url().'/newsletter/subscribe/'.$newsletter_user_details->email.'/'.$job_details->newsletter_id.'" style="color:#666666;">Subscribe</a>';
										
										
										$unsubscribe_link='<a href="'.base_url().'/newsletter/unsubscribe/'.$newsletter_user_details->email.'/'.$job_details->newsletter_id.'" style="color:#666666;">UnSubscribe</a>';
										
										
										if($allow_subscribe_link==1 || $allow_subscribe_link=='1')
										{
											$email_message.='<div style="clear:both;">'.$subscribe_link.'</div>';									
										}
										
										if($allow_unsubscribe_link==1 || $allow_unsubscribe_link=='1')
										{
											$email_message.='<div style="clear:both;">'.$unsubscribe_link.'</div>';									
										}
										
										
										$insert_report=$this->db->query("insert into ".$this->db->dbprefix('newsletter_report')."(`newsletter_user_id`,`job_id`)values('".$subscribe->newsletter_user_id."','".$job->job_id."')");	
										
										$report_id=mysql_insert_id();
										
										$track_link='<img src="'.base_url().'/newsletter/open/'.$report_id.'" width="1" height="1" />';
										
										$email_message.=$track_link;
										
																	
										
																
 										
										$this->email->from($email_address_from);
										$this->email->reply_to($email_address_reply);
										$this->email->to($newsletter_user_details->email);
										$this->email->subject($email_subject);
										$this->email->message($email_message);
										
										if(file_exists($base_path.'upload/newsletter/'.$attach_file))
										{										
											$this->email->attach($base_path.'upload/newsletter/'.$attach_file);										
										}
										
										if($this->email->send())
										{
											////insert success details=====
										
										//*$make_success=$this->db->query("insert into newsletter_report(`newsletter_user_id`,`job_id`,`is_fail`)values('".$subscribe->newsletter_user_id."','".$job->job_id."','1')");*/
										
											
										}
										else
										{
											////insert fail details=====
										
										$make_fail=$this->db->query("insert into ".$this->db->dbprefix('newsletter_report')."(`newsletter_user_id`,`job_id`,`is_fail`)values('".$subscribe->newsletter_user_id."','".$job->job_id."','1')");
										
										}
										
										$cnt++;
										
									}
									else
									{
										////insert fail details=====
										
										$make_fail=$this->db->query("insert into ".$this->db->dbprefix('newsletter_report')."(`newsletter_user_id`,`job_id`,`is_fail`)values('".$subscribe->newsletter_user_id."','".$job->job_id."','1')");									
																			
									}
																	
								
								}///////////===check user exists			
													
								
															
							}
							
							
							
						$all_send=(int)$job_details->send_total+(int)$cnt;
							
				$update_send_total=$this->db->query("update ".$this->db->dbprefix('newsletter_job')." set send_total='".$all_send."' where job_id='".$job->job_id."'");
						
						
							
							
						}
							
						
											
					}			
					
					 
					 } //////====count check for greater 0
				
				}///////==check newsletter==			
			
			}
			
			////////// save cron job run time
			$data = array(
						'user_id' => 0,
						'cronjob' => 'newsletter_send',
						'date_run' =>date('Y-m-d H:i:s'),
						'status' => '1',
					);
			$this->db->insert('cronjob', $data);

			exit;

		} else {
		
			/////////// save cron job run time
			$data = array(
						'user_id' => 0,
						'cronjob' => 'newsletter_send',
						'date_run' =>date('Y-m-d H:i:s'),
						'status' => '0',
					);
			$this->db->insert('cronjob', $data);

			exit;	
		
		}

	
	///////=======subscribe link base_url().'/subscribe/'.$newsletter_user_email.'/'.$newsletter_id
	
	///////=======unsubscribe link base_url().'/unsubscribe/'.$newsletter_user_email.'/'.$newsletter_id
	
	///======put the tracking code url base_url().'/newsletter/open/'.$report_id (get from last insert id)
	
	}
	
}


?>