<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index() {
        return view('page.admin.statistic');
    }
}
