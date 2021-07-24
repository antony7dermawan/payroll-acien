<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_login_user extends CI_Model {
    
    


  public function select_by_username($username)
  {
    $this->db->select('*');
    $this->db->from('T_LOGIN_USER');
    $this->db->where("USERNAME='{$username}'");
    $this->db->where('MARK_FOR_DELETE',false);

    $akun = $this->db->get ();
    return $akun->result ();
  }




}


