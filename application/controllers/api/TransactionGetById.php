<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class TransactionGetById extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaction_model','transaction');
        $this->load->model('Total_model','total');
        $this->load->model('ItemTransaction_model','itemtran');
    }

    public function index_post()
    {
        $id_user = $this->post('id_user');
        $query = $this->transaction->getTransactionById($id_user);
        
        if($query)
        {
            $this->response($query);

        }else{
            $this->response($query);
        }
    }
}