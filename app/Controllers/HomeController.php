<?php

namespace App\Controllers;

use App\Models\BookModels;
use App\Models\CategoryModels;
use App\Models\CartModels;

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

    public function index_bookdetails($id_book = null)
    {
        $BookModels = new BookModels();
        $CategoryModels = new CategoryModels();
        $data['bookData'] = $BookModels->where('id_book', $id_book)->findAll();
        $data['categoryData'] = $CategoryModels->where('id_category', $data['bookData'][0]['category_id'])->findAll();
        echo view('userview/layout/header_base');
        echo view('userview/Bookdetails', $data);
        echo view('userview/layout/footer');
    }

    public function add_cart($id_book = null)
    {
        $CartModels = new CartModels();
        $BookModels = new BookModels();
        date_default_timezone_set('Asia/Bangkok');

        $data = [
            'id_user' => 1,
            'id_book' => $id_book,
            'cart_date' => date('Y-m-d H:i:s')
        ];

        $data_book = [
            'status_book' => 2,
        ];
        $BookModels->update($id_book, $data_book);

        $check = $CartModels->save($data);
        if ($check) {
            $response = [
                'success' => true,
                'message' => 'เพิ่มเข้าตระกร้าแล้ว!',
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

    public function index_cart()
    {
        $CartModels = new CartModels();
        $BookModels = new BookModels();
        $CategoryModels = new CategoryModels();
        
        $data['categoryData'] = $CategoryModels->where('id_category', 1)->findAll();
        $data['cartData'] = $CartModels->where('id_user', 1)->findAll();
    
        foreach ($data['cartData'] as $key => $value) {
            // Retrieve book data for the current cart item
            $bookData = $BookModels->where('id_book', $value['id_book'])->findAll();
            $data['cartData'][$key]['bookData'] = $bookData;
    
            // Assuming each cart item is associated with a specific book, you can directly fetch its category
            if (!empty($bookData)) {
                $categoryId = $bookData[0]['category_id'];
                $data['cartData'][$key]['categoryData'] = $CategoryModels->where('id_category', $categoryId)->findAll();
            }
        }
    
        echo view('userview/layout/header_base');
        echo view('userview/Cart', $data);
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
        $email->setMessage('อีเมล์ผู้ส่ง' . '<br>' . $to . "<br>" . 'ชื่อผู้ส่ง ' . $name . ' ' . $lastname . "<br>" . 'รายละเอียด' . '<br> ' . $message);

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

    public function index_history()
    {
        echo view('userview/layout/header_base');
        echo view('userview/History');
        echo view('userview/layout/footer');
    }
}
