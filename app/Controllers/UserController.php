<?php

namespace App\Controllers;

use App\Models\HistoryModels;
use App\Models\UserModels;
use App\Models\BookModels;
use App\Models\CategoryModels;
use App\Models\LateFeesModels;

class UserController extends BaseController
{
    public function customer_index()
    {
        $BookModels = new BookModels();
        $HistoryModels = new HistoryModels();
        $CategoryModels = new CategoryModels();
        $LateFeesModels = new LateFeesModels();
        $data['data_book'] = $BookModels->findAll();
        $data['data_category'] = $CategoryModels->findAll();
        $data['data_latefees'] = $LateFeesModels->findAll();
        $data['data_history'] = $HistoryModels->findAll();

        echo view('dashboard/layout/header');
        echo view('dashboard/customer', $data);
    }

    public function employee_index()
    {
        echo view('dashboard/layout/header');
        echo view('dashboard/employee');
    }

    public function owner_index()
    {
        echo view('dashboard/layout/header');
        echo view('dashboard/owner');
    }

    public function admin_index()
    {
        echo view('dashboard/layout/header');
        echo view('dashboard/admin');
    }

    public function profile_index()
    {
        $UserModels = new UserModels();
        $data['data_user'] = $UserModels->where('id_user', session()->get('id'))->find();
        echo view('dashboard/layout/header');
        echo view('dashboard/profile', $data);
    }

