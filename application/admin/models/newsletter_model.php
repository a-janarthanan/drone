<?php
class Newsletter_model extends CI_Model {
	
    function Newsletter_model()
    {
		parent::__construct();
    } 
	
	
	
	
	
	
	function get_total_job_send($job_id)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('newsletter_job')." where job_id='".$job_id."'");
		
		if($query->num_rows()>0)
		{
			$result=$query->row();
			
			if($result->send_total!='' && $result->send_total>0)
			{
				return $result->send_total;
			}
			else
			{			
				return 0;
			} 
		}
	
		return 0;	
	}
	
	
	
	function get_total_job_open($job_id)
	{
		$query=$this->db->query("select count(*) as open_total from ".$this->db->dbprefix('newsletter_report')." where job_id='".$job_id."' and is_open='1'");
		
		if($query->num_rows()>0)
		{
			$result=$query->row();
			
			if($result->open_total!='' && $result->open_total>0)
			{
				return $result->open_total;
			}
			else
			{			
				return 0;
			} 
		}
	
		return 0;	
	}
	
	
	
	function get_total_job_fail($job_id)
	{
		$query=$this->db->query("select count(*) as fail_total from ".$this->db->dbprefix('newsletter_report')." where job_id='".$job_id."' and is_fail='1'");
		
		if($query->num_rows()>0)
		{
			$result=$query->row();
			
			if($result->fail_total!='' && $result->fail_total>0)
			{
				return $result->fail_total;
			}
			else
			{			
				return 0;
			} 
		}
	
		return 0;	
	}
	
	
	function get_total_subscription($nwid)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('newsletter_subscribe')." where newsletter_id='".$nwid."'");
		
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
	
		return 0;
		
	}
	
	
	
	function all_project()
	{
		$query=$this->db->query("select * from project order by project_id desc");
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
	
		return 0;
			
	}
	
	
	
	
	//////////////////==============Newsletter Job Part===============
	
	
	function get_count_newsletter_job()
	{
		$query=$this->db->query("select jb.*,nt.subject from ".$this->db->dbprefix('newsletter_job')." jb left join ".$this->db->dbprefix('newsletter_template')." nt on jb.newsletter_id=nt.newsletter_id order by jb.job_id desc");
		
		return $query->num_rows();	
	}
	
	
	function get_all_newsletter_job($offset,$limit)
	{
		$query=$this->db->query("select jb.*,nt.subject from ".$this->db->dbprefix('newsletter_job')." jb left join ".$this->db->dbprefix('newsletter_template')." nt on jb.newsletter_id=nt.newsletter_id order by jb.job_id desc LIMIT ".$limit." OFFSET ".$offset);
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
	
		return 0;	
	}
	
	
	function get_total_search_job_count($option,$keyword)
	{
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","@","(",")",":",";",">","<","/"),'',$keyword));
		
		$this->db->select('newsletter_job.*,newsletter_template.subject');
		$this->db->from('newsletter_job');
		$this->db->join('newsletter_template', 'newsletter_template.newsletter_id = newsletter_job.newsletter_id','left');
		
		if($option=='subject')
		{
			$this->db->like('newsletter_template.subject',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('newsletter_template.subject',$val);
				}	
			}

			
		}
		$this->db->order_by("newsletter_job.job_id", "desc"); 
		
		$query = $this->db->get();
		
		return $query->num_rows();
	}
	
	function get_search_job_result($option,$keyword,$offset, $limit)
	{
		
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","@","(",")",":",";",">","<","/"),'',$keyword));
		
		$this->db->select('newsletter_job.*,newsletter_template.subject');
		$this->db->from('newsletter_job');
		$this->db->join('newsletter_template', 'newsletter_template.newsletter_id = newsletter_job.newsletter_id','left');
		
		if($option=='subject')
		{
			$this->db->like('newsletter_template.subject',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('newsletter_template.subject',$val);
				}	
			}

			
		}
		$this->db->order_by("newsletter_job.job_id", "desc"); 
		
		$this->db->limit($limit,$offset);
		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	
	
	
	function get_one_job($job_id)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('newsletter_job')." where job_id='".$job_id."'");
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
	
		return 0;	
	}
	
	
	function add_new_job()
	{	
		$data=array(
		'newsletter_id'=>$this->input->post('newsletter_id'),
		'job_start_date'=>date('Y-m-d',strtotime($this->input->post('job_start_date'))),
		'job_date'=>date('Y-m-d'),
		);
		$this->db->insert('newsletter_job',$data);
		
	}
	
	function delete_newsletter_job($id)
	{
	
		$chk_newsletter_report=$this->db->query("select * from ".$this->db->dbprefix('newsletter_report')." where job_id='".$id."'");
		
		if($chk_newsletter_report->num_rows()>0)
		{
			$this->db->query("delete from ".$this->db->dbprefix('newsletter_report')." where job_id='".$id."'");	
		}
		
		$chk_newsletter_job=$this->db->query("select * from ".$this->db->dbprefix('newsletter_job')." where job_id='".$id."'");
		
		if($chk_newsletter_job->num_rows()>0)
		{
			$this->db->query("delete from ".$this->db->dbprefix('newsletter_job')." where job_id='".$id."'");	
		}
		
	
	}
	
	
	//////////////////==============Newsletter Job Part===============
	
	
	/////////////////===========Newsletter Template Part==========
	
		
	function newsletter_insert()
	{

		$attach_file='';
		
		
		if($_FILES['file_up']['name']!='')
		{
		    	
				$this->load->library('upload');
				$rand=rand(0,100000);

				$_FILES['userfile']['name']     =   $_FILES['file_up']['name'];
				$_FILES['userfile']['type']     =   $_FILES['file_up']['type'];
				$_FILES['userfile']['tmp_name'] =   $_FILES['file_up']['tmp_name'];
				$_FILES['userfile']['error']    =   $_FILES['file_up']['error'];
				$_FILES['userfile']['size']     =   $_FILES['file_up']['size']; 
				  
						
		   
				$config['file_name']     = $rand.'newsletter';
				$config['upload_path'] = base_path().'upload/newsletter/';					
				$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp|doc|pdf|mp3|avi|flv|mp4';
					  
			  
			   $this->upload->initialize($config);
			 
			 
					if (!$this->upload->do_upload())
					{							
						 $error =  $this->upload->display_errors();					   
					} 
					
					$picture = $this->upload->data();
					
					$attach_file=$picture['file_name'];
				
   		
		} 			
		
		
			$template_content=$this->input->post('template_content');
				
		
		$data = array(
			'subject' => $this->input->post('subject'),
			'template_content' => $template_content,	
			'attach_file' => $attach_file,
			'allow_subscribe_link' => $this->input->post('allow_subscribe_link'),
			'allow_unsubscribe_link' => $this->input->post('allow_unsubscribe_link'),
			'project_id' => $this->input->post('project_id'),
			'newsletter_create_date' => date('Y-m-d H:i:s'),
					
		);		
		$this->db->insert('newsletter_template',$data);
		
		$newsletter_id=mysql_insert_id();
		
		
		if($this->input->post('subscribe_to')=='all')
		{
			$get_all_user=$this->db->query("select * from ".$this->db->dbprefix('newsletter_user')." order by newsletter_user_id asc");
			
			if($get_all_user->num_rows()>0)
			{
				$user=$get_all_user->result();
				
				foreach($user as $us)
				{
					$make_subscriber=$this->db->query("insert into ".$this->db->dbprefix('newsletter_subscribe')." (`newsletter_user_id`,`newsletter_id`,`subscribe_date`)values('".$us->newsletter_user_id."','".$newsletter_id."','".date('Y-m-d')."')");
								
				}
				
				
			}
			
		}
		else
		{
		
		}
		
			
	
	}
	
	
	
	function newsletter_update()
	{
		
		
		$attach_file='';
		
		if($_FILES['file_up']['name']!='')
		{
		    	
						if(is_file(base_path().'upload/newsletter/'.$this->input->post('prev_attach_file'))) 
						{				
							
								$link1=base_path().'upload/newsletter/'.$this->input->post('prev_attach_file');
								unlink($link1);
							
						
						}
						
						
						
				$this->load->library('upload');
				$rand=rand(0,100000);	
		  
			
				$_FILES['userfile']['name']     =   $_FILES['file_up']['name'];
				$_FILES['userfile']['type']     =   $_FILES['file_up']['type'];
				$_FILES['userfile']['tmp_name'] =   $_FILES['file_up']['tmp_name'];
				$_FILES['userfile']['error']    =   $_FILES['file_up']['error'];
				$_FILES['userfile']['size']     =   $_FILES['file_up']['size']; 
				  
						
		   
				$config['file_name']     = $rand.'newsletter';
				$config['upload_path'] = base_path().'upload/newsletter/';					
				$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp|doc|pdf|mp3|avi|flv|mp4';
					  
			  
			   $this->upload->initialize($config);
			 
			 
					if (!$this->upload->do_upload())
					{							
						  $error =  $this->upload->display_errors();					   
						
					} 
					
					$picture = $this->upload->data();
					
					$attach_file=$picture['file_name'];
				
   		
		} else {
				
					if($this->input->post('prev_attach_file')!='')
					{
						$attach_file=$this->input->post('prev_attach_file');
					}
					
									
		}
			
		
		
			$template_content=$this->input->post('template_content');
		
			
		$data = array(
			'subject' => $this->input->post('subject'),
			'template_content' => $template_content,	
			'attach_file' => $attach_file,
			'allow_subscribe_link' => $this->input->post('allow_subscribe_link'),
			'allow_unsubscribe_link' => $this->input->post('allow_unsubscribe_link'),
			//'project_id' => $this->input->post('project_id'),					
		);	
		
		$this->db->where('newsletter_id',$this->input->post('newsletter_id'));	
		$this->db->update('newsletter_template',$data);
		
		$newsletter_id=$this->input->post('newsletter_id');	
	
	}  
	
	
	
	function get_total_template_count()
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('newsletter_template')." order by newsletter_id desc");
		return $query->num_rows();
	}
	
	function get_template_result($offset, $limit)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('newsletter_template')." order by newsletter_id desc LIMIT ".$limit." OFFSET ".$offset);
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
	
		return 0;
	
	}
	
	
	
	
	
	function get_total_search_template_count($option,$keyword)
	{
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","@","(",")",":",";",">","<","/"),'',$keyword));
		
		$this->db->select('newsletter_template.*');
		$this->db->from('newsletter_template');
		
				
		if($option=='subject')
		{
			$this->db->like('newsletter_template.subject',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('newsletter_template.subject',$val);
				}	
			}
	
		}
		
		$this->db->order_by("newsletter_template.newsletter_id", "desc"); 
		
		
		$query = $this->db->get();
		
		return $query->num_rows();
	}
	function get_search_template_result($option,$keyword,$offset, $limit)
	{
		
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","@","(",")",":",";",">","<","/"),'',$keyword));
		$this->db->select('newsletter_template.*');
		$this->db->from('newsletter_template');

		
				
		if($option=='subject')
		{
			$this->db->like('newsletter_template.subject',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('newsletter_template.subject',$val);
				}	
			}
	
		}
		
		$this->db->order_by("newsletter_template.newsletter_id", "desc"); 
		
		$this->db->limit($limit,$offset);
		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	
	
	function get_all_newsletter_templates()
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('newsletter_template')." order by subject asc");
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
	
		return 0;
	}
	
	function get_one_newsletter($id)
	{	
		$query = $this->db->get_where('newsletter_template',array('newsletter_id'=>$id));
		return $query->row();
	}	
	
	
	
	function delete_newsletter($newsletter_id)
	{
		$chk_subscription=$this->db->query("select * from ".$this->db->dbprefix('newsletter_subscribe')." where newsletter_id='".$newsletter_id."'");
		
		if($chk_subscription->num_rows()>0)
		{
			$delete_from_subscription=$this->db->query("delete from ".$this->db->dbprefix('newsletter_subscribe')." where newsletter_id='".$newsletter_id."'");		
		}
		
		
		$chk_job=$this->db->query("select * from ".$this->db->dbprefix('newsletter_job')." where newsletter_id='".$newsletter_id."'");
		
		if($chk_job->num_rows()>0)
		{
			$delete_from_job=$this->db->query("delete from ".$this->db->dbprefix('newsletter_job')." where newsletter_id='".$newsletter_id."'");		
		}
		
		
		
				
			
		$chk_newsletter=$this->db->query("select * from ".$this->db->dbprefix('newsletter_template')." where newsletter_id='".$newsletter_id."'");
		
		if($chk_newsletter->num_rows()>0)
		{
			$delete_from_newsletter=$this->db->query("delete from ".$this->db->dbprefix('newsletter_template')." where newsletter_id='".$newsletter_id."'");		
		}
		
		
	
	}
	
	
	
	
	//////////////////===============subscriber part====================
	
	
	function get_total_newsletter_user_count($nwid)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('newsletter_subscribe')." ns left join ".$this->db->dbprefix('newsletter_user')." nu on ns.newsletter_user_id=nu.newsletter_user_id where ns.newsletter_id='".$nwid."' order by ns.subscribe_id desc");
		
		return $query->num_rows();
				
	}
	
	
	function get_newsletter_user_result($nwid,$offset, $limit)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('newsletter_subscribe')." ns left join ".$this->db->dbprefix('newsletter_user')." nu on ns.newsletter_user_id=nu.newsletter_user_id where ns.newsletter_id='".$nwid."' order by ns.subscribe_id desc LIMIT ".$limit." OFFSET ".$offset);
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
	
		return 0;
				
	}
	
	
	
	function get_total_search_newsletter_user_count($nwid,$option,$keyword)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('newsletter_subscribe')." ns left join ".$this->db->dbprefix('newsletter_user')." nu on ns.newsletter_user_id=nu.newsletter_user_id where ns.newsletter_id='".$nwid."' and nu.".$option." LIKE '%".$keyword."%' order by ns.subscribe_id desc");
		
		return $query->num_rows();
				
	}
	
	
	function get_search_newsletter_user_result($nwid,$option,$keyword,$offset, $limit)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('newsletter_subscribe')." ns left join ".$this->db->dbprefix('newsletter_user')." nu on ns.newsletter_user_id=nu.newsletter_user_id where ns.newsletter_id='".$nwid."' and nu.".$option." LIKE '%".$keyword."%' order by ns.subscribe_id desc LIMIT ".$limit." OFFSET ".$offset);
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
	
		return 0;
				
	}
	
	
	
	function delete_user_subscription($id,$newsletter_id)
	{
					
		$chk_subscription=$this->db->query("select * from ".$this->db->dbprefix('newsletter_subscribe')." where newsletter_user_id='".$id."' and newsletter_id='".$newsletter_id."'");
		
		if($chk_subscription->num_rows()>0)
		{
			$delete_from_subscription=$this->db->query("delete from ".$this->db->dbprefix('newsletter_subscribe')." where newsletter_user_id='".$id."' and newsletter_id='".$newsletter_id."'");		
		}
	
	}
	
	//////////////////===============subscriber part====================
	

	////////////////////=============Newsletter User=================
	
	function get_total_user_count()
	{

		$this->db->select('newsletter_user.*');
		$this->db->from('newsletter_user');
		$this->db->order_by("newsletter_user.newsletter_user_id", "desc"); 
		$query = $this->db->get();
		
		return $query->num_rows();
	}
	
	function get_user_result($offset, $limit)
	{
		
		$this->db->select('newsletter_user.*');
		$this->db->from('newsletter_user');
		$this->db->order_by("newsletter_user.newsletter_user_id", "desc"); 
		
	
		$this->db->limit($limit,$offset);
		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
		
	
	}
	
	function get_total_search_user_count($option,$keyword)
	{

		$this->db->select('newsletter_user.*');
		$this->db->from('newsletter_user');
		if($option=='user_name')
		{
			$this->db->like('newsletter_user.user_name',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->or_like('newsletter_user.user_name',$val);
				}	
			}

			
		}
		if($option=='email')
		{
			$this->db->like('newsletter_user.email',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->or_like('newsletter_user.email',$val);
				}	
			}

			
		}
		$this->db->order_by("newsletter_user.newsletter_user_id", "desc"); 
		
		$query = $this->db->get();
		
		return $query->num_rows();
	}
	
	function get_search_user_result($option,$keyword,$offset, $limit)
	{
		
		
		$this->db->select('newsletter_user.*');
		$this->db->from('newsletter_user');
		if($option=='user_name')
		{
			$this->db->like('newsletter_user.user_name',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->or_like('newsletter_user.user_name',$val);
				}	
			}

			
		}
		if($option=='email')
		{
			$this->db->like('newsletter_user.email',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->or_like('newsletter_user.email',$val);
				}	
			}

			
		}
		$this->db->order_by("newsletter_user.newsletter_user_id", "desc"); 
		
	
		$this->db->limit($limit,$offset);
		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	
	function user_unique($str)
	{
		if($this->input->post('newsletter_user_id'))
		{
			$query = $this->db->query("select email from ".$this->db->dbprefix('newsletter_user')." where email = '$str' and newsletter_user_id!='".$this->input->post('newsletter_user_id')."'");
		}else{
			$query = $this->db->query("select email from ".$this->db->dbprefix('newsletter_user')." where email = '$str'");
		}
		if($query->num_rows()>0){
			return FALSE;
		}else{
			return TRUE;
		}
	}
	
	
	
	function user_insert()
	{
	 
		$data = array(
			'email' => $this->input->post('email'),
			'user_name' => $this->input->post('user_name'),	
			'user_date' => date('Y-m-d H:i:s'),
			'user_ip' => $_SERVER['REMOTE_ADDR'],			
		);		
		$this->db->insert('newsletter_user',$data);
		$newsletter_user_id=mysql_insert_id();
		
		
		/////////////============subscribe newsletter========
		
		
		$newsletter_id=$this->input->post('newsletter_id');
		
		if($newsletter_id)
		{
			foreach($newsletter_id as $news)
			{
				$make_subscriber=$this->db->query("insert into ".$this->db->dbprefix('newsletter_subscribe')." (`newsletter_user_id`,`newsletter_id`,`subscribe_date`)values('".$newsletter_user_id."','".$news."','".date('Y-m-d')."')");
			
			}
		
		}
		
		
	}
	
	function user_update()
	{
		$data = array(			
			'email' => $this->input->post('email'),
			'user_name' => $this->input->post('user_name'),					
		);
		$this->db->where('newsletter_user_id',$this->input->post('newsletter_user_id'));
		$this->db->update('newsletter_user',$data);
		
		
		
		
		
		$newsletter_user_id=$this->input->post('newsletter_user_id');
		
		
		/////////////============subscribe newsletter========
		
		$sub_arr=array();
		$chk_subscribe=$this->db->query("select * from ".$this->db->dbprefix('newsletter_subscribe')." where newsletter_user_id='".$newsletter_user_id."'");
				
			if($chk_subscribe->num_rows()>0)
			{
				$subscribe=$chk_subscribe->result();
				
				foreach($subscribe as $sub)
				{
					$sub_arr[]=$sub->newsletter_id;
				}
			}
			
		
		$newsletter_id=$this->input->post('newsletter_id');
		
		if($newsletter_id)
		{
			$arr_diff=array_diff($sub_arr,$newsletter_id);
		}
		else
		{
			$arr_diff=$sub_arr;
		}
		
		
		///////////============insert new subscription============
						
		if($newsletter_id)
		{
			foreach($newsletter_id as $news)
			{						
				
				if(!in_array($news,$sub_arr)) {
						
				$make_subscriber=$this->db->query("insert into ".$this->db->dbprefix('newsletter_subscribe')." (`newsletter_user_id`,`newsletter_id`,`subscribe_date`)values('".$newsletter_user_id."','".$news."','".date('Y-m-d')."')");
				
				}
				
			
			}
		
		}
		
		///////////////=======delete other subscribe============
		
		
		if($arr_diff)
		{			
			foreach($arr_diff as $delsub)
			{
				$delete_subscribe=$this->db->query("delete from ".$this->db->dbprefix('newsletter_subscribe')." where newsletter_user_id='".$newsletter_user_id."' and newsletter_id='".$delsub."'");
			}								
		}
		
		
		
	}
	
	function get_one_user($id)
	{
		$query = $this->db->get_where('newsletter_user',array('newsletter_user_id'=>$id));
		return $query->row_array();
	}	
	
	
	
	function get_all_subscription($uid)
	{
		$temp=array();
		
		$query=$this->db->query("select * from ".$this->db->dbprefix('newsletter_subscribe')." where newsletter_user_id='".$uid."'");
		
		if($query->num_rows()>0)
		{
			$subscription=$query->result();
			
			foreach($subscription as $sub)
			{
				$temp[]=$sub->newsletter_id;
			}
		}
		
		return $temp;
	}
	
	
	
	function delete_newsletter_user($id)
	{
		
		$chk_report=$this->db->query("select * from ".$this->db->dbprefix('newsletter_report')." where newsletter_user_id='".$id."'");
		
		if($chk_report->num_rows()>0)
		{
			$delete_from_report=$this->db->query("delete from ".$this->db->dbprefix('newsletter_report')." where newsletter_user_id='".$id."'");		
		}
		
		
		
		$chk_subscription=$this->db->query("select * from ".$this->db->dbprefix('newsletter_subscribe')." where newsletter_user_id='".$id."'");
		
		if($chk_subscription->num_rows()>0)
		{
			$delete_from_subscription=$this->db->query("delete from ".$this->db->dbprefix('newsletter_subscribe')." where newsletter_user_id='".$id."'");		
		}
			
		
		
		$chk_user=$this->db->query("select * from ".$this->db->dbprefix('newsletter_user')." where newsletter_user_id='".$id."'");
		
		if($chk_user->num_rows()>0)
		{
			$delete_user=$this->db->query("delete from ".$this->db->dbprefix('newsletter_user')." where newsletter_user_id='".$id."'");		
		}
		
		
		
	
	}
	
	
	
	///////////////////=============setting part========================
	
	function get_newsletter_setting()
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('newsletter_setting')."");
		
		return $query->row();
	}
	
	
	function newsletter_setting_update()
	{
		
		$data=array(
			'newsletter_from_name' => $this->input->post('newsletter_from_name'),	
			'newsletter_from_address' => $this->input->post('newsletter_from_address'),						
			'newsletter_reply_name' => $this->input->post('newsletter_reply_name'),
			'newsletter_reply_address' => $this->input->post('newsletter_reply_address'),			
			'new_subscribe_email' => $this->input->post('new_subscribe_email'),
			'unsubscribe_email' => $this->input->post('unsubscribe_email'),			
			'new_subscribe_to' => $this->input->post('new_subscribe_to'),
			'selected_newsletter_id' => $this->input->post('selected_newsletter_id'),			
			'number_of_email_send' => $this->input->post('number_of_email_send'),		
			'break_between_email' => $this->input->post('break_between_email'),
			'break_type' => $this->input->post('break_type'),							
			'mailer' => $this->input->post('mailer'),
			'sendmail_path' => $this->input->post('sendmail_path'),
			'smtp_port' => $this->input->post('smtp_port'),
			'smtp_host' => $this->input->post('smtp_host'),
			'smtp_email' => $this->input->post('smtp_email'),
			'smtp_password' => $this->input->post('smtp_password'),
		
		);
		
		$this->db->where('newsletter_setting_id',$this->input->post('newsletter_setting_id'));
		$this->db->update('newsletter_setting',$data);
	
	}
	
	
	
}

?>