<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_t_m_d_level_user extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_m_d_level_user');
  }

  public function index()
  {
    $this->session->set_userdata('t_m_d_level_user_delete_logic', '1');
    $data = [
      "c_t_m_d_level_user" => $this->m_t_m_d_level_user->select(),
      "title" => "Master Level User",
      "description" => "Level User untuk Login"
    ];
    $this->render_backend('template/backend/pages/t_m_d_level_user', $data);
  }



  public function delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => TRUE
    );
    $this->m_t_m_d_level_user->update($data, $id);
    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');
    redirect('/c_t_m_d_level_user');
  }

  public function undo_delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => FALSE
    );
    $this->m_t_m_d_level_user->update($data, $id);
    
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Dikembalikan!</strong></p></div>');
    redirect('/c_t_m_d_level_user');
  }


  function tambah()
  {
    
    $level_user = substr($this->input->post("level_user"), 0, 50);

    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
    $data = array(
      'LEVEL_USER' => $level_user,
      'CREATED_BY' => $this->session->userdata('username'),
      'UPDATED_BY' => '',
      'MARK_FOR_DELETE' => FALSE,
      'POSTFIX_ID' => $this->session->userdata('postfix_id')
    );

    $this->m_t_m_d_level_user->tambah($data);

    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
    redirect('c_t_m_d_level_user');
  }






  public function edit_action()
  {
    $id = $this->input->post("id");
    $level_user = substr($this->input->post("level_user"), 0, 50);

    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
    $data = array(
      'LEVEL_USER' => $level_user,
      'UPDATED_BY' => $this->session->userdata('username')
    );

    $this->m_t_m_d_level_user->update($data, $id);
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Diupdate!</strong></p></div>');
    redirect('/c_t_m_d_level_user');
  }
}
