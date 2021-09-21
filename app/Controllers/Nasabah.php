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
            $response = [
                'status' => 400,
                'error' => true,
                'messages' => $errors,
            ];
    
            return $this->respond($response,400);
        } 
        else {
            $email        = $data['email'];
            $otp          = $this->baseController->generateOTP(6);

            $nasabahModel = new NasabahModel();
            $lastNasabah  = $nasabahModel->getLastNasabah();
            $idNasabah    = '';

            if ($lastNasabah['success'] == true) {
                $lastID = $lastNasabah['message']['id_nasabah'];
                $lastID = (int)substr($lastID,4)+1;
                $lastID = sprintf('%05d',$lastID);

                $idNasabah = $this->request->getPost("rt").$this->request->getPost("rw").$lastID;
            }
            else if ($lastNasabah['code'] == 404) {
                $idNasabah = $this->request->getPost("rt").$this->request->getPost("rw").'00001';
            } 
            else {
                $response = [
                    'status'   => $lastNasabah['code'],
                    'error'    => true,
                    'messages' => $lastNasabah['message'],
                ];
        
                return $this->respond($response,$lastNasabah['code']);

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

            $addNasabah = $nasabahModel->addNasabah($data);

            if ($addNasabah['success'] == true) {
                $sendEmail = $this->baseController->sendVerification($email,$otp);

                if ($sendEmail == true) {
                    $response = [
                        'status'   => 201,
                        "error"    => false,
                        'messages' => 'register success. please check your email',
                    ];
    
                    return $this->respond($response,201);
                } 
                else {
                    $response = [
                        'status'   => 500,
                        'error'    => true,
                        'messages' => $sendEmail,
                    ];
            
                    return $this->respond($response,500);
                }
                
            } 
            else {
                $response = [
                    'status'   => $addNasabah['code'],
                    'error'    => true,
                    'messages' => $addNasabah['message'],
                ];
        
                return $this->respond($response,$addNasabah['code']);
            }
        }

    }

    public function verification()
    {
		$data   = $this->request->getPost();
        $this->validation->run($data,'codeOTP');
        $errors = $this->validation->getErrors();

        if($errors) {
            $response = [
                'status'   => 400,
                'error'    => true,
                'messages' => $errors['code_otp'],
            ];
    
            return $this->respond($response,400);
        } 
        else {
            $nasabahModel = new NasabahModel();
            $email        = $this->request->getPost('code_otp');
            $editNasabah  = $nasabahModel->emailVerification($email);

            if ($editNasabah['success'] == true) {
                $response = [
                    'status'   => 201,
                    'error'    => false,
                    'messages' => $editNasabah['message'],
                ];
        
                return $this->respond($response,201);

            } 
            else {
                $response = [
                    'status'   => $editNasabah['code'],
                    'error'    => true,
                    'messages' => $editNasabah['message'],
                ];
        
                return $this->respond($response,$editNasabah['code']);
            }
        }    
    }

    public function login()
    {
		$data   = $this->request->getPost();
        $this->validation->run($data,'nasabahLogin');
        $errors = $this->validation->getErrors();

        if($errors) {
            $response = [
                'status'   => 400,
                'error'    => true,
                'messages' => $errors,
            ];
    
            return $this->respond($response,400);
        } 
        else {
            $nasabahModel = new NasabahModel();
            $nasabahData  = $nasabahModel->getNasabahByEmail($this->request->getPost("email"));

            if ($nasabahData['success'] == true) {
                $login_pass    = $this->request->getPost("password");
                $database_pass = $nasabahData['message']['password'];

                if (password_verify($login_pass,$database_pass)) {
                    $is_verify = $nasabahData['message']['is_verify'];

                    if ($is_verify == 'no') {
                        $response = [
                            'status'   => 401,
                            'error'    => true,
                            'messages' => 'account is not verify',
                        ];
                
                        return $this->respond($response,401);
                    } 
                    else {
                        // database row id
                        $id           = $nasabahData['message']['id'];
                        // rememberMe check
                        $rememberme   = ($this->request->getPost("rememberme") == 'yes') ? true : '';
                        // generate new token
                        $token        = $this->baseController->generateToken(
                            $id,
                            $nasabahData['message']['id_nasabah'],
                            $rememberme
                        );

                        // edit nasabah in database
                        $editNasabah = $nasabahModel->updateToken($id,$token);

                        if ($editNasabah['success'] == true) {
                            $response = [
                                'status'   => 200,
                                'error'    => false,
                                'messages' => 'loggin success',
                                'token   ' => $token
                            ];
    
                            return $this->respond($response,200);
                        } 
                        else {
                            $response = [
                                'status'   => $nasabahData['code'],
                                'error'    => true,
                                'messages' => $nasabahData['message'],
                            ];
                    
                            return $this->respond($response,$nasabahData['code']);
                        }
                    } 
                } 
                else {
                    $response = [
                        'status'   => 404,
                        'error'    => true,
                        'messages' => 'password not match',
                    ];
            
                    return $this->respond($response,404);
                }
            } 
            else {
                $response = [
                    'status'   => $nasabahData['code'],
                    'error'    => true,
                    'messages' => $nasabahData['message'],
                ];
        
                return $this->respond($response,$nasabahData['code']);
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
            $response = [
                'status'   => $result['code'],
                'error'    => true,
                'messages' => $result['message'],
            ];
    
            return $this->respond($response,$result['code']);
        }
    }

    public function getProfile()
    {
        $authHeader = $this->request->getHeader('token');
        $token      = $authHeader->getValue();
        $result     = $this->baseController->checkToken($token);

        if ($result['success'] == true) {
            $nasabahModel = new NasabahModel();
            $id           = $result['message']['data']['id'];
            $dataNasabah  = $nasabahModel->getProfileNasabah($id);
            
            if ($dataNasabah['success'] == true) {
                $response = [
                    'status' => 200,
                    'error'  => false,
                    'data '  => $dataNasabah['message']
                ];

                return $this->respond($response,200);
            } 
            else {
                $response = [
                    'status'   => $dataNasabah['code'],
                    'error'    => true,
                    'messages' => $dataNasabah['message'],
                ];
        
                return $this->respond($response,$dataNasabah['code']);
            }
        } 
        else {
            $response = [
                'status'   => $result['code'],
                'error'    => true,
                'messages' => $result['message'],
            ];
    
            return $this->respond($response,$result['code']);
        }
    }

    public function editProfile()
    {
        $authHeader = $this->request->getHeader('token');
        $token      = $authHeader->getValue();
        $result     = $this->baseController->checkToken($token);

        if ($result['success'] == true) {
            $this->baseController->_methodParser('data');
            global $data;
            $data['id'] = $result['message']['data']['id']; 

            $this->validation->run($data,'editProfileNasabah');
            $errors = $this->validation->getErrors();

            if($errors) {
                $response = [
                    'status'   => 400,
                    'error'    => true,
                    'messages' => $errors,
                ];
        
                return $this->respond($response,400);
            } 
            else {
                $id           = $data['id'];
                $nasabahModel = new NasabahModel();
                $dataNasabah  = $nasabahModel->where("id",$id)->first();

                if (!empty($dataNasabah)) {
                    $newpass = '';
                    $oldpass = '';

                    try {
                        $newpass = $data['new_password'];
                        $oldpass = $data['old_password'];

                        $this->validation->run($data,'editNewPassword');
                        $errors = $this->validation->getErrors();
                        
                        if($errors) {
                            $response = [
                                'status'   => 400,
                                'error'    => true,
                                'messages' => $errors,
                            ];
                    
                            return $this->respond($response,400);
                        } 
                    } 
                    catch (Exception $e) {}
            
                    $data = [
                        "id"           => $data['id'],
                        "username"     => $data['username'],
                        "nama_lengkap" => $data['nama_lengkap'],
                        "notelp"       => $data['notelp'],
                        "alamat"       => $data['alamat'],
                        "tgl_lahir"    => $data['tgl_lahir'],
                        "kelamin"      => $data['kelamin'],
                    ];

                    if ($newpass != '') {
                        if (password_verify($oldpass,$dataNasabah['password'])) {
                            $data['password'] = password_hash($newpass, PASSWORD_DEFAULT);
                            unset($data['new_password']);
                            unset($data['old_password']);
                        } 
                        else {
                            return $this->fail("wrong old password",401,true);
                        }
                    }

                    $editNasabah  = $nasabahModel->editProfileNasabah($data);

                    if ($editNasabah['success'] == true) {
                        $response = [
                            'status' => 201,
                            'error' => false,
                            'messages' => $editNasabah['message'],
                        ];
    
                        return $this->respond($response,201);
                    } 
                    else {
                        $response = [
                            'status'   => $editNasabah['code'],
                            'error'    => true,
                            'messages' => $editNasabah['message'],
                        ];
                
                        return $this->respond($response,$editNasabah['code']);
                    }
                } 
                else {
                    return $this->fail("nasabah with id $id not found",404,true);
                }
                
            }
        } 
        else {
            $response = [
                'status'   => $result['code'],
                'error'    => true,
                'messages' => $result['message'],
            ];
    
            return $this->respond($response,$result['code']);
        }
        
    }

    public function logout()
    {
        $authHeader = $this->request->getHeader('token');
        $token      = $authHeader->getValue();
        $result     = $this->baseController->checkToken($token);

        if ($result['success'] == true) {
            $nasabahModel = new NasabahModel();
            $id           = $result['message']['data']['id'];
            $editNasabah  = $nasabahModel->setTokenNull($id);

            if ($editNasabah['success'] == true) {
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => $editNasabah['message'],
                ];

                return $this->respond($response,200);
            } 
            else {
                $response = [
                    'status'   => $editNasabah['code'],
                    'error'    => true,
                    'messages' => $editNasabah['message'],
                ];
        
                return $this->respond($response,$editNasabah['code']);
            }
        } 
        else {
            $response = [
                'status'   => $result['code'],
                'error'    => true,
                'messages' => $result['message'],
            ];
    
            return $this->respond($response,$result['code']);
        }
        
    }
}