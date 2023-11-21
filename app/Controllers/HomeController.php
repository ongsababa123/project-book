<?php

namespace App\Controllers;
use App\Models\BookModels;
use App\Models\CategoryModels;

class HomeController extends BaseController
{
    public function index()
    {
        $BookModels = new BookModels();
        $data['bookData'] = $BookModels->orderBy('RAND()')->limit(3)->get()->getResultArray();

        echo view('userview/layout/header_home' );
        echo view('userview/Home', $data );
        echo view('userview/layout/footer' );
    }

    public function index_listbook()
    {
        $BookModels = new BookModels();
        $CategoryModels = new CategoryModels();
        $data['bookData'] = $BookModels->where('status_book', 1)->findAll();
        $data['categoryData'] = $CategoryModels->where('status', 1)->findAll();

        echo view('userview/layout/header_base' );
        echo view('userview/Booklist', $data );
        echo view('userview/layout/footer' );
    }
}
