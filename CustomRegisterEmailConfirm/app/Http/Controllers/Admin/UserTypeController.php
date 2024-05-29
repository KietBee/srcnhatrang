<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserType;

class UserTypeController extends Controller
{
    public function indexAction () {
        $listType = UserType::getAllUserTypes();
        return view('admin.page.user', compact('listType'));
    }
}
