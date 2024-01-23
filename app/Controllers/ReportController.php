<?php

namespace App\Controllers;

use App\Models\BookModels;
use App\Models\HistoryModels;
// use Dompdf\Dompdf;
// use Dompdf\Options;

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

    // public function htmlToPDF()
    // {
    //     $html = view('dashboard/pdf_view');

    //     $options = new Options();
    //     $options->set('isHtml5ParserEnabled', true);
    //     $options->set('isPhpEnabled', true);

    //     $dompdf = new Dompdf($options);

    //     // Set font directory explicitly
    //     $fontDir = WRITEPATH . 'fonts/';
    //     $dompdf->getOptions()->setFontDir($fontDir);
    //     $dompdf->getOptions()->setFontCache($fontDir);
    //     $dompdf->loadHtml($html);

    //     $dompdf->setPaper('A4', 'portrait');

    //     $dompdf->render();

    //     $output = $dompdf->output();

    //     $filename = 'hello.pdf';

    //     $this->response->setStatusCode(200);
    //     $this->response->setHeader('Content-Type', 'application/pdf');
    //     $this->response->setHeader('Content-Disposition', 'inline; filename="' . $filename . '"');
    //     $this->response->setBody($output);

    //     return $this->response;
    // }



    public function view_pdf($date = null, $type_data = null, $type = null)
    {
        $HistoryModels = new HistoryModels();
        $BookModels = new BookModels();
        $data['book'] = $BookModels->findAll();

        switch ($type_data) {
            case 1:
                $data['history'] = $HistoryModels->where('DATE(submit_date)', $date)->findAll();
                break;
            case 2:
                $data['history'] = $HistoryModels->where('DATE_FORMAT(submit_date, "%Y-%m")', $date)->findAll();
                break;
            case 3:
                $data['history'] = $HistoryModels->where('DATE_FORMAT(submit_date, "%Y")', $date)->findAll();
                break;
            default:
                // Handle invalid type_data here, if needed
                break;
        }
        foreach ($data['book'] as $key => $value) {
            $data['book'][$key]['count_history'] = 0;
            $data['book'][$key]['count_price_sum'] = 0;
            foreach ($data['history'] as $key_history => $value_history) {

                $id_book_splite = explode(',', $value_history['id_book']);
                foreach ($id_book_splite as $key_id_book => $id_book) {

                    if ($value['id_book'] == $id_book) {
                        $data['book'][$key]['count_history']++;
                        $price = $value_history['sum_rental_price'] + $value_history['sum_deposit_price'] - $value_history['sum_price_promotion'];
                        $late_price = $value_history['sum_late_price'] + $value_history['sum_day_late_price'] + $value_history['sum_book_des_price'];
                        $data['book'][$key]['count_price_sum'] += ($price + $late_price);
                    }
                }
            }
        }
        $data['date'] = $date;
        $data['type'] = $type_data;
        $data['type_load'] = $type;

        echo view('dashboard/pdf_view', $data);
    }
}
