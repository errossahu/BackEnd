<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class CartGetId extends REST_Controller
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
        $cart = $this->cart->getCartById($id);

        if($cart>0)
        {
            $this->response($cart);

        }else{
            $this->response([
                'status' => false,
                'message' => 'ID NOT FOUND'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}