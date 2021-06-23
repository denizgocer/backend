<?php
class User_Model extends CI_Model{
    
    public function get_user($table,$table2){
        $query = $this->db->select('u.*,r.role_title');
        $this->db->from($table.' as u ');
        $this->db->join($table2.' as r ', ' r.id = u.role_id ', 'left');
        // if($this->session->userdata('admin')['uid'] != 1){
        //     $this->db->where('u.role_id !=',1);
        //     // $this->db->where('u.created_by',$this->session->userdata('staff')['uid']);
        // }
        
        if($this->session->userdata('admin')['uid'] == 1){
            $this->db->where('u.uid !=',$this->session->userdata('admin')['uid']);
        }
        $this->db->where('u.role_id',2);
        $this->db->where('u.is_deleted',0);
        $this->db->order_by("uid", "DESC");
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        return $query->result_array();
    }

    public function insert_user(){

        $id = $this->input->post('hidden_uid');     
        $password = $this->input->post('password');
        $stores = $this->get_store(TBL_STORE);
        if ($id == 0) {

            $data['name'] = $this->input->post('name');
            $data['username'] = $this->input->post('username');
            $data['password'] = $password;
            $data['role_id'] =  2;
            $data['is_superadmin'] = ($this->input->post('store_id_M') == 'M') ? 1 : 0;
            if($this->input->post('store_id_M') == 'M'){
                $store_id = implode(",",$stores);
            }else{
                $store_id = 0;
            }
            $data['store_id'] = $this->input->post('store_id') ? implode(",",$this->input->post('store_id')) : $store_id;
            $data['permission_id'] = $this->input->post('permission') ? implode(",",$this->input->post('permission')) : 0;
            $data['created_by'] = $this->session->userdata('staff')['uid'];

            $result = $this->db->insert(TBL_USER, $data); 

        } else {
            $data = [];
            if($this->input->post('password')){
                $data['password'] = $password;
            }
            $data['name'] = $this->input->post('name');
            $data['username'] = $this->input->post('username');
            $data['role_id'] =  2;
            $data['is_superadmin'] = $this->input->post('store_id_M') == 'M' ? 1 : 0;
            if($this->input->post('store_id_M') == 'M'){
                $store_id = implode(",",$stores);
            }else{
                $store_id = 0;
            }
            $data['store_id'] = $this->input->post('store_id') ? implode(",",$this->input->post('store_id')) : $store_id;
            $data['permission_id'] =   $this->input->post('permission') ? implode(",",$this->input->post('permission')) : 0;
            $data['updated_at'] =  $date = date('Y-m-d h:i:s');
            $data['updated_by'] = $this->session->userdata('staff')['uid'];
            
            $this->db->where('uid', $id);
            $result = $this->db->update(TBL_USER, $data);            
        }
        return $result;
        
    }

    public function UsernameExist($username,$id){
        $query = $this->db->select('*');
        $this->db->from(TBL_USER);
        $this->db->where('username',$username);
        $this->db->where_not_in('uid',$id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function delete_user($id){
        
        $data = array(                
            'is_deleted' => 1,                
        );
        $this->db->where('uid', $id);
        $result = $this->db->update(TBL_USER, $data);  
        return $result;      
    }

    public function GetPermissions($table){
        
        $query = $this->db->get_where($table,array('is_deleted'=>0));
        $permissions = $query->result_array();      

        if(!empty($permissions)){
            foreach($permissions as $mm){
                $mm = (array) $mm;
                if($mm['parent_id'] == 0){
                    foreach($permissions as $sm){
                        
                        $sm = (array) $sm;
                        if($mm['id'] == $sm['parent_id']){
                            $mm['is_parent'] = 1;
                            (array)$mm['subpermission'][] = $sm;
                        }
                    }
                    $customize_arr[] = $mm;
                }
            }
        }

        return $customize_arr;
    }

    public function get_store($table){
       
        $query = $this->db->select('*');
        $this->db->from($table);
        $this->db->where('is_deleted',0);
        $this->db->order_by("store_id", "ASC");
        $query = $this->db->get();
        return $query->result_array();
    }

}