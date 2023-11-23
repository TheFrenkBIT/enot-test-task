<?php

namespace App\Controllers;

class AuthController extends Controller
{
    public function index()
    {
        include_once APP_PATH . '/views/pages/login.php';
    }
    public function login()
    {
        include_once APP_PATH . '/views/pages/login.php';
    }
    public function authUser()
    {
        if ($this->auth()->attempt($_REQUEST['login'], $_REQUEST['password']))
        {
            $_SESSION['is_auth'] = true;
            header('Location: http://localhost:8000/admin');
        } else {
            $_SESSION['is_auth'] = false;
        }
    }
}