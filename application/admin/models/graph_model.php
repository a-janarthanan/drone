<?php

class Graph_model extends CI_Model {
	
    function Graph_model()
    {
        parent::__construct();	
    }   
	
	
	
	
	
	
	//----------------------task report------------------
	
	
	
	
	
	
	
	function get_yearly_new_task($first_date,$last_date)
	{
		
		$week_task_arr=array();
		
		$temp=array();
		
		
		$this->db->select('COUNT(*) as total, YEAR(task_post_date) as task_post_date');
		$this->db->from('task');
		$this->db->where('task_status',1);
		$this->db->where('YEAR(task_post_date) >=',$first_date);
		$this->db->where('YEAR(task_post_date) <=',$last_date);
		$this->db->group_by('YEAR(task_post_date)');
		
		$query=$this->db->get();
		
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_task_arr[$wtr->task_post_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
			for($i=$first_date;$i<=$last_date;$i++)
			{	
				
				if(array_key_exists($i,$week_task_arr))
				{
					$temp[$i]=$week_task_arr[$i];
				}
				
				else
				{
					$temp[$i]=0;
				}
								
			}
			
		
		
		return $temp;
		
		
		
		
	}
	
	function get_yearly_open_task($first_date,$last_date)
	{
		
		$week_task_arr=array();
		
		$temp=array();
		
		
		
		$this->db->select('COUNT(*) as total, YEAR(task_assigned_date) as task_assigned_date');
		$this->db->from('task');
		$this->db->where('task_status',1);
		$this->db->where('YEAR(task_assigned_date) >=',$first_date);
		$this->db->where('YEAR(task_assigned_date) <=',$last_date);
		$this->db->group_by('YEAR(task_assigned_date)');
		
		$query=$this->db->get();
		
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_task_arr[$wtr->task_assigned_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
			for($i=$first_date;$i<=$last_date;$i++)
			{	
				
				if(array_key_exists($i,$week_task_arr))
				{
					$temp[$i]=$week_task_arr[$i];
				}
				
				else
				{
					$temp[$i]=0;
				}
								
			}
			
		
		
		
		return $temp;
		
		
		
		
	}
	
	
	function get_yearly_close_task($first_date,$last_date)
	{
		
		$week_task_arr=array();
		
		$temp=array();
		
	
		
		$this->db->select('COUNT(*) as total, YEAR(task_complete_date) as task_complete_date');
		$this->db->from('task');
		$this->db->where('task_status',1);
		$this->db->where('YEAR(task_complete_date) >=',$first_date);
		$this->db->where('YEAR(task_complete_date) <=',$last_date);
		$this->db->group_by('YEAR(task_complete_date)');
		
		$query=$this->db->get();
		
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_task_arr[$wtr->task_complete_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
			for($i=$first_date;$i<=$last_date;$i++)
			{	
				
				if(array_key_exists($i,$week_task_arr))
				{
					$temp[$i]=$week_task_arr[$i];
				}
				
				else
				{
					$temp[$i]=0;
				}
								
			}
			
		
		
		
		return $temp;
		
		
		
		
	}
	
	
	function get_yearly_cancel_task($first_date,$last_date)
	{
		
		$week_task_arr=array();
		
		$temp=array();
		
		
		$this->db->select('COUNT(*) as total, YEAR(task_close_date) as task_close_date');
		$this->db->from('task');
		$this->db->where('task_status',1);
		$this->db->where('task_assigned_date','0000-00-00 00:00:00');
		$this->db->where('task_complete_date','0000-00-00 00:00:00');
		$this->db->where('task_close_date !=','0000-00-00 00:00:00');
		$this->db->where('YEAR(task_close_date) >=',$first_date);
		$this->db->where('YEAR(task_close_date) <=',$last_date);
		$this->db->group_by('YEAR(task_close_date)');
		
		$query=$this->db->get();
		
	
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_task_arr[$wtr->task_close_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
	
			for($i=$first_date;$i<=$last_date;$i++)
			{	
				
				if(array_key_exists($i,$week_task_arr))
				{
					$temp[$i]=$week_task_arr[$i];
				}
				
				else
				{
					$temp[$i]=0;
				}
								
			}
			
		
		
		return $temp;
		
		
		
		
	}
	
	
	
	
	
	
	
	function get_monthly_new_task($first_date,$last_date)
	{
		
		$week_task_arr=array();
		
		$temp=array();
		
		$month_year=date('Y');
		
		$this->db->select('COUNT(*) as total, MONTH(task_post_date) as task_post_date');
		$this->db->from('task');
		$this->db->where('task_status',1);
		$this->db->where('YEAR(task_post_date)',$month_year);
		$this->db->where('MONTH(task_post_date) >=',$first_date);
		$this->db->where('MONTH(task_post_date) <=',$last_date);
		$this->db->group_by('MONTH(task_post_date)');
		
		$query=$this->db->get();
		
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_task_arr[$wtr->task_post_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
			for($i=1;$i<=12;$i++)
			{	
				
				if(array_key_exists($i,$week_task_arr))
				{
					$temp[$i]=$week_task_arr[$i];
				}
				
				else
				{
					$temp[$i]=0;
				}
								
			}
			
		
		
		return $temp;
		
		
		
		
	}
	
	function get_monthly_open_task($first_date,$last_date)
	{
		
		$week_task_arr=array();
		
		$temp=array();
		
		$month_year=date('Y');
		
		$this->db->select('COUNT(*) as total, MONTH(task_assigned_date) as task_assigned_date');
		$this->db->from('task');
		$this->db->where('task_status',1);
		$this->db->where('MONTH(task_assigned_date) >=',$first_date);
		$this->db->where('MONTH(task_assigned_date) <=',$last_date);
		$this->db->where('YEAR(task_assigned_date)',$month_year);
		$this->db->group_by('MONTH(task_assigned_date)');
		
		$query=$this->db->get();
		
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_task_arr[$wtr->task_assigned_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
		for($i=1;$i<=12;$i++)
			{	
				
				if(array_key_exists($i,$week_task_arr))
				{
					$temp[$i]=$week_task_arr[$i];
				}
				
				else
				{
					$temp[$i]=0;
				}
								
			}
			
		
		
		return $temp;
		
		
		
		
	}
	
	
	function get_monthly_close_task($first_date,$last_date)
	{
		
		$week_task_arr=array();
		
		$temp=array();
		
		$month_year=date('Y');
		
		$this->db->select('COUNT(*) as total, MONTH(task_complete_date) as task_complete_date');
		$this->db->from('task');
		$this->db->where('task_status',1);
		$this->db->where('MONTH(task_complete_date) >=',$first_date);
		$this->db->where('MONTH(task_complete_date) <=',$last_date);
		$this->db->where('YEAR(task_complete_date)',$month_year);
		$this->db->group_by('MONTH(task_complete_date)');
		
		$query=$this->db->get();
		
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_task_arr[$wtr->task_complete_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
		for($i=1;$i<=12;$i++)
			{	
				
				if(array_key_exists($i,$week_task_arr))
				{
					$temp[$i]=$week_task_arr[$i];
				}
				
				else
				{
					$temp[$i]=0;
				}
								
			}
			
		
		
		return $temp;
		
		
		
		
	}
	
	
	function get_monthly_cancel_task($first_date,$last_date)
	{
		
		$week_task_arr=array();
		
		$temp=array();
		
		$month_year=date('Y');
		
		$this->db->select('COUNT(*) as total, MONTH(task_close_date) as task_close_date');
		$this->db->from('task');
		$this->db->where('task_status',1);
		$this->db->where('task_assigned_date','0000-00-00 00:00:00');
		$this->db->where('task_complete_date','0000-00-00 00:00:00');
		$this->db->where('task_close_date !=','0000-00-00 00:00:00');
		$this->db->where('MONTH(task_close_date) >=',$first_date);
		$this->db->where('MONTH(task_close_date) <=',$last_date);
		$this->db->where('YEAR(task_close_date)',$month_year);
		$this->db->group_by('MONTH(task_close_date)');
		
		$query=$this->db->get();
		
	
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_task_arr[$wtr->task_close_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
		for($i=1;$i<=12;$i++)
			{	
				
				if(array_key_exists($i,$week_task_arr))
				{
					$temp[$i]=$week_task_arr[$i];
				}
				
				else
				{
					$temp[$i]=0;
				}
								
			}
			
		
		
		return $temp;
		
		
		
		
	}
	
	
	
	
	
	
	
	
	function get_weekly_new_task($first_date,$last_date)
	{
		
		$week_task_arr=array();
		
		$temp=array();
		
		$this->db->select('COUNT(*) as total, DATE(task_post_date) as task_post_date');
		$this->db->from('task');
		$this->db->where('task_status',1);
		$this->db->where('DATE(task_post_date) >=',$first_date);
		$this->db->where('DATE(task_post_date) <=',$last_date);
		$this->db->group_by('DATE(task_post_date)');
		
		$query=$this->db->get();
		
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_task_arr[$wtr->task_post_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
		while (strtotime($first_date) <= strtotime($last_date)) 
			{
				
				if(array_key_exists($first_date,$week_task_arr))
				{
					$temp[$first_date]=$week_task_arr[$first_date];
				}
				
				else
				{
					$temp[$first_date]=0;
				}
				
				
				
				$first_date = date ("Y-m-d", strtotime("+1 day", strtotime($first_date)));
				
			}
			
		
		
		return $temp;
		
		
		
		
	}
	
	function get_weekly_open_task($first_date,$last_date)
	{
		
		$week_task_arr=array();
		
		$temp=array();
		
		$this->db->select('COUNT(*) as total, DATE(task_assigned_date) as task_assigned_date');
		$this->db->from('task');
		$this->db->where('task_status',1);
		$this->db->where('DATE(task_assigned_date) >=',$first_date);
		$this->db->where('DATE(task_assigned_date) <=',$last_date);
		$this->db->group_by('DATE(task_assigned_date)');
		
		$query=$this->db->get();
		
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_task_arr[$wtr->task_assigned_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
		while (strtotime($first_date) <= strtotime($last_date)) 
			{
				
				if(array_key_exists($first_date,$week_task_arr))
				{
					$temp[$first_date]=$week_task_arr[$first_date];
				}
				
				else
				{
					$temp[$first_date]=0;
				}
				
				
				
				$first_date = date ("Y-m-d", strtotime("+1 day", strtotime($first_date)));
				
			}
			
		
		
		return $temp;
		
		
		
		
	}
	
	
	function get_weekly_close_task($first_date,$last_date)
	{
		
		$week_task_arr=array();
		
		$temp=array();
		
		$this->db->select('COUNT(*) as total, DATE(task_complete_date) as task_complete_date');
		$this->db->from('task');
		$this->db->where('task_status',1);
		$this->db->where('DATE(task_complete_date) >=',$first_date);
		$this->db->where('DATE(task_complete_date) <=',$last_date);
		$this->db->group_by('DATE(task_complete_date)');
		
		$query=$this->db->get();
		
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_task_arr[$wtr->task_complete_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
		while (strtotime($first_date) <= strtotime($last_date)) 
			{
				
				if(array_key_exists($first_date,$week_task_arr))
				{
					$temp[$first_date]=$week_task_arr[$first_date];
				}
				
				else
				{
					$temp[$first_date]=0;
				}
				
				
				
				$first_date = date ("Y-m-d", strtotime("+1 day", strtotime($first_date)));
				
			}
			
		
		
		return $temp;
		
		
		
		
	}
	
	
	function get_weekly_cancel_task($first_date,$last_date)
	{
		
		$week_task_arr=array();
		
		$temp=array();
		
		$this->db->select('COUNT(*) as total, DATE(task_close_date) as task_close_date');
		$this->db->from('task');
		$this->db->where('task_status',1);
		$this->db->where('task_assigned_date','0000-00-00 00:00:00');
		$this->db->where('task_complete_date','0000-00-00 00:00:00');
		$this->db->where('task_close_date !=','0000-00-00 00:00:00');
		$this->db->where('DATE(task_close_date) >=',$first_date);
		$this->db->where('DATE(task_close_date) <=',$last_date);
		$this->db->group_by('DATE(task_close_date)');
		
		$query=$this->db->get();
		
	
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_task_arr[$wtr->task_close_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
		while (strtotime($first_date) <= strtotime($last_date)) 
			{
				
				if(array_key_exists($first_date,$week_task_arr))
				{
					$temp[$first_date]=$week_task_arr[$first_date];
				}
				
				else
				{
					$temp[$first_date]=0;
				}
				
				
				
				$first_date = date ("Y-m-d", strtotime("+1 day", strtotime($first_date)));
				
			}
			
		
		
		return $temp;
		
		
		
		
	}
	
	
	
	
	
	
	
	
	
	//----------------------registration report------------------
	
	
	
	
	
	
	function get_yearly_registration($first_date,$last_date)
	{
		
		$week_reg_arr=array();
		
		$temp=array();
		
	
		
		$this->db->select('COUNT(*) as total, YEAR(sign_up_date) as sign_up_date');
		$this->db->from('user');
		$this->db->where('YEAR(sign_up_date) >=',$first_date);
		$this->db->where('YEAR(sign_up_date) <=',$last_date);
		$this->db->group_by('YEAR(sign_up_date)');
		
		$query=$this->db->get();
		
		
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_reg_arr[$wtr->sign_up_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
		
			for($i=$first_date;$i<=$last_date;$i++)
			{	
				
				if(array_key_exists($i,$week_reg_arr))
				{
					$temp[$i]=$week_reg_arr[$i];
				}
				
				else
				{
					$temp[$i]=0;
				}
				
			}
			
		
		
		return $temp;
		
		
		
		
	}
	
	function get_yearly_fb_registration($first_date,$last_date)
	{
		
		$week_reg_arr=array();
		
		$temp=array();
		
		
		
		$this->db->select('COUNT(*) as total, YEAR(sign_up_date) as sign_up_date');
		$this->db->from('user');
		$this->db->where('YEAR(sign_up_date) >=',$first_date);
		$this->db->where('YEAR(sign_up_date) <=',$last_date);
		$this->db->where('fb_id !=','');
		$this->db->where('fb_id !=',0);		
		$this->db->group_by('YEAR(sign_up_date)');
		
		$query=$this->db->get();
		
		
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_reg_arr[$wtr->sign_up_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
		
		for($i=$first_date;$i<=$last_date;$i++)
			{	
				
				if(array_key_exists($i,$week_reg_arr))
				{
					$temp[$i]=$week_reg_arr[$i];
				}
				
				else
				{
					$temp[$i]=0;
				}
				
			}
		
		
		return $temp;
		
		
		
		
	}
	
	
	function get_yearly_tw_registration($first_date,$last_date)
	{
		
		$week_reg_arr=array();
		
		$temp=array();
		
		
		$this->db->select('COUNT(*) as total, YEAR(sign_up_date) as sign_up_date');
		$this->db->from('user');
		$this->db->where('YEAR(sign_up_date) >=',$first_date);
		$this->db->where('YEAR(sign_up_date) <=',$last_date);
		$this->db->where('tw_id !=','');
		$this->db->where('tw_id !=',0);		
		$this->db->group_by('YEAR(sign_up_date)');
		
		$query=$this->db->get();
		
		
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_reg_arr[$wtr->sign_up_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
		
		for($i=$first_date;$i<=$last_date;$i++)
			{	
				
				if(array_key_exists($i,$week_reg_arr))
				{
					$temp[$i]=$week_reg_arr[$i];
				}
				
				else
				{
					$temp[$i]=0;
				}
				
			}
			
		
		
		return $temp;
		
		
		
		
	}
	
	
	function get_yearly_runner_registration($first_date,$last_date)
	{
		
		$week_reg_arr=array();
		
		$temp=array();
		
				
		$this->db->select('COUNT(*) as total, YEAR(worker_date) as worker_date');
		$this->db->from('worker');
		$this->db->where('YEAR(worker_date) >=',$first_date);
		$this->db->where('YEAR(worker_date) <=',$last_date);
		$this->db->group_by('YEAR(worker_date)');
		
		$query=$this->db->get();
		
		
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_reg_arr[$wtr->worker_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
		
		for($i=$first_date;$i<=$last_date;$i++)
			{	
				
				if(array_key_exists($i,$week_reg_arr))
				{
					$temp[$i]=$week_reg_arr[$i];
				}
				
				else
				{
					$temp[$i]=0;
				}
				
			}
			
		
		
		return $temp;
		
		
		
		
	}
	
	
	
	
	
	
	
	function get_monthly_registration($first_date,$last_date)
	{
		
		$week_reg_arr=array();
		
		$temp=array();
		
		$month_year=date('Y');
		
		$this->db->select('COUNT(*) as total, MONTH(sign_up_date) as sign_up_date');
		$this->db->from('user');
		$this->db->where('MONTH(sign_up_date) >=',$first_date);
		$this->db->where('MONTH(sign_up_date) <=',$last_date);
		$this->db->where('YEAR(sign_up_date) ',$month_year);
		$this->db->group_by('MONTH(sign_up_date)');
		
		$query=$this->db->get();
		
		
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_reg_arr[$wtr->sign_up_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
		
			for($i=1;$i<=12;$i++)
			{	
				
				if(array_key_exists($i,$week_reg_arr))
				{
					$temp[$i]=$week_reg_arr[$i];
				}
				
				else
				{
					$temp[$i]=0;
				}
				
			}
			
		
		
		return $temp;
		
		
		
		
	}
	
	function get_monthly_fb_registration($first_date,$last_date)
	{
		
		$week_reg_arr=array();
		
		$temp=array();
		
		$month_year=date('Y');
		
		$this->db->select('COUNT(*) as total, MONTH(sign_up_date) as sign_up_date');
		$this->db->from('user');
		$this->db->where('MONTH(sign_up_date) >=',$first_date);
		$this->db->where('MONTH(sign_up_date) <=',$last_date);
		$this->db->where('fb_id !=','');
		$this->db->where('fb_id !=',0);		
		$this->db->where('YEAR(sign_up_date) ',$month_year);
		$this->db->group_by('MONTH(sign_up_date)');
		
		$query=$this->db->get();
		
		
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_reg_arr[$wtr->sign_up_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
		
		for($i=1;$i<=12;$i++)
			{	
				
				if(array_key_exists($i,$week_reg_arr))
				{
					$temp[$i]=$week_reg_arr[$i];
				}
				
				else
				{
					$temp[$i]=0;
				}
				
			}
		
		
		return $temp;
		
		
		
		
	}
	
	
	function get_monthly_tw_registration($first_date,$last_date)
	{
		
		$week_reg_arr=array();
		
		$temp=array();
		
		$month_year=date('Y');
		
		$this->db->select('COUNT(*) as total, MONTH(sign_up_date) as sign_up_date');
		$this->db->from('user');
		$this->db->where('MONTH(sign_up_date) >=',$first_date);
		$this->db->where('MONTH(sign_up_date) <=',$last_date);
		$this->db->where('tw_id !=','');
		$this->db->where('tw_id !=',0);		
		$this->db->where('YEAR(sign_up_date) ',$month_year);
		$this->db->group_by('MONTH(sign_up_date)');
		
		$query=$this->db->get();
		
		
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_reg_arr[$wtr->sign_up_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
		
		for($i=1;$i<=12;$i++)
			{	
				
				if(array_key_exists($i,$week_reg_arr))
				{
					$temp[$i]=$week_reg_arr[$i];
				}
				
				else
				{
					$temp[$i]=0;
				}
				
			}
			
		
		
		return $temp;
		
		
		
		
	}
	
	
	function get_monthly_runner_registration($first_date,$last_date)
	{
		
		$week_reg_arr=array();
		
		$temp=array();
		
		$month_year=date('Y');
				
		$this->db->select('COUNT(*) as total, MONTH(worker_date) as worker_date');
		$this->db->from('worker');
		$this->db->where('MONTH(worker_date) >=',$first_date);
		$this->db->where('MONTH(worker_date) <=',$last_date);
		$this->db->where('YEAR(worker_date) ',$month_year);
		$this->db->group_by('MONTH(worker_date)');
		
		$query=$this->db->get();
		
		
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_reg_arr[$wtr->worker_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
		
		for($i=1;$i<=12;$i++)
			{	
				
				if(array_key_exists($i,$week_reg_arr))
				{
					$temp[$i]=$week_reg_arr[$i];
				}
				
				else
				{
					$temp[$i]=0;
				}
				
			}
			
		
		
		return $temp;
		
		
		
		
	}
	
	
	
	
	
	
	
	
	function get_weekly_registration($first_date,$last_date)
	{
		
		$week_reg_arr=array();
		
		$temp=array();
		
		$this->db->select('COUNT(*) as total, DATE(sign_up_date) as sign_up_date');
		$this->db->from('user');
		$this->db->where('DATE(sign_up_date) >=',$first_date);
		$this->db->where('DATE(sign_up_date) <=',$last_date);
		$this->db->group_by('DATE(sign_up_date)');
		
		$query=$this->db->get();
		
		
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_reg_arr[$wtr->sign_up_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
		
		while (strtotime($first_date) <= strtotime($last_date)) 
			{
				
				if(array_key_exists($first_date,$week_reg_arr))
				{
					$temp[$first_date]=$week_reg_arr[$first_date];
				}
				
				else
				{
					$temp[$first_date]=0;
				}
				
				
				
				$first_date = date ("Y-m-d", strtotime("+1 day", strtotime($first_date)));
				
			}
			
		
		
		return $temp;
		
		
		
		
	}
	
	function get_weekly_fb_registration($first_date,$last_date)
	{
		
		$week_reg_arr=array();
		
		$temp=array();
		
		$this->db->select('COUNT(*) as total, DATE(sign_up_date) as sign_up_date');
		$this->db->from('user');
		$this->db->where('DATE(sign_up_date) >=',$first_date);
		$this->db->where('DATE(sign_up_date) <=',$last_date);
		$this->db->where('fb_id !=','');
		$this->db->where('fb_id !=',0);		
		$this->db->group_by('DATE(sign_up_date)');
		
		$query=$this->db->get();
		
		
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_reg_arr[$wtr->sign_up_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
		
		while (strtotime($first_date) <= strtotime($last_date)) 
			{
				
				if(array_key_exists($first_date,$week_reg_arr))
				{
					$temp[$first_date]=$week_reg_arr[$first_date];
				}
				
				else
				{
					$temp[$first_date]=0;
				}
				
				
				
				$first_date = date ("Y-m-d", strtotime("+1 day", strtotime($first_date)));
				
			}
			
		
		
		return $temp;
		
		
		
		
	}
	
	
	function get_weekly_tw_registration($first_date,$last_date)
	{
		
		$week_reg_arr=array();
		
		$temp=array();
		
		$this->db->select('COUNT(*) as total, DATE(sign_up_date) as sign_up_date');
		$this->db->from('user');
		$this->db->where('DATE(sign_up_date) >=',$first_date);
		$this->db->where('DATE(sign_up_date) <=',$last_date);
		$this->db->where('tw_id !=','');
		$this->db->where('tw_id !=',0);		
		$this->db->group_by('DATE(sign_up_date)');
		
		$query=$this->db->get();
		
		
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_reg_arr[$wtr->sign_up_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
		
		while (strtotime($first_date) <= strtotime($last_date)) 
			{
				
				if(array_key_exists($first_date,$week_reg_arr))
				{
					$temp[$first_date]=$week_reg_arr[$first_date];
				}
				
				else
				{
					$temp[$first_date]=0;
				}
				
				
				
				$first_date = date ("Y-m-d", strtotime("+1 day", strtotime($first_date)));
				
			}
			
		
		
		return $temp;
		
		
		
		
	}
	
	
	function get_weekly_runner_registration($first_date,$last_date)
	{
		
		$week_reg_arr=array();
		
		$temp=array();
		
		$this->db->select('COUNT(*) as total, DATE(worker_date) as worker_date');
		$this->db->from('worker');
		$this->db->where('DATE(worker_date) >=',$first_date);
		$this->db->where('DATE(worker_date) <=',$last_date);
		$this->db->group_by('DATE(worker_date)');
		
		$query=$this->db->get();
		
		
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_reg_arr[$wtr->worker_date]=$wtr->total;
				}
			
			}
		
			
		}
		
		
		
		
		while (strtotime($first_date) <= strtotime($last_date)) 
			{
				
				if(array_key_exists($first_date,$week_reg_arr))
				{
					$temp[$first_date]=$week_reg_arr[$first_date];
				}
				
				else
				{
					$temp[$first_date]=0;
				}
				
				
				
				$first_date = date ("Y-m-d", strtotime("+1 day", strtotime($first_date)));
				
			}
			
		
		
		return $temp;
		
		
		
		
	}
	
	
	
	//----------------------transaction report------------------
	
	
	function get_yearly_earning($year_first,$year_last)
	{		
		
		$year_post_arr=array();
		$year_pay_arr=array();
		
		$temp=array();
		
		
		
		
		/////////////===========total earning on total post task
		
		
		$this->db->select('SUM(total_cut_price) as fees, YEAR(wallet_date) as wallet_year');
		$this->db->from('wallet');
		$this->db->where('credit >',0);
		$this->db->where('credit !=',0);
		$this->db->where('total_cut_price >',0);
		$this->db->where('task_id !=',0);
		$this->db->where('YEAR(wallet_date) >=',$year_first);
		$this->db->where('YEAR(wallet_date) <=',$year_last);
		$this->db->group_by('YEAR(wallet_date)');
		
		$query=$this->db->get();
		
		//echo $this->db->last_query();
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$year_post_arr[$wtr->wallet_year]=$wtr->fees;
				}
			
			}
		
			
		}
		
		
		
		/////////////===========total earning on total runner pay
		
		
		$this->db->select('SUM(total_cut_price) as fees, YEAR(wallet_date) as wallet_year');
		$this->db->from('wallet');
		$this->db->where('debit >',0);
		$this->db->where('debit !=',0);
		$this->db->where('total_cut_price >',0);
		$this->db->where('task_id !=',0);
		$this->db->where('YEAR(wallet_date) >=',$year_first);
		$this->db->where('YEAR(wallet_date) <=',$year_last);
		$this->db->group_by('YEAR(wallet_date)');
		
		$query2=$this->db->get();
		
		//echo $this->db->last_query();
	
		
		if($query2->num_rows()>0)
		{
			$res2 = $query2->result();		
			
			
			if($res2)
			{
				
				foreach($res2 as $wtr)
				{
					$year_pay_arr[$wtr->wallet_year]=$wtr->fees;
				}
			
			}
			
		}
		
		
		
		
			for($i=$year_first;$i<=$year_last;$i++)
			{	
				
				
				if(array_key_exists($i,$year_post_arr))
				{
					$temp[$i]=$year_post_arr[$i];
				}
				
				else
				{
					$temp[$i]=0.00;
				}
				
				
				if(array_key_exists($i,$year_pay_arr))
				{
					$temp[$i]=$year_pay_arr[$i]+$temp[$i];
				}
				
			
				
			}
			
		
		
		
		
		return $temp;
		
		
	}
	
	
	function get_yearly_escrow($year_first,$year_last)
	{		
		
		$year_escrow_arr=array();

		$temp=array();
		
		
		$this->db->select('SUM(credit) as fees, YEAR(wallet_date) as wallet_year');
		$this->db->from('wallet');
		$this->db->where('credit >',0);
		$this->db->where('debit =',0);
		$this->db->where('task_id !=',0);
		$this->db->where('YEAR(wallet_date) >=',$year_first);
		$this->db->where('YEAR(wallet_date) <=',$year_last);
		$this->db->group_by('YEAR(wallet_date)');
		
		$query=$this->db->get();
		
		//echo $this->db->last_query();
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$year_escrow_arr[$wtr->wallet_year]=$wtr->fees;
				}
			
			}
		
			
		}
		
	
		
			for($i=$year_first;$i<=$year_last;$i++)
			{	
				
				
				if(array_key_exists($i,$year_escrow_arr))
				{
					$temp[$i]=$year_escrow_arr[$i];
				}
				
				else
				{
					$temp[$i]=0.00;
				}
				
				
				
			}
			
		
		return $temp;
		
		
	}
	
	
	function get_yearly_runner_pay($year_first,$year_last)
	{		
		
		$year_pay_arr=array();

		$temp=array();
		
		
		$this->db->select('SUM(debit) as fees, YEAR(wallet_date) as wallet_year');
		$this->db->from('wallet');
		$this->db->where('debit >',0);
		$this->db->where('credit =',0);
		$this->db->where('task_id !=',0);
		$this->db->where('YEAR(wallet_date) >=',$year_first);
		$this->db->where('YEAR(wallet_date) <=',$year_last);
		$this->db->group_by('YEAR(wallet_date)');
		
		$query=$this->db->get();
		
		//echo $this->db->last_query();
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$year_pay_arr[$wtr->wallet_year]=$wtr->fees;
				}
			
			}
		
			
		}
		
		
			for($i=$year_first;$i<=$year_last;$i++)
			{
				
				if(array_key_exists($i,$year_pay_arr))
				{
					$temp[$i]=$year_pay_arr[$i];
				}
				
				else
				{
					$temp[$i]=0.00;
				}
				
				
				
			}
			
		
		return $temp;
		
		
	}
	
	
	
	
	
	
	
	
	function get_monthly_earning($month_first,$month_last)
	{		
		
		$month_post_arr=array();
		$month_pay_arr=array();
		
		$temp=array();
		
		$month_year=date('Y');
		
		
		/////////////===========total earning on total post task
		
		
		$this->db->select('SUM(total_cut_price) as fees, MONTH(wallet_date) as wallet_month');
		$this->db->from('wallet');
		$this->db->where('credit >',0);
		$this->db->where('credit !=',0);
		$this->db->where('total_cut_price >',0);
		$this->db->where('task_id !=',0);
		$this->db->where('MONTH(wallet_date) >=',$month_first);
		$this->db->where('MONTH(wallet_date) <=',$month_last);
		$this->db->where('YEAR(wallet_date) ',$month_year);
		$this->db->group_by('MONTH(wallet_date)');
		
		$query=$this->db->get();
		
		//echo $this->db->last_query();
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$month_post_arr[$wtr->wallet_month]=$wtr->fees;
				}
			
			}
		
			
		}
		
		
		
		/////////////===========total earning on total runner pay
		
		
		$this->db->select('SUM(total_cut_price) as fees, MONTH(wallet_date) as wallet_month');
		$this->db->from('wallet');
		$this->db->where('debit >',0);
		$this->db->where('debit !=',0);
		$this->db->where('total_cut_price >',0);
		$this->db->where('task_id !=',0);
		$this->db->where('MONTH(wallet_date) >=',$month_first);
		$this->db->where('MONTH(wallet_date) <=',$month_last);
		$this->db->where('YEAR(wallet_date) ',$month_year);
		$this->db->group_by('MONTH(wallet_date)');
		
		$query2=$this->db->get();
		
		//echo $this->db->last_query();
	
		
		if($query2->num_rows()>0)
		{
			$res2 = $query2->result();		
			
			
			if($res2)
			{
				
				foreach($res2 as $wtr)
				{
					$month_pay_arr[$wtr->wallet_month]=$wtr->fees;
				}
			
			}
			
		}
		
		
		
		
			for($i=1;$i<=12;$i++)
			{	
				
				
				if(array_key_exists($i,$month_post_arr))
				{
					$temp[$i]=$month_post_arr[$i];
				}
				
				else
				{
					$temp[$i]=0.00;
				}
				
				
				if(array_key_exists($i,$month_pay_arr))
				{
					$temp[$i]=$month_pay_arr[$i]+$temp[$i];
				}
				
			
				
			}
			
		
		
		
		
		return $temp;
		
		
	}
	
	
	function get_monthly_escrow($month_first,$month_last)
	{		
		
		$month_escrow_arr=array();

		$temp=array();
		
		$month_year=date('Y');
		
		$this->db->select('SUM(credit) as fees, MONTH(wallet_date) as wallet_month');
		$this->db->from('wallet');
		$this->db->where('credit >',0);
		$this->db->where('debit =',0);
		$this->db->where('task_id !=',0);
		$this->db->where('MONTH(wallet_date) >=',$month_first);
		$this->db->where('MONTH(wallet_date) <=',$month_last);
		$this->db->where('YEAR(wallet_date) ',$month_year);
		$this->db->group_by('MONTH(wallet_date)');
		
		$query=$this->db->get();
		
		//echo $this->db->last_query();
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$month_escrow_arr[$wtr->wallet_month]=$wtr->fees;
				}
			
			}
		
			
		}
		
	
		
			for($i=1;$i<=12;$i++)
			{	
				//$d=sprintf("%02d",$i);
				
				if(array_key_exists($i,$month_escrow_arr))
				{
					$temp[$i]=$month_escrow_arr[$i];
				}
				
				else
				{
					$temp[$i]=0.00;
				}
				
				
				
			}
			
		
		return $temp;
		
		
	}
	
	
	function get_monthly_runner_pay($month_first,$month_last)
	{		
		
		$month_pay_arr=array();

		$temp=array();
		
		$month_year=date('Y');
		
		
		$this->db->select('SUM(debit) as fees, MONTH(wallet_date) as wallet_month');
		$this->db->from('wallet');
		$this->db->where('debit >',0);
		$this->db->where('credit =',0);
		$this->db->where('task_id !=',0);
		$this->db->where('MONTH(wallet_date) >=',$month_first);
		$this->db->where('MONTH(wallet_date) <=',$month_last);
		$this->db->where('YEAR(wallet_date) ',$month_year);
		$this->db->group_by('MONTH(wallet_date)');
		
		$query=$this->db->get();
		
		//echo $this->db->last_query();
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$month_pay_arr[$wtr->wallet_month]=$wtr->fees;
				}
			
			}
		
			
		}
		
		
			for($i=1;$i<=12;$i++)
			{
				
				if(array_key_exists($i,$month_pay_arr))
				{
					$temp[$i]=$month_pay_arr[$i];
				}
				
				else
				{
					$temp[$i]=0.00;
				}
				
				
				
			}
			
		
		return $temp;
		
		
	}
	
	
	
	
	
	
	
	
	
	function get_weekly_earning($first_date,$last_date)
	{		
		
		$week_post_arr=array();
		$week_pay_arr=array();
		
		$temp=array();
		
		
		
		
		/////////////===========total earning on total post task
		
		
		$this->db->select('SUM(total_cut_price) as fees, DATE(wallet_date) as wallet_date');
		$this->db->from('wallet');
		$this->db->where('credit >',0);
		$this->db->where('credit !=',0);
		$this->db->where('total_cut_price >',0);
		$this->db->where('task_id !=',0);
		$this->db->where('DATE(wallet_date) >=',$first_date);
		$this->db->where('DATE(wallet_date) <=',$last_date);
		$this->db->group_by('DATE(wallet_date)');
		
		$query=$this->db->get();
		
		//echo $this->db->last_query();
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_post_arr[$wtr->wallet_date]=$wtr->fees;
				}
			
			}
		
			
		}
		
		
		
