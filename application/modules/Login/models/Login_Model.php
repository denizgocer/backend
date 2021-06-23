<?php
class Login_Model extends CI_Model
{

    public function get_where_record($table,$where)
    {
        // $query = $this->db->get_where($table, $where);
        // return $query->row_array();

        $query = $this->db->select('u.*');
        $this->db->from($table.' as u ');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row_array();
    }
}
