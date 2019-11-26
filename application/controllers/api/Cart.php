<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Cart extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cart_model','cart');
        $this->load->model('Total_model','total');
    }

    public function index_get()
    {
        $cart = $this->cart->getCart();
        $total = 0;
        foreach ($cart as $key => $row) {
            $total += $row['harga'];
        }
        $data = [
            'total' => $total
        ];
        $result = $this->total->upTotal($data);
        
        if($cart||$item==null)
        {
            $this->response($cart);

        }else{
            $this->response([
                'message' => 'ID Not FOUND'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_post()
    {
        $itemTotal = 0;
        $id = $this->post('id_user');
        $harga = $this->post('harga');
        $jumlah = $this->post('jumlah');
        $item = $this->post('item');
        $where = [
            'id_user' => $id,
            'item' => $item
        ];
        $cart = $this->cart->getCartSameItem($where);
        if(sizeof($cart))
        {
            foreach($cart as $row)
                $itemTotal = $jumlah + $row['jumlah'];
            $total = $harga*$itemTotal;
            $data = [
                'harga' => $total,
                'jumlah' => $itemTotal
            ];
            $cart = $this->cart->updateCart($data,$where);
            if($cart>0)
            {
                $this->response([
                    'status' => "true",
                    'message' =>'new item has been updated',
                    'value' => '200'
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => "false",
                    'cart' => $cart,
                    'message' => 'failed to update data'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $total = $harga*$jumlah;
            $data = [
                'id_user' => $id,
                'item' => $this->post('item'),
                'harga' => $total,
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

    public function index_delete()
    {
            if($this->cart->deleteCartAll() > 0){
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

    // public function index_put()
    // {
    //     $item = $this->put('item');
    //     $data = [
    //         'item' => $this->put('item'),
    //         'harga' => $this->put('harga'),
    //         'jumlah' => $this->put('jumlah')
    //     ];

    //     if($this->cart->updateCart($data,$id)>0)
    //     {
    //         $this->response([
    //             'status' => true,
    //             'id' => $item,
    //             'message' =>'new mahasiswa has been updated'
    //         ], REST_Controller::HTTP_OK);
    //     }else{
    //         $this->response([
    //             'status' => false,
    //             'message' => 'failed to update data'
    //         ], REST_Controller::HTTP_BAD_REQUEST);
    //     }
    // }
}