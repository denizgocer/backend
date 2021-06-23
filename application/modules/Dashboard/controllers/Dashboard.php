<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {

    public function __construct(){
        parent::__construct();
        $this->mdl_common->is_admin_logged_in(1);
		$this->load->model('Dashboard_Model','mdl_dashboard');
	}

	public function index(){

        $todays_registration = $this->mdl_common->count_total_rows(TBL_USER, array('DATE(created_at)'=>date('Y-m-d')));
        $total_users = $this->mdl_common->count_total_rows(TBL_USER, array());
        $total_media = $this->mdl_common->count_total_rows(TBL_VIDEO, array());
        $total_comment = $this->mdl_common->count_total_rows(TBL_COMMENT, array());
        $total_gift = $this->mdl_common->count_total_rows(TBL_GIFT, array());
        $total_gift_cat = $this->mdl_common->count_total_rows(TBL_GIFT_CAT, array());
        $total_coin_pkg = $this->mdl_common->count_total_rows(TBL_COIN_PKG, array());
        $total_offer_coin_pkg = $this->mdl_common->count_total_rows(TBL_COIN_PKG_OFFER, array());
        $total_branding_img = $this->mdl_common->count_total_rows(TBL_BRANDING_IMG, array());
        $total_campaign = $this->mdl_common->count_total_rows(TBL_CAMPAIGN, array());
        $total_running_campaign = $this->mdl_common->count_total_rows(TBL_CAMPAIGN, array('status'=>1));
        $total_chat_profile = $this->mdl_common->count_total_rows(TBL_CHAT_PROFILE, array());
        $total_chat_message = $this->mdl_common->count_total_rows(TBL_CHAT_MSG, array());

        $data = array(
            'page_title' => 'Dashboard',
            'sub_title' => 'Dashboard',
            'main_content' => 'Dashboard',
            'todays_registration' => $todays_registration,
            'total_users' => $total_users,
            'total_media' => $total_media,
            'total_comment' => $total_comment,
            'total_gift' => $total_gift,
            'total_gift_cat' => $total_gift_cat,
            'total_coin_pkg' => $total_coin_pkg,
            'total_offer_coin_pkg' => $total_offer_coin_pkg,
            'total_branding_img' => $total_branding_img,
            'total_campaign' => $total_campaign,
            'total_running_campaign' => $total_running_campaign,
            'total_chat_profile' => $total_chat_profile,
            'total_chat_message' => $total_chat_message,
        );
        
        $this->load->view('Layout/template', $data);	
    }
    
    public function DeleteData()
    {
        $id = $this->input->post('id');
        $action_type = $this->input->post('action_type');
        if($action_type == "comment")
        {
            $where = array('comment_id'=>$id);
            $update = $this->mdl_common->deletedata(TBL_COMMENT, $where);
        }
        else if($action_type == "country")
        {
            $this->db->where('country_id',$id);
            $data = $this->db->get(TBL_COUNTRY)->row_array();
            unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$data['country_media']);
            $this->db->where('country_id',$id);
            $data1 = $this->db->get(TBL_VIDEO)->row_array();
            
            if($data1){
                unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$data1['video']);
                unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$data1['thumb_img']);
                $image_gallery = explode(',',$data1['image_gallery']);
                foreach($image_gallery as $val){
                    unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$val);
                }
                $video_gallery = explode(',',$data1['video_gallery']);
                foreach($video_gallery as $val){
                    unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$val);
                }
            }
            $where = array('country_id'=>$id);
            $update = $this->mdl_common->deletedata(TBL_COUNTRY, $where);
            $update = $this->mdl_common->deletedata(TBL_VIDEO, $where);
            $update = $this->mdl_common->deletedata(TBL_COMMENT, $where);
        }
        else if($action_type == "video")
        {
            $this->db->where('country_id',$id);
            $data1 = $this->db->get(TBL_VIDEO)->row_array();
            
            if($data1){
                unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$data1['video']);
                unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$data1['thumb_img']);
                $image_gallery = explode(',',$data1['image_gallery']);
                foreach($image_gallery as $val){
                    unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$val);
                }
                $video_gallery = explode(',',$data1['video_gallery']);
                foreach($video_gallery as $val){
                    unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$val);
                }
            }
            $where = array('video_id'=>$id);
            $update = $this->mdl_common->deletedata(TBL_VIDEO, $where);
        }
        else if($action_type == "user")
        {
            $this->db->where('user_id',$id);
            $data = $this->db->get(TBL_USER)->row_array();
            unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$data['user_profile']);
            $where = array('user_id'=>$id);
            $update = $this->mdl_common->deletedata(TBL_USER, $where);
        }
        else if($action_type == "gift")
        {
            $this->db->where('gift_id',$id);
            $data = $this->db->get(TBL_GIFT)->row_array();
            unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$data['gift_media']);
            $where = array('gift_id'=>$id);
            $update = $this->mdl_common->deletedata(TBL_GIFT, $where);
        }
        else if($action_type == "gift_category")
        {
            $this->db->where('gift_cat_id',$id);
            $data = $this->db->get(TBL_GIFT)->row_array();
            unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$data['gift_media']);
            $this->db->where('gift_cat_id',$id);
            $data1 = $this->db->get(TBL_GIFT_CAT)->row_array();
            unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$data1['gift_cat_media']);
            $where = array('gift_cat_id'=>$id);
            $update = $this->mdl_common->deletedata(TBL_GIFT_CAT, $where);
            $update = $this->mdl_common->deletedata(TBL_GIFT, $where);
        }
        else if($action_type == "coin_package")
        {
            $this->db->where('coin_pkg_id',$id);
            $data = $this->db->get(TBL_COIN_PKG)->row_array();
            unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$data['image']);
            $where = array('coin_pkg_id'=>$id);
            $update = $this->mdl_common->deletedata(TBL_COIN_PKG, $where);
        }
        else if($action_type == "offer_coin_package")
        {
            $this->db->where('offer_id',$id);
            $data = $this->db->get(TBL_COIN_PKG_OFFER)->row_array();
            unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$data['image']);
            $where = array('offer_id'=>$id);
            $update = $this->mdl_common->deletedata(TBL_COIN_PKG_OFFER, $where);
        }
        else if($action_type == "branding_image")
        {
            $this->db->where('branding_id',$id);
            $data = $this->db->get(TBL_BRANDING_IMG)->row_array();
            unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$data['image']);
            $where = array('branding_id'=>$id);
            $update = $this->mdl_common->deletedata(TBL_BRANDING_IMG, $where);
        }
        else if($action_type == "campaign")
        {
            $this->db->where('campaign_id',$id);
            $data = $this->db->get(TBL_CAMPAIGN)->row_array();
            unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$data['icon']);
            unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$data['banner_image']);
            unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$data['interestial_image']);
            unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$data['rewarded_video']);
            $where = array('campaign_id'=>$id);
            $update = $this->mdl_common->deletedata(TBL_CAMPAIGN, $where);
        }
        else if($action_type == "chat_profile")
        {
            $this->db->where('profile_id',$id);
            $data = $this->db->get(TBL_CHAT_PROFILE)->row_array();
            unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$data['image']);
            $where = array('profile_id'=>$id);
            $update = $this->mdl_common->deletedata(TBL_CHAT_PROFILE, $where);
        }
        else if($action_type == "chat_message")
        {
            $this->db->where('message_id',$id);
            $data = $this->db->get(TBL_CHAT_MSG)->row_array();
            if($data['type'] != 3){
                unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$data['message_file_text']);
            }
            $where = array('message_id'=>$id);
            $update = $this->mdl_common->deletedata(TBL_CHAT_MSG, $where);
        }

        $total_country = $this->mdl_common->count_total_rows(TBL_COUNTRY);
        $total_comment = $this->mdl_common->count_total_rows(TBL_COMMENT);
        $total_media = $this->mdl_common->count_total_rows(TBL_VIDEO);
        $total_gift = $this->mdl_common->count_total_rows(TBL_GIFT);
        $total_gift_category = $this->mdl_common->count_total_rows(TBL_GIFT_CAT);
        $total_coin_pkg = $this->mdl_common->count_total_rows(TBL_COIN_PKG);
        $total_coin_pkg_offer = $this->mdl_common->count_total_rows(TBL_COIN_PKG_OFFER);
        $total_branding_img = $this->mdl_common->count_total_rows(TBL_BRANDING_IMG);
        $total_campaign = $this->mdl_common->count_total_rows(TBL_CAMPAIGN);
        $total_chat_profile = $this->mdl_common->count_total_rows(TBL_CHAT_PROFILE);
        $total_chat_message = $this->mdl_common->count_total_rows(TBL_CHAT_MSG);
        $total_user = $this->mdl_common->count_total_rows(TBL_USER);

        $response['total_comment'] = $total_comment;
        $response['total_country'] = $total_country;
        $response['total_media'] = $total_media;
        $response['total_gift'] = $total_gift;
        $response['total_gift_category'] = $total_gift_category;
        $response['total_coin_pkg'] = $total_coin_pkg;
        $response['total_coin_pkg_offer'] = $total_coin_pkg_offer;
        $response['total_branding_img'] = $total_branding_img;
        $response['total_campaign'] = $total_campaign;
        $response['total_chat_profile'] = $total_chat_profile;
        $response['total_chat_message'] = $total_chat_message;
        $response['total_user'] = $total_user;

        $response['success'] = 1;
        echo json_encode($response);
    }

}