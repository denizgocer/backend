<?php

class User_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('email');
	}

	public function check_identity_already($identity)
	{
		$this->db->select('*');
        $this->db->from(TBL_USER);
        $this->db->where('identity',$identity);
        $query = $this->db->get();
        $num_rows = $query->num_rows();
        return $num_rows;
	}

}