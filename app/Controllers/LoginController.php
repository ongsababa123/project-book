<?php

namespace App\Controllers;

use App\Models\UserModels;
use App\Models\DetailsModels;

// use App\Models\CategoryModels;

class LoginController extends BaseController
{

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
                } else {
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
                $key_pass = password_hash($number_random, PASSWORD_DEFAULT);
                $key_pass = str_replace(['.', '/'], '', $key_pass);
                $data = [
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'key_pass' => $key_pass,
                ];
                $userModels->set($data);
                $updated = $userModels->where('email_user', $email)->update();
                $data = $userModels->where('email_user', $email)->first();
                $this->sendMail_keypass($data, $number_random);
                if ($updated) {
                    $response = [
                        'success' => true,
                        'message' => 'อัปเดตข้อมูลสำเร็จรหัสผ่านสำรองจะถูกส่งไปที่อีเมล์ของคุณ',
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

    public function request_resetpassword()
    {
        $UserModels = new UserModels();
        $email = $this->request->getVar('email');
        $data = $UserModels->where('email_user', $email)->first();
        $check = $this->sendMail($email, $data);
        if ($data) {
            if ($check) {
                $response = [
                    'success' => true,
                    'message' => 'กรุณาตรวจสอบอีเมล์ของคุณเพื่อเปลี่ยนรหัสผ่าน',
                    'reload' => false,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'อีเมล์ไม่ถูกต้อง',
                    'reload' => false,
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

    function sendMail($email = null, $data = null)
    {
        $to = $email;
        $imagePath = 'http://52.139.174.147/test/dist/img/logo11.png';
        $url_resetpassword = base_url('resetpassword/' . $data['key_pass'] . '/' . $email);

        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom($to, 'Bang book shop');

        #send mail for reset password
        $email->setSubject("รีเซ็ตรหัสผ่าน");

        // Load the email template view
        $email_template = view('email_resetpass_template', ['imagePath' => $imagePath, 'data' => $data, 'url_resetpassword' => $url_resetpassword]);

        $email->setMessage($email_template);

        if ($email->send()) {
            $check = true;
        } else {
            $check = false;
        }

        return $check;
    }

    function sendMail_keypass($data = null, $number_random = null)
    {
        $to = $data['email_user'];
        // $imagePath = base_url('dist/img/logo11.png');
        $imagePath = 'http://52.139.174.147/test/dist/img/logo11.png';

        $email = \Config\Services::email();

        $email->setTo($to);
        $email->setFrom($to, 'Bang book shop');
        #send mail for reset password
        $email->setSubject("รหัสผ่านสำรอง");
        // $email->setMessage('รหัสผ่านสำรองของคุณคือ ' . $number_random . ' ใช้สำหรับการเข้าสู่ระบบ' . '<br>');
        $email_template = view('email_keypass_template', ['imagePath' => $imagePath, 'data' => $data, 'number_random' => $number_random]);

        $email->setMessage($email_template);

        if ($email->send()) {
            $check = true;
        } else {
            $check = false;
        }

        return $check;
    }

    public function index_Login()
    {
        $DetailsModels = new DetailsModels();
        $data['details'] = $DetailsModels->findAll();

        echo view('Login', $data);
    }
    public function index_Register()
    {
        $DetailsModels = new DetailsModels();
        $data['details'] = $DetailsModels->findAll();

        echo view('Register', $data);
    }

    public function index_forgotpassword()
    {
        $DetailsModels = new DetailsModels();
        $data['details'] = $DetailsModels->findAll();

        echo view('Forgotpassword', $data);
    }

    public function index_resetpassword($pin = null, $email = null)
    {
        $DetailsModels = new DetailsModels();
        $data_['details'] = $DetailsModels->findAll();

        $data = [
            'pin' => $pin,
            'email' => $email
        ];
        echo view('ResetPassword', $data + $data_);
    }
}
