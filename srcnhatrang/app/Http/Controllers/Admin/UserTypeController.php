<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserType;
use Illuminate\Support\Carbon;

class UserTypeController extends Controller
{
    public function index() {
        return view('page.admin.user-type.index');
    }

    public function edit(Request $request, $id) {
        $userType = UserType::findOrFail($id);
        return view('page.admin.user-type.edit', compact('userType'));
    }

    public function create(Request $request) {
        $currentDateTime = Carbon::now()->format('Hisdm'); 
        $userType = UserType::create([
            'user_type_id' => 'UT'. $currentDateTime,
            'user_type_name' => $request->user_type_name,
        ]);
    
        if ($userType->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Dữ liệu mới đã được tạo thành công!');
        } else {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra khi tạo dữ liệu mới!');
        }
    }

    public function update(Request $request, $id) {
        try {
            $userType = UserType::findOrFail($id);
    
            $userType->user_type_name =  $request->user_type_name;
    
            $userType->save();
    
            return redirect()->back()->with('success', 'Dữ liệu đã được cập nhật thành công!');
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật dữ liệu. Vui lòng thử lại sau.');
        }
    }    

    public function destroy($id) {
        $userType = UserType::findOrFail($id);
        $userType->delete();

        return response()->json(['message' => 'Bản ghi đã được xóa thành công.']);
    }
}
