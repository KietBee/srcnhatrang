<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Fund;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index() {
        $listExpenses = Expense::all();
        return view('page.admin.expense.index', compact('listExpenses'));
    }

    public function create(Request $request) { 
        $currentDateTime = Carbon::now()->format('Hisdm');
        $expense = Expense::create([
            'expense_id' => 'EP'. $currentDateTime,
            'approver_id' =>  Auth::user()->id,
            'type' => false,
            'fund_id' => $request->fund,
            'amount' => $request->amount,
            'description' => $request->description
        ]);
    
        if ($expense->wasRecentlyCreated) {
            $fund = Fund::findOrFail($request->fund);
            if ($fund->current_balance >= $request->amount) {
                $fund->current_balance -= $request->amount;
                $fund->save();
                return redirect()->back()->with('success', 'Phiếu chi mới đã được tạo thành công!');
            } else {
                $expense->delete();
                return redirect()->back()->with('error', 'Số dư của quỹ không đủ để thực hiện chi phiếu!');
            }
        } else {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra khi tạo phiếu chi mới!');
        }
    }
}
