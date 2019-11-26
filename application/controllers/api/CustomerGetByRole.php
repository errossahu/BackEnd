<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class CustomerGetByRole extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_model','customer');
    }

    public function index_post()
    {
        $data = array(
            'role' => $this->post('role')
        );
            $query = $this->customer->getByRole($data);

        if($query)
        {
            $this->response($query);

        }else{
            $this->response($query);
        }
    }

}