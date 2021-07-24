<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_login_user extends CI_Model {
    
    


  public function select_by_username($username)
  {
    $this->db->select('T_LOGIN_USER.USERNAME');
    $this->db->select('T_LOGIN_USER.NAME');
    $this->db->select('T_LOGIN_USER.PASSWORD');
    $this->db->select('T_LOGIN_USER.LEVEL_USER_ID');
    $this->db->select('T_LOGIN_USER.COMPANY_ID');
    $this->db->select('T_LOGIN_USER.POSTFIX_ID');
    $this->db->select('T_M_D_COMPANY.COMPANY');

    $this->db->from('T_LOGIN_USER');

    $this->db->join('T_M_D_COMPANY', 'T_M_D_COMPANY.ID = T_LOGIN_USER.COMPANY_ID', 'left');

    $this->db->where("USERNAME='{$username}'");
    $this->db->where('MARK_FOR_DELETE',false);

    $akun = $this->db->get ();
    return $akun->result ();
  }




}


