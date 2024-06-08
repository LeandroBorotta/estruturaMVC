<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Users;

class HomeController extends Controller {
    public function index() {

        $nome = "João";
        $idade = 30;
        $this->view('home/index', ['nome' => $nome, 'idade' => $idade]);
    }
}
