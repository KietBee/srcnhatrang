<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Carbon;
class CategoryController extends Controller
{
    public function index() {
        return view('page.admin.category.index');
    }

    public function edit(Request $request, $id) {
        $category = Category::findOrFail($id);
        return view('page.admin.category.edit', compact('category'));
    }

    public function create(Request $request) { 
        $currentDateTime = Carbon::now()->format('Hisdm');
        $category = Category::create([
            'category_id' => 'CG'. $currentDateTime,
            'category_name' => $request->category_name,
        ]);
    
        if ($category->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Dữ liệu mới đã được tạo thành công!');
        } else {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra khi tạo dữ liệu mới!');
        }
    }

    public function update(Request $request, $id) {
        try {
            $category = Category::findOrFail($id);
    
            $category->category_name =  $request->category_name;
    
            $category->save();
    
            return redirect()->back()->with('success', 'Dữ liệu đã được cập nhật thành công!');
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật dữ liệu. Vui lòng thử lại sau.');
        }
    }    

    public function destroy($id) {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Bản ghi đã được xóa thành công.']);
    }
}
