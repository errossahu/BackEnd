<?php

class Total_model extends CI_Model
{
    public function getTotal(){
         return $this->db->get_where('total',['id' => '1'])->result_array();
    }

    public function upTotal($total){
        $this->db->update('total',$total,['id'=>'1']);
        return $this->db->affected_rows();
    }
}