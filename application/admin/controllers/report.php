<?php
class Report extends CI_Controller 
{
	function Report()
	{
		parent::__construct();	
		$this->load->model('report_model');
		$this->load->model('user_model');
		$this->load->model('worker_model');
	}
	
	function index()
	{
		echo "<script>window.location.href='".site_url('report/list_search_report')."'</script>";
	}
	
	function list_search_report($limit=20,$option='',$keyword='',$offset=0,$msg='')
	{	
		$check_rights=get_rights('task_report');
	
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$this->load->library('pagination');
		$cat='';
		$lbudget='';
		$hbudget='';
		$cityname='';
		$statename='';	
		
		if($_POST)
		{	
			$option=$this->input->post('option');
			$keyword=$this->input->post('keyword');
			$cat=$this->input->post('cat');
			$lbudget=$this->input->post('low_budget');
			$hbudget=$this->input->post('high_budget'); 
			$cityname=$this->input->post('city');
			$statename=$this->input->post('state');						
		}
		else
		{
			$option=$option;
			$keyword=$keyword;		
			$cat=$cat;	
			$lbudget=$lbudget;
			$hbudget=$hbudget;
			$cityname=$cityname;
			$statename=$statename;
		}
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');		
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',trim($keyword)));	
		$config['uri_segment']='5';
		$config['base_url'] = base_url().'report/list_search_report/'.$limit.'/'.$option.'/'.$keyword.'/';
		$config['total_rows'] = $this->report_model->get_total_search_task_count($option,$keyword,$cat,$lbudget,$hbudget,$cityname,$statename);
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();		
		$data['result'] = $this->report_model->get_search_task_result($option,$keyword,$offset, $limit,$cat,$lbudget,$hbudget,$cityname,$statename);
		$data['msg'] = $msg;
		$data['offset'] = $offset;				
		$data['cat'] = $this->report_model->get_category();	
		
		$data['limit']=$limit;
		$data['option']=$option;
		$data['keyword']=$keyword;
		$data['lbudget']=$lbudget;
		$data['hbudget']=$hbudget;
		$data['cate']=$cat;		
		$data['cityname']=$cityname;
		$data['statename']=$statename;
		$data['search_type']='search';
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/report/list_search_report',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}	
	function export_report($time='')
	{
		
		$data = array();

		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
		
		
		$this->load->dbutil();
		
		$query = $this->db->query("select tk.*,us.*,c.*,ca.* from trc_task tk,trc_user us,trc_worker wrk,trc_user uswrk,trc_city c,trc_task_category ca where tk.user_id=us.user_id and tk.task_worker_id=wrk.worker_id and wrk.user_id=uswrk.user_id and tk.task_city_id=c.city_id and tk.task_category_id=ca.task_category_id and tk.task_status=1");		
		
		$delimiter = ",";
		$newline = "\r\n";

		$csv= $this->dbutil->csv_from_result($query, $delimiter, $newline);
		
		 $file_name = "report_".date('d-m-Y').".csv";
   		 $this->force_download($file_name,$csv);
		$this->db->cache_delete_all();	
	}
}	
?>	