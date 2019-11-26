<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Item extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Item_model','item');
    }

    public function index_get()
    {
        $item = $this->item->getAll();
        
        if($item)
        {
            $this->response($item);

        }else{
            $this->response([
                'message' => 'ID Not FOUND'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_POST()
    {
        $item = $this->post('item');
        if($item==null){
            $this->response([
                'message' => 'ID Not FOUND'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            $result = $this->item->getItem($item);
        }
        
        
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