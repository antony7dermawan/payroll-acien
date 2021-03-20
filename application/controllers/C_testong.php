<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_testong extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_t_t_t_pembelian_rincian');
  }


  public function index()
  {
    $barang_id = 1613537976;
    $read_select = $this->m_t_t_t_pembelian_rincian->select_min_harga_barang($barang_id);
    foreach ($read_select as $key => $value) 
    {



      
      echo $value->HARGA_MIN;
      
    }
  }


}
