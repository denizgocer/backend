<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_Model');
    }

    public function showLogin()
	{
        if(!empty($this->session->userdata('is_logged'))){
            redirect('admin/dashboard');
        }else{
            $this->load->view('Login');
        }
       
    }
    
    public function dologin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
    
        $where = array('username' => $username, 'password' => $password);
        $que = $this->Login_Model->get_where_record(TBL_ADMIN, $where);
        
        if (!empty($que)) {
            
            $sessiondata['name'] = $que['username'];
            $sessiondata['email'] = $que['email'];
            $sessiondata['admin_id'] = $que['id'];
            $sessiondata['profile_image'] = base_url().DEFAULT_IMAGE_URL.$que['profile_image'];
            $sessiondata['is_logged'] = 1;
            $this->session->set_userdata($sessiondata);
            redirect('admin/dashboard');
            
        } else {
            $this->session->set_flashdata('error_msg', 'Your Username or Password is Wrong');
            redirect('admin/login');
        }
    }

    public function logout()
    {
        // unset($_SESSION['staff']);
        $this->session->unset_userdata('name'); 
        $this->session->unset_userdata('email'); 
        $this->session->unset_userdata('is_logged');
        redirect('admin/login');
    }


    public function admin_profile()
    {
        $adminid = $this->session->userdata('admin_id');
        $profile = $this->db->query("SELECT * from ".TBL_ADMIN." WHERE id = '".$adminid."'")->row_array();
    
        $data=array(
            'page_title'=>'My Profile',
            'sub_title'=>'My Profile',
            'main_content'=>'admin_profile',
            'profile'=>$profile
        );  
        $this->load->view('Layout/template',$data);	
    }


    public function updateadminprofile()
    {

        $admin_id = $this->input->post('admin_id');
        $admin_name = $this->input->post('admin_name');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $hdn_profile_image = $this->input->post('hdn_profile_image');
        $profile_image = '';
        if(!empty($_FILES['profile_image']['name']))
        {
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = preg_replace("/[^a-z0-9\_\-\.]/i", '', basename(rand().$_FILES['profile_image']['name']));
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('profile_image')){

                $uploadData = $this->upload->data();
                $profile_image = $uploadData['file_name'];

            }else{
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error',$error['error']);
                echo $this->upload->display_errors();
            }
        }

        $data = [];
        if($profile_image){
            $data['profile_image'] = $profile_image;
        }else{
            $data['profile_image'] = $hdn_profile_image;
        }
        $data['username'] = $admin_name;
        $data['email'] = $email;
        $data['password'] = $password;
 
        $where = array(
            'id'=>$admin_id
        );

       $update =  $this->mdl_common->update(TBL_ADMIN, $where, $data);
       if($update){
        $sessiondata['name'] = $admin_name;
        $sessiondata['email'] = $email;
        $sessiondata['profile_image'] = base_url().DEFAULT_IMAGE_URL.$profile_image;
        $this->session->set_userdata($sessiondata);

        $response['admin_name'] = $admin_name;
        $response['admin_email'] = $email;
		$response['admin_profile_url'] = base_url().DEFAULT_IMAGE_URL.$profile_image;
		$response['admin_profile'] = $profile_image;
        $response['status'] = 1;
       }else{
        $response['admin_name'] = "";
        $response['admin_email'] = "";
		$response['admin_profile_url'] = "";
		$response['admin_profile'] = "";
        $response['status'] = 0;
       }
       echo json_encode($response);
    }

}