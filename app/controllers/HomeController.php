<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Users;
use App\Services\EmailService;
use App\Services\PaginateService;
use App\Services\PaymentGatewayService;

class HomeController extends Controller
{
    public function index()
    {
        $pix = PaymentGatewayService::gerarPix();


        $this->view('home/index', ['pix'=>$pix]);
    }
}
