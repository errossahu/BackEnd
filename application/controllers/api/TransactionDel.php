<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class TransactionDel extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaction_model','transaction');
        $this->load->model('ItemTransaction_model','itemtran');
    }

    public function index_post()
    {
        $id_transaksi = $this->post('id_transaksi');
        if($id_transaksi==null){
            $this->response([
                'status' => false,
                'message' => 'PROVIDE AN ID'
            ], REST_Controller::HTTP_NOT_FOUND);
        }else{
            $this->itemtran->deleteItemTransactionById($id_transaksi);
            if($this->transaction->deleteTransaction($id_transaksi)){
                $this->response([
                    'status' => true,
                    'id' => $id_transaksi,
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