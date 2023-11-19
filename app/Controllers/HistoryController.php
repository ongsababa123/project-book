<?php

namespace App\Controllers;

use App\Models\HistoryModels;
use App\Models\UserModels;
use App\Models\BookModels;
use App\Models\CategoryModels;
use App\Models\LateFeesModels;


class HistoryController extends BaseController
{
    protected $helpers = ['form'];
    public function history_index()
    {
        $UserModels = new UserModels();
        $BookModels = new BookModels();
        $CategoryModels = new CategoryModels();
        $LateFeesModels = new LateFeesModels();
        $data['data_user'] = $UserModels->findAll();
        $data['data_book'] = $BookModels->findAll();
        $data['data_category'] = $CategoryModels->findAll();
        $data['data_latefees'] = $LateFeesModels->findAll();

        echo view('dashboard/layout/header');
        echo view('dashboard/history', $data);
    }

    public function create_history()
    {
        $HistoryModels = new HistoryModels();
        $rental_date = $this->request->getVar('rental_date_create');
        $return_date = $this->request->getVar('return_date_create');

        $rental_formattedDate = date('Y/m/d', strtotime($rental_date));
        $return_formattedDate = date('Y/m/d', strtotime($return_date));

        $data = [
            'id_user' => $this->request->getVar('name_user_create'),
            'id_book' => $this->request->getVar('name_book_create__'),
            'rental_date' => $rental_formattedDate,
            'return_date' => $return_formattedDate,
            'submit_date' => null,
            'sum_price' => $this->request->getVar('price_book_create'),
            'late_price' => null,
        ];
        $check = $HistoryModels->save($data);
        if ($check) {
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
    public function edit_retrun_date($id_history = null)
    {
        $HistoryModels = new HistoryModels();
        $inputDate = $this->request->getVar('return_date');

        // Format the date if needed (adjust the format according to your database requirements)
        $formattedDate = date('Y/m/d', strtotime($inputDate));

        $data = [
            'return_date' => $formattedDate,
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

    public function submit_his($id_history = null, $price_fess_totel = null)
    {
        helper(['form']);
        $HistoryModels = new HistoryModels();
        $price = ($price_fess_totel === '0') ? null : $price_fess_totel;
        $data = [
            'submit_date' => date('Y/m/d'),
            'late_price' => $price,
        ];
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

        $data['data_book'] = $BookModels->findAll();
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
        $data['data_history'] = $HistoryModels->where('id_user', $id_user)->findAll();
        $data['data_user'] = $UserModels->where('id_user', $id_user)->findAll();
        $data['data_book'] = $BookModels->findAll();
        $data['data_category'] = $CategoryModels->findAll();

        echo view('dashboard/layout/header');
        echo view('dashboard/user_history', $data);
    }

    public function get_data_table()
    {
        $HistoryModels = new HistoryModels();
        $totalRecords = $HistoryModels->countAllResults();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');

        $recordsFiltered = $totalRecords;
        $recordsFiltered = $totalRecords;

        $data = $HistoryModels->findAll($limit, $start);

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
