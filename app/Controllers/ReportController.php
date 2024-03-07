<?php

namespace App\Controllers;

use App\Models\BookModels;
use App\Models\HistoryModels;
use App\Models\CategoryModels;
use Config\Services;
use Mpdf\Mpdf;

class ReportController extends BaseController
{
    public function report_index()
    {
        $BookModels = new BookModels();
        $CategoryModels = new CategoryModels();
        $data['book'] = $BookModels->findAll();
        foreach ($data['book'] as $key => $value) {
            $data['book'][$key]['category'] = $CategoryModels->where('id_category', $value['category_id'])->select('name_category')->first();
        }
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

    public function htmlToPDF()
    {
        // Create an instance of Mpdf
        $mpdf = new \Mpdf\Mpdf([
            'fontDir' => __DIR__ . '/fonts',
            'fontdata' => [
                'sarabun' => [
                    'R' => 'THSarabunNew.ttf',
                    'I' => 'THSarabunNew Italic.ttf',
                    'B' => 'THSarabunNew Bold.ttf',
                ]
            ],
            'default_font' => 'sarabun',
        ]);

        // Set additional properties
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        // Generate PDF content
        $html = view('dashboard/pdf_view_', []);
        $mpdf->WriteHTML($html);

        // Output the PDF to the browser or save it to a file
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('arjun.pdf', 'I'); // opens in browser
    }

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
                        $data['book'][$key]['count_price_sum'] = ($value['price'] * $data['book'][$key]['count_history']);
                        $data['history'][$key_history]['late_price'] = $late_price;
                        $data['history'][$key_history]['count_price_sum'] = $price + $late_price;
                    }
                }
            }
        }
        $data['date'] = $date;
        $data['type'] = $type_data;
        $data['type_load'] = $type;

        if ($type == 1) {
            // Create an instance of Mpdf
            $mpdf = new \Mpdf\Mpdf([
                'fontDir' => __DIR__ . '/fonts',
                'fontdata' => [
                    'sarabun' => [
                        'R' => 'THSarabunNew.ttf',
                        'I' => 'THSarabunNew Italic.ttf',
                        'B' => 'THSarabunNew Bold.ttf',
                    ],
                ],
                'default_font' => 'sarabun',
            ]);

            // Set additional properties
            $mpdf->autoScriptToLang = true;
            $mpdf->autoLangToFont = true;

            // Generate PDF content
            $html = view('dashboard/pdf_view_', $data);

            $mpdf->WriteHTML($html);

            // Output the PDF to the browser or save it to a file
            $this->response->setHeader('Content-Type', 'application/pdf');
            $mpdf->Output('รายงานยอดขาย.pdf', 'I'); // opens in browser
        } else if ($type == 2) {
            echo view('dashboard/print_view', $data);
        } else if ($type == 3) {
            // Create an instance of Mpdf
            $mpdf = new \Mpdf\Mpdf([
                'fontDir' => __DIR__ . '/fonts',
                'fontdata' => [
                    'sarabun' => [
                        'R' => 'THSarabunNew.ttf',
                        'I' => 'THSarabunNew Italic.ttf',
                        'B' => 'THSarabunNew Bold.ttf',
                    ],
                ],
                'default_font' => 'sarabun',
            ]);

            // Set additional properties
            $mpdf->autoScriptToLang = true;
            $mpdf->autoLangToFont = true;

            // Generate PDF content
            $html = view('dashboard/pdf_view_his', $data);

            $mpdf->WriteHTML($html);

            // Output the PDF to the browser or save it to a file
            $this->response->setHeader('Content-Type', 'application/pdf');
            $mpdf->Output('รายงานยอดขาย.pdf', 'I'); // opens in browser
        } else if ($type == 4) {
            echo view('dashboard/print_view_his', $data);
        }

    }
}