		/////////////===========total earning on total runner pay
		
		
		$this->db->select('SUM(total_cut_price) as fees, DATE(wallet_date) as wallet_date');
		$this->db->from('wallet');
		$this->db->where('debit >',0);
		$this->db->where('debit !=',0);
		$this->db->where('total_cut_price >',0);
		$this->db->where('task_id !=',0);
		$this->db->where('DATE(wallet_date) >=',$first_date);
		$this->db->where('DATE(wallet_date) <=',$last_date);
		$this->db->group_by('DATE(wallet_date)');
		
		$query2=$this->db->get();
		
		//echo $this->db->last_query();
	
		
		if($query2->num_rows()>0)
		{
			$res2 = $query2->result();		
			
			
			if($res2)
			{
				
				foreach($res2 as $wtr)
				{
					$week_pay_arr[$wtr->wallet_date]=$wtr->fees;
				}
			
			}
			
		}
		
		
		
		
			while (strtotime($first_date) <= strtotime($last_date)) 
			{
				
				if(array_key_exists($first_date,$week_post_arr))
				{
					$temp[$first_date]=$week_post_arr[$first_date];
				}
				
				else
				{
					$temp[$first_date]=0.00;
				}
				
				
				if(array_key_exists($first_date,$week_pay_arr))
				{
					$temp[$first_date]=$week_pay_arr[$first_date]+$temp[$first_date];
				}
				
				
				$first_date = date ("Y-m-d", strtotime("+1 day", strtotime($first_date)));
				
			}
			
		
		
		
		
