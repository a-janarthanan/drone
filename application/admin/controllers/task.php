<?php
class Task extends CI_Controller {
	function Task()
	{
		 parent::__construct();	
		$this->load->model('task_model');
		$this->load->model('report_model');
		$this->load->model('user_model');
		$this->load->model('worker_model');
	}
	
	function index()
	{
		redirect('task/list_task');
	}
	
	function list_task($limit=20,$offset=0,$msg='')
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_task');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$data['cate']='';
		$data['lbudget']='';
		$data['hbudget']='';
		$data['cityname']='';
		$data['statename']='';
		
		$data['cat'] = $this->report_model->get_category();
		$this->load->library('pagination');

		//$limit = '10';
		$config['uri_segment']='4';
		$config['base_url'] = base_url().'task/list_task/'.$limit.'/';
		$config['total_rows'] = $this->task_model->get_total_task_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->task_model->get_task_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/task/list_task',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	function search_list_task($limit=20,$option='',$keyword='',$offset=0,$msg='')
	{
		/*$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_task');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$this->load->library('pagination');
		$data['cat'] = $this->report_model->get_category();
		$cat='';
		$lbudget='';
		$hbudget='';
		
		if($_POST)
		{		
			$option=$this->input->post('option');
			$keyword=$this->input->post('keyword');
			$cat=$this->input->post('cat');
			$lbudget=$this->input->post('low_budget');
			$hbudget=$this->input->post('high_budget'); 
						
		}
		else
		{
			$option=$option;
			$keyword=$keyword;		
			$cat=$cat;	
			$lbudget=$lbudget;
			$hbudget=$hbudget;
		}
		
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',trim($keyword)));
	
		$config['uri_segment']='5';
		$config['base_url'] = base_url().'task/search_list_task/'.$limit.'/'.$option.'/'.$keyword.'/';
		$config['total_rows'] = $this->task_model->get_total_search_task_count($option,$keyword,$cat,$lbudget,$hbudget);
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->task_model->get_search_task_result($option,$keyword,$offset, $limit,$cat,$lbudget,$hbudget);
		$data['msg'] = $msg;
		$data['offset'] = $offset;

		$data['site_setting'] = site_setting();
		
		$data['limit']=$limit;
		$data['option']=$option;
		$data['keyword']=$keyword;
		$data['search_type']='search';*/
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
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
		//echo '<pre>'; print_r($_POST); die();
			
			$option=$this->input->post('option');
			$keyword=$this->input->post('keyword');
			$cat=$this->input->post('cat');
			$lbudget=$this->input->post('low_budget');
			$hbudget=$this->input->post('high_budget'); 
			$cityname=$this->input->post('city');;
			$statename=$this->input->post('state');;
			
			if($option=='category')
			{
				$keyword= $cat;	
			}
			if($option=='city')
			{
				$keyword= $cityname;	
			}
			if($option=='state')
			{
				$keyword= $statename;	
			}
			
			if($option=='date')
			{
				$keyword=date('Y-m-d', strtotime($keyword));
			}
			
			if($option=='budget')
			{
			   $keyword=$lbudget.'-'.$hbudget;
		    }			
		}
		else
		{
			$buget = explode('-',$keyword);
			//$lbudget=$buget[0]; //$lbudget;
			//$hbudget=$buget[1]; //$hbudget;
			
			$option=$option;
			$keyword=$keyword;		
			$cat=$cat;	
			$lbudget=$lbudget;
			$hbudget=$hbudget;
			$cityname=$cityname;
			$statename=$statename;
		}
		
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',trim($keyword)));
	
		//$config['uri_segment']='5';
		if($keyword=='')
		{
			$config['uri_segment']='4';
		
		} else{
			
			if($offset>0)
			{
				$config['uri_segment']='6';
			}
			else
			{
				$config['uri_segment']='5';
			}
		}	
		
		$config['base_url'] = base_url().'task/search_list_task/'.$limit.'/'.$option.'/'.$keyword.'/';
		$config['total_rows'] = $this->report_model->get_total_search_task_count($option,$keyword,$cat,$lbudget,$hbudget,$cityname,$statename);
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->report_model->get_search_task_result($option,$keyword,$offset, $limit,$cat,$lbudget,$hbudget,$cityname,$statename);
		$data['msg'] = $msg;
		$data['offset'] = $offset;

		//$data['site_setting'] = site_setting();
		//echo "<pre>";
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
		
		$data['site_setting'] = site_setting();
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/task/list_task',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	/*function open_task($limit=20,$offset=0,$msg='')
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_task');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}

		$this->load->library('pagination');

		//$limit = '10';
		$config['uri_segment']='4';
		$config['base_url'] = base_url().'task/list_task/'.$limit.'/';
	    $config['total_rows'] = $this->task_model->get_total_open_task_count();
		
		
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->task_model->get_open_task_result($offset, $limit);
		//echo"<pre>";
		//print_r($data['result']);
		//exit;
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/task/open_task',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}*/
	
	function post_task($limit=20,$offset=0,$msg='')
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_task');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}

		$this->load->library('pagination');

