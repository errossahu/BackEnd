<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Transaction extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaction_model','transaction');
        $this->load->model('Total_model','total');
        $this->load->model('ItemTransaction_model','itemtran');
    }

    public function index_get()
    {
        
        $query = $this->transaction->getTransaction();
        
        if($query>0)
        {
            $this->response($query);

        }else{
            $this->response([
                'message' => 'ID Not FOUND'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_post()
    {
        $data = [
            'id_user' => $this->post('id_user'),
            'id_transaksi' => $this->post('id_transaksi'),
            'nama' => $this->post('nama'),
            'jenis' => $this->post('jenis'),
            'total' => $this->post('total')
        ];
        
        $query = $this->transaction->createTransaction($data);
        if($query>0)
        {
            $this->response([
                'status' => "true",
                'message' =>'new transaction has been created',
                'value' => '200'
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => "false",
                'message' => 'failed to create new data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    // public function index_delete()
    // {
    //         if($this->transaction->deleteAll() > 0){
    //             $this->response([
    //                 'status' => true,
    //                 'message' =>'deleted'
    //             ], REST_Controller::HTTP_OK);
    //         }else{
    //             $this->response([
    //                 'status' => false,
    //                 'message' => 'ID NOT FOUND'
    //             ], REST_Controller::HTTP_BAD_REQUEST);
    //         }
        

    // }

    public function index_put()
    {
        $id_transaksi = $this->put('id_transaksi');
        $data = [
            'nama' => $this->put('nama'),
            'jenis' => $this->put('jenis'),
            'total' => $this->put('total')
        ];
        $this->itemtran->deleteItemTransactionById($id_transaksi);
        if($this->transaction->updateTransaction($data,$id_transaksi)>0)
        {
            $this->response([
                'status' => true,
                'id' => $id_transaksi,
                'message' =>'new transaction has been updated'
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => true,
                'id' => $id_transaksi,
                'message' =>'new transaction has been updated'
            ], REST_Controller::HTTP_OK);
        }
    }
}