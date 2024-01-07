<?php

namespace App\Controllers;

use App\Models\HistoryModels;
use App\Models\UserModels;
use App\Models\BookModels;
use App\Models\CategoryModels;
use App\Models\LateFeesModels;
use App\Models\PromotionModels;
use App\Models\CartModels;


class HistoryController extends BaseController
{
    protected $helpers = ['form'];
    public function history_index()
    {
        $UserModels = new UserModels();
        $BookModels = new BookModels();
        $CategoryModels = new CategoryModels();
        $LateFeesModels = new LateFeesModels();
        $PromotionModels = new PromotionModels();
        $data['data_user'] = $UserModels->where('type_user', 4)->where('status_user', 1)->findAll();
        $data['data_book'] = $BookModels->findAll();
        $data['data_category'] = $CategoryModels->findAll();
        $data['data_latefees'] = $LateFeesModels->findAll();
        $data['data_promotion'] = $PromotionModels->findAll();

        echo view('dashboard/layout/header');
        echo view('dashboard/history', $data);
    }

    public function create_history()
    {
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
        $this->chage_status_book($id_book, 2);
        $data = [
            'id_user' => $this->request->getVar('name_user_create'),
            'id_book' => $this->request->getVar('name_book_create__'),
            'rental_date' => $rental_formattedDate,
            'return_date' => $return_formattedDate,
            'submit_date' => null,
            'sum_price' => $this->request->getVar('price_book_create'),
            'late_price' => null,
            'id_promotion' => $id_promotion,
            'sum_price_promotion' => $this->request->getVar('sum_price_promotion'),
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


    public function edit_history($id_history = null)
    {
        $HistoryModels = new HistoryModels();
        $inputDate = $this->request->getVar('return_date');
        $price_late = $this->request->getVar('price_late');
        $pice_promotion = $this->request->getVar('pice_promotion');

        // Format the date if needed (adjust the format according to your database requirements)
        $formattedDate = date('Y/m/d', strtotime($inputDate));

        $data = [
            'return_date' => $formattedDate,
            'late_price' => $price_late,
            'sum_price_promotion' => $pice_promotion,
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

    public function cancel_his($id_history = null)
    {
        helper(['form']);
        $HistoryModels = new HistoryModels();
        $UserModels = new UserModels();
        $id_book = $HistoryModels->where('id_history', $id_history)->findAll()[0]['id_book'];
        $bookIds = explode(',', $id_book);
        $this->chage_status_book($bookIds, 1);

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

    public function submit_his($id_history = null, $price_fess_totel = null , $id_user = null)
    {
        helper(['form']);
        $HistoryModels = new HistoryModels();
        $UserModels = new UserModels();

        $price = ($price_fess_totel === '0') ? null : $price_fess_totel;
        $data = [
            'submit_date' => date('Y/m/d'),
            'late_price' => $price,
            'status_his' => 3,
        ];
        $UserModels->update($id_user, ['status_rental' => 1]);
        $id_book = $HistoryModels->where('id_history', $id_history)->findAll()[0]['id_book'];
        $bookIds = explode(',', $id_book);
        $this->chage_status_book($bookIds, 1);
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
        $totalRecords = $HistoryModels->where('status_his', $status_his)->countAllResults();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');

        $recordsFiltered = $totalRecords;
        $recordsFiltered = $totalRecords;

        $data = $HistoryModels->where('status_his', $status_his)->findAll($limit, $start);

        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
            // 'searchValue' => $searchValue,
        ];

        return $this->response->setJSON($response);
    }
}
