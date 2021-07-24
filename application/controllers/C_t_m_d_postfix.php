<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class C_t_m_d_postfix extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('m_t_m_d_postfix');
        $this->load->database();
    }

    //Menampilkan data kontak
    public function index_get($page, $size)
    {   
        



        $select_results = $this->m_t_m_d_postfix->select_count();
        foreach ($select_results as $key => $value) 
        {
          $total_data = $value->count;
        }

        $select_results = $this->m_t_m_d_postfix->select($page,$size);
        
        // $this->response($select_results, 200);
        $this->response(array("data" => $select_results, "page" => $page, "size" => $size, "total" => $total_data),200);
    }


    public function insert_post()
    {
        $postfix_id = strtotime(date('Y-m-d H:i:s'));
        $company_id_qty = intval($this->post("company_id_qty"));
        $personal_id_qty = intval($this->post("personal_id_qty"));
        $postfix = substr($this->post("postfix"), 0, 50);

        //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
        $data = array(
          'POSTFIX_ID' => $postfix_id,
          'COMPANY_ID_QTY' => $company_id_qty,
          'PERSONAL_ID_QTY' => $personal_id_qty,
          'POSTFIX' => $postfix
        );


        $insert = $this->m_t_m_d_postfix->tambah($data);

        if($insert)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(array("message" => "failed" , "response" =>502), 502);
        }
        
    }


    public function update_post()
    {
        $postfix_id = intval($this->post("postfix_id"));
        $company_id_qty = intval($this->post("company_id_qty"));
        $personal_id_qty = intval($this->post("personal_id_qty"));
        $postfix = substr($this->post("postfix"), 0, 50);

        //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
        $data = array(
          'POSTFIX_ID' => $postfix_id,
          'COMPANY_ID_QTY' => $company_id_qty,
          'PERSONAL_ID_QTY' => $personal_id_qty,
          'POSTFIX' => $postfix
        );


        $insert = $this->m_t_m_d_postfix->update($data,$postfix_id);

        if($insert)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(array("message" => "failed" , "response" =>502), 502);
        }
        
    }



    public function delete_post()
    {
        $postfix_id = intval($this->post("postfix_id"));
        

        //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
     


        $delete = $this->m_t_m_d_postfix->delete($postfix_id);

        if($delete) 
        {
            $this->response(array('status' => 'success'), 200);
        } 
        else 
        {
            $this->response(array("message" => "failed", "response" => 502), 502);
        }
        
    }

    //Masukan function selanjutnya disini
}
