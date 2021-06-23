<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MX_Controller {

    public function __construct(){
        parent::__construct();
        $this->mdl_common->is_admin_logged_in(1);
        $this->load->model('Settings_Model','mdl_settings');
	}

    
	public function index()
	{
        $SettingData = $this->db->get(TBL_SETTINGS)->row_array();
        $data=array(
            'page_title'=>'Admob',
            'sub_title'=>'Admob List',
			'main_content'=>'view_addupdate_settings',
			'SettingData' => $SettingData
        );  
        $this->load->view('Layout/template',$data);	
	}

	public function addUpdateAdmob(){

        $publisher_id = $this->input->post('publisher_id');
		$banner_id = $this->input->post('banner_id');
		$interestial_id = $this->input->post('interestial_id');
		$rewarded_id = $this->input->post('rewarded_id');
		$id = $this->input->post('hidden_id');
		$data['admob_publisher_id'] = $publisher_id;
		$data['admob_banner_id'] = $banner_id;
		$data['admob_interestial_id'] = $interestial_id;
		$data['admob_rewarded_id'] = $rewarded_id;
		if(!empty($id)){
            $data['updated_at'] = date('Y-m-d h:i:s');
            $this->db->where('id', $id);
            $result=$this->db->update(TBL_SETTINGS,$data); 
			$msg = "Update";
			$response['flag'] = 2;
		}else{
			$result = $this->db->insert(TBL_SETTINGS, $data);        
			$id = $this->db->insert_id();    
			$msg = "Add";
			$response['flag'] = 1;
		}
        
		if ($result) {
			$response['success'] = 1;
			$response['data'] = $id;
			$response['message'] = "Successfully ".$msg." Setting";
		} else {
			$response['success'] = 0;
			$response['data'] = 0;
			$response['message'] = "Error While ".$msg." Setting";
		}
		echo json_encode($response);
	}

	public function addUpdateFacebook(){

		$banner_id = $this->input->post('banner_id');
		$interestial_id = $this->input->post('interestial_id');
		$rewarded_id = $this->input->post('rewarded_id');
		$id = $this->input->post('hidden_id');

		$data['fb_banner_id'] = $banner_id;
		$data['fb_interestial_id'] = $interestial_id;
		$data['fb_rewarded_id'] = $rewarded_id;
		if(!empty($id)){
            $data['updated_at'] = date('Y-m-d h:i:s');
            $this->db->where('id', $id);
            $result=$this->db->update(TBL_SETTINGS,$data); 
			$msg = "Update";
			$response['flag'] = 2;
		}else{
			$result = $this->db->insert(TBL_SETTINGS, $data);        
			$id = $this->db->insert_id();    
			$msg = "Add";
			$response['flag'] = 1;
		}
        
		if ($result) {
			$response['success'] = 1;
			$response['data'] = $id;
			$response['message'] = "Successfully ".$msg." Setting";
		} else {
			$response['success'] = 0;
			$response['data'] = 0;
			$response['message'] = "Error While ".$msg." Setting";
		}
		echo json_encode($response);
	}

	public function addUpdateOther(){

		$video_ad_bonus = $this->input->post('video_ad_bonus');
		$log_in_bonus = $this->input->post('log_in_bonus');
		$refer_friend_bonus = $this->input->post('refer_friend_bonus');
		$seconds_for_ad = $this->input->post('seconds_for_ad');
		$seconds_for_call = $this->input->post('seconds_for_call');
		$razorpay_key_id = $this->input->post('razorpay_key_id');
		$razorpay_key_secret = $this->input->post('razorpay_key_secret');
		$more_apps_url = $this->input->post('more_apps_url');
		$privacy_policy = $this->input->post('privacy_policy');

		$id = $this->input->post('hidden_id');

		$data['video_ad_bonus'] = $video_ad_bonus;
		$data['log_in_bonus'] = $log_in_bonus;
		$data['refer_friend_bonus'] = $refer_friend_bonus;
		$data['seconds_for_ad'] = $seconds_for_ad;
		$data['seconds_for_call'] = $seconds_for_call;
		$data['razorpay_key_id'] = $razorpay_key_id;
		$data['razorpay_key_secret'] = $razorpay_key_secret;
		$data['more_apps_url'] = $more_apps_url;
		$data['privacy_policy'] = $privacy_policy;

		if(!empty($id)){
            $data['updated_at'] = date('Y-m-d h:i:s');
            $this->db->where('id', $id);
            $result=$this->db->update(TBL_SETTINGS,$data); 
			$msg = "Update";
			$response['flag'] = 2;
		}else{
			$result = $this->db->insert(TBL_SETTINGS, $data);        
			$id = $this->db->insert_id();    
			$msg = "Add";
			$response['flag'] = 1;
		}
        
		if ($result) {
			$response['success'] = 1;
			$response['data'] = $id;
			$response['message'] = "Successfully ".$msg." Setting";
		} else {
			$response['success'] = 0;
			$response['data'] = 0;
			$response['message'] = "Error While ".$msg." Setting";
		}
		echo json_encode($response);
	}
}