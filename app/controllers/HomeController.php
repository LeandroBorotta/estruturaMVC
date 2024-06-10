<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Users;
use App\Services\EmailService;
use App\Services\PaginateService;

class HomeController extends Controller
{
    public function index()
    {
        $data = Users::paginate(3);

        $users = $data['results'];
        $paginateService = $data['paginateService'];

        $this->view('home/index', ["users" => $users, "paginate" => $paginateService]);
    }
}
