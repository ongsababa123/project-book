<?php

namespace App\Controllers;

use App\Models\HistoryModels;
use App\Models\UserModels;
use App\Models\BookModels;
use App\Models\CategoryModels;
use App\Models\LateFeesModels;
use App\Models\DayrentModels;
use App\Models\PromotionModels;
use App\Models\CartModels;
use App\Models\StockBookModels;
use App\Controllers\BookController;


class HistoryController extends BaseController
{
    protected $helpers = ['form'];
    public function history_index()
    {
        $UserModels = new UserModels();
        $BookModels = new BookModels();
        $CategoryModels = new CategoryModels();
        $LateFeesModels = new LateFeesModels();
        $DayrentModels = new DayrentModels();
        $PromotionModels = new PromotionModels();
        $StockBookModels = new StockBookModels();
        $this->check_stock_all();
        $data['data_user'] = $UserModels->where('type_user', 4)->where('status_user', 1)->findAll();
        $data['data_book'] = $BookModels->findAll();
        $data['data_category'] = $CategoryModels->findAll();
        $data['data_latefees'] = $LateFeesModels->findAll();
        $data['data_promotion'] = $PromotionModels->findAll();
        $data['data_dayrent'] = $DayrentModels->findAll();

        foreach ($data['data_book'] as $key => $value) {
            $count_stock = $StockBookModels->where('id_book', $value['id_book'])->where('status_stock', 1)->countAllResults();
            if (!empty($count_stock)) {
                // Merge the arrays correctly
                $data['data_book'][$key] = array_merge($value, ['count_stock' => $count_stock]);
            }
        }

        echo view('dashboard/layout/header');
        echo view('dashboard/history', $data);
    }

    //เช็คหนังสือ
    function check_stock_all()
    {
        $StockBookModels = new StockBookModels();
        $BookModels = new BookModels();

        $data_book = $BookModels->findAll();
        foreach ($data_book as $key => $value) {
            $data_stock = $StockBookModels->where('id_book', $value['id_book'])->where('status_stock', 1)->first();
            if ($data_stock != null) {
                $BookModels->update($value['id_book'], ['status_book' => 1]);
            } else {
                $BookModels->update($value['id_book'], ['status_book' => 0]);
            }
        }
    }

    //จองหนังสือ
    function reserve_book_stock($id_book = [])
    {
        $StockBookModels = new StockBookModels();
        $BookModels = new BookModels();
        $data_stock = [];
        $id_stock_book = null;

        $this->check_stock_all();
        foreach ($id_book as $key => $id) {
            $check_status_book = $BookModels->where('id_book', $id)->where('status_book', 1)->first();
            if ($check_status_book != null) {
                $data = $StockBookModels->where('id_book', $id)->where('status_stock', 1)->first();
                if ($data != null) {
                    $data_stock[$key] = $data['id_stock'];
                    $StockBookModels->update($data['id_stock'], ['status_stock' => 2]);
                }
            }
        }
        if ($data_stock != null) {
            $id_stock_book = implode(',', $data_stock);
        }

        $this->check_stock_all();
        return $id_stock_book;
    }

