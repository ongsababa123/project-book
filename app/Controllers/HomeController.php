<?php

namespace App\Controllers;

use App\Models\BookModels;
use App\Models\CategoryModels;
use App\Models\CartModels;
use App\Models\HistoryModels;
use App\Models\PromotionModels;
use App\Models\UserModels;
use App\Models\LateFeesModels;

class HomeController extends BaseController
{
    public function index()
    {
        $BookModels = new BookModels();
        $HistoryModels = new HistoryModels();

        // ดึงข้อมูล id_book จากฐานข้อมูล
        $results = $HistoryModels->findAll(); // ปรับตามโครงสร้าง Model ของคุณ

        // รวบรวมทุกไอดีเข้ามาในอาร์เรย์
        $allIds = [];
        foreach ($results as $row) {
            $ids = explode(',', $row['id_book']);
            $allIds = array_merge($allIds, $ids);
        }

        // นับจำนวนครั้งที่แต่ละไอดีปรากฏซ้ำกัน
        $idCounts = array_count_values($allIds);

        // เรียงลำดับตามจำนวนครั้งที่ปรากฏ
        arsort($idCounts);

        // ดึง 3 อันดับแรก
        $top3Ids = array_slice($idCounts, 0, 3, true);

        // ดึงข้อมูลของไอดีที่มีจำนวนครั้งซ้ำมากที่สุด 3 อันดับ
        $top3Ids = array_keys($top3Ids);


        // ตรวจสอบว่ามีไอดีที่ซ้ำกันหรือไม่
        if (!empty($top3Ids)) {
            // ใช้คำสั่ง WHERE IN เพื่อดึงข้อมูลจากฐานข้อมูล
            $data['bookData'] = $BookModels->whereIn('id_book', $top3Ids)->findAll();
        } else {
            // กรณีไม่มีไอดีที่ซ้ำกัน
            $data['bookData'] = $BookModels->orderBy('RAND()')->limit(3)->get()->getResultArray();
        }
        echo view('userview/layout/header_home');
        echo view('userview/Home', $data);
        echo view('userview/layout/footer');

    }

    public function index_listbook()
    {
        // Instantiate models
        $BookModels = new BookModels();
        $CategoryModels = new CategoryModels();
        $UserModels = new UserModels();
        $PromotionModels = new PromotionModels();
        $data['userData'] = $UserModels->where('id_user', session()->get('id'))->findAll();

        // Retrieve all categories with status 1
        $data['categoryData'] = $CategoryModels->where('status', 1)->findAll();
        $data['promotionData'] = $PromotionModels->where('status', 1)->findAll();

        // Loop through categories and retrieve books for each category with status 1
        $data['bookData'] = [];

        foreach ($data['categoryData'] as $Category) {
            // Retrieve books for a specific category with status_book 1
            $booksForCategory = $BookModels
                ->where('category_id', $Category['id_category'])
                ->whereIn('status_book', [1, 2])
                ->findAll();

            // Merge the books for the current category into the main array
            $data['bookData'] = array_merge($data['bookData'], $booksForCategory);
        }


        // Load views
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
            'id_user' => session()->get('id'),
            'id_book' => $id_book,
            'cart_date' => date('Y-m-d H:i:s'),
            'status_cart' => 1,
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
        $UserModels = new UserModels();

        $data['categoryData'] = $CategoryModels->where('id_category', session()->get('id'))->findAll();
        $data['cartData'] = $CartModels->where('id_user', session()->get('id'))->findAll();
        $data['userData'] = $UserModels->where('id_user', session()->get('id'))->findAll();

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
        $userModels = new UserModels();
        $HistoryModels = new HistoryModels();
        $data['user_data'] = $userModels->where('id_user', session()->get('id'))->findAll();
        $data['count_data'] = $HistoryModels->where('id_user', session()->get('id'))->countAllResults();

        echo view('userview/layout/header_home');
        echo view('userview/Profile', $data);
        echo view('userview/layout/footer');
    }

    public function index_history()
    {
        $HistoryModels = new HistoryModels();
        $BookModels = new BookModels();
        $CategoryModels = new CategoryModels();
        $PromotionModels = new PromotionModels();
        $LateFeesModels = new LateFeesModels();

        // Fetch history data for user with id session()->get('id')
        $data['HistoryData'] = $HistoryModels->where('id_user', session()->get('id'))->findAll();
        $data['PromotionData'] = $PromotionModels->findAll();
        $data['data_latefees'] = $LateFeesModels->findAll();

        // Create an array to store book data with associated category and promotion data
        $data['bookData'] = [];

        foreach ($data['HistoryData'] as $key => $value) {
            // Split the comma-separated ids
            $id_books = explode(',', $value['id_book']);

            // Create an array to store promotion data

            // Fetch book data for each id
            foreach ($id_books as $id) {
                // Check if the book id is not already in the array
                $bookData = $BookModels->where('id_book', $id)->findAll();

                // Fetch category data for the book
                $categoryData = $CategoryModels->where('id_category', $bookData[0]['category_id'])->findAll();

                // Associate promotion, category, and book data
                $bookData[0]['categoryData'] = $categoryData[0];

                // Check if the book data is not already in the array
                if (!in_array($bookData[0], $data['bookData'])) {
                    // Add the fetched book data with associated category and promotion data to the array
                    $data['bookData'][] = $bookData[0];
                }
            }
        }

        // Load views
        echo view('userview/layout/header_base');
        echo view('userview/History', $data);
        echo view('userview/layout/footer');
    }

}
