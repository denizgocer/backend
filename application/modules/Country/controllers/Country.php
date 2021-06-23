<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country extends MX_Controller {

    public function __construct(){
        parent::__construct();
        $this->mdl_common->is_admin_logged_in(1);
        $this->load->model('Country_Model','mdl_country');
	}
    
    public function index(){

        $total_country = $this->mdl_common->count_total_rows(TBL_COUNTRY);
        $data=array(
            'page_title'=>'Country',
            'sub_title'=>'Country List',
            'main_content'=>'list_country',
            'total_country'=>$total_country,
        );  
        $this->load->view('Layout/template',$data);	
    }
    
    public function CheckExistCountry()
	{
		$country = $this->input->post('country');
		$country_id = $this->input->post('country_id');

		if(!empty($country_id)){
            $this->db->where('country',$country);
            $this->db->where('country_id','!=',$country_id);
            $checkCountry = $this->db->get(TBL_COUNTRY)->result_array();
		}else{
            $this->db->where('country',$country);
            $checkCountry = $this->db->get(TBL_COUNTRY)->result_array();
		}

		if(!empty($checkCountry)) {
			echo json_encode(FALSE);
		}else{
			echo json_encode(TRUE);
		}
    }

    public function addUpdateCountry(){
		$country = $this->input->post('country');
		$country_id = $this->input->post('country_id');

        if(!empty($_FILES['country_media']['name']))
        {     
           
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = '*';
            $config['file_name'] = preg_replace("/[^a-z0-9\_\-\.]/i", '', basename(rand().$_FILES['country_media']['name']));
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('country_media')){

                $uploadData = $this->upload->data();
                $country_media = $uploadData['file_name'];

            }else{
                $response = array(
                    'status' => FALSE,
                    'message' => $this->upload->display_errors()
                );
                echo json_encode($response);
                exit;
            }
            $data['country_media'] = $country_media;
        }
        
        $data['country'] = $country;
        
		if(!empty($country_id)){
            $data['updated_at'] = date('Y-m-d h:i:s');
            $this->db->where('country_id', $country_id);
            $result=$this->db->update(TBL_COUNTRY,$data); 
			$msg = "Update";
			$response['flag'] = 2;
		}else{
            $result = $this->db->insert(TBL_COUNTRY, $data); 
            $country_id = $this->db->insert_id();
			$msg = "Add";
			$response['flag'] = 1;
		}
        
        $total_country = $this->mdl_common->count_total_rows(TBL_COUNTRY);
        
		if ($result) {
            $this->db->where('country_id', $country_id);
            $CountryData = $this->db->get(TBL_COUNTRY)->row_array();

            $response['success'] = 1;
            $response['data'] = $CountryData;
			$response['message'] = "Successfully ".$msg." Country";
			$response['total_country'] = $total_country;
		} else {
            $response['success'] = 0;
            $response['data'] = [];
			$response['message'] = "Error While ".$msg." Country";
			$response['total_country'] = 0;
		}
		echo json_encode($response);
	}

    public function showCountryList()
    {

		$columns = array( 
			0 =>'country_id', 
			1 =>'country',
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
            $this->db->order_by('country_id','DESC');
            $CountryData = $this->db->get(TBL_COUNTRY)->result();
		}
		else {
            $this->db->where("country_id LIKE '%{$search}%' ");
            $this->db->or_where("country LIKE '%{$search}%' ");
            $this->db->limit($length,$start);
            $this->db->order_by('country_id','DESC');
            $CountryData = $this->db->get(TBL_COUNTRY)->result();
		}
		$Category = 'country';
		$data = array();
		if(!empty($CountryData))
		{
			foreach ($CountryData as $rows)
			{
   
                if($this->session->userdata('admin_id') == 1){ 
                    $disabled = '';
                }else{
                    $disabled = 'disabled';
                }

                if($rows->country_media){
                    $country_media = $rows->country_media;
                    $country_img = '<img width="50" height="50" src = "'.base_url().DEFAULT_IMAGE_URL.$rows->country_media.'">'; 
                }else{
                    $country_media = '';
                    $country_img = '';
                }
                
				$data[]= array(
                    $rows->country,
                    $country_img,
					'<a class="UpdateCountry" data-toggle="modal" data-target="#CountryModal" data-id="'.$rows->country_id.'" data-name="'.$rows->country.'" data-url="'.base_url().DEFAULT_IMAGE_URL.'" data-media="'.$country_media.'" '.$disabled.'><i class="i-cl-3 fa fa-edit col-blue font-20 pointer p-l-5 p-r-5"></i></a> <a href="JavaScript:Void(0);" onclick="deletedata(\''.$rows->country_id.'\',\''.$Category.'\');" class="delete" title="Delete Category" '.$disabled.'><i class="fa fa-trash text-danger font-20 pointer p-l-5 p-r-5" ></i></a>'
				); 
			}
		}
        $totalData = $this->mdl_common->count_total_rows(TBL_COUNTRY);
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