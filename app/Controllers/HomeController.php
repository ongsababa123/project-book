<?php

namespace App\Controllers;

use App\Models\BookModels;
use App\Models\CategoryModels;

class HomeController extends BaseController
{
    public function index()
    {
        $BookModels = new BookModels();
        $data['bookData'] = $BookModels->orderBy('RAND()')->limit(3)->get()->getResultArray();

        echo view('userview/layout/header_home');
        echo view('userview/Home', $data);
        echo view('userview/layout/footer');
    }

    public function index_listbook()
    {
        $BookModels = new BookModels();
        $CategoryModels = new CategoryModels();
        $data['bookData'] = $BookModels->where('status_book', 1)->findAll();
        $data['categoryData'] = $CategoryModels->where('status', 1)->findAll();

        echo view('userview/layout/header_base');
        echo view('userview/Booklist', $data);
        echo view('userview/layout/footer');
    }

    public function index_contact()
    {
        echo view('userview/layout/header_base');
        echo view('userview/Contact');
        echo view('userview/layout/footer');
    }

    function sendMail()
    {
        $to = $this->request->getVar('email');
        $name = $this->request->getVar('name');
        $lastname = $this->request->getVar('lastname');
        $message = $this->request->getVar('details');

        $email = \Config\Services::email();
        $email->setTo('6239010001@p-vec.ac.th');
        $email->setFrom('6239010001@p-vec.ac.th', 'Comments, suggestions, and problem reports');

        $email->setSubject("Comments, suggestions, and problem reports");
        $email->setMessage('อีเมล์ผู้ส่ง' .'<br>'.$to . "<br>" .'ชื่อผู้ส่ง '.$name .' '. $lastname ."<br>". 'รายละเอียด'. '<br> '.$message);

        if ($email->send()) {
            $response = [
                'success' => true,
                'message' => 'ส่งข้อความเรียบร้อย!',
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

    public function index_profile()
    {
        echo view('userview/layout/header_home');
        echo view('userview/Profile');
        echo view('userview/layout/footer');
    }

    public function index_cart()
    {
        echo view('userview/layout/header_base');
        echo view('userview/Cart');
        echo view('userview/layout/footer');
    }
}
