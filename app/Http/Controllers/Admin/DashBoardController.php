<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashBoardController extends Controller
{
    public function index() {
        if(Auth::id()) {
            $userType = Auth()->user()->userType->user_type_name;

            if($userType=='user') {
                return view('dashboard');
            } elseif($userType=='admin') {
                return view('admin.page.dashboard');
            } else {
                return redirect()->back();
            }
        }
    }

    public function post() {
        return view('post');
    } 
}