    public function create_user($type = null)
    {
        helper(['form']);
        $rules = [
            'name' => 'required|min_length[2]|max_length[200]',
            'last' => 'required|min_length[2]|max_length[200]',
            'phone' => 'required|min_length[10]|max_length[10]',
            'email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[user_table.email_user]',
        ];
        $number_random = mt_rand(100000, 999999);
        if ($this->validate($rules)) {
            $userModels = new UserModels();
            $data_check = $userModels->findAll();
            $name_create = $this->request->getVar('name');
            $lastname_create = $this->request->getVar('last');
            $check_Data = true;
            foreach ($data_check as $value) {
                if ($value['name'] == $name_create && $value['lastname'] == $lastname_create) {
                    $check_Data = false;
                }
            }
            if ($check_Data) {
                $data = [
                    'email_user' => $this->request->getVar('email'),
                    'name' => $this->request->getVar('name'),
                    'lastname' => $this->request->getVar('last'),
                    'phone' => $this->request->getVar('phone'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'key_pass' => password_hash(str_replace(['.', '/'], '', $number_random), PASSWORD_DEFAULT),
                    'status_user' => 1,
                    'status_rental' => 1,
                    'type_user' => $type,
                ];
                $check = $userModels->save($data);
                if ($check) {
                    $response = [
                        'success' => true,
                        'message' => 'สร้างข้อมูลสำเร็จ รหัส 6 หลักคุณคือ ' . $number_random . ' ใช้ในกรณีลืมรหัสผ่าน',
                        'reload' => true,
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'error',
                        'reload' => false,
                    ];
                }
            }else{
                $response = [
                    'success' => false,
                    'message' => 'ชื่อและนามสกุลซ้ำกันในระบบ',
                    'reload' => false,
                ];
            }
        } else {
            $data['validation'] = $this->validator;
            $response = [
                'success' => false,
                'message' => 'ผิดพลาด',
                'validator' => $this->validator->getErrors(), // Get validation errors
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function edit_user($id_user = null)
    {
        helper(['form']);
        
        if ($this->request->getVar('customSwitch3') === null){
            $status = 1;
        }else{
            $status = $this->request->getVar('customSwitch3') === 'on' ? 1 : 0;

        }
        $rules = [
            'name' => 'required|min_length[2]|max_length[200]',
            'last' => 'required|min_length[2]|max_length[200]',
            'phone' => 'required|min_length[10]|max_length[10]',
            'email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[user_table.email_user,id_user,' . $id_user . ']',
        ];
        $password = $this->request->getVar('password');

        if ($this->validate($rules)) {
            $userModels = new UserModels();
            $data = [
                'email_user' => $this->request->getVar('email'),
                'name' => $this->request->getVar('name'),
                'lastname' => $this->request->getVar('last'),
                'phone' => $this->request->getVar('phone'),
                'status_user' => $status
            ];
            if ($password === '' || $password === null) {
                $response = [
                    'success' => true,
                    'message' => 'อัปเดตข้อมูลสำเร็จ',
                    'reload' => true,
                ];
            } else {
                $number_random = mt_rand(100000, 999999);
                $passdata = [
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'key_pass' => password_hash(str_replace(['.', '/'], '', $number_random), PASSWORD_DEFAULT),
                ];
                $data = array_merge($data, $passdata);
                $response = [
                    'success' => true,
                    'message' => 'อัปเดตข้อมูลสำเร็จ รหัส 6 หลักใหม่คือ ' . $number_random . ' ใช้ในกรณีลืมรหัสผ่าน',
                    'reload' => false,
                    'pass' => $password
                ];
            }
            $check = $userModels->update($id_user, $data);
            if (!$check) {
                $response = [
                    'success' => false,
                    'message' => 'error',
                    'reload' => false,
                ];
            }
        } else {
            $data['validation'] = $this->validator;
            $response = [
                'success' => false,
                'message' => 'ผิดพลาด',
                'validator' => $this->validator->getErrors(), // Get validation errors
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function edit_user_profile($id_user = null)
    {
        helper(['form']);
        $rules = [
            'name' => 'required|min_length[2]|max_length[200]',
            'last' => 'required|min_length[2]|max_length[200]',
            'phone' => 'required|min_length[10]|max_length[10]',
            'email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[user_table.email_user,id_user,' . $id_user . ']',
        ];
        $password = $this->request->getVar('password');

        if ($this->validate($rules)) {
            $userModels = new UserModels();
            $data = [
                'email_user' => $this->request->getVar('email'),
                'name' => $this->request->getVar('name'),
                'lastname' => $this->request->getVar('last'),
                'phone' => $this->request->getVar('phone'),
            ];
            if ($password !== '' && $password !== null) {
                $passdata = [
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                ];
                $data = array_merge($data, $passdata);
            }
            $check = $userModels->update($id_user, $data);
            $session = session();
            $data_update = $userModels->where('email_user', $this->request->getVar('email'))->first();
            $ses_data = [
                'id' => $data_update['id_user'],
                'name' => $data_update['name'],
                'lastname' => $data_update['lastname'],
                'type' => $data_update['type_user'],
                'isLoggedIn' => TRUE
            ];
            $session->set($ses_data);
            if ($check) {
                $response = [
                    'success' => true,
                    'message' => 'อัปเดตข้อมูลสำเร็จ',
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
            $data['validation'] = $this->validator;
            $response = [
                'success' => false,
                'message' => 'ผิดพลาด',
                'validator' => $this->validator->getErrors(), // Get validation errors
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function delete_user($id_user = null)
    {
        helper(['form']);
        $userModels = new UserModels();

        $check = $userModels->where('id_user', $id_user)->delete($id_user);
        if ($check) {
            $response = [
                'success' => true,
                'message' => 'ลบข้อมูลสำเร็จ!',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'error!',
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }
    public function get_data_table($type = null)
    {
        $UserModels = new UserModels();
        $HistoryModels = new HistoryModels();
        $totalRecords = $UserModels->where('type_user', $type)->countAllResults();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $UserModels->groupStart()
                ->like('email_user', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('name', $searchValue)
                ->orLike('lastname', $searchValue)
                ->orLike('phone', $searchValue)
                // เพิ่มคอลัมน์เพิ่มเติมตามที่ต้องการค้นหา
                ->groupEnd();
        }

        $recordsFiltered = $totalRecords;
        $recordsFiltered = $totalRecords;

        $data = $UserModels->where('type_user', $type)->findAll($limit, $start);

        foreach ($data as $key => $value) {
            $countHis = $HistoryModels->where('id_user', $value['id_user'])->countAllResults();
            $numver = [
                'counthis' => $countHis
            ];
            $data[$key] = array_merge($data[$key], $numver);
        }
        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
            'searchValue' => $searchValue,
        ];

        return $this->response->setJSON($response);
    }

}
