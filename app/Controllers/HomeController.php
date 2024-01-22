<?php

namespace App\Controllers;

use App\Models\BookModels;
use App\Models\CategoryModels;
use App\Models\CartModels;
use App\Models\HistoryModels;
use App\Models\PromotionModels;
use App\Models\UserModels;
use App\Models\LateFeesModels;
use App\Models\DetailsModels;
use App\Models\DayrentModels;
use App\Models\StockBookModels;
use App\Controllers\HistoryController;

class HomeController extends BaseController
{
    public function index()
    {
        $HistoryController = new HistoryController();
        $HistoryController->check_stock_all();
        $BookModels = new BookModels();
        $HistoryModels = new HistoryModels();

        $DetailsModels = new DetailsModels();
        $data_details['details'] = $DetailsModels->findAll();
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
        echo view('userview/layout/header_home', $data_details);
        echo view('userview/Home', $data);
        echo view('userview/layout/footer');

    }

    public function index_listbook()
    {
        // Instantiate models
        $HistoryController = new HistoryController();
        $HistoryController->check_stock_all();
        $BookModels = new BookModels();
        $CategoryModels = new CategoryModels();
        $UserModels = new UserModels();
        $PromotionModels = new PromotionModels();
        $DetailsModels = new DetailsModels();
        $StockBookModels = new StockBookModels();
        $data_details['details'] = $DetailsModels->findAll();
        $data['userData'] = $UserModels->where('id_user', session()->get('id'))->findAll();

        // Retrieve all categories with status 1
        $data['categoryData'] = $CategoryModels->where('status', 1)->findAll();
        usort($data['categoryData'], function ($a, $b) {
            return strcmp($a['name_category'], $b['name_category']);
        });
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

        foreach ($data['bookData'] as $key => $value) {
            // var_dump($key);
            $count_stock = $StockBookModels->where('id_book', $value['id_book'])->where('status_stock', 1)->countAllResults();
            $numver = [
                'count_stock' => $count_stock
            ];
            $data['bookData'][$key] = array_merge($data['bookData'][$key], $numver);
        }
        // เรียงลำดับอาร์เรย์ bookData ตามชื่อหนังสือ (คาดว่าชื่อหนังสือถูกเก็บไว้ในฟิลด์ที่ชื่อ 'name' ในฐานข้อมูล)
        $this->sortBookData($data['bookData']);

        // Load views
        echo view('userview/layout/header_base', $data_details);
        echo view('userview/Booklist', $data);
        echo view('userview/layout/footer');
    }
    private function sortBookData(&$bookData)
    {
        // Create a Thai collator
        $collator = collator_create('th_TH');

        // Define the sorting function
        $sortingFunction = function ($a, $b) use ($collator) {
            return collator_compare($collator, $a['name_book'], $b['name_book']);
        };

        // Sort the array using the custom sorting function
        usort($bookData, $sortingFunction);
    }

    public function index_bookdetails($id_book = null)
    {
        $HistoryController = new HistoryController();
        $HistoryController->check_stock_all();
        $BookModels = new BookModels();
        $CategoryModels = new CategoryModels();
        $UserModels = new UserModels();
        $DetailsModels = new DetailsModels();
        $StockBookModels = new StockBookModels();
        $data_details['details'] = $DetailsModels->findAll();
        $data['bookData'] = $BookModels->where('id_book', $id_book)->findAll();
        $data['categoryData'] = $CategoryModels->where('id_category', $data['bookData'][0]['category_id'])->findAll();
        $data['userData'] = $UserModels->where('id_user', session()->get('id'))->findAll();
        foreach ($data['bookData'] as $key => $value) {
            // var_dump($key);
            $count_stock = $StockBookModels->where('id_book', $value['id_book'])->where('status_stock', 1)->countAllResults();
            $numver = [
                'count_stock' => $count_stock
            ];
            $data['bookData'][$key] = array_merge($data['bookData'][$key], $numver);
        }
        echo view('userview/layout/header_base', $data_details);
        echo view('userview/Bookdetails', $data);
        echo view('userview/layout/footer');
    }

