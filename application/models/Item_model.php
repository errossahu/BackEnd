<?php

class Item_model extends CI_Model
{
    public function getAll(){
            return $this->db->get('item')->result_array();
    }

    public function getItem($item){
         return $this->db->get_where('item',['item' => $item])->result_array();
    }
}