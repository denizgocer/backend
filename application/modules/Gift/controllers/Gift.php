<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gift extends MX_Controller {

    public function __construct(){
        parent::__construct();
        $this->mdl_common->is_admin_logged_in(1);
        $this->load->model('Gift_Model','mdl_gift');
	}
    
    public function index(){

        $total_gift = $this->mdl_common->count_total_rows(TBL_GIFT);
        $this->db->order_by('gift_cat_id','DESC');
        $GiftCatData = $this->db->get(TBL_GIFT_CAT)->result_array();
        $data=array(
            'page_title'=>'Gift',
            'sub_title'=>'Gift List',
            'main_content'=>'list_gift',
            'total_gift'=>$total_gift,
            'GiftCatData'=>$GiftCatData,
        );  
        $this->load->view('Layout/template',$data);	
    }


    public function addUpdateGift(){
		$coins = $this->input->post('coins');
        $gift_cat_id = $this->input->post('gift_cat_id');
        $gift_id = $this->input->post('gift_id');

        if(!empty($_FILES['gift_media']['name']))
        {     
           
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = '*';
            $config['file_name'] = preg_replace("/[^a-z0-9\_\-\.]/i", '', basename(rand().$_FILES['gift_media']['name']));
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('gift_media')){

                $uploadData = $this->upload->data();
                $gift_media = $uploadData['file_name'];

            }else{
                $response = array(
                    'status' => FALSE,
                    'message' => $this->upload->display_errors()
                );
                echo json_encode($response);
                exit;
            }
            $data['gift_media'] = $gift_media;
        }
        
        $data['coins'] = $coins;
        $data['gift_cat_id'] = $gift_cat_id;
        
		if(!empty($gift_id)){
            $data['updated_at'] = date('Y-m-d h:i:s');
            $this->db->where('gift_id', $gift_id);
            $result=$this->db->update(TBL_GIFT,$data); 
			$msg = "Update";
			$response['flag'] = 2;
		}else{
            $result = $this->db->insert(TBL_GIFT, $data); 
            $gift_id = $this->db->insert_id();
			$msg = "Add";
			$response['flag'] = 1;
		}
        
        $total_gift = $this->mdl_common->count_total_rows(TBL_GIFT);
        
		if ($result) {
            $this->db->where('gift_id', $gift_id);
            $GiftData = $this->db->get(TBL_GIFT)->row_array();

            $response['success'] = 1;
            $response['data'] = $GiftData;
			$response['message'] = "Successfully ".$msg." Gift";
			$response['total_gift'] = $total_gift;
		} else {
            $response['success'] = 0;
            $response['data'] = [];
			$response['message'] = "Error While ".$msg." Gift";
			$response['total_gift'] = 0;
		}
		echo json_encode($response);
    }
    
    public function viewListGiftCategory(){

        $total_gift_category = $this->mdl_common->count_total_rows(TBL_GIFT_CAT);
        $data=array(
            'page_title'=>'Gift Category',
            'sub_title'=>'Gift Category List',
            'main_content'=>'list_gift_category',
            'total_gift_category'=>$total_gift_category,
        );  
        $this->load->view('Layout/template',$data);	
    }

    public function CheckExistGiftCategory()
	{
		$gift_cat_name = $this->input->post('gift_cat_name');
		$gift_cat_id = $this->input->post('gift_cat_id');

		if(!empty($gift_cat_id)){
            $this->db->where('gift_cat_name',$gift_cat_name);
            $this->db->where('gift_cat_id','!=',$gift_cat_id);
            $checkGift = $this->db->get(TBL_GIFT_CAT)->result_array();
		}else{
            $this->db->where('gift_cat_name',$gift_cat_name);
            $checkGift = $this->db->get(TBL_GIFT_CAT)->result_array();
		}

		if(!empty($checkGift)) {
			echo json_encode(FALSE);
		}else{
			echo json_encode(TRUE);
		}
    }

    public function addUpdateGiftCategory(){
		$gift_cat_name = $this->input->post('gift_cat_name');
		$gift_cat_id = $this->input->post('gift_cat_id');

        if(!empty($_FILES['gift_cat_media']['name']))
        {     
           
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = '*';
            $config['file_name'] = preg_replace("/[^a-z0-9\_\-\.]/i", '', basename(rand().$_FILES['gift_cat_media']['name']));
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('gift_cat_media')){

                $uploadData = $this->upload->data();
                $gift_cat_media = $uploadData['file_name'];
            }else{
                $response = array(
                    'status' => FALSE,
                    'message' => $this->upload->display_errors()
                );
                echo json_encode($response);
                exit;
            }
            $data['gift_cat_media'] = $gift_cat_media;
        }
        
        $data['gift_cat_name'] = $gift_cat_name;
        
		if(!empty($gift_cat_id)){
            $data['updated_at'] = date('Y-m-d h:i:s');
            $this->db->where('gift_cat_id', $gift_cat_id);
            $result=$this->db->update(TBL_GIFT_CAT,$data); 
			$msg = "Update";
			$response['flag'] = 2;
		}else{
            $result = $this->db->insert(TBL_GIFT_CAT, $data); 
            $gift_cat_id = $this->db->insert_id();
			$msg = "Add";
			$response['flag'] = 1;
		}
        
        $total_gift_category = $this->mdl_common->count_total_rows(TBL_GIFT_CAT);
        
		if ($result) {
            $this->db->where('gift_cat_id', $gift_cat_id);
            $GiftCatData = $this->db->get(TBL_GIFT_CAT)->row_array();

            $response['success'] = 1;
            $response['data'] = $GiftCatData;
			$response['message'] = "Successfully ".$msg." Gift Category";
			$response['total_gift_category'] = $total_gift_category;
		} else {
            $response['success'] = 0;
            $response['data'] = [];
			$response['message'] = "Error While ".$msg." Gift Category";
			$response['total_gift_category'] = 0;
		}
		echo json_encode($response);
	}

    public function showGiftList()
    {

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
            $this->db->select('g.*, gc.gift_cat_name as gift_cat_name');
            $this->db->from(TBL_GIFT.' as g');
            $this->db->join(TBL_GIFT_CAT.' as gc','gc.gift_cat_id = g.gift_cat_id');
            $this->db->order_by('g.gift_id','DESC');
            $this->db->limit($length,$start);
            $GiftData = $this->db->get()->result();
		}
		else {
            $this->db->select('g.*, gc.gift_cat_name as gift_cat_name');
            $this->db->from(TBL_GIFT.' as g');
            $this->db->join(TBL_GIFT_CAT.' as gc','gc.gift_cat_id = g.gift_cat_id');
            $this->db->where("g.gift_id LIKE '%{$search}%' ");
            $this->db->or_where("gc.gift_cat_name LIKE '%{$search}%' ");
            $this->db->or_where("g.coins LIKE '%{$search}%' ");
            $this->db->order_by('g.gift_id','DESC');
            $this->db->limit($length,$start);
            $GiftData = $this->db->get()->result();
		}
		$Category = 'gift';
		$data = array();
		if(!empty($GiftData))
		{
			foreach ($GiftData as $rows)
			{
                if($this->session->userdata('admin_id') == 1){ 
                    $disabled = '';
                }else{
                    $disabled = 'disabled';
                }

                if($rows->gift_media){
                    $gift_media = $rows->gift_media;
                    $gift_img = '<img width="50" height="50" src = "'.base_url().DEFAULT_IMAGE_URL.$rows->gift_media.'">'; 
                }else{
                    $gift_media = '';
                    $gift_img = '';
                }
                
				$data[]= array(
                    $gift_img,
                    $rows->coins,
                    $rows->gift_cat_name,
					'<a class="UpdateGift" data-toggle="modal" data-target="#GiftModal" data-id="'.$rows->gift_id.'" data-cat_id="'.$rows->gift_cat_id.'" data-coins="'.$rows->coins.'" data-url="'.base_url().DEFAULT_IMAGE_URL.'" data-media="'.$gift_media.'" '.$disabled.'><i class="i-cl-3 fa fa-edit col-blue font-20 pointer p-l-5 p-r-5"></i></a> <a href="JavaScript:Void(0);" onclick="deletedata(\''.$rows->gift_id.'\',\''.$Category.'\');" class="delete" title="Delete Gift" '.$disabled.'><i class="fa fa-trash text-danger font-20 pointer p-l-5 p-r-5"></i></a>'
				); 
			}
		}
        $totalData = $this->mdl_common->count_total_rows(TBL_GIFT);
		$json_data = array(
			"draw"            => intval($this->input->post('draw')),  
			"recordsTotal"    => intval($totalData),  
			"recordsFiltered" => intval($totalData), 
			"data"            => $data   
			);

		echo json_encode($json_data); 
        exit();

    }

    public function showGiftCategoryList()
    {

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
            $this->db->order_by('gift_cat_id','DESC');
            $GiftCatData = $this->db->get(TBL_GIFT_CAT)->result();
		}
		else {
            $search = $this->input->post('search'); 

            $this->db->where('gift_cat_id','LIKE',"%{$search}%");
            $this->db->or_where('gift_cat_name', 'LIKE',"%{$search}%");
            $this->db->limit($length,$start);
            $this->db->order_by('gift_cat_id','DESC');
            $GiftCatData = $this->db->get(TBL_GIFT_CAT)->result();
		}
		$Category = 'gift_category';
		$data = array();
		if(!empty($GiftCatData))
		{
			foreach ($GiftCatData as $rows)
			{

                if($this->session->userdata('admin_id') == 1){ 
                    $disabled = '';
                }else{
                    $disabled = 'disabled';
                }

                if($rows->gift_cat_media){
                    $gift_cat_media = $rows->gift_cat_media;
                    $gift_cat_img = '<img width="50" height="50" src = "'.base_url().DEFAULT_IMAGE_URL.$rows->gift_cat_media.'">'; 
                }else{
                    $gift_cat_media = '';
                    $gift_cat_img = '';
                }
                
				$data[]= array(
                    $rows->gift_cat_name,
                    $gift_cat_img,
					'<a class="UpdateGiftCategory" data-toggle="modal" data-target="#GiftCategoryModal" data-id="'.$rows->gift_cat_id.'" data-name="'.$rows->gift_cat_name.'" data-url="'.base_url().DEFAULT_IMAGE_URL.'" data-media="'.$gift_cat_media.'" '.$disabled.'><i class="i-cl-3 fa fa-edit col-blue font-20 pointer p-l-5 p-r-5"></i></a> <a href="JavaScript:Void(0);" onclick="deletedata(\''.$rows->gift_cat_id.'\',\''.$Category.'\');" class="delete" title="Delete Category" '.$disabled.'><i class="fa fa-trash text-danger font-20 pointer p-l-5 p-r-5"></i></a>'
				); 
			}
		}
        $totalData = $this->mdl_common->count_total_rows(TBL_GIFT);
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