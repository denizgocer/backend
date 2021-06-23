<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends MX_Controller {

    public function __construct(){
        parent::__construct();
        $this->mdl_common->is_admin_logged_in(1);
	}

	public function viewSendNotification()
	{

		$data=array(
            'page_title'=>'Notification',
            'sub_title'=>'Send Notification',
            'main_content'=>'send_notification',
            'JS'=>array('assets/pages/js/notification.js')
        );  
        $this->load->view('Layout/template',$data);	
	}

	public function sendNotification()
	{
		$notification_topic = $this->input->post('notification_topic');
		$notification_title = $this->input->post('notification_title');
		$notification_message = $this->input->post('notification_message');

		$notify_image = "";

		if(!empty($_FILES['notify_image']['name']))
        {     

			$config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|jfif|webp';
            $config['file_name'] = preg_replace("/[^a-z0-9\_\-\.]/i", '', basename(rand().$_FILES['notify_image']['name']));
            
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('notify_image')){

                $uploadData = $this->upload->data();
                $notify_image = $uploadData['file_name'];

            }else{
                $response = array(
                    'status' => FALSE,
                    'message' => $this->upload->display_errors()
                );
                echo json_encode($response);
                exit;
            }
        }
				                
		$url = 'https://fcm.googleapis.com/fcm/send';
		$notification = array('title' =>$notification_title , 'body' => $notification_message, 'icon'=>DEFAULT_IMAGE_URL.$notify_image, 'sound' => 'default', 'badge' => '1');
		$fields = array('to' => '/topics/'.$notification_topic, 'notification' => $notification,'priority'=>'high');

		$headers = array(
			'Content-Type:application/json',
			'Authorization:key='.FCM_TOKEN
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

		if($result){

			$response['success'] = 1;
			$response['message'] = "Successfully Send Notification";
		} else {
			$response['success'] = 0;
			$response['message'] = "Error While Send Notification";
		}
		echo json_encode($response);
	}
}