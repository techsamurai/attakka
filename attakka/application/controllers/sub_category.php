<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Sub_category extends CI_Controller 
{ 
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');	
		$this->load->helper('common');	
		$this->load->library('session');	   
		$this->load->model('category_model');
		$this->load->model('user_model');
		$this->load->model('sub_category_model');
		
	}
	
	// this method is used for the show list category 
	public function index()
	{
		
		
		// check admin login or not
		validation_login();
		
		$data = array();		
		$data['title'] = "Sub Category List";
		$error = "";
		$message = "";
		$post = $this->input->post();
		
		$table_name = "tbl_sub_category";
		$offset = $this->uri->segment(3);
		if(!$offset)
			$offset=0;
		$data['site_data'] = $this->sub_category_model->get_category_list_with_limit($table_name,$offset);		
		$data['offset'] = $offset;
        $this->load->library('pagination');
        $config['base_url'] = base_url().'sub_category/index/';
		$config['total_rows'] = $this->sub_category_model->count_total_category($table_name);
		$config['per_page'] = PER_PAGE_ADMIN_VIEW;
        $this->pagination->initialize($config);
		$data['site_data_pagination'] = $this->pagination->create_links();
		$data['error'] = $error;
		$data['message'] = $message;
		$this->load->view('admin_template/admin_header',$data);
		$this->load->view('admin_pages/sub_category_list');
		$this->load->view('admin_template/admin_footer');
	}
	
	// this method is used for the active inactive
	function active_inactive()
	{
		$sub_category_id = $this->uri->segment(3);
		$category_status = $this->uri->segment(4);
		$table_name = "tbl_sub_category";
		$update_data = array(
							 "sub_category_id"=>$sub_category_id,
							 "sub_category_status"=>$category_status
							 );
		
		$this->sub_category_model->active_inactive_category($table_name,$update_data,$sub_category_id);
		
		if($category_status==0)
		{
			$this->session->set_flashdata('add', 'sub category inactive successfully!'); 	
			redirect("sub_category");
		}
		if($category_status==1)
		{
			$this->session->set_flashdata('add', 'sub category active successfully!'); 	
			redirect("sub_category");	
		}
		
		
		
	}
	
	
	function add_category()
	{
			// check admin login or not
		validation_login();
		$session_data = get_session_data();
		
		$data = array();		
		$data['title'] = "Add sub Category";
		$error = "";
		$message = "";
		$post = $this->input->post();
		
		$data["catgory_list"] =$this->sub_category_model->get_all_category("tbl_category");
		
		
		//pr($data["catgory_list"] );
		
		
		if($this->input->post('operation')!="")
		{
			
			if($this->input->post('category_id')=="")
			{
				$error .="Please select the category  !<br/>";
			}
			
			
			if($this->input->post('sub_category_name')=="")
			{
				$error .="Please enter the category name !<br/>";
			}else{
				
			$category_name = $this->input->post('sub_category_name');
				
			$table_name = "tbl_sub_category";
			$category_data = $this->sub_category_model->check_category_name_already_exits_or_not($category_name,$table_name);
			
			
				if(!empty($category_data))
				{
					$error .="Category name already exits !<br/>";
				}
					
			}
			
			
			
			
			if($this->input->post('sub_category_description')=="")
			{
				$error .="Please enter the category description !<br/>";
			}
			
			
			if($_FILES['sub_category_image']['name']!="")
			{
				$file_name = time()."-".$_FILES['sub_category_image']['name'];
				$category_data['sub_category_image'] = $file_name;
				$config['file_name'] = $file_name;
				$config['upload_path'] = './upload_image/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '1000';
				$config['max_width']  = '1024';
				$config['max_height']  = '1024';
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('sub_category_image'))
				{
					$upload_error =  $this->upload->display_errors();
					$error .= $upload_error;
					//pr($upload_error);
					//pr($_FILES);
					//die;
					
				}
			
			}else{
				$error .=" Please select image ";	
			}
			
			
			
			if($error=="")
			{
				
				
				$category_data['created_by'] = CATEGORY_CREATED_BY_ADMIN;
				$category_data['creator_id'] = $session_data['admin_id'];
				
				$category_data['category_id'] = $this->input->post("category_id");
				$category_data['sub_category_name'] = $this->input->post("sub_category_name");
				$category_data['sub_category_description'] = $this->input->post("sub_category_description");
				$category_data['sub_category_rules'] = $this->input->post("sub_category_rules");
				$category_data['sub_category_created_date_time'] = date("Y-m-d H:i:s");
				$category_id = $this->sub_category_model->add_category($category_data , "tbl_sub_category");				
				
				//$this->upload_category_image($_FILES,$category_id);
				
				$this->session->set_flashdata('add', 'sub category add successfully!'); 	
				redirect("sub_category");
				
									
			}
				
		}
		
		$data['error'] = $error;
		$data['message'] = $message;
		$this->load->view('admin_template/admin_header',$data);
		$this->load->view('admin_pages/add_sub_category');
		$this->load->view('admin_template/admin_footer');
	}
	
	
	function edit_category()
	{
			// check admin login or not
		validation_login();
		$data = array();
		$data["catgory_list"] = $this->sub_category_model->get_all_category("tbl_category");
		$session_data = get_session_data();
		
				
		$data['title'] = "Edit Category";
		$error = "";
		$message = "";
		$post = $this->input->post();
	
		
		
		if($this->uri->segment(3)=="")
		{
			redirect("category");	
		}
		
		$sub_category_id = $this->uri->segment(3);
		
		$data['category_data'] = $this->sub_category_model->get_category_detail($sub_category_id,"tbl_sub_category");
		
		$category_image_data = $this->sub_category_model->get_category_image_detail($sub_category_id,"tbl_sub_category_image");
		
		$data['category_image_data'] = $category_image_data;
		
		
		if($this->input->post('operation')!="")
		{
			
			if($this->input->post('sub_category_name')=="")
			{
				$error .="Please enter the category name !<br/>";
			}else{
				
			$category_name = $this->input->post('sub_category_name');
				
			$table_name = "tbl_sub_category";
			$category_data = $this->sub_category_model->check_category_name_for_edit_already_exits_or_not($category_name,$table_name,$sub_category_id);
			
			
			//pr($category_data); die;
			
			if(!empty($category_data))
			{
					$error .="Category name already exits !<br/>";
			}
					
				
			}
			
			
			
			if($this->input->post('sub_category_description')=="")
			{
				$error .="Please enter the category description !<br/>";
			}
			
			
				if($_FILES['sub_category_image']['name']!="")
			{
				$file_name = time()."-".$_FILES['sub_category_image']['name'];
				$category_data['sub_category_image'] = $file_name;
				$config['file_name'] = $file_name;
				$config['upload_path'] = './upload_image/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '1000';
				$config['max_width']  = '1024';
				$config['max_height']  = '1024';
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('sub_category_image'))
				{
					$upload_error =  $this->upload->display_errors();
					$error .= $upload_error;
					//pr($upload_error);
					//pr($_FILES);
					//die;
					
				}
			
			}
			
			
			
			if($error=="")
			{
				$category_data['created_by'] = CATEGORY_CREATED_BY_ADMIN;
				$category_data['creator_id'] = $session_data['admin_id'];
				$category_data['sub_category_id'] = $this->uri->segment(3);
				$category_data['sub_category_name'] = $this->input->post("sub_category_name");
				$category_data['sub_category_description'] = $this->input->post("sub_category_description");
				$category_data['sub_category_rules'] = $this->input->post("sub_category_rules");
				$category_data['sub_category_created_date_time'] = date("Y-m-d H:i:s");
				$this->sub_category_model->edit_category($category_data , "tbl_sub_category");		
				//$this->upload_category_image_edit($_FILES,$sub_category_id,$category_image_data);
				$this->session->set_flashdata('add', 'sub category edit successfully!'); 	
				redirect("sub_category");
			}
				
		}
		
		$data['error'] = $error;
		$data['message'] = $message;
		$this->load->view('admin_template/admin_header',$data);
		$this->load->view('admin_pages/edit_sub_category');
		$this->load->view('admin_template/admin_footer');
	}
	
	
	
