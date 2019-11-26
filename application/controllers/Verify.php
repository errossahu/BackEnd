<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Verify extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_model','customer');
    }

    public function verify($id,$hash)
    {
        $where = [
            'id' => $id,
            'hash' => $hash,
            'active' => '0'
        ];
        $result = $this->customer->loginCustomer('customer',$where);
        if(sizeof($result)>0)
        {
            $data = [
                'active' => '1'
            ];
            $this->customer->updateCustomer($data,$id);
            
            echo 'Your Account Activated, Please login into MakanYuk';
        }
        else
        {
            echo 'Activated Failed, you have been activated your account ';
        }
    }
}