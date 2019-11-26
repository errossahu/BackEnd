<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class CustomerDelById extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_model','customer');
    }

    public function index_post()
    {
        $id = $this->post('id');
        if($this->customer->deleteCustomerById($id) > 0){
            $this->response([
                'status' => true,
                'id' => $id,
                'message' =>'deleted'
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'ID NOT FOUND'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        
    }
}