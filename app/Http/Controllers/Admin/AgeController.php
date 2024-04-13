<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgeController extends Controller
{
    public function getAllUser() {
        $users = DB::table('users')->paginate(10); // Số lượng người dùng trên mỗi trang là 10, bạn có thể thay đổi nếu cần

    return view('admin.page.user', compact('users'));
    }
}
