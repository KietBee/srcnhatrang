<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        return view('page.app.statistics.statistics');
    }
}
