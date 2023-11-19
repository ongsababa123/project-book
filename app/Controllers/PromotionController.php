<?php

namespace App\Controllers;

use App\Models\PromotionModels;

class PromotionController extends BaseController
{
    public function index()
    {
        echo view('dashboard/layout/header');
        echo view('dashboard/promotion');
    }

    public function edit_promotion($id_promotion = null , $status = null)
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
}
