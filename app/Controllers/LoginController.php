<?php

namespace App\Controllers;

use App\Models\UserModels;
// use App\Models\CategoryModels;

class LoginController extends BaseController
{

    public function index_Login()
    {
        echo view('Login');
    }

    public function loginAuth()
    {
        $session = session();
        $UserModels = new UserModels();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $data = $UserModels->where('email_user', $email)->first();
        
        if($data){
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if($data['type_user'] === '4'){
                $url = '';
            }else{
                $url = '/dashboard/index';
            }
            if($authenticatePassword){
                $ses_data = [
                    'id' => $data['id_user'],
                    'name' => $data['name'],
                    'lastname' => $data['lastname'],
                    'type' => $data['type_user'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                $response = [
                    'success' => true,
                    'message' => 'เข้าสู่ระบบสำเร็จ',
                    'reload' => true,
                    'type' => $url,
                ];
            
            }else{
                $response = [
                    'success' => false,
                    'message' => 'รหัสผ่านไม่ถูกต้อง',
                    'reload' => false,
                ];
            }
        }else{
            $response = [
                'success' => false,
                'message' => 'อีเมล์ไม่ถูกต้อง',
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function logout()
    {

        $session = session();
        $session->destroy();

        return redirect()->to('/');
    }

    public function index_Register()
    {
        echo view('Register');
    }

    public function index_forgotpassword()
    {
        echo view('Forgotpassword');
    }

    public function index_resetpassword()
    {
        echo view('ResetPassword');
    }
}
