<?php

namespace App\Controllers;

use App\Models\NasabahModel;
use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class Nasabah extends ResourceController
{
    public $basecontroller;

	public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->baseController = new BaseController;
    }

    public function register()
    {
		$data   = $this->request->getPost();
        $this->validation->run($data,'nasabahRegister');
        $errors = $this->validation->getErrors();

        if($errors) {
            return $this->fail($errors,400,true);
        } else {
            $email        = $data['email'];
            $otp          = $this->baseController->generateOTP(6);

            $nasabahModel = new NasabahModel();
            $lastNasabah  = $nasabahModel->getLastNasabah();
            $idNasabah    = '';

            if (count($lastNasabah) != 0) {
                $lastID = $lastNasabah[0]['id_nasabah'];
                $lastID = (int)substr($lastID,4)+1;
                $lastID = sprintf('%05d',$lastID);

                $idNasabah = $this->request->getPost("rt").$this->request->getPost("rw").$lastID;
            } else {
                $idNasabah = $this->request->getPost("rt").$this->request->getPost("rw").'00001';
            }
            
            $data = [
                "id"           => uniqid(),
                "id_nasabah"   => $idNasabah,
                "email"        => $email,
                "username"     => $data['username'],
                "password"     => password_hash($data['password'], PASSWORD_DEFAULT),
                "nama_lengkap" => $data['nama_lengkap'],
                "notelp"       => $data['notelp'],
                "alamat"       => $data['alamat'],
                "tgl_lahir"    => $data['tgl_lahir'],
                "kelamin"      => $data['kelamin'],
                "otp"          => $otp,
            ];

            if ($nasabahModel->addNasabah($data)) {
                $sendEmail = $this->baseController->sendVerification($email,$otp);

                if ($sendEmail == true) {
                    $response = [
                        'status'   => 201,
                        "error"    => false,
                        'messages' => 'register success. please check your email',
                    ];
    
                    return $this->respondCreated($response);
                } 
                else {
                    return $this->fail($sendEmail,500,true);
                }
                
            } 
            else {
                return $this->failServerError();
            }
        }

    }

    public function verification()
    {
		$data   = $this->request->getPost();
        $this->validation->run($data,'codeOTP');
        $errors = $this->validation->getErrors();

        if($errors) {
            return $this->fail($errors,400,true);
        } 
        else {
            $nasabahModel = new NasabahModel();
            $email        = $this->request->getPost('code_otp');
            $editNasabah  = $nasabahModel->emailVerification($email);

            if (is_int($editNasabah)) {
                if ($editNasabah > 0) {
                    $response = [
                        'status'   => 201,
                        "error"    => false,
                        'messages' => 'verification success',
                    ];
    
                    return $this->respondCreated($response);
                } else {
                    return $this->fail('otp not found',404,true);
                }                
            } 
            else {
                return $this->fail($editNasabah,500,true);
            }
        }    
    }

    public function login()
    {
		$data   = $this->request->getPost();
        $this->validation->run($data,'nasabahLogin');
        $errors = $this->validation->getErrors();

        if($errors) {
            return $this->fail($errors,400,true);
        } 
        else {
            $nasabahModel = new NasabahModel();
            $nasabahdata  = $nasabahModel->where("email", $this->request->getPost("email"))->first();

            if (!empty($nasabahdata)) {
                if (password_verify($this->request->getPost("password"), $nasabahdata['password'])) {

                    if ($nasabahdata['is_verify'] == 'no') {
                        return $this->fail('account is not verify',403,true);
                    } 
                    else {
                        // rememberMe check
                        $rememberme   = ($this->request->getPost("rememberme") == 'yes') ? true : '';
                        // generate new token
                        $token        = $this->baseController->generateToken(
                            $nasabahdata['id'],
                            $nasabahdata['id_nasabah'],
                            $rememberme
                        );
                        // edit nasabah in database
                        $editNasabah = $nasabahModel->updateToken($nasabahdata['id'],$token);

                        if (is_int($editNasabah)) {
                            if ($editNasabah > 0) {
                                $response = [
                                    'status' => 200,
                                    'error' => false,
                                    'messages' => 'loggin success',
                                    'data' => [
                                        'token' => $token
                                    ]
                                ];
        
                                return $this->respond($response,200);
                            } 
                            else {
                                return $this->fail('user id not found',404,true);
                            }                
                        } 
                        else {
                            return $this->fail($editNasabah,500,true);
                        }
                    } 
                } 
                else {
                    return $this->fail('wrong password',401,true);
                }
            } 
            else {
                return $this->fail('email not found',404,true);
            }
        }
    }

    public function sessionCheck()
    {
        $authHeader = $this->request->getHeader('token');
        $token      = $authHeader->getValue();
        $result     = $this->baseController->checkToken($token);

        if ($result['success'] == true) {
            return $this->respond($result['message'],200);
        } 
        else {
            return $this->fail($result['message'],200,true);
        }
        
    }

    public function getData()
    {
        $authHeader = $this->request->getHeader('token');
        $token      = $authHeader->getValue();
        $result     = $this->baseController->checkToken($token);

        if ($result['success'] == true) {
            $nasabahModel = new NasabahModel();
            $id_nasabah   = $result['message']['data']['id_nasabah'];
            $dataNasabah  = $nasabahModel->where("id_nasabah",$id_nasabah)->first();

            if (!empty($dataNasabah)) {
                $response = [
                    'status' => 200,
                    'error'  => false,
                    'data '  => [
                        'id'          => $dataNasabah['id'],
                        'id_nasabah'  => $dataNasabah['id_nasabah'],
                        'email'       => $dataNasabah['email'],
                        'username'    => $dataNasabah['username'],
                        'nama_lengkap'=> $dataNasabah['nama_lengkap'],
                        'alamat'      => $dataNasabah['alamat'],
                        'notelp'      => $dataNasabah['notelp'],
                        'kelamin'     => $dataNasabah['kelamin'],
                        'tgl_lahir'   => $dataNasabah['tgl_lahir'],
                        'created_at'  => $dataNasabah['created_at'],
                    ],
                ];

                return $this->respond($response,200);
            } 
            else {
                return $this->fail('nasabah not found',404,true);
            }
        } 
        else {
            return $this->fail($result['message'],200,true);
        }
    }

    public function editProfile()
    {
        $authHeader = $this->request->getHeader('token');
        $token      = $authHeader->getValue();
        $result     = $this->baseController->checkToken($token);

        if ($result['success'] == true) {
            $data   = $this->request->getPost();
            $this->validation->run($data,'editProfileNasabah');
            $errors = $this->validation->getErrors();

            if($errors) {
                return $this->fail($errors,400,true);
            } 
            else {
                $id           = $data['id'];
                $nasabahModel = new NasabahModel();
                $dataNasabah  = $nasabahModel->where("id",$id)->first();

                if (!empty($dataNasabah)) {
                    $data = [
                        "id"           => $data['id'],
                        "username"     => $data['username'],
                        "nama_lengkap" => $data['nama_lengkap'],
                        "notelp"       => $data['notelp'],
                        "alamat"       => $data['alamat'],
                        "tgl_lahir"    => $data['tgl_lahir'],
                        "kelamin"      => $data['kelamin'],
                    ];

                    $newpass = $this->request->getPost('new_password');
                    $oldpass = $this->request->getPost('old_password');

                    if ($newpass != '') {
                        if (password_verify($oldpass,$dataNasabah['password'])) {
                            $data['password'] = password_hash($newpass, PASSWORD_DEFAULT);
                        } 
                        else {
                            return $this->fail("wrong old password",401,true);
                        }
                    }

                    $editNasabah  = $nasabahModel->editProfileNasabah($data);

                    if (is_int($editNasabah)) {
                        if ($editNasabah > 0) {
                            $response = [
                                'status' => 201,
                                'error' => false,
                                'messages' => 'edit profile success',
                            ];
        
                            return $this->respond($response,201);
                        }
                        else {
                            $response = [
                                'status' => 201,
                                'error' => false,
                                'messages' => 'nothing update',
                            ];
        
                            return $this->respond($response,201);
                        }
                    } 
                    else {
                        return $this->fail($editNasabah,500,true);
                    }
                } 
                else {
                    return $this->fail("nasabah with id $id not found",404,true);
                }
                
            }
        } 
        else {
            return $this->fail($result['message'],200,true);
        }
        
    }

    public function logout()
    {
        $authHeader = $this->request->getHeader('token');
        $token      = $authHeader->getValue();
        $result     = $this->baseController->checkToken($token);

        if ($result['success'] == true) {
            $nasabahModel = new NasabahModel();
            $id_nasabah   = $result['message']['data']['id_nasabah'];
            $editNasabah  = $nasabahModel->setTokenNull($id_nasabah);

            if (is_int($editNasabah)) {
                if ($editNasabah > 0) {
                    $response = [
                        'status' => 200,
                        'error' => false,
                        'messages' => 'logout success',
                    ];

                    return $this->respond($response,200);
                }              
            } 
            else {
                return $this->fail($editNasabah,500,true);
            }
        } 
        else {
            return $this->fail($result['message'],200,true);
        }
        
    }
}