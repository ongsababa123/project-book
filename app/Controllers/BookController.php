<?php

namespace App\Controllers;

use App\Models\CategoryModels;
use App\Models\BookModels;
use App\Models\StockBookModels;
use App\Controllers\HistoryController;

class BookController extends BaseController
{
    protected $helpers = ['form'];
    public function index()
    {
        $CategoryModels = new CategoryModels();
        $data['categoryData'] = $CategoryModels->findAll();
        $HistoryController = new HistoryController();
        $HistoryController->check_stock_all();

        echo view('dashboard/layout/header');
        echo view('dashboard/book', $data);
    }

    public function index_stock_id($id_book = null)
    {
        $BookModels = new BookModels();
        $data['bookData'] = $BookModels->where('id_book', $id_book)->first();
        echo view('dashboard/layout/header');
        echo view('dashboard/stock_book_id', $data);
    }

    public function index_stock_all()
    {
        $BookModels = new BookModels();

        // ดึงข้อมูลเฉพาะ name_book และ id_book
        $data['bookData'] = $BookModels->select('name_book, id_book')->findAll();

        echo view('dashboard/layout/header');
        echo view('dashboard/stock_book_all', $data);
    }


    public function create_book()
    {
        $BookModels = new BookModels();
        $profile_picture = $this->request->getFile('uploadImage');
        $data = [
            'name_book' => $this->request->getVar('name_book'),
            'book_author' => $this->request->getVar('name_book_author'),
            'details' => $this->request->getVar('detail_category'),
            'status_book' => 0,
            'price' => $this->request->getVar('price_book'),
            'price_book' => $this->request->getVar('price_book_book'),
            'category_id' => $this->request->getVar('categorySelect'),
        ];
        if ($profile_picture->isValid() && !$profile_picture->hasMoved()) {
            $validationRules = [
                'uploadImage' => 'max_size[uploadImage,10240]', // 10MB in kilobytes
            ];
            // Validate the input
            if (!$this->validate($validationRules)) {
                $response = [
                    'success' => false,
                    'message' => 'ผิดพลาด',
                    'reload' => false,
                    'image_error' => 'ไฟล์จะต้องมีขนาดต่ำกว่า 10MB'
                ];
                return $this->response->setJSON($response);
            }
            $minFileSize = 1024; // 1MB in kilobytes
            if ($profile_picture->getSize() >= $minFileSize) {
                if ($profile_picture->isValid() && !$profile_picture->hasMoved()) {
                    $imageData = file_get_contents($profile_picture->getTempName()); // Read image file data
                    $base64ImageData = base64_encode($imageData);
                    $data['pic_book'] = $base64ImageData;
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'ผิดพลาด',
                    'reload' => false,
                    'image_error' => 'ไฟล์จะต้องมีขนาดอย่างน้อย 1MB'
                ];
                return $this->response->setJSON($response);
            }
        }
        $check = $BookModels->save($data);
        if ($check) {
            $response = [
                'success' => true,
                'message' => 'สร้างข้อมูลสำเร็จ',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'error',
                'reload' => false,
            ];
        }


        return $this->response->setJSON($response);
    }

    public function create_stock($id_book = null)
    {
        $StockBookModels = new StockBookModels();
        $BookModels = new BookModels();
        $quantity = $this->request->getVar('quantity');
        $response = []; // Initialize the response array outside the loop
    
        for ($i = 0; $i < $quantity; $i++) {
            do {
                $number_random = mt_rand(100000, 999999);
                $id_number_ = $this->generateIdNumber($id_book, $number_random, $BookModels);
                $check = $StockBookModels->where('id_number_', $id_number_)->first();
            } while ($check); // Keep generating until a unique id_number_ is found
    
            $data = [
                'id_book' => $id_book,
                'id_number_' => $id_number_,
                'status_stock' => 0
            ];
            $check = $StockBookModels->save($data);
    
            if (!$check) {
                $response = [
                    'success' => false,
                    'message' => 'Error saving data',
                    'reload' => false,
                ];
                break; // Exit the loop if an error occurs during saving
            }
        }
    
        if (empty($response)) {
            $response = [
                'success' => true,
                'message' => 'สร้างข้อมูลสำเร็จ',
                'reload' => true,
            ];
        }
    
        return $this->response->setJSON($response);
    }
    
    private function generateIdNumber($id_book, $number_random, $BookModels)
    {
        $data_book = $BookModels->where('id_book', $id_book)->find();
        return $data_book[0]['id_book'] . '-' . ($data_book[0]['category_id'] . '-' . $number_random);
    }
    

