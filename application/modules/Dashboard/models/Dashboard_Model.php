<?php
class Dashboard_Model extends CI_Model{
    
    public function get_sale($table,$table2,$store_id=""){
        $query = $this->db->select('s.sale_date,s.till_total,s.script_count,s.customer_count,st.short_name,st.color');
        $this->db->from($table.' as s ');
        $this->db->join($table2.' as st ', ' s.store_id = st.store_id', 'left');
        // $this->db->where('sale_date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()');
        $this->db->where('s.store_id',$store_id);
        $this->db->where('s.till_total != ', 0);
        $this->db->where('s.script_count != ', 0);
        $this->db->where('s.customer_count != ', 0);
        $this->db->where('s.is_deleted',0);
        $this->db->order_by("s.sale_date", "DESC");
        $this->db->limit(30);
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }

    public function get_store($table,$store_id=""){
        $query = $this->db->select('*');
        $this->db->from($table);
        if(!empty($store_id)){
            $this->db->where("store_id IN (".$store_id.")",NULL, false);
        }
        $this->db->where('is_deleted',0);
        $this->db->order_by("store_id", "ASC");
        $query = $this->db->get();
        return $query->result_array();
    }
}