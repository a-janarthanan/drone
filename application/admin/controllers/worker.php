<?php

class Worker extends CI_Controller {

	function Worker()

	{

		 parent::__construct();	

		$this->load->model('worker_model');

	}

	

	function index()

	{

		redirect('worker/list_worker');

	}

	

	function list_worker($limit=20,$offset=0,$msg='')

	{

		

		$theme = getThemeName();

		$this->template->set_master_template($theme .'/template.php');

		

		$check_rights=get_rights('list_worker');

		

		if(	$check_rights==0) {			

			redirect('home/dashboard/no_rights');	

		}



		$this->load->library('pagination');



		//$limit = '10';

		$config['uri_segment']='4';

		$config['base_url'] = base_url().'worker/list_worker/'.$limit.'/';

		$config['total_rows'] = $this->worker_model->get_total_worker_count();

		$config['per_page'] = $limit;		

		$this->pagination->initialize($config);		

		$data['page_link'] = $this->pagination->create_links();

		

		$data['result'] = $this->worker_model->get_worker_result($offset, $limit);

		$data['msg'] = $msg;

		$data['offset'] = $offset;

		

		

		$data['limit']=$limit;

		$data['option']='';

		$data['keyword']='';

		$data['search_type']='normal';

		

		$data['site_setting'] = site_setting();



		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);

