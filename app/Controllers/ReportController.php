<?php

namespace App\Controllers;

use App\Models\BookModels;
use App\Models\HistoryModels;

class ReportController extends BaseController
{
    public function report_index()
    {
        $BookModels = new BookModels();
        $data['book'] = $BookModels->findAll();
        echo view('dashboard/layout/header');
        echo view('dashboard/report', $data);
    }

    public function get_data_table($type_data = null)
    {
        $HistoryModels = new HistoryModels();
        $data = [];

        switch ($type_data) {
            case 1:
                $yyyy_mm_dd = $this->request->getVar('input_day');
                $data['history'] = $HistoryModels->where('DATE(submit_date)', $yyyy_mm_dd)->findAll();
                break;
            case 2:
                $yyyy_mm = $this->request->getVar('input_month');
                $data['history'] = $HistoryModels->where('DATE_FORMAT(submit_date, "%Y-%m")', $yyyy_mm)->findAll();
                break;
            case 3:
                $yyyy = $this->request->getVar('input_year');
                $data['history'] = $HistoryModels->where('DATE_FORMAT(submit_date, "%Y")', $yyyy)->findAll();
                break;
            default:
                // Handle invalid type_data here, if needed
                break;
        }

        $response = [
            'data' => $data['history']
        ];
        return $this->response->setJSON($response);
    }


}
