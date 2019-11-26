<?php

class Cart_model extends CI_Model
{
    public function getCart($item=null){

        if($item==null){
            return $this->db->get('cart')->result_array();
        }else{
            return $this->db->get_where('cart',['item' => $item])->result_array();
        }
        
    }

    public function getCartById($id){
        return $this->db->get_where('cart',['id_user' => $id])->result_array();
     
    }
    
    public function getCartSameItem($where){
        return $this->db->get_where('cart',$where)->result_array();
     
    }

    public function deleteCartByItem($item)
    {
        $this->db->delete('cart', ['item' => $item]);
        return $this->db->affected_rows();
    }

    public function deleteCartById($id)
    {
        $this->db->delete('cart', ['id_user' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteCartAll()
    {
        $this->db->query('DELETE FROM cart');
        return $this->db->affected_rows();
    }

    public function createCart($data)
    {
        $this->db->insert('cart',$data);
        return $this->db->affected_rows();
    }

    public function updateCart($data,$where)
    {
        $this->db->update('cart',$data, $where);
        return $this->db->affected_rows();
    }
}