		return $temp;
		
		
	}
	
	
	function get_weekly_escrow($first_date,$last_date)
	{		
		
		$week_escrow_arr=array();

		$temp=array();
		
		
		$this->db->select('SUM(credit) as fees, DATE(wallet_date) as wallet_date');
		$this->db->from('wallet');
		$this->db->where('credit >',0);
		$this->db->where('debit =',0);
		$this->db->where('task_id !=',0);
		$this->db->where('DATE(wallet_date) >=',$first_date);
		$this->db->where('DATE(wallet_date) <=',$last_date);
		$this->db->group_by('DATE(wallet_date)');
		
		$query=$this->db->get();
		
		//echo $this->db->last_query();
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_escrow_arr[$wtr->wallet_date]=$wtr->fees;
				}
			
			}
		
			
		}
		
		
			while (strtotime($first_date) <= strtotime($last_date)) 
			{
				
				if(array_key_exists($first_date,$week_escrow_arr))
				{
					$temp[$first_date]=$week_escrow_arr[$first_date];
				}
				
				else
				{
					$temp[$first_date]=0.00;
				}
				
				$first_date = date ("Y-m-d", strtotime("+1 day", strtotime($first_date)));
				
			}
			
		
		return $temp;
		
		
	}
	
	
	function get_weekly_runner_pay($first_date,$last_date)
	{		
		
		$week_pay_arr=array();

		$temp=array();
		
		
		$this->db->select('SUM(debit) as fees, DATE(wallet_date) as wallet_date');
		$this->db->from('wallet');
		$this->db->where('debit >',0);
		$this->db->where('credit =',0);
		$this->db->where('task_id !=',0);
		$this->db->where('DATE(wallet_date) >=',$first_date);
		$this->db->where('DATE(wallet_date) <=',$last_date);
		$this->db->group_by('DATE(wallet_date)');
		
		$query=$this->db->get();
		
		//echo $this->db->last_query();
		
		if($query->num_rows()>0)
		{
			$res = $query->result();		
			
			
			if($res)
			{
				
				foreach($res as $wtr)
				{
					$week_pay_arr[$wtr->wallet_date]=$wtr->fees;
				}
			
			}
		
			
		}
		
		
			while (strtotime($first_date) <= strtotime($last_date)) 
			{
				
				if(array_key_exists($first_date,$week_pay_arr))
				{
					$temp[$first_date]=$week_pay_arr[$first_date];
				}
				
				else
				{
					$temp[$first_date]=0.00;
				}
				
				$first_date = date ("Y-m-d", strtotime("+1 day", strtotime($first_date)));
				
			}
			
		
		return $temp;
		
		
	}
	
	
}

?>