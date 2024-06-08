<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PredefinedOnlyAmount;
use Illuminate\Http\Request;

class PredefinedOnlyAmountController extends Controller
{
    public function index() {
        return view('page.admin.predefined-only-amount.index');
    }

    public function edit(Request $request, $id) {
        $predefinedOnlyAmount = PredefinedOnlyAmount::findOrFail($id);
        return view('page.admin.predefined-only-amount.edit', compact('predefinedOnlyAmount'));
    }

    public function create(Request $request) { 
        $predefinedOnlyAmount = PredefinedOnlyAmount::create([
            'amount' => $request->amount,
        ]);
    
        if ($predefinedOnlyAmount->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'dữ liệu mới đã được tạo thành công!');
        } else {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra khi tạo dữ liệu mới!');
        }
    }

    public function update(Request $request, $id) {
        try {
            $predefinedOnlyAmount = PredefinedOnlyAmount::findOrFail($id);
    
            $predefinedOnlyAmount->amount = $request->amount;
    
            $predefinedOnlyAmount->save();
    
            return redirect()->back()->with('success', 'Dữ liệu đã được cập nhật thành công!');
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật dữ liệu. Vui lòng thử lại sau.');
        }
    }    

    public function destroy($id) {
        $predefinedOnlyAmount = PredefinedOnlyAmount::findOrFail($id);
        $predefinedOnlyAmount->delete();

        return response()->json(['message' => 'Bản ghi đã được xóa thành công.']);
    }
}
