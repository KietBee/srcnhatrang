<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // public function index() {
    //     if(Auth::id()) {
    //         $userType = Auth()->user()->userType->user_type_name;

    //         if($userType=='user') {
    //             return view('dashboard');
    //         } elseif($userType=='admin') {
    //             return view('admin.page.dashboard');
    //         } else {
    //             return redirect()->back();
    //         }
    //     }
    // }

    // public function post() {
    //     return view('post');
    // } 
}
