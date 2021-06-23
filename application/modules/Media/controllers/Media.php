<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends MX_Controller {

    public function __construct(){
        parent::__construct();
        $this->mdl_common->is_admin_logged_in(1);
        $this->load->model('Media_Model','mdl_media');
	}
    
    public function index(){

        $total_media = $this->mdl_common->count_total_rows(TBL_VIDEO);
        $data=array(
            'page_title'=>'Media',
            'sub_title'=>'Media List',
            'main_content'=>'list_media',
            'total_media'=>$total_media,
        );  
        $this->load->view('Layout/template',$data);	
    }
    
    public function ViewAddEditMedia($id=''){

        $this->db->order_by('country_id','DESC');
        $CountryData = $this->db->get(TBL_COUNTRY)->result_array();

        if(empty($id)){
            $data=array(
                'page_title'=>'Video',
                'sub_title'=>'Add Video',
                'main_content'=>'insert_media',
                'CountryData'=>$CountryData,
            );  
        }else{
            $this->db->where('video_id',$id);
            $MediaData = $this->db->get(TBL_VIDEO)->row_array();
            $data=array(
                'page_title'=>'Video',
                'sub_title'=>'Edit Video',
                'main_content'=>'update_media',
                'CountryData'=>$CountryData,
                'MediaData'=>$MediaData,
            );  
        }
        if($this->session->userdata('admin_id') == 1){ 
            $this->load->view('Layout/template',$data);	
        }else{
            redirect('admin/dashboard');
        }
    }

    public function ViewMedia($id=''){

        $this->db->where('video_id',$id);
        $MediaData = $this->db->get(TBL_VIDEO)->row_array();

        $this->db->order_by('country_id','DESC');
        $CountryData = $this->db->get(TBL_COUNTRY)->result_array();

        $data=array(
            'page_title'=>'Video',
            'sub_title'=>'View Video',
            'main_content'=>'view_media',
            'MediaData'=>$MediaData,
            'CountryData'=>$CountryData,
        );  
        $this->load->view('Layout/template',$data);	
    }

    public function addUpdateMedia(){

        $media_name = $this->input->post('media_name');
        $country_id = $this->input->post('country_id');
        $rate = $this->input->post('rate');
        $bio = $this->input->post('bio');
        $media_id = $this->input->post('media_id');
        $hidden_media_images = $this->input->post('hidden_media_images');
        $hidden_media_videos = $this->input->post('hidden_media_videos');
        
        $action = $this->input->post('action');
        
        if(!empty($_FILES['video_file']['name']))
        {     
           
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'mp4|mpeg|mpg|mov|avi|3gp|f4v|webm|vlc';
            $config['file_name'] = preg_replace("/[^a-z0-9\_\-\.]/i", '', basename(rand().$_FILES['video_file']['name']));
            
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('video_file')){

                $uploadData = $this->upload->data();
                $video_file = $uploadData['file_name'];

            }else{
                $response = array(
                    'status' => FALSE,
                    'message' => $this->upload->display_errors()
                );
                echo json_encode($response);
                exit;
            }

        }else{
            $video_file = $this->input->post('hidden_video_file');
        }
 
        if(!empty($_FILES['thumb_image']['name']))
        {     
           
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|jfif|webp';
            $config['file_name'] = preg_replace("/[^a-z0-9\_\-\.]/i", '', basename(rand().$_FILES['thumb_image']['name']));
            
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('thumb_image')){

                $uploadData = $this->upload->data();
                $thumb_image = $uploadData['file_name'];

            }else{
                $response = array(
                    'status' => FALSE,
                    'message' => $this->upload->display_errors()
                );
                echo json_encode($response);
                exit;
            }
        }else{
            $thumb_image = $this->input->post('hidden_thumb_image');
        }

        if(!empty($_FILES['media_images']['name']) && count(array_filter($_FILES['media_images']['name'])) > 0){ 
            $filesCount = count($_FILES['media_images']['name']); 
            $i=0;
            foreach($_FILES['media_images']['name'] as $key => $value){
                if(!empty($_FILES['media_images']['name'][$i])){ 
                  
                    $_FILES['media_img']['name']     = $_FILES['media_images']['name'][$i]; 
                    $_FILES['media_img']['type']     = $_FILES['media_images']['type'][$i]; 
                    $_FILES['media_img']['tmp_name'] = $_FILES['media_images']['tmp_name'][$i]; 
                    $_FILES['media_img']['error']     = $_FILES['media_images']['error'][$i]; 
                    $_FILES['media_img']['size']     = $_FILES['media_images']['size'][$i]; 
                        
                    $config['upload_path'] = 'uploads/';
                    $config['allowed_types'] = 'jpg|jpeg|png|jfif|webp';
                    $config['file_name'] = preg_replace("/[^a-z0-9\_\-\.]/i", '', basename(rand().$_FILES['media_img']['name']));
                        
                    // Load and initialize upload library 
                    $this->load->library('upload', $config); 
                    $this->upload->initialize($config); 
                        
                    // Upload file to server 
                    if($this->upload->do_upload('media_img')){ 
                        $uploadData = $this->upload->data();    
                        $media_images = $uploadData['file_name'];                            
                        $media_images_arr[] = $uploadData['file_name'];
                    }else{
                        $response = array(
                            'status' => FALSE,
                            'message' => $this->upload->display_errors()
                        );
                        
                    }
                    $i++;
                }
            }

            if($hidden_media_images){
				$hdn_media_image = explode(',',$hidden_media_images);
				$image_arr = array_merge($hdn_media_image,$media_images_arr);
				$image_gallery = implode(',', $image_arr);
			}else{
				$image_gallery = implode(',', $media_images_arr);
            }
            
        }else{
			$image_gallery = $hidden_media_images;
		}
        if(!empty($_FILES['media_videos']['name']) && count(array_filter($_FILES['media_videos']['name'])) > 0){ 
            $filesCount = count($_FILES['media_videos']['name']); 
            $i=0;
            foreach($_FILES['media_videos']['name'] as $key => $value){
                if(!empty($_FILES['media_videos']['name'][$i])){ 
                  
                    $_FILES['media_vid']['name']     = $_FILES['media_videos']['name'][$i]; 
                    $_FILES['media_vid']['type']     = $_FILES['media_videos']['type'][$i]; 
                    $_FILES['media_vid']['tmp_name'] = $_FILES['media_videos']['tmp_name'][$i]; 
                    $_FILES['media_vid']['error']     = $_FILES['media_videos']['error'][$i]; 
                    $_FILES['media_vid']['size']     = $_FILES['media_videos']['size'][$i]; 
                        
                    $config['upload_path'] = 'uploads/';
                    $config['allowed_types'] = '*';
                    $config['file_name'] = preg_replace("/[^a-z0-9\_\-\.]/i", '', basename(rand().$_FILES['media_vid']['name']));
                        
                    // Load and initialize upload library 
                    $this->load->library('upload', $config); 
                    $this->upload->initialize($config); 
                        
                    // Upload file to server 
                    if($this->upload->do_upload('media_vid')){ 
                        $uploadData = $this->upload->data();    
                        $media_videos = $uploadData['file_name'];                            
                        $media_videos_arr[] = $uploadData['file_name'];
                    }else{
                        $response = array(
                            'status' => FALSE,
                            'message' => $this->upload->display_errors()
                        );
                        
                    }
                    $i++;
                }
            }

            if($hidden_media_videos){
				$hdn_media_video = explode(',',$hidden_media_videos);
				$video_arr = array_merge($hdn_media_video,$media_videos_arr);
				$video_gallery = implode(',', $video_arr);
			}else{
				$video_gallery = implode(',', $media_videos_arr);
            }
            
        }else{
			$video_gallery = $hidden_media_videos;
        }
        
		$data['video'] = $video_file;
        $data['thumb_img'] = $thumb_image;
        $data['name'] = $media_name;
        $data['country_id'] = $country_id;
        $data['bio'] = $bio;
        $data['rate'] = $rate;
        $data['image_gallery'] = $image_gallery;
        $data['video_gallery'] = $video_gallery;

        if($action == 'update'){
            $data['updated_at'] = date('Y-m-d h:i:s');
            $this->db->where('video_id', $media_id);
            $result=$this->db->update(TBL_VIDEO,$data); 
			$msg = "Update";
			$response['flag'] = 2;
		}else{
            $data['video_id'] = $media_id;
            $result = $this->db->insert(TBL_VIDEO, $data); 
            $media_id = $this->db->insert_id();
			$msg = "Add";
			$response['flag'] = 1;
        }

		if ($result) {
			$response['success'] = 1;
			$response['message'] = "Successfully ".$msg." Video";
		} else {
			$response['success'] = 0;
			$response['message'] = "Error While ".$msg." Video";
		}
		echo json_encode($response);
	}

    public function viewListComment(){

        $total_comment = $this->mdl_common->count_total_rows(TBL_COMMENT);

        $this->db->order_by('country_id','DESC');
        $CountryData = $this->db->get(TBL_COUNTRY)->result_array();

        $data=array(
            'page_title'=>'Comment',
            'sub_title'=>'Comment List',
            'main_content'=>'list_comment',
            'total_comment'=>$total_comment,
            'CountryData'=>$CountryData,
        );  
        $this->load->view('Layout/template',$data);	
    }

    public function addUpdateMediaComment(){
		$comment = $this->input->post('comment');
        $country_id = $this->input->post('country_id');
        $comment_id = $this->input->post('comment_id');
        
		if(!empty($comment_id)){
            $data['comment'] = $comment;
            $data['country_id'] = $country_id;
            $data['updated_at'] = date('Y-m-d h:i:s');
            $this->db->where('comment_id', $comment_id);
            $result=$this->db->update(TBL_COMMENT,$data); 
			$msg = "Update";
			$response['flag'] = 2;
		}else{
            $comments = explode(',',$comment);
            foreach($comments as $val){
                $data['comment'] = $val;
                $data['country_id'] = $country_id;
                $result = $this->db->insert(TBL_COMMENT, $data); 
            }
            
			$msg = "Add";
			$response['flag'] = 1;
		}
        
        $total_comment = $this->mdl_common->count_total_rows(TBL_COMMENT);
        
		if ($result) {
            $response['success'] = 1;
			$response['message'] = "Successfully ".$msg." Comment";
			$response['total_comment'] = $total_comment;
		} else {
            $response['success'] = 0;
			$response['message'] = "Error While ".$msg." Comment";
			$response['total_comment'] = 0;
		}
		echo json_encode($response);
	}

	public function deleteMediaComment(){

		$comment_id = $this->input->post('comment_id');

        $this->db->where('comment_id', $comment_id);
        $result=$this->db->delete(TBL_COMMENT);
         
        $total_country = $this->mdl_common->count_total_rows(TBL_COMMENT);;
		if ($result) {
			$response['success'] = 1;
			$response['message'] = "Successfully Delete Comment";
			$response['total_country'] = $total_country;
		} else {
			$response['success'] = 0;
			$response['message'] = "Error While Delete Comment";
			$response['total_country'] = 0;
		}
		echo json_encode($response);

    }


    public function showMediaList()
    {

        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search = $this->input->post("search");
        $search = $search['value'];
        $recipe_type = $this->input->post("recipe_type");
        $category_id = $this->input->post("category_id");
        $col = 0;
        $dir = $this->input->post('order.0.dir');

        if(empty($search))
		{            
            $this->db->select('v.*, cu.country as country');
            $this->db->from(TBL_VIDEO.' as v');
            $this->db->join(TBL_COUNTRY.' as cu','v.country_id = cu.country_id');
            $this->db->order_by('v.video_id','DESC');
            $this->db->limit($length,$start);
            $MediaData = $this->db->get()->result();

		}else {

            $this->db->select('v.*, cu.country as country');
            $this->db->from(TBL_VIDEO.' as v');
            $this->db->join(TBL_COUNTRY.' as cu','v.country_id = cu.country_id');
            $this->db->where("cu.country LIKE '%{$search}%' ");
            $this->db->or_where("v.name LIKE '%{$search}%' ");
            $this->db->or_where("v.bio LIKE '%{$search}%' ");
            $this->db->order_by('v.video_id','DESC');
            $this->db->limit($length,$start);
            $MediaData = $this->db->get()->result();
        }
    
        $data = array();
        $Category = 'video';

        if(!empty($MediaData))
		{
            
			foreach ($MediaData as $rows)
			{
                if($this->session->userdata('admin_id') == 1){ 
                    $disabled = '';
                }else{
                    $disabled = 'disabled';
                }

                if($rows->video){
                    $video = '<button data-toggle="modal" data-target="#modal-video" data-src="'.base_url().DEFAULT_IMAGE_URL.$rows->video.'" class="btn btn-success text-white" id="playvideomdl" title="Play Video"><i class="fa fa-play" style="font-size: 14px;"></i></button>';
                }else
                {
                    $video = '';
                }

                if($rows->thumb_img){
                    $thumb_img = '<img width="50" height="50" src = "'.base_url().DEFAULT_IMAGE_URL.$rows->thumb_img.'">'; 
                }else
                {
                    $thumb_img = '';
                }

                $data[]= array(
                    $video,
                    $thumb_img,
                    $rows->name,
                    $rows->country,
                    $rows->bio,
                    $rows->rate,               
                    '<a href="'.base_url().'admin/media/ViewMedia/'.$rows->video_id.'" class="view" ><i class="i-cl-3 fa fa-eye col-green  font-20 pointer p-l-5 p-r-5"></i></a> <a class="UpdateMedia" href="'.base_url().'admin/media/ViewEditMedia/'.$rows->video_id.'"  '.$disabled.'><i class="i-cl-3 fa fa-edit col-blue font-20 pointer p-l-5 p-r-5"></i></a>  <a href="JavaScript:Void(0);" onclick="deletedata(\''.$rows->video_id.'\',\''.$Category.'\');" class="delete" title="Delete Media" '.$disabled.'><i class="fa fa-trash text-danger font-20 pointer p-l-5 p-r-5"></i></a>'
                );  
            }
        }

        $totalData = $this->mdl_common->count_total_rows(TBL_VIDEO);

		$json_data = array(
			"draw"            => intval($this->input->post('draw')),  
			"recordsTotal"    => intval($totalData),  
			"recordsFiltered" => intval($totalData), 
			"data"            => $data   
			);

		echo json_encode($json_data); 
        exit();
    }

    public function showMediaCommentList()
    {

		$columns = array( 
			0 =>'comment_id', 
            1 =>'comment',
            1 =>'country',
		);

        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = $this->input->post('order.0.dir');

		if(empty($search))
		{            

            $this->db->select('c.*, cu.country as country');
            $this->db->from(TBL_COMMENT.' as c');
            $this->db->join(TBL_COUNTRY.' as cu','c.country_id = cu.country_id');
            $this->db->order_by('c.country_id','DESC');
            $this->db->limit($length,$start);
            $CommentData = $this->db->get()->result();

		}
		else {

            $this->db->select('c.*, cu.country as country');
            $this->db->from(TBL_COMMENT.' as c');
            $this->db->join(TBL_COUNTRY.' as cu','c.country_id = cu.country_id');
            $this->db->where("cu.country LIKE '%{$search}%' ");
            $this->db->or_where("c.comment LIKE '%{$search}%' ");
            $this->db->order_by('c.country_id','DESC');
            $this->db->limit($length,$start);
            $CommentData = $this->db->get()->result();

		}
		$Category = 'comment';
		$data = array();
		if(!empty($CommentData))
		{
			foreach ($CommentData as $rows)
			{
                if($this->session->userdata('admin_id') == 1){ 
                    $disabled = '';
                }else{
                    $disabled = 'disabled';
                }
                
				$data[]= array(
                    $rows->comment,
                    $rows->country,
					'<a class="UpdateComment" data-toggle="modal" data-target="#CommentModal" data-id="'.$rows->comment_id.'" data-name="'.$rows->comment.'" data-country="'.$rows->country_id.'" '.$disabled.'><i class="i-cl-3 fa fa-edit col-blue font-20 pointer p-l-5 p-r-5"></i></a> <a href="JavaScript:Void(0);" onclick="deletedata(\''.$rows->comment_id.'\',\''.$Category.'\');" class="delete" title="Delete Category" '.$disabled.'><i class="fa fa-trash text-danger font-20 pointer p-l-5 p-r-5"></i></a>'
				); 
			}
		}
        $totalData = $this->mdl_common->count_total_rows(TBL_COMMENT);
		$json_data = array(
			"draw"            => intval($this->input->post('draw')),  
			"recordsTotal"    => intval($totalData),  
			"recordsFiltered" => intval($totalData), 
			"data"            => $data   
			);

		echo json_encode($json_data); 
        exit();

    }

}