<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_t_m_d_postfix extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_t_login_user');
    $this->load->model('m_t_m_d_postfix');
    $this->load->model('m_t_m_d_jenis_barang');
    $this->load->model('m_t_m_d_company');
    $this->load->model('m_t_m_d_kategori');
    $this->load->model('m_t_m_d_satuan');
    $this->load->model('m_t_m_d_no_polisi');
    $this->load->model('m_t_m_d_supir');
    $this->load->model('m_t_m_d_sales');
    $this->load->model('m_t_m_d_supplier');
    $this->load->model('m_t_m_d_pelanggan');
  }

  public function index()
  {
    if($this->session->userdata('username')!='antony@acien')
    {
      redirect('/auth/logout');
    }
    $this->session->set_userdata('t_m_d_postfix_delete_logic', '1');
    $data = [
      "c_t_m_d_postfix" => $this->m_t_m_d_postfix->select(),
      

      "title" => "Master Postfix",
      "description" => "Postfix ID untuk Login"
    ];
    $this->render_backend('template/backend/pages/t_m_d_postfix', $data);
  }



  public function delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => TRUE
    );
    $this->m_t_m_d_postfix->update($data, $id);
    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');
    redirect('/c_t_m_d_postfix');
  }





  function tambah()
  {
    $username = substr($this->input->post("username"), 0, 50);
    $postfix = substr($this->input->post("postfix"), 0, 100);
    $company_id_qty = intval($this->input->post("company_id_qty"));
    $barang_id_qty = intval($this->input->post("barang_id_qty"));


    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.

    $postfix_id = strtotime(date('Y-m-d H:i:s'));


    $data = array(
      'POSTFIX_ID' => $postfix_id,
      'COMPANY_ID_QTY' => $company_id_qty,
      'BARANG_ID_QTY' => $barang_id_qty,
      'POSTFIX' => $postfix
    );

    $this->m_t_m_d_postfix->tambah($data);





     $data = array(
      'COMPANY' => $postfix,
      'INV_PEMBELIAN' => 'BELI-',
      'INV_RETUR_PEMBELIAN' => 'RB-',
      'INV_PENJUALAN' => 'JUAL-',
      'INV_RETUR_PENJUALAN' => 'RJ-',
      'INV_PO' => 'PO-',
      'INV_PEMAKAIAN' => 'PEMAKAIAN-',
      'INV_RETUR_PEMAKAIAN' => 'RP--',
      'CREATED_BY' => $this->session->userdata('username'),
      'UPDATED_BY' => '',
      'MARK_FOR_DELETE' => FALSE,
      'POSTFIX_ID' => $postfix_id
    );

    $this->m_t_m_d_company->tambah($data);


    $read_select = $this->m_t_m_d_company->select_top_1_desc($postfix_id);
    foreach ($read_select as $key => $value) 
    {
      $company_id = $value->ID;
    }



    $data = array(
          'USERNAME' => $username.'@'.$postfix,
          'PASSWORD' => '1234',
          'NAME' => $username,
          'COMPANY_ID' => $company_id,
          'LEVEL_USER_ID' => 1,
          'CREATED_BY' => $this->session->userdata('username'),
          'UPDATED_BY' => '',
          'MARK_FOR_DELETE' => FALSE,
          'POSTFIX_ID' => $postfix_id
    );

    $this->m_t_login_user->tambah($data);


    $data = array(
      'JENIS_BARANG' => 'unknown',
      'CREATED_BY' => $this->session->userdata('username'),
      'UPDATED_BY' => '',
      'MARK_FOR_DELETE' => FALSE,
      'POSTFIX_ID' => $postfix_id
    );

    $this->m_t_m_d_jenis_barang->tambah($data);


    $data = array(
      'KATEGORI' => 'unknown',
      'CREATED_BY' => $this->session->userdata('username'),
      'UPDATED_BY' => '',
      'MARK_FOR_DELETE' => FALSE,
      'POSTFIX_ID' => $postfix_id
    );

    $this->m_t_m_d_kategori->tambah($data);



    $data = array(
      'SATUAN' => 'Unit',
      'CREATED_BY' => $this->session->userdata('username'),
      'UPDATED_BY' => '',
      'MARK_FOR_DELETE' => FALSE,
      'POSTFIX_ID' => $postfix_id
    );

    $this->m_t_m_d_satuan->tambah($data);



    $data = array(
      'NO_POLISI' => 'unknown',
      'CREATED_BY' => $this->session->userdata('username'),
      'UPDATED_BY' => '',
      'MARK_FOR_DELETE' => FALSE,
      'POSTFIX_ID' => $postfix_id
    );

    $this->m_t_m_d_no_polisi->tambah($data);



    $data = array(
      'SUPIR' => 'unknown',
      'CREATED_BY' => $this->session->userdata('username'),
      'UPDATED_BY' => '',
      'MARK_FOR_DELETE' => FALSE,
      'POSTFIX_ID' => $postfix_id
    );

    $this->m_t_m_d_supir->tambah($data);



    $data = array(
      'SALES' => 'unknown',
      'NO_TELP' => '',
      'ALAMAT' => '',
      'CREATED_BY' => $this->session->userdata('username'),
      'UPDATED_BY' => '',
      'MARK_FOR_DELETE' => FALSE,
      'POSTFIX_ID' => $postfix_id
    );

    $this->m_t_m_d_sales->tambah($data);



    $data = array(
      'SUPPLIER' => 'unknown',
      'NO_TELP' => '',
      'ALAMAT' => '',
      'CREATED_BY' => $this->session->userdata('username'),
      'UPDATED_BY' => '',
      'MARK_FOR_DELETE' => FALSE,
      'EMAIL' => '',
      'NIK' => '',
      'NPWP' => '',
      'POSTFIX_ID' => $postfix_id
    );

    $this->m_t_m_d_supplier->tambah($data);



    $data = array(
      'PELANGGAN' => 'unknown',
      'NO_TELP' => '',
      'ALAMAT' => '',
      'CREATED_BY' => $this->session->userdata('username'),
      'UPDATED_BY' => '',
      'MARK_FOR_DELETE' => FALSE,
      'EMAIL' => '',
      'NIK' => '',
      'NPWP' => '',
      'POSTFIX_ID' => $postfix_id
    );

    $this->m_t_m_d_pelanggan->tambah($data);


    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
    redirect('c_t_m_d_postfix');
  }






  public function edit_action()
  {
    $id = $this->input->post("id");
    
    $postfix = substr($this->input->post("postfix"), 0, 100);
    $company_id_qty = intval($this->input->post("company_id_qty"));
    $barang_id_qty = intval($this->input->post("barang_id_qty"));



    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
    $data = array(
      'COMPANY_ID_QTY' => $company_id_qty,
      'BARANG_ID_QTY' => $barang_id_qty,
      'POSTFIX' => $postfix
    );

    $this->m_t_m_d_postfix->update($data, $id);
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Diupdate!</strong></p></div>');
    redirect('/c_t_m_d_postfix');
  }
}