// this method is used for the upload image
function upload_category_image($category_image,$sub_category_id)
{

	$size_of =  count($category_image['sub_category_image_name']['name']);	
	
	for( $i=0; $i<=$size_of; $i++ )
	{
		
		$category_image_name =  "";
		if(isset($category_image['sub_category_image_name']['name'][$i]))
		{
			$category_image_name =  $category_image['sub_category_image_name']['name'][$i];
		}
		if($category_image_name!="")
		{
			$extension_detail = pathinfo($category_image_name);
			//pr($extension_detail);die;
			$extension = $extension_detail['extension'];
			$file_name = $extension_detail['filename'];
			$new_file_name = time()."-".$file_name.".".$extension;
			$category_image_name_temp = $category_image['sub_category_image_name']['tmp_name'][$i];			
			
			if(move_uploaded_file($category_image_name_temp,"./upload_image/" . $new_file_name))
			{
				$image_data['sub_category_id'] = $sub_category_id;
				$image_data['sub_category_image_name'] = $new_file_name;
				$image_data['sub_category_image_created_date_time'] = date("Y-m-d H:i:s");			
				$this->sub_category_model->add_category_image_detail($image_data,"tbl_sub_category_image");					
			
			}
		}
		
	}
	
}


// this method is used for the upload image
function upload_category_image_edit($category_image,$sub_category_id,$image_data_db)
{

	$size_of =  count($category_image['sub_category_image_name']['name']);	
	$i = 0;
	foreach($image_data_db as $detail_image)
	{
		
		$category_image_name =  "";
		if(isset($category_image['sub_category_image_name']['name'][$i]))
		{
			$category_image_name =  $category_image['sub_category_image_name']['name'][$i];
		}
		if($category_image_name!="")
		{
			$extension_detail = pathinfo($category_image_name);
			//pr($extension_detail);die;
			$extension = $extension_detail['extension'];
			$file_name = $extension_detail['filename'];
			$new_file_name = time()."-".$file_name.".".$extension;
			$category_image_name_temp = $category_image['sub_category_image_name']['tmp_name'][$i];			
			
			if(move_uploaded_file($category_image_name_temp,"./upload_image/" . $new_file_name))
			{
				$image_data['sub_category_id'] = $sub_category_id;
				$image_data['sub_category_image_name'] = $new_file_name;
				$image_data['sub_category_image_created_date_time'] = date("Y-m-d H:i:s");	
				$sub_category_image_id = $detail_image['sub_category_image_id'];
				$this->sub_category_model->edit_category_image_detail($image_data,"tbl_sub_category_image",$sub_category_image_id);
				
				//echo $this->db->last_query();
				
			
			
			}
			
			
		}
		
	$i++;	}
	
}



	function ajax_check_category()
	{
		
		$category_name = $this->input->post("category_name");	
		
		
		if($category_name=="")
		{
		
			$table_name = "tbl_sub_category";
			$category_data = $this->sub_category_model->check_category_name_already_exits_or_not($category_name,$table_name);
			
			if(!empty($category_data))
			{
				echo 1;	
			}else{
				echo 0;	
			}
		}
		
		
		
	}
	
	
	function category_image_list()
	{
		// check admin login or not
		validation_login();
		
		$data = array();		
		$data['title'] = "Upload Sub Category Image";
		$error = "";
		$message = "";
		$post = $this->input->post();
		$category_id = $this->uri->segment(3);
		
		$sub_category_id = $this->uri->segment(3);
		
		$data['category_detail'] = $this->sub_category_model->get_category_detail($sub_category_id,"tbl_sub_category");
		
		
		$table_name = " tbl_sub_category_image";
		$offset = $this->uri->segment(4);
		if(!$offset)
			$offset=0;
		$data['site_data'] = $this->sub_category_model->get_sub_category_image_list_with_limit($table_name,$offset,$category_id);		
		$data['offset'] = $offset;
        $this->load->library('pagination');
        $config['base_url'] = base_url().'sub_category/category_image_list/'.$category_id.'/';
		$config['total_rows'] = $this->sub_category_model->count_total_sub_category_image($table_name,$category_id);
		$config['per_page'] = PER_PAGE_ADMIN_VIEW;
		$config['uri_segment'] = 4;
		
        $this->pagination->initialize($config);
		$data['site_data_pagination'] = $this->pagination->create_links();
		$data['error'] = $error;
		$data['message'] = $message;
		$this->load->view('admin_template/admin_header',$data);
		//$this->load->view('admin_pages/upload_category_image');
		
		$this->load->view('admin_pages/sub_category_image_list');
		$this->load->view('admin_template/admin_footer');
		
	}
	
	function upload_insert()
	{
		//pr($_POST);
		
		if(isset($_POST)) 
		{
			//echo $_POST['name'];
			$fileName = $_POST['name'];
			$sub_category_id = $_POST['sub_category_id'];
			$time = time();
			
		//	mysql_query("INSERT INTO uploadify(filename, filedate) VALUES('$fileName', '$time')");
			//$category_id = $this->uri->segment(3);
			$insert_data = array(
								 "sub_category_id"=>$sub_category_id,
								 "sub_category_image_name"=>$fileName,
								 "sub_category_image_created_date_time"=>date("Y-m-d H:i:s")
							   );			
			$this->db->insert("tbl_sub_category_image",$insert_data);
			$inserted_id = $this->db->insert_id();
			
			if($inserted_id > 0) { // if success
				echo "uploaded file: " . $fileName;
			}
		
		}	
	}
	
	
	function move_file_on_server()
	{
		/*
		Uploadify v2.1.4
		Release Date: November 8, 2010
		
		Copyright (c) 2010 Ronnie Garcia, Travis Nickels
		
		Permission is hereby granted, free of charge, to any person obtaining a copy
		of this software and associated documentation files (the "Software"), to deal
		in the Software without restriction, including without limitation the rights
		to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
		copies of the Software, and to permit persons to whom the Software is
		furnished to do so, subject to the following conditions:
		
		The above copyright notice and this permission notice shall be included in
		all copies or substantial portions of the Software.
		
		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
		IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
		FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
		AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
		LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
		OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
		THE SOFTWARE.
		*/
			if (!empty($_FILES)) 
			{
				$tempFile = $_FILES['Filedata']['tmp_name'];
				//$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
				
				//$targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];
				$time = time();
				$targetFile = "uploads/".$_FILES['Filedata']['name'];
				
				// $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
				// $fileTypes  = str_replace(';','|',$fileTypes);
				// $typesArray = split('\|',$fileTypes);
				// $fileParts  = pathinfo($_FILES['Filedata']['name']);
				
				// if (in_array($fileParts['extension'],$typesArray)) {
					// Uncomment the following line if you want to make the directory if it doesn't exist
					// mkdir(str_replace('//','/',$targetPath), 0755, true);
					
					move_uploaded_file($tempFile,$targetFile);
					echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
				// } else {
				// 	echo 'Invalid file type.';
				// }
			}
	}
		
	
	
	// this method is used for the active inactive
	function active_inactive_category_image()
	{
		$sub_category_image_id = $this->uri->segment(3);
		$sub_category_status = $this->uri->segment(4);
		$sub_category_id = $this->uri->segment(5);
		
		$table_name = "tbl_sub_category_image";
		$update_data = array(
							 "sub_category_image_id"=>$sub_category_image_id,
							 "sub_category_image_status"=>$sub_category_status
							 );
		
		$this->sub_category_model->active_inactive_category_image($table_name,$update_data,$sub_category_image_id);
		
		if($sub_category_status==0)
		{
			$this->session->set_flashdata('add', 'sub category image inactive successfully!'); 	
			redirect("sub_category/category_image_list/".$sub_category_id);
		}
		if($sub_category_status==1)
		{
			$this->session->set_flashdata('add', 'sub category image active successfully!'); 	
			redirect("sub_category/category_image_list/".$sub_category_id);
		}
		
		
		
	}
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */