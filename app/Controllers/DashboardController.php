<?php

namespace App\Controllers;
use App\Models\HistoryModels;

class DashboardController extends BaseController
{
    public function index()
    {
        $HistoryModels = new HistoryModels();

        $data['data_history'] = $HistoryModels->findAll();

        echo view('dashboard/layout/header');
        echo view('dashboard/home' , $data);
    }
}
