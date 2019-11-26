<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Customer extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_model','customer');
    }
    
    public function index_get($id)
    {
        $data = array(
            'id' => $id
        );
            
        $query = $this->customer->getById($data);

        if($query)
        {
            $this->response($query);

        }else{
            $this->response($query);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');

        if($id===null){
            $this->response([
                'status' => false,
                'message' => 'PROVIDE AN ID'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            if($this->mahasiswa->deleteMahasiswa($id) > 0){
                $this->response([
                    'status' => true,
                    'id' => $id,
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

    public function index_post()
    {
        require 'vendor/autoload.php';
        if($this->post('role')==null){

            $password = $this->post('password');
            $hash = md5($password);
            $email = $this->post('email');
            $nama = $this->post('nama');
            $data = [
                'email' => $this->post('email'),
                'password' => password_hash($password,PASSWORD_BCRYPT),
                'nama' => $this->post('nama'),
                'tanggal_lahir' => $this->post('tanggal_lahir'),
                'jenis_kelamin' => $this->post('jenis_kelamin'),
                'alamat' => $this->post('alamat'),
                'no_telp' => $this->post('no_telp'),
                'hash' => $hash,
                'role' => 'Customer'
            ];
            
            $this->customer->createCustomer($data);
            $customer = $this->customer->loginCustomer("customer",$data);
            foreach($customer as $row)
                $id = $row['id'];
            if($customer>0)
            {
                $message = '
                Thanks for signing up!<br>
                Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.<br>
                <br>
                ------------------------<br>
                Username: '.$nama.'<br>
                Password: '.$password.'<br>
                ------------------------<br>
                <br>
                Please click this link to activate your account:<br>
                https://berusahapastibisakok.tech/Backend_PBP/Verify/verify/'.$id.'/'.$hash.'<br>
                
                ';
                $mail = new PHPMailer(true); 
                try {
                    //Server settings
                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Setmailer touse SMTP
                    $mail->Host = 'berusahapastibisakok.tech';  // Specify main andbackup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'letseat@berusahapastibisakok.tech';                 // SMTP username
                    $mail->Password= 'letseat1234567890';                           // SMTP password
                    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 465;                                    // TCP port toconnectto
                    //Recipients
                    $mail->setFrom('letseat@berusahapastibisakok.tech', 'MakanYuk');
                    $mail->addAddress($email, $nama);     // Adda recipient
                    //$mail->addAddress('ellen@example.com');               // Nameisoptional
                    //$mail->addReplyTo('info@example.com', 'Information');
                    //$mail->addCC('cc@example.com');
                    //$mail->addBCC('bcc@example.com');
                    //Attachments
                    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Addattachments
                    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                    //Content
                    $mail->isHTML(true);                                  // Setemail format toHTML
                    $mail->Subject = 'ACTIVATED ACCOUNT';
                    $mail->Body    = $message;
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                    $mail->send();
                    $this->response([
                        'status' => "true",
                        'message' =>'new customer has been created,check your email',
                        'id' => $id,
                        'value' => '200'
                    ], REST_Controller::HTTP_OK);;
                } catch (Exception $e) {
                    $this->response([
                        'status' => "true",
                        'message' =>'Failed',
                        'value' => '200'
                    ], REST_Controller::HTTP_OK);
                }
                
            }else{
                $this->response([
                    'status' => "false",
                    'message' => 'failed to create new data'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }else
        {
            $password = $this->post('password');
            $hash = rand(1,1000000000000000);
            $email = $this->post('email');
            $nama = $this->post('nama');
            $data = [
                'email' => $this->post('email'),
                'password' => password_hash($password,PASSWORD_BCRYPT),
                'nama' => $this->post('nama'),
                'tanggal_lahir' => $this->post('tanggal_lahir'),
                'jenis_kelamin' => $this->post('jenis_kelamin'),
                'alamat' => $this->post('alamat'),
                'no_telp' => $this->post('no_telp'),
                'hash' => $hash,
                'active' => '1',
                'role' => $this->post('role')
            ];
            if($this->customer->createCustomer($data))
            {
                $this->response([
                    'status' => "true",
                    'message' =>'Failed',
                    'value' => '200'
                ], REST_Controller::HTTP_OK);
            }
            else{
                $this->response([
                    'status' => "false",
                    'message' => 'failed to create new data'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_put()
    {
        $old = $this->put('old_password');
        $password = $this->put('password');
        $id = $this->put('id');
        if($password==null){
            $data = [
                'email' => $this->put('email'),
                'nama' => $this->put('nama'),
                'tanggal_lahir' => $this->put('tanggal_lahir'),
                'jenis_kelamin' => $this->put('jenis_kelamin'),
                'alamat' => $this->put('alamat'),
                'no_telp' => $this->put('no_telp')
            ];
        }else{
            $where = [
                'id' => $id,
            ];
            $result = $this->customer->loginCustomer("customer",$where);
            foreach($result as $row){
                if(!password_verify($old,$row['password'])){
                    $this->response([
                        'status' => false,
                        'message' => 'Wrong old Password'
                    ], REST_Controller::HTTP_BAD_REQUEST);
                }
                else{
                    $data = [
                        'id' => $id,
                        'password' => password_hash($password,PASSWORD_BCRYPT)
                    ];
                }
            }
        }

        if($this->customer->updateCustomer($data,$id)>0)
        {
            $this->response([
                'id' => $id
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'failed to update data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}