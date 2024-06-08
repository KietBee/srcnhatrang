<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Age;
use Illuminate\Support\Carbon;

class AgeController extends Controller
{
    public function index() {
        return view('page.admin.age.index');
    }

    public function edit(Request $request, $id) {
        $age = Age::findOrFail($id);
        return view('page.admin.age.edit', compact('age'));
    }

    public function create(Request $request) { 
        $currentDateTime = Carbon::now()->format('Hisdm');
        $age = Age::create([
            'age_id' => 'AG'. $currentDateTime,
            'description' => $request->description,
        ]);
    
        if ($age->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Dữ liệu mới đã được tạo thành công!');
        } else {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra khi tạo dữ liệu mới!');
        }
    }

    public function update(Request $request, $id) {
        try {
            $age = Age::findOrFail($id);
    
            $age->description =  $request->description;
    
            $age->save();
    
            return redirect()->back()->with('success', 'Dữ liệu đã được cập nhật thành công!');
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật dữ liệu. Vui lòng thử lại sau.');
        }
    }    

    public function destroy($id) {
        $age = Age::findOrFail($id);
        $age->delete();

        return response()->json(['message' => 'Bản ghi đã được xóa thành công.']);
    }
}
