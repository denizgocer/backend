<?php

function send_push($fcmtoken,$message,$plateform)
{
    if($plateform == 0)
    {
        $customData =  array("message" =>$message);
        
        $url = 'https://fcm.googleapis.com/fcm/send';

        $api_key = '';

        $fields = array (
            'registration_ids' => array (
                $fcmtoken
            ),
            'data' => $customData
        );

        $headers = array(
            'Content-Type:application/json',
            'Authorization:key='.$api_key
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        // print_r(json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        // print_r($result);
        return $result;
    }
    else
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $api_key = '';

        $title = $message;

        $msg = array ( 'title' => 'this is title', 'body' => 'this is a description');

        $message = array(
            "message" => $title,
            "data" => $message,
        );

        $data = array('registration_ids' => array($fcmtoken));
        $data['data'] = $message;
        $data['notification'] = $msg;
        $data['notification']['sound'] = "default";

        $headers = array(
            'Content-Type:application/json',
            'Authorization:key='.$api_key
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        //echo json_encode($data);
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        // print_r($result);
        return $result;
    }

}

function verify_request_base()
{
    $ci = & get_instance();
    $ci->load->database();

    $ci->load->model('mdl_common');
    $where = array('id'=>1);
    $data = $ci->mdl_common->select_where_result(TBL_ADMIN, $where);            

    $unique_key = $ci->input->get_request_header('Unique-Key');
    // print_r($unique_key);
    if($data['unique_key'] != $unique_key)
    {
        $status = 401;
        $response = array('status' => $status, 'errors' => 'Unauthorized Access!');
        return $response;
        // return $ci->response($response, 401);
        exit();
    }
    else
    {
        $status = 200;
        $response = array('status' => $status, 'errors' => 'Authorized Access!');
        return $response;
        // return $ci->response($response, 200);
        exit();
    }
}

function verify_request()
{
    $ci = & get_instance();
    $ci->load->database();

    // Get all the headers
    $headers = $ci->input->request_headers();
//print_r($headers);
//exit();
    // Extract the token
    $secret_key = $ci->input->get_request_header('Secret-Key');
    if((!isset($secret_key)))
    {
        $status = 401;
        $response = array('status' => $status, 'errors' => 'Unauthorized Access!');
         return $response;
        exit();
    }
    else
    {
        $token = $secret_key;
        
    }

    // Use try-catch
    // JWT library throws exception if the token is not valid
    // try {
        // Validate the token
        // Successfull validation will return the decoded user data else returns false
        $data = AUTHORIZATION::validateToken($token);
        if ($data === false) {
           $status = 401;
            $response = array('status' => $status, 'errors' => 'Unauthorized Access!');
            return $response;
            // return $ci->response($response, 401);
            exit();
        } else {

            $ci = &get_instance();
            $ci->load->model('mdl_common');
            $where = array('token'=>$token);
            $query_count = $ci->mdl_common->count_total_rows(TBL_USER, $where);            

            if($query_count != 1)
            {
                $status = 401;
                $response = array('status' => $status, 'errors' => 'Unauthorized Access!');
                return $response;
                // return $ci->response($response, 401);
                exit();
            }
            else
            {
                $ci = &get_instance();
                $ci->load->model('mdl_common');
                $where = array('token'=>$token);
                $query = $ci->mdl_common-> get_data_row(TBL_USER, $where, $field = '*','user_id');

                $status = 200;
                $response = array('status' => $status, 'errors' => 'Authorized Access!', 'userdata'=>$query);
                return $response;
                // return $ci->response($response, 200);
                exit();
            }

            // return $data;
        }
}

   
?>