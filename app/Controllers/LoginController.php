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

        if ($data) {
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if ($data['type_user'] === '4') {
                $url = '';
            } else {
                $url = '/dashboard/index';
            }
            if ($authenticatePassword) {
                if ($data['status_user'] === '1') {
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
                        'message' => 'บัญชีผู้ใช้นี้ถูกระงับ',
                        'reload' => false,
                    ];
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'อีเมล์หรือรหัสผ่านไม่ถูกต้อง',
                    'reload' => false,
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'อีเมล์หรือรหัสผ่านไม่ถูกต้อง',
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

    public function index_resetpassword($pin = null, $email = null)
    {
        $data = [
            'pin' => $pin,
            'email' => $email
        ];
        echo view('ResetPassword', $data);
    }

    public function update_resetpassword()
    {
        helper(['form']);
        $userModels = new UserModels();

        $password = $this->request->getVar('password');
        $email = $this->request->getVar('email');
        $pin = $this->request->getVar('pin');

        $data = $userModels->where('email_user', $email)->first();
        if ($data) {
            if ($data['key_pass'] === $pin) {
                $number_random = mt_rand(100000, 999999);
                $data = [
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'key_pass' => password_hash(str_replace(['.', '/'], '', $number_random), PASSWORD_DEFAULT),
                ];
                $userModels->set($data);
                $updated = $userModels->where('email_user', $email)->update();
                if ($updated) {
                    $response = [
                        'success' => true,
                        'message' => 'อัปเดตรหัสผ่านใหม่สำเร็จ รหัส 6 หลักคุณคือ ' . $number_random . ' ใช้ในกรณีลืมรหัสผ่าน',
                        'reload' => true,
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'error',
                        'reload' => false,
                    ];
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'ไม่สามารถเปลี่ยนรหัสผ่านได้',
                    'reload' => false,
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'ไม่สามารถเปลี่ยนรหัสผ่านได้ กรุณาติดต่อผู้ดูแลระบบ',
                'reload' => false,
            ];
        }

        return $this->response->setJSON($response);
    }

    public function checkpin()
    {
        $UserModels = new UserModels();
        $email = $this->request->getVar('email');
        $pin = $this->request->getVar('pin');

        $data = $UserModels->where('email_user', $email)->first();

        if ($data) {
            $key_pass = $data['key_pass'];
            $authenticatePin = password_verify($pin, $key_pass);

            if ($authenticatePin) {
                $response = [
                    'success' => true,
                    'message' => 'รหัส PIN ถูกต้อง',
                    'reload' => true,
                    'data' => $key_pass . '/' . $email
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'รหัส PIN ไม่ถูกต้อง',
                    'reload' => false,
                    'data' => $key_pass
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'อีเมล์ไม่ถูกต้อง',
                'reload' => false,
                'data' => $data
            ];
        }

        return $this->response->setJSON($response);
    }

}