    //สร้างการยืมหนังสือ
    public function create_history()
    {
        helper(['form']);
        $HistoryModels = new HistoryModels();
        $UserModels = new UserModels();
        $rental_date = $this->request->getVar('rental_date_create');
        $return_date = $this->request->getVar('return_date_create');
        $id_promotion = $this->request->getVar('sumid_promotion');
        if ($id_promotion == null) {
            $id_promotion = null;
        }
        $rental_formattedDate = date('Y/m/d', strtotime($rental_date));
        $return_formattedDate = date('Y/m/d', strtotime($return_date));
        $cart_id = explode(',', $this->request->getVar('cart_id'));
        $this->delete_cart($cart_id);

        $id_book = explode(',', $this->request->getVar('name_book_create__'));

        $check_stock = $this->reserve_book_stock($id_book);
        if ($check_stock != null) {
            $data = [
                'id_user' => $this->request->getVar('name_user_create'),
                'id_book' => $this->request->getVar('name_book_create__'),
                'id_stock_book' => $check_stock,
                'rental_date' => $rental_formattedDate,
                'return_date' => $return_formattedDate,
                'submit_date' => null,
                'sum_rental_price' => $this->request->getVar('price_book_create'),
                'sum_deposit_price' => $this->request->getVar('price_deposit_'),
                'sum_late_price' => null,
                'sum_price_promotion' => $this->request->getVar('sum_price_promotion'),
                'id_promotion' => $id_promotion,
                'status_his' => 1,
            ];
            $check = $HistoryModels->save($data);
            if ($check) {
                $UserModels->update($this->request->getVar('name_user_create'), ['status_rental' => 2]);
                $response = [
                    'success' => true,
                    'message' => 'สร้างข้อมูลเช่าสำเร็จ!',
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
                'message' => 'หนังสือหมดสต็อก!',
                'reload' => false,
            ];
        }

        return $this->response->setJSON($response);
    }

    //ยกเลิกการเช่า
    public function cancel_his($id_history = null)
    {
        helper(['form']);
        $HistoryModels = new HistoryModels();
        $UserModels = new UserModels();
        $BookController = new BookController();

        $id_stock_book = $HistoryModels->where('id_history', $id_history)->findAll()[0]['id_stock_book'];
        $StockIds = explode(',', $id_stock_book);
        foreach ($StockIds as $StockId) {
            $BookController->change_status_stock_function($StockId, 1, 1);
        }

        $id_user = $HistoryModels->where('id_history', $id_history)->findAll()[0]['id_user'];
        $UserModels->update($id_user, ['status_rental' => 1]);

        $check = $HistoryModels->where('id_history', $id_history)->delete($id_history);
        if ($check) {
            $response = [
                'success' => true,
                'message' => 'ยกเลิกการเช่าสำเร็จ!',
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

    //แก้ไขการเช่า
    public function edit_history($id_history = null)
    {
        helper(['form']);
        $HistoryModels = new HistoryModels();
        $inputDate = $this->request->getVar('return_date');
        $price_late = $this->request->getVar('sum_late_price');
        $pice_promotion = $this->request->getVar('sum_price_promotion');
        $BookController = new BookController();

        // Format the date if needed (adjust the format according to your database requirements)
        $formattedDate = date('Y/m/d', strtotime($inputDate));

        $data = [
            'return_date' => $formattedDate,
            'late_price' => $price_late,
            'sum_price_promotion' => $pice_promotion,
        ];
        $id_stock_book = $HistoryModels->where('id_history', $id_history)->findAll()[0]['id_stock_book'];
        $StockIds = explode(',', $id_stock_book);
        $status = "";
        foreach ($StockIds as $StockId) {
            $status = $this->request->getVar('r' . $StockId);
            if ($status == 0) {
                $BookController->change_status_stock_function($StockId, 2, 1);
            }else if ($status == 1) {
                $BookController->change_status_stock_function($StockId, 3, 1);
            }else if ($status == 2) {
                $BookController->change_status_stock_function($StockId, 4, 1);
            }else if ($status == 3) {
                $BookController->change_status_stock_function($StockId, 5, 1);
            }
        }
        $check = $HistoryModels->update($id_history, $data);
        $status_his = $HistoryModels->where('id_history', $id_history)->findAll()[0]['status_his'];
        if ($check) {
            if ($status_his == 2 || $status_his == 1) {
                $response = [
                    'success' => true,
                    'message' => 'อัปเดตข้อมูลสำเร็จ',
                    'reload' => false,
                    'button' => true,
                    'status_his' => $status_his
                ];
            } else {
                $response = [
                    'success' => true,
                    'message' => 'อัปเดตข้อมูลสำเร็จ',
                    'reload' => true,
                ];
            }

        } else {
            $response = [
                'success' => false,
                'message' => 'error',
                'reload' => false,
            ];
        }

        return $this->response->setJSON($response);
    }

    //อัปเดตสถานะ กำลังเช่า
    public function update_status_his($id_history = null)
    {
        $HistoryModels = new HistoryModels();
        $UserModels = new UserModels();
        $id_user = $HistoryModels->where('id_history', $id_history)->findAll()[0]['id_user'];
        $UserModels->update($id_user, ['status_rental' => 3]);
        $data = [
            'status_his' => 2,
        ];
        $check = $HistoryModels->update($id_history, $data);

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

        return $this->response->setJSON($response);
    }

    //อัปเดตสถานะ ยืนยันการคืน
    public function submit_his($id_history = null, $price_fess_totel = null, $id_user = null)
    {
        helper(['form']);
        $HistoryModels = new HistoryModels();
        $UserModels = new UserModels();
        $BookController = new BookController();

        $price = ($price_fess_totel === '0') ? null : $price_fess_totel;
        $data = [
            'submit_date' => date('Y/m/d'),
            'late_price' => $price,
            'status_his' => 3,
        ];
        $UserModels->update($id_user, ['status_rental' => 1]);
        $id_stock_book = $HistoryModels->where('id_history', $id_history)->findAll()[0]['id_stock_book'];
        $StockIds = explode(',', $id_stock_book);
        foreach ($StockIds as $StockId) {
            $BookController->change_status_stock_function($StockId, 1, 0);
        }
        $check = $HistoryModels->update($id_history, $data);
        if ($check) {
            $response = [
                'success' => true,
                'message' => 'ยืนยันการคืนสำเร็จ!',
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

    public function delete_create_history()
    {
        $bookIds = explode(',', $this->request->getVar('name_book_create__'));
        $cart_id = explode(',', $this->request->getVar('cart_id'));

        $this->chage_status_book($bookIds, 1);
        $this->delete_cart($cart_id);

        $response = [
            'success' => true,
            'message' => 'ยกเลิกการตระกร้าสำเร็จ!',
            'reload' => true,
        ];

        return $this->response->setJSON($response);
    }
    function chage_status_book($bookIds = [], $numberstatus = null)
    {
        $BookModels = new BookModels();
        foreach ($bookIds as $id_book) {
            $bookData = [
                'status_book' => $numberstatus,
            ];

            $BookModels->update($id_book, $bookData);
        }
    }

    function delete_cart($cartIds = [])
    {
        $CartModels = new CartModels();
        foreach ($cartIds as $id_cart) {
            $CartModels->where('id_cart', $id_cart)->delete($id_cart);
        }
    }


    public function billview($id_history = null)
    {
        $HistoryModels = new HistoryModels();
        $UserModels = new UserModels();
        $CategoryModels = new CategoryModels();
        $BookModels = new BookModels();
        $PromotionModels = new PromotionModels();

        $data['data_book'] = $BookModels->findAll();
        $data['data_promotion'] = $PromotionModels->findAll();
        $data['data_category'] = $CategoryModels->findAll();
        $data['data_category'] = $CategoryModels->findAll();
        $data['data_history'] = $HistoryModels->getWhere(['id_history' => $id_history])->getResultArray();

        if (!empty($data['data_history'])) {
            $id_user = $data['data_history'][0]['id_user'];
            $data['data_user'] = $UserModels->getWhere(['id_user' => $id_user])->getResultArray();
            echo view('dashboard/bill_view', $data);
        } else {
            echo "History record not found for id_history: $id_history";
        }
    }

    public function history_user($id_user = null)
    {
        $HistoryModels = new HistoryModels();
        $UserModels = new UserModels();
        $BookModels = new BookModels();
        $CategoryModels = new CategoryModels();
        $LateFeesModels = new LateFeesModels();
        $data['data_history'] = $HistoryModels->where('id_user', $id_user)->findAll();
        $data['data_user'] = $UserModels->where('id_user', $id_user)->findAll();
        $data['data_book'] = $BookModels->findAll();
        $data['data_category'] = $CategoryModels->findAll();
        $data['data_latefees'] = $LateFeesModels->findAll();

        echo view('dashboard/layout/header');
        echo view('dashboard/user_history', $data);
    }

    public function get_data_table($status_his = null)
    {
        $HistoryModels = new HistoryModels();
        $StockBookModels = new StockBookModels();

        // Get search value
        $searchValue = $this->request->getVar('search')['value'];

        // Apply search filter
        if (!empty($searchValue)) {
            $HistoryModels->join('user_table', 'user_table.id_user = history_book_table.id_user');

            $HistoryModels->groupStart();
            $HistoryModels->like('user_table.name', $searchValue);
            $HistoryModels->orLike('user_table.lastname', $searchValue);
            $HistoryModels->groupEnd();
        }

        // Get total records after applying search
        $totalRecords = $HistoryModels->where('status_his', $status_his)->countAllResults();

        // Get DataTable parameters
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');

        // Get filtered data
        if (!empty($searchValue)) {
            $HistoryModels->join('user_table', 'user_table.id_user = history_book_table.id_user');

            $HistoryModels->groupStart();
            $HistoryModels->like('user_table.name', $searchValue);
            $HistoryModels->orLike('user_table.lastname', $searchValue);
            $HistoryModels->groupEnd();
        }

        $data = $HistoryModels->where('status_his', $status_his)->findAll($limit, $start);

        foreach ($data as $key_1 => $value) {
            $id_stock = explode(',', $value['id_stock_book']);
            foreach ($id_stock as $key_2 => $id) {
                $data_stock = $StockBookModels->where('id_stock', $id)->first();
                $data[$key_1]['stock'][$key_2] = $data_stock;
            }
        }
        // Prepare response
        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords, // You may need to update this based on the actual filtered count
            'data' => $data,
            'searchValue' => $searchValue,
        ];

        return $this->response->setJSON($response);
    }



}
