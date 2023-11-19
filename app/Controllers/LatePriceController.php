<?php

namespace App\Controllers;

use App\Models\LateFeesModels;

class LatePriceController extends BaseController
{
    public function index()
    {
        echo view('dashboard/layout/header');
        echo view('dashboard/lateprice');
    }

    public function edit_lateprice($id_late_fees = null)
    {
        helper(['form']);
        $LateFeesModels = new LateFeesModels();
        $data = [
            'price_fees' => $this->request->getVar('late_price'),
        ];

        $check = $LateFeesModels->update($id_late_fees, $data);
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

    public function get_data_table()
    {
        $LateFeesModels = new LateFeesModels();
        $totalRecords = $LateFeesModels->countAllResults();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');

        $recordsFiltered = $totalRecords;
        $recordsFiltered = $totalRecords;

        $data = $LateFeesModels->findAll($limit, $start);

        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ];

        return $this->response->setJSON($response);
    }
}
