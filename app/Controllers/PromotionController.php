<?php

namespace App\Controllers;

use App\Models\PromotionModels;
use App\Models\HistoryModels;

class PromotionController extends BaseController
{
    public function index()
    {
        echo view('dashboard/layout/header');
        echo view('dashboard/promotion');
    }

    public function edit_promotion($id_promotion = null, $status = null)
    {
        helper(['form']);
        $PromotionModels = new PromotionModels();
        $data = [
            'status' => $status,
        ];

        $check = $PromotionModels->update($id_promotion, $data);
        if ($check) {
            $response = [
                'success' => true,
                'message' => 'อัปเดตสถานะสำเร็จ',
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

    public function get_data_table()
    {
        $PromotionModels = new PromotionModels();
        $totalRecords = $PromotionModels->countAllResults();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');

        $recordsFiltered = $totalRecords;
        $recordsFiltered = $totalRecords;

        $data = $PromotionModels->findAll($limit, $start);

        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ];

        return $this->response->setJSON($response);
    }

    public function cal_promotion()
    {
        $promotionModels = new PromotionModels();
        $data['promotion'] = $promotionModels->findAll();
    
        $historyModels = new HistoryModels();
        $id_user = $this->request->getVar('id_user');
        $sum_id_book = $this->request->getVar('sum_id_book');
        $sum_price = $this->request->getVar('sum_price');
        $sum_id_book_array = explode(',', $sum_id_book);
        $text = null;
        $sumid_promotion = null;
        $price_promotion = 0;
    
        $countHis = $historyModels->where('id_user', $id_user)->countAllResults();
    
        if (count($sum_id_book_array) >= 3) {
            if ($data['promotion'][0]['status'] == '1') {
                $sum_price -= 10;
                $text .= $data['promotion'][0]['details'] . '<br>';
                $sumid_promotion .= $data['promotion'][0]['id_promotion']. ',';
                $price_promotion += 10;
            }
        }
    
        if ($countHis >= 3) {
            if ($data['promotion'][1]['status'] == '1') {
                $sum_price -= 20;
                $text .= $data['promotion'][1]['details'] . '<br>';
                $sumid_promotion .= $data['promotion'][1]['id_promotion'];
                $price_promotion += 20;
            }
        }
        if ($sum_price < 0) {
            $sum_price = 0;
        }
        $response = [
            'price_result' => $sum_price,
            'price_promotion' => $price_promotion,
            'sumid_promotion' => $sumid_promotion,
            'text' => $text,
        ];
    
        return $this->response->setJSON($response);
    }
    
}
