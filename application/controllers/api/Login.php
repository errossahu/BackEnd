<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Login extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_model','customer');
    }

    public function index_post()
    {
        $this->load->library("form_validation");

        $email = $this->post('email');
        $password = $this->post('password');
        $where = array(
            'email' => $email
            );
        $result = $this->customer->loginCustomer("customer",$where);
        foreach($result as $row){
            if(password_verify($password,$row['password'])){
        
                if($result>0)
                {
                    $this->response($result);
                }else{
                    $this->response([
                        'status' => "false",
                        'password' => $where['password'],
                        'message' => 'User Not Found'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            }
        }
    }
}