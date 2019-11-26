<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Total extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Total_model','total');
    }

    public function index_get()
    {
        $result = $this->total->getTotal();
        if($result)
        {
            $this->response($result);

        }else{
            $this->response([
                'message' => 'ID Not FOUND'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

}