<?php

class Skill_worker extends CI_Controller {

	function Skill_worker()
	{

		 parent::__construct();	

		$this->load->model('skill_worker_model');

	}

	

	function index()
	{
		redirect('worker/list_worker');

	}

	
	
	function get_ajax_sort_list($city_id)
	{
		if($this->session->userdata['admin_id']=="")
		{
			echo 'login_failed';
		}
		
		else
		{
			$str='';
			
			if($city_id=='all' || $city_id=='' || $city_id==0)
			{
			
				$str.= '<ul>';
				
				$all_categories=get_parent_category();
				
				if($all_categories)
				{
				   
				   $cnt_cat=0;
                	
					foreach($all_categories as $all_cats)
					{
					
					
						$category_image=front_base_url().'upload/category/no_image.png';

		
						if($all_cats->category_image!='') 
						{  
						
							if(file_exists(base_path().'upload/category/'.$all_cats->category_image)) 
							{ 
								
								$category_image=front_base_url().'upload/category/'.$all_cats->category_image;
							
							}
							
						}
					
					
					
              		$str.='<li>';
			
              $str.='<img src="'.$category_image.'" width="50" height="50"  />
				<h1>';
				
				$str.=anchor('skill_worker/lists/'.$all_cats->task_category_id,ucfirst($all_cats->category_name),' style="color:#FFFFFF;"');
				
				$parent_count=get_skill_worker($all_cats->task_category_id);
				
				 $str.='('.$parent_count.')</h1>';
				
                
                 $sub=sub_category($all_cats->task_category_id);
				
						if($sub)
						{
							foreach($sub as $sub_cats)
							{
							
							$child_count=get_skill_worker($sub_cats->task_category_id);
					
                    
       $str.='<h2>'.anchor('skill_worker/lists/'.$sub_cats->task_category_id,ucfirst($sub_cats->category_name)).'('.$child_count.')</h2>';
               
               }  } 
             
			 $str.='<div style="clear:both;"></div>
                
                </li>';
                
                
            		
              $cnt_cat++;    if($cnt_cat>4) { $cnt_cat=0; $str.="</ul><ul>"; }
					
				 }
			
			 } 
            
                 
               $str.=" </ul>";
                
           }
           
           else
           {
           	
           		
			
				$str.= '<ul>';
				
				$all_categories=get_parent_category();
				
				if($all_categories)
				{
				   
				   $cnt_cat=0;
                	
					foreach($all_categories as $all_cats)
					{
					
					
						$category_image=front_base_url().'upload/category/no_image.png';

		
						if($all_cats->category_image!='') 
						{  
						
							if(file_exists(base_path().'upload/category/'.$all_cats->category_image)) 
							{ 
								
								$category_image=front_base_url().'upload/category/'.$all_cats->category_image;
							
							}
							
						}
					
					
					
              		$str.='<li>';
			
              $str.='<img src="'.$category_image.'" width="50" height="50"  />
				<h1>';
				
				$str.=anchor('skill_worker/search_lists/'.$all_cats->task_category_id.'/20/city/'.$city_id,ucfirst($all_cats->category_name),' style="color:#FFFFFF;"');
	
				
				$parent_count=get_skill_worker($all_cats->task_category_id,$city_id);
				
				 $str.='('.$parent_count.')</h1>';
				
                
                 $sub=sub_category($all_cats->task_category_id);
				
						if($sub)
						{
							foreach($sub as $sub_cats)
							{
							
							$child_count=get_skill_worker($sub_cats->task_category_id,$city_id);
					
                    
       $str.='<h2>'.anchor('skill_worker/search_lists/'.$sub_cats->task_category_id.'/20/city/'.$city_id,ucfirst($sub_cats->category_name)).'('.$child_count.')</h2>';
               
               }  } 
             
			 $str.='<div style="clear:both;"></div>
                
                </li>';
                
                
            		
              $cnt_cat++;    if($cnt_cat>4) { $cnt_cat=0; $str.="</ul><ul>"; }
					
				 }
			
			 } 
            
                 
               $str.=" </ul>";
                
           
           
           }     
                
                
              echo $str; 
			
			
		}
		
		exit;
	}
	
	

	function lists($category_id,$limit=20,$offset=0,$msg='')
	{
	
		if($category_id=='' || $category_id==0)
		{
			redirect('home/dashboard');
		}
		

		$theme = getThemeName();

		$this->template->set_master_template($theme .'/template.php');

		

		$check_rights=get_rights('list_worker');

		

		if(	$check_rights==0) {			

			redirect('home/dashboard/no_rights');	

		}



		$this->load->library('pagination');



		//$limit = '10';

		$config['uri_segment']='5';

		$config['base_url'] = base_url().'skill_worker/lists/'.$category_id.'/'.$limit.'/';

		$config['total_rows'] = $this->skill_worker_model->get_total_worker_count($category_id);

		$config['per_page'] = $limit;		

		$this->pagination->initialize($config);		

		$data['page_link'] = $this->pagination->create_links();

		$data['category_id']=$category_id;

		$data['result'] = $this->skill_worker_model->get_worker_result($category_id,$offset, $limit);

		$data['msg'] = $msg;

		$data['offset'] = $offset;

		
		$data['total_rows']=$config['total_rows'];
		

		$data['limit']=$limit;

		$data['option']='';

		$data['keyword']='';

		$data['search_type']='normal';

		

		$data['site_setting'] = site_setting();



		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);

