<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        echo view('dashboard/layout/header');
        echo view('dashboard/home');
    }
}