		//$limit = '10';
		$config['uri_segment']='4';
		$config['base_url'] = base_url().'task/post_task/'.$limit.'/';
	    $config['total_rows'] = $this->task_model->get_total_post_task_count();
		
		
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->task_model->get_post_task_result($offset, $limit);
		//echo"<pre>";
		//print_r($data['result']);
		//exit;
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/task/post_task',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
    function action_task()
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');

		 $offset=$this->input->post('offset');
		 $action=$this->input->post('action');
		 $task_id=$this->input->post('chk');
		
		if($action=='suspend')
		{	
			foreach($task_id as $id)
			{
				$this->db->query("update ".$this->db->dbprefix('task')." set task_activity_status='4' where task_id='".$id."'");				
			}
			
			redirect('task/suspend_task/20/'.$offset.'/suspend');
		}
		
		if($action=='delete')
		{	
			foreach($task_id as $id)
			{
				$this->db->delete('task',array('task_id' =>$id));
			}
			
			redirect('task/list_task/20/'.$offset.'/delete');
		}
		
		
		
	}
	
	function close_task($limit=20,$offset=0,$msg='')
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_task');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}

		$this->load->library('pagination');

		//$limit = '10';
		$config['uri_segment']='4';
		$config['base_url'] = base_url().'task/list_task/'.$limit.'/';
	    $config['total_rows'] = $this->task_model->get_total_close_task_count();
		
		
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->task_model->get_close_task_result($offset, $limit);
		//echo"<pre>";
		//print_r($data['result']);
		//exit;
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/task/close_task',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	function completed_task($limit=20,$offset=0,$msg='')
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_task');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}

		$this->load->library('pagination');

		//$limit = '10';
		$config['uri_segment']='4';
		$config['base_url'] = base_url().'task/list_task/'.$limit.'/';
	    $config['total_rows'] = $this->task_model->get_total_complete_task_count();
		
		
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->task_model->get_complete_task_result($offset, $limit);
		//echo"<pre>";
		//print_r($data['result']);
		//exit;
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/task/complete_task',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	function suspend_task($limit=20,$offset=0,$msg='')
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_task');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}

		$this->load->library('pagination');

		//$limit = '10';
		$config['uri_segment']='4';
		$config['base_url'] = base_url().'task/list_task/'.$limit.'/';
	    $config['total_rows'] = $this->task_model->get_total_suspend_task_count();
		
		
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->task_model->get_suspend_task_result($offset, $limit);
		//echo"<pre>";
		//print_r($data['result']);
		//exit;
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/task/suspend_task',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	function running_task($limit=20,$offset=0,$msg='')
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_task');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}

		$this->load->library('pagination');

		//$limit = '10';
		$config['uri_segment']='4';
		$config['base_url'] = base_url().'task/list_task/'.$limit.'/';
	    $config['total_rows'] = $this->task_model->get_total_running_task_count();
		
		
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->task_model->get_running_task_result($offset, $limit);
		//echo"<pre>";
		//print_r($data['result']);
		//exit;
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/task/running_task',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	function force_download($filename = '', $data = false, $enable_partial = true, $speedlimit = 0)
    {
        if ($filename == '')
        {
            return FALSE;
        }
        
        if($data === false && !file_exists($filename))
            return FALSE;

        // Try to determine if the filename includes a file extension.
        // We need it in order to set the MIME type
        if (FALSE === strpos($filename, '.'))
        {
            return FALSE;
        }
    
        // Grab the file extension
        $x = explode('.', $filename);
        $extension = end($x);

        // Load the mime types
        @include(APPPATH.'config/mimes'.EXT);
    
        // Set a default mime if we can't find it
        if ( ! isset($mimes[$extension]))
        {
            if (ereg('Opera(/| )([0-9].[0-9]{1,2})', $_SERVER['HTTP_USER_AGENT']))
                $UserBrowser = "Opera";
            elseif (ereg('MSIE ([0-9].[0-9]{1,2})', $_SERVER['HTTP_USER_AGENT']))
                $UserBrowser = "IE";
            else
                $UserBrowser = '';
            
            $mime = ($UserBrowser == 'IE' || $UserBrowser == 'Opera') ? 'application/octetstream' : 'application/octet-stream';
        }
        else
        {
            $mime = (is_array($mimes[$extension])) ? $mimes[$extension][0] : $mimes[$extension];
        }
        
        $size = $data === false ? filesize($filename) : strlen($data);
        
        if($data === false)
        {
            $info = pathinfo($filename);
            $name = $info['basename'];
        }
        else
        {
            $name = $filename;
        }
        
        // Clean data in cache if exists
        @ob_end_clean();
        
        // Check for partial download
        if(isset($_SERVER['HTTP_RANGE']) && $enable_partial)
        {
            list($a, $range) = explode("=", $_SERVER['HTTP_RANGE']);
            list($fbyte, $lbyte) = explode("-", $range);
            
            if(!$lbyte)
                $lbyte = $size - 1;
            
            $new_length = $lbyte - $fbyte;
            
            header("HTTP/1.1 206 Partial Content", true);
            header("Content-Length: $new_length", true);
            header("Content-Range: bytes $fbyte-$lbyte/$size", true);
        }
        else
        {
            header("Content-Length: " . $size);
        }
        
        // Common headers
        header('Content-Type: ' . $mime, true);
        header('Content-Disposition: attachment; filename="' . $name . '"', true);
        header("Expires: 0", true);
        header('Accept-Ranges: bytes', true);
        header("Cache-control: private", true);
        header('Pragma: private', true);header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        
        // Open file
        if($data === false) {
            $file = fopen($filename, 'r');
            
            if(!$file)
                return FALSE;
        }
        
        // Cut data for partial download
        if(isset($_SERVER['HTTP_RANGE']) && $enable_partial)
            if($data === false)
                fseek($file, $range);
            else
                $data = substr($data, $range);
        
        // Disable script time limit
        @set_time_limit(0);
        
        // Check for speed limit or file optimize
        if($speedlimit > 0 || $data === false)
        {
            if($data === false)
            {
                $chunksize = $speedlimit > 0 ? $speedlimit * 1024 : 512 * 1024;
            
                while(!feof($file) and (connection_status() == 0))
                {
                    $buffer = fread($file, $chunksize);
                    echo $buffer;
                    flush();
                    
                    if($speedlimit > 0)
                        sleep(1);
                }
                
                fclose($file);
            }
            else
            {
                $index = 0;
                $speedlimit *= 1024; //convert to kb
                
                while($index < $size and (connection_status() == 0))
                {
                    $left = $size - $index;
                    $buffersize = min($left, $speedlimit);
                    
                    $buffer = substr($data, $index, $buffersize);
                    $index += $buffersize;
                    
                    echo $buffer;
                    flush();
                    sleep(1);
                }
            }

        }
        else
        {
            echo $data;
        }
		
		$this->db->cache_delete_all();
		ob_clean();
        flush();
		
    } 
	

	function export_post_task($time='')
	{
		
		$data = array();
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_task');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		$this->load->dbutil();
		$query = $this->db->query("select * from ".$this->db->dbprefix('task')." where task_status='1' and task_activity_status =0 ");		
		
		$delimiter = ",";
		$newline = "\r\n";

		$csv= $this->dbutil->csv_from_result($query, $delimiter, $newline);
		
		 $file_name = "open_task_".date('d-m-Y').".csv";
   		 $this->force_download($file_name,$csv);
		$this->db->cache_delete_all();	
	}
	
	function export_close_task($time='')
	{
		
		$data = array();
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_task');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		$this->load->dbutil();
		$query = $this->db->query("select * from ".$this->db->dbprefix('task')." where task_activity_status='3'");		
		
		$delimiter = ",";
		$newline = "\r\n";

		$csv= $this->dbutil->csv_from_result($query, $delimiter, $newline);
		
		 $file_name = "close_task_".date('d-m-Y').".csv";
   		 $this->force_download($file_name,$csv);
		$this->db->cache_delete_all();	
	}
	
	function export_compete_task($time='')
	{
		
		$data = array();
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_task');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		$this->load->dbutil();
		$query = $this->db->query("select * from ".$this->db->dbprefix('task')." where task_activity_status='2'");		
		
		$delimiter = ",";
		$newline = "\r\n";

		$csv= $this->dbutil->csv_from_result($query, $delimiter, $newline);
		
		 $file_name = "Complete_task_".date('d-m-Y').".csv";
   		 $this->force_download($file_name,$csv);
		$this->db->cache_delete_all();	
	}
	
	function export_suspend_task($time='')
	{
		
		$data = array();
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_task');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		$this->load->dbutil();
		$query = $this->db->query("select * from ".$this->db->dbprefix('task')." where task_activity_status='4'");		
		
		$delimiter = ",";
		$newline = "\r\n";

		$csv= $this->dbutil->csv_from_result($query, $delimiter, $newline);
		
		 $file_name = "Suspend_task_".date('d-m-Y').".csv";
   		 $this->force_download($file_name,$csv);
		$this->db->cache_delete_all();	
	}
	
	function export_running_task($time='')
	{
		
		$data = array();
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_task');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		$this->load->dbutil();
		$query = $this->db->query("select * from ".$this->db->dbprefix('task')." where task_activity_status='1'");		
		
		$delimiter = ",";
		$newline = "\r\n";

		$csv= $this->dbutil->csv_from_result($query, $delimiter, $newline);
		
		 $file_name = "running_task_".date('d-m-Y').".csv";
   		 $this->force_download($file_name,$csv);
		$this->db->cache_delete_all();	
	}
	
	function task_detail($task_id)
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$row= $this->task_model->task_detail($task_id);
		if(!$row)
		{
			redirect('home/dashboard');
		}
		
		$data['row'] =$row;
		$data['task_location']=$this->task_model->get_task_location($task_id);
		
		
		$data['total_offers_on_task']=$this->task_model->get_total_task_offer($task_id,$row->user_id);
		$data['offers_on_task']=$this->task_model->get_task_offer($task_id,$row->user_id);
		
		
		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/task/task_detail',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
}
?>