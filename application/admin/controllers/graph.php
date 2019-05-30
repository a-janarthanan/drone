<?php
class Graph extends CI_Controller 
{
	function Graph()
	{
		parent::__construct();	
		$this->load->model('graph_model');
		$this->load->model('home_model'); 		
	}
	
	
	function index()
	{
		
		$data=array();
		
		$date=date('Y-m-d');
		
		$week_first_date= get_first_day_of_week($date);
		$week_last_date= get_last_day_of_week($date);	
		
		$data['week_first_date']=$week_first_date;
		$data['week_last_date']=$week_last_date;
		
		$data['weekly_earning']=$this->graph_model->get_weekly_earning($week_first_date,$week_last_date);		
		$data['weekly_escrow']=$this->graph_model->get_weekly_escrow($week_first_date,$week_last_date);
		$data['weekly_runner_pay']=$this->graph_model->get_weekly_runner_pay($week_first_date,$week_last_date);
		
		
		
		
		
	
		$month_first_date = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
		$month_last_date = date('Y-m-t', mktime(0, 0, 0, date('m'), 1, date('Y')));
		
		$month_first=1;
		$month_last=12;
		
		$data['month_first']=$month_first;
		$data['month_last']=$month_last;		
		
		$data['monthly_earning']=$this->graph_model->get_monthly_earning($month_first,$month_last);		
		$data['monthly_escrow']=$this->graph_model->get_monthly_escrow($month_first,$month_last);
		$data['monthly_runner_pay']=$this->graph_model->get_monthly_runner_pay($month_first,$month_last);
		
		
		$year_back = strtotime('-2 years');
		$year_forward = strtotime('+2 years');
		
		$year_first=date('Y',$year_back);
		$year_last=date('Y',$year_forward);
		
		$data['year_first']=$year_first;
		$data['year_last']=$year_last;	

		$data['yearly_earning']=$this->graph_model->get_yearly_earning($year_first,$year_last);		
		$data['yearly_escrow']=$this->graph_model->get_yearly_escrow($year_first,$year_last);
		$data['yearly_runner_pay']=$this->graph_model->get_yearly_runner_pay($year_first,$year_last);
		
		
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/graph/index',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	
	
	
	function task()
	{
		
		$data=array();
		
		$date=date('Y-m-d');
		
		
		$week_first_date= get_first_day_of_week($date);
		$week_last_date= get_last_day_of_week($date);	
		
		$data['week_first_date']=$week_first_date;
		$data['week_last_date']=$week_last_date;
		
		$data['weekly_new_task']=$this->graph_model->get_weekly_new_task($week_first_date,$week_last_date);		
		$data['weekly_open_task']=$this->graph_model->get_weekly_open_task($week_first_date,$week_last_date);
		$data['weekly_close_task']=$this->graph_model->get_weekly_close_task($week_first_date,$week_last_date);
		$data['weekly_cancel_task']=$this->graph_model->get_weekly_cancel_task($week_first_date,$week_last_date);
		
		
		
		
		
	
		$month_first_date = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
		$month_last_date = date('Y-m-t', mktime(0, 0, 0, date('m'), 1, date('Y')));
		
		$month_first=1;
		$month_last=12;
		
		$data['month_first']=$month_first;
		$data['month_last']=$month_last;		
		
		$data['monthly_new_task']=$this->graph_model->get_monthly_new_task($month_first,$month_last);		
		$data['monthly_open_task']=$this->graph_model->get_monthly_open_task($month_first,$month_last);
		$data['monthly_close_task']=$this->graph_model->get_monthly_close_task($month_first,$month_last);
		$data['monthly_cancel_task']=$this->graph_model->get_monthly_cancel_task($month_first,$month_last);
		
		
		$year_back = strtotime('-2 years');
		$year_forward = strtotime('+2 years');
		
		$year_first=date('Y',$year_back);
		$year_last=date('Y',$year_forward);
		
		$data['year_first']=$year_first;
		$data['year_last']=$year_last;	

		$data['yearly_new_task']=$this->graph_model->get_yearly_new_task($year_first,$year_last);		
		$data['yearly_open_task']=$this->graph_model->get_yearly_open_task($year_first,$year_last);
		$data['yearly_close_task']=$this->graph_model->get_yearly_close_task($year_first,$year_last);
		$data['yearly_cancel_task']=$this->graph_model->get_yearly_cancel_task($year_first,$year_last);
		
		
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/graph/task',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	
	
	function user()
	{
		
		$data=array();
		
		$date=date('Y-m-d');
		
		$week_first_date= get_first_day_of_week($date);
		$week_last_date= get_last_day_of_week($date);	
		
		$data['week_first_date']=$week_first_date;
		$data['week_last_date']=$week_last_date;
		
		$data['weekly_registration']=$this->graph_model->get_weekly_registration($week_first_date,$week_last_date);		
		$data['weekly_fb_registration']=$this->graph_model->get_weekly_fb_registration($week_first_date,$week_last_date);
		$data['weekly_tw_registration']=$this->graph_model->get_weekly_tw_registration($week_first_date,$week_last_date);
		$data['weekly_runner_registration']=$this->graph_model->get_weekly_runner_registration($week_first_date,$week_last_date);
		
		
		
		
		
	
		$month_first_date = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
		$month_last_date = date('Y-m-t', mktime(0, 0, 0, date('m'), 1, date('Y')));
		
		$month_first=1;
		$month_last=12;
		
		$data['month_first']=$month_first;
		$data['month_last']=$month_last;		
		
		$data['monthly_registration']=$this->graph_model->get_monthly_registration($month_first,$month_last);		
		$data['monthly_fb_registration']=$this->graph_model->get_monthly_fb_registration($month_first,$month_last);
		$data['monthly_tw_registration']=$this->graph_model->get_monthly_tw_registration($month_first,$month_last);
		$data['monthly_runner_registration']=$this->graph_model->get_monthly_runner_registration($month_first,$month_last);
		
		
		$year_back = strtotime('-2 years');
		$year_forward = strtotime('+2 years');
		
		$year_first=date('Y',$year_back);
		$year_last=date('Y',$year_forward);
		
		$data['year_first']=$year_first;
		$data['year_last']=$year_last;	

		$data['yearly_registration']=$this->graph_model->get_yearly_registration($year_first,$year_last);		
		$data['yearly_fb_registration']=$this->graph_model->get_yearly_fb_registration($year_first,$year_last);
		$data['yearly_tw_registration']=$this->graph_model->get_yearly_tw_registration($year_first,$year_last);
		$data['yearly_runner_registration']=$this->graph_model->get_yearly_runner_registration($year_first,$year_last);
		
		
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/graph/user',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
}

?>