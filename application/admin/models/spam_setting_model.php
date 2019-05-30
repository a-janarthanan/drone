<?php

class Spam_setting_model extends CI_Model {
	
    function Spam_setting_model()
    {
        parent::__construct();	
    }   
	
	
	
	function add_spammer()
	{
	
	
		$data=array(
		'spam_ip'=>$this->input->post('spam_ip'),
		'permenant_spam'=>$this->input->post('permenant_spam'),
		'start_date'=>date('Y-m-d'),
		'end_date'=>date('Y-m-d',strtotime("+30 days"))
		);
		/*print_r($data);
		die();*/
		
		$this->db->insert('spam_ip',$data);
	
	
	}
	
	
	function spam_control_update()
	{
		
		$data = array(			
			'spam_report_total' => $this->input->post('spam_report_total'),			
			'spam_report_expire' => $this->input->post('spam_report_expire'),
			'total_register' =>  $this->input->post('total_register'),
			'register_expire' => $this->input->post('register_expire'),
			'total_comment' => $this->input->post('total_comment'),
			'comment_expire' => $this->input->post('comment_expire'),			
			'total_contact' => $this->input->post('total_contact'),
			'contact_expire' => $this->input->post('contact_expire')			
		);
		$this->db->where('spam_control_id',$this->input->post('spam_control_id'));
		$this->db->update('spam_setting',$data);
	}
	
	function get_spam_control()
	{
		$query = $this->db->get_where('spam_setting');
		return $query->row_array();
	}
	
	
	function get_total_spam_report_count()
	{
		$query=$this->db->query("select *, COUNT(*) as total_spam from ".$this->db->dbprefix('spam_report_ip')." group by spam_ip HAVING COUNT(*) >=1 order by spam_report_id desc");
		return $query->num_rows();	
	}
	
	function get_spam_report_result($offset, $limit)
	{
		$query=$this->db->query("select *, COUNT(*) as total_spam from ".$this->db->dbprefix('spam_report_ip')." group by spam_ip HAVING COUNT(*) >=1 order by spam_report_id desc LIMIT ".$limit." OFFSET ".$offset);
		
		if($query->num_rows()>0)
		{
		
			return $query->result();
		}
		
		return 0;
			
	}
	
	function delete_spam_report($ip)
	{
		$query=$this->db->query("delete from spam_report_ip where spam_ip='".$ip."'");	
	}
	
	function make_spam($ip)
	{
		$spam_control=$this->db->query("select * from spam_control");
		$control=$spam_control->row();
				
		$report_expire=date('Y-m-d', strtotime('+'.$control->spam_report_expire.' days'));
		
		
		$insert_spam=$this->db->query("insert into spam_ip(`spam_ip`,`start_date`,`end_date`)values('".$ip."','".date('Y-m-d')."','".$report_expire."')");
												
		$delete_from_report=$this->db->query("delete from spam_report_ip where spam_ip='".$ip."'");		
		
	}
	
	
	
	
	
	function get_total_spamer_count()
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('spam_ip')." group by spam_ip order by spam_id desc");
		return $query->num_rows();	
	}
	
	function get_spamer_result($offset, $limit)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('spam_ip')." group by spam_ip order by spam_id desc LIMIT ".$limit." OFFSET ".$offset);
		
		if($query->num_rows()>0)
		{
		
			return $query->result();
		}
		
		return 0;			
	}
	
	function delete_spam($ip){
		$query=$this->db->query("delete from ".$this->db->dbprefix('spam_report_ip')." where spam_report_id='".$ip."'");
	}
	
	function delete_spamer($ip)
	{
		$query=$this->db->query("delete from ".$this->db->dbprefix('spam_ip')." where spam_ip='".$ip."'");	
	}
	
	
	function make_spam_permenant($ip)
	{
		$query=$this->db->query("update ".$this->db->dbprefix('spam_ip')." set permenant_spam='1' where spam_ip='".$ip."'");
	}
	
	function get_total_search_spam_count($option,$keyword)
	{
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));
		
		$this->db->select('spam_ip.*');
		$this->db->from('spam_ip');
		
		if($option=='ip')
		{
			$this->db->like('spam_ip.spam_ip',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('spam_ip.spam_ip',$val);
				}	
			}

		}
		
		$this->db->order_by("spam_ip.spam_id", "desc"); 
		
		$query = $this->db->get();
		
		return $query->num_rows();
	}
	
	
	
	function get_search_spam_result($option,$keyword,$offset, $limit)
	{
		
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));
		$this->db->select('spam_ip.*');
		$this->db->from('spam_ip');
		
		if($option=='ip')
		{
			$this->db->like('spam_ip.spam_ip',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('spam_ip.spam_ip',$val);
				}	
			}

		}
		
		$this->db->order_by("spam_ip.spam_id", "desc"); 
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			
			return $query->result();
		}
		return 0;
	}
	
	
	function get_total_spam_spamreport_count($option,$keyword)
	{
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));
		
		
		
		$this->db->select('spam_report_ip.*,COUNT(*) as total_spam');
		$this->db->from('spam_report_ip');
		
		if($option=='ip')
		{
			$this->db->like('spam_report_ip.spam_ip',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('spam_report_ip.spam_ip',$val);
				}	
			}

		}
		
		$this->db->group_by ("spam_report_ip.spam_ip", "desc"); 
		$this->db->order_by("spam_report_ip.spam_report_id", "desc"); 
		
		$query = $this->db->get();
		
		return $query->num_rows();
	}
	
	function get_spam_spamreport_result($option,$keyword,$offset, $limit)
	{
		
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));
		
		//$query=$this->db->query("select *, COUNT(*) as total_spam from spam_report_ip group by spam_ip HAVING COUNT(*) >=1 order by spam_report_id desc LIMIT ".$limit." OFFSET ".$offset);
		
		$this->db->select('spam_report_ip.*,COUNT(*) as total_spam');
		$this->db->from('spam_report_ip');
		
		if($option=='ip')
		{
			$this->db->like('spam_report_ip.spam_ip',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('spam_report_ip.spam_ip',$val);
				}	
			}

		}
		
		$this->db->group_by("spam_report_ip.spam_ip", "desc"); 
		$this->db->order_by("spam_report_ip.spam_report_id", "desc"); 
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			
			return $query->result();
		}
		return 0;
	}
	
}
?>