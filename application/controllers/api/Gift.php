<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/Format.php';

class Gift extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->load->library('form_validation');
    }

    public function gift_category_list_post()
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
        extract($_POST);
                
        $user_id = $this->input->post('user_id') ? $this->input->post('user_id') : '';

        $data = $this->mdl_common->select_all_result(TBL_GIFT_CAT,'gift_cat_id','DESC');

        if(!empty($data)){
            $response = array(
                'status' => TRUE,
                'message' => 'Gift Category Data Found',
                'data' => $data,
            );
        }else{
            $response = array(
                'status' => FALSE,
                'message' => 'Data Not Found',
                'data' => [],
            );
        }

        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function gifts_by_catid_post()
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

        $this->form_validation->set_rules('start', 'start','required|trim',
            array('required'      => 'Oops ! start required')
        );

        $this->form_validation->set_rules('count', 'count','required|trim',
            array('required'      => 'Oops ! count is required')
        );

        $this->form_validation->set_rules('category_id', 'category_id','required|trim',
            array('required'  => 'Oops ! category id required')
        );

        $this->form_validation->set_error_delimiters('', '');
        if($this->form_validation->run()== false)
        {
            $response['status']= FALSE;
            if(!empty(form_error('start')))$response['message'] =form_error('start');
            if(!empty(form_error('count')))$response['message'] =form_error('count');
            if(!empty(form_error('category_id')))$response['message'] =form_error('category_id');
        }
        else
        {
            extract($_POST);
            
            $user_id = $this->input->post('user_id') ? $this->input->post('user_id') : '';
            $where = array('gift_cat_id'=>$category_id);
            $video_exit = $this->mdl_common->count_total_rows(TBL_GIFT, $where);

            if($video_exit <= 0)
            {
                $response = array(
                    'status' => TRUE,
                    'message' => 'Gift List does not exit',
                );
            }else{
                $where = array('gift_cat_id'=>$category_id);
                $data = $this->mdl_common->select_all_where_result(TBL_GIFT,$where,$start,$count,'gift_id','DESC');
            
                if(!empty($data)){
                    $gift_list = [];
                    $i=0;
                    foreach ($data as $value) {
                        $gift_list[$i]['gift_id'] = $value['gift_id'];
                        $gift_list[$i]['coins'] = $value['coins'];
                        $gift_list[$i]['gift_media'] = $value['gift_media'];
                        $i++;
                    }

                    $response = array(
                        'status' => TRUE,
                        'message' => 'Gift List Found',
                        'data' => $gift_list,
                    );
                }else{
                    $response = array(
                        'status' => FALSE,
                        'message' => 'Data Not Found',
                        'data' => [],
                    );
                }
            }
        }

        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function random_video_post()
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

        extract($_POST);
        
        $data = $this->mdl_common->select_where_result(TBL_VIDEO,$where="",'video_id','RANDOM',1);
    
        if(!empty($data)){
            $video_list['video_id'] = $data['video_id'];
            $video_list['video'] = $data['video'];
            $video_list['thumb_img'] = $data['thumb_img'];
            $video_list['name'] = $data['name'];
            $video_list['country_id'] = $data['country_id'];
            $video_list['bio'] = $data['bio'];
            $video_list['rate'] = $data['rate'];
            $video_list['image_gallery'] = explode(',',$data['image_gallery']);
            $video_list['video_gallery'] = explode(',',$data['video_gallery']);
            $i++;

            $response = array(
                'status' => TRUE,
                'message' => 'Video Data Found',
                'data' => $video_list,
            );
        }else{
            $response = array(
                'status' => FALSE,
                'message' => 'Data Not Found',
                'data' => [],
            );
        }

        $this->response($response, REST_Controller::HTTP_OK);
    }
}
?>