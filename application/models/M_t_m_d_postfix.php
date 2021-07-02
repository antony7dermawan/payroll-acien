<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_m_d_postfix extends CI_Model {
    
    

	public function update($data, $id)
	{
	   $this->db->where('POSTFIX_ID', $id);
	   return $this->db->update('T_M_D_POSTFIX', $data);
	}

  public function select_by_id()
  {
    $this->db->select('*');
    $this->db->from('T_M_D_POSTFIX');
    $this->db->where("POSTFIX_ID={$this->session->userdata('postfix_id')}");


    $akun = $this->db->get ();
    return $akun->result ();
  }




  public function select()
  {
    $this->db->select('*');
    $this->db->from('T_M_D_POSTFIX');




    

    $this->db->order_by("POSTFIX_ID", "asc");
    $akun = $this->db->get ();
    return $akun->result ();
  }

  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_M_D_POSTFIX');
  }

  function tambah($data)
  {
    $this->db->insert('T_M_D_POSTFIX', $data);
    return TRUE;
  }



}


