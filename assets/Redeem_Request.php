<?php ob_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Redeem_Request extends CI_Controller{

     function __construct(){

        parent::__construct();
        $this->load->database();
        // $this->load->model('admin/User_model','Auser');
        $this->load->model('Common');
    }


    public function redeem_request()
    {
    	$this->load->view('admin/include/header');
    	$this->load->view('admin/redeem_request/redeem_request');
    	$this->load->view('admin/include/footer');
    }


    public function showRedeemRequest()
    {

        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }
        $valid_columns = array(
            0=>'redeem_request_id',
            1=>'redeem_request_type',
            2=>'account',
            3=>'amount',
            4=>'created_date',
            5=>'status'
        );
        if(!isset($valid_columns[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_columns[$col];
        }
        if($order !=null)
        {
            $this->db->order_by($order, $dir);
        }
        
        if(!empty($search))
        {
            $this->db->group_start();
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }
            $this->db->group_end();                
        }

        $this->db->limit($length,$start);
        $this->db->where('status',0);
        $users = $this->db->get("redeem_request");
        $Type = 'redeem_request';
        $data = array();
        foreach($users->result() as $rows)
        {
            if ($rows->status == 0) {
                $status =  '<span class="badge badge-pill badge-warning">Pending</span>';
            } elseif ($rows->status == 1) {
                $status =  '<span class="badge badge-pill badge-success">Completed</span>';
            }

            $userdata = get_row_data('users',array('user_id'=>$rows->user_id));

            $data[]= array(
                $rows->redeem_request_type,
                $rows->account,
                $rows->amount,
                $userdata['full_name'],
                $rows->created_date,
                $status,
                '<a href="JavaScript:Void(0);" onclick="deletedata(\''.$rows->redeem_request_id.'\',\''.$Type.'\');" class="" title="Confirm Redeem Request"><i class="text-success fa fa-share font-20 pointer p-l-5 p-r-5"></i></a>
                '
            );  
        }
      

        if(!empty($search))
        {
            $this->db->group_start();
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }
            $this->db->group_end();                
        }

        $total_user = $this->Common->get_total_rows('redeem_request', array('status'=>0));
        // $total_user = $this->db->get("redeem_request")->num_rows();

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_user,
            "recordsFiltered" => $total_user,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function showRedeemRequest_confirm()
    {

        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }
        $valid_columns = array(
            0=>'redeem_request_id',
            1=>'redeem_request_type',
            2=>'account',
            3=>'amount',
            4=>'created_date',
            5=>'status'
        );
        if(!isset($valid_columns[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_columns[$col];
        }
        if($order !=null)
        {
            $this->db->order_by($order, $dir);
        }
        
        if(!empty($search))
        {
            $this->db->group_start();
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }
            $this->db->group_end();                
        }

        $this->db->limit($length,$start);
        $this->db->where('status',1);
        $users = $this->db->get("redeem_request");
        $Type = 'redeem_request';
        $data = array();
        foreach($users->result() as $rows)
        {
            if ($rows->status == 0) {
                $status =  '<span class="badge badge-pill badge-warning">Pending</span>';
            } elseif ($rows->status == 1) {
                $status =  '<span class="badge badge-pill badge-success">Completed</span>';
            }

            $userdata = get_row_data('users',array('user_id'=>$rows->user_id));

            $data[]= array(
                $rows->redeem_request_type,
                $rows->account,
                $rows->amount,
                $userdata['full_name'],
                $rows->created_date,
                $status
            );  
        }
      

        if(!empty($search))
        {
            $this->db->group_start();
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }
            $this->db->group_end();                
        }

        $total_user = $this->Common->get_total_rows('redeem_request', array('status'=>1));
        // $total_user = $this->db->get("redeem_request")->num_rows();

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_user,
            "recordsFiltered" => $total_user,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }
}