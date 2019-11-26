<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class EmployeeDel extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Employee_model','employee');
    }

    public function index_post()
    {
        $id = $this->post('id');

        if($id==null){
            $this->response([
                'status' => false,
                'message' => 'PROVIDE AN ID'
            ], REST_Controller::HTTP_NOT_FOUND);
        }else{
            if($this->employee->deleteEmployee($id)){
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
}