		$this->template->write_view('center',$theme .'/layout/skill_worker/list_worker',$data,TRUE);

		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);

		$this->template->render();

	}

	

	function search_lists($category_id,$limit=20,$option='',$keyword='',$offset=0,$msg='')

	{
		
		
		$theme = getThemeName();

		$this->template->set_master_template($theme .'/template.php');

		

		$check_rights=get_rights('list_worker');

		

		if(	$check_rights==0) {			

			redirect('home/dashboard/no_rights');	

		}

		
		if($category_id=='' || $category_id==0)
		{
			redirect('home/dashboard');
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

		
		if($offset>0)
		{

			$config['uri_segment']='7';
		}
		else
		{
			$config['uri_segment']='6';
		}

		$config['base_url'] = base_url().'skill_worker/search_lists/'.$category_id.'/'.$limit.'/'.$option.'/'.$keyword.'/';

		$config['total_rows'] = $this->skill_worker_model->get_total_search_worker_count($category_id,$option,$keyword);

		$config['per_page'] = $limit;		

		$this->pagination->initialize($config);		

		$data['page_link'] = $this->pagination->create_links();

		

		$data['result'] = $this->skill_worker_model->get_search_worker_result($category_id,$option,$keyword,$offset, $limit);

		$data['msg'] = $msg;

		$data['offset'] = $offset;

		$data['total_rows']=$config['total_rows'];
		$data['category_id']=$category_id;
		
		$data['site_setting'] = site_setting();

		

		$data['limit']=$limit;

		$data['option']=$option;

		$data['keyword']=$keyword;

		$data['search_type']='search';



		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);

		$this->template->write_view('center',$theme .'/layout/skill_worker/list_worker',$data,TRUE);

		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);

		$this->template->render();

	}
	
	
	
	
	function export_skill_worker($category_id,$keyword=0,$time='')

	{

		$theme = getThemeName();

		$this->template->set_master_template($theme .'/template.php');

		

		$check_rights=get_rights('list_worker');

		

		if(	$check_rights==0) {	redirect('home/dashboard/no_rights');	}

		
		
		$cat_detail=$this->db->get_where('trc_task_category',array('task_category_id'=>$category_id));
		
		$cat_info=$cat_detail->row();
		
		$file_name = $cat_info->category_url_name."-skill-worker-".date('d-m-Y').".csv";

		
if($keyword>0)
{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('worker', 'worker.user_id= user.user_id','left');
		$this->db->where('worker.worker_status',1);
		$this->db->where('worker.worker_app_approved',1);
		$this->db->like('worker.worker_task_type',$category_id);
		$this->db->join('worker_cities', 'worker.user_id= worker_cities.user_id','left');
		$this->db->like('worker_cities.city_id',$keyword);		
		$this->db->order_by("worker.worker_id", "desc"); 
		
		$query=$this->db->get();
}
else
{		
		$query = $this->db->query("select * from ".$this->db->dbprefix('worker')." w, ".$this->db->dbprefix('user')." u where w.user_id = u.user_id and w.worker_app_approved=1 and w.worker_status=1 and w.worker_task_type like '%".$category_id."%' order by w.worker_id desc ");		

}	

				 $line = array();
            
                $line[] = 'Name';
				$line[] = 'Email';
				$line[] = 'Mobile';
				$line[] = 'Phone';
				$line[] = 'Postal Code';
				$line[] = 'Cities';
				$line[] = 'Ava. Day';
				$line[] = 'Ava. Time';
           
			
			
            	$array[] = $line;
				
		
		if($query->num_rows()>0)
		{		
				
				
			  foreach ($query->result() as $row)
      		  {
					$line = array();
				   
					$line[] = ucfirst($row->first_name).' '.ucfirst(substr($row->last_name,0,1));
					$line[] = $row->email;
					$line[] = $row->mobile_no;
					$line[] = $row->phone_no;
					$line[] = $row->zip_code;
					
					
					$this->db->select('*');
					$this->db->from('worker_cities wc');
					$this->db->join('city ct','wc.city_id=ct.city_id','left');
					$this->db->where('wc.worker_id',$row->worker_id);
					
					$query2=$this->db->get();
					
					
					
					$cities='';
					
					if($query2->num_rows()>0)
					{
						$res=$query2->result();
						
						foreach($res as $ct)
						{
							$cities.=$ct->city_name.',';
						}
					}
					
					$line[] = $cities;
					
					$line[] = $row->worker_available_day;
					$line[] = $row->worker_available_time;
				   
					$array[] = $line;
				}

		}

	
		
		
	array_to_csv($array, $file_name);
	
	//query_to_csv($query, TRUE,$file_name);
		
			//$delimiter = ",";

		//$newline = "\r\n";
		//$csv= $this->dbutil->csv_from_result($query, $delimiter, $newline);
		

   		// $this->force_download($file_name,$csv);

		//$this->db->cache_delete_all();	

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

	
}

?>