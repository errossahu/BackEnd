<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class ItemTransaction extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ItemTransaction_model','itemtran');
        $this->load->model('Transaction_model','transaction');
    }

    public function index_get()
    {
        $id_transaksi = $this->get('id_transaksi');
        if($id_transaksi==null){
            $query = $this->itemtran->getItemTransaction();
        }else{
            $query = $this->itemtran->getItemTransaction($id_transaksi);
        }
        
        
        if($query||$id_transaksi==null)
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
        $id_user = $this->post('id_user');
        $data = [
            'id_user' => $id_user,
            'id_transaksi' => $this->post('id_transaksi'),
            'item' => $this->post('item'),
            'jumlah' => $this->post('jumlah'),
            'harga' => $this->post('harga')
        ];
        
        $query = $this->itemtran->createItemTransaction($data);
        if($query>0)
        {
            $this->response([
                'status' => "true",
                'message' =>'new item has been created',
                'value' => '200'
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => "false",
                'message' => 'failed to create new data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_delete()
    {
            if($this->itemtran->deleteItemTransactionAll() > 0){
                $this->response([
                    'status' => true,
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