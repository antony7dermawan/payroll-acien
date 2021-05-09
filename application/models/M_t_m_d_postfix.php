<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_m_d_postfix extends CI_Model {
    
    



  public function select_by_id()
  {
    $this->db->select('*');
    $this->db->from('T_M_D_POSTFIX');
    $this->db->where("POSTFIX_ID={$this->session->userdata('postfix_id')}");


    $akun = $this->db->get ();
    return $akun->result ();
  }


}


