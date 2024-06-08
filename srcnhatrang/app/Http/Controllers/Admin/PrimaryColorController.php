<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PrimaryColor;

class PrimaryColorController extends Controller
{
    public function index() {
        return view('page.admin.primary-color.index');
    }

    public function edit(Request $request, $id) {
        $primary_color = PrimaryColor::findOrFail($id);
        return view('page.admin.primary-color.edit', compact('primary_color'));
    }

    public function create(Request $request) { 
        $currentDateTime = Carbon::now()->format('Hisdm');
        $primary_color = PrimaryColor::create([
            'primary_color_id' => 'PR'. $currentDateTime,
            'primary_color_name' => $request->primary_color_name,
        ]);
    
        if ($primary_color->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Dữ liệu mới đã được tạo thành công!');
        } else {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra khi tạo dữ liệu mới!');
        }
    }

    public function update(Request $request, $id) {
        try {
            $primary_color = PrimaryColor::findOrFail($id);
    
            $primary_color->primary_color_name =  $request->primary_color_name;
    
            $primary_color->save();
    
            return redirect()->back()->with('success', 'Dữ liệu đã được cập nhật thành công!');
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật dữ liệu. Vui lòng thử lại sau.');
        }
    }    

    public function destroy($id) {
        $primary_color = PrimaryColor::findOrFail($id);
        $primary_color->delete();

        return response()->json(['message' => 'Bản ghi đã được xóa thành công.']);
    }
}
