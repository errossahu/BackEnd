<?php

class Transaction_model extends CI_Model
{

    public function getTransaction(){
            return $this->db->get('transaksi')->result_array();
    }

    public function getTransactionById($id_user){

        return $this->db->get_where('transaksi',['id_user' => $id_user])->result_array();
        
    }

    public function createTransaction($data)
    {
        $this->db->insert('transaksi',$data);
        return $this->db->affected_rows();
    }

    

    public function deleteTransaction($id_transaksi)
    {
        $this->db->delete('transaksi', ['id_transaksi' => $id_transaksi]);
        return $this->db->affected_rows();
    }

    public function updateTransaction($data,$id_transaksi)
    {
        $this->db->update('transaksi',$data, ['id_transaksi'=>$id_transaksi]);
        return $this->db->affected_rows();
    }

}
