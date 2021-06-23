<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MX_Controller {

    public function __construct(){
        parent::__construct();
        $this->mdl_common->is_admin_logged_in(19);
        $this->load->model('User_Model','mdl_user');
	}

	public function index(){
        $total_user = $this->mdl_common->count_total_rows(TBL_USER);
        $data=array(
            'page_title'=>'Users',
            'sub_title'=>'User List',
            'main_content'=>'list_user',
            'total_user'=>$total_user,
        );  
        // echo "<pre>"; print_r($data);die;
        $this->load->view('Layout/template',$data);	
    }

    public function view_user()
    {
        $user_id = base64_decode($this->uri->segment(3));

        $followers_where = array('to_user_id'=>$user_id);
        $data['followers_count'] = $this->mdl_common->count_total_rows('followers', $followers_where);

        $following_where = array('from_user_id'=>$user_id);
        $data['following_count'] = $this->mdl_common->count_total_rows('followers', $following_where);

        $data['total_videos'] = $this->mdl_common->count_total_rows('post', array('user_id'=>$user_id));

        $data['user_data'] = $this->mdl_common->get_data_row('users', array('user_id'=>$user_id), $field = '*', 'user_id');
        
        $data['profile_category_data'] = $this->mdl_common->user_profile_category($user_id);

        $this->load->view('admin/include/header');
        $this->load->view('admin/user/view_user',$data);
        $this->load->view('admin/include/footer');
    }
    
    public function change_status(){
		$status=$this->input->post('status');
		$id=$this->input->post('id');
		
		if($status==1){
	    	$message= 'Successful Enable...';
		}else{
	    	$message= 'Successful Disable...';
        }
        $this->db->where('uid', $id);
        $result=$this->db->update(TBL_USER,['is_active'=>$status]);   
	    echo json_encode(array('message'=>$message,'status'=>$status));
    }

    public function showUserList()
    {

        $columns = array( 
            0=>'user_id',
            1=>'profile',
            2=>'full_name',
            3=>'user_name',
            4=>'user_email',
            5=>'login_type',
            6=>'identity',
            7=>'created_at',
            8=>'status'
		);

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
            $this->db->order_by($order,$dir);
            $UserData = $this->db->get(TBL_USER)->result();
		}
		else {
            $search = $this->input->post('search'); 

            $this->db->where("id LIKE '%{$search}%' ");
			$this->db->or_where("full_name LIKE '%{$search}%' ");
            $this->db->or_where("user_name LIKE '%{$search}%' ");
            $this->db->or_where("user_email LIKE '%{$search}%' ");
            $this->db->or_where("identity LIKE '%{$search}%' ");
            $this->db->limit($length,$start);
            $this->db->order_by($order,$dir);
            $UserData = $this->db->get(TBL_USER)->result();
		}
		$Category = 'user';
		$data = array();
		if(!empty($UserData))
		{
			foreach ($UserData as $rows)
			{

                if ($rows->status == 0) {
                    $status =  '<span class="badge badge-pill badge-danger">De-Active</span>';
                } elseif ($rows->status == 1) {
                    $status =  '<span class="badge badge-pill badge-success">Active</span>';
                } 
    
                $user_id = $rows->user_id;
                if(!empty($rows->user_profile))
                {
                    $profile = '<img height="50px;" width="50px;" src="'.base_url().DEFAULT_IMAGE_URL.$rows->user_profile.'" class="" alt="">';
                }
                else
                {
                    $profile = '<img height="50px;" width="50px;" src="'.base_url().'assets/dist/img/logo.png" class="" alt="">';
                }
    
    
                $data[]= array(
                    $profile,
                    $rows->full_name,
                    $rows->user_name,
                    $rows->user_email,
                    date('Y-m-d',strtotime($rows->created_at)),
                    $status,
                    // '<a href="JavaScript:Void(0);" onclick="deletedata(\''.$rows->user_id.'\',\''.$Type.'\');" class="delete" title="Delete User"><i class="fa fa-trash text-danger font-20 pointer p-l-5 p-r-5"></i></a>'
                );  
			}
		}
        $totalData = $this->mdl_common->count_total_rows(TBL_USER);
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