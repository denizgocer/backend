<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends MX_Controller {

    public function __construct(){
        parent::__construct();
        $this->mdl_common->is_admin_logged_in(1);
        $this->load->model('Chat_Model','mdl_country');
	}
    
    public function ViewListProfile(){

        $total_chat_profile = $this->mdl_common->count_total_rows(TBL_CHAT_PROFILE);
        $data=array(
            'page_title'=>'Chat Profile',
            'sub_title'=>'Chat Profile List',
            'main_content'=>'list_chat_profile',
            'total_chat_profile'=>$total_chat_profile,
        );  
        $this->load->view('Layout/template',$data);	
    }
    
    public function CheckExistChatProfile()
	{
		$name = $this->input->post('name');
		$profile_id = $this->input->post('profile_id');

		if(!empty($profile_id)){
            $this->db->where('name',$name);
            $this->db->where('profile_id','!=',$profile_id);
            $checkCountry = $this->db->get(TBL_CHAT_PROFILE)->result_array();
		}else{
            $this->db->where('name',$name);
            $checkCountry = $this->db->get(TBL_CHAT_PROFILE)->result_array();
		}

		if(!empty($checkCountry)) {
			echo json_encode(FALSE);
		}else{
			echo json_encode(TRUE);
		}
    }

    public function addUpdateChatProfile(){
        $name = $this->input->post('name');
        $bio = $this->input->post('bio');
		$profile_id = $this->input->post('profile_id');

        if(!empty($_FILES['profile_image']['name']))
        {     
           
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|jfif|webp';
            $config['file_name'] = preg_replace("/[^a-z0-9\_\-\.]/i", '', basename(rand().$_FILES['profile_image']['name']));
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('profile_image')){

                $uploadData = $this->upload->data();
                $profile_image = $uploadData['file_name'];

            }else{
                $response = array(
                    'status' => FALSE,
                    'message' => $this->upload->display_errors()
                );
                echo json_encode($response);
                exit;
            }
            $data['image'] = $profile_image;
        }
        
        $data['name'] = $name;
        $data['bio'] = $bio;
        
		if(!empty($profile_id)){
            $data['updated_at'] = date('Y-m-d h:i:s');
            $this->db->where('profile_id', $profile_id);
            $result=$this->db->update(TBL_CHAT_PROFILE,$data); 
			$msg = "Update";
			$response['flag'] = 2;
		}else{
            $result = $this->db->insert(TBL_CHAT_PROFILE, $data); 
            $profile_id = $this->db->insert_id();
			$msg = "Add";
			$response['flag'] = 1;
		}
        
        $total_chat_profile = $this->mdl_common->count_total_rows(TBL_CHAT_PROFILE);
        
		if ($result) {
            $response['success'] = 1;
			$response['message'] = "Successfully ".$msg." Chat Profile";
			$response['total_chat_profile'] = $total_chat_profile;
		} else {
            $response['success'] = 0;
			$response['message'] = "Error While ".$msg." Chat Profile";
			$response['total_chat_profile'] = 0;
		}
		echo json_encode($response);
	}

    public function ViewListMessage(){

        $total_chat_message = $this->mdl_common->count_total_rows(TBL_CHAT_MSG);
        $data=array(
            'page_title'=>'Chat Profile',
            'sub_title'=>'Chat Profile List',
            'main_content'=>'list_chat_message',
            'total_chat_message'=>$total_chat_message,
        );  
        $this->load->view('Layout/template',$data);	
    }

    public function addUpdateChatMessage(){
        $message_type = $this->input->post('message_type');
        $content = $this->input->post('content');
		$message_id = $this->input->post('message_id');
        if($message_type == 1){
            if(!empty($_FILES['message_image']['name']))
            {     
            
                $config['upload_path'] = 'uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|jfif|webp';
                $config['file_name'] = preg_replace("/[^a-z0-9\_\-\.]/i", '', basename(rand().$_FILES['message_image']['name']));
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('message_image')){

                    $uploadData = $this->upload->data();
                    $message_image = $uploadData['file_name'];

                }else{
                    $response = array(
                        'status' => FALSE,
                        'message' => $this->upload->display_errors()
                    );
                    echo json_encode($response);
                    exit;
                }
                $data['message_file_text'] = $message_image;
            }

            $data['type'] = $message_type;
            $data['content'] = $content ? $content : "";
            
            if(!empty($message_id)){
                $data['updated_at'] = date('Y-m-d h:i:s');
                $this->db->where('message_id', $message_id);
                $result=$this->db->update(TBL_CHAT_MSG,$data); 
                $msg = "Update";
                $response['flag'] = 2;
            }else{
                $result = $this->db->insert(TBL_CHAT_MSG, $data); 
                $message_id = $this->db->insert_id();
                $msg = "Add";
                $response['flag'] = 1;
            }

        }else if($message_type == 2){
            if(!empty($_FILES['message_voice']['name']))
            {     
            
                $config['upload_path'] = 'uploads/';
                $config['allowed_types'] = '*';
                $config['file_name'] = preg_replace("/[^a-z0-9\_\-\.]/i", '', basename(rand().$_FILES['message_voice']['name']));
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('message_voice')){

                    $uploadData = $this->upload->data();
                    $message_voice = $uploadData['file_name'];

                }else{
                    $response = array(
                        'status' => FALSE,
                        'message' => $this->upload->display_errors()
                    );
                    echo json_encode($response);
                    exit;
                }
                $data['message_file_text'] = $message_voice;
            }

            
            $data['type'] = $message_type;
            
            if(!empty($message_id)){
                $data['updated_at'] = date('Y-m-d h:i:s');
                $this->db->where('message_id', $message_id);
                $result=$this->db->update(TBL_CHAT_MSG,$data); 
                $msg = "Update";
                $response['flag'] = 2;
            }else{
                $result = $this->db->insert(TBL_CHAT_MSG, $data); 
                $message_id = $this->db->insert_id();
                $msg = "Add";
                $response['flag'] = 1;
            }

        }else{
            $message_text = $this->input->post('message_text');
            if(!empty($message_id)){
                $data['type'] = $message_type;
                $data['message_file_text'] = $message_text;
                $data['updated_at'] = date('Y-m-d h:i:s');
                $this->db->where('message_id', $message_id);
                $result=$this->db->update(TBL_CHAT_MSG,$data); 
                $msg = "Update";
                $response['flag'] = 2;
            }else{
                $message_text = explode(',', $message_text);
                foreach($message_text as $val){
                    $data['type'] = $message_type;
                    $data['message_file_text'] = $val;
                    $result = $this->db->insert(TBL_CHAT_MSG, $data); 
                }
                $msg = "Add";
                $response['flag'] = 1;
            }
        }

        
        $total_chat_message = $this->mdl_common->count_total_rows(TBL_CHAT_MSG);
        
		if ($result) {
            $response['success'] = 1;
			$response['message'] = "Successfully ".$msg." Chat Message";
			$response['total_chat_message'] = $total_chat_message;
		} else {
            $response['success'] = 0;
			$response['message'] = "Error While ".$msg." Chat Message";
			$response['total_chat_message'] = 0;
		}
		echo json_encode($response);
	}

    public function showChatProfileList()
    {

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
            $this->db->limit($length,$start);
            $this->db->order_by('profile_id','DESC');
            $ChatProfileData = $this->db->get(TBL_CHAT_PROFILE)->result();
		}
		else {
            $this->db->where("profile_id LIKE '%{$search}%' ");
            $this->db->or_where("name LIKE '%{$search}%' ");
            $this->db->or_where("bio LIKE '%{$search}%' ");
            $this->db->limit($length,$start);
            $this->db->order_by('profile_id','DESC');
            $ChatProfileData = $this->db->get(TBL_CHAT_PROFILE)->result();
		}
		$Category = 'chat_profile';
		$data = array();
		if(!empty($ChatProfileData))
		{
			foreach ($ChatProfileData as $rows)
			{

                if($this->session->userdata('admin_id') == 1){ 
                    $disabled = '';
                }else{
                    $disabled = 'disabled';
                }
                if($rows->image){
                    $image = $rows->image;
                    $profile_img = '<img width="50" height="50" src = "'.base_url().DEFAULT_IMAGE_URL.$rows->image.'">'; 
                }else{
                    $image = '';
                    $profile_img = '';
                }
                
				$data[]= array(
                    $rows->name,
                    $rows->bio,
                    $profile_img,
					'<a class="UpdateChatProfile" data-toggle="modal" data-target="#ChatProfileModal" data-id="'.$rows->profile_id.'" data-name="'.$rows->name.'" data-bio="'.$rows->bio.'" data-url="'.base_url().DEFAULT_IMAGE_URL.'" data-media="'.$image.'" '.$disabled.'><i class="i-cl-3 fa fa-edit col-blue font-20 pointer p-l-5 p-r-5"></i></a> <a href="JavaScript:Void(0);" onclick="deletedata(\''.$rows->profile_id.'\',\''.$Category.'\');" class="delete" title="Delete Chat Profile" '.$disabled.'><i class="fa fa-trash text-danger font-20 pointer p-l-5 p-r-5"></i></a>'
				); 
			}
		}
        $totalData = $this->mdl_common->count_total_rows(TBL_CHAT_PROFILE);
		$json_data = array(
			"draw"            => intval($this->input->post('draw')),  
			"recordsTotal"    => intval($totalData),  
			"recordsFiltered" => intval($totalData), 
			"data"            => $data   
			);

		echo json_encode($json_data); 
        exit();

    }

    public function showChatMessageList()
    {

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
            $this->db->limit($length,$start);
            $this->db->order_by('message_id','DESC');
            $ChatMessageData = $this->db->get(TBL_CHAT_MSG)->result();
		}
		else {
            $this->db->where("message_id LIKE '%{$search}%' ");
            $this->db->or_where("type LIKE '%{$search}%' ");
            $this->db->or_where("content LIKE '%{$search}%' ");
            $this->db->limit($length,$start);
            $this->db->order_by('message_id','DESC');
            $ChatMessageData = $this->db->get(TBL_CHAT_MSG)->result();
		}
		$Category = 'chat_message';
		$data = array();
		if(!empty($ChatMessageData))
		{
			foreach ($ChatMessageData as $rows)
			{
                if($this->session->userdata('admin_id') == 1){ 
                    $disabled = '';
                }else{
                    $disabled = 'disabled';
                }

                if($rows->type == 1){
                    $image = $rows->message_file_text;
                    $message_file_text = '<img width="50" height="50" src = "'.base_url().DEFAULT_IMAGE_URL.$rows->message_file_text.'">'; 
                }else if($rows->type == 2){
                    $image = $rows->message_file_text;
                    $message_file_text = '<audio controls> <source src="'.base_url().DEFAULT_IMAGE_URL.$rows->message_file_text.'" type="audio/mpeg"> </audio>';
                }else if($rows->type == 3){
                    $image = $rows->message_file_text;
                    $message_file_text = $rows->message_file_text; 
                }else{
                    $image = '';
                    $message_file_text = '';
                }
                
				$data[]= array(
                    $message_file_text,
                    $rows->content,
					'<a class="UpdateChatMessage" data-toggle="modal" data-target="#ChatMessageModal" data-id="'.$rows->message_id.'" data-type="'.$rows->type.'" data-content="'.$rows->content.'" data-url="'.base_url().DEFAULT_IMAGE_URL.'" data-media="'.$image.'" '.$disabled.'><i class="i-cl-3 fa fa-edit col-blue font-20 pointer p-l-5 p-r-5"></i></a> <a href="JavaScript:Void(0);" onclick="deletedata(\''.$rows->message_id.'\',\''.$Category.'\');" class="delete" title="Delete Chat Message" '.$disabled.'><i class="fa fa-trash text-danger font-20 pointer p-l-5 p-r-5"></i></a>'
				); 
			}
		}
        $totalData = $this->mdl_common->count_total_rows(TBL_CHAT_MSG);
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