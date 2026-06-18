<?php

require_once 'core/Controller.php';
require_once 'models/UserModel.php';

class AuthController extends Controller
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        $this->view('auth/login');
    }
}