		$this->template->write_view('center',$theme .'/layout/worker/list_worker',$data,TRUE);

		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);

		$this->template->render();

	}

	

	function search_list_worker($limit=20,$option='',$keyword='',$offset=0,$msg='')

	{

		$theme = getThemeName();

		$this->template->set_master_template($theme .'/template.php');

		

		$check_rights=get_rights('list_worker');

		

		if(	$check_rights==0) {			

			redirect('home/dashboard/no_rights');	

		}

		

		$this->load->library('pagination');

		

		if($_POST)

		{		

			$option=$this->input->post('option');

			$keyword=$this->input->post('keyword');

		}

		else

		{

			$option=$option;

			$keyword=$keyword;			

		}

		

		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',trim($keyword)));

	

		$config['uri_segment']='5';

		$config['base_url'] = base_url().'worker/search_list_worker/'.$limit.'/'.$option.'/'.$keyword.'/';

		$config['total_rows'] = $this->worker_model->get_total_search_worker_count($option,$keyword);

		$config['per_page'] = $limit;		

		$this->pagination->initialize($config);		

		$data['page_link'] = $this->pagination->create_links();

		

		$data['result'] = $this->worker_model->get_search_worker_result($option,$keyword,$offset, $limit);

		$data['msg'] = $msg;

		$data['offset'] = $offset;



		$data['site_setting'] = site_setting();

		

		$data['limit']=$limit;

		$data['option']=$option;

		$data['keyword']=$keyword;

		$data['search_type']='search';



		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);

		$this->template->write_view('center',$theme .'/layout/worker/list_worker',$data,TRUE);

		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);

		$this->template->render();

	}

	

	function list_active_worker($limit=20,$offset=0,$msg='')

	{

		

		$theme = getThemeName();

		$this->template->set_master_template($theme .'/template.php');

		

		$check_rights=get_rights('list_worker');

		

		if(	$check_rights==0) {			

			redirect('home/dashboard/no_rights');	

		}



		$this->load->library('pagination');



		//$limit = '10';

		$config['uri_segment']='4';

		$config['base_url'] = base_url().'worker/list_active_worker/'.$limit.'/';

		$config['total_rows'] = $this->worker_model->get_total_active_worker_count();

		$config['per_page'] = $limit;		

		$this->pagination->initialize($config);		

		$data['page_link'] = $this->pagination->create_links();

		

		$data['result'] = $this->worker_model->get_active_worker_result($offset, $limit);

		$data['msg'] = $msg;

		$data['offset'] = $offset;

		

		

		$data['limit']=$limit;

		$data['option']='';

		$data['keyword']='';

		$data['search_type']='normal';

		

		$data['site_setting'] = site_setting();



		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);

		$this->template->write_view('center',$theme .'/layout/worker/list_active_worker',$data,TRUE);

		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);

		$this->template->render();

	}

	

	function list_waiting_worker($limit=20,$offset=0,$msg='')

	{

		

		$theme = getThemeName();

		$this->template->set_master_template($theme .'/template.php');

		

		$check_rights=get_rights('list_worker');

		

		if(	$check_rights==0) {			

			redirect('home/dashboard/no_rights');	

		}



		$this->load->library('pagination');



		//$limit = '10';

		$config['uri_segment']='4';

		$config['base_url'] = base_url().'worker/list_waiting_worker/'.$limit.'/';

		$config['total_rows'] = $this->worker_model->get_total_waiting_worker_count();

		$config['per_page'] = $limit;		

		$this->pagination->initialize($config);		

		$data['page_link'] = $this->pagination->create_links();

		

		$data['result'] = $this->worker_model->get_waiting_worker_result($offset, $limit);

		$data['msg'] = $msg;

		$data['offset'] = $offset;

		

		

		$data['limit']=$limit;

		$data['option']='';

		$data['keyword']='';

		$data['search_type']='normal';

		

		$data['site_setting'] = site_setting();



		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);

		$this->template->write_view('center',$theme .'/layout/worker/list_waiting_worker',$data,TRUE);

		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);

		$this->template->render();

	}

	

	 function action_worker()

	{

		

		

		$theme = getThemeName();

		$this->template->set_master_template($theme .'/template.php');

		

		$check_rights=get_rights('list_worker');

		

		if(	$check_rights==0) {			

			redirect('home/dashboard/no_rights');	

		}

		

		

		

		 $offset=$this->input->post('offset');

		 $action=$this->input->post('action');

		 $worker_id=$this->input->post('chk');

		 $fname=$this->input->post('fname');

		//print_r($trans_id);

		//exit;

		

		

		if($action=='active')

		{	

			foreach($worker_id as $id)

			{

				$this->db->query("update ".$this->db->dbprefix('worker')." set worker_app_approved='1',worker_interview_approved='1',worker_background_approved='1',worker_status='1' where worker_id='".$id."'");				

			}

			

			redirect('worker/list_waiting_worker/20/'.$offset.'/active');

		}

		

		if($action=='reject')

		{	

			foreach($worker_id as $id)

			{

				$this->db->query("update ".$this->db->dbprefix('worker')." set worker_status='2' where worker_id='".$id."'");				

			}

			

			redirect('worker/list_waiting_worker/20/'.$offset.'/reject');

		}

		

		if($action=='delete')

		{	

			foreach($worker_id as $id)

			{

				$this->db->query("update ".$this->db->dbprefix('worker')." set worker_status='3' where worker_id='".$id."'");

			}

			

			redirect('worker/'.$fname.'/20/'.$offset.'/delete');

		}

		

		

		

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

	



	function export_waiting_worker($time='')

	{

		

		$theme = getThemeName();

		$this->template->set_master_template($theme .'/template.php');

		

		$check_rights=get_rights('list_worker');

		

		if(	$check_rights==0) {			

			redirect('home/dashboard/no_rights');	

		}

		

		

		$this->load->dbutil();

		$query = $this->db->query("select * from ".$this->db->dbprefix('worker')." w inner join ".$this->db->dbprefix('user')." u on w.user_id = u.user_id and w.worker_status='0'");		

		

		$delimiter = ",";

		$newline = "\r\n";



		$csv= $this->dbutil->csv_from_result($query, $delimiter, $newline);

		

		 $file_name = "waiting_worker_".date('d-m-Y').".csv";

   		 $this->force_download($file_name,$csv);

		$this->db->cache_delete_all();	

	}

	

	function export_active_worker($time='')

	{

		$theme = getThemeName();

		$this->template->set_master_template($theme .'/template.php');

		

		$check_rights=get_rights('list_worker');

		

		if(	$check_rights==0) {			

			redirect('home/dashboard/no_rights');	

		}

		

		

		$this->load->dbutil();

		$query = $this->db->query("select * from ".$this->db->dbprefix('worker')." w, ".$this->db->dbprefix('user')." u where w.user_id = u.user_id and w.worker_app_approved='1' and w.worker_status='1'");		

		

		$delimiter = ",";

		$newline = "\r\n";



		$csv= $this->dbutil->csv_from_result($query, $delimiter, $newline);

		

		 $file_name = "active_worker_".date('d-m-Y').".csv";

   		 $this->force_download($file_name,$csv);

		$this->db->cache_delete_all();	

	}

	

   function export_reject_worker($time='')

	{

		$theme = getThemeName();

		$this->template->set_master_template($theme .'/template.php');

		

		$check_rights=get_rights('list_worker');

		

		if(	$check_rights==0) {			

			redirect('home/dashboard/no_rights');	

		}

		

		

		$this->load->dbutil();

		$query = $this->db->query("select * from ".$this->db->dbprefix('worker')." w, ".$this->db->dbprefix('user')." u where w.user_id = u.user_id and w.worker_status='2'");		

		

		$delimiter = ",";

		$newline = "\r\n";



		$csv= $this->dbutil->csv_from_result($query, $delimiter, $newline);

		

		 $file_name = "reject_worker_".date('d-m-Y').".csv";

   		 $this->force_download($file_name,$csv);

		$this->db->cache_delete_all();	

	}

	

  function list_reject_worker($limit=20,$offset=0,$msg='')

	{

		

		$theme = getThemeName();

		$this->template->set_master_template($theme .'/template.php');

		

		$check_rights=get_rights('list_worker');

		

		if(	$check_rights==0) {			

			redirect('home/dashboard/no_rights');	

		}



		$this->load->library('pagination');



		//$limit = '10';

		$config['uri_segment']='4';

		$config['base_url'] = base_url().'worker/list_reject_worker/'.$limit.'/';

		$config['total_rows'] = $this->worker_model->get_total_reject_worker_count();

		$config['per_page'] = $limit;		

		$this->pagination->initialize($config);		

		$data['page_link'] = $this->pagination->create_links();

		

		$data['result'] = $this->worker_model->get_reject_worker_result($offset, $limit);

		$data['msg'] = $msg;

		$data['offset'] = $offset;

		

		

		$data['limit']=$limit;

		$data['option']='';

		$data['keyword']='';

		$data['search_type']='normal';

		

		$data['site_setting'] = site_setting();



		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);

		$this->template->write_view('center',$theme .'/layout/worker/list_reject_worker',$data,TRUE);

		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);

		$this->template->render();

	}



    function list_deleted_worker($limit=20,$offset=0,$msg='')

	{

		

		$theme = getThemeName();

		$this->template->set_master_template($theme .'/template.php');

		

		$check_rights=get_rights('list_worker');

		

		if(	$check_rights==0) {			

			redirect('home/dashboard/no_rights');	

		}



		$this->load->library('pagination');



		//$limit = '10';

		$config['uri_segment']='4';

		$config['base_url'] = base_url().'worker/list_deleted_worker/'.$limit.'/';

		$config['total_rows'] = $this->worker_model->get_total_delete_worker_count();

		$config['per_page'] = $limit;		

		$this->pagination->initialize($config);		

		$data['page_link'] = $this->pagination->create_links();

		

		$data['result'] = $this->worker_model->get_delete_worker_result($offset, $limit);

		$data['msg'] = $msg;

		$data['offset'] = $offset;

		

		

		$data['limit']=$limit;

		$data['option']='';

		$data['keyword']='';

		$data['search_type']='normal';

		

		$data['site_setting'] = site_setting();



		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);

		$this->template->write_view('center',$theme .'/layout/worker/list_deleted_worker',$data,TRUE);

		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);

		$this->template->render();

	}

	

	function delete_forever()

	{

	     $theme = getThemeName();

		$this->template->set_master_template($theme .'/template.php');

		

		$check_rights=get_rights('list_worker');

		

		if(	$check_rights==0) {			

			redirect('home/dashboard/no_rights');	

		}

	     

	     $offset=$this->input->post('offset');

		 $action=$this->input->post('action');

		 $worker_id=$this->input->post('chk');

	   foreach($worker_id as $id)

			{

				$this->db->delete('worker',array('worker_id' =>$id));

			}

			

			//redirect('task/list_deleted_worker/20/'.$offset.'/delete');
			redirect('worker/list_deleted_worker');

	}

	

	function export_deleted_worker($time='')

	{

		$theme = getThemeName();

		$this->template->set_master_template($theme .'/template.php');

		

		$check_rights=get_rights('list_worker');

		

		if(	$check_rights==0) {			

			redirect('home/dashboard/no_rights');	

		}

		

		

		$this->load->dbutil();

		$query = $this->db->query("select * from ".$this->db->dbprefix('worker')." w, ".$this->db->dbprefix('user')." u where w.user_id = u.user_id and w.worker_status='3'");		

		

		$delimiter = ",";

		$newline = "\r\n";



		$csv= $this->dbutil->csv_from_result($query, $delimiter, $newline);

		

		 $file_name = "Deleted_worker_".date('d-m-Y').".csv";

   		 $this->force_download($file_name,$csv);

		$this->db->cache_delete_all();	

	}

	

	

	//view worker

	function view_worker($id)

	{

		$check_rights=get_rights('list_worker');

		

		if(	$check_rights==0) {			

			redirect('home/dashboard/no_rights');	

		}

		

		if($id == '' || $id == 0) {

			redirect('worker/list_worker');

		}

		

		$data["error"]='';

	    $theme = getThemeName();

		$this->template->set_master_template($theme .'/template.php');

		

		$result = $this->worker_model->view_worker_result($id);

		$data['row'] = $result;

		

		

		$this->load->library('form_validation');

		$this->form_validation->set_rules('worker_level', 'WORKER LEVEL', 'required|integer');

		

		if($this->form_validation->run() == FALSE){			

			if(validation_errors())

			{

				$data["error"] = validation_errors();

			}else{

				$data["error"] = "";

			}

			

			if($this->input->post('worker_id'))

			{

				$data["worker_level"] = $this->input->post('worker_level');

				$data["worker_status"] = $this->input->post('worker_status');	

				$data["worker_app_approved"] = $this->input->post('worker_app_approved');

				$data["worker_background_approved"] = $this->input->post('worker_background_approved');

				

			}else{

				$result = $this->worker_model->view_worker_result($id);

				

				$data["worker_level"] = $result->worker_level;

				$data["worker_status"] = $result->worker_status;

				$data["worker_app_approved"] = $result->worker_app_approved;

				$data["worker_background_approved"] = $result->worker_background_approved;

			}

			

			$data['site_setting'] = site_setting();



			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);

			$this->template->write_view('center',$theme .'/layout/worker/view_worker',$data,TRUE);

			$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);

			$this->template->render(); 

		}else{

			/*$result = $this->worker_model->view_worker_result($id);

		    $data['row'] = $result;

			

			$data['error'] = "";

			$data["worker_level"] = $this->input->post('worker_level');

			$data["worker_status"] = $this->input->post('worker_status');	

			$data["worker_app_approved"] = $this->input->post('worker_app_approved');

			$data["worker_background_approved"] = $this->input->post('worker_background_approved');*/

			

			if($this->input->post('submit')) {

				$data = array('worker_level' => $this->input->post('worker_level'),

						  'worker_status' => $this->input->post('worker_status'),

						  'worker_app_approved' => $this->input->post('worker_app_approved'),

						  'worker_background_approved' => $this->input->post('worker_background_approved')

				);

			

				$this->db->where('worker_id', $this->input->post('worker_id'));

				$this->db->update('worker',$data);

			}



			redirect('worker/list_active_worker/20/0/active');

		}

		

		

	}

	function update_worker()

	{

	

		

	   //echo '<pre>'; print_r($_POST); 

		$data = array('worker_level' => $this->input->post('worker_level'),

				      'worker_status' => $this->input->post('worker_status'),

					  'worker_app_approved' => $this->input->post('worker_app_approved'),

					  'worker_background_approved' => $this->input->post('worker_background_approved')

				);

				// print_r($data); 

		$this->db->where('worker_id', $this->input->post('worker_id'));

		$this->db->update('worker',$data);

		//die();

		redirect('worker/list_worker');

		

	}

	//end view worker



}

?>