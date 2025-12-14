<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        $title = [
            "data" => "Dashboard",
        ];
        return view("dashboard/index", $title);
    }

    public function landingpage()
    {
        $title = [
            "data" => "Landing Page",
        ];
        return view("landingpage", $title);
    }
}
