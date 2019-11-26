<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Employee extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Employee_model','employee');
    }

    public function index_get()
    {
        $id = $this->get('id');
        if($id==null){
            $employee = $this->employee->getEmployee();
        }else{
            $employee = $this->employee->getEmployee($id);
        }
        
        
        if($employee||$id===null)
        {
            $this->response($employee);

        }else{
            $this->response($employee);
        }
    }

    public function index_post()
    {
        $password = $this->post('password');
        $data = [
            'nama' => $this->post('nama'),
            'email' => $this->post('email'),
            'tanggal_lahir' => $this->post('tanggal_lahir'),
            'jenis_kelamin' => $this->post('jenis_kelamin'),
            'alamat' => $this->post('alamat'),
            'role' => $this->post('role')
        ];
        
        $employee = $this->employee->createEmployee($data);
        if($employee>0)
        {
            $this->response([
                'status' => "true",
                'message' =>'new employee has been created',
                'value' => '200'
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => "false",
                'message' => 'failed to create new data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_delete()
    {
        $email = $this->get('email');

        if($email==null){
            $this->response([
                'status' => false,
                'message' => 'EMAIL NULL'
            ], REST_Controller::HTTP_NOT_FOUND);
        }else{
            if($this->employee->deleteEmployee($email) > 0){
                $this->response([
                    'status' => true,
                    'email' => $email,
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

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'nama' => $this->put('nama'),
            'email' => $this->put('email'),
            'jenis_kelamin' => $this->put('jenis_kelamin'),
            'tanggal_lahir' => $this->put('tanggal_lahir'),
            'alamat' => $this->put('alamat'),
            'role' => $this->put('role')
        ];

        if($this->employee->updateEmployee($data,$id)>0)
        {
            $this->response([
                'status' => true,
                'id' => $id,
                'message' =>'new mahasiswa has been updated'
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => true,
                'id' => $id,
                'message' =>'new mahasiswa has been updated'
            ], REST_Controller::HTTP_OK);
        }
    }
}