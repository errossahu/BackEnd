<?php

class Customer_model extends CI_Model
{
    public function getByRole($where){
        return $this->db->get_where('customer',$where)->result_array();
    }
    
    public function getById($where){
        return $this->db->get_where('customer',$where)->result_array();
    }

    public function loginCustomer($table,$where)
    {
        return $this->db->get_where($table,$where)->result_array();
    }

    public function deleteCustomerById($id)
    {
        $this->db->delete('customer', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function createCustomer($data)
    {
        $this->db->insert('customer',$data);
        return $this->db->affected_rows();
    }

    public function updateCustomer($data,$id)
    {
        return $this->db->update('customer',$data, ['id'=>$id]);
        return $this->db->affected_rows();
    }

    public function postCURL($_url, $_param){

        $postData = '';
        //create name value pairs seperated by &
        foreach($_param as $k => $v) 
        { 
          $postData .= $k . '='.$v.'&'; 
        }
        rtrim($postData, '&');


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, false); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    

        $output=curl_exec($ch);

        curl_close($ch);

        return $output;
    }
}