    public function add_cart($id_book = null)
    {
        date_default_timezone_set('Asia/Bangkok');
        $CartModels = new CartModels();
        $BookModels = new BookModels();
        $HistoryController = new HistoryController();

        $HistoryController->check_stock_all();
        $Bookdata = $BookModels->where('id_book', $id_book)->findAll();
        $data = [
            'id_book' => $id_book,
        ];
        $id_stock_book = $HistoryController->reserve_book_stock($data);

        if ($id_stock_book != null) {
            $data = [
                'id_user' => session()->get('id'),
                'id_book' => $id_book,
                'id_stock_book' => $id_stock_book,
                'cart_date' => date('Y-m-d H:i:s'),
                'status_cart' => 1,
            ];

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
        } else {
            $response = [
                'success' => false,
                'message' => 'หนังสือ ' . $Bookdata[0]['name_book'] . ' ถูกจองไปแล้ว',
                'reload' => false,
            ];
        }

        return $this->response->setJSON($response);
    }

    public function index_cart()
    {
        $HistoryController = new HistoryController();
        $HistoryController->check_stock_all();
        $CartModels = new CartModels();
        $BookModels = new BookModels();
        $CategoryModels = new CategoryModels();
        $UserModels = new UserModels();
        $DetailsModels = new DetailsModels();
        $DayrentModels = new DayrentModels();

        $data_details['details'] = $DetailsModels->findAll();
        $data['categoryData'] = $CategoryModels->where('id_category', session()->get('id'))->findAll();
        $data['cartData'] = $CartModels->where('id_user', session()->get('id'))->findAll();
        $data['userData'] = $UserModels->where('id_user', session()->get('id'))->findAll();
        $data['data_dayrent'] = $DayrentModels->findAll();

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

        echo view('userview/layout/header_base', $data_details);
        echo view('userview/Cart', $data);
        echo view('userview/layout/footer');
    }


    public function index_contact()
    {
        $HistoryController = new HistoryController();
        $HistoryController->check_stock_all();
        $DetailsModels = new DetailsModels();
        $data_details['details'] = $DetailsModels->findAll();

        echo view('userview/layout/header_base', $data_details);
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
        $email->setTo('bookbanglem31@gmail.com');
        $email->setFrom('bookbanglem31@gmail.com', 'Bang book shop');

        $email->setSubject("ความคิดเห็น ข้อเสนอแนะ และรายงานปัญหา");
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
        $HistoryController = new HistoryController();
        $HistoryController->check_stock_all();
        $userModels = new UserModels();
        $HistoryModels = new HistoryModels();
        $DetailsModels = new DetailsModels();
        $data_details['details'] = $DetailsModels->findAll();
        $data['user_data'] = $userModels->where('id_user', session()->get('id'))->findAll();
        $data['count_data'] = $HistoryModels->where('id_user', session()->get('id'))->countAllResults();

        echo view('userview/layout/header_home', $data_details);
        echo view('userview/Profile', $data);
        echo view('userview/layout/footer');
    }

    public function index_history()
    {
        $HistoryController = new HistoryController();
        $HistoryController->check_stock_all();
        $HistoryModels = new HistoryModels();
        $BookModels = new BookModels();
        $CategoryModels = new CategoryModels();
        $PromotionModels = new PromotionModels();
        $LateFeesModels = new LateFeesModels();
        $DetailsModels = new DetailsModels();
        $data_details['details'] = $DetailsModels->findAll();
        // Fetch history data for user with id session()->get('id')
        $data['HistoryData_1'] = $HistoryModels->where('status_his', 1)
            ->where('id_user', session()->get('id'))
            ->orderBy('id_history', 'desc')
            ->findAll();

        $data['HistoryData_2'] = $HistoryModels->where('status_his', 2)
            ->where('id_user', session()->get('id'))
            ->orderBy('id_history', 'desc')
            ->findAll();

        $data['HistoryData_3'] = $HistoryModels->where('status_his', 3)
            ->where('id_user', session()->get('id'))
            ->orderBy('id_history', 'desc')
            ->findAll();

        // ตรงนี้คือส่วนที่อาจจะมีการโยนข้อมูลไปยัง view หรือทำอย่างอื่นต่อไป
// เช่น return view('your_view', $data);

        $data['PromotionData'] = $PromotionModels->findAll();
        $data['data_latefees'] = $LateFeesModels->findAll();

        // Create an array to store book data with associated category and promotion data
        $data['bookData'] = [];

        foreach ($data['HistoryData_1'] as $key => $value) {
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
        foreach ($data['HistoryData_2'] as $key => $value) {
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
        foreach ($data['HistoryData_3'] as $key => $value) {
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
        echo view('userview/layout/header_base', $data_details);
        echo view('userview/History', $data);
        echo view('userview/layout/footer');
    }

}
