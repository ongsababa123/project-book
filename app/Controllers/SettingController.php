<?php

namespace App\Controllers;

use App\Models\LateFeesModels;
use App\Models\DayrentModels;
use App\Models\DetailsModels;

class SettingController extends BaseController
{
    public function index()
    {
        $LateFeesModels = new LateFeesModels();
        $DayrentModels = new DayrentModels();
        $data['late_fees'] = $LateFeesModels->findAll();
        $data['dayrent'] = $DayrentModels->findAll();
        echo view('dashboard/layout/header');
        echo view('dashboard/setting', $data);
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

    public function edit_dayrent($id_day_rent = null)
    {
        helper(['form']);
        $DayrentModels = new DayrentModels();
        $data = [
            'day_rent' => $this->request->getVar('day_rent'),
        ];
        $check = $DayrentModels->update($id_day_rent, $data);
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

    public function crate_details()
    {
        helper(['form']);
        $DetailsModels = new DetailsModels();
        $data = [
            'text_details' => $this->request->getVar('detail'),
        ];

        $check = $DetailsModels->insert($data);
        if ($check) {
            $response = [
                'success' => true,
                'message' => 'สร้างรายการสำเร็จ',
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

    public function edit_details($id_details = null)
    {
        helper(['form']);
        $DetailsModels = new DetailsModels();
        $data = [
            'text_details' => $this->request->getVar('detail'),
        ];

        $check = $DetailsModels->update($id_details, $data);
        if ($check) {
            $response = [
                'success' => true,
                'message' => 'สร้างรายการสำเร็จ',
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

    public function delete_details($id_details = null){
        helper(['form']);
        $DetailsModels = new DetailsModels();
        $check = $DetailsModels->delete($id_details);
        if ($check) {
            $response = [
                'success' => true,
                'message' => 'ลบรายการสำเร็จ',
                'reload' => true,
            ];
        }else{
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
        $DetailsModels = new DetailsModels();
        $totalRecords = $DetailsModels->countAllResults();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');

        $recordsFiltered = $totalRecords;
        $recordsFiltered = $totalRecords;

        $data = $DetailsModels->findAll($limit, $start);

        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ];

        return $this->response->setJSON($response);
    }


}
