<?php
/* this model is used to denid common function through the website */
/* put this model in auto load */
class Mdl_common extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}    

  	public function is_admin_logged_in($permission)
	{
		// echo $this->session->userdata('is_logged');die;
		if(empty($this->session->userdata('is_logged'))){
			redirect('admin/login');
		}
	} 

	public function get_data_row($tablename, $where = array(), $field = '*', $ord_field)
	{
		$this->db->select($field);
		$this->db->from($tablename);
		$this->db->order_by($ord_field, "desc");
		$this->db->where($where);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function select_where_result($table, $where="",$order="",$order_by="",$limit=0)
	{
		$this->db->select('*');
		$this->db->from($table);
		if($where){
			$this->db->where($where);
		}
		$this->db->order_by($order,$order_by);
		if($limit){
			$this->db->limit($limit);
		}
		$query = $this->db->get();
		return $query->row_array();
	}

	public function select_all_where_result($table, $where,$start=0,$count=0,$order,$order_by)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		if($count >= 0){
			$this->db->limit($count,$start);
		}
		$this->db->order_by($order,$order_by);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function select_all_result($table,$order,$order_by)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->order_by($order,$order_by);
		$query = $this->db->get();
		return $query->result();
	}

	public function update($table, $where, $data)
	{
		$this->db->where($where);
		return $this->db->update($table, $data);
	}

	public function insert($table, $data)
	{
		return $this->db->insert($table, $data);
	}
	
	public function deletedata($table, $where)
	{
		$this->db->where($where);
		return $this->db->delete($table);
	}
	
	public function count_total_rows($table,$where="")
	{
			$this->db->select('*');
			$this->db->from($table);
			if($where){
				$this->db->where($where);
			}
			$query = $this->db->get();
			return $query->num_rows();
	}

	public function get_random_string($table,$field_code)
	{
        $random_unique  =  sprintf('%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));

		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($field_code,$random_unique);
        $exitData = $this->db->get()->result_array();
        if (!empty($exitData)) {
            $this->get_random_string($table,$field_code);
        }
        return $random_unique;
    }
    
}
?>