<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class CartCreateFromItem extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cart_model','cart');
        $this->load->model('Total_model','total');
    }

    public function index_post()
    {
        $id = $this->post('id_user');
        $harga = $this->post('harga');
        $jumlah = $this->post('jumlah');
        $data = [
            'id_user' => $id,
            'item' => $this->post('item'),
            'harga' => $harga,
            'jumlah' => $jumlah
        ];
        
        $cart = $this->cart->createCart($data);
        if($cart>0)
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
}