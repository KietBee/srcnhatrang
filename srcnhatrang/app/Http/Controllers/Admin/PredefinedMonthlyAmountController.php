<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PredefinedMonthlyAmount;
use Illuminate\Http\Request;

class PredefinedMonthlyAmountController extends Controller
{
    public function index() {
        return view('page.admin.predefined-monthly-amount.index');
    }

    public function edit(Request $request, $id) {
        $predefinedMonthlyAmount = PredefinedMonthlyAmount::findOrFail($id);
        return view('page.admin.predefined-monthly-amount.edit', compact('predefinedMonthlyAmount'));
    }

    public function create(Request $request) { 
        $predefinedMonthlyAmount = PredefinedMonthlyAmount::create([
            'amount' => $request->amount,
        ]);
    
        if ($predefinedMonthlyAmount->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'dữ liệu mới đã được tạo thành công!');
        } else {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra khi tạo dữ liệu mới!');
        }
    }

    public function update(Request $request, $id) {
        try {
            $predefinedMonthlyAmount = PredefinedMonthlyAmount::findOrFail($id);
    
            $predefinedMonthlyAmount->amount = $request->amount;
    
            $predefinedMonthlyAmount->save();
    
            return redirect()->back()->with('success', 'Dữ liệu đã được cập nhật thành công!');
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật dữ liệu. Vui lòng thử lại sau.');
        }
    }    

    public function destroy($id) {
        $predefinedMonthlyAmount = PredefinedMonthlyAmount::findOrFail($id);
        $predefinedMonthlyAmount->delete();

        return response()->json(['message' => 'Bản ghi đã được xóa thành công.']);
    }
}
