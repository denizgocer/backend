<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CoinPackage extends MX_Controller {

    public function __construct(){
        parent::__construct();
        $this->mdl_common->is_admin_logged_in(1);
        $this->load->model('CoinPackage_Model','mdl_coinpackage');
	}
    
    public function index(){

        $total_coin_pkg = $this->mdl_common->count_total_rows(TBL_COIN_PKG);
        $data=array(
            'page_title'=>'Coin Package',
            'sub_title'=>'Coin Package List',
            'main_content'=>'list_coin_pkg',
            'total_coin_pkg'=>$total_coin_pkg,
        );  
        $this->load->view('Layout/template',$data);	
    }


    public function addUpdateCoinPackage(){
		$coin_amount = $this->input->post('coin_amount');
        $price = $this->input->post('price');
        $playstore_product_id = $this->input->post('playstore_product_id');
        $coin_pkg_id = $this->input->post('coin_pkg_id');

        if(!empty($_FILES['coin_pkg_image']['name']))
        {     
           
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = '*';
            $config['file_name'] = preg_replace("/[^a-z0-9\_\-\.]/i", '', basename(rand().$_FILES['coin_pkg_image']['name']));
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('coin_pkg_image')){

                $uploadData = $this->upload->data();
                $coin_pkg_image = $uploadData['file_name'];

            }else{
                $response = array(
                    'status' => FALSE,
                    'message' => $this->upload->display_errors()
                );
                echo json_encode($response);
                exit;
            }
            $data['image'] = $coin_pkg_image;
        }
        
        $data['coin_amount'] = $coin_amount;
        $data['price'] = $price;
        $data['playstore_product_id'] = $playstore_product_id;
        
		if(!empty($coin_pkg_id)){
            $data['updated_at'] = date('Y-m-d h:i:s');
            $this->db->where('coin_pkg_id', $coin_pkg_id);
            $result=$this->db->update(TBL_COIN_PKG,$data); 
			$msg = "Update";
			$response['flag'] = 2;
		}else{
            $result = $this->db->insert(TBL_COIN_PKG, $data); 
            $coin_pkg_id = $this->db->insert_id();
			$msg = "Add";
			$response['flag'] = 1;
		}
        
        $total_coin_pkg = $this->mdl_common->count_total_rows(TBL_COIN_PKG);
        
		if ($result) {
            $response['success'] = 1;
			$response['message'] = "Successfully ".$msg." CoinPackage";
			$response['total_coin_pkg'] = $total_coin_pkg;
		} else {
            $response['success'] = 0;
			$response['message'] = "Error While ".$msg." CoinPackage";
			$response['total_coin_pkg'] = 0;
		}
		echo json_encode($response);
    }
    
    public function viewListBrandingImage(){

        $total_branding_img = $this->mdl_common->count_total_rows(TBL_BRANDING_IMG);
        $data=array(
            'page_title'=>'Branding Image',
            'sub_title'=>'Branding Image List',
            'main_content'=>'list_branding_img',
            'total_branding_img'=>$total_branding_img,
        );  
        $this->load->view('Layout/template',$data);	
    }

    public function addUpdateBrandingImage(){

        $branding_id = $this->input->post('branding_id');
        $hidden_branding_image = $this->input->post('hidden_branding_image');

        if(!empty($_FILES['branding_image']['name']) && count(array_filter($_FILES['branding_image']['name'])) > 0){ 
            $filesCount = count($_FILES['branding_image']['name']); 
            $i=0;
            foreach($_FILES['branding_image']['name'] as $key => $value){
                if(!empty($_FILES['branding_image']['name'][$i])){ 
                  
                    $_FILES['brand_img']['name']     = $_FILES['branding_image']['name'][$i]; 
                    $_FILES['brand_img']['type']     = $_FILES['branding_image']['type'][$i]; 
                    $_FILES['brand_img']['tmp_name'] = $_FILES['branding_image']['tmp_name'][$i]; 
                    $_FILES['brand_img']['error']     = $_FILES['branding_image']['error'][$i]; 
                    $_FILES['brand_img']['size']     = $_FILES['branding_image']['size'][$i]; 
                        
                    $config['upload_path'] = 'uploads/';
                    $config['allowed_types'] = '*';
                    $config['file_name'] = preg_replace("/[^a-z0-9\_\-\.]/i", '', basename(rand().$_FILES['brand_img']['name']));
                        
                    // Load and initialize upload library 
                    $this->load->library('upload', $config); 
                    $this->upload->initialize($config); 
                        
                    // Upload file to server 
                    if($this->upload->do_upload('brand_img')){ 
                        $uploadData = $this->upload->data();    
                        $branding_image = $uploadData['file_name'];                            
                        $branding_image_arr[] = $uploadData['file_name'];
                    }else{
                        $response = array(
                            'status' => FALSE,
                            'message' => $this->upload->display_errors()
                        );
                        
                    }
                    $i++;
                }
            }
            
        }
        if(!empty($branding_id)){
            if(!empty($branding_image_arr)){
                foreach( $branding_image_arr as $value){
                    $data['image'] = $value;
                    $this->db->where('branding_id', $branding_id);
                    $result = $this->db->update(TBL_BRANDING_IMG, $data); 
                }
            }else{
                $result = 1;
            }            
            $msg = "Update";
            $response['flag'] = 1;
        }else{
            foreach( $branding_image_arr as $value){
                $data['image'] = $value;
                $result = $this->db->insert(TBL_BRANDING_IMG, $data); 
            } 
            $msg = "Add";
            $response['flag'] = 1;
        }
        $total_branding_img = $this->mdl_common->count_total_rows(TBL_BRANDING_IMG);
        
		if ($result) {
            $response['success'] = 1;
			$response['message'] = "Successfully ".$msg." Branding Image";
			$response['total_branding_img'] = $total_branding_img;
		} else {
            $response['success'] = 0;
			$response['message'] = "Error While ".$msg." Branding Image";
			$response['total_branding_img'] = 0;
		}
		echo json_encode($response);
	}

    public function viewListCoinOffer(){

        $total_coin_pkg_offer = $this->mdl_common->count_total_rows(TBL_COIN_PKG_OFFER);
        $data=array(
            'page_title'=>'Offer Coin Packages',
            'sub_title'=>'Offer Coin Packages List',
            'main_content'=>'list_coin_pkg_offer',
            'total_coin_pkg_offer'=>$total_coin_pkg_offer,
        );  
        $this->load->view('Layout/template',$data);	
    }

    public function addUpdateCoinOffer(){
        $coin_amount = $this->input->post('coin_amount');
        $price = $this->input->post('price');
        $playstore_product_id = $this->input->post('playstore_product_id');
        $offer_id = $this->input->post('offer_id');

        if(!empty($_FILES['offer_coin_pkg_image']['name']))
        {     
           
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = '*';
            $config['file_name'] = preg_replace("/[^a-z0-9\_\-\.]/i", '', basename(rand().$_FILES['offer_coin_pkg_image']['name']));
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('offer_coin_pkg_image')){

                $uploadData = $this->upload->data();
                $offer_coin_pkg_image = $uploadData['file_name'];

            }else{
                $response = array(
                    'status' => FALSE,
                    'message' => $this->upload->display_errors()
                );
                echo json_encode($response);
                exit;
            }
            $data['image'] = $offer_coin_pkg_image;
        }
        
        $data['coin_amount'] = $coin_amount;
        $data['price'] = $price;
        $data['playstore_product_id'] = $playstore_product_id;
        
		if(!empty($offer_id)){
            $data['updated_at'] = date('Y-m-d h:i:s');
            $this->db->where('offer_id', $offer_id);
            $result=$this->db->update(TBL_COIN_PKG_OFFER,$data); 
			$msg = "Update";
			$response['flag'] = 2;
		}else{
            $result = $this->db->insert(TBL_COIN_PKG_OFFER, $data); 
            $offer_id = $this->db->insert_id();
			$msg = "Add";
			$response['flag'] = 1;
		}
        
        $total_coin_pkg_offer = $this->mdl_common->count_total_rows(TBL_COIN_PKG_OFFER);
        
		if ($result) {
            $response['success'] = 1;
			$response['message'] = "Successfully ".$msg." CoinPackage";
			$response['total_coin_pkg_offer'] = $total_coin_pkg_offer;
		} else {
            $response['success'] = 0;
			$response['message'] = "Error While ".$msg." CoinPackage";
			$response['total_coin_pkg_offer'] = 0;
		}
		echo json_encode($response);
    }
    
    public function showCoinPackageList()
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
            $this->db->order_by($order,$dir);
            $CoinpkgData = $this->db->get(TBL_COIN_PKG)->result();
		}
		else {
            $search = $this->input->post('search'); 

            $this->db->where('coin_pkg_id','LIKE',"%{$search}%");
            $this->db->or_where('coin_amount', 'LIKE',"%{$search}%");
            $this->db->or_where('price', 'LIKE',"%{$search}%");
            $this->db->or_where('playstore_product_id', 'LIKE',"%{$search}%");
            $this->db->limit($length,$start);
            $this->db->order_by($order,$dir);
            $CoinpkgData = $this->db->get(TBL_COIN_PKG)->result();
		}
		$Category = 'coin_package';
		$data = array();
		if(!empty($CoinpkgData))
		{
			foreach ($CoinpkgData as $rows)
			{
                if($this->session->userdata('admin_id') == 1){ 
                    $disabled = '';
                }else{
                    $disabled = 'disabled';
                }
                if($rows->image){
                    $coin_pkg_media = $rows->image;
                    $coin_pkg_img = '<img width="50" height="50" src = "'.base_url().DEFAULT_IMAGE_URL.$rows->image.'">'; 
                }else{
                    $coin_pkg_media = '';
                    $coin_pkg_img = '';
                }
                
				$data[]= array(
                    $coin_pkg_img,
                    $rows->coin_amount,
                    $rows->price,
                    $rows->playstore_product_id,
					'<a class="UpdateCoinPkg" data-toggle="modal" data-target="#CoinPkgModal" data-id="'.$rows->coin_pkg_id.'" data-coin_amount="'.$rows->coin_amount.'" data-price="'.$rows->price.'" data-playstore_id="'.$rows->playstore_product_id.'" data-url="'.base_url().DEFAULT_IMAGE_URL.'" data-media="'.$coin_pkg_media.'" '.$disabled.'><i class="i-cl-3 fa fa-edit col-blue font-20 pointer p-l-5 p-r-5"></i></a> <a href="JavaScript:Void(0);" onclick="deletedata(\''.$rows->coin_pkg_id.'\',\''.$Category.'\');" class="delete" title="Delete Coin Package" '.$disabled.'><i class="fa fa-trash text-danger font-20 pointer p-l-5 p-r-5"></i></a>'
				); 
			}
		}
        $totalData = $this->mdl_common->count_total_rows(TBL_COIN_PKG);
		$json_data = array(
			"draw"            => intval($this->input->post('draw')),  
			"recordsTotal"    => intval($totalData),  
			"recordsFiltered" => intval($totalData), 
			"data"            => $data   
			);

		echo json_encode($json_data); 
        exit();

    }

    public function showBrandingImageList()
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
            $this->db->order_by($order,$dir);
            $BrandingImgData = $this->db->get(TBL_BRANDING_IMG)->result();
		}
		else {
            $search = $this->input->post('search'); 

            $this->db->where('branding_id','LIKE',"%{$search}%");
            $this->db->limit($length,$start);
            $this->db->order_by($order,$dir);
            $BrandingImgData = $this->db->get(TBL_BRANDING_IMG)->result();
		}
		$Category = 'branding_image';
		$data = array();
		if(!empty($BrandingImgData))
		{
			foreach ($BrandingImgData as $rows)
			{
                if($this->session->userdata('admin_id') == 1){ 
                    $disabled = '';
                }else{
                    $disabled = 'disabled';
                }
                if($rows->image){
                    $branding_media = $rows->image;
                    $branding_img = '<img width="50" height="50" src = "'.base_url().DEFAULT_IMAGE_URL.$rows->image.'">'; 
                }else{
                    $branding_media = '';
                    $branding_img = '';
                }
                
				$data[]= array(
                    $branding_img,
					'<a class="UpdateBrandingImg" data-toggle="modal" data-target="#BrandingImgModal" data-id="'.$rows->branding_id.'" data-url="'.base_url().DEFAULT_IMAGE_URL.'" data-media="'.$branding_media.'" '.$disabled.'><i class="i-cl-3 fa fa-edit col-blue font-20 pointer p-l-5 p-r-5"></i></a><a href="JavaScript:Void(0);" onclick="deletedata(\''.$rows->branding_id.'\',\''.$Category.'\');" class="delete" title="Delete Branding Image" '.$disabled.'><i class="fa fa-trash text-danger font-20 pointer p-l-5 p-r-5"></i></a>'
				); 
			}
		}
        $totalData = $this->mdl_common->count_total_rows(TBL_COIN_PKG);
		$json_data = array(
			"draw"            => intval($this->input->post('draw')),  
			"recordsTotal"    => intval($totalData),  
			"recordsFiltered" => intval($totalData), 
			"data"            => $data   
			);

		echo json_encode($json_data); 
        exit();

    }

    public function showCoinOfferList()
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
            $this->db->order_by($order,$dir);
            $CoinpkgData = $this->db->get(TBL_COIN_PKG_OFFER)->result();
		}
		else {
            $search = $this->input->post('search'); 

            $this->db->where('offer_id','LIKE',"%{$search}%");
            $this->db->or_where('coin_amount', 'LIKE',"%{$search}%");
            $this->db->or_where('price', 'LIKE',"%{$search}%");
            $this->db->or_where('playstore_product_id', 'LIKE',"%{$search}%");
            $this->db->limit($length,$start);
            $this->db->order_by($order,$dir);
            $CoinpkgData = $this->db->get(TBL_COIN_PKG_OFFER)->result();
		}
		$Category = 'offer_coin_package';
		$data = array();
		if(!empty($CoinpkgData))
		{
			foreach ($CoinpkgData as $rows)
			{
                if($this->session->userdata('admin_id') == 1){ 
                    $disabled = '';
                }else{
                    $disabled = 'disabled';
                }

                if($rows->image){
                    $coin_pkg_media = $rows->image;
                    $coin_pkg_img = '<img width="50" height="50" src = "'.base_url().DEFAULT_IMAGE_URL.$rows->image.'">'; 
                }else{
                    $coin_pkg_media = '';
                    $coin_pkg_img = '';
                }
                
				$data[]= array(
                    $coin_pkg_img,
                    $rows->coin_amount,
                    $rows->price,
                    $rows->playstore_product_id,
					'<a class="UpdateOfferCoinPkg" data-toggle="modal" data-target="#OfferCoinPkgModal" data-id="'.$rows->offer_id.'" data-coin_amount="'.$rows->coin_amount.'" data-price="'.$rows->price.'" data-playstore_id="'.$rows->playstore_product_id.'" data-url="'.base_url().DEFAULT_IMAGE_URL.'" data-media="'.$coin_pkg_media.'" '.$disabled.'><i class="i-cl-3 fa fa-edit col-blue font-20 pointer p-l-5 p-r-5"></i></a> <a href="JavaScript:Void(0);" onclick="deletedata(\''.$rows->offer_id.'\',\''.$Category.'\');" class="delete" title="Delete Offer Coin Package" '.$disabled.'><i class="fa fa-trash text-danger font-20 pointer p-l-5 p-r-5"></i></a>'
				); 
			}
		}
        $totalData = $this->mdl_common->count_total_rows(TBL_COIN_PKG_OFFER);
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