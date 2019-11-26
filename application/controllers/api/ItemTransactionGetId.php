<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class ItemTransactionGetId extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ItemTransaction_model','itemtran');
        $this->load->model('Transaction_model','transaction');
    }

    public function index_post()
    {
        $id_transaksi = $this->post('id_transaksi');
            $query = $this->itemtran->getItemTransaction($id_transaksi);
        
        
        
        if($query)
        {
            $this->response($query);

        }else{
            $this->response($query);
        }
    }

}