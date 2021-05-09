<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_t_login_user extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_t_login_user');
    $this->load->model('m_t_m_d_level_user');
    $this->load->model('m_t_m_d_company');

    $this->load->model('m_t_m_d_postfix');
  }


  public function index()
  {
    $data = [
      "c_t_login_user" => $this->m_t_login_user->select(),
      "c_t_m_d_level_user" => $this->m_t_m_d_level_user->select(),
      "c_t_m_d_company" => $this->m_t_m_d_company->select(),
      "title" => "User List",
      "description" => "Data user yang akan login"
    ];
    $this->render_backend('template/backend/pages/t_login_user', $data);
  }


  public function delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => TRUE
    );
    $this->m_t_login_user->update($data, $id);
    
    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');
    redirect('/c_t_login_user');
  }

  public function undo_delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => FALSE
    );
    $this->m_t_login_user->update($data, $id);
    
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Dikembalikan!</strong></p></div>');
    redirect('/c_t_login_user');
  }



  function tambah()
  {
    $level_user_id = intval($this->input->post("level_user_id"));
    $company_id = intval($this->input->post("company_id"));
    $username = ($this->input->post("username"));
    $name = ($this->input->post("name"));
    $password1 = ($this->input->post("password1"));
    $password1c = ($this->input->post("password1c"));


    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
    if ($password1 != $password1c or $password1 == '') {
      $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Gagal Membuat User Baru! Password Tidak Sama</strong> Silahkan Mengulang!</p></div>');
    } 

    else {


      $read_select = $this->m_t_m_d_postfix->select_by_id(); //id nya dalam session uda di model
      foreach ($read_select as $key => $value) {
        $company_id_qty = $value->COMPANY_ID_QTY;
        $barang_id_qty = $value->BARANG_ID_QTY;
        $postfix = $value->POSTFIX;
      }

      //select existing username

      $username = $username.'@'.$postfix;


      $existing_logic_username = 0;
      $read_select = $this->m_t_login_user->select_existing_username($username); //id nya dalam session uda di model
      foreach ($read_select as $key => $value) {
        $existing_logic_username = 1;
      }


      if($existing_logic_username == 0)
      {
        $data = array(
          'USERNAME' => $username,
          'PASSWORD' => $password1,
          'NAME' => $name,
          'COMPANY_ID' => $company_id,
          'LEVEL_USER_ID' => $level_user_id,
          'CREATED_BY' => $this->session->userdata('username'),
          'UPDATED_BY' => '',
          'MARK_FOR_DELETE' => FALSE,
          'POSTFIX_ID' => $this->session->userdata('postfix_id')
        );

        $this->m_t_login_user->tambah($data);

        $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
      }

      if($existing_logic_username == 1)
      {
        $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Gagal Membuat User Baru! Username Sudah Digunakan!</strong> Silahkan Mengulang!</p></div>');
      }

      
    }

    redirect('c_t_login_user');
  }






  public function edit_action()
  {
    $id = $this->input->post("id");


    $company = ($this->input->post("company"));
    $read_select = $this->m_t_m_d_company->select_id($company);
    foreach ($read_select as $key => $value) {
      $company_id = $value->ID;
    }





    $level_user = ($this->input->post("level_user"));
    $read_select = $this->m_t_m_d_level_user->select_id($level_user);
    foreach ($read_select as $key => $value) {
      $level_user_id = $value->ID;
    }







    $name = ($this->input->post("name"));
    if ($level_user_id != '') {
      $data = array(
        'LEVEL_USER_ID' => $level_user_id,
        'COMPANY_ID' => $company_id,
        'NAME' => $name,
        'UPDATED_BY' => $this->session->userdata('username')
      );
      $this->m_t_login_user->update($data, $id);
      $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Diupdate!</strong></p></div>');
    } else {
      $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Gagal Update!</strong> Periksa Ulang Password</p></div>');
    }

    redirect('/c_t_login_user');
  }
}
