<?php

namespace App\Controllers;

use Core\Controller;

class TesteController extends Controller {
    public function index($id) {

        $this->view('home/teste');
    }

    public function show($user, $nome, $id) {

        echo $id;

    }
}