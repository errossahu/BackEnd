<?php

class ItemTransaction_model extends CI_Model
{
    public function getItemTransaction($id_transaksi=null){

        if($id_transaksi==null){
            return $this->db->get('item_transaksi')->result_array();
        }else{
            return $this->db->get_where('item_transaksi',['id_transaksi' => $id_transaksi])->result_array();
        }
    }

    public function deleteItemTransactionById($id_transaksi)
    {
        $this->db->delete('item_transaksi', ['id_transaksi' => $id_transaksi]);
        return $this->db->affected_rows();
    }

    public function deleteItemTransactionAll()
    {
        $this->db->query('DELETE FROM item_transaksi');
        return $this->db->affected_rows();
    }

    public function createItemTransaction($data)
    {
        $this->db->insert('item_transaksi',$data);
        return $this->db->affected_rows();
    }
}