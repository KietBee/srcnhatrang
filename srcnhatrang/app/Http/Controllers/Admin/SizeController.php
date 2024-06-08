<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Size;

class SizeController extends Controller
{
    public function index() {
        return view('page.admin.size.index');
    }

    public function edit(Request $request, $id) {
        $size = Size::findOrFail($id);
        return view('page.admin.size.edit', compact('size'));
    }

    public function create(Request $request) { 
        $currentDateTime = Carbon::now()->format('Hisdm');
        $size = Size::create([
            'size_id' => 'SZ'. $currentDateTime,
            'description' => $request->description,
        ]);
    
        if ($size->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Dữ liệu mới đã được tạo thành công!');
        } else {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra khi tạo dữ liệu mới!');
        }
    }

    public function update(Request $request, $id) {
        try {
            $size = Size::findOrFail($id);
    
            $size->description =  $request->description;
    
            $size->save();
    
            return redirect()->back()->with('success', 'Dữ liệu đã được cập nhật thành công!');
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật dữ liệu. Vui lòng thử lại sau.');
        }
    }    

    public function destroy($id) {
        $size = Size::findOrFail($id);
        $size->delete();

        return response()->json(['message' => 'Bản ghi đã được xóa thành công.']);
    }
}
