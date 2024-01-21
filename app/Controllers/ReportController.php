<?php

namespace App\Controllers;

use App\Models\BookModels;
use App\Models\HistoryController;

class ReportController extends BaseController
{
    public function report_index()
    {
        echo view('dashboard/layout/header');
        echo view('dashboard/report');
    }

}
