<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class CartDelBy extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cart_model','cart');
    }

    public function index_post()
    {
        $item = $this->post('item');
        $id = $this->post('id_user');
        if($item==null){
            if($this->cart->deleteCartById($id) > 0){
                $this->response([
                    'status' => true,
                    'id' => $item,
                    'message' =>'deleted'
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'message' => 'ID NOT FOUND'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            if($this->cart->deleteCartByItem($item) > 0){
                $this->response([
                    'status' => true,
                    'id' => $item,
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