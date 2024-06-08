<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Users;

class AuthController extends Controller {
    public function index() {
        $this->view('home/login');
    }
}