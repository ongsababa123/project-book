<?php

namespace App\Controllers;

// use App\Models\BookModels;
// use App\Models\CategoryModels;

class LoginController extends BaseController
{

    public function index_Login()
    {
        echo view('Login');
    }

    public function index_Register()
    {
        echo view('Register');
    }

    public function index_forgotpassword()
    {
        echo view('Forgotpassword');
    }

    public function index_resetpassword()
    {
        echo view('ResetPassword');
    }
}
