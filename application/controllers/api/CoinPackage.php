<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/Format.php';

class CoinPackage extends REST_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function coin_packge_list_get()
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
            
        $data = $this->db->get(TBL_COIN_PKG)->result_array();
        
        if(!empty($data)){
            $response = array(
                'status' => TRUE,
                'message' => 'Coin Package Data Found',
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

    public function offer_coin_packge_list_get()
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
            
        $data = $this->db->get(TBL_COIN_PKG_OFFER)->result_array();
        
        if(!empty($data)){
            $response = array(
                'status' => TRUE,
                'message' => 'Offer Coin Package Data Found',
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

    public function branding_image_list_get()
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
            
        $data = $this->db->get(TBL_BRANDING_IMG)->result_array();
        
        if(!empty($data)){
            $response = array(
                'status' => TRUE,
                'message' => 'Branding Image Data Found',
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
}
?>