    function change_status_stock_function($id_stock = null, $status = null, $bypass_edit = null)
    {
        $StockBookModels = new StockBookModels();
        $data = [
            'status_stock' => $status
        ];
        $status_stock = $StockBookModels->where('id_stock', $id_stock)->findAll()[0]['status_stock'];
        if ($status_stock == 0 || $status_stock == 1 || $status_stock == 2 || $bypass_edit == 1) {
            $check = $StockBookModels->update($id_stock, $data);
            if ($check) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    public function change_status_stock($id_stock = null, $status = null)
    {
        $StockBookModels = new StockBookModels();
        $description = $this->request->getVar('description');
        if ($description == "") {
            $description = null;
        }
        $data = [
            'status_stock' => $status,
            'description' => $description,
        ];
        $check = $StockBookModels->update($id_stock, $data);
        if ($check) {
            $response = [
                'success' => true,
                'message' => 'เปลี่ยนสถานะสำเร็จ',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'error',
                'reload' => false,
            ];
        }

        return $this->response->setJSON($response);
    }

    public function edit_book($id_book = null)
    {
        $BookModels = new BookModels();

        $data = [
            'price' => $this->request->getVar('price_book'),
        ];

        $check = $BookModels->update($id_book, $data);
        if ($check) {
            $response = [
                'success' => true,
                'message' => 'อัพเดทข้อมูลสำเร็จ',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'error',
                'reload' => false,
            ];
        }

        return $this->response->setJSON($response);
    }

    public function delete_book($id_book = null)
    {
        helper(['form']);
        $BookModels = new BookModels();

        $check = $BookModels->where('id_book', $id_book)->delete($id_book);
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

    public function get_data_table($category_id = null)
    {
        $BookModels = new BookModels();
        $StockBookModels = new StockBookModels();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $BookModels->groupStart()
                ->like('name_book', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('price', $searchValue)
                ->orLike('price_book', $searchValue)
                // เพิ่มคอลัมน์เพิ่มเติมตามที่ต้องการค้นหา
                ->groupEnd();
        }
        if ($category_id != 0) {
            $totalRecords = $BookModels->where('category_id', $category_id)->countAllResults();
        } else {
            $totalRecords = $BookModels->countAllResults();
        }
        $recordsFiltered = $totalRecords;

        if (!empty($searchValue)) {
            $BookModels->groupStart()
                ->like('name_book', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('price', $searchValue)
                ->orLike('price_book', $searchValue)
                // เพิ่มคอลัมน์เพิ่มเติมตามที่ต้องการค้นหา
                ->groupEnd();
        }
        if ($category_id != 0) {
            $data = $BookModels->where('category_id', $category_id)->findAll($limit, $start);
        } else {
            $data = $BookModels->findAll($limit, $start);
        }

        foreach ($data as $key => $value) {
            $count_stock = $StockBookModels->where('id_book', $value['id_book'])->where('status_stock', 1)->countAllResults();
            $numver = [
                'count_stock' => $count_stock
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

    public function get_data_table_stock($id_book = null)
    {
        $StockBookModels = new StockBookModels();
        $BookModels = new BookModels();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];
        $value = 6;

        if (!empty($searchValue)) {
            if ($searchValue == 'ไม่พร้อมใช้งาน') {
                $value = 0;
            } else if ($searchValue == 'พร้อมใช้งาน') {
                $value = 1;
            } else if ($searchValue == 'กำลังเช่า') {
                $value = 2;
            } else if ($searchValue == 'หนังสือหาย') {
                $value = 3;
            } else if ($searchValue == 'หนังสือชำรุด') {
                $value = 4;
            } else if ($searchValue == 'หนังสือไม่สามารถใช้ต่อได้') {
                $value = 5;
            }
        }

        if ($id_book != 0) {
            if (!empty($searchValue)) {
                $StockBookModels->groupStart()
                    ->like('id_number_', $searchValue)
                    ->orLike('status_stock', $value)
                    ->groupEnd();
            }
            $totalRecords = $StockBookModels->where('id_book', $id_book)->countAllResults();
            if (!empty($searchValue)) {
                $StockBookModels->groupStart()
                    ->like('id_number_', $searchValue)
                    ->orLike('status_stock', $value)
                    ->groupEnd();
            }
            $data = $StockBookModels->where('id_book', $id_book)->findAll($limit, $start);
        } else {
            // ตั้งค่าการค้นหา
            if (!empty($searchValue)) {
                $StockBookModels->groupStart()
                    ->like('id_number_', $searchValue)
                    ->orLike('status_stock', $value)
                    ->orLike('book_table.name_book', $searchValue) // ค้นหา name_book
                    ->groupEnd();
            }

            // นำข้อมูลจาก $StockBookModels และ $BookModels ด้วยการ join
            $StockBookModels->join('book_table', 'book_table.id_book = stock_book_table.id_book');

            // ดึงข้อมูลจาก $StockBookModels โดยเรียงลำดับตามคอลัมน์ id_book
            $data_stock_books = $StockBookModels->orderBy('stock_book_table.id_book')->findAll($limit, $start);

            // นับจำนวนรายการทั้งหมดใน $StockBookModels
            $totalRecords = $StockBookModels->countAllResults();

            // $data_stock_books ตอนนี้จะมีคอลัมน์ name_book ที่ถูกเพิ่มเข้าไป
            $data = $data_stock_books;


        }
        $recordsFiltered = $totalRecords;


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
