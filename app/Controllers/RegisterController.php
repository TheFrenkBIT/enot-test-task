<?php

namespace App\Controllers;
use App\Controllers\Controller;
use App\Router\Route;

class RegisterController extends Controller
{
    public function index()
    {
        include_once APP_PATH . '/views/pages/register.php';
    }
    public function register()
    {
        include_once APP_PATH . '/views/pages/register.php';
    }
    public function saveUser()
    {
        $userCreate = $this->db()->insert('users',[
            'login' => $_REQUEST['login'],
            'password' => password_hash($_REQUEST['password'], PASSWORD_DEFAULT)
        ]);
        if ($userCreate)
        {
            include_once APP_PATH . '/views/pages/login.php';
        } else {
            echo 'user not created';
        }
    }
}