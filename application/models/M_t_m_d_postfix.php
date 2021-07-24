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





  public function select_count()
  {
 
    $this->db->select("count(\"POSTFIX_ID\")");
    $this->db->from('T_M_D_POSTFIX');

    $akun = $this->db->get ();
    return $akun->result ();
  }


  public function select($page,$size)
  {
    $from_offset = (($page*$size)-$size);
    

    $this->db->limit($size, $from_offset);
    $this->db->select('*');
    $this->db->from('T_M_D_POSTFIX');

    $this->db->order_by("POSTFIX_ID", "asc");
    $akun = $this->db->get ();
    return $akun->result ();
  }

  public function delete($id)
  {
    $this->db->where('POSTFIX_ID',$id);
    $this->db->delete('T_M_D_POSTFIX');
    return TRUE;
  }

  function tambah($data)
  {
    $this->db->insert('T_M_D_POSTFIX', $data);
    return TRUE;
  }



}


