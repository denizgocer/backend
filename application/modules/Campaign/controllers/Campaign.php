<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaign extends MX_Controller {

    public function __construct(){
        parent::__construct();
        $this->mdl_common->is_admin_logged_in(1);
        $this->load->model('Campaign_Model','mdl_campaign');
	}
    
    public function index(){

        $total_campaign = $this->mdl_common->count_total_rows(TBL_CAMPAIGN);
        $data=array(
            'page_title'=>'Campaign',
            'sub_title'=>'Campaign List',
            'main_content'=>'list_campaign',
            'total_campaign'=>$total_campaign,
        );  
        $this->load->view('Layout/template',$data);	
    }
    
    public function ViewAddEditCampaign($id=''){

        if(empty($id)){
            $data=array(
                'page_title'=>'Campaign',
                'sub_title'=>'Add Campaign',
                'main_content'=>'insert_campaign',
            );  
        }else{
            $this->db->where('campaign_id',$id);
            $CampaignData = $this->db->get(TBL_CAMPAIGN)->row_array();
            $data=array(
                'page_title'=>'Campaign',
                'sub_title'=>'Edit Campaign',
                'main_content'=>'update_campaign',
                'CampaignData'=>$CampaignData,
            );  
        }
        if($this->session->userdata('admin_id') == 1){ 
            $this->load->view('Layout/template',$data);	
        }else{
            redirect('admin/dashboard');
        }
    }

    public function ViewCampaign($id=''){

        $this->db->where('campaign_id',$id);
        $CampaignData = $this->db->get(TBL_CAMPAIGN)->row_array();

        $data=array(
            'page_title'=>'Campaign',
            'sub_title'=>'View Campaign',
            'main_content'=>'view_campaign',
            'CampaignData'=>$CampaignData,
        );  
        $this->load->view('Layout/template',$data);	
    }

    public function addUpdateCampaign(){

        $campaign_id = $this->input->post('campaign_id');
        $title = $this->input->post('title');
        $button_text = $this->input->post('button_text');
        $description = $this->input->post('description');
        $device_type = $this->input->post('device_type');
        $andriod_url = $this->input->post('andriod_url');
        $ios_url = $this->input->post('ios_url');
        $action = $this->input->post('action');

        if(count($device_type) == 2){
            $device_type = 3;
            $app_url = $andriod_url.','.$ios_url;
        }else if($device_type[0] == 1){
            $device_type = 1;
            $app_url = $andriod_url;
        }else if($device_type[0] == 2){
            $device_type = 2;
            $app_url = $ios_url;
        }
        
        if(!empty($_FILES['icon']['name']))
        {     
           
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|jfif|webp';
            $config['file_name'] = preg_replace("/[^a-z0-9\_\-\.]/i", '', basename(rand().$_FILES['icon']['name']));
            
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('icon')){

                $uploadData = $this->upload->data();
                $icon = $uploadData['file_name'];

            }else{
                $response = array(
                    'status' => FALSE,
                    'message' => $this->upload->display_errors()
                );
                echo json_encode($response);
                exit;
            }

        }else{
            $icon = $this->input->post('hidden_icon');
        }
 
        if(!empty($_FILES['banner_image']['name']))
        {     
           
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|jfif|webp';
            $config['file_name'] = preg_replace("/[^a-z0-9\_\-\.]/i", '', basename(rand().$_FILES['banner_image']['name']));
            
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('banner_image')){

                $uploadData = $this->upload->data();
                $banner_image = $uploadData['file_name'];

            }else{
                $response = array(
                    'status' => FALSE,
                    'message' => $this->upload->display_errors()
                );
                echo json_encode($response);
                exit;
            }

        }else{
            $banner_image = $this->input->post('hidden_banner_image');
        }
        
        if(!empty($_FILES['interestial_image']['name']))
        {     
           
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|jfif|webp';
            $config['file_name'] = preg_replace("/[^a-z0-9\_\-\.]/i", '', basename(rand().$_FILES['interestial_image']['name']));
            
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('interestial_image')){

                $uploadData = $this->upload->data();
                $interestial_image = $uploadData['file_name'];

            }else{
                $response = array(
                    'status' => FALSE,
                    'message' => $this->upload->display_errors()
                );
                echo json_encode($response);
                exit;
            }

        }else{
            $interestial_image = $this->input->post('hidden_interestial_image');
        }
 
        if(!empty($_FILES['rewarded_video']['name']))
        {     
           
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'mp4|mpeg|mpg|mov|avi|3gp|f4v|webm|vlc';
            $config['file_name'] = preg_replace("/[^a-z0-9\_\-\.]/i", '', basename(rand().$_FILES['rewarded_video']['name']));
            
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('rewarded_video')){

                $uploadData = $this->upload->data();
                $rewarded_video = $uploadData['file_name'];

            }else{
                $response = array(
                    'status' => FALSE,
                    'message' => $this->upload->display_errors()
                );
                echo json_encode($response);
                exit;
            }
        }else{
            $rewarded_video = $this->input->post('hidden_rewarded_video');
        }
            
        $data['title'] = $title;
        $data['button_text'] = $button_text;
        $data['device_type'] = $device_type;
        $data['link'] = $app_url;
        $data['description'] = $description;
        $data['icon'] = $icon;
        $data['banner_image'] = $banner_image;
        $data['interestial_image'] = $interestial_image;
        $data['rewarded_video'] = $rewarded_video;

        if($action == 'update'){
            $data['updated_at'] = date('Y-m-d h:i:s');
            $this->db->where('campaign_id', $campaign_id);
            $result = $this->db->update(TBL_CAMPAIGN,$data); 
			$msg = "Update";
			$response['flag'] = 2;
		}else{
            $data['campaign_id'] = $campaign_id;
            $result = $this->db->insert(TBL_CAMPAIGN, $data); 
            $campaign_id = $this->db->insert_id();
			$msg = "Add";
			$response['flag'] = 1;
        }

		if ($result) {
			$response['success'] = 1;
			$response['message'] = "Successfully ".$msg." Campaign";
		} else {
			$response['success'] = 0;
			$response['message'] = "Error While ".$msg." Campaign";
		}
		echo json_encode($response);
	}

    public function changeCampaignStatus()
    {
        $campaign_id = $this->input->post('campaign_id');
        $status = $this->input->post('status');
        if($status == 1){
            $is_status = 0;
        }else{
            $is_status = 1;
        }
        $data['status'] = $is_status;

        $this->db->where('campaign_id', $campaign_id);
        $update = $this->db->update(TBL_CAMPAIGN, $data);

        $response['status'] = 1;
        echo json_encode($response);   

    }

    public function showCampaignList()
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
            $this->db->select('*');
            $this->db->from(TBL_CAMPAIGN);
            $this->db->order_by('campaign_id','DESC');
            $this->db->limit($length,$start);
            $CampaignData = $this->db->get()->result();

		}else {

            $this->db->select('*');
            $this->db->from(TBL_CAMPAIGN);
            $this->db->or_where("title LIKE '%{$search}%' ");
            $this->db->or_where("button_text LIKE '%{$search}%' ");
            $this->db->or_where("link LIKE '%{$search}%' ");
            $this->db->or_where("icon LIKE '%{$search}%' ");
            $this->db->or_where("discription LIKE '%{$search}%' ");
            $this->db->order_by('campaign_id','DESC');
            $this->db->limit($length,$start);
            $CampaignData = $this->db->get()->result();
        }
    
        $data = array();
        $Category = 'campaign';

        if(!empty($CampaignData))
		{
			foreach ($CampaignData as $rows)
			{
                if($this->session->userdata('admin_id') == 1){ 
                    $disabled = '';
                }else{
                    $disabled = 'disabled';
                }
                

                if ($rows->status == 1) {
                    $checked = 'checked';
                }else{
                    $checked = '';
                }
                $status =  '<label class="switch">
                    <input type="checkbox" class="changeCampaignStatus" data-id="'.$rows->campaign_id.'" data-status="'.$rows->status.'" '.$checked.' '.$disabled.'>
                    <span class="slider round"></span>
                </label>';

    
                if($rows->icon != "")
                {
                    $icon = '<img width="50" height="50" src = "'.base_url().DEFAULT_IMAGE_URL.$rows->icon.'">';       
                }
                else
                {
                    $icon = '';
                }
                
                $adndriod_clicks = $this->db->query('SELECT SUM(clicks) as clicks FROM '.TBL_CAMPAIGN_ANALYTICS.' WHERE campaign_id = '.$rows->campaign_id.' AND device_type = 1 ')->row_array();
                $ios_clicks = $this->db->query('SELECT SUM(clicks) as clicks FROM '.TBL_CAMPAIGN_ANALYTICS.' WHERE campaign_id = '.$rows->campaign_id.' AND device_type = 2 ')->row_array();
           
                if($rows->device_type == 3) {
                    $is_andriod = '<i class="i-cl-6 fa fa-check"></i>';
                    $is_ios = '<i class="i-cl-6 fa fa-check"></i>';
                }else if($rows->device_type == 2){
                    $is_andriod = '<i class="i-cl-1 fa fa-times"></i>';
                    $is_ios = '<i class="i-cl-6 fa fa-check"></i>';
                }else if($rows->device_type == 1){
                    $is_andriod = '<i class="i-cl-6 fa fa-check"></i>';
                    $is_ios = '<i class="i-cl-1 fa fa-times"></i>';
                }else{
                    $is_andriod = '<i class="i-cl-1 fa fa-times"></i>';
                    $is_ios = '<i class="i-cl-1 fa fa-times"></i>';
                }

                $data[]= array(
                    $rows->title,
                    $icon,
                    $adndriod_clicks['clicks'],
                    $ios_clicks['clicks'],
                    $is_andriod,
                    $is_ios,
                    $status,            
                    '<a href="'.base_url().'admin/campaign/ViewCampaign/'.$rows->campaign_id.'" class="view"><i class="i-cl-3 fa fa-eye col-green  font-20 pointer p-l-5 p-r-5"></i></a> <a class="UpdateCampaign" href="'.base_url().'admin/campaign/ViewEditCampaign/'.$rows->campaign_id.'" '.$disabled.'><i class="i-cl-3 fa fa-edit col-blue font-20 pointer p-l-5 p-r-5"></i></a>  <a href="JavaScript:Void(0);" onclick="deletedata(\''.$rows->campaign_id.'\',\''.$Category.'\');" class="delete" title="Delete Campaign" '.$disabled.'><i class="fa fa-trash text-danger font-20 pointer p-l-5 p-r-5"></i></a>'
                );  
            }
        }

        $totalData = $this->mdl_common->count_total_rows(TBL_CAMPAIGN);

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