<?php

namespace App\Controllers;

use App\Models\BookModels;
use App\Models\HistoryModels;
use Dompdf\Dompdf;
use Dompdf\Options;

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

    public function htmlToPDF()
    {
        $html = view('dashboard/pdf_view');

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);

        // Set font directory explicitly
        $fontDir = WRITEPATH . 'fonts/';
        $dompdf->getOptions()->setFontDir($fontDir);
        $dompdf->getOptions()->setFontCache($fontDir);

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $output = $dompdf->output();

        $filename = 'hello.pdf';

        $this->response->setStatusCode(200);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $this->response->setHeader('Content-Disposition', 'inline; filename="' . $filename . '"');
        $this->response->setBody($output);

        return $this->response;
    }



    public function view_pdf()
    {
        echo view('dashboard/pdf_view');
    }
}
