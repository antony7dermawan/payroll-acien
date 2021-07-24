<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class C_t_login_user extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('m_t_login_user');
        $this->load->database();
    }

    public function index_get()
    {   
        
    }

    public function login_post()
    {
        $username = substr($this->post("username"), 0, 100);
        $password = md5(substr($this->post("password"), 0, 100));

        $r_username = '';
        $r_name = '';
        $r_password = '';
        $r_level_user_id = '';
        $r_company_id = '';
        $r_postfix_id = '';

        $select_results = $this->m_t_login_user->select_by_username($username);
        foreach ($select_results as $key => $value) 
        {
          $r_username = $value->USERNAME;
          $r_name = $value->NAME;
          $r_password = $value->PASSWORD;
          $r_level_user_id = $value->LEVEL_USER_ID;
          $r_company_id = $value->COMPANY_ID;
          $r_postfix_id = $value->POSTFIX_ID;
        }
        if($r_username!='')
        {
            if($r_password==$password)
            {
                $data = array(
                    'message' => 'success',
                    'response' => 200,
                    'data' => 
                        {
                            'POSTFIX_ID' => $r_postfix_id,
                            'COMPANY_ID' => $r_company_id,
                            'USERNAME' => $r_username,
                            'NAME' => $r_name,
                            'LEVEL_USER_ID' => $r_level_user_id
                        }
                );
                $this->response($data, 200);
            }

            else
            {
                $this->response(array("message" => "wrong_password" , "response" =>502), 502);
            }
        }

        else
        {
            $this->response(array("message" => "username_not_found" , "response" =>502), 502);
        }
        
    }





    //Masukan function selanjutnya disini
}
