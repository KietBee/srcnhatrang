<?php

namespace App\Http\Controllers\Admin;

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getAllUser(Request $request) {
        $users = User::getAllDataUsers($request->input('paginate', 8));
        return view('admin.page.user', compact('users'));
    }

    public function getDetailUser(Request $request, $id) {
        $user = User::findOrFail($id);
        return view('admin.page.user-detail', compact('user'));
    }
}

