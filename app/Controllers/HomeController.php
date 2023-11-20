<?php

namespace App\Controllers;
use App\Models\HistoryModels;

class HomeController extends BaseController
{
    public function index()
    {
        echo view('userview/layout/headeruser' );
        echo view('userview/HomeUser' );
    }
}
