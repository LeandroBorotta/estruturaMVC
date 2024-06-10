<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Users;
use App\Services\EmailService;

class HomeController extends Controller {
    public function index() {
        $email = "leandroborotta2006@gmail.com";
        $mensagem = "isso é um teste";
        $titulo = "teste";

       
      
        $nome = "João";
        $idade = 30;
        $this->view('home/index', ['nome' => $nome, 'idade' => $idade]);
    }
}
