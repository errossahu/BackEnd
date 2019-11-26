<?php

class Employee_model extends CI_Model
{

    public function getEmployee($id=null){

        if($id===null){
            return $this->db->get('employee')->result_array();
        }else{
            return $this->db->get_where('employee',['id' => $id])->result_array();
        }
        
    }

    public function createEmployee($data)
    {
        $this->db->insert('employee',$data);
        return $this->db->affected_rows();
    }

    public function deleteEmployee($id)
    {
        $this->db->delete('employee', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function updateEmployee($data,$id)
    {
        $this->db->update('employee',$data, ['id'=>$id]);
        return $this->db->affected_rows();
    }

}
