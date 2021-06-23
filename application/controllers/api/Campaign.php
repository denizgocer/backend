<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/Format.php';

class Campaign extends REST_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function campaign_list_post()
    {
        $verify_request_base = verify_request_base();

        if (isset($verify_request_base['status']) && $verify_request_base['status'] == 401) {
            $response = array(
                'status' => 401,
                'message' => 'Unauthorized Access!',
            );
            $this->response($response, 401); 
            exit();
        }
        else
        {
            $this->form_validation->set_rules('device_type', 'device_type', 'required|trim',
                array('required'      => 'Oops ! device type is required.'
            ));
            $this->form_validation->set_error_delimiters('', '');
            if($this->form_validation->run()== false)
            {
                $response['status']= FALSE;
                if(!empty(form_error('device_type')))$response['message'] =form_error('device_type');
            }
            else
            {
                extract($_POST);
                
                $this->db->select("*");
                $this->db->from(TBL_CAMPAIGN);
                $this->db->where("(device_type= $device_type OR device_type=3)", NULL, FALSE);
                $this->db->where('status', 1);
                $this->db->order_by('campaign_id','DESC');
                $query = $this->db->get();
                $campaign_data = $query->result_array();

                $data = [];
                foreach($campaign_data as $k => $value){
                    $data[$k]['campaign_id'] = $value['campaign_id'];
                    $data[$k]['campaign_title'] = $value['title'];
                    if($value['device_type'] == 3){
                        $app_url = explode(',',$value['link']);
                        $andriod_url = $app_url[0];
                        $ios_url = $app_url[1];
                        if($device_type == 1){
                            $device_type = 1;
                            $app_url = $andriod_url;
                        }else if($device_type == 2){
                            $device_type = 2;
                            $app_url = $ios_url;
                        }
                    }else{
                        $app_url = $value['link'];
                    }

                    $data[$k]['button_text'] = $value['button_text'];
                    $data[$k]['description'] = trim($value['description']);
                    $data[$k]['icon'] = $value['icon'];
                    $data[$k]['app_url'] = $app_url;
                    $data[$k]['banner_image'] = $value['banner_image'];
                    $data[$k]['interestial_image'] = $value['interestial_image'];
                    $data[$k]['rewarded_video'] = $value['rewarded_video'];
                    $data[$k]['status'] = $value['status'];
                
                }

                $response = array(
                    'status' => TRUE,
                    'message' => 'Campaign get successfully',
                    'data' => $data,
                );
            }
        }

        $this->response($response, REST_Controller::HTTP_OK);
    }


    public function clicks_increase_post()
    {
        $verify_request_base = verify_request_base();

        if (isset($verify_request_base['status']) && $verify_request_base['status'] == 401) {
            $response = array(
                'status' => 401,
                'message' => 'Unauthorized Access!',
            );
            $this->response($response, 401); 
            exit();
        }
        else
        {
            $this->form_validation->set_rules('campaign_id', 'campaign_id', 'required|trim',
                array('required'      => 'Oops ! campaign id is required.'
            ));
            $this->form_validation->set_rules('device_type', 'device_type', 'required|trim',
                array('required'      => 'Oops ! device type is required.'
            ));
            $this->form_validation->set_error_delimiters('', '');
            if($this->form_validation->run()== false)
            {
                $response['status']= FALSE;
                if(!empty(form_error('campaign_id')))$response['message'] =form_error('campaign_id');
                if(!empty(form_error('device_type')))$response['message'] =form_error('device_type');
            }
            else
            {
                extract($_POST);

                $where = array('campaign_id'=>$campaign_id,'device_type'=>$device_type);
                $campaign_data = $this->mdl_common->select_where_result(TBL_CAMPAIGN_ANALYTICS,$where);
                if(!empty($campaign_data)){
                    $data['clicks'] = $campaign_data['clicks']+1;
    
                    $update = $this->mdl_common->update(TBL_CAMPAIGN_ANALYTICS ,$where, $data);
                }else{
                    $data['campaign_id'] = $campaign_id;
                    $data['device_type'] = $device_type;
                    $data['clicks'] = 1;
    
                    $insert = $this->mdl_common->insert(TBL_CAMPAIGN_ANALYTICS, $data);
                }               
                
                $response = array(
                    'status' => TRUE,
                    'message' => 'Increase Clicks successfully'
                );
            }
        }

        $this->response($response, REST_Controller::HTTP_OK);
    }

    
}
?>